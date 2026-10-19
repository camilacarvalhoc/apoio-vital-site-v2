# Auditoria de conteudo de 19/10/2026: o que saiu e o que ficou

A socia pediu, antes de dormir, que o site inteiro fosse reavaliado texto por
texto. Isto e o registro do que foi feito e, principalmente, **do que continua
aberto**, que e a parte util para quem ler depois.

## Como foi medido

Cinco frentes em paralelo sobre as 24 paginas, cada achado obrigado a citar o
trecho literal e a linha. Cada achado passou depois por uma verificacao
instruida a **derruba-lo**: abrir o arquivo, conferir se o trecho existe mesmo,
ler o paragrafo e a secao inteira, e so confirmar se nada no contexto ja
qualificasse a frase.

| | |
|---|---|
| agentes | 125 |
| achados brutos | 198 |
| confirmados com trecho conferido | 113 |
| unicos, tirando o que duas frentes viram duas vezes | 91 |
| **correcoes aplicadas** | **73, em 17 arquivos** |

## O criterio, que explica o que entrou e o que nao entrou

Foi aplicado **so o que RETIRA afirmacao que a operacao nao sustenta**. Nada
foi acrescentado como promessa nova. Nenhum texto aprovado foi reescrito por
questao de estilo.

Um exemplo do que isso excluiu: um achado apontou voz passiva em "Sao
esclarecidas as condicoes do atendimento...", em `como-funciona.html`. Esse
texto esta em `TEXTOS-APROVADOS.md` linha 191. Texto aprovado so muda com a
socia, e o defeito era de estilo, nao de verdade. Ficou como estava.

## O achado estrutural: a oferta de enfermagem vivia fora da pagina dela

A pagina de tecnico de enfermagem tinha saido do menu em 18/10, mas a oferta
continuava em todo o resto do site: nas meta descriptions que alimentam a
busca, no argumento de preco repetido em cinco paginas, no JSON-LD, na tabela e
no seletor do Trabalhe Conosco, e na propria pagina, que era a **unica das 18**
que ainda se anunciava no proprio menu, no proprio rodape e no proprio
og:title.

Tirar uma pagina do menu nao tira o servico do site. Isso e o que esta rodada
corrigiu.

## O que continua aberto, e depende da socia

Nada disto foi inventado para fechar buraco. Sao os pontos em que o site
preferiu ficar calado a afirmar sem lastro.

| o que falta | o que destrava |
|---|---|
| **Enfermeiro responsavel tecnico com COREN** | os 24 blocos de rodape, os blocos de supervisao, a peca do plano de cuidados que saiu da home, e a exigencia da RDC 917/2024 |
| **Numero do alvara, da licenca sanitaria e do CNES** | a socia disse ter os tres e nao forneceu numero. Numero conferido e a condicao para publicar |
| **Contrato padrao de prestacao de servico** | a garantia "contrato por escrito" saiu de `como-funciona.html` porque a empresa opera sem contrato formal |
| **Fotografia real com autorizacao de uso de imagem** | a foto do hero e gerada por IA, por decisao dela de 19/10. Ver `FOTOGRAFIA.md` |
| **Definir se ha retorno fora do horario comercial** | varias promessas de prazo sairam por nao haver definicao |

## Pendencias tecnicas que NAO sao desta rodada

A rolagem de 4 px a 768 px e a 1024 px em `index.html`, `como-funciona.html` e
`plano-de-saude-cobre-home-care.html` e **pre-existente**. Foi conferida
servindo o commit anterior em paralelo e medindo os dois: numeros identicos. Ja
estava registrada em `AUDITORIA-estrutura.md`. Continua sem causa localizada:
nenhum elemento ultrapassa a largura da janela, o que aponta para
pseudo-elemento ou arredondamento.

## O que a verificacao por assercao pegou, e que o olho nao pegaria

Todas as 73 substituicoes exigiram contagem exata de ocorrencias antes de
gravar. Duas falharam por achar **duas** ocorrencias onde eu esperava uma: a
frase estava tambem no JSON-LD da pagina, que e o que o buscador pode exibir
como resposta direta. Sem a assercao, metade da correcao teria ficado para
tras, e justamente a metade que o Google mostra.
