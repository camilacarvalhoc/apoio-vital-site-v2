/* =========================================================================
   APOIO VITAL - main.js
   JavaScript puro, sem dependencias. Carregado com "defer".
   Tudo aqui e progressive enhancement: o site funciona sem JS.
   ========================================================================= */
(function () {
  'use strict';

  /* ======================================================================
     CONFIG - altere apenas este bloco ao trocar os dados da empresa
     ====================================================================== */
  var CONFIG = {
    // Numero do WhatsApp em formato internacional, somente digitos: 55 + DDD + numero
    //
    // ATENCAO: este numero tambem esta gravado no href dos 160 botoes do site,
    // dentro dos arquivos .html, para que funcionem com o JavaScript desligado.
    // Trocar so aqui deixa o HTML desatualizado para quem nao tem JS.
    // Use a troca global do numero nos .html junto com a troca aqui.
    whatsapp: '5521974792051',

    // Mensagem padrao que ja vem escrita quando a pessoa abre o WhatsApp
    msgPadrao: 'Ola! Vim pelo site da Apoio Vital e gostaria de saber mais sobre os cuidados em casa.',

    // Para onde o formulario envia ALEM do WhatsApp.
    // Vazio significa usar o action do proprio formulario, que e '/enviar.php',
    // o arquivo PHP que fica no site e manda para contato@apoiovital.com.
    // So preencha aqui se um dia for usar servico de terceiro.
    endpointFormulario: '',

    // Pagina de agradecimento apos envio bem-sucedido
    paginaObrigado: 'obrigado.html',

    // Medicao propria, no proprio servidor. Deixe vazio enquanto o site nao
    // estiver na Hostinger; assim nada e enviado e nada quebra.
    // Depois de publicar, coloque: '/medir.php'
    endpointMedicao: '/medir.php'
  };

  var ehRaiz = !/\/servicos\//.test(window.location.pathname);
  var prefixo = ehRaiz ? '' : '../';

  /* ======================================================================
     Utilidades
     ====================================================================== */
  function $(sel, ctx) { return (ctx || document).querySelector(sel); }
  function $$(sel, ctx) { return Array.prototype.slice.call((ctx || document).querySelectorAll(sel)); }
  function on(el, ev, fn, opts) { if (el) el.addEventListener(ev, fn, opts); }

  var movimentoReduzido = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function linkWhats(texto) {
    var msg = texto || CONFIG.msgPadrao;
    return 'https://wa.me/' + CONFIG.whatsapp + '?text=' + encodeURIComponent(msg);
  }

  /* ======================================================================
     1. Links de WhatsApp
     O href real ja vem gravado no HTML, entao o botao funciona sem JavaScript.
     Esta funcao apenas reescreve por cima, para que trocar o numero no CONFIG
     continue valendo para quem tem JS, e garante target e rel.
     ====================================================================== */
  function montarLinksWhats() {
    $$('[data-whats]').forEach(function (a) {
      var personalizada = a.getAttribute('data-whats');
      a.href = linkWhats(personalizada && personalizada.trim() ? personalizada : null);
      a.setAttribute('target', '_blank');
      a.setAttribute('rel', 'noopener');
    });
  }

  /* ======================================================================
     2. Cabecalho fixo - sombra ao rolar
     ====================================================================== */
  function sombraTopo() {
    var topo = $('.topo');
    if (!topo) return;
    var ticking = false;
    function atualizar() {
      topo.classList.toggle('rolou', window.scrollY > 8);
      ticking = false;
    }
    on(window, 'scroll', function () {
      if (!ticking) { window.requestAnimationFrame(atualizar); ticking = true; }
    }, { passive: true });
    atualizar();
  }

  /* ======================================================================
     3. Menu mobile - com armadilha de foco e Esc
     ====================================================================== */
  function menuMobile() {
    var painelWrap = $('.menu-mobile');
    var abrir = $('.abrir-menu');
    if (!painelWrap || !abrir) return;

    var painel = $('.menu-mobile__painel', painelWrap);
    var fundo = $('.menu-mobile__fundo', painelWrap);
    var fechar = $('.fechar-menu', painelWrap);
    var ultimoFoco = null;

    var FOCAVEIS = 'a[href], button:not([disabled]), input, select, textarea, [tabindex]:not([tabindex="-1"])';

    function abrirMenu() {
      ultimoFoco = document.activeElement;
      painelWrap.setAttribute('data-aberto', 'true');
      abrir.setAttribute('aria-expanded', 'true');
      document.body.classList.add('menu-aberto');
      var primeiro = $$(FOCAVEIS, painel)[0];
      if (primeiro) primeiro.focus();
    }

    function fecharMenu() {
      painelWrap.setAttribute('data-aberto', 'false');
      abrir.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('menu-aberto');
      if (ultimoFoco) ultimoFoco.focus();
    }

    on(abrir, 'click', abrirMenu);
    on(fechar, 'click', fecharMenu);
    on(fundo, 'click', fecharMenu);

    $$('a', painel).forEach(function (a) { on(a, 'click', fecharMenu); });

    on(document, 'keydown', function (e) {
      if (painelWrap.getAttribute('data-aberto') !== 'true') return;

      if (e.key === 'Escape') { e.preventDefault(); fecharMenu(); return; }

      if (e.key === 'Tab') {
        var itens = $$(FOCAVEIS, painel).filter(function (el) { return el.offsetParent !== null; });
        if (!itens.length) return;
        var primeiro = itens[0];
        var ultimo = itens[itens.length - 1];
        if (e.shiftKey && document.activeElement === primeiro) { e.preventDefault(); ultimo.focus(); }
        else if (!e.shiftKey && document.activeElement === ultimo) { e.preventDefault(); primeiro.focus(); }
      }
    });
  }

  /* ======================================================================
     4. Submenu do desktop
     ====================================================================== */
  function submenus() {
    var grupos = $$('.tem-submenu');
    if (!grupos.length) return;

    function fecharTodos(exceto) {
      grupos.forEach(function (g) {
        var b = $('button', g);
        if (b && g !== exceto) b.setAttribute('aria-expanded', 'false');
      });
    }

    grupos.forEach(function (g) {
      var botao = $('button', g);
      if (!botao) return;
      on(botao, 'click', function (e) {
        e.stopPropagation();
        var aberto = botao.getAttribute('aria-expanded') === 'true';
        fecharTodos(g);
        botao.setAttribute('aria-expanded', aberto ? 'false' : 'true');
      });
      on(g, 'mouseleave', function () { botao.setAttribute('aria-expanded', 'false'); });
    });

    on(document, 'click', function () { fecharTodos(null); });
    on(document, 'keydown', function (e) {
      if (e.key === 'Escape') {
        var algumAberto = grupos.some(function (g) {
          var b = $('button', g);
          return b && b.getAttribute('aria-expanded') === 'true';
        });
        if (algumAberto) {
          fecharTodos(null);
          var primeiroBotao = $('button', grupos[0]);
          if (primeiroBotao) primeiroBotao.focus();
        }
      }
    });
  }

  /* ======================================================================
     5. Pagina atual no menu (aria-current)
     ====================================================================== */
  function marcarPaginaAtual() {
    var caminho = window.location.pathname.replace(/\/index\.html$/, '/').replace(/\/$/, '/index.html');
    var arquivo = caminho.split('/').filter(Boolean).pop() || 'index.html';
    var pasta = /\/servicos\//.test(window.location.pathname) ? 'servicos/' : '';

    $$('.nav-principal a, .menu-mobile nav a').forEach(function (a) {
      var href = a.getAttribute('href') || '';
      var alvo = href.split('/').filter(Boolean).pop();
      if (!alvo || href.charAt(0) === '#') return;
      if (alvo === arquivo) {
        a.setAttribute('aria-current', 'page');
        var pai = a.closest('.tem-submenu');
        if (pai) { var b = $('button', pai); if (b) b.setAttribute('data-ativo', 'true'); }
      }
    });

    // Marca o item "Servicos" quando estamos em qualquer pagina filha
    if (pasta === 'servicos/') {
      $$('[data-nav="servicos"]').forEach(function (el) { el.setAttribute('data-ativo', 'true'); });
    }
  }

  /* ======================================================================
     6. FAQ
     O acordeao e <details>/<summary> nativo e nao precisa de JS.
     Aqui so tratamos a abertura por ancora na URL.
     ====================================================================== */
  function faq() {
    if (!window.location.hash) return;
    var alvo = document.getElementById(window.location.hash.slice(1));
    if (alvo && alvo.tagName === 'DETAILS') {
      alvo.open = true;
      alvo.scrollIntoView({ behavior: movimentoReduzido ? 'auto' : 'smooth', block: 'center' });
    }
  }

  /* ======================================================================
     7. Revelar ao rolar
     ====================================================================== */
  function revelar() {
    var alvos = $$('.revelar');
    if (!alvos.length) return;

    if (movimentoReduzido || !('IntersectionObserver' in window)) {
      alvos.forEach(function (el) { el.classList.add('visivel'); });
      return;
    }

    var obs = new IntersectionObserver(function (entradas) {
      entradas.forEach(function (entrada) {
        if (entrada.isIntersecting) {
          entrada.target.classList.add('visivel');
          obs.unobserve(entrada.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    alvos.forEach(function (el, i) {
      el.style.transitionDelay = Math.min(i % 4, 3) * 70 + 'ms';
      obs.observe(el);
    });
  }

  /* ======================================================================
     8. Mascara de telefone brasileiro
     ====================================================================== */
  function mascaraTelefone() {
    $$('input[data-mascara="telefone"]').forEach(function (campo) {
      campo.setAttribute('inputmode', 'tel');
      campo.setAttribute('maxlength', '15');
      on(campo, 'input', function () {
        var d = campo.value.replace(/\D/g, '').slice(0, 11);
        var saida = d;
        if (d.length > 10)      saida = '(' + d.slice(0, 2) + ') ' + d.slice(2, 7) + '-' + d.slice(7);
        else if (d.length > 6)  saida = '(' + d.slice(0, 2) + ') ' + d.slice(2, 6) + '-' + d.slice(6);
        else if (d.length > 2)  saida = '(' + d.slice(0, 2) + ') ' + d.slice(2);
        else if (d.length > 0)  saida = '(' + d;
        campo.value = saida;
      });
    });
  }

  /* ======================================================================
     9. Validacao e envio do formulario
     ====================================================================== */
  var MENSAGENS = {
    vazio: 'Este campo e obrigatorio.',
    nomeCurto: 'Informe o nome completo.',
    email: 'Informe um e-mail valido, como nome@email.com.br',
    telefone: 'Informe um telefone com DDD, como (21) 99999-0000',
    escolha: 'Escolha uma das opcoes.',
    consentimento: 'E preciso concordar para que possamos entrar em contato.',
    arquivo: 'Envie um arquivo PDF, DOC ou DOCX de ate 5 MB.'
  };

  function validarCampo(campo) {
    var valor = (campo.value || '').trim();
    var tipo = campo.getAttribute('data-valida') || campo.type;
    var obrigatorio = campo.hasAttribute('required');
    var erro = '';

    if (obrigatorio && !valor && campo.type !== 'checkbox') erro = MENSAGENS.vazio;
    else if (obrigatorio && campo.type === 'checkbox' && !campo.checked) erro = MENSAGENS.consentimento;
    else if (valor && tipo === 'nome' && valor.split(/\s+/).length < 2) erro = MENSAGENS.nomeCurto;
    else if (valor && tipo === 'email' && !/^[^\s@]+@[^\s@]+\.[a-z]{2,}$/i.test(valor)) erro = MENSAGENS.email;
    else if (valor && tipo === 'telefone' && valor.replace(/\D/g, '').length < 10) erro = MENSAGENS.telefone;

    mostrarErro(campo, erro);
    return !erro;
  }

  function mostrarErro(campo, mensagem) {
    var envolto = campo.closest('.campo') || campo.closest('.consentimento') || campo.parentNode;
    var caixa = envolto ? $('.campo__erro', envolto) : null;

    if (mensagem) {
      campo.setAttribute('aria-invalid', 'true');
      if (caixa) {
        caixa.textContent = mensagem;
        caixa.setAttribute('data-visivel', 'true');
        if (!caixa.id) caixa.id = (campo.id || campo.name || 'campo') + '-erro';
        campo.setAttribute('aria-describedby', caixa.id);
      }
    } else {
      campo.removeAttribute('aria-invalid');
      if (caixa) { caixa.setAttribute('data-visivel', 'false'); caixa.textContent = ''; }
    }
  }

  function textoDoCampo(campo) {
    if (campo.tagName === 'SELECT') {
      var op = campo.options[campo.selectedIndex];
      return op ? op.text : campo.value;
    }
    return campo.value;
  }

  function montarResumoWhats(form) {
    var linhas = ['*Novo contato pelo site - Apoio Vital*', ''];
    $$('input, select, textarea', form).forEach(function (campo) {
      if (campo.type === 'submit' || campo.type === 'hidden' || campo.type === 'file') return;
      var envolto = campo.closest('.campo') || campo.closest('.escolha') || campo.closest('.consentimento');
      var rotuloEl = envolto ? $('label', envolto) : null;
      var rotulo = rotuloEl ? rotuloEl.textContent.replace(/\s*\*\s*$/, '').replace(/\s+/g, ' ').trim() : campo.name;

      if (campo.type === 'checkbox') {
        if (campo.checked && campo.name !== 'consentimento') linhas.push('• ' + (campo.value || rotulo));
        return;
      }
      if (campo.type === 'radio') {
        if (campo.checked) linhas.push('*' + rotulo + ':* ' + (campo.value || 'sim'));
        return;
      }
      if ((campo.value || '').trim()) linhas.push('*' + rotulo + ':* ' + textoDoCampo(campo).trim());
    });
    return linhas.join('\n');
  }

  function formularios() {
    $$('form[data-form]').forEach(function (form) {
      var retorno = $('.form__retorno', form);
      var botao = $('[type="submit"]', form);
      var textoBotao = botao ? botao.textContent : '';

      // Valida ao sair do campo, e revalida ao digitar depois de um erro
      $$('input, select, textarea', form).forEach(function (campo) {
        if (campo.type === 'submit') return;
        on(campo, 'blur', function () { validarCampo(campo); });
        on(campo, 'input', function () {
          if (campo.getAttribute('aria-invalid') === 'true') validarCampo(campo);
        });
        on(campo, 'change', function () {
          if (campo.type === 'checkbox' || campo.tagName === 'SELECT') validarCampo(campo);
        });
      });

      on(form, 'submit', function (e) {
        e.preventDefault();

        var campos = $$('input, select, textarea', form).filter(function (c) { return c.type !== 'submit' && c.type !== 'hidden'; });
        var valido = true;
        var primeiroErro = null;

        campos.forEach(function (campo) {
          if (!validarCampo(campo)) {
            valido = false;
            if (!primeiroErro) primeiroErro = campo;
          }
        });

        if (!valido) {
          if (retorno) {
            retorno.setAttribute('data-estado', 'erro');
            retorno.textContent = 'Faltou preencher alguma coisa. Confira os campos marcados em vermelho logo abaixo.';
          }
          if (primeiroErro) {
            primeiroErro.focus();
            primeiroErro.scrollIntoView({ behavior: movimentoReduzido ? 'auto' : 'smooth', block: 'center' });
          }
          return;
        }

        if (retorno) retorno.removeAttribute('data-estado');

        // Dois caminhos ao mesmo tempo, por decisao da socia:
        //   1. abre o WhatsApp com os dados preenchidos, que e onde o setor fecha
        //   2. manda o mesmo conteudo por e-mail, para nada se perder se a
        //      pessoa desistir no meio ou nao tiver WhatsApp naquele aparelho
        // Sem JavaScript, o proprio form tem action e method e vai direto
        // para o enviar.php.

        var destino = CONFIG.endpointFormulario || form.getAttribute('action');

        // O WhatsApp abre primeiro, porque navegador bloqueia janela aberta
        // depois de uma resposta assincrona.
        var janela = window.open(linkWhats(montarResumoWhats(form)), '_blank', 'noopener');

        if (retorno) {
          retorno.setAttribute('data-estado', 'sucesso');
          retorno.textContent = janela
            ? 'Abrimos o WhatsApp com os seus dados preenchidos. \u00c9 s\u00f3 tocar em enviar. A gente tamb\u00e9m recebeu por aqui e responde ainda hoje.'
            : 'Recebemos os seus dados e respondemos ainda hoje.';
        }

        if (!destino) return;

        if (botao) { botao.disabled = true; botao.textContent = 'Enviando...'; }

        fetch(destino, {
          method: 'POST',
          body: new FormData(form),
          headers: { Accept: 'application/json' }
        })
          .then(function (r) {
            if (!r.ok) throw new Error('Falha no envio');
            medir('envio_formulario', { formulario: form.querySelector('[name="formulario"]') ? form.querySelector('[name="formulario"]').value : 'contato' });
            if (!janela) { window.location.href = prefixo + CONFIG.paginaObrigado; return; }
            if (botao) { botao.disabled = false; botao.textContent = textoBotao; }
          })
          .catch(function () {
            if (botao) { botao.disabled = false; botao.textContent = textoBotao; }
            // O WhatsApp ja abriu, entao o lead nao se perdeu. Avisa sem assustar.
            if (retorno && !janela) {
              retorno.setAttribute('data-estado', 'erro');
              retorno.innerHTML = 'N\u00e3o conseguimos enviar agora. Fale direto no WhatsApp: ' +
                '<a href="' + linkWhats(montarResumoWhats(form)) + '" target="_blank" rel="noopener"><strong>abrir conversa</strong></a>.';
            }
          });
      });
    });
  }

  /* ======================================================================
     10. Ano corrente no rodape
     ====================================================================== */
  function anoRodape() {
    var ano = String(new Date().getFullYear());
    $$('[data-ano]').forEach(function (el) { el.textContent = ano; });
  }

  /* ======================================================================
     10b. Controle de tamanho de texto
     Nativo, nao plugin. Guarda a escolha so no navegador de quem leu.
     ====================================================================== */
  function tamanhoTexto() {
    var botoes = $$('.controle-texto button');
    if (!botoes.length) return;

    function aplicar(valor, guardar) {
      if (valor && valor !== 'n') document.documentElement.setAttribute('data-texto', valor);
      else document.documentElement.removeAttribute('data-texto');
      botoes.forEach(function (b) {
        b.setAttribute('aria-pressed', b.getAttribute('data-texto') === (valor || 'n') ? 'true' : 'false');
      });
      if (guardar) { try { localStorage.setItem('av-texto', valor || 'n'); } catch (e) {} }
    }

    var guardado = null;
    try { guardado = localStorage.getItem('av-texto'); } catch (e) {}
    if (guardado) aplicar(guardado, false);

    botoes.forEach(function (b) {
      on(b, 'click', function () { aplicar(b.getAttribute('data-texto'), true); });
    });
  }

  /* ======================================================================
     11. Medicao
     Nao depende de nenhuma tag estar instalada: se o GA4 ou o GTM nao
     existirem, os eventos simplesmente nao vao a lugar nenhum e o site
     continua funcionando igual. Quando a tag for instalada, comeca a
     medir sozinho, sem mexer em HTML de pagina nenhuma.
     ====================================================================== */
  function medir(evento, dados) {
    var carga = dados || {};
    carga.pagina = window.location.pathname.replace(/^\//, '') || 'index.html';

    // 1. Medicao propria, no proprio servidor. Sem cookie, sem identificador,
    //    sem terceiro. E por isso que o site nao precisa de aviso de cookies:
    //    a politica de privacidade so promete o aviso para ferramenta que
    //    depende de cookie nao essencial, e esta aqui nao usa nenhum.
    try {
      if (CONFIG.endpointMedicao) {
        var corpo = JSON.stringify({
          evento: evento,
          pagina: carga.pagina,
          codigo: carga.codigo || '',
          posicao: carga.posicao || '',
          extra: carga.pergunta || carga.arquivo || carga.segundos || '',
          largura: window.innerWidth,
          vindo_de: (document.referrer || '').split('/')[2] || ''
        });
        if (navigator.sendBeacon) {
          navigator.sendBeacon(CONFIG.endpointMedicao, new Blob([corpo], { type: 'text/plain' }));
        } else {
          var x = new XMLHttpRequest();
          x.open('POST', CONFIG.endpointMedicao, true);
          x.setRequestHeader('Content-Type', 'text/plain');
          x.send(corpo);
        }
      }
    } catch (e) { /* medicao nunca derruba o site */ }

    // 2. Se um dia for instalada ferramenta externa, ela recebe os mesmos eventos.
    try {
      window.dataLayer = window.dataLayer || [];
      window.dataLayer.push(Object.assign({ event: evento }, carga));
      if (typeof window.gtag === 'function') window.gtag('event', evento, carga);
      if (window.clarity) window.clarity('event', evento);
    } catch (e) { /* medicao nunca derruba o site */ }
  }

  function codigoDe(el) {
    // O codigo vive em data-origem, para a mensagem que a familia le ficar limpa.
    // A leitura de dentro da mensagem fica como reserva, caso algum link antigo sobre.
    var o = el.getAttribute('data-origem');
    if (o) return o;
    var txt = el.getAttribute('data-whats') || '';
    var m = txt.match(/\[([A-Za-z0-9-]{2,16})\]/);
    return m ? m[1] : 'sem-codigo';
  }

  function ondeEsta(el) {
    if (el.closest('.barra-acao')) return 'barra-mobile';
    if (el.closest('.whats-flutuante') || el.classList.contains('whats-flutuante')) return 'flutuante';
    if (el.closest('.barra-contato')) return 'topo';
    if (el.closest('.rodape')) return 'rodape';
    if (el.closest('.menu-mobile')) return 'menu';
    if (el.closest('.faixa-cta')) return 'cta-final';
    if (el.closest('.topo-pagina') || el.closest('.hero')) return 'inicio';
    return 'corpo';
  }

  function medicao() {
    on(document, 'click', function (e) {
      var alvo = e.target.closest ? e.target.closest('a') : null;
      if (!alvo) return;

      if (alvo.hasAttribute('data-whats')) {
        medir('clique_whatsapp', { codigo: codigoDe(alvo), posicao: ondeEsta(alvo) });
        return;
      }
      var href = alvo.getAttribute('href') || '';
      if (href.indexOf('tel:') === 0) {
        medir('clique_telefone', { posicao: ondeEsta(alvo) });
      } else if (href.indexOf('mailto:') === 0) {
        medir('clique_email', { posicao: ondeEsta(alvo) });
      } else if (/\.pdf($|\?)/i.test(href)) {
        medir('baixou_arquivo', { arquivo: href.split('/').pop() });
      }
    }, true);

    $$('form[data-form]').forEach(function (form) {
      on(form, 'submit', function () {
        var dados = {};
        ['situacao', 'urgencia', 'bairro', 'horas_dia', 'dependencia', 'quem_decide', 'funcao'].forEach(function (nome) {
          var campo = form.querySelector('[name="' + nome + '"]');
          if (campo && campo.value) dados[nome] = campo.value;
        });
        medir('envio_formulario', dados);
      });
    });

    $$('.faq__item > summary').forEach(function (s) {
      on(s, 'click', function () {
        var item = s.closest('.faq__item');
        if (item && !item.open) medir('abriu_faq', { pergunta: item.id || 'sem-id' });
      });
    });

    var marcos = { 50: false, 75: false, 90: false };
    var tick = false;
    function profundidade() {
      var h = document.documentElement.scrollHeight - window.innerHeight;
      if (h <= 0) return;
      var pct = Math.round((window.scrollY / h) * 100);
      Object.keys(marcos).forEach(function (m) {
        if (!marcos[m] && pct >= Number(m)) { marcos[m] = true; medir('scroll_' + m, {}); }
      });
      tick = false;
    }
    on(window, 'scroll', function () {
      if (!tick) { window.requestAnimationFrame(profundidade); tick = true; }
    }, { passive: true });

    var saiu = false;
    ['pagehide', 'beforeunload'].forEach(function (ev) {
      on(window, ev, function () {
        if (saiu) return;
        saiu = true;
        medir('tempo_na_pagina', { segundos: Math.round(performance.now() / 1000) });
      });
    });
  }

  /* ======================================================================
     Inicializacao
     ====================================================================== */
  function iniciar() {
    montarLinksWhats();
    sombraTopo();
    menuMobile();
    submenus();
    marcarPaginaAtual();
    faq();
    revelar();
    mascaraTelefone();
    formularios();
    anoRodape();
    tamanhoTexto();
    medicao();
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', iniciar);
  else iniciar();
})();
