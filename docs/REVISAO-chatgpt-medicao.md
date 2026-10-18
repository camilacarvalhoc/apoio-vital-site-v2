# Medição do pacote revisado pelo ChatGPT

Registro do que foi medido no pacote `apoio-vital-site-revisado-para-publicacao.zip`,
devolvido pela sócia em 18/10/2026, antes de qualquer publicação.

Base da revisão: o pacote local do repositório em `9a89bc9`, árvore limpa, 8 commits ainda não
publicados. **A revisão partiu da base certa**, não da versão que está no ar (`13e152f`).
Conferido arquivo por arquivo.

## Método

Comparação byte a byte dos 117 arquivos do pacote contra a árvore de trabalho. Todas as
contagens deste documento são resultado de varredura, não de leitura por amostragem.

## O que mudou

26 arquivos alterados: 24 HTML e 2 de documentação. `style.css` e `main.js` **idênticos**, o
que dispensa refazer o cache-busting nas 24 páginas.

Todas as alterações são trocas de linha por linha, sem alteração estrutural: cada arquivo tem
exatamente tantas linhas removidas quanto adicionadas.

Oito dessas linhas são a mesma mudança global em todas as 24 páginas: a barra do topo, seis
itens do submenu de serviços e o parágrafo do rodapé.

## Defeito que impedia publicar, já corrigido

`formacao-de-cuidadores.html` voltou com duas tags de fechamento substituídas por um byte de
controle `U+0002` (STX):

| linha | esperado | recebido |
|---|---|---|
| 13 | `</title>` | `U+0002` |
| 263 | `</h1>` | `U+0002` |

O `<title>` sem fechamento engole o `<head>`; o `<h1>` sem fechamento engole o parágrafo
seguinte. Varredura dos 117 arquivos por caracteres de controle e invisíveis (C0, C1, NBSP,
largura zero, BOM, marcas de direção): **a corrupção está contida nesses dois pontos**.

Corrigido restaurando as duas tags, sem tocar no texto. Revalidado: 24 arquivos balanceados.

## Revisão aplicada aos títulos, não ao corpo

A revisão trocou 16 botões de `Pedir avaliação gratuita` para `Consultar disponibilidade` e o
cartão `Avaliação em casa, sem custo` para `Entendimento da necessidade`.

Os conceitos removidos dos títulos sobreviveram no corpo do site:

| conceito | sobreviventes | páginas |
|---|---|---|
| oferta de avaliação gratuita | 18 | 11 |
| "Mantemos escala reserva, com profissionais de folga" | 24 | 7 |
| prazos ("em 24 horas", "ainda hoje", "dois a três dias") | 12 | 5 |
| "proposta por escrito" | 12 | 5 |
| "apresentação à família antes do primeiro plantão" | 8 | 5 |
| "relatório diário de cuidados" | 5 | 2 |
| "a conversa leva cerca de 15 minutos" | 4 | 4 |

Caso visível na home: o subtítulo diz *"A visita de avaliação não custa nada"* e o botão
imediatamente abaixo diz *"Consultar disponibilidade"*.

## "Disponibilidade": de 6 para 110 ocorrências

Contagem no site inteiro. A navegação das 22 páginas passou a exibir "Serviço não disponível
no momento" em dois itens e "Informações sobre futuras iniciativas" num terceiro.

O diagnóstico está correto — quatro dos sete serviços ainda não existem. A execução escolhida
(manter o item no menu com rótulo negativo) comunica ausência em todas as páginas. Retirar o
item resolve a mesma honestidade sem esse custo.

## Título brigando com conteúdo em seis páginas

| página | `<title>` (inalterado) | `<h1>` (revisado) |
|---|---|---|
| servicos.html | Serviços de Home Care no Rio de Janeiro | Cuidado e acompanhamento conforme a disponibilidade na sua região |
| index.html | Cuidador de Pessoa Idosa e Home Care no Rio | Cuidado e acompanhamento para quem é importante para você |
| servicos/cuidador-de-idosos.html | Cuidador de Pessoa Idosa no Rio de Janeiro | Cuidador de pessoa idosa \| Apoio Vital |

O `|` foi levado para dentro do `<h1>` em duas páginas. É convenção de título de aba; no corpo
aparece como traço solto.

`formacao-de-cuidadores.html` tem três mensagens simultâneas: a descrição no Google e o
compartilhamento no WhatsApp vendem "Curso de Cuidador de Pessoa Idosa no Rio" com certificado;
o `<h1>` diz "informações sobre disponibilidade"; o corpo tem 14 menções a "curso", com faixa
de preço. Precisa de decisão inteira, não de ajuste de título.

## Objeção registrada: a avaliação gratuita é verdadeira

A sócia confirmou que ela própria faz a primeira conversa e a avaliação em casa ("Sou eu
mesma"). Não é promessa sobre equipe inexistente.

As demais remoções da revisão corrigem afirmações não sustentadas — supervisão, equipe em
seleção, verificações não comprovadas — e entram sem discussão. A oferta de avaliação gratuita
não pertence a esse grupo: é verificável, é o único elemento do site que retira risco de quem
decide sob pressão, e foi removida sem que houvesse inverdade a corrigir.

## O que a revisão acertou

- `seguranca-e-selecao.html`: removeu "Nenhum profissional entra na casa de um cliente sem ter
  passado por todas", "sem exceção", "no mínimo duas famílias", "renovada periodicamente".
- Removeu a descrição da entrevista conduzida pela cofundadora como triagem técnica estruturada.
- Removeu "em todo o Rio de Janeiro" do rodapé das 22 páginas, com a cobertura real ainda em
  aberto (questão 12 do questionário segue sem resposta única).
- `areas-de-atendimento.html`: lista de bairros deixou de ser promessa.
- `como-funciona.html`: removeu "esse caminho inteiro cabe em 24 horas".

## Documentação alterada pela revisão

`docs/CONFRONTO-operacao.md` e `docs/AUDITORIA-estrutura.md` tiveram citações reescritas. Esses
documentos registram o que o site **dizia** no momento da auditoria, e as citações são a prova
de cada achado. Reescrevê-las torna os achados incoerentes — um deles passou a localizar o
problema no próprio texto que o corrigiria.

Pior: `docs/CONFRONTO-operacao.md` passou a afirmar que `como-funciona.html:375` diz
"Substituição: quando há necessidade de substituição, a Apoio Vital organiza a busca...". A
página não foi alterada: a linha 389 continua dizendo "Escala reserva: Mantemos profissionais
de folga disponíveis para cobertura". O documento afirma uma correção que não existe.

**Recomendação: reverter os dois arquivos de `docs/`.** Eles são registro histórico, não texto
publicado, e não aparecem no site (bloqueados no `.htaccess`).

## Verificado e sem problema

- JSON-LD das 22 páginas: válido.
- Travessões: zero.
- Rolagem horizontal: nenhuma nova. Os 4 px de `contato.html` existem idênticos no repositório
  e vêm da `div.armadilha`, o campo-isca anti-spam posicionado fora da tela de propósito.
- Formulário: `action="/enviar.php"`, `method="post"`, 7 links de WhatsApp com endereço no
  HTML. Funciona com o JavaScript desligado.
- Caracteres de controle e invisíveis: zero, após a correção.
- Links internos: nenhum quebrado. Os 60 avisos em `_modelo-servico.html` são pré-existentes,
  idênticos no repositório, e intencionais: é molde para gerar páginas em `servicos/`.

## Situação

Pacote de trabalho corrigido e validado, **não publicado**. Aguarda decisão sobre os quatro
pontos do documento `PROMPT-para-o-chatgpt.md`: os 18 trechos da avaliação gratuita, os 83
trechos dos demais conceitos, a página de formação e o rótulo dos itens do menu.
