# Assinatura horizontal

Como a assinatura horizontal da Apoio Vital foi composta, com que material, e
quais medidas estao travadas. A variante 1 ja esta aplicada no repositorio, nas 22
paginas publicas e nos dois moldes. Ainda nao foi publicada.

## De onde vem cada parte

| parte | origem | redesenhada? |
|---|---|---|
| simbolo | `apoio-vital-simbolo-m.svg`, o vetor ja fechado e aprovado | nao, usado inteiro |
| APOIO VITAL | contornos do logotipo existente, extraidos de `apoio-vital-principal.svg` | nao, apenas reposicionados numa linha so |
| HOME CARE | composto em Figtree 400 | sim, por falta de alternativa |

O descritor e a unica parte composta em tipo. As letras H, M, C, R e E nunca
existiram como vetor aprovado: o logotipo so tem A, P, O, I, V, T e L. Como a
Figtree ja e a fonte de titulo do site, o descritor passa a pertencer a
tipografia do proprio site em vez de imitar um desenho.

## Por que o letreiro nao foi copiado da prancha

A prancha final e imagem gerada, e o letreiro dela nao tem metrica de fonte. Medido
coluna a coluna, o primeiro O de APOIO tem 102,6 unidades de largura e o segundo
tem 105,1, com a mesma altura de maiuscula. Dois exemplares da mesma letra, na
mesma palavra, com larguras diferentes. Copiar isso seria perseguir um desenho,
nao reproduzir uma marca.

Os contornos do logotipo existente sao consistentes, ja estao aprovados e estao no
mesmo registro visual: sans geometrico leve. A Figtree 700, que seria a alternativa
obvia por ser a fonte do site, e bem mais pesada e nao serve para o nome.

## Medidas, em unidades de altura de maiuscula de APOIO VITAL

Quatro vem da prancha da socia, medidas em pixel. A quinta foi definida pelo ChatGPT,
que desenhou o simbolo.

| medida | valor | origem |
|---|---|---|
| altura de maiuscula de APOIO VITAL | 1,00 | referencia |
| altura do simbolo | 1,82 | ancora B: igual a altura do bloco de texto |
| vao entre simbolo e letreiro | 0,50 | ChatGPT, medido entre caixas de tinta |
| altura de HOME CARE | 0,41 | prancha |
| vao entre nome e descritor | 0,41 | prancha |
| entreletra de APOIO VITAL | 0,15 | calibrada para bater a razao 9,0 da prancha |
| espaco entre APOIO e VITAL | 0,50 | prancha, medido em 0,487 |
| largura de HOME CARE | 12,4 x a propria maiuscula | prancha |

HOME CARE fica centralizado no nome, como na prancha, onde os dois centros caem em
235 e 236 pixels.

A ancora B foi escolhida porque a ancora A, que mantinha o simbolo em 2,95 maiusculas,
fazia o simbolo mandar na altura e derrubava HOME CARE para 4,2 px de altura de
maiuscula no celular.

Proporcao final do conjunto: **7,576:1**, caixa de tinta de 1394,13 por 184,30 unidades.

O viewBox e a caixa de TINTA, nao a caixa de desenho. O bloco tipografico mede 182
unidades de linha de maiuscula a linha de base, mas as maiusculas redondas transbordam
as duas linhas, que e como toda tipografia funciona: o O sobe 1,6 acima da linha de
maiuscula e o descritor desce 0,7 abaixo da base. A primeira versao deste arquivo
fechava o viewBox em 182 e o recorte do proprio SVG decepava o apice do A e o topo dos
O. Medido no raster a 1400 px de largura: 294 pixels de tinta encostavam na borda
superior, cortados retos. Com a caixa de tinta correta sao 49, que e o contato normal
de tangente.

## Tamanhos reais no site

O gargalo da horizontal e a largura, nao a altura.

| aplicacao | caixa | o que limita |
|---|---|---|
| cabecalho desktop | arte de 270 x 35,6 px | a largura; sobram 8 px de altura |
| cabecalho celular de 390 px | arte de 227 x 30 px | a altura |
| cabecalho celular de 320 px | arte de 198 x 26,2 px | a largura, 62vw |
| rodape | arte de 300 x 39,6 px | a largura |

Altura de maiuscula de HOME CARE em cada caso: 7,9 px no desktop, 6,7 px no celular de
390, **5,8 px no celular de 320** e 8,8 px no rodape. O caso de 320 px e o pior e nao
foi testado com a socia antes da escolha.

## Cor

No fundo claro o descritor usa a terracota escura `#854930`, 6,16:1 sobre a perola.

No fundo escuro ele **nao** pode usar a terracota da prancha: `#C47A5A` sobre
`#1B4B57` da 2,87:1, reprovado para texto em qualquer tamanho. No escuro o descritor
usa o verde-agua claro `#8FC5BC`, 4,97:1. Ver `MARCA-contraste.md`.

## Arquivos

| arquivo | uso |
|---|---|
| `apoio-vital-assinatura-h.svg` | fundo claro, com descritor |
| `apoio-vital-assinatura-h-negativo.svg` | fundo escuro, com descritor |
| `apoio-vital-assinatura-h-nome.svg` | fundo claro, so o nome |
| `apoio-vital-assinatura-h-nome-negativo.svg` | fundo escuro, so o nome |

As duas variantes tem a mesma altura total e o simbolo do mesmo tamanho, de proposito:
e o que torna a comparacao entre elas honesta.

## Como reproduzir

```
python3 -m venv venv && venv/bin/pip install fonttools
curl -A "Mozilla/4.0" "https://fonts.googleapis.com/css2?family=Figtree:wght@400" \
  | grep -o "https://[^)]*\.ttf" | xargs curl -o fonte/figtree-400.ttf
venv/bin/python docs/vetorizacao/assinatura.py
```

`extrai.py` refaz `letras.json` a partir de `apoio-vital-principal.svg`.
A Figtree e licenciada sob a SIL Open Font License e nao esta versionada aqui.

## Decisao

Em 17/10/2026 a socia escolheu a **variante 1, com HOME CARE**, depois de ver as duas
no cabecalho real em tamanho real.

Aplicada nas 22 paginas publicas e nos dois moldes, em tres lugares por pagina:
cabecalho, topo do menu de celular e rodape. Quatro linhas por pagina, 97 no total.
O CSS nao foi tocado.

Os nomes de arquivo sao novos de proposito. O `.htaccess` manda `max-age=31536000,
immutable` para svg e png, e so css e js carregam `?v=` com hash. Se a arte nova
reaproveitasse o nome antigo, quem ja visitou o site continuaria vendo a marca velha
por um ano.

Tamanho resultante da arte: 270 x 35,6 px no cabecalho desktop, 227 x 30 no celular
de 390 px e 300 x 39,6 no rodape.

Conferido depois de aplicar: as 22 paginas carregam a assinatura nos tres lugares em
1400 px e em 390 px, sem rolagem horizontal; zero reprovacao de contraste de texto;
473 paradas de Tab sem anel de foco reprovado; e tudo continua funcionando com o
JavaScript desligado.

Uma revisao independente por cinco angulos, rodada depois disso, achou tres defeitos
nesta mudanca, todos corrigidos: o viewBox que cortava a arte, o campo `height` do
JSON-LD que ficou com a altura do PNG antigo (335 em vez de 264) e o `alt` do menu de
celular que continuava dizendo so "Apoio Vital" para uma arte que mostra HOME CARE.

## O resto da marca antiga, tambem trocado

Depois da assinatura, a socia pediu para fechar tudo o que ainda mostrava o simbolo
anterior. Nada disso foi desenhado: tudo sai do simbolo vetorizado aprovado.

| onde | o que era | o que e agora |
|---|---|---|
| `favicon.svg`, `favicon-16/32.png`, `favicon.ico` | circulo com a linha de ECG | circulo petroleo `#1F5D6B` com o simbolo reduzido a 80% do lado |
| `apple-touch-icon.png` | circulo com transparencia | quadrado cheio de 180 px, que e o que o iOS espera |
| `og-apoio-vital.png` | simbolo antigo e nome empilhado | assinatura negativa, mesmo texto de antes |
| `.lista-ecg li::before` | tracado antigo embutido no CSS | simbolo reduzido, referenciado do arquivo |
| `.foto--vazia::before` | o mesmo tracado | o mesmo simbolo, a 30% |
| `.artefato__marca` na home | SVG do tracado antigo escrito no HTML | `<img>` do simbolo mono reduzido |

O 80% foi escolhido olhando: a 72% o simbolo fica pequeno dentro do circulo e a 88%
encosta na borda.

As duas mascaras do CSS **referenciam o arquivo** em vez de embutir o caminho. Embutido
seriam 25 KB a mais num CSS de 68 KB, por causa de dois ornamentos; o arquivo tem 6 KB,
e carregado uma vez e tem cache de um ano.

Como esses arquivos mantiveram o nome, o cache de um ano foi furado por `?v=` com hash
de conteudo, a mesma convencao que o projeto ja usava em `style.css` e `main.js`.

Com isso o tracado antigo nao existe mais em nada que o servidor entrega: zero
ocorrencias em HTML, CSS e JS.
