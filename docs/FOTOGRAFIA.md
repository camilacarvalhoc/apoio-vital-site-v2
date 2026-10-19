# Fotografia do site: o que fotografar e como

> **Este documento substituiu o `IMAGENS.md`**, que ensinava a gerar as imagens por
> inteligência artificial. Essa rota foi abandonada por decisão da Camila em 17/10/2026.
> O arquivo antigo foi movido para `assets/img/_IMAGENS-geracao-por-IA-DESCONTINUADO.md`,
> preservado apenas como registro.

## A regra, e o motivo dela

**Nenhuma pessoa que apareça neste site pode ter sido inventada por máquina.** Nem cuidador,
nem paciente, nem a casa onde o atendimento acontece.

O motivo não é estético, é comercial. A família está decidindo quem vai entrar na casa da mãe
dela. No dia em que alguém perceber que a cuidadora da foto não existe, e hoje muita gente
percebe, o que cai não é a imagem: é a confiança em tudo que o site afirma, inclusive no que é
verdade. Num serviço de saúde isso não se recupera.

Enquanto não houver foto real, **o site fica sem foto**. Ele foi desenhado para isso: tem arte
vetorial própria, hierarquia de texto e respiro suficiente. Site sóbrio sem foto é melhor que
site cheio de gente que não existe.

## Os três encaixes que existem hoje

| Página | Arquivo sugerido | Proporção | Mínimo |
|---|---|---|---|
| `alta-hospitalar.html` | `alta-chegada-em-casa.jpg` | 3:2 | 1600×1067 |
| `servicos/aluguel-de-equipamento.html` | `equipamento-cama-hospitalar.jpg` | 3:2 | 1600×1067 |
| `servicos/remocao-de-pacientes.html` | `remocao-cadeira-de-rodas.jpg` | 3:2 | 1600×1067 |

Os arquivos vão em `assets/img/fotos/`. Os espaços já estão no HTML, com legenda, e aceitam a
imagem sem mexer em leiaute.

## O que fotografar primeiro, em ordem de utilidade

1. **Equipamento de verdade, sem ninguém na cena.** Cama hospitalar montada, cadeira de rodas,
   andador, suporte de soro. É a foto mais fácil de conseguir, não precisa de autorização de
   ninguém e já resolve dois dos três encaixes.
2. **Mãos, objetos e detalhes.** A caixa de remédio organizada por horário, o caderno de
   registro do plantão aberto, o crachá sobre a mesa. Conta a rotina sem expor rosto.
3. **A equipe, com rosto.** É a que mais converte e a que exige mais cuidado. Só depois de
   autorização escrita.

## Autorização de imagem: inegociável

Toda pessoa reconhecível precisa assinar autorização de uso de imagem antes de a foto entrar
no site. Para paciente e família, isso vale em dobro: a imagem associada a um serviço de saúde
revela condição de saúde, que a LGPD trata como **dado pessoal sensível** no art. 11.

Na dúvida, não publique. Uma foto a menos não custa nada; uma foto publicada sem autorização
custa processo e reputação.

## Como a foto precisa ser para combinar com o site

- **Luz natural**, de janela, de lado. Nada de flash direto nem de luz amarela de teto.
- **Enquadramento com ar em volta.** O site tem respiro, e foto apertada briga com ele.
- **Casa de verdade**, com objeto de verdade. Ambiente cenográfico se reconhece na hora.
- **Sem sorriso de catálogo.** A família está num momento difícil, não numa propaganda.
- **Cor contida.** O site é petróleo, creme e menta. Foto muito saturada destoa. O próprio CSS
  já aplica um leve ajuste de cor em `.foto` para unificar o conjunto.
- **Pessoa idosa com dignidade.** Em atividade, com autonomia visível, olhando para frente.
  Nunca encolhida, nunca de cima para baixo, nunca só como alguém que recebe cuidado.

## Depois de salvar os arquivos

1. Nomear como na tabela acima, tudo em minúsculo, sem acento e sem espaço.
2. Reduzir para no máximo 1600 px de largura e salvar em JPG de qualidade 80.
3. Trocar o `<div class="foto foto--vazia">` pela tag `<img>` com `alt` descrevendo a cena.
4. O `alt` descreve o que se vê, não o que se quer vender. Quem usa leitor de tela merece a
   cena, não o slogan.

---

## A fotografia do hero: o que aconteceu, 18 e 19/10/2026

A direcao visual aprovada pela socia coloca uma fotografia ocupando a metade
direita da pagina inicial, sangrando ate a borda da tela.

**Em 18/10 eu montei um painel provisorio** em petroleo com a marca d'agua do
simbolo, porque a regra do projeto proibia imagem de IA com pessoas e
`assets/img/fotos/` estava vazia.

**Em 19/10 a socia decidiu publicar uma fotografia gerada por IA.** Apresentei
as tres saidas e mostrei, antes da escolha, o texto da regra e o motivo dela,
que esta no topo deste documento e continua valendo como analise. Ela escolheu
ciente disso. O painel provisorio saiu; a fotografia entrou.

O arquivo e `assets/img/fotos/hero-cuidado-em-casa.jpg`, 1254x1254, gerado a
partir de especificacao escrita: sala de estar brasileira, luz natural de fim
de tarde, convivencia cotidiana, sem leito hospitalar, sem equipamento medico,
sem procedimento clinico, em tons quentes que convivem com o perola e o
terracota da paleta.

### A pendencia conhecida, registrada e nao resolvida

**O emblema no uniforme da cuidadora foi desenhado pela propria IA e NAO e a
marca da Apoio Vital.** O batimento virou uma cruz, as duas fitas trocaram de
hierarquia e ganharam degrade que os arquivos aprovados nao tem, e o nome
embaixo saiu ilegivel. Mostrei a ampliacao lado a lado a socia e ela optou por
publicar assim e ajustar depois.

A correcao ja esta montada e e a que a lei 9 da
`docs/REFERENCIA-sites-cinematograficos.md` prescreve: compor o arquivo
aprovado `apoio-vital-simbolo-m-negativo.svg` por cima da fotografia, por
edicao de imagem, em vez de pedir a IA que desenhe o logotipo.

### O texto alternativo

Descreve a cena e **nao afirma** que as pessoas sao profissionais ou clientes
da Apoio Vital. A empresa nao tem clientes. Afirmar que tem, por imagem, e o
art. 37 §1º do CDC.

### Medida do encaixe



A moldura e quadrada acima de 1040 px (`aspect-ratio: 1 / 1`) e 4:3 abaixo
disso. Sangra ate a borda direita da tela, com canto arredondado de 34 px
apenas do lado esquerdo. Para o lado direito nao aparecer cortado em tela
larga, a foto precisa de area util sobrando a direita do assunto principal.
