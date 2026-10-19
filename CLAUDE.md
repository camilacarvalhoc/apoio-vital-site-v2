# Apoio Vital — site institucional

Site da Apoio Vital Gestão de Cuidados e Acompanhamento Ltda., empresa de atenção domiciliar
do Rio de Janeiro. CNPJ 69.306.846/0001-50.

O público é a família de um paciente, quase sempre no celular, decidindo sob pressão depois de
uma alta hospitalar ou de uma perda de autonomia. O site existe para essa pessoa entender o
serviço e falar com alguém.

**Antes de mexer em qualquer coisa, leia `docs/v1/00-estado-atual.md` e `docs/PREENCHER.md`.**
Há pendências regulatórias e um conflito de marca em aberto que mudam o que pode ser escrito.

## Estrutura

HTML, CSS e JavaScript puros. Sem build, sem framework, sem banco de dados. Três arquivos PHP
para o que precisa de servidor.

```
*.html              23 páginas públicas
_modelo*.html       moldes que geram as páginas, bloqueados no .htaccess
assets/css/style.css   folha única, com as variáveis de cor em :root
assets/js/main.js      interatividade, tudo como reforço
enviar.php          formulários por e-mail
medir.php           medição própria, sem cookie
painel.php          leitura da medição
.htaccess           HTTPS, canônica, cache, segurança, bloqueios
docs/               documentação interna, bloqueada na web
```

## Regras que não se quebram

**Nada que não seja verdade.** A empresa **não tem responsável técnico registrado** nem
inscrição no COREN-RJ: os dois estão em andamento, segundo a sócia em 18/10/2026. O site não
pode afirmar que tem.

Na mesma data a sócia informou que a empresa **tem alvará, licença sanitária e CNES**, o que
inverte a premissa anterior deste arquivo. Mesmo assim **nada foi religado**, e nada deve ser:
ela não forneceu o número de nenhum dos três, e número conferido é a condição para publicar.
Publicar "temos licença sanitária" sem o número é adjetivo, que é exatamente o que a pesquisa
de mercado condenou nos concorrentes. Ver `docs/RESPOSTAS-operacao.md`.

Os blocos correspondentes seguem desativados no HTML, com comentário explicando como
restaurar. Restaurar antes de ter o número é regressão, não melhoria.

**O que a operação de fato é, confirmado pela sócia, e que o site levou um dia inteiro para
parar de contradizer:** os profissionais são pessoa jurídica e autônomos, não CLT; quem
acompanha a execução do trabalho é o próprio profissional; a supervisão é sob demanda, por
profissional que ela não identificou; quatro dos sete serviços do site são apenas planejados;
e a empresa já opera sem contrato formal. Qualquer texto novo tem que caber nisso. O confronto
página a página está em `docs/CONFRONTO-operacao.md`.

**"Regido pela" e não "em conformidade com"** a RDC ANVISA nº 917/2024. Diferença de duas
palavras e de peso jurídico inteiramente distinto.

**Nada funciona só com JavaScript.** Os botões de WhatsApp têm o endereço no HTML, os
formulários têm `action` e `method`. Teste com o script desligado antes de cada publicação.

**Sem travessão, sem superlativo, sem autoelogio, sem marketing de medo.** Publicidade em
saúde não admite, e não convence quem está com medo. "Ente querido" não: é registro de velório.

**Publicidade vincula.** Cada prazo e cada "24h" vira obrigação contratual exigível. Nenhum
número novo entra sem confirmação da sócia.

**Imagem de IA: a regra mudou em 19/10/2026, por decisão expressa da sócia.**
Até 18/10 era proibido usar imagem de IA representando equipe, paciente ou a casa. Apresentei
a ela as três saídas para o espaço da fotografia e mostrei, antes da escolha, o texto desta
regra e o motivo registrado em `docs/FOTOGRAFIA.md`: no dia em que alguém percebe que a
cuidadora da foto não existe, o que cai não é a imagem, é a confiança em tudo que o site
afirma. Ciente disso, ela escolheu publicar a fotografia gerada por IA. É a empresa dela e a
regra era dela.

**O que continua valendo, e não é negociável:**

- A marca na imagem é o arquivo aprovado, composto por edição. **Nunca** peça à IA que desenhe
  o logotipo: ela inventa um parecido. Já aconteceu, em 18/10, e está documentado em
  `docs/REFERENCIA-sites-cinematograficos.md`.
- O texto alternativo e qualquer legenda **não afirmam** que as pessoas da foto são
  profissionais ou clientes da Apoio Vital. A empresa não tem clientes, e afirmar isso seria o
  art. 37 §1º do CDC, publicidade enganosa por omissão.
- Nada de procedimento clínico na imagem: a empresa oferece cuidador e acompanhante
  hospitalar, não enfermagem.

**Citação jurídica só com fonte aberta e conferida.** As normas do site levam ao Planalto, ao
Diário Oficial e ao COFEN. Três resoluções do COFEN não podem ser citadas por estarem revogadas
ou suspensas: 567/2018, 358/2009 e 688/2022.

**Não tocar em MX, SPF, DKIM, DMARC nem nos nameservers.** Eles sustentam o
contato@apoiovital.com. Ver `docs/v1/03-infraestrutura.md`.

**O que não está no repositório não existe.** A primeira fase do projeto perdeu todo o trabalho
analítico por deixá-lo em pasta temporária. Escreva no repositório o que precisar sobreviver.

## Como testar antes de publicar

1. Servir por HTTP, não por `file://`.
2. Com o JavaScript desligado: WhatsApp, telefone, menu e formulário continuam funcionando.
3. Em 1400 px e em 390 px, sem rolagem horizontal e com console limpo.
4. Impressão: nenhum bloco sai com opacidade menor que 1.
5. Varredura: zero link quebrado, zero JSON-LD inválido, zero HTML desbalanceado, zero dado de
   exemplo, zero travessão.
