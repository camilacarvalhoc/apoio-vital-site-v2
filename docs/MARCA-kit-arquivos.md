# Onde estao os arquivos da marca

Em 18/10/2026 o kit da marca saiu do repositorio. Ficaram em `assets/img/logo/`
apenas os cinco arquivos que as paginas carregam. Os outros 37 foram movidos,
inteiros e sem alteracao, para fora do projeto.

**Destino:** `04 Apoio Vital/Apoio Vital - Logos/Kit do site/`, no iCloud, com
as subpastas `SVG (vetor)` e `PNG (imagem)`, na mesma convencao das outras
pastas de logo.

Nada foi apagado. Cada arquivo foi conferido por hash depois de movido, e os
37 continuam no historico do Git: `git show <commit>^:assets/img/logo/<nome>`
devolve qualquer um deles.

Eles nao foram para dentro de `SVG (vetor)` e `PNG (imagem)` direto porque onze
tem o mesmo nome de arquivos que ja estavam la, com conteudo diferente. A
subpasta propria evita sobrescrever o que era seu.

## Os cinco que ficaram, e por que

| arquivo | onde e usado |
|---|---|
| `apoio-vital-assinatura-h.svg` | cabecalho das 22 paginas e dos dois moldes |
| `apoio-vital-assinatura-h-negativo.svg` | rodape das 22 paginas e dos dois moldes |
| `apoio-vital-assinatura-h-nome.svg` | 22 paginas e os dois moldes |
| `apoio-vital-assinatura-h.png` | `index.html`, imagem do compartilhamento |
| `apoio-vital-simbolo-m-mono-reduzido.svg` | `assets/css/style.css` e `index.html` |

Depois da mudanca, as 50 referencias de imagem do site foram conferidas uma a
uma, resolvidas a partir do arquivo que cita cada uma: zero quebrada.

## Consequencia para os scripts de vetorizacao

`docs/vetorizacao/` le arquivos que agora estao fora do repositorio:

| script | arquivo que ele le |
|---|---|
| `assinatura.py` | `apoio-vital-simbolo-m.svg` e `apoio-vital-simbolo-m-negativo.svg` |
| `extrai.py` | `apoio-vital-principal.svg` |

Para rodar qualquer um deles de novo, copie antes os arquivos do `Kit do site`
de volta para `assets/img/logo/`. Os scripts nao foram alterados: o caminho que
eles usam continua sendo o do repositorio.

## O que foi movido

### SVG (vetor)

- `apoio-vital-assinatura-h-nome-negativo.svg`
- `apoio-vital-horizontal-branco.svg`
- `apoio-vital-horizontal-duas-cores.svg`
- `apoio-vital-horizontal-mono.svg`
- `apoio-vital-horizontal-negativo.svg`
- `apoio-vital-horizontal-petroleo.svg`
- `apoio-vital-horizontal-preto.svg`
- `apoio-vital-horizontal.svg`
- `apoio-vital-icone.svg`
- `apoio-vital-principal-branco.svg`
- `apoio-vital-principal-duas-cores.svg`
- `apoio-vital-principal-negativo.svg`
- `apoio-vital-principal-preto.svg`
- `apoio-vital-principal.svg`
- `apoio-vital-selo-menta.svg`
- `apoio-vital-selo.svg`
- `apoio-vital-simbolo-branco.svg`
- `apoio-vital-simbolo-compacto.svg`
- `apoio-vital-simbolo-duas-cores.svg`
- `apoio-vital-simbolo-m-mono.svg`
- `apoio-vital-simbolo-m-negativo.svg`
- `apoio-vital-simbolo-m-reduzido.svg`
- `apoio-vital-simbolo-m.svg`
- `apoio-vital-simbolo-negativo.svg`
- `apoio-vital-simbolo-petroleo.svg`
- `apoio-vital-simbolo-preto.svg`
- `apoio-vital-simbolo.svg`
- `apoio-vital-vertical-negativo.svg`
- `apoio-vital-vertical-petroleo.svg`
- `apoio-vital-vertical-preto.svg`
- `apoio-vital-vertical.svg`

### PNG (imagem)

- `apoio-vital-horizontal-mono.png`
- `apoio-vital-horizontal-negativo.png`
- `apoio-vital-horizontal.png`
- `apoio-vital-icone.png`
- `apoio-vital-simbolo.png`
- `apoio-vital-vertical.png`
