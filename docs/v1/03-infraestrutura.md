# Infraestrutura

Atualizado em 17/10/2026.

## Resumo

| Item | Estado |
|---|---|
| Domínio `apoiovital.com` | Registrado no CNPJ da empresa, ativo até 10/10/2027, renovação automática **ligada** |
| Hospedagem | Hostinger, plano Premium, 12 meses, até 11/10/2027 |
| E-mail `contato@apoiovital.com` | **Funcionando** |
| SSL | Ativo, com redirecionamento HTTP→HTTPS ligado |
| Site no ar | **Não** — o domínio serve a página de boas-vindas da Hostinger |
| Repositório | `camilacarvalhoc/apoio-vital-site`, privado, branch `main` |

## DNS — a parte que não se toca

Os nameservers são `cosmos.dns-parking.com` e `nova.dns-parking.com` (são da Hostinger, apesar
do nome). O DNS é gerenciado pela própria Hostinger.

**A zona de e-mail está configurada e funcionando:** MX apontando para `mx1` e
`mx2.hostinger.com`, SPF, três registros DKIM, DMARC, autodiscover e autoconfig.

> ### Regra absoluta
>
> **Não alterar, remover ou recriar MX, SPF, DKIM, DMARC ou os nameservers.** Mexer em
> qualquer um derruba o e-mail da empresa.
>
> Se o painel oferecer "redefinir zona DNS" ou "restaurar registros padrão", **recusar**.
>
> Vincular site, emitir SSL e conectar Git mexem em registro A e em arquivos — nunca na zona
> de e-mail. Se alguma vez for preciso trocar nameservers ou apontar o domínio para outro
> provedor, a zona de e-mail vai junto e precisa ser recriada no destino: **avisar antes**.

Depois de qualquer mexida em infraestrutura, a verificação que vale é prática: enviar uma
mensagem de outro endereço para `contato@apoiovital.com` e confirmar que chega.

## Limites do plano

- **Até 3 sites**, 20 GB de SSD, SSL grátis automático
- **Sem CDN e sem suporte prioritário.** Não é problema: o site tem 141 KB.
- **E-mail: máximo 2 caixas, 1 GB cada.** Atenção ao prazo — pelo levantamento, a Hostinger
  descontinuou o e-mail profissional gratuito em abril de 2025; o Premium inclui um período de
  teste e depois vira assinatura à parte. **Confirmar o preço de renovação por caixa**, que
  vence em data separada da hospedagem.
  Situação em 19/10/2026: plano "Teste grátis do Starter Business Email", com vencimento em
  10/10/2027; 2 caixas (`contato@` e `vagas@`), 1 GB cada, 100 envios por 24 h, até 5 apelidos
  por caixa. `privacidade@`, `ouvidoria@` e `financeiro@` são apelidos de `contato@`. A sócia testou o
  recebimento nos quatro endereços (`ouvidoria@`, `vagas@`, `financeiro@`, `privacidade@`) em
  19/10/2026. O que
  acontece com as 2 caixas depois do teste não foi confirmado com a Hostinger.

**O limite de caixas não afeta o site:** o `enviar.php` entrega por `mail()` da hospedagem, sem
SMTP e sem login em caixa, e não há banco de dados. O currículo anexado pelo Trabalhe Conosco
ocupa espaço na caixa de destino (1 GB) e não fica guardado no servidor. Os formulários seguem
abrindo o WhatsApp com os dados preenchidos.

## Estado do site no ar

Verificado de fora em 17/10/2026:

```
https://apoiovital.com        → 200, título "Página padrão" (a tal default.php)
http://apoiovital.com         → 301 para https://   (Forçar HTTPS já ligado)
https://www.apoiovital.com    → 200, sem redirecionamento canônico
```

**Ressalva de método:** a inspeção do certificado, feita deste ambiente, mostra o certificado
do proxy de egresso, não o do servidor. O SSL funcionar é evidência forte mas indireta;
confirmar no painel.

**`public_html` contém exatamente um arquivo:** `default.php`, 16.395 bytes. Sem dotfiles, sem
`.htaccess`. Na raiz da conta, um nível acima, há o marcador `DO_NOT_UPLOAD_HERE`, que **não
deve ser tocado**.

## Como publicar

**Método escolhido: integração de Git nativa do hPanel.** Não cria usuário, senha, IP nem
arquivo de configuração — conecta por autorização do GitHub. Credencial que não existe não vaza.

### Passos

1. **Apagar `default.php`** de `public_html`. A integração exige a pasta vazia.
2. **hPanel → painel do site → Avançado → Git → "Connect with GitHub"**, autorizar. O
   repositório é **privado**: a autorização precisa incluí-lo.
   ```
   Repositório: camilacarvalhoc/apoio-vital-site
   Branch:      main
   Destino:     public_html
   ```
3. Acionar o primeiro **Deploy**.

**Parar e pedir ajuda** se a tela pedir endereço de webhook, chave SSH, ou usuário e senha:
há dois fluxos de Git no painel e só o do GitHub App se configura sozinho.

### Depois do primeiro deploy, verificação obrigatória

Abrir `https://apoiovital.com/.git/config` e `https://apoiovital.com/.git/HEAD`.

**Os dois precisam dar erro.** A integração clona o repositório dentro da raiz web, então a
pasta `.git` vai junto. Se devolverem conteúdo, o histórico do repositório está público e o
`.htaccess` com `RedirectMatch 404 /\.git` vira urgente.

## Plano B, se não houver menu Git

GitHub Actions publicando por FTP, com **usuário de FTP restrito a `public_html`** (não a conta
principal do painel) e a senha em GitHub Secrets — nunca em arquivo no repositório.

**O método do vídeo — gravar usuário, senha e IP num `.env` dentro da pasta do projeto — não
deve ser usado em hipótese alguma.** A pasta é um repositório Git e o histórico é permanente:
apagar o arquivo num commit seguinte não remove a senha.

## Renovações

| O que | Quando | Renovação automática |
|---|---|---|
| Domínio | 10/10/2027 | **Ligada** — é o ativo que não se pode perder por esquecimento |
| Hospedagem | 11/10/2027 | Desligada, para não haver cobrança surpresa |
| E-mail | data própria | Desligada — **confirmar a data, que é separada** |

Dois lembretes recomendados: um no dia 25 após a compra (antes de fechar a janela de reembolso
de 30 dias) e outro 45 dias antes do vencimento, cobrindo hospedagem e e-mail.

## Migrar de provedor: o custo real está no e-mail

O site é HTML estático num repositório — move-se em minutos. **O e-mail é que prende:**
exportar caixas, cortar o MX, janela de entrega dupla. Se um dia a migração for considerada,
é esse o custo a pesar, não o do site.
