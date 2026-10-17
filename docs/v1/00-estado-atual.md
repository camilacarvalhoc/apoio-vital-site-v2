# Estado atual do projeto

Atualizado em 17/10/2026, ao fim da primeira fase de trabalho.

## Em uma frase

O site está **pronto e versionado**, mas **não está no ar**: o domínio ainda serve a página
de boas-vindas da Hostinger. Falta uma ação no painel para publicar.

## O que existe

O site é uma página única com nove seções: abertura, modalidades de plantão, barra de
confiança, quem somos, serviços, como funciona, FAQ, contato e rodapé institucional. Tem
formulário com consentimento LGPD, aviso de emergência apontando o SAMU, dados jurídicos
completos no rodapé e JSON-LD de `MedicalBusiness`.

Último commit: `70ec8ec`.

O texto é deliberadamente concreto — fala em "substituição de profissional em até 4 horas",
"valor fixo em contrato com reajuste pelo INPC", "documentação e antecedentes conferidos antes
do primeiro plantão". Isso não é acaso: num setor em que todo mundo promete carinho e
excelência, o compromisso verificável é o que diferencia. **Preservar essa qualidade é mais
importante que qualquer melhoria visual.**

## O que trava o quê

### 1. Publicação — parada em uma ação de painel

A infraestrutura está contratada e ativa. O que falta:

- **Apagar `default.php` de `public_html`.** É a página de boas-vindas da Hostinger, o único
  arquivo lá. A integração de Git exige a pasta vazia.
- **Conectar o Git** no hPanel, em Avançado → Git, apontando para `camilacarvalhoc/apoio-vital-site`,
  branch `main`, destino `public_html`.

Já resolvido, verificado de fora em 17/10: **SSL ativo e redirecionamento HTTP→HTTPS ligado**
(`http://apoiovital.com` devolve 301). Ressalva: a verificação foi feita através de um proxy,
então é evidência indireta do certificado do servidor.

### 2. Pendências técnicas conhecidas

- **`www` e sem-`www` respondem ambos com 200**, sem canonização entre eles. Conteúdo
  duplicado em dois endereços.
- **Não existe `.htaccess`.** Precisa de quatro coisas: bloquear `/.git` (a integração de Git
  clona o repositório dentro da raiz web, e `apoiovital.com/.git/config` pode ficar público),
  apontar o `ErrorDocument 404` para `/404.html`, redirecionar `www` para sem-`www`, e dar
  cache **curto** ao HTML — com cache longo, uma correção de texto levaria dias para chegar a
  quem já visitou.
- Vai sozinho num commit, sem misturar com mudança de conteúdo: erro de sintaxe em `.htaccess`
  derruba o site inteiro, e commit isolado é trivial de reverter.

### 3. Pendências regulatórias — bloqueiam a divulgação, não a publicação

- **Não há responsável técnico** contratado nem registrado no conselho.
- **Não há licença sanitária** da Vigilância do Rio.
- **Não há inscrição no CNES.**

O rodapé tem dois marcadores `[PREENCHER]` invisíveis ao visitante. O selo que afirmava
conformidade com a Resolução CFM nº 2.336/2023 **foi desativado** no commit `70ec8ec` e hoje
diz apenas "Identificação da empresa", porque a afirmação original era falsa.

Isso é mais grave do que parece: operar um serviço de atenção domiciliar sem alvará, RT e CNES
é infração sanitária **independente do que o site diga**. O site não cria o problema — mas, se
afirmasse conformidade, o documentaria por escrito e de forma datada. Ver `docs/04-regulatorio.md`.

### 4. Marca — decisão tomada, com risco conhecido

Existe registro em vigor "APOIO VITAL HOME SAÚDE" (processo 921805373, titular VITALMED,
classe 44) cuja especificação cobre literalmente "Enfermagem", "Serviços de enfermagem
domiciliar" e "UTI móvel". A decisão de **manter o nome** foi tomada pela responsável com esse
quadro à vista. Ver `docs/02-marca-vitalmed.md`.

Datas que importam: a janela para pedir caducidade do registro por desuso abre em
**18/01/2027**.

## Ordem recomendada

1. Apagar `default.php` e conectar o Git — o site vai ao ar
2. Verificar se `/.git/config` ficou exposto; se sim, `.htaccess` vira urgente
3. `.htaccess` em commit isolado
4. Responsável técnico e licença sanitária — destravam o selo de conformidade e são
   pré-requisito do depósito de marca
5. Depósito da marca, em 44, 39 e 41

## Erro que não deve se repetir

Todo o trabalho analítico desta fase — dossiê de marca, análise de copy, roteiro de registro —
foi produzido em diretório temporário e **se perdeu quando o container foi recriado**. O código
sobreviveu porque estava versionado; o conhecimento não. É por isso que esta pasta `docs/`
existe. **O que não está no repositório não existe.**
