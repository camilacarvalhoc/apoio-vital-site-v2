# Apoio Vital — site institucional

Site de uma página da Apoio Vital Gestão de Cuidados e Acompanhamento Ltda., empresa de
atenção domiciliar (home care) do Rio de Janeiro. O público é a família de um paciente,
quase sempre no celular, decidindo sob pressão depois de uma alta hospitalar ou de uma perda
de autonomia. O site existe para essa pessoa entender o serviço e falar com alguém.

**Antes de mexer em qualquer coisa, leia `docs/00-estado-atual.md`.** Há pendências
regulatórias e um conflito de marca em aberto que mudam o que pode e o que não pode ser
escrito nesta página.

## Stack

HTML, CSS e JavaScript puros. **Sem build, sem framework, sem backend, sem banco de dados.**
Os arquivos são servidos como estão.

```
index.html     a página inteira
styles.css     folha de estilo única, com design tokens em :root
script.js      interatividade, sem dependências
404.html       página de erro, reaproveita styles.css
assets/        logos SVG da marca, ícone de iOS, imagem de prévia social
robots.txt     sitemap.xml
```

A única dependência externa é a fonte Figtree, do Google Fonts. Não acrescente outras sem
necessidade real — cada uma entrega o IP de todo visitante a um terceiro antes mesmo de a
pessoa preencher qualquer formulário, o que num site de saúde tem implicação de LGPD.

## Convenções do código

Estas não são preferências de estilo, são as convenções que o código já segue. Mantenha-as.

**JavaScript** — tudo dentro de uma IIFE com `'use strict'`. Funções nomeadas em português
(`iniciarMenu`, `iniciarFaq`, `iniciarRevelacao`), declaradas com `var`. Cada módulo começa
com uma guarda que devolve cedo se o elemento não existir. O bootstrap no fim chama cada
`iniciar*` em ordem.

**Estado no DOM** — atributos `data-*`, não classes de estado: `data-aberto`, `data-visivel`,
`data-ativo`. Classes são para estilo, atributos para estado.

**CSS** — tokens de cor e espaçamento em `:root`; nomes de classe em português no padrão
bloco-elemento-modificador (`.secao__cabecalho`, `.botao--primario`). Mobile-first, com os
breakpoints subindo a partir de 768px e 1024px.

**Acessibilidade não é opcional aqui.** O público inclui pessoas idosas e quem navega por
teclado ou leitor de tela. O FAQ tem navegação por setas, `Home` e `End`; o menu devolve o
foco ao fechar; há aviso de emergência com o SAMU; e tudo que anima respeita
`prefers-reduced-motion`.

## Como testar

Não há suite de testes no repositório — os scripts de verificação foram escritos sob demanda
com Playwright, que está disponível no ambiente em
`/opt/node22/lib/node_modules/playwright`, com o Chromium em `/opt/pw-browsers`.

O que vale verificar a cada mudança, por experiência do que já quebrou:

1. **Servir por HTTP, não por `file://`.** A página 404 usa caminhos absolutos e só resolve
   servida. Um servidor Node de dez linhas basta.
2. **Console limpo** em 1280×860 e em 390×844.
3. **Sem rolagem horizontal** no mobile.
4. **Impressão**: emular `media: print` e conferir que nenhum bloco sai com opacidade menor
   que 1. Já houve regressão aqui, com o PDF saindo em branco.
5. **Teclado no FAQ**: setas, `Home`, `End` navegam; `Ctrl+Home` e `Ctrl+End` **não** podem ser
   interceptados, são do navegador.
6. **Movimento reduzido**: com `prefers-reduced-motion`, nada pode ficar escondido.

Validar o HTML com um parser antes de commitar pega tag não fechada em segundos.

## O que nunca fazer

**Não afirmar conformidade regulatória que não existe.** O site não tem responsável técnico
nem licença sanitária identificados. Dizer "em conformidade com a RDC 917/2024" ou que o
responsável técnico está identificado no rodapé é falso hoje, e é publicidade enganosa. A
formulação correta é "regido pela RDC Anvisa nº 917/2024" — diferença de duas palavras com
peso jurídico distinto. Ver `docs/04-regulatorio.md`.

**Não prometer o que a operação não entrega.** Publicidade vincula o fornecedor e integra o
contrato. Cada "24h", "monitoramento contínuo" e "retaguarda" vira obrigação exigível.

**Não usar superlativo nem autoelogio** ("a melhor", "excelência", "equipamentos de ponta").
Publicidade em saúde não admite, e não convence quem está com medo.

**Não tocar em registros DNS de e-mail.** MX, SPF, DKIM, DMARC e nameservers sustentam
`contato@apoiovital.com`. Mexer derruba o e-mail da empresa. Ver `docs/03-infraestrutura.md`.

**Não versionar credencial.** O `.gitignore` bloqueia `.env`, chaves e perfis de FTP. O
histórico do Git é permanente: apagar num commit seguinte não remove o que já subiu.

**Não usar imagem gerada por IA** para representar equipe, pacientes ou instalações. Num
serviço de saúde, inventar as pessoas que vão entrar na casa de alguém destrói a confiança
quando percebido.

## Documentação

| Arquivo | Para quê |
|---|---|
| `docs/00-estado-atual.md` | Onde o projeto está e o que trava o quê. **Comece por aqui.** |
| `docs/01-decisoes.md` | Cada decisão e o motivo dela |
| `docs/02-marca-vitalmed.md` | O conflito de marca em aberto |
| `docs/03-infraestrutura.md` | Domínio, hospedagem, e-mail, publicação |
| `docs/04-regulatorio.md` | RDC 917/2024, responsável técnico, licença |
| `docs/05-copy-e-conteudo.md` | O que o texto pode e não pode dizer |
