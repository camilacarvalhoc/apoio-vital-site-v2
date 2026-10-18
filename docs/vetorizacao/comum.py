import sys,colorsys; sys.path.insert(0,'.')
from png import *
from collections import deque

def classe(c):
    r,g,b=[v/255 for v in c]
    hh,ll,ss=colorsys.rgb_to_hls(r,g,b); H=hh*360
    if ll>0.88 or ss<0.20: return None
    if 150<=H<=230: return 'fria'
    if H<=45 or H>=330: return 'quente'
    return 'outro'

def mascara_bruta(px,cn,x0,y0,x1,y1):
    W=x1-x0; H=y1-y0
    m=[[0]*W for _ in range(H)]
    for j in range(H):
        for i in range(W):
            k=classe(pix(px,cn,x0+i,y0+j))
            m[j][i]= 1 if k=='fria' else (2 if k=='quente' else 0)
    return m,W,H

def componentes(m,W,H):
    """rotula regioes conectadas (8-vizinhos), ignorando a cor"""
    rot=[[0]*W for _ in range(H)]; comps=[]; n=0
    for j in range(H):
        for i in range(W):
            if m[j][i]==0 or rot[j][i]: continue
            n+=1; q=deque([(i,j)]); rot[j][i]=n; area=0
            mnx,mny,mxx,mxy=i,j,i,j
            while q:
                x,y=q.popleft(); area+=1
                mnx=min(mnx,x);mxx=max(mxx,x);mny=min(mny,y);mxy=max(mxy,y)
                for dx in(-1,0,1):
                    for dy in(-1,0,1):
                        a,b=x+dx,y+dy
                        if 0<=a<W and 0<=b<H and m[b][a] and not rot[b][a]:
                            rot[b][a]=n; q.append((a,b))
            comps.append({'id':n,'area':area,'bb':(mnx,mny,mxx,mxy)})
    comps.sort(key=lambda c:-c['area'])
    return rot,comps

def erode(m,W,H,n=1):
    for _ in range(n):
        novo=[[0]*W for _ in range(H)]
        for j in range(H):
            for i in range(W):
                if not m[j][i]: continue
                ok=True
                for dx in(-1,0,1):
                    for dy in(-1,0,1):
                        a,b=i+dx,j+dy
                        if not(0<=a<W and 0<=b<H and m[b][a]): ok=False
                if ok: novo[j][i]=1
        m=novo
    return m

def dilata(m,W,H,n=1):
    for _ in range(n):
        novo=[[0]*W for _ in range(H)]
        for j in range(H):
            for i in range(W):
                if m[j][i]:
                    for dx in(-1,0,1):
                        for dy in(-1,0,1):
                            a,b=i+dx,j+dy
                            if 0<=a<W and 0<=b<H: novo[b][a]=1
        m=novo
    return m

def soMaior(m,W,H):
    rot,comps=componentes(m,W,H)
    if not comps: return m
    k=comps[0]['id']
    return [[1 if rot[j][i]==k else 0 for i in range(W)] for j in range(H)]
