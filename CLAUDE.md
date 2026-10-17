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
*.html              22 páginas públicas
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

**Nada que não seja verdade.** A empresa ainda não tem responsável técnico registrado, licença
sanitária nem CNES. O site não pode afirmar que tem. Os blocos correspondentes estão
desativados no HTML, com comentário explicando como restaurar. Restaurar antes de existirem é
regressão, não melhoria.

**"Regido pela" e não "em conformidade com"** a RDC ANVISA nº 917/2024. Diferença de duas
palavras e de peso jurídico inteiramente distinto.

**Nada funciona só com JavaScript.** Os 150 botões de WhatsApp têm o endereço no HTML, os
formulários têm `action` e `method`. Teste com o script desligado antes de cada publicação.

**Sem travessão, sem superlativo, sem autoelogio, sem marketing de medo.** Publicidade em
saúde não admite, e não convence quem está com medo. "Ente querido" não: é registro de velório.

**Publicidade vincula.** Cada prazo e cada "24h" vira obrigação contratual exigível. Nenhum
número novo entra sem confirmação da sócia.

**Nenhuma pessoa inventada por máquina.** Proibido usar imagem de IA representando equipe,
paciente ou a casa. Ver `docs/FOTOGRAFIA.md`.

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
