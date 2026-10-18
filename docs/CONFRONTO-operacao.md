# Confronto: a operação real contra o que o site publica

Feito em 18/10/2026, logo depois de a sócia responder o questionário. Cinco leitores
independentes cruzaram as 22 páginas com as respostas de `RESPOSTAS-operacao.md`, e cada
contradição passou por alguém encarregado de derrubá-la. **Nenhuma página foi alterada.
Isto é diagnóstico.**

As respostas são o fato. O site é a alegação. Onde os dois divergem, quem está errado é
o site.

## O resumo em cinco linhas

- **Nove contradições**, oito delas publicadas: três de risco jurídico, três sanitário,
  duas trabalhista. A nona está num comentário interno do HTML. A mais grave não é sobre
  serviço: é sobre vínculo.
- **Vinte e oito achados ao todo:** 9 contradições, 11 pontos que dependem de decisão da
  sócia e 8 coisas que as respostas destravam ou confirmam.
- **Quatro dos sete serviços não existem hoje** e têm página própria vendendo em presente
  do indicativo, com botão de contratação e dado estruturado de oferta ativa.
- **A espinha do argumento de confiança não se sustenta:** o site diz que a enfermeira
  responsável técnica supervisiona o dia a dia; a resposta diz que quem acompanha a
  execução é o próprio profissional.
- **Dois blocos desativados podem voltar**, assim que os números existirem. É a primeira
  vez que algo se destrava em vez de travar.
- **Um comentário interno do HTML virou mentira** e vai contaminar a próxima decisão de
  quem o ler.

---

## Risco jurídico

### A página de remoção de pacientes vende frota, equipe e logística que não existem

**CONTRADIZ o que o site publica**

**Onde:** servicos/remocao-de-pacientes.html:293 "Remoção de pacientes no Rio de Janeiro"; :294 "transporte em maca ou cadeira de rodas, com equipe que sabe mobilizar sem machucar, do leito do hospital até a cama de casa"; :296 botão "Pedir uma remoção"; :331-338 "O que está incluído" com "Veículo adaptado com maca ou espaço para cadeira de rodas", "Equipe treinada em mobilização e transferência segura", "Retirada do leito e acomodação no destino"; :410 "Atendemos, com equipe dimensionada para isso"; :421 "A alta saiu hoje?"; JSON-LD em :44 declara Service "Remoção de pacientes" com areaServed Rio, Niterói, Duque de Caxias e Nova Iguaçu.

**A resposta que colide:** Resposta 5: remoção de pacientes está marcada como APENAS PLANEJADA. Resposta 14, palavras dela: "Vamos começar oferecendo serviços de cuidador de idosos e acompanhante hospitalar".

**Por que importa:** A página não sugere, ela afirma. Descreve veículo, equipe e procedimento em presente do indicativo e termina com um botão de contratação imediata. Pelo art. 30 do Código de Defesa do Consumidor a oferta publicada obriga o fornecedor e integra o contrato, e pelo art. 35 a família pode exigir o cumprimento forçado. Uma alta hospitalar marcada para hoje, confiando nessa página, vira inadimplemento no pior momento possível. Some-se que transporte de paciente em maca tem exigência sanitária própria, distinta da atenção domiciliar da RDC 917/2024.

**O que fazer:**

ACEITO O ACHADO, REJEITO A CORRECAO PROPOSTA EM TRES PONTOS.

Defeito 1 do 410. Contei as referencias: todos os 22 arquivos publicos mais os dois modelos citam remocao-de-pacientes.html, tres vezes cada um (menu do cabecalho, menu mobile e rodape), alem de links extras em alta-hospitalar.html:482, precos.html:161, servicos.html:124, index.html:367, areas-de-atendimento.html:124 e perguntas-frequentes.html:289. Responder 410 cria mais de 69 links quebrados e viola o item 5 do roteiro de publicacao do CLAUDE.md ("zero link quebrado"). Alem disso 410 significa foi embora de vez, e a resposta 5 diz planejado, nao extinto: a propria resposta HTTP viraria afirmacao falsa.

Defeito 2 do SAMU. A pagina hoje acerta ao separar emergencia de transporte programado. Mandar ao SAMU 192 a familia que procura remocao programada (hemodialise, quimioterapia, consulta, mudanca de endereco) e orientacao errada e uso indevido do servico de urgencia. O aviso de emergencia deve ficar como ja esta, nao virar a unica saida da pagina.

Defeito 3 do JSON-LD. Remover so o Service nao basta. O FAQPage logo abaixo (a partir da linha 104) repete "Atendemos, com equipe dimensionada para isso" e as quatro perguntas em presente do indicativo. E tambem declaracao de oferta lida por maquina.

CORRECAO QUE EU FARIA

A. Manter a URL viva, trocar o conteudo.
Sem mexer no .htaccess e sem tirar a linha 46 do sitemap.xml. Adicionar na pagina <meta name="robots" content="noindex, follow">, substituindo o "index, follow" da linha 16: para de disputar a busca por remocao no Rio enquanto o servico nao existe, e nao quebra navegacao nenhuma.

B. Cabecalho do documento. Trocar title, meta description, og:title e og:description (linhas 13, 14, 25 e 26), que hoje vendem o servico na busca e na previa do WhatsApp mesmo que o corpo mude. Sugestao de title: "Remocao de pacientes | Apoio Vital". Description: "A Apoio Vital ainda nao oferece remocao de pacientes. Veja o que ja atendemos hoje."

C. JSON-LD. Apagar os dois blocos, Service (linhas 71 a 103) e FAQPage (104 ao fim do bloco). Manter apenas o BreadcrumbList.

D. Corpo. Substituir tudo entre <section class="topo-pagina"> e o fim da faixa-cta por um bloco unico, sem nenhum botao de contratacao de remocao. Texto que nao inventa nada:

  Titulo: "A Apoio Vital ainda nao faz remocao de pacientes"
  Paragrafo: "Hoje atendemos cuidador de pessoa idosa, tecnico de enfermagem e acompanhante hospitalar. A remocao de pacientes nao esta entre os servicos que oferecemos, e nao queremos que voce descubra isso no dia da alta."
  Paragrafo: "Se a alta ja tem data, procure uma empresa de remocao ou pergunte ao servico social do hospital, que costuma ter contatos conferidos. Se voce tambem vai precisar de alguem em casa depois que a pessoa chegar, isso a gente faz."
  Manter o aviso de emergencia que ja existe, com SAMU 192 e Bombeiros 193, com a mesma redacao.
  Um unico link, para servicos.html, sem botao de WhatsApp proprio da pagina. Os botoes globais (whats-flutuante e barra-acao, data-origem GLB) podem ficar: o texto deles e sobre cuidado em casa, nao sobre remocao.

E. Apagar os dois botoes REM-01 (linha 296) e REM-02 (linha 421) e o aviso "Combina com o resto do cuidado", que promete enfermeira acompanhando a remocao, servico duplamente inexistente.

F. Nos 24 arquivos, tirar "Alta hospitalar, transferencia, consultas e exames" do subtitulo do item de servico (padrao que aparece em servicos.html:124, index.html:367, precos.html:161, areas-de-atendimento.html:124, perguntas-frequentes.html:289 e alta-hospitalar.html:188), porque e descricao de servico em operacao. Tirar tambem o link "Ver remocao de pacientes" de alta-hospitalar.html:482, que empurra justamente quem esta saindo do hospital. Os links de menu e rodape podem ficar apontando para a pagina honesta, ou sair de uma vez, desde que saiam dos 24 arquivos juntos.

G. Nao entra: nenhuma data de inicio, nenhum "em breve" com prazo, nenhum numero de licenca, nenhum nome de empresa parceira. A socia nao informou nada disso e publicidade vincula.

H. Tratar as quatro paginas apenas planejadas no mesmo passo e com o mesmo padrao: remocao-de-pacientes.html, enfermagem-e-equipe-multidisciplinar.html, aluguel-de-equipamento.html e formacao-de-cuidadores.html. Corrigir so esta cria tres solucoes diferentes para o mesmo problema.

I. Perguntar a socia, sem escrever nada no site antes da resposta: a licenca sanitaria que ela diz ter (resposta 13) cobre transporte sanitario? Remocao em maca tem exigencia propria, separada da atencao domiciliar da RDC 917/2024. Enquanto nao houver resposta, a pagina nao afirma nem nega nada sobre isso.

---

### "Urgência tem resposta a qualquer hora" aparece como promessa assistencial, e só existe primeiro contato no WhatsApp

**CONTRADIZ o que o site publica**

**Onde:** como-funciona.html:83, index.html:326 e perguntas-frequentes.html:248, barra do topo, idêntica nas 22 páginas: "Urgência tem resposta a qualquer hora, todos os dias, em todo o Rio de Janeiro". index.html:466: "Recebeu alta e precisa resolver hoje? Chame no WhatsApp. Tem gente atendendo a qualquer hora, inclusive de madrugada." index.html:500: "Urgência tem resposta a qualquer hora" / "Inclusive de madrugada, fim de semana e feriado." index.html:774, faixa de indicadores: "24h" / "Urgência tem resposta a qualquer hora, inclusive de madrugada e em feriado". Rodapé das quatro páginas (como-funciona.html:527, seguranca-e-selecao.html:410, perguntas-frequentes.html:634, index.html:1050): "Urgência tem resposta a qualquer hora".

**A resposta que colide:** Resposta 9: "24 horas" significa apenas o primeiro contato no WhatsApp. Ela não marcou contratação a qualquer hora nem início de atendimento assistencial a qualquer hora.

**Por que importa:** A palavra "urgência" numa empresa de saúde não é lida como "alguém lê a sua mensagem". É lida como "alguém resolve". A família que manda mensagem às 3h com a mãe passando mal entende que haverá resposta assistencial, e não há. Oferta publicitária vincula o fornecedor pelos arts. 30 e 35 do CDC, e a frase está em todas as páginas, no topo e no rodapé, o que a torna a promessa mais repetida do site.

**O que fazer:**

Princípio: trocar promessa de resolução por descrição de canal, preservando o que a sócia confirmou (há escala noturna, de fim de semana e de feriado) e sem criar número novo.

1. Texto substituto, único, para as 48 ocorrências de barra-contato e rodapé mais as variantes de corpo de texto:
   Barra-contato (24 arquivos, inclusive _modelo.html:63 e _modelo-servico.html:63): trocar "Urgência tem resposta a qualquer hora, todos os dias, em todo o Rio de Janeiro" por "WhatsApp para primeiro contato, todos os dias, em todo o Rio de Janeiro". Observação de escopo: "em todo o Rio de Janeiro" colide com a resposta 12, que se contradiz, e é objeto de outro achado. Não resolver aqui, mas também não reescrever essa parte por conta própria.
   Rodapé (24 arquivos, inclusive os dois moldes): trocar o <small> "Urgência tem resposta a qualquer hora" por "Primeiro contato a qualquer hora, todos os dias".

2. index.html:466: trocar "Recebeu alta e precisa resolver hoje? Chame no WhatsApp. Tem gente atendendo a qualquer hora, inclusive de madrugada." por "Recebeu alta e precisa falar com alguém hoje? Chame no WhatsApp: o primeiro contato é atendido a qualquer hora, inclusive de madrugada."

3. index.html:500, cartão do hero, as duas frases de uma vez: trocar "Urgência tem resposta a qualquer hora / Inclusive de madrugada, fim de semana e feriado. O atendimento pode começar em 24 horas." por "Primeiro contato a qualquer hora / Inclusive de madrugada, fim de semana e feriado. Temos profissionais para plantão noturno, de fim de semana e de feriado. O prazo para iniciar um atendimento novo depende do caso e é informado na avaliação." Isso mantém o que a resposta 9 confirma e elimina o prazo de 24 horas, que ela não confirmou.

4. index.html:774, faixa de indicadores: remover o indicador inteiro. Não substituir por outro número. Publicidade vincula e nenhum número novo entra sem confirmação da sócia. A faixa continua com três indicadores (2, 0, 100%), e o CSS de .faixa-confianca precisa ser conferido em 1400 px e 390 px depois da remoção.

5. Páginas que o revisor não listou e que carregam a mesma promessa:
   contato.html:14 e :26, meta description e og:description: trocar "urgência tem resposta a qualquer hora" por "primeiro contato pelo WhatsApp a qualquer hora".
   contato.html:357: trocar "Urgência tem resposta a qualquer hora. Se o seu caso não pode esperar, não use o formulário: chame no WhatsApp, inclusive de madrugada, fim de semana e feriado." por "Se o seu caso não pode esperar, não use o formulário: chame no WhatsApp, que o primeiro contato é atendido a qualquer hora, inclusive de madrugada, fim de semana e feriado."
   contato.html:383: trocar a linha da lista por "WhatsApp: primeiro contato a qualquer hora, todos os dias".
   contato.html:408: trocar por "Não espere o formulário. O primeiro contato pelo WhatsApp é atendido a qualquer hora, inclusive de madrugada e em feriado."
   precos.html:380: trocar "Urgência tem resposta a qualquer hora; os outros contatos, no horário do escritório." por "O primeiro contato pelo WhatsApp é atendido a qualquer hora; os outros canais, no horário do escritório." Atenção: a frase seguinte, "Uma enfermeira entende o quadro", é outro achado (resposta 8 diz que quem responde é "outro profissional habilitado", não enfermeiro). Não misturar, mas não reescrever a frase como se estivesse validada.
   sobre.html:269, linha "Atendimento" da tabela: trocar para "WhatsApp. Primeiro contato a qualquer hora, todos os dias".
   obrigado.html:191: trocar "fale agora no WhatsApp, que a gente atende a qualquer hora, inclusive de madrugada. Mensagem escrita de madrugada a gente responde logo cedo." por "fale agora no WhatsApp. O primeiro contato é atendido a qualquer hora, inclusive de madrugada." A segunda frase sai porque contradiz a primeira; se a sócia confirmar que mensagem de madrugada é respondida só de manhã, então o texto certo é o inverso e a promessa de "qualquer hora" cai do site inteiro. Esta é uma pergunta a fazer a ela antes de publicar.
   obrigado.html:224: trocar "Precisa de atendimento imediato? Chame no WhatsApp. Urgência tem resposta a qualquer hora, todos os dias." por "Precisa falar com alguém agora? Chame no WhatsApp: primeiro contato a qualquer hora, todos os dias."
   servicos/acompanhante-hospitalar.html:498: trocar "Urgência tem resposta a qualquer hora, todos os dias." por "Primeiro contato a qualquer hora, todos os dias."

6. Não tocar, para não ampliar escopo indevidamente: index.html:472 "Plantão 24 horas" e todas as entradas de menu "Diurno, noturno, plantão 24h ou integral", que descrevem modalidade de escala e são verdadeiras pela resposta 5; servicos.html:366 e precos.html:294 e :295, que explicam 12x36 e revezamento. Usar busca literal por "rgência tem resposta a qualquer hora" e pelos trechos acima, nunca regex em "24h" ou "24 horas".

7. Achados vizinhos que surgiram na verificação e pertencem à mesma varredura, mas não a este item: servicos/acompanhante-hospitalar.html:113 e :464 ("em boa parte dos casos conseguimos colocar alguém no leito ainda no mesmo dia") e as três ocorrências de "começar em 24 horas" em como-funciona.html:14, :26, :221, index.html:735, alta-hospitalar.html:105 e :475, perguntas-frequentes.html:230 e :548, obrigado.html:206. Todas colidem com "o prazo depende do caso" da resposta 9.

8. Antes de publicar, rodar os cinco testes do CLAUDE.md e conferir que a contagem de "rgência tem resposta a qualquer hora" caiu de 60 para 0, inclusive nos dois moldes.

---

### "O atendimento pode começar em 24 horas" é prazo publicado, e o prazo real depende do caso

**CONTRADIZ o que o site publica**

**Onde:** index.html:500: "O atendimento pode começar em 24 horas." index.html:735: "Se a urgência for de hoje, esse caminho inteiro cabe em 24 horas." como-funciona.html:221: mesma frase. como-funciona.html:14 e :26, meta description e og:description: "Da primeira ligação ao primeiro plantão em até 24 horas". perguntas-frequentes.html:548 e :230 (JSON-LD): "Em caso de urgência, como uma alta hospitalar, costuma ser possível começar em 24 horas. Sem urgência, de dois a três dias".

**A resposta que colide:** Resposta 9: o prazo para começar um atendimento novo depende do caso. Nenhum prazo foi afirmado.

**Por que importa:** Publicidade vincula, e o site transforma um prazo que a sócia não confirmou em compromisso exigível, inclusive na descrição que aparece no Google e no cartão do WhatsApp. O "dois a três dias" da página de dúvidas tem o mesmo problema. A família que contrata por causa da alta de amanhã escolhe pelo prazo, e o descumprimento vira pedido de devolução e reclamação pública.

**O que fazer:**

Aceito o achado e mantenho o princípio da correção (tirar o número onde ele significa prazo de início), mas a correção proposta precisa de três ajustes: deixa de fora quatro ocorrências publicadas, quebra o par texto visível/JSON-LD se aplicada como está, e o texto substituto que sugere cria uma promessa nova.

O QUE REMOVER, inventário completo (caminhos a partir de ):

1. index.html:500 ,  apagar apenas a última frase, "O atendimento pode começar em 24 horas." O cartão continua verdadeiro e útil com "Urgência tem resposta a qualquer hora. Inclusive de madrugada, fim de semana e feriado.", que é exatamente o que a resposta 9 confirma.
2. index.html:735 ,  trocar por "Quatro passos, e nenhum deles custa nada até você decidir. Quando o caso é urgente, a gente encurta o caminho sem pular etapa."
3. como-funciona.html:221 ,  substituir por "Ninguém precisa decidir nada na primeira conversa, e nada custa até você aprovar a proposta. O tempo até o primeiro plantão depende do caso, e a gente diz o seu assim que entender a situação."
4. como-funciona.html:14 e :26 ,  as duas metas, com texto idêntico nas duas para não dessincronizar: "Como funciona o atendimento domiciliar da Apoio Vital: conversa com enfermeira, avaliação em casa sem custo, plano de cuidados por escrito, adaptação e cobertura de falta." Sem número.
5. perguntas-frequentes.html:548 (visível) E :230 (JSON-LD FAQPage) ,  obrigatoriamente no mesmo commit e com texto idêntico, senão entra divergência de FAQPage e a regra de zero JSON-LD inválido do CLAUDE.md cai. Texto para os dois: "Depende do caso. Quando há alta marcada, a gente prioriza e encurta o caminho. O que leva tempo é escolher a pessoa certa para o perfil da sua família, e essa é a parte que não vale apressar. Na primeira conversa a gente já diz o prazo do seu caso."

AS QUATRO QUE O REVISOR NÃO LISTOU E TÊM O MESMO DEFEITO:

6. obrigado.html:206 ,  "Se aprovar, o atendimento pode começar em 24 horas." Trocar por "Se aprovar, combinamos a data de início junto com você."
7. alta-hospitalar.html:475 (visível) E :105 (JSON-LD) ,  "costuma ser possível começar em 24 horas". Mesmo par, mesmo commit. Texto: "Depende do caso, e por isso quanto antes você avisar, melhor, mesmo que a data da alta ainda possa mudar. A gente reserva a escala e confirma quando o hospital liberar." A segunda metade já estava lá e é verdadeira: a resposta 10 confirma escala reserva.
8. servicos/acompanhante-hospitalar.html:464 (visível) E :113 (JSON-LD) ,  "em boa parte dos casos conseguimos colocar alguém no leito ainda no mesmo dia" é o mesmo prazo com outro nome. Trocar por "Para urgência, chame no WhatsApp. A gente atende a qualquer hora e diz na hora o que é possível para o seu caso."
9. alta-hospitalar.html:312 e servicos/tecnico-de-enfermagem.html:472 ,  trocar "começar no mesmo dia em que ela chega" por "chegar com a casa e a escala já preparadas".
10. como-funciona.html:248 (título "As primeiras 48 horas"), :244 (id="primeiras-48h") e :230 (texto do índice). Além de ser mais um prazo publicado, contradiz as 24 horas da linha 221 na mesma página. Trocar título e texto do índice para "Do primeiro contato ao primeiro plantão" e o id para "primeiro-plantao". O id só é referenciado em como-funciona.html:230, verifiquei, então não quebra link interno.

O QUE NÃO PODE SER VARRIDO JUNTO, e a correção proposta não avisa: "24h" e "plantão 24 horas" como MODALIDADE DE ESCALA aparecem em mais de duas dezenas de lugares (cartão de modalidades em index.html:489, selo em index.html:472, submenu de todas as páginas, tabelas de precos.html e servicos/cuidador-de-idosos.html:417). Isso é duração de plantão na casa, não prazo de início, e a resposta 9 confirma que há profissional para plantão noturno, fim de semana e feriado. Igualmente fica de pé o indicador de index.html:773, "24h / Urgência tem resposta a qualquer hora", que é tempo de RESPOSTA, o único sentido que a sócia confirmou. Quem executar precisa editar ponto a ponto, nunca por substituição global de "24 horas".

ONDE DISCORDO DO TEXTO SUBSTITUTO PROPOSTO: "o prazo de início depende do caso e é informado na avaliação" muda a promessa de lugar em vez de removê-la, e ainda a joga para depois da visita em casa, o que é pior para quem está decidindo hoje. Publicidade vincula também aí. O substituto deve dizer que o prazo depende do caso e que a empresa informa o prazo na primeira conversa, que é o único momento que a resposta 9 sustenta, já que o primeiro contato no WhatsApp é atendido a qualquer hora.

PENDÊNCIA A REGISTRAR, não a publicar: anotar em docs/PREENCHER.md que a linha 83 da tabela de números ("24 horas, prazo para iniciar o atendimento") foi para a sócia e voltou SEM confirmação, e que nenhum número de prazo de início volta ao site antes de ela fixar um que a operação cumpra. A mesma tabela tem outros dois números da mesma família que a resposta 9 não cobriu e continuam em aberto: as "4 horas" para repor um substituto e as "2 horas" de retorno de contato, esta publicada em obrigado.html:14. Não são objeto deste achado, mas caem na mesma regra.

---

## Risco trabalhista

### A página de vagas promete CLT a quem vai ser PJ ou autônomo

**CONTRADIZ o que o site publica**

**Onde:** trabalhe-conosco.html:251-252, "Registro regular" e "Contratação formal, com encargos, férias e décimo terceiro. Você não é autônomo disfarçado." A mesma promessa está nas meta descriptions, trabalhe-conosco.html:14 e 26, "Pagamento em dia, registro regular, escala previsível e suporte de enfermagem."

**A resposta que colide:** Resposta 3: os profissionais são contratados como pessoa jurídica e autônomos pagos pela Apoio Vital. Ela não marcou CLT.

**Por que importa:** Encargos, férias e décimo terceiro são efeitos do contrato de emprego. Prometer os três e negar o autônomo disfarçado, contratando PJ e autônomo, é afirmação falsa feita pela própria empresa, publicada, datada e arquivável. Numa reclamação trabalhista essa frase não é publicidade, é confissão escrita de que a empresa sabia qual era a natureza da relação e ofereceu outra. Ela sustenta sozinha o pedido de reconhecimento de vínculo e o de danos, e o site fica provando contra quem o publicou.

**O que fazer:**

Aceito o achado, mas a correção proposta precisa de três ajustes para não quebrar a página nem inventar fato.

1. Não "retirar o cartão inteiro" sem mexer no título. O H2 da seção, em trabalhe-conosco.html:243, diz "Seis compromissos com quem trabalha aqui" e a grade tem exatamente seis cartões. Apagar o de "Registro regular" deixa cinco cartões sob um título que promete seis. Duas saídas: trocar o H2 para "Cinco compromissos com quem trabalha aqui" e remover as linhas 250 a 253, ou substituir o cartão por outro que diga só o que a sócia confirmou.

2. Não deletar as meta descriptions, reescrever. Página sem meta description e sem og:description é perda de SEO e de pré-visualização no WhatsApp, que é por onde o candidato chega. Basta tirar o trecho falso: nas linhas 14 e 26, trocar "Pagamento em dia, registro regular, escala previsível e suporte de enfermagem" por "Pagamento em dia, escala previsível e escopo de função por escrito". Fica a observação de que "suporte de enfermagem" nessa mesma frase depende da resposta 13, porque o responsável técnico ainda está em pedido de andamento, e isso pertence a outro achado.

3. O texto substituto sugerido pelo revisor inventa fato. Ele propõe prometer "contrato escrito de prestação de serviços com o profissional, valor e prazo de pagamento definidos, escopo por escrito". A resposta 11 diz que a empresa já opera, mas sem contrato formal, e a resposta 10 diz que o procedimento escrito ainda não existe e será criado. Então nenhuma das três promessas está confirmada hoje, e colocá-las no ar repete o erro que se está corrigindo, só que com outra palavra. Enquanto a sócia não confirmar por escrito que já existe contrato assinado com o profissional, o caminho seguro é reduzir para cinco cartões.

Se ela quiser manter seis, o único conteúdo sustentado pelas respostas 2, 3 e 4 é que o profissional é pago pela Apoio Vital e não cobra da família, e que a negociação com a família é feita pela empresa. Um cartão possível, a ser confirmado por ela antes de publicar: título "Quem paga é a empresa", texto "Você recebe da Apoio Vital, não da família. Valor e condições são combinados com você antes do primeiro plantão, e quem negocia com o cliente somos nós." Nenhum número, nenhum prazo, nenhuma palavra sobre encargos, férias, décimo terceiro, carteira ou registro em carteira entra enquanto a contratação for PJ ou autônomo.

4. O mesmo defeito está publicado em outras seis páginas, nas mesmas palavras, e corrigir só trabalhe-conosco.html deixa a confissão no ar. Não é ampliação de escopo, é a mesma frase: index.html:292 e 942, perguntas-frequentes.html:94 e 416, como-funciona.html:404 e 405, precos.html:364 e servicos/cuidador-de-idosos.html:153 e 513 afirmam "com registro regular" e "Encargos, férias, décimo terceiro e INSS são da empresa". As ocorrências 292, 94 e 153 estão dentro de JSON-LD, então são dado estruturado indexável e precisam ser alteradas junto com o texto visível, sob pena de o site se contradizer para o buscador. Nessas páginas a função da frase é tranquilizar a família quanto a vínculo, e a parte verdadeira pode ficar: o profissional é contratado e remunerado pela Apoio Vital, que responde perante a família, com contrato de prestação de serviços entre a família e o CNPJ. O que sai é "com registro regular" e a lista "encargos, férias, décimo terceiro". Sobre INSS, não afirmar nada antes de o contador confirmar o recolhimento como contribuinte individual, porque é o único item da lista que pode ser verdadeiro no modelo atual e publicá-lo errado custa o mesmo que publicar os outros.

---

### Cinco páginas garantem à família que encargos, férias, décimo terceiro e INSS são da empresa

**CONTRADIZ o que o site publica**

**Onde:** index.html:292 e 942, "Encargos, férias, décimo terceiro e INSS são nossos"; como-funciona.html:404-405, "O profissional é contratado e remunerado pela Apoio Vital, com registro regular" e "Encargos, férias, décimo terceiro e INSS são da empresa"; perguntas-frequentes.html:94 e 416; precos.html:349-350, linhas "Quem é o empregador: A empresa" e "Encargos, férias, 13º e INSS: Por conta da empresa"; precos.html:364, "o profissional é nosso, com registro regular"; servicos/cuidador-de-idosos.html:153 e 513.

**A resposta que colide:** Resposta 3, PJ e autônomos, não CLT. Resposta 2 confirma apenas que a Apoio Vital assina o contrato, recebe o pagamento e responde perante a família.

**Por que importa:** É a razão que o site dá para a família pagar mais caro do que pagaria contratando direto, e ela não existe hoje. Vale em duas frentes. Para o consumidor, é publicidade enganosa por afirmação, art. 37 do Código de Defesa do Consumidor, e vincula por força dos arts. 30 e 35: a família pode exigir o cumprimento. Para a Justiça do Trabalho, é a empresa declarando em público que se considera empregadora, o que arrasta a família para o polo passivo como tomadora de serviço quando o profissional reclamar.

**O que fazer:**

ACEITO O ACHADO, COM TRÊS AJUSTES NA CORREÇÃO.

1) FALTA A NONA OCORRÊNCIA, E É A PIOR
trabalhe-conosco.html:250-252, cartão "Registro regular": "Contratação formal, com encargos, férias e décimo terceiro. Você não é autônomo disfarçado."
É a empresa declarando ao próprio profissional, em público, que ele não é autônomo. Pela resposta 3, ele é. Numa reclamação trabalhista essa frase é prova pré-constituída do fato que o reclamante precisaria provar: o site da empregadora afirmando a pessoalidade e a formalidade do vínculo. Pior que as oito voltadas à família.
Trocar por: título "Contrato e pagamento pela Apoio Vital" / texto "Você presta serviço contratado pela Apoio Vital, como pessoa jurídica ou autônomo, com valor e data de pagamento definidos em contrato." Apagar "Você não é autônomo disfarçado". Tirar "registro regular" das meta descriptions trabalhe-conosco.html:14 e :26.

2) NÃO APAGAR AS DUAS LINHAS DA TABELA EM precos.html
A coluna da esquerda é verdadeira e é o aviso de consumo que mais importa: na contratação direta acima de dois dias por semana, a família vira empregadora doméstica pela LC 150/2015 e deve encargos, férias, 13º, FGTS e INSS. Falso é só o que a coluna da direita afirma. Apagar as linhas inteiras joga fora fato verdadeiro e deixa a família com menos informação.
Corrigir a coluna da direita:
- "Quem é o empregador" → linha "Com quem é o seu contrato" | "Com o profissional" | "Com a Apoio Vital, CNPJ"
- "Encargos, férias, 13º e INSS" → linha "Encargos trabalhistas na sua conta" | "Sim, se configurar vínculo doméstico, LC 150/2015" | "Não: você contrata a empresa, não a pessoa"
Concordo com o revisor que o título "Sem vínculo empregatício para a sua família" fica. Ele continua verdadeiro e fica mais verdadeiro depois da correção.

3) FRASE SUBSTITUTA PARA AS SETE OCORRÊNCIAS VOLTADAS À FAMÍLIA
(index.html:292 e 942, como-funciona.html:404-405, perguntas-frequentes.html:94 e 416, precos.html:364, cuidador-de-idosos.html:153 e 513)
"O profissional é selecionado e remunerado pela Apoio Vital. O contrato de prestação de serviços é entre a sua família e o nosso CNPJ, e é a Apoio Vital que responde perante você pelo serviço. A sua família não contrata nem paga o profissional."
Só isso, que é exatamente o que as respostas 2 e 3 autorizam. Manter o parágrafo "não prometemos risco zero", que permanece verdadeiro. Em precos.html:364, preservar a frase da LC 150/2015 e trocar apenas "o profissional é nosso, com registro regular" pelo texto acima.
Não reaproveitar a expressão "registro regular" em nenhuma das nove. Se o que se quer dizer é registro ativo no COREN do técnico de enfermagem, escrever "registro ativo no conselho de classe"; caso contrário, sair.

RESSALVA PARA A SÓCIA, nas mesmas frases reescritas
A resposta 11 diz que a empresa já opera "sem contrato formal". As frases que estou reescrevendo afirmam "contrato por escrito" e "nota fiscal em todos os atendimentos". Não invento fato nem apago: fica registrado que essas duas afirmações precisam de confirmação antes de serem republicadas, sob pena de cair no mesmo art. 37 do CDC.

ADJACENTE, OUTRO ACHADO, FORA DESTE ESCOPO
precos.html:356, linha "Supervisão de enfermagem | Não existe | Enfermeira responsável técnica". A resposta 13 diz que o responsável técnico é "pedido em andamento" e a 8 diz que quem responde é "outro profissional habilitado", não enfermeiro. Linha publicada, fora de comentário.

---

### O site publica, somados, todos os elementos de relação de emprego descritos na resposta 4

**PRECISA de decisão da sócia**

**Onde:** seguranca-e-selecao.html:233, "Nenhum profissional entra na casa de um cliente sem ter passado por todas. Não existe exceção por urgência"; seguranca-e-selecao.html:258, entrevista técnica conduzida pela empresa; seguranca-e-selecao.html:264, treinamento interno "Antes de assumir escala"; trabalhe-conosco.html:256, "Você sabe com antecedência onde vai trabalhar e em qual turno. Mudança de última hora é exceção, não método"; sobre.html:310, "Se um profissional faltar, acionamos o substituto".

**A resposta que colide:** Resposta 4: seleção, horário e escala, distribuição de plantão, avaliação e substituição são todos da Apoio Vital. Resposta 3: o vínculo é PJ e autônomo.

**Por que importa:** Seleção pela empresa, treinamento obrigatório antes de assumir, escala e turno definidos pela empresa, avaliação pela empresa e substituição decidida pela empresa são, juntos, pessoalidade, não eventualidade, onerosidade e subordinação, os quatro requisitos dos arts. 2º e 3º da CLT. Nenhuma redação de site resolve isso, porque o que decide reconhecimento de vínculo é a realidade da prestação, e a realidade está descrita pela própria sócia na resposta 4. O site apenas documenta com data e endereço fixo.

**O que fazer:**

Levar a resposta 4 a um advogado trabalhista antes de publicar qualquer versão nova destas páginas. São dois caminhos, e a escolha é da sócia: mudar a operação para que o profissional mantenha autonomia real sobre agenda e possa se fazer substituir, ou reconhecer que o modelo é de emprego e contratar sob a CLT. Enquanto a decisão não vier, não acrescentar nenhuma frase nova sobre controle de escala, substituição ou avaliação, e não apagar as existentes sem orientação, porque elas descrevem a prática atual.

---

### O cadastro de candidatos não pergunta nada do modelo PJ e a página não diz qual é o vínculo

**PRECISA de decisão da sócia**

**Onde:** trabalhe-conosco.html:286-290, tabela "O que pedimos, por função", que lista documento com foto, comprovante de residência, certificado, antecedentes e carteira do COREN; trabalhe-conosco.html:336-347, campo "Função pretendida"; trabalhe-conosco.html:359-369, campo "Disponibilidade".

**A resposta que colide:** Resposta 3: contratados como pessoa jurídica e autônomos pagos pela Apoio Vital.

**Por que importa:** Quem se cadastra hoje acredita estar se candidatando a emprego, porque a página inteira diz isso. Descobrir no momento da proposta que precisa abrir MEI ou emitir recibo é frustração previsível, e é o tipo de divergência entre anúncio e contratação que alimenta tanto reclamação trabalhista quanto queixa de má-fé. Além disso, a tabela não pede nada do que o modelo PJ exige, de modo que a seleção começa incompleta.

**O que fazer:**

Decisão da sócia sobre duas coisas. Primeira: se o modelo PJ se confirma, a página precisa dizer com clareza, acima do formulário, que a contratação é por prestação de serviços e qual é a forma de pagamento, e a tabela precisa pedir CNPJ ou MEI ativo. Segunda: se a intenção é migrar para CLT quando a operação crescer, a página não pode antecipar essa fase. Nenhuma das duas é escolha de redação.

---

## Risco sanitário

### A página de aluguel de equipamento anuncia estoque, entrega e montagem, inclusive de itens sob vigilância sanitária

**CONTRADIZ o que o site publica**

**Onde:** servicos/aluguel-de-equipamento.html:256 "Aluguel de cama hospitalar e equipamento no Rio"; :257 "Alugar resolve, e a gente leva, monta e ensina a usar"; :259 botão "Ver disponibilidade"; :275 "<h2>Equipamento disponível</h2>"; :276 "Entrega, montagem e orientação de uso fazem parte. Ninguém recebe uma caixa na portaria e se vira sozinho"; :280-329 seis categorias descritas como existentes; :335 "Alguns itens, como concentrador de oxigênio e aspirador, só são instalados com prescrição"; :353-359 "Entrega e montagem com hora marcada", "Troca se a necessidade mudar", "Retirada quando não precisar mais".

**A resposta que colide:** Resposta 5: aluguel de equipamento está marcado como APENAS PLANEJADO.

**Por que importa:** O título da seção é literalmente "Equipamento disponível" e o botão é "Ver disponibilidade". Não há como ler isso como projeto. Além da oferta vinculante do art. 30 do CDC, concentrador de oxigênio e aspirador são produtos para saúde: colocá-los em locação exige regularização própria perante a vigilância sanitária, que é coisa distinta da licença sanitária que a resposta 13 diz existir para o serviço de atenção domiciliar. Anunciar locação desses itens sem essa autorização expõe a empresa a autuação, não só a reclamação de consumidor.

**O que fazer:**

A correção do revisor está certa no diagnóstico e errada em três pontos de execução.

ERRO 1, INVENTA FATO. Ele sugere trocar a página por um texto dizendo que a Apoio Vital "pode indicar fornecedores". Ninguém informou isso. A sócia não disse ter parceria, convênio nem lista de fornecedores de equipamento. Escrever isso cria uma promessa nova, exatamente o que a regra "publicidade vincula" proíbe, e troca uma oferta falsa por outra menor. Fora.

ERRO 2, QUEBRA O SITE. Ele manda servir 410 e tirar do sitemap, mas esquece que o link mora no menu suspenso, no menu móvel e no rodapé de 24 arquivos HTML, incluindo _modelo.html e _modelo-servico.html, que regeneram as páginas. Publicar 410 sem mexer nesses 24 arquivos deixa o site com link quebrado em todas as páginas, contra o item 5 da checklist do CLAUDE.md.

ERRO 3, ESCOPO CURTO. Ele só lembra do JSON-LD. Ficam de pé o `<title>` "Aluguel de Cama Hospitalar no Rio de Janeiro", a meta description (:14), a og:description (:26) e, principalmente, alta-hospitalar.html:405-424, que tem uma seção inteira chamada "O equipamento que costuma aparecer na lista", um botão "Ver equipamento disponível" e um cartão listando seis itens com a frase "a gente diz o que é mesmo necessário". Essa seção continua anunciando o serviço mesmo com a página de destino fora do ar.

CORREÇÃO MELHOR, em ordem de execução:

A. Página servicos/aluguel-de-equipamento.html. Preferir desativar com conteúdo honesto a devolver 410, porque o 410 derruba uma URL que já está indexada e linkada e não devolve nada para quem chega por busca. Reduzir a página a um bloco curto, sem lista de itens, sem a palavra "disponível", sem botão de disponibilidade: que a Apoio Vital não aluga equipamento, que os serviços oferecidos hoje são cuidador de pessoa idosa, técnico de enfermagem e acompanhante hospitalar, e um link para servicos.html. Nada sobre entrega, montagem, troca, retirada, prazo ou fornecedor. Remover o `Service` "Aluguel de equipamento médico e hospitalar" do JSON-LD, mantendo só o BreadcrumbList. Trocar o robots da linha 16 para `noindex, follow`. Reescrever title, meta description e og:description para não anunciarem o serviço. Deixar comentário HTML no padrão dos blocos já desativados do projeto, dizendo que o conteúdo de oferta saiu por força da resposta 5 de 18/10/2026 e o que precisa existir de fato antes de voltar.

B. sitemap.xml, linhas 51-56. Remover o bloco `<url>` inteiro.

C. Os 24 arquivos que linkam. Tirar o item "Aluguel de equipamento" do menu suspenso, do menu móvel e da lista Serviços do rodapé, inclusive em _modelo.html e _modelo-servico.html, senão volta na próxima geração. Como a página passa a existir só como aviso, ela não deve ser oferecida na navegação.

D. alta-hospitalar.html:405-424. Remover o botão "Ver equipamento disponível" e reescrever a seção, ou removê-la. Se a sócia quiser manter a orientação, ela pode dizer que parte do que vem na lista da alta é de uso temporário e que vale conferir o que é mesmo necessário, sem prometer que a Apoio Vital fornece, aluga, entrega ou indica onde conseguir.

E. Mesmo tratamento, por identidade de motivo, para as outras três páginas de serviço que a resposta 5 marcou como apenas planejado: servicos/enfermagem-e-equipe-multidisciplinar.html, servicos/remocao-de-pacientes.html e formacao-de-cuidadores.html. Fica registrado aqui porque a decisão de navegação e de sitemap é a mesma e é melhor fazer de uma vez.

F. Confirmar com a sócia antes de publicar apenas uma coisa: se ela quer manter captação de interesse para quando o serviço existir. Se quiser, o texto da captação precisa sair dela, não de nós, e não pode conter prazo nem nome de fornecedor.

---

### O site diz que a enfermeira responsável técnica supervisiona o dia a dia; a sócia diz que quem acompanha a execução é o próprio profissional

**CONTRADIZ o que o site publica**

**Onde:** perguntas-frequentes.html:484-486, e o mesmo texto no JSON-LD em :163-166. Pergunta: "Quem supervisiona o trabalho no dia a dia?" Resposta publicada: "A enfermeira responsável técnica. Ela monta o plano de cuidados, acompanha os registros diários de cada plantão e faz visitas periódicas à residência para conferir na prática."

**A resposta que colide:** Resposta 4: o acompanhamento da execução é do próprio profissional, e a orientação do que fazer na casa é da família. Resposta 8: quem responde pela assistência é "outro profissional habilitado", sem dizer qual, e não foi marcado enfermeiro nem médico. Resposta 13: responsável técnico indicado é pedido em andamento.

**Por que importa:** Esta é a afirmação central da arquitetura de confiança do site e a única que a resposta desmente ponto a ponto: não há enfermeira, não há visita periódica, e quem acompanha a execução é quem executa. Autossupervisão não é supervisão. A RDC ANVISA 917/2024, art. 4º, exige responsável técnico de nível superior da área da saúde habilitado no conselho, e a resposta diz que esse requisito está apenas em andamento. Como está, a resposta aparece também no JSON-LD, ou seja, pode ser colhida por buscador e mostrada fora do site.

**O que fazer:**

A direção do revisor está certa (tirar das duas ocorrências ao mesmo tempo, porque o JSON-LD sobrevive à edição do texto visível), mas o "reescrever para descrever o que existe hoje" é impraticável sem inventar, e eu trocaria por outra coisa.

POR QUE NÃO REESCREVER AGORA. Para responder "quem supervisiona" seria preciso nomear o "outro profissional habilitado" da resposta 8, e a sócia não disse qual é. As únicas descrições verdadeiras disponíveis hoje seriam "quem acompanha a execução é o próprio profissional", "a orientação do que fazer vem da família" e "a supervisão é sob demanda". Publicar qualquer uma delas é criar uma afirmação nova, igualmente vinculante ("publicidade vincula"), a partir de caixa marcada em questionário, sem texto confirmado pela sócia, numa página que é lida por família em decisão. Autossupervisão descrita por escrito é pior para a empresa do que silêncio, e não é obrigatório responder a uma pergunta que a própria empresa ainda não sabe responder.

O QUE FAZER, usando o padrão que o repositório já tem. Desativar o item inteiro com comentário de restauração, igual ao bloco do rodapé do mesmo arquivo:

a) Em `perguntas-frequentes.html:483-488`, envolver o `<details id="supervisao">` em comentário HTML, com nota dizendo que o bloco está desativado de propósito, que a RDC ANVISA nº 917/2024, art. 4º, exige responsável técnico de nível superior habilitado no conselho, que o pedido está em andamento, e que a restauração depende de duas coisas: o registro da responsável técnica e o texto da resposta confirmado pela sócia.

b) Em `perguntas-frequentes.html:162-168`, apagar o objeto `{ "@type": "Question", "name": "Quem supervisiona o trabalho no dia a dia?" ... }` do array `mainEntity`, cuidando da vírgula para o JSON continuar válido (a varredura do CLAUDE.md exige zero JSON-LD inválido). JSON-LD não aceita comentário, então aqui é remoção mesmo, e o comentário de restauração do item (a) deve avisar que, ao restaurar, o objeto precisa voltar ao JSON-LD.

c) Verificar a âncora. O item tem `id="supervisao"`, então pode haver link apontando para `perguntas-frequentes.html#supervisao` em outra página. Rodar a varredura de link quebrado antes de publicar.

O QUE A CORREÇÃO NÃO PODE FAZER, e vale registrar porque qualquer reescrita cairia nisso:
- Não escrever "enfermeira", "enfermeiro" nem "responsável técnica" na resposta. Não existe registrado.
- Não escrever "visitas periódicas", nem qualquer frequência. A resposta 9 e a 8 dizem sob demanda.
- Não manter a segunda promessa da frase, "o nome e o número de COREN de quem responde tecnicamente pelo seu caso são informados por escrito na avaliação". É obrigação exigível que a empresa não consegue cumprir hoje: a inscrição da empresa no COREN-RJ e a indicação do RT estão as duas em andamento (resposta 13). Uma reescrita descuidada preservaria essa frase por parecer inofensiva.
- Não usar a resposta 13 (tem alvará, licença sanitária e CNES) para suavizar. Ter licença sanitária e CNES sem responsável técnico registrado não supre o art. 4º da RDC, e nenhum número de documento foi informado, então nada disso pode ser publicado como compensação.

PENDÊNCIA PARA A SÓCIA, uma pergunta só, a ser registrada em `docs/PREENCHER.md`: qual é o "outro profissional habilitado" da resposta 8, com formação e conselho. Sem isso a pergunta do FAQ não volta.

FORA DO ESCOPO DESTE ACHADO, mas a ser aberto como item próprio e não resolvido aqui: as outras ocorrências de "enfermeira responsável" no site, inclusive as duas do mesmo arquivo em `:501` e `:182`, e a linha do rodapé de todas as páginas "supervisão de enfermagem" (`perguntas-frequentes.html:579`). Corrigir só 484/166 reduz a exposição, não a elimina.

---

### Atos privativos de enfermagem anunciados como executados "sob supervisão da enfermeira responsável técnica"

**CONTRADIZ o que o site publica**

**Onde:** servicos/tecnico-de-enfermagem.html:294 ("Medicação, curativo, sonda, aspiração e sinais vitais são atos privativos da categoria, executados aqui sob supervisão da enfermeira responsável técnica"), servicos/cuidador-de-idosos.html:361 ("Quem faz: técnico ou auxiliar de enfermagem, sob supervisão da enfermeira responsável técnica"), index.html:602 ("executados em casa com prescrição e supervisão da enfermeira responsável técnica"), servicos/tecnico-de-enfermagem.html:330 e :354 ("com supervisão de enfermeiro")

**A resposta que colide:** Resposta 5: técnico de enfermagem está disponível hoje. Resposta 6: administração de medicamento, curativo, procedimento de enfermagem (sonda, aspiração) e controle de sinais vitais são realizados. Resposta 8: supervisão sob demanda, por "outro profissional habilitado" não identificado, sem enfermeiro marcado. Resposta 13: RT em andamento e inscrição da empresa no COREN-RJ em andamento.

**Por que importa:** O serviço está sendo vendido hoje, os atos estão sendo praticados hoje, e a supervisão que a lei exige não foi confirmada. A Lei nº 7.498/1986 condiciona a atuação do técnico e do auxiliar à orientação e supervisão de enfermeiro, e o próprio site publica essa regra em index.html:715. O site escreve a regra correta e, na linha seguinte, afirma cumpri-la com uma pessoa que não existe.

**O que fazer:**

A decisao proposta esta certa e nao inventa fato, mas e estreita demais e nao diz o que o site faz hoje, enquanto o pedido de RT estiver em andamento e o servico estiver sendo vendido. Correcao melhor, em quatro partes.

1. Escopo real. Tratar todas as ocorrencias publicadas, nao as cinco citadas: index.html:91, :602, :615, :659; servicos.html:272; perguntas-frequentes.html:166 e :486; precos.html:354; seguranca-e-selecao.html:258; trabalhe-conosco.html:260; formacao-de-cuidadores.html:331; plano-de-saude-cobre-home-care.html:365; servicos/cuidador-de-idosos.html:361 e :454; servicos/tecnico-de-enfermagem.html:294 e :304; servicos/enfermagem-e-equipe-multidisciplinar.html:14, :26, :75, :294, :416.

2. O que fica. Preservar os enunciados da regra legal, que estao corretos e nao prometem nada: index.html:715 e as etiquetas "Categoria" de servicos/tecnico-de-enfermagem.html:330 e :354. Dizer que a lei exige supervisao de enfermeiro e verdade; dizer que a Apoio Vital ja a tem e que nao foi confirmado.

3. O que sai, e como. Nada de redacao vaga, pelo motivo que o revisor deu. Desativar os trechos com o mesmo padrao que o projeto ja usa nos blocos de licenca sanitaria e CNES: comentario HTML com o motivo, a norma e a instrucao de restauracao, para que voltem inteiros quando a inscricao no COREN-RJ sair e a enfermeira estiver nomeada. Enquanto isso, suspender a venda do servico de tecnico de enfermagem, o que inclui retirar o cartao de index.html:602 e a entrada correspondente em servicos.html, e nao so editar a pagina de destino. A pagina servicos/enfermagem-e-equipe-multidisciplinar.html tem problema proprio e anterior: pela resposta 5 ela e apenas planejada, entao sai inteira do ar, sem redacao substituta.

4. Duas promessas que precisam cair junto, porque sao exigiveis e hoje nao tem como cumprir. perguntas-frequentes.html:166 e :486 prometem que "o nome e o numero de COREN de quem responde tecnicamente pelo seu caso sao informados por escrito na avaliacao": com RT em andamento, essa promessa nao pode ser honrada em nenhuma avaliacao feita hoje. trabalhe-conosco.html:260 promete ao profissional "enfermeira responsavel tecnica para ligar, inclusive de madrugada", o que colide com a resposta 8, que diz supervisao sob demanda por profissional nao identificado.

Nada disso entra no HTML com nome, numero de COREN, numero de inscricao ou prazo, porque a socia nao informou nenhum. Os campos de restauracao ficam como estao, com NOME e NUMERO por preencher.

Fora do site, uma pergunta que precisa voltar para a socia e nao se resolve editando pagina: pela resposta 6 os atos de medicacao, curativo, sonda, aspiracao e sinais vitais ja estao sendo praticados hoje, e pela resposta 8 a supervisao e de "outro profissional habilitado" que ela nao identificou. Tirar as frases do ar corrige a alegacao publicada, nao a operacao. Quem e esse profissional precisa ser respondido antes de qualquer republicacao.

---

### Sem saber quem é o "outro profissional habilitado", nenhuma frase de supervisão pode ser reescrita

**PRECISA de decisão da sócia**

**Onde:** Atinge as 22 páginas pelo rodapé ("Equipe selecionada, supervisão de enfermagem e plano de cuidados individual para cada pessoa", por exemplo em index.html:995) e o comentário já existente em sobre.html:245-247: "não sugerir que ela é a responsável técnica. Técnica de enfermagem e responsável técnica são coisas diferentes, e a RDC ANVISA nº 917/2024, art. 4º, exige nível superior para a segunda."

**A resposta que colide:** Resposta 8: "outro profissional habilitado", sem dizer qual, e nem enfermeiro nem médico foram marcados. Resposta 6: não foi respondido quem executa cada ato clínico nem quem define e supervisiona. Resposta 13: responsável técnico indicado é pedido em andamento.

**Por que importa:** Esta é a lacuna que sustenta quase todos os achados acima. Enquanto a resposta for "outro profissional habilitado" sem nome e sem conselho, não há como escrever uma frase verdadeira sobre supervisão, e qualquer reescrita vira adivinhação. Há ainda o risco específico que o próprio código já antecipa: se a figura pretendida for a sócia, que é técnica de enfermagem, ela não pode ser responsável técnica pelo art. 4º, e o site não pode sugerir que é.

**O que fazer:**

Antes de qualquer reescrita de texto, obter três informações: quem é esse profissional, qual a profissão e o conselho, e qual o número de registro. Com elas, decidir caso a caso quais frases de supervisão voltam. Sem elas, a decisão correta é remover as afirmações de supervisão, não substituí-las. Vale registrar essa pendência em docs/, porque é o que a próxima sessão precisa saber antes de tocar no texto.

---

### A empresa tem CNES mas diz que o responsável técnico está em andamento, e os dois fatos não costumam conviver

**PRECISA de decisão da sócia**

**Onde:** sobre.html:283 (linha desativada "Cadastro Nacional de Estabelecimentos de Saúde / CNES NÚMERO") e docs/v1/04-regulatorio.md, tabela de exigências: "5º | Inscrição no CNES" e "4º | Responsável técnico: profissional de nível superior da área da saúde, habilitado no respectivo conselho".

**A resposta que colide:** Resposta 13: CADASTRO NO CNES: TEM, e RESPONSÁVEL TÉCNICO INDICADO: PEDIDO EM ANDAMENTO. Resposta 8: quem responde é "outro profissional habilitado", não identificado.

**Por que importa:** O cadastro de um estabelecimento no CNES normalmente declara um responsável e profissionais vinculados. Se o CNES já existe, alguém foi declarado ali como responsável. Ou essa pessoa existe e é ela a resposta à pergunta 8, e então o site pode nomeá-la assim que ela confirmar, ou o CNES foi aberto com outro enquadramento, e aí o que está cadastrado não é um serviço de atenção domiciliar. As duas hipóteses mudam completamente o que o site pode escrever, e não dá para escolher no escuro.

**O que fazer:**

Perguntar à sócia, em uma pergunta só: quem consta como responsável no cadastro CNES da empresa, com qual conselho e qual número, e sob qual tipo de estabelecimento a inscrição foi feita. Registrar a resposta em docs/v1/04-regulatorio.md. Não escrever nada no site até ter isso.

---

### Alvará de funcionamento não tem linha nenhuma na tabela, nem desativada, e não é o alvará que a RDC exige

**PRECISA de decisão da sócia**

**Onde:** sobre.html:265-285, a tabela de identificação da empresa, que vai de Razão social até Atividades de enfermagem. Não há linha de alvará, ativa ou comentada. O comentário em sobre.html:279 fala de "alvará (art. 3º)" tratando-o como sinônimo de licença sanitária.

**A resposta que colide:** Resposta 13 separou os dois: ALVARÁ DE FUNCIONAMENTO: TEM, e LICENÇA SANITÁRIA: TEM. São duas respostas distintas para dois documentos distintos.

**Por que importa:** Alvará de funcionamento é licença municipal de localização, emitida pela prefeitura e devida por qualquer empresa. O art. 3º da RDC 917/2024 exige alvará do órgão sanitário competente, que é a licença sanitária. Se a sócia marcou os dois é porque entende ter os dois, mas pode também ter marcado "licença sanitária" por ter o alvará municipal. A diferença decide se a empresa está licenciada como serviço de saúde ou apenas como empresa. E resolve o ponto anterior: o CNAE principal publicado em sobre.html é 8712-3/00, fornecimento de infraestrutura de apoio e assistência a paciente no domicílio, com 8650-0/01 de atividades de enfermagem como secundário.

**O que fazer:**

Pedir cópia ou leitura dos dois documentos e conferir se a licença sanitária nomeia a atividade de atenção domiciliar ou o CNAE 8712-3/00. Só depois decidir se entra uma terceira linha na tabela. Publicar alvará municipal ao lado de licença sanitária, se forem o mesmo papel, infla a prova em vez de reforçá-la, e o valor da tabela de sobre.html vem justamente de ser conferível.

---

### Com licença e CNES, a ausência de RT muda de natureza e sobe de prioridade em vez de descer

**PRECISA de decisão da sócia**

**Onde:** docs/v1/04-regulatorio.md, seção "Duas cadeias sancionatórias que não se confundem": "Funcionar como SAD sem alvará, RT e CNES é infração sanitária, Lei 6.437/1977, art. 10, II". E a "Ordem de prioridade" do mesmo arquivo, que lista responsável técnico em primeiro, licença sanitária em segundo e CNES em terceiro.

**A resposta que colide:** Resposta 13 resolve os itens 2 e 3 da lista e deixa o item 1 em aberto. Resposta 6: as atividades realizadas incluem administração de medicamento, curativo, sonda, aspiração e controle de sinais vitais, ou seja, atos privativos de enfermagem. Resposta 8: a supervisão é SOB DEMANDA e quem responde não é enfermeiro nem médico.

**Por que importa:** Antes, a empresa era um serviço não licenciado, e a Vigilância teria que chegar até ela. Agora é um estabelecimento de saúde inscrito, com CNES, que executa atos privativos de enfermagem sem responsável técnico de nível superior e com supervisão sob demanda. Deixa de ser invisível e passa a ser localizável, com o art. 4º descumprido num cadastro que a própria empresa abriu. A regularização parcial reduziu duas exposições e concentrou toda a exposição restante num único ponto, que é o mais difícil dos três. A ordem de prioridade do documento continua certa, mas pelo motivo oposto ao que foi escrito.

**O que fazer:**

Atualizar a seção de prioridade de docs/v1/04-regulatorio.md para registrar esse deslocamento, mantendo responsável técnico em primeiro lugar e explicando que agora ele é a única exigência estrutural em aberto num estabelecimento já cadastrado. Levar esse ponto à sócia junto com a pergunta sobre quem consta no CNES, porque as duas coisas se resolvem com a mesma informação.

---

### As duas linhas da tabela de identificação em sobre.html estão destravadas, mas não podem ser religadas sem número

**DESTRAVA algo que estava travado**

**Onde:** sobre.html:278-285. Comentário: "Licença sanitária e CNES desativados: a empresa ainda não tem os dois. A RDC ANVISA nº 917/2024 exige alvará (art. 3º) e inscrição no CNES (art. 5º). Publicar número inventado de licença é pior do que não publicar nenhum. PARA RESTAURAR, com os números reais em mãos:" seguido de <tr><th scope="row">Licença sanitária</th><td>Nº NÚMERO, Vigilância Sanitária do Município do Rio de Janeiro</td></tr> e <tr><th scope="row">Cadastro Nacional de Estabelecimentos de Saúde</th><td>CNES NÚMERO</td></tr>

**A resposta que colide:** Resposta 13: LICENÇA SANITÁRIA: TEM. CADASTRO NO CNES: TEM. Mas a mesma resposta registra que ela NÃO informou número de nenhum documento.

**Por que importa:** A premissa do comentário caiu pela metade. O obstáculo deixou de ser a inexistência do documento e passou a ser a falta do número. O próprio comentário já previa exatamente esta condição, "com os números reais em mãos", e ela não foi atendida. Religar agora publicaria os literais NÚMERO como se fossem dados, que é o cenário que o comentário chama de pior do que não publicar nenhum. Esta é a única das três pendências regulatórias do projeto que a resposta 13 efetivamente destrava, e mesmo ela não está pronta.

**O que fazer:**

Não religar ainda. Pedir à sócia quatro dados por escrito: número da licença sanitária, órgão emissor exato e data de validade, e número do CNES. Com os quatro em mãos, apagar as linhas de comentário de sobre.html:278-281 e a linha 285, e substituir Nº NÚMERO e CNES NÚMERO pelos valores reais. Conferir o CNES no cadastro público antes de publicar, porque é consultável por qualquer família.

---

## Decisão comercial

### Falta decidir se as quatro páginas saem do ar ou viram página de serviço futuro

**PRECISA de decisão da sócia**

**Onde:** servicos/enfermagem-e-equipe-multidisciplinar.html, servicos/remocao-de-pacientes.html, servicos/aluguel-de-equipamento.html e formacao-de-cuidadores.html, as quatro no ar, nas quatro no sitemap.xml e nas quatro com JSON-LD de oferta ativa.

**A resposta que colide:** Resposta 14, palavras dela: "Vamos começar oferecendo serviços de cuidador de idosos e acompanhante hospitalar". Na mesma resposta: os serviços essenciais ao negócio são "Serviços de enfermagem e serviços de alta complexidade". Ela NÃO respondeu quais serviços podem esperar a regularização.

**Por que importa:** Há duas saídas e elas não são equivalentes. Tirar do ar com 410 encerra o risco jurídico de imediato e devolve as URLs quando houver serviço, ao custo de perder a posição de busca já construída. Manter uma página curta de serviço futuro preserva alguma captação, mas qualquer página que permaneça com botão de contato continua funcionando como oferta aos olhos do CDC. Além disso a resposta 14 abre uma dúvida que só a sócia fecha: ela diz que vai começar por cuidador e acompanhante, sem citar técnico de enfermagem, que a resposta 5 marca como disponível. Isso muda quantas páginas de serviço o site terá.

**O que fazer:**

Levar à sócia três perguntas objetivas, de preferência por escrito: primeira, para cada um dos quatro serviços, tirar do ar ou manter como serviço futuro sem botão de contratação. Segunda, há prazo estimado para enfermagem e alta complexidade, já que ela os chama de essenciais. Terceira, técnico de enfermagem está ou não no ar hoje, porque a resposta 5 e a resposta 14 divergem. Nada é republicado antes dessas três respostas.

---

### O site vende toda a Região Metropolitana, e a sócia marcou apenas Niterói fora do Rio, com resposta contraditória sobre o próprio Rio

**PRECISA de decisão da sócia**

**Onde:** perguntas-frequentes.html:541 e JSON-LD :222: "Todo o município do Rio de Janeiro, nas seis regiões da cidade... Atendemos também a Região Metropolitana, com Niterói, São Gonçalo, Duque de Caxias, Nova Iguaçu e demais municípios da Baixada." servicos/acompanhante-hospitalar.html:446 ("Atendemos em qualquer hospital do Rio e da Região Metropolitana"), e o rodapé das 22 páginas ("Assistência domiciliar e hospitalar em todo o Rio de Janeiro")

**A resposta que colide:** Resposta 12: foram marcados ao mesmo tempo o município do Rio inteiro, "só algumas regiões do Rio" e Niterói. As duas primeiras se contradizem. A sócia afirmou que a promessa de atender todo o Rio corresponde à capacidade de hoje.

**Por que importa:** O site extrapola até a resposta mais generosa da sócia: ela marcou Niterói, o site vende São Gonçalo, Duque de Caxias, Nova Iguaçu e "demais municípios da Baixada". E a contradição interna da resposta 12 impede saber se o Rio inteiro é verdade. Cobertura anunciada é a promessa que mais rápido vira recusa de atendimento depois do contato, que é a pior experiência possível para quem está em alta hospitalar.

**O que fazer:**

Perguntar à sócia, de forma fechada, quais regiões do Rio e quais municípios ela consegue cobrir hoje com profissional disponível. Até a resposta, reduzir a lista da Baixada, que ela não marcou. O rodapé das 22 páginas depende dessa mesma resposta.

---

### O convite de sobre.html para a família pedir os documentos deixa de ser blefe e passa a ser compromisso verificável, com um buraco

**PRECISA de decisão da sócia**

**Onde:** sobre.html:292: "Serviços de atenção domiciliar são regidos pela RDC ANVISA nº 917/2024, que exige licença sanitária, responsável técnico de nível superior e inscrição no CNES. Peça esses documentos a qualquer empresa que você estiver avaliando, inclusive a nós." E sobre.html:258: "apenas um nomeava o enfermeiro responsável técnico. É a prova mais barata e mais convincente de que uma empresa existe, e quase ninguém publica."

**A resposta que colide:** Resposta 13: licença sanitária e CNES existem, RT em andamento.

**Por que importa:** Esse parágrafo convida a família a pedir três documentos. Até ontem, nenhum dos três existia e o convite era uma aposta. Hoje dois existem e o convite vira o melhor argumento da página, com a ressalva de que o terceiro continua faltando e é justamente o que o parágrafo anterior chama de prova mais convincente. A família que aceitar o convite vai receber dois documentos e uma negativa, por escrito, induzida pelo próprio site. Isso precisa de uma resposta combinada antes de a tabela ganhar as duas linhas novas, porque é quando as duas linhas aparecerem que as famílias vão começar a pedir a terceira.

**O que fazer:**

Definir com a sócia qual é a resposta padrão de quem receber o pedido do documento de RT enquanto o registro não sai, e registrá-la no repositório. Decidir também se o convite fica como está, que é a opção coerente com a linha editorial, ou se ganha uma frase que antecipa a situação do RT. Não publicar essa frase antecipatória sem a decisão dela.

---

### "100% com antecedentes verificados" e "nenhuma exceção por urgência" alcançam também quem já está em campo

**PRECISA de decisão da sócia**

**Onde:** index.html:781 e :782: "100%" / "Dos profissionais com antecedentes criminais verificados antes do primeiro plantão". seguranca-e-selecao.html:233: "Nenhum profissional entra na casa de um cliente sem ter passado por todas. Não existe exceção por urgência." seguranca-e-selecao.html:246: "Certidão exigida de todo profissional antes do primeiro plantão, sem exceção, e renovada periodicamente para quem fica na equipe." perguntas-frequentes.html:502: "Nenhuma etapa é pulada por urgência."

**A resposta que colide:** Resposta 11: a empresa já está operando, sem contrato formal. Resposta 10: o procedimento escrito ainda não existe. Nada nas respostas contradiz a exigência de certidão, mas também nada confirma que os profissionais hoje em campo passaram pelas seis etapas.

**Por que importa:** "100%", "sem exceção" e "nenhuma etapa" são afirmações auditáveis e retroativas: cobrem os atendimentos em curso. Sem procedimento escrito, a empresa não tem como demonstrar o 100% se for questionada, e uma única exceção derruba a frase inteira. "Renovada periodicamente" acrescenta uma rotina de recadastramento que também precisa existir em algum lugar.

**O que fazer:**

Perguntar à sócia, nome a nome, se os profissionais que já estão atendendo passaram pelas seis etapas e têm certidão arquivada. Se sim, manter e começar a guardar os comprovantes. Se não, trocar "100%" por descrição do processo sem número e remover "renovada periodicamente" até a rotina existir.

---

### "Em todo o Rio de Janeiro" está na barra do topo de todas as páginas, e a resposta sobre abrangência se contradiz

**PRECISA de decisão da sócia**

**Onde:** como-funciona.html:83, index.html:326 e perguntas-frequentes.html:248: "em todo o Rio de Janeiro". Rodapé das quatro páginas (como-funciona.html:472, index.html:995, seguranca-e-selecao.html:355, perguntas-frequentes.html:579): "Assistência domiciliar e hospitalar em todo o Rio de Janeiro." perguntas-frequentes.html:541: "Todo o município do Rio de Janeiro, nas seis regiões da cidade".

**A resposta que colide:** Resposta 12: ela marcou o município do Rio inteiro e também "só algumas regiões do Rio" e Niterói, e as duas primeiras se contradizem. Ao mesmo tempo, afirmou que a promessa de atender todo o Rio corresponde à capacidade de hoje.

**Por que importa:** A afirmação aparece no topo e no rodapé de todas as páginas, então é a promessa geográfica mais repetida do site. Ela respondeu que corresponde à capacidade atual, o que basta para manter. Mas marcou também "só algumas regiões", e essa contradição precisa ser desfeita por ela, não por quem escreve o site, porque a consequência prática é recusar atendimento em Santa Cruz depois de a família ter lido que atende todo o Rio.

**O que fazer:**

Fazer a ela uma pergunta fechada: existe bairro ou região do município onde hoje vocês não conseguem colocar profissional. Se existir, trocar "em todo o Rio de Janeiro" por uma lista de regiões no topo e no rodapé das 22 páginas, e ajustar perguntas-frequentes.html:541 e o JSON-LD correspondente. Se não existir, manter como está e registrar a confirmação.

---

### Plantão noturno, fim de semana e feriado se sustentam, e o selo "Plantão 24 horas" continua ambíguo

**DESTRAVA algo que estava travado**

**Onde:** index.html:489 e :490, cartão de modalidades: "24h" / "Presença contínua, com revezamento de profissionais". Sustentado. O problema está em index.html:472, no hero: o selo "Plantão 24 horas" ao lado de "CNPJ e endereço no rodapé" e "Contrato e nota fiscal".

**A resposta que colide:** Resposta 9: há profissional para plantão noturno, fim de semana e feriado. Mas "24 horas" como canal significa apenas o primeiro contato no WhatsApp.

**Por que importa:** A modalidade de escala de 24 horas tem lastro e deve ficar. O selo do hero, porém, está num grupo de selos institucionais e, lido ali, soma-se à barra do topo e ao indicador de 24h para formar a impressão de central aberta a qualquer hora, que é justamente o que a resposta 9 nega. A ambiguidade está na posição, não na frase.

**O que fazer:**

Manter o cartão de modalidades como está. Trocar o selo do hero por "Plantão diurno, noturno e integral", que diz a mesma verdade sem sugerir central 24 horas.

---

## Sem risco imediato

### O comentário interno de sobre.html agora afirma um fato falso e vai contaminar a próxima decisão

**CONTRADIZ o que o site publica**

**Onde:** sobre.html:278. Texto literal no HTML: "Licença sanitária e CNES desativados: a empresa ainda não tem os dois."

**A resposta que colide:** Resposta 13: LICENÇA SANITÁRIA: TEM. CADASTRO NO CNES: TEM.

**Por que importa:** O comentário não é visível ao público, então não há risco publicitário. O risco é de governança: é a instrução que qualquer pessoa, ou qualquer máquina, vai ler antes de mexer nessa tabela, e ela diz o contrário do que a sócia respondeu. Pela regra do projeto, o que não está no repositório não existe. Hoje o repositório diz que a empresa não tem licença sanitária. Enquanto essa frase estiver lá, ela vale mais que a resposta.

**O que fazer:**

Em sobre.html, substituir apenas as linhas 278 a 281 pelo texto abaixo, preservando intactas as linhas 282 e 283 (as duas <tr> desativadas) e o fechamento "-->" na linha 284.

          <!-- Licença sanitária e CNES: a empresa TEM os dois, e também o alvará de
               funcionamento. Informado pela sócia em 18/10/2026, resposta 13 em
               docs/RESPOSTAS-operacao.md. Atenção: 18/10/2026 é a data da resposta,
               não a data de emissão de documento nenhum.
               As duas linhas abaixo seguem desativadas por um único motivo: ela não
               informou o número de nenhum dos documentos. Publicar número inventado
               é publicidade enganosa pelo art. 37, §1º do Código de Defesa do Consumidor.
               A RDC ANVISA nº 917/2024 exige alvará (art. 3º) e inscrição no CNES (art. 5º).
               PARA RESTAURAR: confirmar com a sócia o número de cada documento e o órgão
               emissor da licença, preencher os campos e apagar estas linhas de comentário.
               Não depende de mais nada.

Diferenças em relação à correção do revisor, e por quê:
- Troquei "desde 18/10/2026" por "informado pela sócia em 18/10/2026", com aviso explícito de que essa não é data de emissão. A redação original criaria um fato que ninguém informou.
- Acrescentei o alvará, que a resposta 13 confirma e que a linha seguinte do próprio comentário já invoca.
- Mantive a fundamentação do CDC, que estava na redação atual e é o motivo real de não publicar número inventado.
- Registrei que o órgão emissor da licença também precisa ser confirmado: a linha desativada já traz "Vigilância Sanitária do Município do Rio de Janeiro" como suposição, e a sócia não confirmou isso.

O que NÃO mexer, para não transformar esta correção em regressão:
- sobre.html:272, sobre responsável técnica e COREN-RJ, continua correto: ambos estão "pedido em andamento", ou seja, ainda não registrados.
- Os comentários de responsável técnica no rodapé das 22 páginas e dos dois modelos continuam corretos pelo mesmo motivo.
- As linhas 282 e 283 continuam desativadas. Sem número, nada é restaurado.

Pendência separada, que este achado não cobre e que é a mesma falha com mais alcance: o CLAUDE.md na raiz ainda afirma em "Regras que não se quebram" que a empresa não tem responsável técnico registrado, licença sanitária nem CNES. Dois terços dessa frase ficaram falsos em 18/10/2026. Enquanto ela estiver assim, qualquer leitura futura do projeto começa pelo erro.

---

### Ter alvará, licença sanitária e CNES permite ao site provar o que ele hoje não prova

**DESTRAVA algo que estava travado**

**Onde:** Nenhuma das quatro páginas planejadas menciona licença, alvará ou CNES. O rodapé de todas as páginas, exemplo servicos.html:412-428, mantém desativado o bloco de responsável técnica e inscrição no COREN, e servicos.html:483 traz apenas "Serviço de atenção domiciliar regido pela RDC ANVISA nº 917/2024".

**A resposta que colide:** Resposta 13: a empresa TEM alvará de funcionamento, TEM licença sanitária e TEM cadastro no CNES. Pendentes: inscrição no COREN-RJ e responsável técnico indicado, ambos com pedido em andamento. Ela não informou o número de nenhum documento.

**Por que importa:** Enquanto quatro páginas somem, o site perde argumento comercial. A resposta 13 oferece reposição legítima: licença sanitária e CNES são exatamente a prova que a família não encontra em quase nenhum concorrente, e sobre.html já organiza o site em torno de documento conferível. Importante ser preciso: isso libera afirmar que a empresa está licenciada, não libera nenhum dos quatro serviços, porque a pendência deles é de operação, não de papel. E a licença sanitária do serviço de atenção domiciliar não cobre locação de produtos para saúde nem transporte de paciente.

**O que fazer:**

Pedir à sócia o número do alvará, o número da licença sanitária com a data de validade e o número do CNES, mais uma cópia de cada. Com os números em mãos, publicar no rodapé e em sobre.html, com a mesma lógica do bloco desativado de RT. Sem número conferido, nada entra. O bloco de responsável técnica e de inscrição no COREN continua desativado, porque a resposta 13 diz que os dois seguem em andamento.

---

### Alvará, licença sanitária e CNES existem: a premissa de todo o projeto mudou, e dois blocos desativados podem voltar

**DESTRAVA algo que estava travado**

**Onde:** sobre.html:278-284, bloco comentado: "Licença sanitária e CNES desativados: a empresa ainda não tem os dois... PARA RESTAURAR, com os números reais em mãos", com as duas linhas de tabela prontas. O mesmo pressuposto está em CLAUDE.md, linhas 32-35, e em docs/v1/00-estado-atual.md, seção 3.

**A resposta que colide:** Resposta 13: alvará de funcionamento, tem; licença sanitária, tem; cadastro no CNES, tem. Inscrição da empresa no COREN-RJ e responsável técnico indicado seguem como pedido em andamento. Nenhum número foi informado.

**Por que importa:** É a única resposta que destrava em vez de travar, e muda o enquadramento de várias páginas: a página Sobre, o rodapé das 22 páginas e o argumento de conferência documental que o site oferece ao visitante. Mas destrava só dois dos três blocos. O responsável técnico continua em andamento, então a RDC ANVISA 917/2024 segue sem ser cumprida integralmente pelo art. 4º, e "regido pela" continua sendo a única formulação possível. Vale confirmar que o alvará citado é o alvará sanitário de serviço de atenção domiciliar e não o alvará municipal de funcionamento, que são documentos diferentes.

**O que fazer:**

Pedir à sócia os números e as cópias dos três documentos, conferir se a licença sanitária cobre atenção domiciliar, e só então restaurar as duas linhas de sobre.html com os números reais. Não restaurar a linha de responsável técnica. Não trocar "regido pela" por "em conformidade com" em nenhuma hipótese enquanto o art. 4º não estiver cumprido. Atualizar CLAUDE.md e docs/v1/00-estado-atual.md, que hoje afirmam o contrário e vão induzir a próxima sessão ao erro.

---

### Destrava: o núcleo da promessa contratual à família continua verdadeiro e não deve ser apagado junto

**DESTRAVA algo que estava travado**

**Onde:** como-funciona.html:398, "Sem vínculo empregatício para a sua família"; como-funciona.html:375, "Escala reserva. Mantemos profissionais de folga disponíveis para cobertura, não é improviso na hora"; sobre.html:310, "Mantemos escala reserva. Se um profissional faltar, acionamos o substituto e avisamos a família antes, sem custo extra"; precos.html:351-352, linhas de escala reserva; index.html:284 e 935; perguntas-frequentes.html:150 e 473.

**A resposta que colide:** Resposta 2: a Apoio Vital assina o contrato, recebe o pagamento e responde perante a família. Resposta 10: existe escala reserva pronta. Resposta 4: a substituição é decidida pela Apoio Vital.

**Por que importa:** Na correção dos achados anteriores há risco real de varrer junto o que é verdade e é o melhor argumento do site. A família contratar o CNPJ e não o profissional continua sendo fato, e é isso que a afasta da discussão de vínculo doméstico da Lei Complementar nº 150/2015. A escala reserva existe, segundo a resposta 10, e a empresa é quem aciona o substituto, segundo a resposta 4. As duas promessas sobrevivem inteiras.

**O que fazer:**

Preservar o título "Sem vínculo empregatício para a sua família" e os sete trechos de escala reserva. Reescrever apenas a lista abaixo do título, trocando encargos, férias, décimo terceiro, INSS e comprovação de registro por contrato com o CNPJ, pagamento feito pela empresa ao profissional e responsabilidade da empresa perante a família. Registrar em docs que essas duas promessas foram conferidas contra as respostas de 18/10/2026, para ninguém desfazer depois por excesso de cautela.

---

### O rodapé pode continuar dizendo "regido pela" nas 24 páginas, e continua não podendo dizer "em conformidade com"

**DESTRAVA algo que estava travado**

**Onde:** Linha presente em 24 arquivos, por exemplo index.html:1067: "Serviço de atenção domiciliar regido pela RDC ANVISA nº 917/2024." Em servicos.html:483, sobre.html:475, plano-de-saude-cobre-home-care.html:505, _modelo.html:269 e _modelo-servico.html:269 a mesma frase aparece sem o link para o Diário Oficial que as outras dezoito páginas têm.

**A resposta que colide:** Resposta 13: alvará, licença sanitária e CNES existem; COREN e RT em andamento.

**Por que importa:** A regra de duas palavras do CLAUDE.md sobrevive intacta à resposta 13. "Regido pela" descreve o regime aplicável e está correto desde sempre. "Em conformidade com" afirmaria que todas as exigências da norma estão cumpridas, e o art. 4º continua descumprido. Dois de cinco artigos resolvidos não autorizam a troca. Vale dizer isso de forma expressa, porque a notícia de que a empresa tem licença e CNES é exatamente o tipo de novidade que faz alguém propor essa troca achando que é uma atualização.

**O que fazer:**

Nenhuma mudança de texto. Registrar no CLAUDE.md, junto da correção do item anterior, que a resposta 13 não altera a regra "regido pela". Aproveitar para padronizar: incluir o link do Diário Oficial nas seis páginas que estão sem ele, o que é correção de consistência e não de conteúdo.

---

### Escala reserva se sustenta, mas o aviso prévio de troca e o "você não resolve nada" ainda não

**DESTRAVA algo que estava travado**

**Onde:** como-funciona.html:375: "Escala reserva Mantemos profissionais de folga disponíveis para cobertura, não é improviso na hora." Fica de pé. Já como-funciona.html:376 e :379: "Aviso antes da troca A família sabe quem vai no lugar antes de o substituto chegar" e "Você não resolve nada Quem corre atrás somos nós". index.html:935 e perguntas-frequentes.html:473: "acionamos o substituto e avisamos a família antes, nunca depois". como-funciona.html:377 ficou como linha em branco, onde estava o prazo de 4 horas que já foi removido.

**A resposta que colide:** Resposta 10: existe escala reserva pronta, o que confirma a promessa principal. Mas o procedimento escrito ainda não existe, e ela não respondeu quem é acionado em cada situação. Resposta 4: a substituição é atribuição da Apoio Vital, o que também sustenta.

**Por que importa:** Vale registrar o que destrava, porque a escala reserva é a resposta à reclamação número um do setor e agora tem lastro. O que não tem lastro é o "nunca depois" e o "você não resolve nada": sem procedimento escrito e sem definição de quem aciona, a empresa está prometendo uma sequência de atos que ninguém formalizou. "Nunca" é absoluto e não admite a primeira exceção.

**O que fazer:**

Manter o bloco de escala reserva. Trocar "nunca depois" por "sempre que possível antes" nos três pontos, ou condicionar à existência do procedimento. Limpar a linha 377 de como-funciona.html, que ficou vazia depois da remoção do prazo de 4 horas.

---

### A seleção descrita é atribuição real da empresa, o que sustenta a página de segurança

**DESTRAVA algo que estava travado**

**Onde:** seguranca-e-selecao.html:236 a 272, as seis etapas, e index.html:655 a 663, a lista de segurança da home. Também como-funciona.html:277: "Documento e curso conferidos, certidão de antecedentes criminais, duas referências checadas por telefone".

**A resposta que colide:** Resposta 4: seleção, horário e escala, distribuição de plantão, avaliação e substituição são da Apoio Vital.

**Por que importa:** É importante separar o que se mantém do que cai. Com exceção da entrevista conduzida pela responsável técnica, tratada em achado próprio, a estrutura das seis etapas descreve atribuições que a sócia confirmou serem da empresa. A página não precisa ser desmontada, precisa de três trocas de palavra.

**O que fazer:**

Manter a arquitetura da página. Aplicar só as correções já apontadas: entrevista sem a figura da RT, supervisão sem "periodicamente", canal sem "quem decide", e protocolo de emergência e ouvidoria com prazo fora até existirem.

---

## O que NÃO foi feito, e por quê

Nenhuma linha do site mudou. O diagnóstico existe para a sócia decidir a ordem e o
escopo, como foi feito com a auditoria de estrutura. Três correções dependem de
informação que ninguém tem ainda:

- os números do alvará, da licença sanitária e do CNES, sem os quais nada pode ser
  religado;
- quem é o "outro profissional habilitado" da resposta 8, sem o qual nenhuma frase sobre
  supervisão pode ser reescrita;
- se a empresa atende o Rio inteiro ou só algumas regiões, porque a resposta 12 marcou as
  duas coisas.

E uma correção depende de decisão pura: as quatro páginas de serviço planejado saem do ar
ou viram página de serviço futuro.
