<?php
    include("../config.php");
    include("../inc/Banco.php");
    include HEADER_TEMPLATE;
    include DBAPI;
    include_once UTEIS;

    $bd = new Banco();
    $projetos = $bd->select("projetos", "*");

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

?>

    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="message-<?php echo $_SESSION['type']; ?>">
            <?php if ($_SESSION['type'] === "success") : ?>
                <i class="fas fa-check-circle icon-message"></i>
            <?php else : ?>
                <i class="fas fa-times-circle icon-message"></i>
            <?php endif; ?>
            <span><?php echo $_SESSION['message']; ?></span>
            <i class="fas fa-times btn-close" onclick="this.parentElement.remove()"></i>
        </div>
        <?php unset($_SESSION['message']); unset($_SESSION['type']); ?>
        <!-- <?php clear_messages(); ?> -->
    <?php endif; ?>

    <div class="hero-projetos">
        <div class="projetos-text">
            <h1>Nossos <span class="pop">projetos</span></h1>
            <p>Explore nossos projetos e veja como transformamos ambientes com criatividade e qualidade, incluindo pinturas residenciais e comerciais, reformas de fachadas e pintura decorativa.</p>
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

    <div class="projetos">
        <div class="grade-projetos">
            <?php if (!empty($projetos)) : ?>
                <?php foreach($projetos as $p): ?>
                    <div class="projeto">
                        <img src="<?php echo RAIZ_PROJETO . 'assets/admin/img/' . $p['imagem']; ?>">
                        <div class="overlay">
                            <h2><?php echo $p['titulo']; ?></h2>
                            <p><?php echo $p['descricao']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="nenhum-projeto">Nenhum projeto encontrado.</p>
            <?php endif; ?>
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
        return rect.top < window.innerHeight * 0.85 && rect.bottom > 0;
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