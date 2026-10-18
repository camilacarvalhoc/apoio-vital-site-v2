# -*- coding: utf-8 -*-
"""Monta a assinatura horizontal da Apoio Vital a partir de material ja aprovado.

Nada aqui redesenha a marca. O simbolo vem inteiro do SVG vetorizado e aprovado;
as letras de APOIO VITAL vem dos contornos do logotipo existente, apenas
reposicionadas numa linha so; HOME CARE e composto em Figtree, porque as letras
H, M, C, R e E nunca existiram como vetor aprovado.
"""
import json, os, re, sys
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))
from bbox_util import caixa_do_d

SC   = os.environ["SC"]
RAIZ = "/Users/macpro/Library/Mobile Documents/com~apple~CloudDocs/Site Apoio Vital/assets/img/logo"

# ---- medidas da composicao, em unidades de altura de maiuscula de APOIO VITAL
CAP        = 100.0   # altura de maiuscula de APOIO VITAL
TRACK      = 15.0    # entreletra, calibrada para bater a razao 9,0 da prancha
ESPACO     = 50.0    # espaco entre APOIO e VITAL
CAP_HC     = 41.0    # altura de maiuscula de HOME CARE: 0,41 da prancha
VAO_LINHAS = 41.0    # vao entre a base do nome e o topo do descritor: 0,41
VAO_SIMB   = 50.0    # 0,50 maiuscula, definido pelo ChatGPT
RAZAO_HC   = 12.4    # largura/altura-de-maiuscula de HOME CARE na prancha

BLOCO_H = CAP + VAO_LINHAS + CAP_HC          # 182: altura do bloco tipografico
SIMB_H  = BLOCO_H                            # ancora B

COR = {
    "claro":  {"nome": "#1F5D6B", "hc": "#854930", "fundo": "#F3F0E8"},
    "escuro": {"nome": "#F3F0E8", "hc": "#8FC5BC", "fundo": "#1B4B57"},
}

def paths_do_svg(caminho):
    txt = open(caminho).read()
    out = []
    for m in re.finditer(r'<path d="([^"]+)"([^>]*)/>', txt):
        out.append((m.group(1), m.group(2)))
    return out

def simbolo(variante):
    arq = "apoio-vital-simbolo-m.svg" if variante == "claro" else "apoio-vital-simbolo-m-negativo.svg"
    ps = paths_do_svg(os.path.join(RAIZ, arq))
    xs0 = ys0 = 1e9; xs1 = ys1 = -1e9
    for d, _ in ps:
        a, b, c, e = caixa_do_d(d)
        xs0, ys0, xs1, ys1 = min(xs0,a), min(ys0,b), max(xs1,c), max(ys1,e)
    return ps, (xs0, ys0, xs1-xs0, ys1-ys0)

def letras_uma_linha():
    L = json.load(open(SC + "/assin/letras.json"))
    seq = []
    x = 0.0
    for i, grupo in enumerate(("APOIO", "VITAL")):
        if i: x += ESPACO
        for j, l in enumerate(L[grupo]):
            if j: x += TRACK
            a, b, c, e = caixa_do_d(l["d"])
            seq.append((l["d"], x - a))        # encosta a tinta da letra em x
            x += (c - a)
    return seq, x

def home_care(largura_alvo):
    from fontTools.ttLib import TTFont
    from fontTools.pens.svgPathPen import SVGPathPen
    f = TTFont(SC + "/assin/fonte/figtree-400.ttf")
    gs = f.getGlyphSet(); cmap = f.getBestCmap(); hmtx = f["hmtx"]
    s = CAP_HC / 700.0                          # capHeight 700 em upm 1000
    glifos = []; natural = 0.0; n_vaos = 0
    for ch in "HOME CARE":
        if ch == " ":
            glifos.append((None, hmtx[cmap[ord(" ")]][0] * s)); natural += hmtx[cmap[ord(" ")]][0]*s
            continue
        g = cmap[ord(ch)]
        pen = SVGPathPen(gs); gs[g].draw(pen)
        glifos.append((pen.getCommands(), hmtx[g][0] * s))
        natural += hmtx[g][0] * s
    n_vaos = len(glifos) - 1
    track = (largura_alvo - natural) / n_vaos   # distribui a sobra como entreletra
    return glifos, track, s

def monta(variante, com_hc):
    ps, (sx0, sy0, sw, sh) = simbolo(variante)
    k = SIMB_H / sh
    simb_larg = sw * k
    seq, nome_larg = letras_uma_linha()
    x_texto = simb_larg + VAO_SIMB
    larg_total = x_texto + nome_larg
    c = COR[variante]

    partes = ['<g transform="translate(%.3f %.3f) scale(%.5f)">' % (-sx0*k, -sy0*k, k)]
    for d, attrs in ps:
        partes.append('<path d="%s"%s/>' % (d, attrs))
    partes.append('</g>')

    # APOIO VITAL. Com descritor, o topo de maiuscula fica em y=0 e a base em 100.
    # Sem descritor, o nome e centrado na altura do simbolo, que nao muda de tamanho
    # entre as duas variantes justamente para que a comparacao seja honesta.
    y_nome = 0.0 if com_hc else (BLOCO_H - CAP) / 2.0
    partes.append('<g fill="%s" transform="translate(%.3f %.3f)">' % (c["nome"], x_texto, y_nome))
    for d, dx in seq:
        partes.append('<path d="%s" transform="translate(%.3f 0)"/>' % (d, dx))
    partes.append('</g>')

    if com_hc:
        alvo = RAZAO_HC * CAP_HC
        glifos, track, s = home_care(alvo)
        x = x_texto + (nome_larg - alvo) / 2.0           # centralizado no nome
        base = CAP + VAO_LINHAS + CAP_HC                 # base do descritor
        partes.append('<g fill="%s">' % c["hc"])
        for d, av in glifos:
            if d:
                partes.append('<path d="%s" transform="translate(%.3f %.3f) scale(%.5f %.5f)"/>'
                              % (d, x, base, s, -s))
            x += av + track
        partes.append('</g>')
        alt = BLOCO_H
    else:
        alt = BLOCO_H   # mantem a altura para as duas variantes serem comparaveis

    return ('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %.2f %.2f" width="%.0f" height="%.0f" '
            'role="img" aria-label="Apoio Vital%s">%s</svg>'
            % (larg_total, alt, larg_total, alt, " Home Care" if com_hc else "", "".join(partes)))

if __name__ == "__main__":
    os.makedirs(SC + "/assin/saida", exist_ok=True)
    for variante in ("claro", "escuro"):
        for n, com in (("1", True), ("2", False)):
            svg = monta(variante, com)
            nome = "%s/assin/saida/assinatura-v%s-%s.svg" % (SC, n, variante)
            open(nome, "w").write(svg)
            vb = re.search(r'viewBox="0 0 ([\d.]+) ([\d.]+)"', svg)
            print("v%s %-7s  %s x %s  razao %.2f" % (n, variante, vb.group(1), vb.group(2),
                                                     float(vb.group(1))/float(vb.group(2))))
