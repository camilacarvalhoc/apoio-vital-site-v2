<?php
/* =========================================================================
   APOIO VITAL - painel.php
   Leitura dos dados de medicao. Somente leitura, nao grava nada.

   COMO ABRIR: https://apoiovital.com/painel.php?chave=SUA_CHAVE

   TROQUE A CHAVE ABAIXO antes de publicar. Use algo longo e sem sentido.
   Nao e cofre: os dados aqui nao identificam ninguem. A chave serve para
   nao deixar a pagina aberta a qualquer um que digite o endereco.
   ========================================================================= */

const CHAVE = 'troque-esta-chave-por-uma-longa-e-aleatoria';

if (!isset($_GET['chave']) || !hash_equals(CHAVE, (string) $_GET['chave'])) {
    http_response_code(404);
    exit('Nao encontrado');
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
</style></head><body>
<header>
  <h1>Medicao do site</h1>
  <p>Ultimos <?php echo (int) $dias; ?> dias &middot; <?php echo count($linhas); ?> eventos &middot; sem cookie, sem terceiro</p>
</header>
<main>
  <nav>
    <a href="?chave=<?php echo urlencode(CHAVE); ?>&amp;dias=7">7 dias</a>
    <a href="?chave=<?php echo urlencode(CHAVE); ?>&amp;dias=30">30 dias</a>
    <a href="?chave=<?php echo urlencode(CHAVE); ?>&amp;dias=90">90 dias</a>
    <a href="?chave=<?php echo urlencode(CHAVE); ?>&amp;dias=365">1 ano</a>
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
