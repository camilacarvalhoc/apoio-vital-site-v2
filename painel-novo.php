<?php
/* =========================================================================
   APOIO VITAL - painel.php
   Leitura dos dados de medicao: nao grava nenhum dado de medicao.
   Grava, sim, a sessao de quem entra, com cookie proprio.

   A CHAVE NAO MORA NESTE ARQUIVO, e de proposito. Ela ficava aqui como
   constante e ia na URL, o que a deixava no historico do navegador, nos
   registros de acesso do servidor e no cabecalho de referencia. Agora:

   - o segredo vive FORA da pasta publica e fora do Git, e so o hash e
     guardado, nunca a chave em claro;
   - sem essa configuracao a pagina responde 404. Nao existe chave padrao
     de reserva: faltando configuracao, nao ha acesso;
   - a chave entra por formulario e a sessao sustenta a navegacao.

   Como instalar: docs/PAINEL-chave.md
   ========================================================================= */

// ---- 1. Cabecalhos primeiro ------------------------------------------
// Antes de qualquer caminho de saida, inclusive o 404: senao o 404 sai
// cacheavel e a CDN segura a instalacao por dez minutos.
header('X-Robots-Tag: noindex, nofollow');
header('Referrer-Policy: no-referrer');
header('Cache-Control: no-store, max-age=0, must-revalidate');
header('Expires: 0');

// ---- 2. De onde vem o hash da chave ------------------------------------
// O arquivo vive FORA da pasta publica e fora do Git, e devolve
// array('sal' => ..., 'hash' => ...). Guardamos o HMAC, nunca a chave.
//
// Por que HMAC-SHA256 e nao password_hash: a chave e gerada por maquina, com
// 160 bits de aleatoriedade, e nunca digitada de memoria. Hash lento existe
// para proteger senha humana de baixa entropia; aqui nao muda nada, e o HMAC
// e reproduzivel sem depender de formato de bcrypt.
//
// O arquivo e LIDO COMO TEXTO, nunca executado. Uma versao anterior usava
// require dentro de buffer de saida, e isso tinha um buraco: erro de sintaxe
// em arquivo incluido e fatal e nao da para capturar, entao o buffer ficaria
// aberto e o PHP despejaria o conteudo no desligamento. O sal e o hash
// sairiam impressos na pagina, que e exatamente o vazamento que se quer
// impedir. Sem execucao, esse caminho deixa de existir.
// A extensao .php continua importando: se o arquivo for parar dentro da pasta
// publica por engano, o servidor executa e nao entrega o texto.
function lerConfiguracao($caminho) {
    if (!is_readable($caminho)) { return null; }
    $texto = @file_get_contents($caminho);
    if (!is_string($texto) || $texto === '') { return null; }
    // Comprimento exato, e exatamente uma ocorrencia de cada. Faixa larga e
    // busca em qualquer lugar deixariam um comentario ou exemplo no mesmo
    // formato capturar o valor errado, negando acesso com a configuracao certa.
    if (preg_match_all("/'sal'\\s*=>\\s*'([0-9a-f]{32})'/", $texto, $ms) !== 1)  { return null; }
    if (preg_match_all("/'hash'\\s*=>\\s*'([0-9a-f]{64})'/", $texto, $mh) !== 1) { return null; }
    return array('sal' => $ms[1][0], 'hash' => $mh[1][0]);
}

$cfg = lerConfiguracao(__DIR__ . '/../apoio-vital-config/painel-config.php');

// Sem configuracao nao ha acesso, e nao existe chave padrao de reserva.
// Corpo vazio: quem pede de fora nao distingue isto de um 404 qualquer.
if ($cfg === null) {
    http_response_code(404);
    exit;
}
$salChave  = $cfg['sal'];
$hashChave = $cfg['hash'];

// ---- 3. Este arquivo aponta para si mesmo ------------------------------
// Formulario e redirecionamento vao para o endpoint que esta executando, e nao
// para um nome fixo. Assim o mesmo codigo funciona como painel-novo.php
// durante o teste e como painel.php depois de promovido, sem alterar uma
// linha: o que for testado e exatamente o que vai para producao.
$ESTE = basename(isset($_SERVER['SCRIPT_NAME']) ? (string) $_SERVER['SCRIPT_NAME'] : '');
if ($ESTE === '' || !preg_match('/^[A-Za-z0-9._-]{1,64}$/', $ESTE)) {
    $ESTE = 'painel.php';
}
$ESTE_HTML = htmlspecialchars($ESTE, ENT_QUOTES, 'UTF-8');

// ---- 4. Sessao ---------------------------------------------------------
$seguro = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
       || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

if (PHP_VERSION_ID >= 70300) {
    session_set_cookie_params(array(
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => $seguro,
        'httponly' => true,
        'samesite' => 'Strict',
    ));
} else {
    session_set_cookie_params(0, '/', '', $seguro, true);
}
session_name('av_painel');

// Em hospedagem compartilhada a sessao falha quando a cota de disco estoura.
// Sem isto, todo o controle de acesso cairia em silencio.
if (!session_start()) {
    http_response_code(503);
    exit('Sessao indisponivel. Tente de novo em instantes.');
}

$metodo = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

// ---- 5. Sair -----------------------------------------------------------
// POST, e nao GET: um token no endereco nao resolve pre-carregamento, porque o
// mecanismo que pre-carrega o link pediria o endereco com o token junto e
// executaria a saida. Requisicao GET nao muda estado de sessao.
// Tratado ANTES do POST de entrada, para a saida nao ser lida como tentativa
// de autenticacao sem chave.
if ($metodo === 'POST' && isset($_POST['sair'])) {
    $tokenSaida = isset($_POST['av'], $_SESSION['av'])
               && hash_equals((string) $_SESSION['av'], (string) $_POST['av']);
    if ($tokenSaida) {
        $_SESSION = array();
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        session_destroy();
    }
    header('Location: ' . $ESTE);
    exit;
}

// ---- 6. Entrada --------------------------------------------------------
$erro = '';
if ($metodo === 'POST') {
    // O token vem primeiro, e quem nao tem token sai sem custo. Um atraso antes
    // de validar seguraria um processo PHP por requisicao, e em hospedagem
    // compartilhada o limite e numero de processos: viraria alavanca de queda.
    $tokenOk = isset($_POST['av'], $_SESSION['av'])
            && hash_equals((string) $_SESSION['av'], (string) $_POST['av']);

    if (!$tokenOk) {
        // Sessao morreu entre ver o formulario e enviar. Nao e erro de chave,
        // e dizer isso nao revela nada sobre a chave.
        $erro = 'A pagina ficou aberta tempo demais. Tente de novo.';
    } else {
        // Bloqueio com prazo. Um contador que so sobe prenderia a sessao para
        // sempre, e fechar a pagina nao a encerra: o cookie sobrevive. Isto nao
        // e defesa contra tentativa distribuida; a defesa e a entropia da chave.
        $agora = time();
        if (isset($_SESSION['bloqueio']) && $agora >= (int) $_SESSION['bloqueio']) {
            unset($_SESSION['bloqueio'], $_SESSION['falhas']);
        }
        $bloqueio = isset($_SESSION['bloqueio']) ? (int) $_SESSION['bloqueio'] : 0;
        if ($bloqueio > $agora) {
            http_response_code(429);
            $faltam = (int) ceil(($bloqueio - $agora) / 60);
            $erro = 'Tentativas demais. Tente de novo em ' . $faltam
                  . ($faltam === 1 ? ' minuto.' : ' minutos.');
        } else {
            // trim porque a chave vem colada do gerenciador de senhas, e ela
            // nao contem espaco: aparar nao reduz o espaco de busca.
            $enviada = isset($_POST['chave']) ? trim((string) $_POST['chave']) : '';
            $confere = $enviada !== ''
                    && hash_equals($hashChave, hash_hmac('sha256', $enviada, $salChave));
            if ($confere) {
                session_regenerate_id(true);
                $_SESSION['ok']      = true;
                $_SESSION['nascido'] = time();
                // token novo para a sessao autenticada: e ele que o link de
                // sair carrega. Apagar aqui deixaria o sair sem token.
                $_SESSION['av']      = bin2hex(random_bytes(16));
                unset($_SESSION['falhas'], $_SESSION['bloqueio']);
                header('Location: ' . $ESTE);
                exit;
            }
            $falhas = (isset($_SESSION['falhas']) ? (int) $_SESSION['falhas'] : 0) + 1;
            $_SESSION['falhas'] = $falhas;
            if ($falhas >= 5) {
                $_SESSION['bloqueio'] = $agora + 900; // quinze minutos
            }
            $erro = 'Chave invalida.';
        }
    }
}

// ---- 7. Prazo da sessao ------------------------------------------------
// Doze horas. Sem isto a sessao viveria o quanto a hospedagem deixasse.
if (!empty($_SESSION['ok'])) {
    $nascido = isset($_SESSION['nascido']) ? (int) $_SESSION['nascido'] : 0;
    if ($nascido === 0 || (time() - $nascido) > 43200) {
        $_SESSION = array();
        session_regenerate_id(true);
    }
}

// ---- 8. Sem sessao, mostra o formulario e para aqui --------------------
if (!empty($_SESSION['ok']) && empty($_SESSION['av'])) {
    $_SESSION['av'] = bin2hex(random_bytes(16));
}
if (empty($_SESSION['ok'])) {
    if (empty($_SESSION['av'])) {
        $_SESSION['av'] = bin2hex(random_bytes(16));
    }
    $token = htmlspecialchars((string) $_SESSION['av'], ENT_QUOTES, 'UTF-8');
    $aviso = $erro !== '' ? '<p class="erro">' . htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') . '</p>' : '';
    echo '<!doctype html><html lang="pt-BR"><head><meta charset="utf-8">'
       . '<meta name="viewport" content="width=device-width, initial-scale=1">'
       . '<meta name="robots" content="noindex, nofollow"><title>Medicao | Apoio Vital</title>'
       . '<style>body{margin:0;min-height:100vh;display:grid;place-items:center;background:#f4f2ed;'
       . 'color:#15232b;font:15px/1.55 -apple-system,BlinkMacSystemFont,\'Segoe UI\',sans-serif}'
       . 'form{background:#fff;border:1px solid #dcd9d4;border-radius:6px;padding:28px;width:300px}'
       . 'h1{margin:0 0 4px;font:600 17px/1.3 Georgia,serif;color:#0d2935}'
       . 'p{margin:0 0 18px;font-size:13px;color:#5c6670}'
       . 'label{display:block;font-size:12px;margin-bottom:6px;color:#5c6670}'
       . 'input{width:100%;padding:10px;border:1.5px solid #dcd9d4;border-radius:4px;font-size:15px}'
       . 'button{width:100%;margin-top:14px;padding:11px;border:0;border-radius:4px;background:#0d2935;'
       . 'color:#f4f2ed;font-size:15px;font-weight:600;cursor:pointer}'
       . '.erro{color:#8a2b1f;margin:0 0 12px;font-size:13px}</style></head><body>'
       . '<form method="post" action="' . $ESTE_HTML . '">'
       . '<h1>Medicao do site</h1><p>Uso interno da Apoio Vital.</p>'
       . $aviso
       . '<input type="hidden" name="av" value="' . $token . '">'
       . '<label for="c">Chave</label>'
       . '<input id="c" name="chave" type="password" autocomplete="current-password" autofocus required>'
       . '<button type="submit">Entrar</button>'
       . '</form></body></html>';
    exit;
}

$pasta = __DIR__ . '/../dados-apoio-vital';
$linhas = array();
foreach (glob($pasta . '/eventos-*.csv') ?: array() as $arq) {
    $fh = fopen($arq, 'r');
    if (!$fh) { continue; }
    $cab = fgetcsv($fh);
    while (($l = fgetcsv($fh)) !== false) {
        if (count($l) >= 8) { $linhas[] = $l; }
    }
    fclose($fh);
}

$dias = isset($_GET['dias']) ? max(1, min(365, (int) $_GET['dias'])) : 30;
$corte = gmdate('Y-m-d H:i:s', time() - $dias * 86400);
$linhas = array_values(array_filter($linhas, function ($l) use ($corte) {
    return $l[0] >= $corte;
}));

function contar($linhas, $i, $filtroEvento = null) {
    $c = array();
    foreach ($linhas as $l) {
        if ($filtroEvento !== null && $l[1] !== $filtroEvento) { continue; }
        $k = $l[$i] !== '' ? $l[$i] : '(vazio)';
        $c[$k] = isset($c[$k]) ? $c[$k] + 1 : 1;
    }
    arsort($c);
    return $c;
}

function tabela($titulo, $dados, $rotulo) {
    echo '<section><h2>' . htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8') . '</h2>';
    if (!$dados) { echo '<p class="vazio">Nada registrado ainda.</p></section>'; return; }
    $total = array_sum($dados);
    echo '<table><thead><tr><th>' . htmlspecialchars($rotulo, ENT_QUOTES, 'UTF-8')
       . '</th><th>Quantidade</th><th>Participacao</th></tr></thead><tbody>';
    foreach ($dados as $k => $v) {
        $pct = $total ? round($v * 100 / $total) : 0;
        echo '<tr><td>' . htmlspecialchars((string) $k, ENT_QUOTES, 'UTF-8') . '</td>'
           . '<td class="n">' . (int) $v . '</td>'
           . '<td class="n"><span class="barra" style="width:' . (int) $pct . '%"></span>' . $pct . '%</td></tr>';
    }
    echo '</tbody></table></section>';
}

$whats = array_values(array_filter($linhas, function ($l) { return $l[1] === 'clique_whatsapp'; }));
?><!doctype html>
<html lang="pt-BR"><head><meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Medicao | Apoio Vital</title>
<style>
 :root{--petroleo:#0d2935;--menta:#2e6059;--creme:#f4f2ed;--cru:#dcd9d4;--grafite:#15232b}
 *{box-sizing:border-box}
 body{margin:0;background:var(--creme);color:var(--grafite);
      font:15px/1.55 -apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif}
 header{background:var(--petroleo);color:var(--creme);padding:22px 28px}
 header h1{margin:0;font:600 19px/1.3 Georgia,serif}
 header p{margin:5px 0 0;color:#8fc5bc;font-size:13px}
 main{max-width:960px;margin:0 auto;padding:26px 28px 70px}
 section{margin-bottom:34px}
 h2{font:600 15px/1.3 Georgia,serif;margin:0 0 12px;padding-bottom:8px;border-bottom:1px solid var(--cru)}
 table{width:100%;border-collapse:collapse;font-size:14px}
 th{text-align:left;font:600 11px/1 -apple-system;letter-spacing:.09em;text-transform:uppercase;
    color:#5c6670;padding:8px 10px;border-bottom:1px solid var(--cru)}
 td{padding:9px 10px;border-bottom:1px solid #e8e5e0}
 td.n{text-align:right;white-space:nowrap}
 .barra{display:inline-block;height:7px;background:var(--menta);opacity:.35;margin-right:8px;
        vertical-align:middle;border-radius:2px;min-width:2px}
 .resumo{display:flex;gap:28px;flex-wrap:wrap;margin-bottom:30px}
 .cartao{background:#fff;border:1px solid var(--cru);border-radius:4px;padding:16px 20px;min-width:150px}
 .cartao b{display:block;font:600 26px/1.1 Georgia,serif;color:var(--petroleo)}
 .cartao span{font-size:12px;color:#5c6670}
 .vazio{color:#5c6670;font-size:14px}
 nav a{color:var(--menta);font-size:13px;margin-right:14px}
 nav{display:flex;align-items:center}
 /* Sair e POST, nao link: GET nao deve mudar estado de sessao, e um
    mecanismo de pre-carregamento pediria o endereco e derrubaria a sessao. */
 .sair{display:inline;margin:0}
 .sair button{background:none;border:0;padding:0;color:var(--menta);font-size:13px;
              font-family:inherit;cursor:pointer;text-decoration:underline}
</style></head><body>
<header>
  <h1>Medicao do site</h1>
  <p>Ultimos <?php echo (int) $dias; ?> dias &middot; <?php echo count($linhas); ?> eventos &middot; sem cookie de visitante, sem terceiro</p>
</header>
<main>
  <nav>
    <a href="?dias=7">7 dias</a>
    <a href="?dias=30">30 dias</a>
    <a href="?dias=90">90 dias</a>
    <a href="?dias=365">1 ano</a>
    <form method="post" action="<?php echo $ESTE_HTML; ?>" class="sair">
      <input type="hidden" name="av" value="<?php echo htmlspecialchars((string) $_SESSION['av'], ENT_QUOTES, 'UTF-8'); ?>">
      <button type="submit" name="sair" value="1">Sair</button>
    </form>
  </nav>
  <div class="resumo">
    <div class="cartao"><b><?php echo count($whats); ?></b><span>cliques no WhatsApp</span></div>
    <div class="cartao"><b><?php
      echo count(array_filter($linhas, function ($l) { return $l[1] === 'clique_telefone'; })); ?></b><span>cliques para ligar</span></div>
    <div class="cartao"><b><?php
      echo count(array_filter($linhas, function ($l) { return $l[1] === 'envio_formulario'; })); ?></b><span>formularios enviados</span></div>
  </div>
<?php
tabela('De qual pagina veio o clique no WhatsApp', contar($whats, 2), 'Pagina');
tabela('De qual botao veio o clique no WhatsApp',  contar($whats, 3), 'Codigo do botao');
tabela('Em que posicao da pagina estava o botao',  contar($whats, 4), 'Posicao');
tabela('Perguntas mais abertas no FAQ',            contar($linhas, 5, 'abriu_faq'), 'Pergunta');
tabela('Todos os eventos',                         contar($linhas, 1), 'Evento');
tabela('De onde a pessoa veio',                    contar($linhas, 7), 'Origem');
?>
</main></body></html>
