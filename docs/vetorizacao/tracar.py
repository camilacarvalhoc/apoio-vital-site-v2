"""Marching squares + Douglas-Peucker + ajuste de cubicas."""
import math

def contornos(m, W, H):
    """Iso-contornos em 0,5 sobre grade binaria. Devolve lacos fechados."""
    def v(i, j):
        return 1 if (0 <= i < W and 0 <= j < H and m[j][i]) else 0
    segs = {}
    def add(p, q):
        segs.setdefault(p, []).append(q)
    # amostra nos cantos: celula (i,j) olha os pixels (i-1,j-1),(i,j-1),(i-1,j),(i,j)
    for j in range(H + 1):
        for i in range(W + 1):
            a = v(i - 1, j - 1); b = v(i, j - 1); c = v(i, j); d = v(i - 1, j)
            cod = a | (b << 1) | (c << 2) | (d << 3)
            N = (i - 0.5, j - 1.0); E = (i + 0.0, j - 0.5)
            Sd = (i - 0.5, j + 0.0); Wd = (i - 1.0, j - 0.5)
            t = {
                1:[(Wd,N)], 2:[(N,E)], 3:[(Wd,E)], 4:[(E,Sd)],
                5:[(Wd,Sd),(N,E)], 6:[(N,Sd)], 7:[(Wd,Sd)], 8:[(Sd,Wd)],
                9:[(Sd,N)], 10:[(Sd,E),(N,Wd)], 11:[(Sd,E)], 12:[(E,Wd)],
                13:[(E,N)], 14:[(N,Wd)],
            }.get(cod, [])
            for p, q in t: add(p, q)
    lacos = []
    while segs:
        ini = next(iter(segs))
        laco = [ini]; atual = ini
        while True:
            prox = segs.get(atual)
            if not prox: break
            n = prox.pop()
            if not prox: segs.pop(atual, None)
            laco.append(n); atual = n
            if n == ini: break
        if len(laco) > 8: lacos.append(laco)
    return lacos

def area(p):
    s = 0.0
    for i in range(len(p)):
        x1, y1 = p[i]; x2, y2 = p[(i + 1) % len(p)]
        s += x1 * y2 - x2 * y1
    return s / 2

def dp(pts, eps):
    """Douglas-Peucker em laco fechado: parte no ponto mais distante."""
    if len(pts) < 4: return pts
    def rec(p):
        if len(p) < 3: return p
        x0, y0 = p[0]; x1, y1 = p[-1]
        dx, dy = x1 - x0, y1 - y0
        n = math.hypot(dx, dy)
        pior = 0.0; k = 0
        for i in range(1, len(p) - 1):
            x, y = p[i]
            d = abs(dy * x - dx * y + x1 * y0 - y1 * x0) / n if n > 1e-9 else math.hypot(x - x0, y - y0)
            if d > pior: pior, k = d, i
        if pior <= eps: return [p[0], p[-1]]
        return rec(p[:k + 1])[:-1] + rec(p[k:])
    a = pts[:-1] if pts[0] == pts[-1] else pts[:]
    # ponto de partida: o mais longe do centroide, para nao cortar uma curva ao meio
    cx = sum(x for x, _ in a) / len(a); cy = sum(y for _, y in a) / len(a)
    k = max(range(len(a)), key=lambda i: (a[i][0] - cx) ** 2 + (a[i][1] - cy) ** 2)
    a = a[k:] + a[:k]
    r = rec(a + [a[0]])
    return r[:-1]

def paraCubicas(p, tensao=0.5):
    """Catmull-Rom fechada -> cubicas de Bezier."""
    n = len(p)
    if n < 3: return ''
    d = f'M{p[0][0]:.2f} {p[0][1]:.2f}'
    for i in range(n):
        p0 = p[(i - 1) % n]; p1 = p[i]; p2 = p[(i + 1) % n]; p3 = p[(i + 2) % n]
        c1 = (p1[0] + (p2[0] - p0[0]) * tensao / 3, p1[1] + (p2[1] - p0[1]) * tensao / 3)
        c2 = (p2[0] - (p3[0] - p1[0]) * tensao / 3, p2[1] - (p3[1] - p1[1]) * tensao / 3)
        d += f'C{c1[0]:.2f} {c1[1]:.2f} {c2[0]:.2f} {c2[1]:.2f} {p2[0]:.2f} {p2[1]:.2f}'
    return d + 'Z'
