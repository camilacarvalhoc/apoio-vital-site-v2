# Painel de medicao: como a chave funciona

> **Estado em 18/10/2026: em teste controlado.** O codigo novo esta publicado
> como `painel-novo.php`, e o `painel.php` que atende hoje continua com o
> mecanismo antigo, intocado. A promocao so acontece depois que o temporario
> for testado com a configuracao instalada. Este documento descreve o estado
> de destino.

## O que estava errado

A chave era uma constante escrita dentro do `painel.php`, e entrava pela URL,
como `painel.php?chave=...`. Tres consequencias:

1. **Estava no codigo**, e portanto no repositorio e no historico do Git. Apagar
   num commit seguinte nao remove o que ja subiu.
2. **Estava na URL**, e URL fica no historico do navegador, nos registros de
   acesso do servidor e no cabecalho de referencia enviado a terceiros.
3. **Estava no HTML da propria pagina**: os links de 7, 30, 90 dias e 1 ano
   repetiam a chave.

## O que passou a valer

A chave **nao esta em lugar nenhum do repositorio**. O que o servidor guarda e
um sal e um HMAC-SHA256, num arquivo fora da pasta publica.

```
domains/apoiovital.com/
├── painel-config.php       <- sal e hash. Fora do Git, fora da web.
├── dados-apoio-vital/      <- os CSV da medicao, como ja era
└── public_html/            <- o site, que o deploy por Git sobrescreve
    └── painel.php
```

O arquivo fica **irmao** da `public_html`, pelo mesmo motivo que a pasta de
dados: o deploy por Git substitui o conteudo da pasta publica, e o que
estiver dentro dela seria sobrescrito ou publicado.

**Sem esse arquivo o painel responde 404.** Nao existe chave padrao de reserva:
faltando configuracao, nao ha acesso. E proposital.

A chave entra por **formulario**, nao pela URL, e a sessao sustenta a navegacao.
O cookie e `HttpOnly`, `SameSite=Strict` e `Secure`. A pagina manda
`Referrer-Policy: no-referrer` e `Cache-Control: no-store`.

## Por que HMAC-SHA256 e nao password_hash

A chave e gerada por maquina, com 160 bits de aleatoriedade, e nunca digitada de
memoria: vem do gerenciador de senhas. Hash lento como bcrypt existe para
proteger senha humana de baixa entropia contra forca bruta; com 160 bits isso
nao muda nada. E o HMAC e reproduzivel sem depender de variacao de formato de
bcrypt entre linguagens.

**Consequencia:** a chave precisa continuar sendo uma chave gerada. Se um dia
alguem trocar por uma senha curta e memorizavel, essa escolha deixa de valer e o
certo passa a ser `password_hash`.

## Como instalar

1. Enviar `painel-config.php` para a pasta **irma** da `public_html`, que no
   servidor e `domains/apoiovital.com/`, a mesma onde ja esta a pasta
   `dados-apoio-vital`. **O nome precisa ser exatamente `painel-config.php`**:
   o codigo procura esse e so esse. Com outro nome o painel responde 404 e nao
   ha mensagem que explique.
2. Guardar a chave no gerenciador de senhas e **apagar o arquivo de texto**.
3. Abrir `https://apoiovital.com/painel.php`, entrar com a chave nova.
4. Conferir que a chave antiga nao funciona mais.

Os dois arquivos sao gerados fora do iCloud e fora do repositorio, de proposito:
o `.gitignore` impede o Git de ver, mas nao impede a sincronizacao de nuvem.

## O que ainda falta

Trocar a chave e tirar do codigo **nao remove** a chave antiga do historico do
Git. Sao medidas complementares. A limpeza do historico e passo proprio, e so
faz sentido depois que a chave antiga ja nao vale, que e o caso assim que este
painel subir.

Enquanto o repositorio for privado nao ha exposicao publica. Mas a chave antiga
continua la, e por isso ela foi invalidada em vez de apenas escondida.
