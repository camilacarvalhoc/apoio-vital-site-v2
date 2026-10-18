# Auditoria da estrutura do site

Feita na madrugada de 18/10/2026, a pedido da socia, com o ChatGPT acompanhando.
Sete leitores independentes leram as 22 paginas e um oitavo sintetizou.
**Nenhuma pagina foi alterada. Isto e diagnostico.**

## O achado central

> O site e generoso exatamente com aquilo que a empresa ja tinha pronto, e
> avaro exatamente com aquilo que a familia veio buscar.

- Precos abre a folha de custo da empresa e nao da faixa.
- Sobre abre a ficha da JUCERJA e nao da um rosto.
- Seguranca abre o processo interno de RH e nao diz o que acontece se falhar.
- Areas abre o perfil demografico do municipio e nao confirma um bairro.
- Servicos abre a tabela da lei e nao compara custo entre os niveis.

`R$` aparece em **2 dos 22 arquivos**: o piso salarial que a empresa paga ao
profissional, e o capital social. Nada do que a familia paga.

O `POSICIONAMENTO.md` ja tinha a frase que descreve isso: transparencia nao e
exibir papel, e a familia entender o que esta contratando. **O site esta inteiro
na fase do papel.**

## A hipotese de jornada nao se sustenta

A sequencia compreensao, orientacao, funcionamento, confianca, investimento e
contato **nao descreve este site**, e a evidencia esta nas proprias paginas.

A sequência compreensão, orientação, funcionamento, confiança, investimento, contato não descreve este site, e a evidência está escrita nas próprias páginas. Quatro quebras concretas. 1. DÚVIDA E INVESTIMENTO SÃO PORTAS, NÃO SAÍDAS. As páginas que o modelo coloca no fim são as que capturam busca: precos.html tem title e canônica de "quanto custa um cuidador de pessoa idosa no Rio", plano-de-saude-cobre-home-care.html e areas-de-atendimento.html respondem a perguntas de quem ainda não conhece a empresa, e a PESQUISA-mercado.md mostra esse espaço ocupado por agregador sem CNPJ. Quem entra por elas entra no minuto zero, e encontra páginas escritas como se já tivessem lido o resto: nenhuma se apresenta. 2. INVESTIMENTO NÃO EXISTE NO PERCURSO. Não é etapa fora de ordem, é etapa ausente. "R$" aparece em 2 dos 22 arquivos, e nos dois casos é dinheiro da empresa (piso salarial em precos.html, capital social em sobre.html). O único preço publicado é priceRange "5986" no JSON-LD do index, invisível para a família e legível pelo Google. Nenhuma das quatro páginas do momento de agir (alta-hospitalar, contato, obrigado, 404) cita precos.html no corpo. 3. CONTATO NÃO É A SEXTA ETAPA, É O PISO DE TODAS. São 6 a 8 botões de WhatsApp por página, mais flutuante e barra fixa, e em 20 das 22 páginas é a única saída construída. alta-hospitalar.html:292 escreve a refutação com todas as letras: "Chame no WhatsApp antes de ler o resto." 4. CONFIANÇA VEM ANTES DE FUNCIONAMENTO, E ISSO ESTÁ CERTO. No 

## Problemas, por impacto em quem decide

### [ALTA] A enfermeira responsável técnica que a empresa não tem é afirmada como rotina corrente em 13 das 22 páginas, 40 ocorrências fora de comentário, 5 delas dentro de JSON-LD (portanto enviadas ao Google como dado estruturado). Está vendida a três públicos: à família, ao candidato a emprego e ao aluno do curso. A própria página que mais a afirma se desmente: servicos/enfermagem-e-equipe-multidisciplinar.html:275 diz que ela monta o plano hoje, e a linha 285 diz 'Quando a enfermeira responsável técnica for registrada, o nome e o número do COREN dela ficam visíveis no rodapé'.

**Onde:** index.html (9), perguntas-frequentes.html (4, duas no JSON-LD das linhas 159 e 175), seguranca-e-selecao.html:238, precos.html:307 e 334, servicos/enfermagem-e-equipe-multidisciplinar.html:275 e 285, servicos/tecnico-de-enfermagem.html:275, servicos/cuidador-de-idosos.html:342 e 435, trabalhe-conosco.html:240, formacao-de-cuidadores.html:311 e 360, plano-de-saude-cobre-home-care.html:345, como-funciona.html, sobre.html, servicos.html

**Por que importa:** O rodapé dessas mesmas páginas traz o bloco de RT desativado com o comentário explicando que a RDC ANVISA 917/2024 art. 4 exige o registro, que a empresa ainda não o tem, e que publicar seria publicidade enganosa pelo art. 37 do CDC. A regra do CLAUDE.md foi aplicada ao bloco estruturado e não ao texto corrido. É o passivo jurídico mais exposto do site e também o risco de produto mais sério: a RT é a espinha do argumento de confiança inteiro. Se cair, caem a seção de segurança, o processo de seleção, o plano de cuidados, as visitas de supervisão e o passo 1 dos quatro passos.

**O que trava:** Remover ou condicionar as afirmações não depende de ninguém e pode ser feito hoje. O que depende da sócia é o texto que entra no lugar: o enquadramento de operação (QUESTIONARIO-operacao.md) define se haverá RT, quando, e o que a empresa pode afirmar sobre supervisão técnica no intervalo.

### [ALTA] O site não publica nenhum preço para a família. 'R$' aparece em 2 dos 22 arquivos: piso salarial em precos.html (custo da empresa) e capital social de R$ 200.000,00 em sobre.html. O único preço publicado é priceRange '5986' no JSON-LD de index.html:102, número órfão que não existe em nenhum outro arquivo do repositório.

**Onde:** index.html:102 (JSON-LD), precos.html (página inteira), e ausência em todas as outras 20 páginas; nenhuma das quatro páginas do momento de agir cita precos.html no corpo

**Por que importa:** É a pergunta número um de quem decide, e é o território número 1 do POSICIONAMENTO.md ('explicar como o orçamento se forma'). A PESQUISA-mercado.md achou que nenhum de 14 concorrentes explica como o preço é formado: o buraco do mercado está copiado no site, inclusive na página que se chama Preços. Pior, o único número publicado é falso no sentido operacional: 5986 não corresponde a nada e vai para o Google sozinho.

**O que trava:** Tirar o priceRange órfão é imediato. Publicar faixa depende do modelo de operação: intermediação ou prestação direta, CLT ou autônomo, como se compõe hora, plantão e deslocamento. Isso está no questionário e é resposta da sócia.

### [ALTA] Não existe telefone clicável da empresa em nenhuma das 22 páginas. Zero href='tel:'. O único tel: do site é o 0800 da ANS. A barra fixa de celular tem um botão só, WhatsApp. O formulário de contato pergunta 'Melhor horário para te ligar'.

**Onde:** todas as 22 páginas; único tel: em plano-de-saude-cobre-home-care.html:297 (Disque ANS); campo em contato.html:300; barra fixa em index.html e nos dois modelos

**Por que importa:** A barra de topo de todas as páginas promete 'Atendimento 24 horas, todos os dias' e não diz como ligar. Quem decide tem frequentemente 50 a 70 anos, ou está num corredor de hospital. E docs/PREENCHER.md:152 afirma que o número foi 'aplicado em 385 lugares: texto visível, links de ligar', e PREENCHER.md:315 descreve o botão de ligar na barra fixa: a documentação descreve botões que o HTML não tem mais. Isso é regressão silenciosa, não decisão de projeto.

**O que trava:** Nenhum. O número já está confirmado e documentado desde 17/10/2026. É execução.

### [ALTA] Cinco formulações concorrentes de prazo, e '24 horas' com pelo menos cinco sentidos diferentes. Aparece nas 22 páginas, de 3 a 8 vezes cada, inclusive dentro de JSON-LD.

**Onde:** index.html (horário da central na barra de topo, duração do plantão no cartão do hero, prazo de início, duração do caminho), como-funciona.html (24h no title e na meta description, 'As primeiras 48 horas' no nome da seção, 'dois ou três dias' no subtítulo, e a contradição entre 'cabe em 24 horas' e 'Nenhum profissional pula etapa por urgência'), alta-hospitalar.html:98 (dentro do JSON-LD) e 455, contato.html:337 ('A gente responde no mesmo dia, sempre'), obrigado.html:7 ('retorna em até 2 horas') e 169 ('Uma enfermeira entra em contato ainda hoje')

**Por que importa:** Publicidade vincula: cada formulação vira obrigação contratual exigível, e elas não concordam entre si. A do JSON-LD é a mais exposta porque o Google pode exibi-la sem o 'costuma'. E a contradição interna de como-funciona (24 horas contra verificação com certidão de antecedentes e duas referências por telefone) é lida pelo visitante desconfiado como desmentido da própria página.

**O que trava:** Depende da sócia dizer qual é o prazo real de início, se existe sobreaviso e se existe escala reserva. Enquanto não houver resposta, o caminho é uma formulação única e conservadora em todo o site, não cinco otimistas.

### [ALTA] As páginas de confiança são becos sem saída. Contando só links dentro de <main>: sobre.html tem 1 saída (a migalha do index) e 1 entrada; seguranca-e-selecao.html tem 3 e não linka para precos.html; precos.html não linka para como-funciona.html nem para seguranca-e-selecao.html; formacao-de-cuidadores.html recebe zero links de corpo.

**Onde:** sobre.html, seguranca-e-selecao.html, precos.html, formacao-de-cuidadores.html, obrigado.html

**Por que importa:** A objeção seguinte de quem acabou de ser tranquilizado pela página de segurança é o preço, e não há caminho. A de quem levou o susto do preço é a prova de seleção, e não há caminho. Com os degraus desconectados, a única saída construída vira o WhatsApp, e um site de seis momentos funciona como um site de um momento só: fala com quem já estava pronto para chamar e perde quem precisava de mais um passo.

**O que trava:** Nenhum. É decisão de estrutura, independe do enquadramento.

### [ALTA] Quatro páginas estão fora da navegação desktop, incluindo as duas mais fortes do site: seguranca-e-selecao.html, plano-de-saude-cobre-home-care.html, formacao-de-cuidadores.html e trabalhe-conosco.html.

**Onde:** <nav class='nav-principal'> de todas as páginas: itens são Serviços (com 6 subitens), Alta hospitalar, Onde atendemos, Como funciona, Preços, Sobre, Dúvidas, Contato

**Por que importa:** seguranca-e-selecao.html é a página que responde ao medo que trava a decisão ('vou deixar um estranho sozinho com a minha mãe') e contém 'O que este processo não garante', o bloco mais honesto do site. plano-de-saude-cobre-home-care.html é a única página que responde a pergunta do título na primeira frase e a única que diz o que a empresa não tem. Quem está no computador só chega nelas pelo rodapé ou por dentro de uma resposta da FAQ.

**O que trava:** Nenhum.

### [ALTA] As páginas que capturam busca não se identificam. Nenhuma diz, no alto, quem é a Apoio Vital, onde fica e o que faz, antes de começar a responder.

**Onde:** perguntas-frequentes.html (abre em 'As perguntas que mais chegam aqui'), plano-de-saude-cobre-home-care.html (abre em 'Em regra, não'), areas-de-atendimento.html (abre em estatística do IBGE), precos.html (abre com 'Desconfie de preço dado por telefone')

**Por que importa:** São, pela evidência de title, canônica e meta description, as portas de entrada reais. Quem cai de busca lê conselho de qualidade assinado por ninguém, e sai sem saber de quem era a voz. Num mercado onde apenas 1 de 12 concorrentes publica CNPJ, identificar-se no alto é vantagem barata e imediata.

**O que trava:** Nenhum. O CNPJ, a razão social e o NIRE já estão conferidos em sobre.html.

### [ALTA] O menu promete 'Todos os serviços' e servicos.html entrega quatro de sete, com a frase 'São quatro serviços' congelada no texto. Faltam remoção de pacientes, aluguel de equipamento e o curso. E são justamente remoção e aluguel que alta-hospitalar.html linka no corpo, porque são os que a alta exige.

**Onde:** servicos.html:201 e corpo (185-381); submenu em todas as páginas; alta-hospitalar.html (links para servicos/remocao-de-pacientes.html e servicos/aluguel-de-equipamento.html)

**Por que importa:** Não é omissão de conteúdo: é o menu e a página discordando sobre o que a empresa vende. Quem veio pelo menu depois de uma alta procurando remoção, que é a situação mais urgente de todo o site, não encontra na vitrine o serviço que a página de alta já oferece.

**O que trava:** Nenhum, se os seis serviços são todos ofertados de fato. Se algum não for, a decisão é da sócia e o que sai é a página, não a frase.

### [ALTA] Promessas operacionais publicadas sem processo que as sustente, numa empresa de um mês: escala reserva com profissionais de folga, troca sem custo sem justificativa, substituição sem custo extra, atendimento confirmado de Guaratiba a Cachoeiras de Macacu, 'Nenhum profissional entra na casa de um cliente sem ter passado por todas. Não existe exceção por urgência'.

**Onde:** perguntas-frequentes.html:453, 460 e 528; como-funciona.html:355; seguranca-e-selecao.html (subtítulo do processo); areas-de-atendimento.html (lista de municípios)

**Por que importa:** Publicidade vincula, e o POSICIONAMENTO.md, com a condenação do TJDFT de julho de 2025 como referência, diz que nenhuma promessa operacional sai sem processo que a sustente. Nenhuma dessas aparece no site com a prova ou o limite ao lado. Em como-funciona.html:357 há inclusive uma linha vazia na lista de cobertura de falta: sobrou o recuo de um item removido, exatamente onde deveria estar o prazo de chegada do substituto.

**O que trava:** Depende inteiramente das respostas da sócia sobre quadro de pessoal, cobertura de falta e raio real de atendimento. Até lá, o caminho é reduzir a promessa, não sustentá-la com texto.

### [MEDIA] A entrada repete a si mesma em vez de avançar. A tabela da Lei 7.498/1986 aparece idêntica em index.html (675-712) e servicos.html (289-321), com as mesmas 12 linhas e as duas mesmas notas. As modalidades de plantão aparecem em index (474-489) e servicos (337-350), com granularidades diferentes. A seção de exaustão da cuidadora aparece em index (785-799) e como-funciona (407-426), com o mesmo estudo e a mesma frase 'não terceiriza o seu afeto'. Os quatro passos aparecem em index (734-751) e como-funciona (230-247). O processo de seleção aparece em três páginas.

**Onde:** index.html, servicos.html, como-funciona.html

**Por que importa:** Quem percorre index, serviços e como funciona lê o mesmo argumento três vezes e não ganha informação nova. O custo não é de espaço, é de confiança: parece que a empresa tem pouco a dizer, dito de muitos jeitos. E o cartão 'Estou cuidando sozinha' do index leva exatamente para a duplicata.

**O que trava:** Nenhum. Decidir a casa de cada peça é trabalho de estrutura.

### [MEDIA] Números e afirmações de mercado sem fonte, num site onde toda norma leva ao Planalto, ao Diário Oficial ou ao COFEN.

**Onde:** como-funciona.html:287 ('Combinado escrito evita 90% do atrito'); sobre.html (estudo com 84 cuidadores, 88,7% mulheres, sem fonte, e 'onze sites de concorrentes, apenas dois exibiam CNPJ, apenas um nomeava o responsável técnico', enquanto PESQUISA-mercado.md registra 1 de 12 e 1 de 16); perguntas-frequentes.html:454, 505 e 512; areas-de-atendimento.html:201 e 332; plano-de-saude-cobre-home-care.html:297 ('5 dias úteis' sem referência) e três menções ao Rol da ANS sem link

**Por que importa:** Um número inventado ao lado de uma citação boa contamina a citação boa. E o caso de sobre.html é mais grave: o número publicado diverge do número efetivamente conferido pela própria equipe, numa página cuja tese é 'confira por conta própria'.

**O que trava:** Nenhum. É aplicar ao texto publicado o método que a pesquisa já usou: descartar o que não resiste à checagem.

### [MEDIA] Duas comparações diretas com o concorrente, em tom de superioridade e sem fonte.

**Onde:** areas-de-atendimento.html:201 ('A maior parte das empresas do setor atende só Zona Sul e Barra. A gente atende também...') e :332 ('Boa parte das empresas do setor não atravessa a ponte nem sobe a serra. A gente atende.'); precos.html (bloco 'Desconfie de preço dado por telefone', logo à direita do h1)

**Por que importa:** O POSICIONAMENTO.md diz literalmente que o movimento 'eles não, nós sim' está errado, por ser a mesma convenção preguiçosa da categoria virada do avesso, e que envelhece no dia em que um concorrente publicar o mesmo. O CLAUDE.md proíbe autoelogio. E em precos.html o efeito prático é pedir desconfiança a quem já está desconfiado, antes de qualquer informação própria.

**O que trava:** Nenhum.

### [MEDIA] sobre.html não responde o próprio h1. 'Quem vai cuidar da sua família' é respondido com NIRE, CNAE, natureza jurídica e capital social. As duas seções que responderiam de verdade estão comentadas no HTML: a história da fundadora (linhas 220-228) e a equipe (343-366).

**Onde:** sobre.html

**Por que importa:** É a página de conferência de quem já quase decidiu e vai ter que justificar a escolha para a família. Entrega ficha de junta comercial e nenhum rosto, nenhum nome de quem cuida, nenhum registro de conselho. O único número em reais da página é o capital social: a página sobre a empresa tem preço, e a página de preços não tem.

**O que trava:** A seção de equipe depende de existir equipe contratada e de fotografia real (docs/FOTOGRAFIA.md proíbe pessoa gerada por máquina). A história da fundadora depende só de a sócia escrevê-la, e não depende do enquadramento regulatório.

### [MEDIA] areas-de-atendimento.html não confirma cobertura, que é a única coisa que precisa fazer: cerca de cem bairros em nove cartões, sem campo de busca, sem lista única, sem ordem alfabética, precedidos por um bloco de estatística demográfica ('20,2% da população', '121 pessoas idosas para cada 100 jovens') entre o h1 e a lista.

**Onde:** areas-de-atendimento.html, com o aviso autoanulador na linha 210 e o cartão mais útil da página, 'Atendimento em hospital', no penúltimo bloco

**Por que importa:** É página de eliminação: se a resposta for não, nada mais importa, e qualquer coisa que atrase a resposta custa caro. Hoje a estatística de tamanho de mercado, que é escrita para investidor, vem antes da resposta que a filha veio buscar. E o título diz 'no Rio de Janeiro' enquanto um terço do conteúdo é Niterói, São Gonçalo, Baixada, Maricá e Itaboraí: quem mora em Niterói tem motivo para não abrir a página.

**O que trava:** A lista real de cobertura e o custo de deslocamento dependem da sócia. A ordem dos blocos e o campo de busca, não.

### [MEDIA] perguntas-frequentes.html tem 20 itens, todos fechados, sem índice e sem âncora interna, e nenhuma saída para quem teve a dúvida resolvida: os dois botões são 'Minha dúvida não está aqui' e 'Perguntar no WhatsApp'.

**Onde:** perguntas-frequentes.html:367 e 543; seis seções sem índice

**Por que importa:** No celular, achar 'E se o profissional faltar?' exige rolar seis cabeçalhos e vinte títulos fechados. E quem leu e se convenceu não tem o que clicar: a página só oferece mais pergunta. É a melhor página de texto do site funcionando como fim de linha.

**O que trava:** Nenhum.

### [MEDIA] A orientação é prometida na superfície e entregue como oferta. 'Ver o que fazer' aparece oito vezes no index, com o mesmo rótulo em oito cartões de situação, e quatro deles levam a páginas de venda de serviço.

**Onde:** index.html:512-568; 'Não sei qual preciso. Me ajuda?' em servicos.html:203; 'Conta pra gente o que está acontecendo' em index.html:508

**Por que importa:** Quem clica em 'Depois de uma queda' esperando o que fazer chega numa página que vende cuidador. O eixo que o POSICIONAMENTO.md chama de vantagem mais durável, o método de orientação, existe de verdade em um único bloco do site, a seção #nao-aceita de como-funciona, e está na quarta seção de uma página interna.

**O que trava:** Nenhum para corrigir o rótulo. Desenhar o método de orientação é trabalho conjunto com a sócia, previsto no POSICIONAMENTO.md.

### [MEDIA] Duas aberturas competindo na primeira tela do index: o h1 com subtítulo de quatro linhas e, ao lado, o cartão 'Modalidades de plantão' com 6h, 12h e 24h. No celular vira coluna única e a tabela de jornada chega antes de a pessoa saber se a empresa resolve o problema dela.

**Onde:** index.html:474-489, contra index.html:913 ('desconfie de quem diz um número antes de conhecer o caso')

**Por que importa:** É oferta antes de diagnóstico, a inversão que a própria página condena dez seções abaixo. E o h1 anuncia categoria e território, não a situação de quem chegou: a página só começa a responder na segunda seção.

**O que trava:** Nenhum.

### [BAIXA] A faixa de indicadores do index gasta uma tela inteira sem prova nova: '2' num slot de número grande, e '100%' de um denominador que ninguém conhece.

**Onde:** index.html:761-782, repetindo o conteúdo da seção de segurança (651-659)

**Por que importa:** '2' lê como pouco, não como muito, e '100%' é exatamente o adjetivo não conferível que a PESQUISA-mercado.md identificou como convenção da categoria. Ocupa o lugar onde caberia a informação que falta no percurso inteiro.

**O que trava:** Nenhum.

### [BAIXA] Quatro nomes para a mesma página de dúvidas, e dois nomes para a de preços, com o rodapé discordando do menu.

**Onde:** menu desktop 'Dúvidas', menu mobile e rodapé 'Dúvidas frequentes', migalha 'Dúvidas frequentes', title 'Perguntas Frequentes sobre Home Care', arquivo perguntas-frequentes.html; e menu 'Preços' contra rodapé 'Como calculamos o valor'

**Por que importa:** No caso de preços o rodapé está certo e o menu está errado: a página calcula e não precifica. O site já discorda de si mesmo sobre o que a página é, e o visitante clica em Preços esperando preço.

**O que trava:** Depende de decidir antes se vai existir faixa de preço publicada. Se existir, o menu está certo e falta a página; se não existir, o rótulo precisa mudar.

### [BAIXA] obrigado.html e 404.html são as duas páginas menos cuidadas do site: obrigado tem um único link de saída no corpo (index) e é o primeiro lugar de toda a rota onde a palavra 'valores' aparece; 404 não tem entrada nenhuma e oferece três links.

**Onde:** obrigado.html, 404.html

**Por que importa:** obrigado.html é a página que a pessoa lê no momento de maior ansiedade, logo depois de entregar dados de saúde da mãe, e é onde o prazo aparece em duas versões incompatíveis ('retorna em até 2 horas' na meta description, 'ainda hoje' no corpo). 404.html interrompe alguém que estava em movimento e não sabe onde.

**O que trava:** Nenhum.

## O que NAO mudar

Esta lista importa tanto quanto a de problemas, e costuma ser esquecida numa reforma.

- seguranca-e-selecao.html inteira, e em especial o bloco 'O que este processo não garante'. É a única página do site que descreve o limite da própria oferta em vez de exibir adjetivo, e é exatamente o que o POSICIONAMENTO.md chama de método no lugar de comparação. O defeito dela é de localização, não de conteúdo: está fora do menu desktop. Colocar no menu, não reescrever.
- plano-de-saude-cobre-home-care.html, pelas duas razões que a fazem única. Responde a pergunta do título na primeira frase do subtítulo ('Em regra, não.'), coisa que nenhuma outra página faz. E é o único lugar do site onde a empresa diz o que NÃO tem: 'A Apoio Vital não é credenciada a nenhuma operadora, e não promete que seja. Quem disser o contrário está vendendo uma expectativa que não controla' (linha 308). Também é a única página que ajuda alguém que talvez nunca contrate ('você pode usá-lo no seu pedido mesmo que decida não contratar a gente', 345). Uma reforma que procure conversão vai querer tirar essa frase. Não tirar.
- A tabela 'Quem pode fazer o que', baseada na Lei 7.498/1986, com as duas notas de rodapé sobre o que quase todo site erra. É a melhor peça de conteúdo do site e responde a pergunta que a PESQUISA-mercado.md mostra que o mercado não responde. O problema é que ela aparece duas vezes no mesmo percurso (index.html:675-712 e servicos.html:289-321). Resolver escolhendo a casa dela, nunca apagando as duas, e consertar o cartão de técnico de enfermagem que a contradiz 60 linhas acima.
- A seção #nao-aceita de como-funciona.html (309-345), com o script de conversa: em vez de 'você precisa de cuidador', experimente 'contratei alguém para me ajudar com a casa e te levar nas consultas, porque eu não estou dando conta'. É o único bloco de todo o site que orienta sem terminar numa proposta, e é o eixo 3 do POSICIONAMENTO.md existindo de fato. Deve subir de lugar, jamais sumir.
- As duas frases de honestidade estrutural da FAQ: 'Cuidador não é empregado doméstico, e essa confusão é a causa mais comum de atrito e de rompimento de contrato' (428) e 'Não prometemos risco zero, porque existe discussão jurídica sobre responsabilidade subsidiária e ninguém honesto promete isso' (397). São o modelo de tom para o site inteiro.
- O índice interno 'Nesta página' de como-funciona.html (207-218). É o único recurso de leitura sob pressão que o site tem, e é o que falta na FAQ. Replicar, não remover.
- A abertura da composição de custo em precos.html com os pisos da Lei 14.434/2022 e a escala 12x36. É o começo do território 1 do POSICIONAMENTO.md, e nenhum dos 14 concorrentes pesquisados faz isso. Falta a outra metade (a faixa que a família paga), e a tentação de uma reforma apressada vai ser trocar a composição por uma tabela de preço. O certo é somar, não substituir.
- O aviso 'A lista é grande mas não é um limite' em areas-de-atendimento.html:210. É honesto e deve ficar. O que sai é a lista de cem bairros que ele anula, não o aviso.
- O cartão 'Atendimento em hospital' de areas-de-atendimento.html:383, que esclarece que para acompanhante hospitalar o que importa é onde a pessoa está internada, não o bairro dela. É a informação mais útil daquela página. Precisa subir, não sumir.
- O formulário de contato.html como triagem e não como captura de lead: 'O que está acontecendo', 'Como está o dia a dia dela hoje', 'Para quando', com honeypot e dois consentimentos separados (contato e dado de saúde). É raro e está correto em LGPD. A única coisa a corrigir ali é a assimetria de 'Melhor horário para te ligar' num site sem telefone para a família ligar.
- A disciplina dos blocos desativados com comentário de restauração no rodapé (RT, licença sanitária, CNES). É o que vai permitir religar cada um no dia em que existir, sem reinventar o texto nem errar a norma. Apagar os comentários para limpar o HTML seria perder a memória da decisão. Vale o mesmo para a escolha de 'regido pela' em vez de 'em conformidade com' a RDC 917/2024.
- A independência de JavaScript: os botões de WhatsApp com o endereço no HTML, os formulários com action e method. Qualquer reforma que introduza roteamento ou componente dinâmico tem que preservar isso, e a verificação com o script desligado continua sendo condição de publicação.
- A tipografia Figtree e a paleta pérola e terracota. A PESQUISA-mercado.md já decidiu com evidência: Montserrat aparece em 4 de 9 concorrentes, Figtree em nenhum, e o azul hospitalar com verde-água domina 8 sites conferidos. A direção atual já diferencia. Trocar seria perder diferenciação sem ganhar nada.
