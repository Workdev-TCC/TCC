<?php
    include("../config.php");
    include HEADER_TEMPLATE;
    include DBAPI;
    include_once UTEIS;
?>
  <?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php clear_messages(); ?>
  <?php endif; ?>

  <div class="hero-servicos">
    <div class="servicos-text">
      <h1>Nossos <span class="pop">serviços</span></h1>
      <p>Transforme seu espaço com nossos serviços especializados! Oferecemos pintura residencial e comercial, reformas de fachadas e pintura decorativa. Agende uma visita e descubra a solução perfeita para o seu ambiente.</p>
    </div>
  </div>

  <div class="servicos-about">
    <div class="about-text">
      <h1 class="wave-hover">
        <span>N</span><span>o</span><span>s</span><span>s</span><span>o</span><span>s</span>
        <span>&nbsp;</span>
        <span>S</span><span>e</span><span>r</span><span>v</span><span>i</span><span>ç</span><span>o</span><span>s</span>
      </h1> 
      <div class="linha"></div>
      <p>Está com dificuldade para encontrar profissionais especializados ou uma empresa de pintura que ofereça um serviço com qualidade e atendimento diferenciado?
      Trabalhamos com pinturas residenciais e comerciais oferecendo novos conceitos de qualidade, comodidade e garantia, com um atendimento diferenciado garantindo a total satisfação do cliente e a excelência nos serviços prestados.</p>
    </div>
  </div>

  <!-- === GALERIA DESKTOP === -->
  <div class="servicos-galeria">
    <div class="galeria-card large">
      <img src="<?php echo RAIZ_PROJETO;?>assets/img/pintura-interna.webp" alt="Pintura Interna">
      <div class="overlay"><h3>Pintura Interna</h3></div>
    </div>
    <div class="galeria-card wide">
      <img src="<?php echo RAIZ_PROJETO;?>assets/img/pintura-casa.webp" alt="Pintura da Fachadas">
      <div class="overlay"><h3>Pintura da Fachada</h3></div>
    </div>
    <div class="galeria-card">
      <img src="<?php echo RAIZ_PROJETO;?>assets/img/pintura-portao.webp" alt=">Pintura Portão">
      <div class="overlay"><h3>Pintura de Portões, Janelas e Grades</h3></div>
    </div>
    <div class="galeria-card">
      <img src="<?php echo RAIZ_PROJETO;?>assets/img/pintura-decorativa.webp" alt="Pintura Decorativa">
      <div class="overlay"><h3>Pintura Decorativa</h3></div>
    </div>
    <div class="galeria-card small">
      <img src="<?php echo RAIZ_PROJETO;?>assets/img/textura-grafiato.webp" alt="Aplicação de Texturas">
      <div class="overlay"><h3>Aplicação de Texturas</h3></div>
    </div>
    <div class="galeria-card wide">
      <img src="<?php echo RAIZ_PROJETO;?>assets/img/pintura-predio.webp" alt="Pintura Predial">
      <div class="overlay"><h3>Pintura Predial</h3></div>
    </div>
  </div>

  <div id="lightbox" class="lightbox">
    <span class="close">&times;</span>
    <img class="lightbox-img" id="lightbox-img">
  </div>

 <script>
  window.addEventListener('load', () => {
    const popText = document.querySelector('.pop');
    const waveTitle = document.querySelector('.wave-hover');
    const linha = document.querySelector('.linha');
    const aboutText = document.querySelector('.servicos-about p');
    const galeria = document.querySelector('.servicos-galeria');

    // === Animação das letras do "serviços" ===
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

    // === Função pra verificar se um elemento está visível na tela ===
    function isInViewport(element) {
      const rect = element.getBoundingClientRect();
      return rect.top < window.innerHeight && rect.bottom >= 0;
    }

    // === Parágrafo do "sobre" com efeito de frase ===
    function animateParagraph(p) {
      const text = p.textContent.trim();
      const sentences = text.split(/(?<=[.!?])\s+/);
      p.textContent = '';
      sentences.forEach((sentence, i) => {
        const span = document.createElement('span');
        span.textContent = sentence + ' ';
        p.appendChild(span);
        setTimeout(() => {
          span.style.opacity = 1;
          span.style.transform = 'translateY(0)';
        }, i * 600);
      });
    }

    // === Ativa o wave e linha ===
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

    // === Animação da galeria ao rolar ===
    function animateGaleria() {
      if (galeria && isInViewport(galeria)) {
        galeria.classList.add('show');
      }
    }

    // === Chamadas iniciais ===
    checkWave();
    animateGaleria();

    // === Eventos de scroll ===
    window.addEventListener('scroll', () => {
      checkWave();
      animateGaleria();
    });
  });

  // === LIGHTBOX DE IMAGENS ===
  document.addEventListener("DOMContentLoaded", function() {
    const cards = document.querySelectorAll(".galeria-card img");
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    const closeBtn = document.querySelector(".lightbox .close");

    cards.forEach(img => {
      img.addEventListener("click", () => {
        lightbox.style.display = "flex";
        lightboxImg.src = img.src;
      });
    });

    closeBtn.addEventListener("click", () => {
      lightbox.style.display = "none";
    });

    lightbox.addEventListener("click", (e) => {
      if (e.target === lightbox) lightbox.style.display = "none";
    });
  });
</script>



<?php
  include SIDEBAR;
  include USERBAR;
  include FOOTER_TEMPLATE;
?>