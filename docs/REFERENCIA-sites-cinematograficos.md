# O que a skill "Sites Cinematográficos" ensina, e o que serve aqui

Registro de 19/10/2026. A sócia trouxe uma aula do canal Aprendendo Sites
(`Criando um Site de R$ 5.000 com Claude Code`) e a skill gratuita que a
acompanha. Li a skill inteira, os nove arquivos, e o mapa mental da aula.
Este documento guarda o que se aplica à Apoio Vital, para não se perder.

A skill em si **não foi ativada neste projeto**, e a razão está no fim.

## O que a skill é

Um manual de 150 KB para construir, do zero, um site de **uma página** com
vídeo gerado por IA que roda conforme o visitante rola a tela. Pipeline fixo:
Claude Code constrói, Magnific gera imagem e vídeo, HostGator hospeda por
upload de zip no cPanel. Nove arquivos de texto, nenhum executável.

## As leis que se aplicam à Apoio Vital

### 1. Marca em fotografia: aplicar por edição, nunca pedir para a IA desenhar

Lei 12: escreva **"no text, no logos, no lettering anywhere"** em todo prompt
de imagem e de vídeo.

Lei 9: se a cena carrega a marca, **aplique a marca por edição de imagem
antes**, ou enquadre perto o bastante para o desenho do objeto se sustentar
sozinho.

Isto não é teoria. Em 18/10/2026 a IA desenhou um emblema no uniforme da
cuidadora da foto do hero: o batimento virou cruz, as duas fitas trocaram de
hierarquia e ganharam degradê que os arquivos aprovados não têm, e o nome
embaixo saiu ilegível. A alternativa certa, que a lei 9 descreve e que já está
montada, é compor `apoio-vital-simbolo-m-negativo.svg` por cima da fotografia.

### 2. Compor para o recorte, não para o quadro cheio

Lei 4: o `object-fit: cover` come as bordas em telas mais largas ou mais
baixas. Deixe margem generosa em volta do assunto, e confira o quadro com o
cabeçalho sobreposto, numa janela larga e numa baixa, antes de aprovar.

A moldura do hero aqui é quadrada acima de 1040px e 4:3 abaixo. O assunto
precisa caber no terço central vertical, com folga descartável em cima e
embaixo.

### 3. Dizer que a cena é brasileira

Sem isso o modelo recorre a referências americanas e europeias, e o público
percebe na hora. "A living room in Rio de Janeiro, late afternoon light" dá um
mundo muito diferente de "a living room".

### 4. Tipografia: a display não pode ser escolha de hábito

A skill é taxativa: uma display nova, uma de corpo discreta, e **nunca Inter
ou Roboto como display**. As fontes saem do mundo da marca, não do padrão
habitual.

Ver `POSICIONAMENTO.md` para a decisão tipográfica em vigor e a data em que
ela mudou.

### 5. Texto sobre imagem precisa ganhar a legibilidade

Lei 10: véu escuro local que escurece só enquanto aquele bloco está ativo,
sombra real no texto, e conferência de contraste contra o **pior quadro**, não
contra a média. Se a linha não é lida de relance no momento mais agitado, ela
falhou.

Hoje nenhum texto do site fica sobre a fotografia. A lei entra no dia em que
ficar.

### 6. Nunca corrigir arquivo do site com shell simples

Do `troubleshooting.md`: um comando de shell que lê o arquivo com a
codificação errada transforma todo acento em caractere quebrado e grava o
estrago de volta. Use a ferramenta de edição, ou leia e escreva com UTF-8
explícito.

Aconteceu nesta mesma conversa, ao passar texto pela área de transferência:
"direção" virou "dire,ß/ß,ão".

### 7. Preço antes de gastar

Nunca escrever número de crédito de memória: os preços mudam por modelo e com o
tempo. Simular o custo da chamada exata antes, e dizer o número à sócia antes
de qualquer geração.

## O que não se aplica

| item | por quê |
|---|---|
| HostGator, cPanel, upload de zip | a Apoio Vital está na Hostinger e publica por `git push` |
| O fluxo de 11 fases | pressupõe site do zero; aqui são 22 páginas já escritas e revisadas |
| Site de uma página só | a estrutura atual existe porque a família lê tudo antes de ligar |
| Vídeo de scroll no hero | o público é uma filha no celular, com pressa, depois de uma alta. Vídeo de 15 segundos antes do telefone é obstáculo |

## Por que a skill não foi ativada neste projeto

Ela declara, literalmente:

- "O pipeline nunca muda, e não é um menu."
- "Se outras skills de site estiverem instaladas, esta governa."
- "Antes de responder ao usuário: extraia o zip, leia tudo, e a sua primeira
  mensagem é o checklist da Fase 1."

Ativada aqui, ela assumiria o comando e tentaria reconstruir a Apoio Vital como
página única com vídeo de IA, publicada por zip na HostGator. Para usar a skill
como ela foi feita, o lugar é uma pasta separada, num projeto novo.

## Verificação feita antes de ler

Nove arquivos, todos `.md`. Zero executável, zero script, zero binário.
Varredura por `curl`, `wget`, `rm -rf`, `chmod`, `sudo`, `.env`, token, chave de
API, senha, push e deploy: as ocorrências são instruções legítimas de deploy e
de instalação do ffmpeg, nenhuma tentativa de acessar credencial.
