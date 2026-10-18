import io,struct,zlib
def ler(p):
    d=io.open(p,'rb').read(); pos=8; idat=b''
    while pos<len(d):
        ln=struct.unpack('>I',d[pos:pos+4])[0]; tp=d[pos+4:pos+8]; dat=d[pos+8:pos+8+ln]; pos+=12+ln
        if tp==b'IHDR': w,h,bits,ct=struct.unpack('>IIBB',dat[:10])
        elif tp==b'IDAT': idat+=dat
        elif tp==b'IEND': break
    raw=zlib.decompress(idat); cn={0:1,2:3,3:1,4:2,6:4}[ct]; bpp=cn*bits//8 or 1
    L=(w*cn*bits+7)//8; out=[]; ant=bytearray(L); i=0
    for y in range(h):
        f=raw[i]; i+=1; cur=bytearray(raw[i:i+L]); i+=L
        for x in range(L):
            a=cur[x-bpp] if x>=bpp else 0; b=ant[x]; c=ant[x-bpp] if x>=bpp else 0
            if f==1: cur[x]=(cur[x]+a)&255
            elif f==2: cur[x]=(cur[x]+b)&255
            elif f==3: cur[x]=(cur[x]+(a+b)//2)&255
            elif f==4:
                pa=abs(b-c);pb=abs(a-c);pc=abs(a+b-2*c)
                pr=a if(pa<=pb and pa<=pc) else (b if pb<=pc else c)
                cur[x]=(cur[x]+pr)&255
        out.append(bytes(cur)); ant=cur
    return w,h,cn,out
def grava(cam,w,h,cn,L):
    raw=b''.join(b'\x00'+l for l in L); ct={1:0,3:2,4:6}[cn]
    ch=lambda t,d: struct.pack('>I',len(d))+t+d+struct.pack('>I',zlib.crc32(t+d)&0xffffffff)
    io.open(cam,'wb').write(b'\x89PNG\r\n\x1a\n'+ch(b'IHDR',struct.pack('>IIBBBBB',w,h,8,ct,0,0,0))+ch(b'IDAT',zlib.compress(raw,6))+ch(b'IEND',b''))
def lum(c): return 0.2126*c[0]+0.7152*c[1]+0.0722*c[2]
def pix(px,cn,x,y):
    o=x*cn; return (px[y][o],px[y][o+1],px[y][o+2])
def caixa(px,cn,x0,y0,x1,y1,lim=205):
    mnx,mny,mxx,mxy=10**9,10**9,-1,-1
    for y in range(y0,y1):
        for x in range(x0,x1):
            if lum(pix(px,cn,x,y))<lim:
                mnx=min(mnx,x);mxx=max(mxx,x);mny=min(mny,y);mxy=max(mxy,y)
    return mnx,mny,mxx,mxy
