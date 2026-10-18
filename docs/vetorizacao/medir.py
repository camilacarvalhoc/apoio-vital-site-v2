import json,sys; sys.path.insert(0,'.')
from png import ler, pix
from comum import classe
d=json.load(open('mascaras.json')); W,H=d['W'],d['H']
orig=[[1 if (d['fria'][j][i] or d['quente'][j][i] or d['bat'][j][i]) else 0 for i in range(W)] for j in range(H)]
def medir(arq):
    w,h,cn,px=ler(arq)
    inter=so1=so2=0
    for j in range(min(H,h)):
        for i in range(min(W,w)):
            a=orig[j][i]
            b=1 if classe(pix(px,cn,i,j)) in ('fria','quente') else 0
            if a and b: inter+=1
            elif a: so1+=1
            elif b: so2+=1
    return inter/(inter+so1+so2), so1, so2
if __name__=='__main__':
    iou,a,b=medir(sys.argv[1]); print(f'{iou*100:.2f} {a} {b}')
