# Decisões e seus motivos

Cada entrada registra o que foi decidido, por quê, e o que foi descartado. A intenção é que
ninguém precise refazer a discussão — nem reverter por engano algo que custou a ser acertado.

---

## O site existente é a base; a copy nova foi descartada

**Contexto.** Depois que o site já estava pronto, foi proposta uma reescrita completa do texto —
uma copy de página inicial com hero, barra de indicadores, portfólio de soluções e FAQ novo.

**Decisão: não usar.** Ela foi submetida a uma análise em quatro frentes (publicidade médica,
sanitário, consumidor/LGPD e qualidade editorial), com cada norma citada conferida na fonte
oficial por um segundo revisor. Dos 31 achados que sobreviveram à checagem, **16 recomendavam
literalmente manter o texto que já estava no ar**.

**Por quê.** A copy proposta regredia em quase tudo que tocava: trocava compromissos
verificáveis por adjetivos, substituía a fundadora com nome e história por "nasceu com o
propósito de transformar", e introduzia três afirmações juridicamente problemáticas — "a melhor
assistência médica e hospitalar", conformidade com a RDC que ainda não existe, e cobertura por
plano de saúde quando o modelo real é reembolso.

Detalhe em `docs/05-copy-e-conteudo.md`.

---

## O selo da Resolução CFM foi desativado

**Antes:** o selo dizia "Razão social, CNPJ, endereço da sede e responsável técnico
identificados de forma clara no rodapé deste site."

**Agora:** título "Identificação da empresa", texto sem a menção ao responsável técnico.

**Por quê.** Os três primeiros dados estão no rodapé. O responsável técnico não existe. A frase
era falsa exatamente no ponto que a norma exige, e afirmar conformidade inexistente é
publicidade enganosa.

Há um comentário no HTML marcando como restaurar quando o RT for contratado. **Restaurar antes
disso é regressão, não melhoria.**

No FAQ, pela mesma razão, "sob supervisão do responsável técnico" virou "sob supervisão de
enfermeiro, como exige a profissão": descreve a regra da categoria, verdadeira
independentemente da estrutura da empresa.

---

## Domínio: `apoiovital.com`, sem `www`

**Descartado:** `apoiovital.com.br` — está registrado por terceiro desde 11/11/2022, com
vigência até 2027. Não há janela de liberação.

**Descartados também:** `apoiovitalhomecare.com.br` e `apoiovitalcuidados.com.br`, por serem
longos e redundantes ("apoio" já comunica "cuidados").

**Consequência conhecida e aceita:** quem digitar `.com.br` por reflexo vai para o endereço de
outra pessoa. Registrar `apoiovitalrj.com.br` como redirecionamento cobriria parte dessa fuga.

---

## Publicação por Git, não por FTP

**Descartado:** o método de um vídeo popular, que ensina a gravar usuário, senha do painel e IP
num arquivo `.env` dentro da pasta do projeto — que, neste caso, é um repositório Git.

**Decisão:** integração de Git nativa do hPanel, que conecta por autorização do GitHub e **não
cria credencial nenhuma**. Credencial que não existe não vaza.

**Também descartado:** SSH/rsync. Funciona, mas não traz ganho para dez arquivos estáticos e
tem o pior raio de alcance se a chave vazar — senha de FTP dá acesso a uma pasta, chave SSH dá
shell na conta inteira.

---

## Sem CDN, sem compressão manual, sem WordPress

**CDN:** o site inteiro tem 141 KB. CDN não resolve nada aqui; não vale subir de plano.

**Compressão no `.htaccess`:** medida — 141 KB viram 36 KB, 74% de redução, mas em valor
absoluto são 105 KB, algo entre 0,1 e 0,3 segundo no 4G. A Hostinger provavelmente já comprime.
Fica de fora de propósito.

**WordPress:** seria regressão. Traria banco de dados, plugins, atualizações de segurança e
superfície de ataque para servir uma página que são três arquivos.

---

## Animação discreta, não cinematográfica

**Descartado:** o estilo de animação por rolagem que monta um hambúrguer camada por camada ou
despeja café numa xícara.

**Por quê.** Aquilo serve a quem está passeando. O visitante deste site recebeu uma alta
hospitalar difícil, está no celular, com pressa, e quer achar o telefone e decidir se confia.
Animação pesada atrasa o carregamento e compete com o conteúdo.

**O que ficou:** os blocos aparecem suavemente ao entrar na tela, e o menu destaca a seção
atual. Discreto, rápido, com três salvaguardas: a classe só é aplicada depois que o
`IntersectionObserver` existe (se falhar, nada é escondido), é removida ao fim da transição
(senão o `transform: none` anularia o hover dos cards), e nada roda com `prefers-reduced-motion`.

---

## Identidade visual preservada

Na primeira interação foi gerado um site do zero, com paleta azul genérica e símbolo
provisório, sem saber que já existia um site na `main` com a paleta oficial da marca
(petróleo `#1b4b57`, verde água `#8fc5bc`, pérola `#f0ede6`), tipografia Figtree e os logos
SVG oficiais.

**Essa versão foi descartada inteira.** A paleta e os logos vieram de um manual de marca e
foram aplicados deliberadamente. Não substituir por cor genérica.

---

## Imagem de prévia social gerada da marca, não por IA

O canal principal de contato é WhatsApp, e cada link compartilhado aparecia sem imagem. Foi
gerada uma prévia 1200×630 a partir do logo oficial e da chamada do site.

**Para fotos de equipe, paciente ou instalação, a regra é foto real.** Ver `CLAUDE.md`.

---

## Correções que vieram de teste, não de leitura

Três defeitos passaram pela revisão de código e só apareceram no navegador. Registrados porque
mostram onde este projeto quebra:

1. **`rootMargin` não aceita `rem`.** Lançava exceção e deixava todos os blocos escondidos.
2. **Impressão em branco.** `opacity: 0` fora de media query, e o observador não roda na
   impressão: quem imprimisse sem rolar recebia páginas vazias. E restaurar só a opacidade não
   bastava — a transição de 0,6s fazia o navegador capturar o bloco a meio caminho.
3. **`Ctrl+Home` e `Ctrl+End` sequestrados** pelo FAQ, que testava só `evento.key`.

**Lição:** validar com navegador de verdade, não só com leitura do diff.
