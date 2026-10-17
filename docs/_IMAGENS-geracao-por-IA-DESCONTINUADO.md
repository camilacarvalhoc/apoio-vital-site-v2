# Imagens do site: o que gerar e como

Eu não tenho ferramenta de geração de imagem nesta sessão, então quem gera é você. O que já está
pronto do meu lado é tudo em volta, que é o que decide se a imagem vai somar ou estragar: os
encaixes com proporção certa, o carregamento sem salto de layout, o texto alternativo, e a **grade
de cor em CSS que faz imagens geradas em momentos diferentes parecerem o mesmo ensaio**.

Você gera, salva com o nome exato em `assets/img/fotos/`, e a imagem aparece no lugar certo.

---

## Antes de gerar: três avisos que mudam o resultado

**1. A COFEN restringe imagem em publicidade de serviço de saúde.** Imagem que leia como "nosso
paciente real sendo cuidado" é a mais arriscada. Por isso quase todos os prompts abaixo privilegiam
**mão, detalhe e ambiente**, e o rosto da pessoa idosa aparece pouco. Isso não é timidez estética,
é redução de risco.

**2. A pesquisa do setor apontou foto falsa como um dos maiores destruidores de confiança em home
care.** Imagem de IA erra justamente em mão e em rosto de pessoa idosa, que é o que vamos mostrar.
Gere várias e descarte sem dó qualquer uma com dedo a mais, olhar vidrado ou pele de cera.

**3. Nada disso substitui uma foto real da sua equipe.** Uma foto verdadeira da enfermeira
responsável, com nome e COREN ao lado, converte mais do que qualquer imagem gerada. Estas aqui
seguram o site agora. A sessão de fotos real continua sendo a meta.

---

## O estilo que vale para todas

Cole este trecho no fim de **todo** prompt:

```
photorealistic documentary photography, natural side window light, late
afternoon, interior of a real Brazilian apartment in Rio de Janeiro,
warm neutral palette of deep teal, cream and off-white, muted desaturated
colors, soft shadows, 50mm lens, shallow depth of field, candid unposed
moment, no text, no watermark, no logo
```

E este como **negativo**, no campo de exclusão se o gerador tiver:

```
white infinity studio background, crossed arms, stethoscope around the
neck, blue latex gloves close-up, exaggerated smile, clinical hospital
lighting, cold blue tones, stock photo look, text, watermark, extra
fingers, deformed hands
```

> O Canva aceita prompt em português e funciona bem. Midjourney e Firefly rendem mais em inglês.
> Os prompts abaixo estão em inglês por isso, com a descrição em português ao lado.

---

## Os oito encaixes

Salve tudo em `assets/img/fotos/` com o nome exato da coluna.

### 1. `hero-maos.jpg` · proporção 4:3 · mínimo 1600×1200
A mão de uma pessoa jovem sobre a mão de uma pessoa idosa, apoiada na mesa. Sem rosto.

```
Close-up of a younger woman's hand resting gently over an elderly
woman's hand on a wooden dining table, only hands and forearms visible,
no faces, a cup of coffee slightly out of focus in the background
```

### 2. `cuidador-caminhada.jpg` · 3:2 · 1600×1067
Apoio na caminhada dentro de casa, visto de três quartos ou de costas.

```
A caregiver in a simple deep teal scrub uniform supporting an elderly
woman walking slowly down a corridor inside an apartment, seen from
behind at three-quarter angle, the elderly woman's hand on a walker,
plants and a louvered window in the background
```

### 3. `enfermagem-pressao.jpg` · 3:2 · 1600×1067
Aferição de pressão, foco nas mãos e no aparelho.

```
Close-up of a nurse's hands measuring blood pressure on an elderly
person's arm with a manual sphygmomanometer, seated at a table in a
home living room, focus on the hands and the cuff, the elderly person's
face out of frame
```

### 4. `equipe-plano-de-cuidados.jpg` · 3:2 · 1600×1067
O caderno do plano de cuidados sobre a mesa, com mão escrevendo.

```
A nurse's hand writing on a clipboard with a printed care plan form on
a dining table, reading glasses and a pen beside it, soft window light
from the left, no people's faces visible
```

### 5. `acompanhante-leito.jpg` · 3:2 · 1600×1067
A poltrona do acompanhante ao lado do leito, com luz de janela.

```
A quiet hospital room in the late afternoon, an empty companion armchair
next to a neatly made bed, soft daylight through a window with sheer
curtains, a folded blanket on the chair, no people, calm and dignified
```

### 6. `remocao-cadeira-de-rodas.jpg` · 3:2 · 1600×1067
**A que você pediu.** Pessoa idosa em cadeira de rodas sendo conduzida na porta de casa.

```
A caregiver in a deep teal uniform gently pushing an elderly man in a
wheelchair through the open front door of a residential building in Rio
de Janeiro, seen at three-quarter angle from behind, warm late afternoon
light, tropical plants near the entrance, calm and respectful mood
```

### 7. `equipamento-cama-hospitalar.jpg` · 3:2 · 1600×1067
Cama hospitalar montada em quarto residencial, sem pessoas.

```
A hospital bed set up inside a normal residential bedroom, with home
furniture around it, a bedside table with a lamp and a framed family
photo, curtains and warm afternoon light, no people, tidy and homelike
```

### 8. `como-funciona-conversa.jpg` · 16:9 · 1920×1080
Conversa na mesa da sala, duas pessoas, visto de lado.

```
Two women sitting across a dining table in a home, one in a deep teal
nurse uniform listening and taking notes, the other speaking with her
hands, seen from the side at a distance, neither face in sharp focus,
warm window light, documentary feel
```

---

## Como escolher entre as geradas

Descarte na hora se tiver:

- Dedo a mais, dedo torto, mão com anatomia errada. É o erro mais comum e o mais fácil de notar.
- Olhar vidrado ou pele com aparência de cera.
- Jaleco branco, estetoscópio no pescoço, luva azul em close.
- Pessoas que não parecem brasileiras.
- Fundo branco de estúdio.
- Sorriso exagerado. O tom certo é sereno, não publicitário.

Gere **pelo menos seis variações de cada** e escolha uma. A taxa de descarte saudável nesse tipo de
imagem passa de 80%.

---

## Depois de salvar os arquivos

Me avise que eu encaixo as imagens nas páginas, com texto alternativo descritivo, carregamento
preguiçoso e reserva de espaço para não haver salto de layout. Enquanto os arquivos não chegam, os
encaixes mostram a marca d'água do batimento cardíaco em vez de um retângulo cinza quebrado.

Se preferir, também dá para você gerar direto no Canva, que você já tem, e exportar em JPG com
qualidade alta.
