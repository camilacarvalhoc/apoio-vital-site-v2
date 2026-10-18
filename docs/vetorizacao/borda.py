"""Seguimento de borda pelas arestas dos pixels. Determinístico, sem ambiguidade de sela."""

def lacos(m, W, H):
    def fg(i, j):
        return 0 <= i < W and 0 <= j < H and m[j][i]
    # arestas dirigidas com o preenchimento a esquerda (y para baixo => sentido horario)
    ar = {}
    def add(p, q):
        ar.setdefault(p, []).append(q)
    for j in range(H):
        for i in range(W):
            if not fg(i, j): continue
            if not fg(i, j - 1): add((i, j), (i + 1, j))           # topo
            if not fg(i + 1, j): add((i + 1, j), (i + 1, j + 1))   # direita
            if not fg(i, j + 1): add((i + 1, j + 1), (i, j + 1))   # base
            if not fg(i - 1, j): add((i, j + 1), (i, j))           # esquerda
    saida = []
    while ar:
        p0 = next(iter(ar))
        laco = [p0]
        p = p0
        ant = None
        while True:
            opc = ar.get(p)
            if not opc: break
            if len(opc) == 1:
                q = opc.pop()
            else:
                # desempate: seguir a curva mais fechada no sentido horario
                def chave(q):
                    if ant is None: return 0
                    vx, vy = p[0] - ant[0], p[1] - ant[1]
                    wx, wy = q[0] - p[0], q[1] - p[1]
                    cruz = vx * wy - vy * wx          # >0 vira a direita (tela)
                    ponto = vx * wx + vy * wy
                    if cruz > 0: return 0             # direita primeiro
                    if ponto > 0: return 1            # reto
                    if cruz < 0: return 2             # esquerda
                    return 3                          # volta
                opc.sort(key=chave)
                q = opc.pop(0)
            if not ar[p]: ar.pop(p, None)
            laco.append(q); ant, p = p, q
            if q == p0: break
        if len(laco) > 8: saida.append(laco[:-1])
    return saida

def area(p):
    s = 0.0
    for i in range(len(p)):
        x1, y1 = p[i]; x2, y2 = p[(i + 1) % len(p)]
        s += x1 * y2 - x2 * y1
    return s / 2

def alisa(p, passes=6, peso=0.5):
    """Media movel periodica: tira a escada de pixel sem mudar a forma."""
    p = [tuple(map(float, q)) for q in p]
    n = len(p)
    for _ in range(passes):
        novo = []
        for i in range(n):
            a = p[(i - 1) % n]; b = p[i]; c = p[(i + 1) % n]
            novo.append((b[0] + peso * ((a[0] + c[0]) / 2 - b[0]),
                         b[1] + peso * ((a[1] + c[1]) / 2 - b[1])))
        p = novo
    return p

def mediana(m, W, H, r=1):
    """Filtro de mediana binario: tira serrilha sem arredondar reta."""
    lim = ((2 * r + 1) ** 2) // 2
    novo = [[0] * W for _ in range(H)]
    for j in range(H):
        for i in range(W):
            s = 0
            for dy in range(-r, r + 1):
                b = j + dy
                if b < 0 or b >= H: continue
                linha = m[b]
                for dx in range(-r, r + 1):
                    a = i + dx
                    if 0 <= a < W: s += linha[a]
            novo[j][i] = 1 if s > lim else 0
    return novo
