<?php
/* =========================================================================
   APOIO VITAL - enviar.php
   Recebe os formularios do site e manda por e-mail. Sem banco de dados,
   sem servico de terceiro, sem guardar nada em arquivo.

   Por que nao guarda: o formulario toca informacao de saude, que a LGPD
   trata como dado pessoal sensivel no art. 11. O caminho mais seguro e o
   dado so existir no e-mail, e nao tambem num arquivo no servidor.

   Curriculo em arquivo (so no formulario Trabalhe Conosco): o arquivo nunca
   e gravado no site. O PHP o deixa numa pasta temporaria que ele mesmo apaga
   ao fim do pedido; aqui ele e lido dali, conferido e seguido como anexo do
   e-mail. Aceita PDF, DOC e DOCX de ate 5 MB, e o conteudo precisa ser do tipo
   que a extensao diz, nao basta o nome.

   Funciona SEM JavaScript: os formularios tem action e method (e o de
   candidatos tem enctype multipart), entao quem estiver com script bloqueado
   continua conseguindo enviar.
   ========================================================================= */

/* O Trabalhe Conosco vai para contato@, a unica caixa que se sabe que existe.
   rh@apoiovital.com so serve se for criado antes (hPanel > E-mails): e-mail
   para endereco que nao existe nao chega a ninguem. Para usar rh@, troque so
   a linha 'trabalhe' abaixo. */
$DESTINO = array(
    'contato'  => 'contato@apoiovital.com',
    'trabalhe' => 'contato@apoiovital.com',
);
$REMETENTE = 'contato@apoiovital.com';   // mesmo dominio: passa pelo SPF e DKIM
$OBRIGADO  = '/obrigado.html';
$VOLTAR    = '/contato.html';            // para onde "Voltar ao formulario" leva

$ARQUIVO_MAX   = 5 * 1024 * 1024;        // o mesmo limite que o formulario diz ao candidato
$ARQUIVO_TIPOS = array(
    'pdf'  => 'application/pdf',
    'doc'  => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
);

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
/* Troca letra acentuada pela letra simples. Serve para o assunto do e-mail e
   para o nome do arquivo anexo, que assim ficam em ASCII e nao dependem de
   codificacao em nenhum programa de e-mail. */
function semAcento($s) {
    static $mapa = array(
        'á'=>'a','à'=>'a','â'=>'a','ã'=>'a','ä'=>'a','é'=>'e','è'=>'e','ê'=>'e','ë'=>'e',
        'í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','ó'=>'o','ò'=>'o','ô'=>'o','õ'=>'o','ö'=>'o',
        'ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','ç'=>'c','ñ'=>'n',
        'Á'=>'A','À'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E',
        'Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I','Ó'=>'O','Ò'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O',
        'Ú'=>'U','Ù'=>'U','Û'=>'U','Ü'=>'U','Ç'=>'C','Ñ'=>'N',
    );
    return strtr($s, $mapa);
}

/* Nome do anexo montado a partir do nome do candidato. O nome que o arquivo
   tinha no aparelho dele nunca vai para o e-mail. */
function nomeDoAnexo($nome, $ext) {
    $s = preg_replace('/[^A-Za-z0-9]+/', '-', semAcento($nome));
    $s = trim(substr($s, 0, 40), '-');
    return 'Curriculo-' . ($s !== '' ? $s : 'candidato') . '.' . $ext;
}

/* Confere o curriculo enviado. Devolve array('vazio'=>true) se nao veio
   arquivo (o campo e opcional), array('erro'=>texto) se veio e nao serve, ou
   array('ext','dados','tam') se esta tudo certo. */
function confereArquivo($f, $max, $tipos) {
    if (!is_array($f) || !isset($f['error']) || is_array($f['error'])) {
        return array('vazio' => true);
    }
    if ($f['error'] === UPLOAD_ERR_NO_FILE) {
        return array('vazio' => true);
    }
    $grande = 'O arquivo é maior que 5 MB. Envie um PDF, DOC ou DOCX de até 5 MB.';
    if ($f['error'] === UPLOAD_ERR_INI_SIZE || $f['error'] === UPLOAD_ERR_FORM_SIZE) {
        return array('erro' => $grande);
    }
    if ($f['error'] !== UPLOAD_ERR_OK || empty($f['tmp_name']) || !is_uploaded_file($f['tmp_name'])) {
        return array('erro' => 'Não conseguimos receber o arquivo. Tente de novo.');
    }
    $tam = (int) filesize($f['tmp_name']);
    if ($tam <= 0) {
        return array('erro' => 'O arquivo está vazio. Escolha outro.');
    }
    if ($tam > $max) {
        return array('erro' => $grande);
    }
    $nome = isset($f['name']) && is_string($f['name']) ? $f['name'] : '';
    $ext  = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
    $tipoErro = 'Envie o currículo em PDF, DOC ou DOCX.';
    if (!isset($tipos[$ext])) {
        return array('erro' => $tipoErro);
    }
    $dados = @file_get_contents($f['tmp_name']);
    if ($dados === false) {
        return array('erro' => 'Não conseguimos receber o arquivo. Tente de novo.');
    }

    /* O conteudo tem que ser do tipo que o nome diz. Olha os primeiros bytes
       e, nos formatos do Word, o nome de uma peca que so existe nele. */
    $pdf  = strpos(substr($dados, 0, 1024), '%PDF-') !== false;
    $ole  = substr($dados, 0, 8) === "\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1"
            && strpos($dados, "W\0o\0r\0d\0D\0o\0c\0u\0m\0e\0n\0t\0") !== false;
    $rtf  = substr($dados, 0, 5) === '{\\rtf';
    $docx = substr($dados, 0, 2) === 'PK'
            && strpos($dados, '[Content_Types].xml') !== false
            && strpos($dados, 'word/document.xml') !== false
            && stripos($dados, 'vbaProject.bin') === false;   // docx com macro e docm disfarcado
    if ($ext === 'pdf'  && !$pdf)                    { return array('erro' => $tipoErro); }
    if ($ext === 'docx' && !$docx)                   { return array('erro' => $tipoErro); }
    if ($ext === 'doc'  && !($ole || $rtf || $docx)) { return array('erro' => $tipoErro); }

    return array('ext' => $ext, 'dados' => $dados, 'tam' => $tam);
}

function termina($ok, $msg, $destino) {
    global $VOLTAR;
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
            echo '<!doctype html><meta charset="utf-8"><title>Não enviado</title>'
               . '<p style="font:16px/1.5 system-ui;padding:40px;max-width:40em">'
               . htmlspecialchars($msg, ENT_QUOTES, 'UTF-8')
               . ' <a href="' . $VOLTAR . '">Voltar ao formulário</a>.</p>';
        }
    }
    exit;
}

/* --------------------------------------------------------------- entrada */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /contato.html', true, 303);
    exit;
}

$tipo = (isset($_POST['formulario']) && $_POST['formulario'] === 'trabalhe') ? 'trabalhe' : 'contato';
if ($tipo === 'trabalhe') {
    $VOLTAR   = '/trabalhe-conosco.html';
    $OBRIGADO = '/obrigado-candidatura.html';
}

/* Se o pedido passou do limite do PHP (post_max_size), o PHP joga tudo fora e
   $_POST chega vazio. So o formulario de candidatos manda arquivo, e e para
   ele que a pessoa volta. */
if (empty($_POST) && empty($_FILES) && isset($_SERVER['CONTENT_LENGTH']) && (int) $_SERVER['CONTENT_LENGTH'] > 0) {
    $VOLTAR = '/trabalhe-conosco.html';
    termina(false, 'O arquivo é maior que 5 MB. Envie um PDF, DOC ou DOCX de até 5 MB.', $OBRIGADO);
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
    termina(false, $tipo === 'trabalhe'
        ? 'Muitos envios seguidos deste aparelho. Tente de novo mais tarde.'
        : 'Muitos envios seguidos deste aparelho. Fale com a gente no WhatsApp.', $OBRIGADO);
}

/* ----------------------------------------------------------- qual formulario */
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
        termina(false, 'Faltou preencher um campo obrigatório.', $OBRIGADO);
    }
}
foreach ($consentes as $c) {
    if (empty($_POST[$c])) {
        termina(false, 'É preciso marcar a autorização para a gente entrar em contato.', $OBRIGADO);
    }
}

/* ------------------------------------------------------ o curriculo, se veio */
$anexo = null;
if ($tipo === 'trabalhe') {
    $nomeAssunto = trim(preg_replace('/[^A-Za-z0-9 .\'\-]/', '', semAcento(limpo($_POST['nome'], 60))));
    $assunto = 'Trabalhe Conosco: ' . ($nomeAssunto !== '' ? $nomeAssunto : 'candidato');
    $r = confereArquivo(isset($_FILES['curriculo']) ? $_FILES['curriculo'] : null, $ARQUIVO_MAX, $ARQUIVO_TIPOS);
    if (isset($r['erro'])) {
        termina(false, $r['erro'], $OBRIGADO);
    }
    if (isset($r['dados'])) {
        $r['nome'] = nomeDoAnexo(limpo($_POST['nome'], 60), $r['ext']);
        $anexo = $r;
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
if ($tipo === 'trabalhe') {
    $linhas[] = '';
    $linhas[] = $anexo
        ? 'Curriculo em arquivo: anexado (' . $anexo['nome'] . ', ' . max(1, (int) round($anexo['tam'] / 1024)) . ' KB)'
        : 'Curriculo em arquivo: nao enviado';
}
$linhas[] = '';
$linhas[] = 'Autorizacoes marcadas: ' . implode(', ', $consentes);
$linhas[] = 'Recebido em: ' . gmdate('d/m/Y H:i') . ' UTC';
$linhas[] = 'Enviado pelo formulario de ' . ($tipo === 'contato' ? 'contato' : 'trabalhe conosco') . ' do site.';

$texto = implode("\n", $linhas);
$cab   = "From: Apoio Vital <$REMETENTE>\r\n"
       . "Reply-To: $REMETENTE\r\n"
       . "X-Mailer: apoiovital\r\n";

if ($anexo) {
    /* Texto e arquivo no mesmo e-mail. Os dois em base64, que e o que todo
       programa de e-mail entende, e o limite e uma sequencia aleatoria que o
       conteudo do arquivo nao tem como conter. */
    $limite = 'av' . bin2hex(function_exists('random_bytes') ? random_bytes(12) : pack('N*', mt_rand(), mt_rand(), mt_rand()));
    $cab .= "MIME-Version: 1.0\r\n"
          . "Content-Type: multipart/mixed; boundary=\"$limite\"\r\n";
    $corpo = "--$limite\r\n"
           . "Content-Type: text/plain; charset=UTF-8\r\n"
           . "Content-Transfer-Encoding: base64\r\n\r\n"
           . chunk_split(base64_encode($texto), 76, "\r\n")
           . "--$limite\r\n"
           . 'Content-Type: ' . $ARQUIVO_TIPOS[$anexo['ext']] . '; name="' . $anexo['nome'] . "\"\r\n"
           . "Content-Transfer-Encoding: base64\r\n"
           . 'Content-Disposition: attachment; filename="' . $anexo['nome'] . "\"\r\n\r\n"
           . chunk_split(base64_encode($anexo['dados']), 76, "\r\n")
           . "--$limite--\r\n";
} else {
    $cab  .= "Content-Type: text/plain; charset=UTF-8\r\n"
           . "Content-Transfer-Encoding: 8bit\r\n";
    $corpo = $texto;
}

$enviado = @mail($DESTINO[$tipo], $assunto, $corpo, $cab, '-f' . $REMETENTE);

@file_put_contents($marca, (string) ($envios + 1));

if ($enviado) {
    termina(true, 'Recebemos a sua mensagem.', $OBRIGADO);
}
termina(false, $tipo === 'trabalhe'
    ? 'Não conseguimos enviar agora. Tente de novo em alguns minutos ou mande o currículo para contato@apoiovital.com.'
    : 'Não conseguimos enviar agora. Por favor, fale com a gente no WhatsApp.', $OBRIGADO);
