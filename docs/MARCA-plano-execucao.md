# Apoio Vital — plano de execucao da identidade

Juncao do plano estruturado no ChatGPT (Etapas 5 a 7) com o que foi medido aqui.
Onde os dois divergem, a divergencia esta escrita, nao resolvida por omissao.

## Onde o projeto esta

| Etapa | Situacao | Evidencia |
|---|---|---|
| 1-3 Briefing, estrategia, conceito | concluidas | decisao da socia |
| 4 Reconhecimento do simbolo | **concluida** | `docs/MARCA-reconhecimento.md` |
| 5 Avaliacao tecnica | **concluida**, com dois achados | mesmo arquivo |
| 6 Preparacao tecnica dos arquivos | **travada** | nao existe matriz vetorial |
| 7 Regras de aplicacao | definida no papel, sem medidas | depende da Etapa 6 |
| Paleta | fechada, aplicada e auditada | `docs/MARCA-contraste.md` |
| Site | atualizado local, com a paleta nova | nao publicado ate 17/10 |

## O bloqueio, dito com todas as letras

O plano do ChatGPT pede, em tres etapas seguidas, a "matriz original" do simbolo.
Ela **nao existe**. O desenho aprovado e imagem rasterizada gerada por IA. Dela
nao saem, com fidelidade: SVG, EPS, PDF vetorial, favicon nitido, arquivo de
bordado, nem ampliacao para fachada.

Tres caminhos, com o custo de cada um:

1. **Vetorizar por tracado.** A silhueta aprovada e tracada e convertida em
   caminhos. Preserva a forma exata; nao recupera as curvas originais do
   desenhista. Serve para digital e tamanho pequeno. Para fachada e impressao
   grande, a suavidade do contorno depende da resolucao da origem.
2. **Redesenhar sobre o tracado**, com curvas limpas, por quem desenha.
   E o unico caminho que entrega qualidade de impressao grande.
3. **Esperar** um arquivo-fonte que, pelo que se sabe hoje, nao existe.

O caminho 1 desbloqueia o site agora. O caminho 2 continua necessario para
fachada, uniforme bordado e papelaria.

## Divergencias com o plano do ChatGPT

**1. "Converter a reconstrucao em logo oficial" x tracar o aprovado.**
Ele recusa tratar a reconstrucao dele como matriz, e esta certo. Mas tracar o
desenho que a socia aprovou nao e reconstruir: e preservar a mesma silhueta.
Sao coisas diferentes e so a segunda destrava a Etapa 6.

**2. Sete versoes de arquivo.**
LOGO-01 a 03 e SIM-01 a 04 sao sete versoes antes de existir uma. A ordem util e
inversa: primeiro a versao plana de uma tinta, que e a que prova o desenho, e a
reduzida; as demais saem dessas duas. Multiplicar variacao sem aplicacao real
contraria a regra 10 do proprio plano dele.

**3. A narrativa.**
O plano dele mantem "M de Monica" como leitura da marca. O teste mostrou
**0 de 9** leitores vendo M primeiro e **nenhum** com confianca alta nem quando
induzido. A recomendacao e preservar o simbolo e reescrever o conceito para o
que ele comunica. Isso nao e alterar o desenho; e parar de cobrar do publico uma
leitura que ele nao faz.

**4. O regime regulatorio esta ausente.**
O documento de contextualizacao nao cita uma linha da norma que governa este
negocio, e a etapa de aplicacoes e onde isso colide. Ver a secao seguinte.

## O que a marca nao pode fazer, por norma

Extraido do que ja esta verificado em `docs/v1/04-regulatorio.md` e no `CLAUDE.md`.

- **"Home care" serve na assinatura comercial.** A linha legal do site diz
  *atencao domiciliar regida pela RDC ANVISA no 917/2024*. Registros diferentes,
  os dois precisam existir.
- **Nenhuma peca afirma responsavel tecnica, licenca sanitaria ou CNES**
  enquanto nao houver. Restaurar antes de existir e regressao.
- **Publicidade vincula**, CDC art. 37, paragrafo 1o. "Presenca que cuida em
  todos os momentos" e afirmacao absoluta e exigivel. Decidir se fica.
- **Nenhuma imagem de IA representando equipe, paciente ou a casa.** Todas as
  pranchas de marca usam pessoas geradas. Nenhuma pode migrar para o site, o
  Instagram ou material impresso. Ver `docs/FOTOGRAFIA.md`.
- **A folha e o lotus saem** do conjunto de icones.

## Tensao entre o briefing e o site construido

O briefing define publico de alta renda, posicionamento premium e a diretriz de
nao competir por preco. O site argumenta pelo caminho oposto: CNPJ no rodape,
pagina de precos com a conta aberta, a lei citada com link, avaliacao sem custo.

Os dois convivem — credibilidade e uma forma de premium, e foi assim que o site
foi escrito. Mas a etapa de aplicacoes vai pedir decisao sobre a pagina de
precos e sobre o tom. Registrado agora para ser decidido la, sem reabrir nada.

## Sequencia proposta

**A. Agora, sem depender de nada**
1. Publicar o site com a paleta nova e as correcoes acumuladas. O simbolo
   continua o antigo ate existir vetor.

**B. Assim que o arquivo do simbolo isolado estiver em disco**
2. Tracar a silhueta aprovada e gerar o SVG plano de uma tinta.
3. Produzir a **versao reduzida** para abaixo de 32 px, com o batimento
   engrossado, e validar em 16, 24 e 32 px.
4. **Equalizar as duas metades**, de 2,04x para perto de 1,2x.
5. Gerar, a partir dessas duas, as versoes negativa e monocromatica.
6. Trocar o simbolo no site e refazer favicon, apple-touch-icon e imagem de
   compartilhamento.

**C. Depois**
7. Area de protecao e tamanho minimo, medidos no desenho, nao arbitrados.
8. Manual: paleta e funcoes, matriz de contraste, versoes, usos proibidos,
   e a secao regulatoria acima.
9. Encaminhar a quem desenha o redesenho limpo para impressao grande.

## Verificacao

- Varredura de contraste nas 22 paginas, texto e componente: zero reprovacao.
- Teste com JavaScript desligado: WhatsApp, menu e formulario funcionando.
- Impressao: nenhum bloco com opacidade menor que 1.
- 1400 px e 390 px sem rolagem horizontal, console limpo.
- Zero dado de exemplo, zero afirmacao de conformidade inexistente.
