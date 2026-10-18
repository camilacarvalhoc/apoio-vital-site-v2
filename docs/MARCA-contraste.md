# Apoio Vital — matriz de contraste

Gerado por cálculo, não digitado. Fórmula da WCAG 2.1 (luminância relativa).
Mínimos: **4,5:1** texto corrido, **3:1** título grande e componente gráfico, **7:1** nível AAA.

## A paleta

| Cor | HEX | Função |
|---|---|---|
| Pérola | `#F3F0E8` | fundo principal |
| Petróleo escuro | `#1B4B57` | fundo de seção escura, cabeçalho |
| Petróleo | `#1F5D6B` | marca, títulos sobre fundo claro |
| Verde-água | `#65B8A5` | acento gráfico — **nunca texto no claro** |
| Verde-água claro | `#8FC5BC` | fundo suave, texto sobre fundo escuro |
| Terracota | `#C47A5A` | acento gráfico — **nunca texto** |
| Terracota escura | `#854930` | botão e link sobre fundo claro |
| Verde escuro | `#337062` | texto verde sobre fundo claro |
| Cinza do corpo | `#33383D` | texto corrido |
| Branco | `#FFFFFF` | superfície de cartão, texto sobre escuro |

## Matriz completa

Linha = cor do texto. Coluna = cor do fundo.

| texto \ fundo | Pérola | Petróleo escuro | Petróleo | Verde-água | Verde-água claro | Terracota | Terracota escura | Verde escuro | Cinza do corpo | Branco |
|---|---|---|---|---|---|---|---|---|---|---|
| Pérola | — | **8,42** | **6,50** | _2,06_ | _1,69_ | _2,94_ | **6,16** | **5,07** | **10,40** | _1,14_ |
| Petróleo escuro | **8,42** | — | _1,29_ | 4,09 | **4,97** | _2,87_ | _1,37_ | _1,66_ | _1,23_ | **9,59** |
| Petróleo | **6,50** | _1,29_ | — | 3,16 | 3,84 | _2,21_ | _1,06_ | _1,28_ | _1,60_ | **7,40** |
| Verde-água | _2,06_ | 4,09 | 3,16 | — | _1,22_ | _1,43_ | _2,99_ | _2,46_ | **5,05** | _2,35_ |
| Verde-água claro | _1,69_ | **4,97** | 3,84 | _1,22_ | — | _1,73_ | 3,64 | _2,99_ | **6,13** | _1,93_ |
| Terracota | _2,94_ | _2,87_ | _2,21_ | _1,43_ | _1,73_ | — | _2,10_ | _1,73_ | 3,54 | 3,34 |
| Terracota escura | **6,16** | _1,37_ | _1,06_ | _2,99_ | 3,64 | _2,10_ | — | _1,21_ | _1,69_ | **7,02** |
| Verde escuro | **5,07** | _1,66_ | _1,28_ | _2,46_ | _2,99_ | _1,73_ | _1,21_ | — | _2,05_ | **5,78** |
| Cinza do corpo | **10,40** | _1,23_ | _1,60_ | **5,05** | **6,13** | 3,54 | _1,69_ | _2,05_ | — | **11,84** |
| Branco | _1,14_ | **9,59** | **7,40** | _2,35_ | _1,93_ | 3,34 | **7,02** | **5,78** | **11,84** | — |

**negrito** = serve para texto corrido · normal = só título grande · _itálico_ = não serve para letra

## Combinações autorizadas

| Uso | Texto | Fundo | Contraste | Nível |
|---|---|---|---|---|
| Texto corrido | `#33383D` | `#F3F0E8` | 10,40:1 | AAA |
| Texto corrido no cartão | `#33383D` | `#FFFFFF` | 11,84:1 | AAA |
| Título | `#1B4B57` | `#F3F0E8` | 8,42:1 | AAA |
| Título no cartão | `#1B4B57` | `#FFFFFF` | 9,59:1 | AAA |
| Texto secundário verde | `#337062` | `#F3F0E8` | 5,07:1 | AA |
| Link e botão (fundo claro) | `#854930` | `#F3F0E8` | 6,16:1 | AA |
| Rótulo de botão | `#FFFFFF` | `#854930` | 7,02:1 | AAA |
| Texto sobre seção escura | `#F3F0E8` | `#1B4B57` | 8,42:1 | AAA |
| Destaque sobre seção escura | `#8FC5BC` | `#1B4B57` | 4,97:1 | AA |
| Texto sobre fundo verde-água claro | `#1B4B57` | `#8FC5BC` | 4,97:1 | AA |
| Corpo sobre fundo verde-água claro | `#33383D` | `#8FC5BC` | 6,13:1 | AA |

## Proibições

| Combinação | Contraste | Por quê |
|---|---|---|
| Terracota `#C47A5A` como texto na pérola | 2,94:1 | abaixo de 3:1, não serve nem para título |
| Terracota `#C47A5A` como texto no escuro | 2,87:1 | abaixo de 3:1 |
| Verde-água `#65B8A5` como texto na pérola | 2,06:1 | some para a visão reduzida |
| Verde-água claro `#8FC5BC` como texto na pérola | 1,69:1 | some para a visão reduzida |
| Botão terracota escura dentro de seção escura | 1,37:1 | o botão não se separa do fundo (mín. 3:1 pela WCAG 1.4.11). Lá o botão é claro. |

## Os dois petróleos

`#1B4B57` contra `#1F5D6B` dá **1,29:1**. O olho não separa os dois.
Não são duas cores concorrentes: são duas **superfícies**. Um é fundo de seção escura,
o outro é a cor da marca e dos títulos sobre fundo claro. Nunca usar um sobre o outro.

## Bronze

Fora da paleta digital. Metálico não existe em RGB nem em CMYK — o brilho vem da tinta,
do hot stamping ou do relevo. Permanece como **acabamento físico opcional** em placa e papelaria.


## Cor do descritor HOME CARE na assinatura

O descritor **muda de cor conforme o fundo**, e isso é regra, não exceção.

| Fundo | APOIO VITAL e símbolo | HOME CARE | Contraste do descritor |
|---|---|---|---|
| Pérola `#F3F0E8` | cores institucionais | Terracota escura `#854930` | 6,16:1 |
| Petróleo escuro `#1B4B57` | versão negativa | Verde-água claro `#8FC5BC` | 4,97:1 |

A terracota da prancha, `#C47A5A`, **não** pode fazer o descritor no fundo escuro:
dá 2,87:1, e o descritor chega a 6,8 px de altura de maiúscula no celular.
Regra acordada com o ChatGPT, que desenhou o símbolo, em 17/10/2026.
Ver `MARCA-assinatura.md`.
