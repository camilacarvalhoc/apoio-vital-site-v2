import re, json, os
src = "assets/img/logo/apoio-vital-principal.svg"
txt = open(src).read()
# os dois grupos de letras: translate(254 0) = APOIO, translate(254 130) = VITAL
grupos = re.findall(r'<g transform="translate\(254 (\d+)\)"[^>]*>(.*?)</g>', txt, re.S)
saida = {}
for dy, corpo in grupos:
    letras = []
    for m in re.finditer(r'<path d="([^"]+)" transform="translate\(([\d.]+) 0\)"\s*/>', corpo):
        letras.append({"d": m.group(1), "x": float(m.group(2))})
    saida["APOIO" if dy == "0" else "VITAL"] = letras
os.makedirs("/tmp/x", exist_ok=True)
for nome, letras in saida.items():
    print(nome, len(letras), "letras, offsets:", [l["x"] for l in letras])
json.dump(saida, open(os.environ["SC"] + "/assin/letras.json", "w"))
