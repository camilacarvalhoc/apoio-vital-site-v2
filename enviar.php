<?php
/* =========================================================================
   APOIO VITAL - enviar.php
   Recebe os formularios do site e manda por e-mail. Sem banco de dados,
   sem servico de terceiro, sem guardar nada em arquivo.

   Por que nao guarda: o formulario toca informacao de saude, que a LGPD
   trata como dado pessoal sensivel no art. 11. O caminho mais seguro e o
   dado so existir no e-mail, e nao tambem num arquivo no servidor.

   Funciona SEM JavaScript: os formularios tem action e method, entao quem
   estiver com script bloqueado continua conseguindo enviar.
   ========================================================================= */

$DESTINO = array(
    'contato'  => 'contato@apoiovital.com',
    'trabalhe' => 'rh@apoiovital.com',
);
$REMETENTE = 'contato@apoiovital.com';   // mesmo dominio: passa pelo SPF e DKIM
$OBRIGADO  = '/obrigado.html';

/* ------------------------------------------------------------- utilidades */
function limpo($v, $max = 200) {
    $v = is_string($v) ? $v : '';
    $v = str_replace(array("\r", "\n", "\0"), ' ', $v);   // corta injecao de cabecalho
    $v = trim(preg_replace('/\s+/u', ' ', strip_tags($v)));
    return function_exists('mb_substr') ? mb_substr($v, 0, $max, 'UTF-8') : substr($v, 0, $max);
}
function multilinha($v, $max = 2000) {
    $v = is_string($v) ? $v : '';
    $v = str_replace("\0", '', strip_tags($v));
    $v = preg_replace("/\r\n|\r/", "\n", $v);
    return function_exists('mb_substr') ? mb_substr(trim($v), 0, $max, 'UTF-8') : substr(trim($v), 0, $max);
}
function querJson() {
    $a = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';
    $x = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : '';
    return strpos($a, 'application/json') !== false || $x !== '';
}
function termina($ok, $msg, $destino) {
    if (querJson()) {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($ok ? 200 : 400);
        echo json_encode(array('ok' => $ok, 'mensagem' => $msg));
    } else {
        if ($ok) {
            header('Location: ' . $destino, true, 303);
        } else {
            header('Content-Type: text/html; charset=utf-8');
            http_response_code(400);
            echo '<!doctype html><meta charset="utf-8"><title>Nao enviado</title>'
               . '<p style="font:16px/1.5 system-ui;padding:40px;max-width:40em">'
               . htmlspecialchars($msg, ENT_QUOTES, 'UTF-8')
               . ' <a href="/contato.html">Voltar ao formulario</a>.</p>';
        }
    }
    exit;
}

/* --------------------------------------------------------------- entrada */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /contato.html', true, 303);
    exit;
}

/* Campo armadilha: fica escondido e so robo preenche. Se vier preenchido,
   a gente responde como se tivesse dado certo e joga fora em silencio. */
if (!empty($_POST['sobrenome_meio'])) {
    termina(true, 'Recebido.', $OBRIGADO);
}

/* Trava simples contra enxurrada. Guarda so um resumo irreversivel do IP,
   por no maximo uma hora, para prevencao de abuso (LGPD art. 7, IX).
   O IP em si nunca e gravado. */
$pastaTrava = sys_get_temp_dir() . '/av-trava';
if (!is_dir($pastaTrava)) { @mkdir($pastaTrava, 0700, true); }
$ip   = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0';
$sel  = @file_get_contents($pastaTrava . '/.sal');
if ($sel === false) {
    $sel = bin2hex(function_exists('random_bytes') ? random_bytes(16) : pack('N*', mt_rand(), mt_rand()));
    @file_put_contents($pastaTrava . '/.sal', $sel);
}
$marca = $pastaTrava . '/' . substr(hash('sha256', $sel . $ip), 0, 24);
foreach (glob($pastaTrava . '/*') ?: array() as $velho) {
    if (basename($velho) !== '.sal' && filemtime($velho) < time() - 3600) { @unlink($velho); }
}
$envios = file_exists($marca) ? (int) @file_get_contents($marca) : 0;
if ($envios >= 6) {
    termina(false, 'Muitos envios seguidos deste aparelho. Fale com a gente no WhatsApp.', $OBRIGADO);
}

/* ----------------------------------------------------------- qual formulario */
$tipo = (isset($_POST['formulario']) && $_POST['formulario'] === 'trabalhe') ? 'trabalhe' : 'contato';

if ($tipo === 'contato') {
    $campos = array(
        'nome' => 'Nome', 'telefone' => 'WhatsApp', 'bairro' => 'Bairro ou cidade',
        'situacao' => 'O que esta acontecendo', 'urgencia' => 'Para quando',
        'horas_dia' => 'Horas por dia', 'dependencia' => 'Grau de dependencia',
        'melhor_horario' => 'Melhor horario para ligar', 'origem' => 'Como chegou ate a gente',
    );
    $exigidos  = array('nome', 'telefone', 'bairro', 'situacao');
    $consentes = array('consentimento_contato', 'consentimento_saude');
    $assunto   = 'Pedido de avaliacao pelo site';
} else {
    $campos = array(
        'nome' => 'Nome', 'telefone' => 'WhatsApp', 'funcao' => 'Funcao',
        'bairro' => 'Bairro ou cidade', 'disponibilidade' => 'Disponibilidade',
    );
    $exigidos  = array('nome', 'telefone', 'funcao', 'bairro', 'disponibilidade');
    $consentes = array('consentimento');
    $assunto   = 'Cadastro pelo Trabalhe Conosco';
}

foreach ($exigidos as $c) {
    if (limpo(isset($_POST[$c]) ? $_POST[$c] : '') === '') {
        termina(false, 'Faltou preencher um campo obrigatorio.', $OBRIGADO);
    }
}
foreach ($consentes as $c) {
    if (empty($_POST[$c])) {
        termina(false, 'E preciso marcar a autorizacao para a gente entrar em contato.', $OBRIGADO);
    }
}

/* ------------------------------------------------------------- a mensagem */
$linhas = array();
foreach ($campos as $chave => $rotulo) {
    $v = limpo(isset($_POST[$chave]) ? $_POST[$chave] : '');
    if ($v !== '') { $linhas[] = $rotulo . ': ' . $v; }
}
if ($tipo === 'trabalhe' && limpo(isset($_POST['experiencia']) ? $_POST['experiencia'] : '') !== '') {
    $linhas[] = '';
    $linhas[] = 'Experiencia:';
    $linhas[] = multilinha($_POST['experiencia']);
}
$linhas[] = '';
$linhas[] = 'Autorizacoes marcadas: ' . implode(', ', $consentes);
$linhas[] = 'Recebido em: ' . gmdate('d/m/Y H:i') . ' UTC';
$linhas[] = 'Enviado pelo formulario de ' . ($tipo === 'contato' ? 'contato' : 'trabalhe conosco') . ' do site.';

$corpo = implode("\n", $linhas);
$cab   = "From: Apoio Vital <$REMETENTE>\r\n"
       . "Reply-To: $REMETENTE\r\n"
       . "Content-Type: text/plain; charset=UTF-8\r\n"
       . "Content-Transfer-Encoding: 8bit\r\n"
       . "X-Mailer: apoiovital\r\n";

$enviado = @mail($DESTINO[$tipo], '=?UTF-8?B?' . base64_encode($assunto) . '?=', $corpo, $cab, '-f' . $REMETENTE);

@file_put_contents($marca, (string) ($envios + 1));

if ($enviado) {
    termina(true, 'Recebemos a sua mensagem.', $OBRIGADO);
}
termina(false, 'Nao conseguimos enviar agora. Por favor, fale com a gente no WhatsApp.', $OBRIGADO);
