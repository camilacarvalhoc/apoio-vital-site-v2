# O que trocar antes de publicar

Todo dado abaixo é **exemplo**. O site funciona e está completo, mas estes valores
precisam virar os reais antes de o site ir ao ar.

Há duas formas de fazer: rodar o script pronto no fim deste arquivo, ou trocar à mão
usando a tabela. O script é mais rápido e não esquece nada.

---

## 1. Dados que só você tem

### ✅ Já aplicados, extraídos do cartão CNPJ e do contrato social

Estes já estão corretos nas 18 páginas. Nada a fazer.

| Dado | Valor no site |
|---|---|
| Razão social | Apoio Vital Gestão de Cuidados e Acompanhamento Ltda. |
| Nome fantasia | Apoio Vital |
| CNPJ | 69.306.846/0001-50 |
| Endereço | Av. Ator José Wilker, 605, bloco C1, sala 282 |
| Bairro e cidade | Barra Olímpica, Rio de Janeiro/RJ |
| CEP | 22775-024 |
| NIRE | 33.2.1521114-3, arquivado na JUCERJA em 24/09/2026 |
| Natureza jurídica | Sociedade empresária limitada, porte EPP |
| Capital social | R$ 200.000,00 integralizado |
| CNAE principal | 8712-3/00 |
| Data de constituição | 24/09/2026 (no JSON-LD como `foundingDate`) |

### ⚠️ Ainda são exemplo, preciso dos reais

| O que está escrito hoje | O que você precisa informar |
|---|---|
| `(21) 97479-2051` e `+5521974792051` | Telefone fixo da empresa |
| `(21) 99999-0000` e `5521974792051` | WhatsApp comercial |
| ~~`contato@apoiovital.com`~~ | **Resolvido.** É este mesmo |
| ~~`rh@apoiovital.com`~~ | **Resolvido.** A caixa não existia e o endereço saiu do site. A caixa de recrutamento é `vagas@apoiovital.com`, criada em 19/10/2026, com recebimento testado pela sócia. O formulário Trabalhe Conosco envia o currículo para ela; o formulário de contato segue em `contato@`. A entrega do anexo pela hospedagem ainda não foi testada em produção |
| `privacidade@apoiovital.com` | Canal de LGPD |
| `ouvidoria@apoiovital.com` | Canal de ouvidoria |
| `Enfª Nome Sobrenome` | Nome da enfermeira responsável técnica |
| `COREN-RJ 000.000` | Registro dela no COREN |
| `00.000` | Inscrição da empresa no COREN-RJ |
| ~~Domínio~~ | **Resolvido.** `apoiovital.com`, sem o `.br` |

> **Não use o telefone nem o e-mail que constam no cartão CNPJ.**
> `(21) 3400-7750` e `contato@ensetecontabilidade.com.br` são do escritório de
> contabilidade, não da empresa. Publicá-los mandaria seus clientes para o contador.

### Decisões suas sobre o que publicar

| Item | Situação | Pergunta |
|---|---|---|
| Nome da administradora | Mônica de Carvalho, pelo contrato social | Quer o nome dela na página Sobre? Nomear quem responde pela empresa é sinal de confiança, mas é escolha sua |
| Capital social | R$ 200.000,00 | Já está publicado na página Sobre. Incomum no setor e justamente por isso um diferencial contra as concorrentes informais. Se preferir tirar, é uma linha |
| Dados das sócias | **Não publicados** | CPF, RG e endereço pessoal não entram em site, e não entraram |

### Serviços que o seu CNPJ cobre e o site ainda não vende

O contrato social e o cartão CNPJ registram oito atividades. O site hoje cobre quatro
serviços. Estas quatro estão licenciadas e não aparecem em lugar nenhum:

| CNAE | Atividade | Vale colocar no site? |
|---|---|---|
| 8622-4/00 | Remoção de pacientes, exceto urgência | **Provavelmente sim.** Combina direto com alta hospitalar, que é o principal gatilho de contratação |
| 4923-0/02 | Transporte de passageiros com motorista | Útil para levar a consultas e exames |
| 7739-0/02 | Aluguel de equipamentos médicos e hospitalares | Cama hospitalar, cadeira de rodas e oxigênio são a primeira compra da família depois da alta |
| 8599-6/04 | Treinamento em desenvolvimento profissional | Pode virar formação de cuidadores, uma segunda frente de receita |
| 8621-6/02 | Serviços móveis de atendimento a urgências | Exige estrutura específica. Confirmar se vai operar |

Me diga quais desses vocês realmente vão oferecer que eu escrevo as páginas.

## 2. Promessas que viraram número

Estes não são erro de digitação: são compromissos que o site assume em nome da empresa.
**Só mantenha se a operação cumprir.** Promessa quebrada no Reclame Aqui custa mais caro
do que promessa não feita.

| Valor no site | O que significa | Onde aparece |
|---|---|---|
| **4 horas** | Prazo máximo para colocar um substituto quando alguém falta | Home, todas as páginas de serviço, como funciona, dúvidas |
| **2 horas** | Prazo de retorno de contato no horário comercial | Home, contato, obrigado |
| **24 horas** | Prazo para iniciar o atendimento em caso de urgência | Home, como funciona |
| **24 horas** | Central de plantão funcionando todos os dias | Barra do topo e rodapé |
| **100%** | Dos profissionais com antecedentes criminais verificados | Home, faixa de indicadores |
| **160** | Bairros atendidos no Rio | Home, faixa de indicadores |
| **Avaliação gratuita** | Visita em casa sem custo e sem compromisso | Praticamente todas as páginas |
| **Sem taxa de adesão e sem fidelidade** | Condição comercial | Preços e dúvidas |

Se algum destes não for verdade hoje, me avise que eu ajusto o número ou removo a promessa.

---

## 3. Documentos que o site menciona

A RDC ANVISA nº 917/2024 exige, de serviços de atenção domiciliar, licença sanitária,
responsável técnico de nível superior e inscrição no CNES. O site cita isso na página
Sobre e convida o visitante a pedir os documentos.

- [ ] Licença sanitária municipal em dia
- [ ] Inscrição no CNES
- [ ] Inscrição da empresa no COREN-RJ
- [ ] Responsável técnica formalizada

**Importante:** enquanto a licença de serviço de atenção domiciliar não estiver
comprovada, o site **não deve** oferecer "internação domiciliar" nem "desospitalização".
Esses termos têm definição regulatória específica e hoje não aparecem em lugar nenhum
do site, de propósito.

---

## 4. Conteúdo que falta

| Item | Onde | Situação |
|---|---|---|
| Fotos reais da equipe | Sobre, seção comentada no código | Não publique banco de imagens. A pesquisa aponta isso como um dos maiores destruidores de confiança do setor |
| Depoimentos de clientes | Home, seção comentada no código | Só com autorização por escrito. Depoimento inventado é publicidade enganosa pelo art. 37 do CDC |
| Equipe de coordenação | Sobre, seção comentada no código | Nome, função e registro no conselho |
| Imagem de compartilhamento | `assets/img/og-apoio-vital.png` | Hoje é o logo sobre fundo creme. Vale refazer com telefone legível, porque é o que aparece quando alguém manda o link no WhatsApp |

As três primeiras já estão com o código pronto e comentado. Basta preencher e remover
o comentário.

---

## 5. Para onde o formulário envia

> **Reescrito em 19/10/2026.** A versão anterior dizia que o formulário só abria o WhatsApp
> e mandava criar conta no Formspree. Nada disso vale mais: quem envia é o `enviar.php`, que
> já está no site.

Os dois formulários mandam por e-mail, pelo `enviar.php`, e cada um tem um destino:

| formulário | campo `formulario` | destino | abre o WhatsApp? |
|---|---|---|---|
| Contato e orçamento | `contato` | `contato@apoiovital.com` | Sim, com os dados preenchidos |
| Trabalhe Conosco | `trabalhe` | `vagas@apoiovital.com` | **Não** |

**O Trabalhe Conosco não passa mais pelo WhatsApp.** A sócia decidiu em 19/10/2026 que a
candidatura chega só por e-mail: o currículo em arquivo virou obrigatório, e o WhatsApp saiu
da página inteira, inclusive o botão flutuante e a barra de baixo do celular. Quem mexer nessa
página depois precisa saber disso antes de colar bloco de outra página, que traz o WhatsApp
junto.

Sem JavaScript nada se perde: os dois formulários têm `action="/enviar.php"` e `method="post"`,
e o servidor confere de novo o que o navegador conferiu, inclusive a obrigatoriedade do
currículo.

A linha `endpointFormulario` em `assets/js/main.js` continua vazia de propósito. Ela só serve
se um dia o envio for para serviço de terceiro, e aí o `enviar.php` deixa de ser usado.

---

## 6. Script de substituição

> **Reescrito em 17/10/2026.** A versão anterior deste script trocaria dados que já são
> verdadeiros por marcadores, e reintroduziria `.com.br` no domínio, que foi corrigido para
> `apoiovital.com`. Não use scripts antigos guardados em outro lugar.

### O que ainda é dado de exemplo

**Nenhum.** O telefone e o WhatsApp foram preenchidos em 17/10/2026 com o número
`(21) 97479-2051`.

> **Conferido duas vezes em 18/10/2026, e a segunda desfez a primeira.** A contagem de
> 385 que estava escrita aqui descrevia links de ligar que o HTML não tinha mais: a
> auditoria das 22 páginas achou **zero** `href="tel:"` da empresa. De manhã os botões
> foram devolvidos, 67 deles. À tarde a sócia decidiu que **o site não oferece telefone**,
> só WhatsApp, e eles saíram de novo.
>
> Contagem de agora, medida arquivo por arquivo nas 22 páginas públicas:
>
> | onde | quantas |
> |---|---|
> | `href="tel:"` da empresa | **0, por decisão** |
> | botões `wa.me` | 150 |
> | número visível em texto | 45 |
>
> O único `tel:` do site é o 0800 da ANS, em `plano-de-saude-cobre-home-care.html`.
> Ele não é da empresa e deve ficar.
>
> **Se um dia o telefone voltar**, são três pontos por página, mais um: a barra do topo
> (visível de 720px para cima), o botão da barra fixa do celular (abaixo de 720px), o
> rodapé, e o cartão "Canais diretos" de `contato.html`. O CSS dos dois primeiros saiu
> junto: `.barra-contato__tel` e `.barra-acao__tel` não existem mais no `style.css`.
> O commit que os trouxe é `ab94c6d`, e o que os tirou está logo depois dele.

O número `(21) 97479-2051` continua sendo o do WhatsApp e continua no `main.js` e no
JSON-LD do index. Trocar o número exige trocar os três lugares.

### O que NÃO deve ser trocado

Já estão corretos e verificados: razão social, CNPJ `69.306.846/0001-50`, endereço na Av. Ator
José Wilker, NIRE, capital social, CNAEs, o domínio `apoiovital.com` e o e-mail
`contato@apoiovital.com`. Em 19/10/2026 foram criados no hPanel, confirmados na API do painel, os
apelidos `privacidade@`, `ouvidoria@` e `financeiro@`, que entregam na caixa de `contato@`, e a
caixa `vagas@`. A sócia enviou um e-mail de teste do Gmail para `ouvidoria@`, `vagas@`, `financeiro@` e
`privacidade@` e informou que os quatro chegaram. Os cinco endereços aparecem no site: rodapé das
25 páginas e cartão "E-mail por assunto" em `contato.html`.

Já foram **desativados de propósito**, e não são marcadores esquecidos: responsável técnica,
inscrição da empresa no COREN-RJ, licença sanitária e CNES. Cada um tem, no HTML, um comentário
explicando por que saiu e como restaurar. Ver a seção 1 deste documento.

### Passo 1: cópia de segurança

```bash
cd "/Users/macpro/Library/Mobile Documents/com~apple~CloudDocs/Site Apoio Vital" && cp -R . ../"Site Apoio Vital BACKUP $(date +%Y%m%d-%H%M)" && echo "Backup criado."
```

### Passo 2: trocar os três valores

Edite os três valores do lado direito antes de rodar. O número do WhatsApp vai **só com
dígitos**, no formato 55 + DDD + número, sem espaço, sem parêntese e sem traço.

```bash
cd "/Users/macpro/Library/Mobile Documents/com~apple~CloudDocs/Site Apoio Vital" && python3 - <<'FIM'
import pathlib

# ===== EDITE AQUI =====
FIXO_VISIVEL = "(21) 0000-0000"      # como aparece escrito na tela
FIXO_LINK    = "+5521000000000"      # o mesmo numero, para o link de ligar
WHATSAPP     = "5521000000000"       # so digitos: 55 + DDD + numero
# ======================

TROCAS = {
    "(21) 97479-2051": FIXO_VISIVEL,
    "+5521974792051":  FIXO_LINK,
    "5521974792051":  WHATSAPP,
}

alvos = [q for q in pathlib.Path(".").rglob("*")
         if q.suffix in {".html", ".js", ".xml", ".txt"}
         and "_backup" not in str(q).lower()
         and ".git" not in str(q)]

total = 0
for q in alvos:
    t = original = q.read_text(encoding="utf-8")
    for de, para in TROCAS.items():
        t = t.replace(de, para)
    if t != original:
        q.write_text(t, encoding="utf-8")
        total += 1
        print("atualizado:", q)
print("\n%d arquivos atualizados." % total)
FIM
```

### Passo 3: conferir

```bash
cd "/Users/macpro/Library/Mobile Documents/com~apple~CloudDocs/Site Apoio Vital" && grep -rn "3000-0000\|552130000000\|5521974792051" --include="*.html" --include="*.js" . | grep -v PREENCHER
```

Se não aparecer nada, está tudo trocado. Depois abra o site e **clique num botão de WhatsApp
de verdade** para confirmar que abre a conversa no número certo.


## 7. Depois de publicar: ligar a medição

A medição já está construída e **desligada**, esperando o site estar no ar. Ela é própria,
roda na sua hospedagem, **não usa cookie e não manda nada para terceiro**.

Isso não é preciosismo. A sua política de privacidade promete, no item 10, que se o site
passar a usar ferramenta de medição que dependa de cookie não essencial, um aviso de cookies
aparece e os scripts só carregam depois do aceite. Google Analytics cairia nessa regra. A
medição própria não cai, porque não usa cookie nenhum.

### Os três passos, depois que o site estiver na Hostinger

**1.** Abrir `assets/js/main.js` e trocar a linha:

```js
endpointMedicao: ''
```

por:

```js
endpointMedicao: '/medir.php'
```

O passo 1 **já está feito**: `assets/js/main.js` já aponta para `/medir.php`.

**2.** A chave do painel **não fica mais no código** e não vai mais na URL. O procedimento
mudou por inteiro, e está num lugar só: **`docs/PAINEL-chave.md`**.

Em resumo: o sal e o hash ficam em `apoio-vital-config/painel-config.php`, pasta irmã da
`public_html`, fora do Git e fora da web. Sem esse arquivo o painel responde 404.

Não recriar a constante `CHAVE` dentro do `painel.php`, e não usar chave curta e
memorizável: foi exatamente isso que vazou o segredo para o código e para o histórico
do Git. A chave é gerada por máquina e mora no gerenciador de senhas.

**3.** Abrir no navegador e entrar pelo formulário:

```
https://apoiovital.com/painel.php
```

Nos primeiros minutos vai aparecer vazio. Clique num botão de WhatsApp do site, espere um
minuto e recarregue o painel.

### O que o painel mostra

De qual página veio cada clique no WhatsApp, de qual botão, em que posição da página o botão
estava, quais perguntas do FAQ são mais abertas, e de onde a pessoa chegou. Com filtro de
7, 30, 90 dias e 1 ano.

### Onde os dados ficam

Num arquivo `.csv` por mês, na pasta `dados-apoio-vital`, **um nível acima de `public_html`**.
Isso é de propósito: a pasta não é acessível pela internet. Para baixar e abrir no Excel, use
o gerenciador de arquivos da Hostinger.

### O que é gravado, e o que não é

| Gravado | Não gravado |
|---|---|
| Data e hora | Endereço de IP |
| Tipo do evento | Cookie ou identificador de pessoa |
| Página e código do botão | Nome, telefone ou e-mail |
| Largura da tela | Qualquer coisa que a pessoa escreveu |
| Domínio de onde veio | Nada do formulário |

### Se um dia você quiser o Google Analytics também

A camada já envia os mesmos eventos para `dataLayer`, `gtag` e Clarity. Basta colar o script
da ferramenta e ela começa a receber tudo. **Mas aí o aviso de cookies passa a ser
obrigatório**, pela promessa do item 10 da política. Nesse caso me chame, porque o aviso
precisa ser feito direito: recusar tão visível quanto aceitar, nada pré-marcado, e script
só depois do aceite.


## 8. O que mudou nesta madrugada

**Identidade aplicada.** Direção 01, petróleo profundo e cru, tirada dos seus próprios projetos de
uniforme. Cor principal `#0D2935`, cru `#DCD9D4`, menta `#8FC5BC` só como filete. Títulos em
Newsreader, texto em Inter a 19px. Criei variantes do logotipo nessa cor em
`assets/img/logo/*-petroleo.svg`, **sem tocar nos originais**.

**Voz recalibrada.** O texto estava provando muito e acolhendo pouco. Reescrevi 27 blocos para
abrir pela pessoa e fechar pelo fato, em home, cuidador, como funciona, preços, sobre e
acompanhante hospitalar.

**Três páginas novas**, dos serviços que o seu CNPJ já cobre:
`servicos/remocao-de-pacientes.html`, `servicos/aluguel-de-equipamento.html` e
`formacao-de-cuidadores.html`. O site passou de 18 para 21 páginas.

**Barra fixa de contato no celular.** O botão redondo do WhatsApp estava cobrindo o botão de ligar.
Virou uma barra com os dois canais lado a lado, que é o padrão que mais converte no setor.

**Seção "o que chega na sua mão".** O relatório diário de cuidados e o plano de cuidados aparecem
desenhados na home, como documentos de verdade. A pesquisa apontou isso como o que o filho que mora
longe realmente compra, e nenhum concorrente do Rio faz.

**Imagens.** Veja o arquivo `IMAGENS.md`. Eu não tenho ferramenta de geração de imagem, então os
prompts estão prontos para você colar no Canva ou em outro gerador. Os encaixes já estão no site com
proporção, carregamento e grade de cor configurados.

### Ainda falta de você

1. Telefone fixo e WhatsApp
2. Nome e COREN da enfermeira responsável técnica, mais a inscrição da empresa no COREN-RJ
3. Número da licença sanitária e do CNES, que você disse já ter
4. Prazo real de substituição de plantão, se existir
5. Se o nome da administradora entra na página Sobre

---

## 9. Pendências que a pesquisa de conhecimento levantou

### Obrigação legal que pode estar faltando

**Registro da empresa no COREN-RJ.** A Lei 6.839/1980 obriga qualquer empresa com atividade de
enfermagem no objeto social a se registrar no conselho da categoria. O seu contrato social tem
"atividades de enfermagem" (CNAE 8650-0/01), então isso se aplica. Taxa de inscrição de pessoa
jurídica por volta de **R$ 497 em 2026**, mais anuidade. Confirme com o contador se já foi feito.

### Citação que vale confirmar antes de usar

A pesquisa indicou a **Lei nº 15.069, de 23 de dezembro de 2024, Política Nacional de Cuidados**,
que estabeleceria o direito de ser cuidado, de cuidar e ao autocuidado. É o enquadramento mais
forte disponível para a culpa de quem contrata. Coloquei o conceito no site **sem citar o número da
lei**, porque não confirmei em fonte primária. Se o seu advogado confirmar, me avise que eu acrescento
a citação e ela ganha peso.

### Dois nomes que não podem ser usados em material comercial

- **Mini Exame do Estado Mental** está sob direito autoral da PAR, Inc. desde 2001, com relato de
  cobrança por aplicação. Não reproduza o formulário nem use o nome em material de divulgação.
- **Snoezelen** é marca registrada. Mesma regra.

### O método que a pesquisa recomenda adotar

**Avaliação ICOPE**, da Organização Mundial da Saúde, aplicada na primeira visita e devolvida à
família como plano escrito. É gratuita, está traduzida ao português pela OPAS, serve a todos os
serviços da empresa, e dá à Apoio Vital uma assinatura metodológica ancorada na OMS.

Dentro dela, o achado mais valioso de toda a pesquisa: a **escala de Zarit mede a filha, não a mãe**.
É o único instrumento que nomeia a exaustão de quem contrata, com um número. Nenhuma empresa do setor
usa isso como ferramenta de relacionamento, e ele transforma a culpa de obstáculo em porta de entrada.

### Currículo do curso de cuidadores, sem custo de direitos

Somando o Guia de Cuidados para a Pessoa Idosa (Ministério da Saúde, 2023), o manual de Tomiko Born
e o Manual de Cuidados Paliativos do Sírio-Libanês com o Ministério da Saúde, são **mais de 900
páginas de conteúdo oficial e gratuito**, suficientes para montar a grade inteira. A pesquisa
desenhou 12 módulos somando cerca de 160 horas, acima das 80 a 120 que a SBGG recomenda.

## 10. Conferências jurídicas: o que foi verificado e o que falta

Atualizado em 17/10/2026.

### Verificado, abrindo a fonte oficial

Todas as normas citadas no site agora levam ao texto oficial, com link. Cada endereço foi
aberto e conferido antes de entrar no site, nenhum veio de resultado de busca sem visita.

| Norma | Fonte |
|---|---|
| RDC ANVISA nº 917/2024 | Diário Oficial da União, 26/09/2024, Edição 187, Seção 1, p. 167 |
| Lei nº 7.498/1986 | Planalto |
| Lei nº 9.656/1998 | Planalto |
| Lei Complementar nº 150/2015 | Planalto |
| Lei nº 13.709/2018, a LGPD | Planalto |
| Lei nº 9.029/1995 | Planalto |
| Lei nº 14.434/2022 | COFEN |
| Estatuto da Pessoa Idosa, Lei nº 10.741/2003 | Planalto |
| Código de Defesa do Consumidor, Lei nº 8.078/1990 | Planalto, texto compilado |
| CLT, Decreto-Lei nº 5.452/1943 | Planalto |
| CBO 5162-10, cuidador | Ministério do Trabalho |
| Resolução COFEN nº 619/2019 | COFEN, frase literal conferida por mim |

### Uma correção importante que isso produziu

**A tabela de quem pode fazer o quê estava errada.** Ela marcava "Sim" para o técnico de
enfermagem na linha de sonda. **Inserir sonda é ato privativo do enfermeiro**, e isso vale para
a vesical, a nasogástrica e a nasoentérica.

A frase está literal na Resolução COFEN nº 619/2019, que eu abri e conferi: *"a inserção de
sonda oro/nasogástrica (SOG e SNG) e sonda nasoentérica (SNE) é privativa do Enfermeiro"*.

A tabela foi refeita em `index.html` e em `servicos.html`, separando o que o técnico de fato
faz no domicílio: cuidar da sonda já instalada, administrar a dieta por ela, executar o
curativo prescrito e aspirar via aérea de pessoa com traqueostomia de longa permanência.

Isso deixou de ser um risco e virou diferencial: nenhum concorrente faz essa distinção.

### Pendente de conferência, não publicar por número

| Item | Situação |
|---|---|
| Resolução COFEN nº 450/2013, sondagem vesical | A regra está aplicada na tabela, mas **o número não é citado no site**. O anexo com a frase literal não abriu para mim. Peça à enfermeira responsável técnica para confirmar antes de citar o número |
| Resolução COFEN nº 787/2025, lesões cutâneas | Mesma situação. A regra está aplicada, o número não é citado |
| Resolução COFEN nº 557/2017, aspiração de vias aéreas | Mesma situação |
| Resolução COFEN nº 736/2024, processo de enfermagem | Mesma situação |

### Três números que NÃO podem ser citados, por estarem revogados ou suspensos

- **Resolução COFEN nº 567/2018**, sobre feridas, revogada pela 787/2025
- **Resolução COFEN nº 358/2009**, sobre SAE, revogada pela 736/2024
- **Resolução COFEN nº 688/2022**, suspensa judicialmente

Nenhum deles aparece no site. Se alguém sugerir incluir, recuse.

