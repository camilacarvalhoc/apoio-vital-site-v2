# Apoio Vital — vetorizacao do simbolo

Como a matriz vetorial foi obtida, com os numeros. Executado em 17/10/2026.

## Por que tracar em vez de gerar

O simbolo existia so como imagem gerada, e cada geracao produz um desenho
diferente. Medido: a prancha do manual tem proporcao 2,437; a imagem isolada
gerada depois tem 2,51, com o batimento em outra posicao; e a prancha terracota,
que a olho nu parece a mesma coisa, tem **IoU de apenas 76%** contra a do manual.

Tres pranchas, tres desenhos. Nenhuma instrucao textual corrige isso, porque o
problema nao e de precisao do pedido. **Tracar e medir, nao redesenhar** — e a
unica operacao que preserva a geometria aprovada.

Limite do metodo, dito com clareza: tracar preserva a geometria *observavel nos
pixels*, nao a que existia antes da rasterizacao. Essa nao existe mais.

## Fonte

Simbolo do logo principal da **prancha do manual de identidade**, recortado em
x 93-421, y 76-210 — 329 x 135 px. Escolhida por ser a unica versao aplicada em
todo o sistema: recepcao, uniforme, cartao, garrafa, carro, tela do site e as
cinco versoes de uso da propria prancha.

O arquivo e **JPEG**, apesar da extensao .png. Isso importa: o ringing de
compressao serrilha as diagonais de alto contraste, e foi preciso tratar.

Copia da referencia: `referencia-aprovada.png`.

## Metodo

1. **Separacao por matiz.** Fria 150-230 graus, quente 330-45 graus, com corte
   de luminosidade acima de 0,88 e saturacao abaixo de 0,20. Indefinidos: **0,1%**.
2. **Isolamento do batimento.** Erosao de 3 px mata o fio e preserva a fita;
   o maior componente do residuo e o batimento. Resultado: 666 px numa caixa de
   37 x 64, em x 208-244, y 71-134 do recorte.
3. **Filtro de mediana** de raio 1 nas duas fitas, para tirar a serrilha do JPEG
   sem arredondar reta. Nao aplicado ao batimento, que e fino demais.
4. **Contorno por seguimento de arestas de pixel**, deterministico. Conferencia:
   a area dos lacos bate com a contagem da mascara (6840 contra 6847 na fita fria).
5. **Alisamento da polilinha**, 7 passes de media movel periodica.
6. **Douglas-Peucker** com tolerancia 0,25.
7. **Catmull-Rom** com tensao 0,33, convertido em cubicas de Bezier.

## Fidelidade

Vetor renderizado em 329 x 135 e comparado ao original com a mesma regra de cor
nos dois lados.

| medida | resultado |
|---|---|
| IoU de silhueta | **97,71%** |
| distancia media entre bordas | **0,21 px** (0,063% da largura) |
| percentil 95 | **1,00 px** (0,304%) |
| desvio maximo | **1,41 px** (0,430%) |
| proporcao do original | 2,437 |
| proporcao do vetor | 2,418 (diferenca de **0,78%**) |
| topologia | tres formas, mesmo cruzamento, batimento na mesma posicao |

**Nota sobre o IoU.** A configuracao sem alisamento dava **99,82%** e foi
descartada: o contorno seguia a escada de pixel e o resultado era visivelmente
serrilhado. Pontuacao global alta nao prova fidelidade — esconde divergencia
local. O criterio foi inspecao ampliada mais as metricas, nao a metrica sozinha.

## O que foi redesenhado

**Nada.** Nem o batimento. Ele foi tracado como as fitas, sem filtro de mediana,
e manteve posicao e proporcao. A reconstrucao manual prevista no plano nao foi
necessaria.

## Assimetria entre as metades

Medida anterior dizia que a metade esquerda pesava 2,04 vezes mais que a direita.
**Essa medida estava errada de proposito errado**: era contraste medio contra o
fundo, ou seja, peso *tonal*.

Por area de tinta, na versao A: fita fria **6.847 px**, fita quente **6.640 px**.
Razao de **1,031**. Nao ha desequilibrio geometrico; o que o olho percebe vem de
o petroleo ser mais escuro que a terracota.

Nenhum ajuste foi aplicado. Fica como hipotese separada.

## Arquivos gerados

| arquivo | uso |
|---|---|
| `apoio-vital-simbolo-m.svg` | matriz, duas cores chapadas |
| `apoio-vital-simbolo-m-reduzido.svg` | sem batimento, para abaixo de 32 px |
| `apoio-vital-simbolo-m-mono.svg` | uma tinta, #1B4B57 |
| `apoio-vital-simbolo-m-mono-reduzido.svg` | uma tinta sem batimento |
| `apoio-vital-simbolo-m-negativo.svg` | perola, para fundo escuro |

Todos com viewBox 0 0 329 135, caminhos fechados, `fill-rule="evenodd"`,
**sem degrade**. O degrade continua valido em material de apresentacao, onde o
meio o suporta; a matriz chapada e a referencia de reproducao.

## Como refazer

Os scripts estao nesta pasta. `mascaras.json` guarda as tres mascaras extraidas.

    cd docs/vetorizacao && python3 familia.py

Parametros no alto de `familia.py`: MED=1, PASSES=7, EPS=0,25, TEN=0,33.
