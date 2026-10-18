# Apoio Vital, o que falta

Estado em 18/10/2026. Escrito para ser avaliado pelo ChatGPT e decidido pela socia.

## O que ja esta fechado

| frente | estado |
|---|---|
| simbolo da marca | vetorizado a partir do desenho aprovado, com fidelidade medida |
| assinatura horizontal | montada, aplicada nas 22 paginas, com regra de reducao por breakpoint |
| icones e imagem de compartilhamento | refeitos a partir do simbolo aprovado |
| paleta | fechada, com todo contraste calculado pela WCAG e nenhum estimado |
| acessibilidade | zero reprovacao de texto, 528 paradas de Tab com anel visivel |
| funcionar sem JavaScript | conferido nas 22 paginas |
| infraestrutura | repositorio sincronizado com a producao, deploy por Git ligado |

## O que esta aberto, por ordem de risco

### 1. Afirmacoes regulatorias

A empresa **nao tem** responsavel tecnico registrado, licenca sanitaria nem CNES.
Os blocos correspondentes estao desativados no HTML e precisam continuar assim
ate existirem. Risco: sanitario e de publicidade enganosa.

Nada a fazer no site. A acao e da empresa, e o site acompanha depois.

### 2. Posicionamento verbal

A critica do ChatGPT, ainda intocada. Quatro categorias a varrer em precos,
index, sobre e como-funciona:

- comparacao com concorrente
- explicacao defensiva de decisao comercial
- afirmacao de superioridade sem evidencia
- promessa absoluta sobre prazo, disponibilidade ou substituicao

A ultima e a mais seria: publicidade vincula, e promessa operacional vira
obrigacao exigivel. Precisa de revisao propria, separada da revisao de estilo,
e de confirmacao da socia sobre o que a operacao cumpre de fato.

### 3. Conflito de marca no INPI

Ha indicio de registro anterior de "Apoio Vital" na classe 44, nao confirmado.
Se confirmado, muda o nome, e tudo o que foi feito de marca ate aqui vira
retrabalho. Vale confirmar antes de investir em aplicacao fisica.

### 4. Fotografia

O site nao pode usar imagem de IA representando equipe, paciente ou casa. Hoje
usa marca d'agua no lugar das fotos. Precisa de sessao real, com autorizacao de
uso de imagem.

### 5. Defeitos conhecidos e nao corrigidos

- a 768px, seis paginas rolam 4px na horizontal. Pre-existente, identico ao que
  esta no ar hoje
- a chave do painel de medicao esta no codigo e no historico do Git. Enquanto o
  repositorio for privado nao ha exposicao; se um dia virar publico, ha

### 6. Pendencias da marca que o ChatGPT levantou

- teste do cabecalho em aparelho real de 320px, com alguem que nao conheca a marca
- inventario de funcao de cada cor, para saber se a terracota cumpre papel ou e
  so decoracao
- aplicacoes fisicas da marca, uniforme, fachada, cartao e veiculo, nunca validadas
- se o bronze volta a paleta digital

### 7. SEO

O dominio e novo e ainda nao esta indexado. Falta confirmar envio do sitemap e
acompanhar a indexacao.

## Ordem, depois da avaliacao do ChatGPT em 18/10/2026

Ele reordenou por risco imediato, dependencia e custo de retrabalho, e acrescentou
tres coisas que faltavam.

1. **Seguranca, agora.** Ele subiu a chave do painel para o topo. Enquanto o
   repositorio for privado nao ha exposicao publica, mas a chave esta no codigo e
   no historico, e isso precisa ser neutralizado e a exposicao avaliada, nao
   deixado para o fim.
2. **Nome e operacao, em paralelo.** Duas frentes que podem correr juntas:
   - INPI: pesquisa na base oficial, conferindo sinal, apresentacao, situacao
     processual, titularidade, especificacao dos servicos e prioridade do
     eventual direito anterior. A suspeita e motivo para investigar, nao prova
     de conflito.
   - Regularidade sanitaria: e aqui esta o ponto que eu nao tinha visto. Antes
     de revisar texto, e preciso responder **qual e o modelo de operacao**: a
     Apoio Vital presta diretamente atencao domiciliar, ou atua como contratacao
     e intermediacao de profissionais? A RDC ANVISA 917/2024 disciplina o
     primeiro caso, e o enquadramento muda o que o site pode dizer.
3. **Auditoria de texto.** Pode comecar antes, mas a redacao final depende das
   duas frentes acima. As quatro categorias ficam, e ele acrescentou uma quinta:
   **afirmacao que confunde atendimento comercial com disponibilidade
   assistencial**. "Atendimento 24 horas" pode significar que alguem responde no
   WhatsApp a qualquer hora, que a empresa inicia um servico imediatamente, ou
   que ha profissional disponivel para qualquer modalidade a qualquer momento.
   Nao sao a mesma coisa, e hoje a frase esta no site sem distincao.
   Cada promessa vira linha de um inventario: frase atual, risco, evidencia
   operacional, e decisao.
4. **Publicacao controlada** dessa revisao.
5. **Fotografia** real, com autorizacao de uso de imagem.
6. **Aplicacoes fisicas** da marca, depois que o nome estiver confirmado.
7. **SEO**: o monitoramento tecnico e a verificacao de indexacao comecam agora,
   sem esperar o resto. Mas nada de ampliar conteudo ou campanha em torno de um
   nome potencialmente conflitante ou de servico com enquadramento indefinido.

## Matriz de autorizacao

A lacuna principal que ele apontou: o plano dizia o que fazer e em que ordem, mas
nao dizia **o que permite considerar cada frente encerrada**.

| frente | condicao para avancar |
|---|---|
| seguranca | credencial exposta neutralizada e exposicao avaliada |
| INPI | pesquisa documentada, risco analisado, decisao sobre manter o nome |
| regularidade | modelo de operacao e requisitos aplicaveis identificados, com responsavel e providencia definidos |
| texto | cada promessa confrontada com o processo operacional real, e autorizada pela socia |
| publicacao | varredura limpa e conferencia em producao |

## Pendencia aberta, registrada a pedido dele

A 768 px, seis paginas rolam 4 px na horizontal. Pre-existente, identico ao que
estava no ar antes desta rodada. Ele liberou a publicacao com a condicao de que
isso ficasse registrado como pendencia explicita, e que **permaneca aberta ate as
seis paginas serem verificadas a 768 px**.

As paginas: index, como-funciona, plano-de-saude-cobre-home-care,
servicos/enfermagem-e-equipe-multidisciplinar, servicos/remocao-de-pacientes,
servicos/tecnico-de-enfermagem.
