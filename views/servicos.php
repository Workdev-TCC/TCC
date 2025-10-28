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
            <h1>Conheça nossos Servicos</h1>
            <p>Dê um novo visual ao seu espaço com nossos serviços de pintura e reforma. Agende sua visita!</p>
        </div>
    </div>

        <div class="projetos-about">
        <div class="about-text">
            <h1 class="wave-hover">
                <span>N</span><span>o</span><span>s</span><span>s</span><span>o</span><span>s</span>
                <span>&nbsp;</span>
                <span>S</span><span>e</span><span>r</span><span>v</span><span>i</span><span>ç</span><span>o</span><span>s</span>
            </h1> 
            <div class="linha"></div>
            <p>Transformamos ambientes residenciais, comerciais e industriais com pintura de qualidade, texturas modernas e acabamentos impecáveis. Cada projeto é único, feito para valorizar seu espaço com beleza e durabilidade. Inspire-se com nossos trabalhos e renove o seu ambiente!</p>
        </div>
    </div>

<div class="servico-page">
  <div class="card bg-dark rounded" style="width: 23rem; height: 18rem">
    <div class="card-body">
      <h5 class="card-title">Pintura Interna</h5>
      <h6 class="card-subtitle mb-5 text-muted">Cores novas, ambientes renovados</h6>
      <p class="card-text">Transforme cada cômodo com pintura lisa e acabamento perfeito. Qualidade e beleza em cada detalhe!</p>
    </div>
  </div>

  <div class="card bg-dark" style="width: 23rem; height: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Pintura Externa</h5>
      <h6 class="card-subtitle mb-5 text-muted">Proteção e estilo para sua fachada</h6>
      <p class="card-text">Cores vivas e duráveis que resistem ao sol e à chuva. Sua casa sempre com aparência nova!</p>
    </div>
  </div>

  <div class="card bg-dark" style="width: 23rem; height: 18rem">
    <div class="card-body">
      <h5 class="card-title">Pintura Decorativa</h5>
      <h6 class="card-subtitle mb-5 text-muted">Toque de estilo e personalidade</h6>
      <p class="card-text">Texturas e efeitos únicos que deixam seu ambiente moderno e cheio de charme.</p>
    </div>
  </div>
</div>

<div class="servico-page2">
  <div class="card bg-dark" style="width: 23rem; height: 18rem">
    <div class="card-body">
      <h5 class="card-title">Portas e Janelas</h5>
      <h6 class="card-subtitle mb-5 text-muted">Acabamento impecável</h6>
      <p class="card-text">Pintura lisa e uniforme em portas e janelas. Renovamos o visual com perfeição!</p>
    </div>
  </div>

  <div class="card bg-dark" style="width: 23rem; height: 18rem">
    <div class="card-body">
      <h5 class="card-title">Tetos e Forros</h5>
      <h6 class="card-subtitle mb-5 text-muted">Ambientes mais claros e limpos</h6>
      <p class="card-text">Teto bem pintado transforma o ambiente. Serviço rápido, limpo e com ótimo acabamento!</p>
    </div>
  </div>

  <div class="card bg-dark" style="width: 23rem; height: 18rem">
    <div class="card-body">
      <h5 class="card-title">Preparação de Superfícies</h5>
      <h6 class="card-subtitle mb-5 text-muted">A base da pintura perfeita</h6>
      <p class="card-text">Lixamento e correções para garantir pintura lisa e duradoura. Pronto para o novo!</p>
    </div>
  </div>
</div>

<script>
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
            p.appendChild(span);
            setTimeout(() => {
                span.style.opacity = 1;
                span.style.transform = 'translateY(0)';
            }, i * 600);
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
});
</script>
<?php
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>