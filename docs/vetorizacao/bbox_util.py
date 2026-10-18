import re
def caixa_do_d(d):
    toks = re.findall(r'[MCLZmclzHhVvQqSsAa]|-?\d+\.?\d*(?:[eE]-?\d+)?', d)
    xs, ys = [], []; i = 0; cur = (0.0,0.0); start = cur; cmd = None
    while i < len(toks):
        t = toks[i]
        if t.isalpha():
            cmd = t; i += 1
            if cmd in 'Zz': cur = start
            continue
        if cmd in ('M','L','m','l'):
            x, y = float(toks[i]), float(toks[i+1]); i += 2
            if cmd in 'ml': x += cur[0]; y += cur[1]
            xs.append(x); ys.append(y)
            if cmd in 'Mm': start = (x,y); cmd = 'L' if cmd=='M' else 'l'
            cur = (x,y)
        elif cmd in ('H','h'):
            x = float(toks[i]); i += 1
            if cmd=='h': x += cur[0]
            xs.append(x); ys.append(cur[1]); cur = (x,cur[1])
        elif cmd in ('V','v'):
            y = float(toks[i]); i += 1
            if cmd=='v': y += cur[1]
            xs.append(cur[0]); ys.append(y); cur = (cur[0],y)
        elif cmd in ('C','c'):
            p = [float(v) for v in toks[i:i+6]]; i += 6
            x0,y0 = cur
            if cmd=='c': p = [p[0]+x0,p[1]+y0,p[2]+x0,p[3]+y0,p[4]+x0,p[5]+y0]
            x1,y1,x2,y2,x3,y3 = p
            for q in range(17):
                s = q/16.0; u = 1-s
                xs.append(u*u*u*x0+3*u*u*s*x1+3*u*s*s*x2+s*s*s*x3)
                ys.append(u*u*u*y0+3*u*u*s*y1+3*u*s*s*y2+s*s*s*y3)
            cur = (x3,y3)
        else:
            i += 1
    return min(xs), min(ys), max(xs), max(ys)
