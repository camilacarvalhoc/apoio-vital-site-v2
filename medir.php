<?php
/* =========================================================================
   APOIO VITAL - medir.php
   Medicao propria, na propria hospedagem.

   O que NAO e gravado, de proposito:
     - nenhum cookie
     - nenhum identificador de pessoa
     - nenhum endereco de IP
     - nada que o visitante escreveu

   O que e gravado: data e hora, tipo do evento, pagina, codigo do botao,
   posicao do botao, largura da tela e o dominio de onde a pessoa veio.
   Nada disso identifica ninguem, e e por isso que o site nao precisa de
   aviso de cookies. A politica de privacidade so promete o aviso para
   ferramenta que depende de cookie nao essencial.

   O arquivo de dados fica FORA de public_html, entao nao e acessivel
   pela internet.
   ========================================================================= */

header('Content-Type: text/plain; charset=utf-8');
header('X-Content-Type-Options: nosniff');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$bruto = file_get_contents('php://input', false, null, 0, 4096);
$dados = json_decode($bruto, true);
if (!is_array($dados)) {
    http_response_code(204);
    exit;
}

/* So estes eventos entram. Qualquer outro e descartado em silencio. */
$EVENTOS = array(
    'clique_whatsapp', 'clique_telefone', 'clique_email', 'baixou_arquivo',
    'envio_formulario', 'abriu_faq', 'scroll_50', 'scroll_75', 'scroll_90',
    'tempo_na_pagina'
);

function limpar($v, $max) {
    $v = is_scalar($v) ? (string) $v : '';
    $v = preg_replace('/[^\p{L}\p{N} ._\/-]/u', '', $v);
    $v = trim(preg_replace('/\s+/u', ' ', $v));
    // mbstring existe em praticamente todo servidor, mas se faltar o corte
    // por bytes resolve, com cuidado para nao partir caractere acentuado.
    if (function_exists('mb_substr')) {
        return mb_substr($v, 0, $max, 'UTF-8');
    }
    $v = substr($v, 0, $max * 2);
    return preg_replace('/[\x80-\xBF]*$/', '', $v);
}

$evento = limpar(isset($dados['evento']) ? $dados['evento'] : '', 24);
if (!in_array($evento, $EVENTOS, true)) {
    http_response_code(204);
    exit;
}

$linha = array(
    gmdate('Y-m-d H:i:s'),                                              // UTC
    $evento,
    limpar(isset($dados['pagina'])   ? $dados['pagina']   : '', 80),
    limpar(isset($dados['codigo'])   ? $dados['codigo']   : '', 20),
    limpar(isset($dados['posicao'])  ? $dados['posicao']  : '', 20),
    limpar(isset($dados['extra'])    ? $dados['extra']    : '', 40),
    (int) (isset($dados['largura']) ? $dados['largura'] : 0),
    limpar(isset($dados['vindo_de']) ? $dados['vindo_de'] : '', 60),
);

$pasta = __DIR__ . '/../dados-apoio-vital';
if (!is_dir($pasta)) {
    @mkdir($pasta, 0750, true);
}
$arquivo = $pasta . '/eventos-' . gmdate('Y-m') . '.csv';

$novo = !file_exists($arquivo);
$fh = @fopen($arquivo, 'a');
if ($fh) {
    if (flock($fh, LOCK_EX)) {
        if ($novo) {
            fputcsv($fh, array('data_utc','evento','pagina','codigo','posicao','extra','largura','vindo_de'));
        }
        fputcsv($fh, $linha);
        flock($fh, LOCK_UN);
    }
    fclose($fh);
}

http_response_code(204);
