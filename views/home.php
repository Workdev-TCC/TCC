<div class="hero">
  <div class="hero-text">
    <h1 class="wave-hover">
      <span>Z</span><span>U</span><span>P</span><span>I</span><span>N</span><span>T</span><span>U</span><span>R</span><span>A</span><span>S</span>
    </h1>
    <p>
      Na <strong>ZUPINTURAS</strong>, cada parede ganha vida. Transformamos espaços com cores que inspiram, acabamentos impecáveis e cuidado em cada detalhe, valorizando seu imóvel e deixando seu ambiente único.
    </p>
    <?php if(isset($_SESSION['email'])): ?>
        <a href="<?php echo RAIZ_PROJETO; ?>usuarios/views/gerenciar_solicitacoes.php" class="btn-agende btn-pulse">
            AGENDE SUA VISITA <i class="fa-regular fa-calendar-days"></i>
        </a>
    <?php else: ?>
        <button class="btn-agende btn-pulse" id="abrirModal">
            AGENDE SUA VISITA <i class="fa-regular fa-calendar-days"></i>
        </button>
    <?php endif; ?>
  </div>
</div>

<div id="modalLogin" class="modal">
     <div class="modal-content">
         <span class="fechar"><i class="fas fa-times"></i></span>
          <h2>Acesso Necessário <i class="fas fa-lock fa-sm"></i></h2> 
          <p>Entre em sua conta ou cadastre-se e descubra como é fácil transformar seu espaço com a <strong>ZUPINTURAS</strong>.</p> 
          <div class="botoes-modal"> 
            <a href="<?php echo RAIZ_PROJETO; ?>auth/views/login.php" class="btn-modal"> Fazer login <i class="fas fa-sign-in-alt"></i></a> 
            <a href="<?php echo RAIZ_PROJETO; ?>auth/views/cadastro.php" class="btn-modal btn-secundario"> Cadastrar-se <i class="fas fa-user-plus"></i></a> 
        </div> 
    </div> 
</div>

<!-- SOBRE -->
<section class="sobre">
  <div class="conteudo animar fade-left">
    <h3>Um pouco sobre nós</h3>
    <div class="linha"></div>
    <h2>Qualidade &amp; Satisfação</h2>
    <div class="texto">
      <p>
        Em 2009, <strong>Exupério Pereira</strong>, que até então era garçom, decidiu dar um passo ousado e fundou sua própria empresa no ramo de pintura. Inspirado pelos irmãos mais velhos, que já atuavam na área, ele encontrou motivação e coragem para começar do zero.
      </p>
      <p>
        Desde então, a <span>ZUPINTURAS</span> vem se destacando com responsabilidade, experiência e compromisso com a qualidade, transformando imóveis com excelência e profissionalismo.
      </p>
    </div>
  </div>
  <div class="imagem animar fade-right">
    <img src="<?php echo RAIZ_PROJETO;?>assets/img/ferramentas-sobre.jpg" alt="Ferramentas para Pinturas">
  </div>
</section>

<!-- SERVIÇOS -->
<section class="servicos animar fade-up">
  <h2>Nossos Serviços</h2>
  <div class="linha"></div>
  <p>
    A ZUPINTURAS oferece um serviço profissional e pensado na satisfação do cliente. Realizamos pinturas em geral, seja em residências e imóveis comerciais.
  </p>
  <div class="cards">
    <div class="card animar zoom-in">
      <img src="<?php echo RAIZ_PROJETO;?>assets/img/residencial-servicos.jpg" alt="Rolo com tinta Amarela">
      <span>Pintura Residencial</span>
    </div>
    <div class="card animar zoom-in">
      <img src="<?php echo RAIZ_PROJETO;?>assets/img/comercial-servicos.jpg" alt="Latas de Tinta">
      <span>Pintura Comercial</span>
    </div>
    <div class="card animar zoom-in">
      <img src="<?php echo RAIZ_PROJETO;?>assets/img/texturas-servicos.jpg" alt="Multiplas Texturas">
      <span>Texturas</span>
    </div>
    <div class="card animar zoom-in">
      <img src="<?php echo RAIZ_PROJETO;?>assets/img/impermeabilizacao-servicos.jpg" alt="Parede Impermeabilizada">
      <span>Impermeabilização</span>
    </div>
  </div>
  <a href="<?php echo RAIZ_PROJETO; ?>views/servicos.php" class="botao-servicos">
    Conheça Nossos Serviços <i class="fa-solid fa-arrow-right"></i>
  </a>
</section>

<!-- LOCALIZAÇÃO -->
<section class="localizacao animar fade-up">
  <h2>Locais de Atendimento</h2>
  <div class="linha"></div>
  <p class="descricao">
    A ZUPINTURAS está localizada em Sorocaba e atua em toda a região, oferecendo serviços de pintura com qualidade, responsabilidade e compromisso com o cliente.
  </p>

  <div class="conteudo">
    <div class="mapa animar fade-right">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117105.12419236638!2d-47.54910125225094!3d-23.477227189201994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c5f54bcad87989%3A0x4a9099fb9d10cb8e!2sSorocaba%2C%20SP!5e0!3m2!1spt-BR!2sbr!4v1755983447293!5m2!1spt-BR!2sbr" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"></iframe>
    </div>

    <div class="info animar fade-left">
      <div class="informacoes">
        <h3>Informações</h3>
        <p>
          Atendemos as regiões de <strong>Sorocaba</strong>, <strong>Araçoiaba da Terra</strong>, 
          <strong>Itu</strong> e <strong>Piedade</strong>.
        </p>
      </div>
      <div class="contatos">
        <h3>Contatos</h3>
        <p><i class="fa-solid fa-phone"></i> <strong>(11) 3456-7890</strong></p>
        <p><i class="fa-solid fa-envelope"></i> zupiturasempresa@gmail.com</p>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="faqs animar fade-up">
  <div class="faqs-text" id="faq">
    <h1>Perguntas Frequentes</h1>
    <div class="linha"></div>
        <div class="accordions-box">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsetwo"
                            aria-expanded="true"
                            aria-controls="collapsetwo"
                        >
                            Do que se trata a plataforma?
                        </button>
                    </h2>
                    <div
                        id="collapsetwo"
                        class="accordion-collapse collapse"
                        aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample"
                    >
                        <div class="accordion-body">
                            Nossa plataforma tem como objetivo organizar os agendamentos de visitas dos clientes cadastrados, que recebem prioridade, além de apresentar de forma clara todos os nossos serviços.
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsethree"
                            aria-expanded="true"
                            aria-controls="collapsethree"
                        >
                            Qual é a média de preço para uma pintura residencial?
                        </button>
                    </h2>
                    <div
                        id="collapsethree"
                        class="accordion-collapse collapse"
                        aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample"
                    >
                        <div class="accordion-body">
                            Não existe um valor médio fixo, pois o preço varia conforme as condições da obra, como presença de móveis, escolha do material (do cliente ou fornecido por nós) e outras especificações. A visita técnica, que em Sorocaba e região é gratuita, permite fornecer um orçamento preciso.
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsefour"
                            aria-expanded="true"
                            aria-controls="collapsefour"
                        >
                            É seguro fazer login e usar a plataforma para agendar visitas?
                        </button>
                    </h2>
                    <div
                        id="collapsefour"
                        class="accordion-collapse collapse"
                        aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample"
                    >
                        <div class="accordion-body">
                            Sim! Nossa plataforma utiliza tecnologias de criptografia que garantem a proteção de todos os seus dados pessoais e informações de agendamento.
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapsefive"
                            aria-expanded="true"
                            aria-controls="collapsefive"
                        >
                            Quais são as vantagens de usar a plataforma em vez do WhatsApp para agendar visitas?
                        </button>
                    </h2>
                    <div
                        id="collapsefive"
                        class="accordion-collapse collapse"
                        aria-labelledby="headingFour"
                        data-bs-parent="#accordionExample"
                    >
                        <div class="accordion-body">
                            A plataforma oferece uma organização completa dos agendamentos, garantindo que cada cliente tenha prioridade e que o processo seja mais ágil, prático e eficiente no dia da visita, diferente do WhatsApp, que pode gerar mensagens perdidas ou confusão nos horários.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    document.addEventListener("DOMContentLoaded", function() {
         const modal = document.getElementById("modalLogin"); 
         const abrir = document.getElementById("abrirModal"); 
         const fechar = document.querySelector(".fechar"); 
         if (abrir) { abrir.addEventListener("click", () => modal.classList.add("ativo")); } 
         if (fechar) { fechar.addEventListener("click", () => modal.classList.remove("ativo")); } 
         window.addEventListener("click", (e) => { if (e.target === modal) modal.classList.remove("ativo"); });
    });
    window.addEventListener('load', () => {

    const popText = document.querySelector('.pop');
    const waveTitle = document.querySelector('.wave-hover');
    const linha = document.querySelector('.linha');
    const aboutText = document.querySelector('.projetos-about p');
    const projetos = document.querySelectorAll('.projeto');

    if (popText) {
        const letters = popText.textContent.split('');
        popText.textContent = '';
        letters.forEach((letter, i) => {
        const span = document.createElement('span');
        span.textContent = letter;
        span.style.opacity = 0;
        span.style.transform = 'translateY(20px)';
        span.style.display = 'inline-block';
        span.style.transition = 'all 0.9s ease';
        popText.appendChild(span);
        setTimeout(() => {
            span.style.opacity = 1;
            span.style.transform = 'translateY(0)';
        }, i * 100);
        });
    }

    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return rect.top < window.innerHeight && rect.bottom >= 0;
    }

    function animateParagraph(p) {
        const text = p.textContent.trim();
        const sentences = text.split(/(?<=[.!?])\s+/);
        p.textContent = '';
        sentences.forEach((sentence, i) => {
        const span = document.createElement('span');
        span.textContent = sentence + ' ';
        span.style.opacity = 0;
        span.style.display = 'inline-block';
        span.style.transform = 'translateY(15px)';
        span.style.transition = 'all 0.6s ease';
        p.appendChild(span);
        setTimeout(() => {
            span.style.opacity = 1;
            span.style.transform = 'translateY(0)';
        }, i * 500);
        });
    }

    function checkWave() {
        if (waveTitle && linha && isInViewport(waveTitle)) {
        waveTitle.classList.add('active');
        linha.classList.add('active');
        }

        if (aboutText && isInViewport(aboutText) && !aboutText.classList.contains('active')) {
        aboutText.classList.add('active');
        animateParagraph(aboutText);
        }
    }

    function animateProjetos() {
        projetos.forEach((projeto, i) => {
        if (isInViewport(projeto) && !projeto.classList.contains('animate')) {
            setTimeout(() => {
            projeto.classList.add('animate');
            }, i * 200);
        }
        });
    }

    checkWave();
    window.addEventListener('scroll', checkWave);
    window.addEventListener('scroll', animateProjetos);
    window.addEventListener('load', animateProjetos);

    const observador = new IntersectionObserver((entradas) => {
        entradas.forEach((entrada) => {
        if (entrada.isIntersecting) {
            const elemento = entrada.target;
            elemento.classList.add("ativo");

            if (elemento.classList.contains("cards")) {
            const filhos = elemento.querySelectorAll(".card");
            filhos.forEach((filho, i) => {
                setTimeout(() => filho.classList.add("ativo"), i * 150);
            });
            }
        }
        });
    }, { threshold: 0.2 });

    document.querySelectorAll(".animar, .cards").forEach((el) => observador.observe(el));

    });
</script>
