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
            <p>Oferecemos serviços profissionais para transformar seu ambiente, incluindo pintura residencial, comercial, reformas de fachadas e pintura decorativa. Agende uma visita e descubra qual opção é ideal para o seu espaço!</p>
        </div>
    </div>

        <div class="projetos-about">
        <div class="about-text">
            <h1 class="wave-hover">
                <span>N</span><span>o</span><span>s</span><span>s</span><span>o</span><span>s</span>
                <span>&nbsp;</span>
                <span>P</span><span>r</span><span>o</span><span>j</span><span>e</span><span>t</span><span>o</span><span>s</span>
            </h1>
            <div class="linha"></div>
            <p>Oferecemos soluções completas para transformar qualquer ambiente, seja residencial, comercial ou industrial. Nossos serviços incluem pintura decorativa, reformas de fachadas, aplicação de texturas, acabamentos modernos e projetos personalizados que valorizam cada espaço. Trabalhamos com materiais de alta qualidade e técnicas especializadas para garantir um resultado duradouro e esteticamente impecável. Abaixo, você pode conferir alguns exemplos de projetos que já realizamos e se inspirar para renovar o seu próprio espaço!</p>
        </div>
    </div>

<div class="servico-page">
    <div class="card bg-dark rounded" style="width: 22rem; height: 17rem">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle mb-5 text-muted">Card subtitle</h6>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
    <div class="card bg-dark" style="width: 22rem; height: 17rem;">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle mb-5 text-muted">Card subtitle</h6>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
    <div class="card bg-dark" style="width: 22rem; height: 17rem">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle mb-5 text-muted">Card subtitle</h6>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
    <div class="card bg-dark" style="width: 22rem; height: 17rem">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle mb-5 text-muted">Card subtitle</h6>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
</div>
<div class="servico-page2">
        <div class="card bg-dark" style="width: 22rem; height: 17rem">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle mb-5 text-muted">Card subtitle</h6>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
        <div class="card bg-dark" style="width: 22rem; height: 17rem">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle mb-5 text-muted">Card subtitle</h6>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
        <div class="card bg-dark" style="width: 22rem; height: 17rem">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle mb-5 text-muted">Card subtitle</h6>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
    </div>
        <div class="card bg-dark" style="width: 22rem; height: 17rem">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle mb-5 text-muted">Card subtitle</h6>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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