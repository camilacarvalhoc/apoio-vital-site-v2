import json,sys,io; sys.path.insert(0,'.')
from borda import lacos, area, alisa, mediana
from tracar import dp, paraCubicas
d=json.load(open('mascaras.json')); W,H=d['W'],d['H']
MED,PASSES,EPS,TEN=1,7,0.25,0.33

def caminho(nome):
    m=d[nome]
    if nome!='bat': m=mediana(m,W,H,MED)
    ls=[p for p in lacos(m,W,H) if abs(area(p))>=10]
    ls.sort(key=lambda p:-abs(area(p)))
    return ' '.join(paraCubicas(dp(alisa(p,PASSES),EPS),TEN) for p in ls)

CAM={n:caminho(n) for n in ('fria','quente','bat')}

CAB=('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %d %d" '
     'width="%d" height="%d" role="img" aria-label="Apoio Vital">' % (W,H,W,H))

def svg(partes, titulo):
    s=[CAB, f'<title>{titulo}</title>']
    for cor,dd in partes:
        s.append(f'<path d="{dd}" fill="{cor}" fill-rule="evenodd"/>')
    s.append('</svg>')
    return '\n'.join(s)

saidas={
 'apoio-vital-simbolo-m.svg': svg(
    [('#1B4B57',CAM['fria']),('#C47A5A',CAM['quente']),('#C47A5A',CAM['bat'])],
    'Apoio Vital, simbolo principal'),
 'apoio-vital-simbolo-m-reduzido.svg': svg(
    [('#1B4B57',CAM['fria']),('#C47A5A',CAM['quente'])],
    'Apoio Vital, simbolo reduzido, sem batimento'),
 'apoio-vital-simbolo-m-mono.svg': svg(
    [('#1B4B57',CAM['fria']+' '+CAM['quente']+' '+CAM['bat'])],
    'Apoio Vital, simbolo em uma tinta'),
 'apoio-vital-simbolo-m-negativo.svg': svg(
    [('#F3F0E8',CAM['fria']+' '+CAM['quente']+' '+CAM['bat'])],
    'Apoio Vital, simbolo negativo para fundo escuro'),
 'apoio-vital-simbolo-m-mono-reduzido.svg': svg(
    [('#1B4B57',CAM['fria']+' '+CAM['quente'])],
    'Apoio Vital, uma tinta, reduzido'),
}
for k,v in saidas.items():
    io.open(k,'w',encoding='utf-8').write(v)
    print(f'  {k:42} {len(v):6} bytes')
