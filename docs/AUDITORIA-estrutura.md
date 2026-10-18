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

---

# O que foi executado em 18/10/2026

A sócia autorizou corrigir **os três problemas que não dependiam de ninguém**. O
diagnóstico acima fica como estava: é o registro do que o site era antes. Esta seção
registra só o que mudou, e o que foi medido para provar que mudou.

## 1. O telefone voltou a existir

Eram **zero** `href="tel:"` da empresa em 22 páginas, enquanto a barra do topo promete
atendimento 24 horas e o formulário pergunta o melhor horário para ligar.

Nenhum número novo entrou. É o `(21) 97479-2051`, o mesmo que já estava nos 150 botões
de WhatsApp e nos três blocos de JSON-LD do index desde 17/10/2026.

Três pontos fixos em toda página, mais um:

| onde | quando aparece | rótulo |
|---|---|---|
| barra do topo | 720px para cima | `(21) 97479-2051` |
| barra fixa do rodapé | abaixo de 720px | **Ligar**, ao lado do WhatsApp |
| rodapé | sempre | `(21) 97479-2051` |
| cartão "Canais diretos" | só em contato.html | `(21) 97479-2051` |

Os dois primeiros se revezam no mesmo corte de 719px: quem está no celular tem o botão
grande embaixo, quem está no computador tem o número em cima. Nenhum dos dois repete o
outro, e a barra do topo não ganhou mais uma linha no celular.

O botão **Ligar** é `--petroleo-700` com letra branca: **7,40:1**, calculado pela
luminância relativa, não estimado. O WhatsApp ao lado dá 5,94:1. Os dois passam o
critério 1.4.3 da WCAG com folga.

Nenhuma palavra nova sobre prazo ou horário entrou junto. As cinco formulações
concorrentes de "24 horas" continuam exatamente como estavam, porque resolvê-las
depende da sócia.

## 2. As páginas de confiança deixaram de ser beco sem saída

**Nove links novos, em sete lugares**, todos dentro do `<main>` e nenhum em menu ou
rodapé:

| de | para | onde exatamente |
|---|---|---|
| sobre | segurança e seleção | no cartão "Você sabe quem entra na sua casa", que resume aquela página |
| sobre | preços | no cartão "Tudo por escrito", que fala de valores discriminados |
| segurança e seleção | preços | no fim de "O que este processo não garante" |
| preços | segurança e seleção | depois de "Sobre valores e contrato" |
| preços | como funciona | mesmo lugar |
| trabalhe conosco | formação de cuidadores | no compromisso "Treinamento continuado" |
| obrigado | como funciona, preços, segurança | bloco novo "Enquanto você espera", três links |

Saídas no corpo, antes e depois:

| página | antes | depois |
|---|---|---|
| sobre | 1 (só a migalha) | 3 |
| segurança e seleção | 3 | 4 |
| preços | 3 | 5 |
| obrigado | 1 | 4 |
| formação de cuidadores | recebia **0** links de corpo | recebe 1 |

Nada foi reescrito. Só links, nos lugares onde a própria página já falava do assunto
da outra.

## 3. As páginas órfãs entraram na navegação do computador

Estavam fora do menu de barra: segurança e seleção, o plano de saúde cobre, formação de
cuidadores e trabalhe conosco. As duas primeiras são, pela própria auditoria, as páginas
mais fortes do site.

O menu continua com seis itens. Dois deles viraram submenu, no padrão que "Serviços" já
usava:

```
Serviços ▾        ... + Formação de cuidadores
Como funciona ▾   Como funciona · Segurança e seleção
Preços ▾          Preços · O plano de saúde cobre?
Sobre · Dúvidas · Contato
```

"Trabalhe conosco" não entrou no menu porque **já estava** na barra de contato do topo,
visível em toda página de 720px para cima. Ele fala com o profissional, não com a
família, e repeti-lo nos dois lugares disputaria espaço com quem veio contratar.

Nenhum rótulo novo foi inventado: "Segurança e seleção" e "O plano de saúde cobre?" são
os mesmos nomes que o rodapé e o menu do celular já usam. A discordância entre o menu
("Preços") e o rodapé ("Como calculamos o valor") **continua aberta de propósito**, porque
resolvê-la depende de a sócia decidir antes se vai existir faixa de preço publicada.

### O que o submenu custou, e como foi pago

O botão de submenu não é link: sem JavaScript ele não abriria nada, e "Como funciona" e
"Preços" deixariam de ser alcançáveis pelo menu. Isso levou a resolver, de uma vez, uma
regra do `CLAUDE.md` que o site descumpria desde antes: **o menu tem que funcionar com o
script desligado.** Ver a seção seguinte.

## Dois defeitos antigos que apareceram na régua

Não estavam na auditoria porque auditoria se faz lendo, e estes só aparecem medindo.

**O cabeçalho passava da largura da página em qualquer janela entre 1040 e 1200px.**
O menu de barra aparecia a partir de 1040px, mas logo (270) + menu (692) + botão (179) +
vãos precisavam de 1171px. O botão "Pedir orçamento" ficava fora da tela e o site inteiro
rolava de lado: **146px medidos a 1040px no commit anterior**, antes de qualquer coisa
que eu tenha feito. Os dois submenus novos trouxeram duas setinhas e teriam levado para
176px.

Corrigido em duas frentes: os itens do menu fecharam 4px de cada lado (a altura de toque
de 44px continua intacta) e o corte subiu de 1040 para **1220px**, que é onde a conta
fecha com 23px de folga.

Medido nas 22 páginas, com a mesma régua nas duas versões:

| largura | commit anterior | agora |
|---|---|---|
| 1100px | **22 de 22 páginas rolando 205px** | 0 |
| 1400px | 0 | 0 |
| 768px | 6 páginas rolando 4px | as mesmas 6, os mesmos 4px |
| 390px | 0 | 0 |
| 320px | 0 | 0 |

As seis de 768px são `index`, `como-funciona`, `plano-de-saude-cobre-home-care`,
`servicos/tecnico-de-enfermagem`, `servicos/enfermagem-e-equipe-multidisciplinar` e
`servicos/remocao-de-pacientes`. Conferido nas duas versões: nada mudou nelas.

Abaixo de 1220px o cabeçalho passa a usar o botão **Menu**, que abre o painel com as 22
páginas. Em janelas entre 1040 e 1220 isso é visível: antes aparecia a barra de menu
quebrada, agora aparece o botão. É a troca que paga o fim da rolagem lateral.

**O controle "Texto" quebrava o cabeçalho no tamanho maior.** No tamanho "bem maior" a
fonte do menu cresce junto com a do texto, e o cabeçalho passava da página: 3px no commit
anterior, e teria virado 33px com os submenus. Agora o cabeçalho quebra em linha em vez de
empurrar: 0px de rolagem nos três tamanhos. Isso importa mais aqui do que na média dos
sites, porque quem usa o botão de texto maior é exatamente o público deste.

## O menu passou a funcionar sem JavaScript

O botão "Menu" sempre abriu o painel do celular por script, e o botão de submenu nunca foi
link. Com o script desligado, os dois eram controles que não fazem nada, e a navegação
inteira do cabeçalho sumia. O `CLAUDE.md` exige o contrário, e o item estava na lista de
testes de publicação. **Era uma regra descumprida desde antes desta madrugada.**

Agora, enquanto a marca `data-js="on"` não existir no `<html>`, o cabeçalho abre o menu
inteiro em lista única: o botão "Menu" some, o menu de barra aparece em qualquer largura,
os submenus achatam e os 17 links ficam todos visíveis. O cabeçalho também deixa de ser
fixo nesse estado, porque uma lista de 586px grudada no alto cobriria o site durante a
rolagem.

A marca é posta por um script de uma linha no `<head>` de cada página, **antes do primeiro
desenho da tela**. Se estivesse no `main.js`, que carrega com `defer`, quem tem JavaScript
veria o cabeçalho piscar na forma achatada antes de assumir a normal.

### A matriz de teste, medida nas 22 páginas

| estado | largura | rolagem lateral | links do menu | altura do cabeçalho |
|---|---|---|---|---|
| sem JavaScript | 320 | 0 | 17 de 17 | 715 |
| sem JavaScript | 390 | 0 | 17 de 17 | 586 |
| sem JavaScript | 768 | 4 (as seis de sempre) | 17 de 17 | 329 |
| sem JavaScript | 1100 | 0 | 17 de 17 | 243 |
| sem JavaScript | 1219 | 0 | 17 de 17 | 200 |
| sem JavaScript | 1220 | 0 | 17 de 17 | 200 |
| sem JavaScript | 1400 | 0 | 17 de 17 | 200 |
| com JavaScript | 1219 | 0 | botão Menu | 77 |
| com JavaScript | 1220 | 0 | barra de menu | 77 |
| com JavaScript, texto bem maior | 1100 | 0 | botão Menu | 77 |
| com JavaScript, texto bem maior | 1219 | 0 | botão Menu | 77 |
| com JavaScript, texto bem maior | 1220 | 0 | barra de menu | 126 |

Três leituras dessa tabela.

**Na travessia do corte, no tamanho de texto normal, o cabeçalho não muda de altura:**
77px de um lado, 77px do outro. O que muda é o botão Menu virar barra de menu.

**No tamanho de texto bem maior, ele passa de 77 para 126px ao cruzar 1220.** É a barra de
menu aparecendo e quebrando em duas linhas, porque a fonte do menu cresceu junto com a do
texto. Fica registrado: é o único salto que sobrou, não produz rolagem lateral, e a
alternativa seria manter o botão Menu até uma largura que o CSS não tem como calcular,
porque media query não enxerga tamanho de fonte.

**Sem JavaScript o cabeçalho tem a mesma altura em 1219, 1220 e 1400.** Para isso o botão
"Pedir orçamento" sai nesse estado: ele só aparece de 1220px para cima e faria o cabeçalho
crescer 68px de uma vez ao cruzar o corte. Contato já está na lista de links logo abaixo, e
os botões de WhatsApp da página continuam todos funcionando.

Cada link da lista achatada tem entre 39 e 45px de altura, acima do mínimo de 24.

Fica registrado um laço: **se um dia entrar uma Content-Security-Policy**, esse script de
uma linha precisa de hash ou nonce. Sem isso ele não roda, e o site inteiro passa a ser
servido no modo sem JavaScript.

## O que ficou de pé e precisa ser dito

**As seis páginas que rolam 4px a 768px continuam rolando.** Medidas de novo hoje, nas
duas versões: os mesmos 4px, nas mesmas seis. A pendência segue aberta.

## O que NÃO foi tocado, de propósito

Tudo que depende de uma decisão da sócia:

- as 40 afirmações sobre a enfermeira responsável técnica, em 13 páginas;
- as cinco formulações concorrentes de prazo, inclusive a que está dentro do JSON-LD;
- o `priceRange` órfão de `index.html:102`;
- a ausência de faixa de preço;
- "São quatro serviços" em servicos.html contra os seis do menu;
- as promessas operacionais sem processo que as sustente;
- os números sem fonte e as duas comparações com o concorrente;
- os quatro nomes da página de dúvidas e os dois da de preços.

E tudo que está na lista "O que NÃO mudar" acima continua intacto, palavra por palavra.
