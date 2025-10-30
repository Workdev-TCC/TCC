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

    <div class="hero-projetos">
        <div class="projetos-text">
            <h1>Conheça nossos <span class="pop">projetos</span></h1>
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

    <div class="projetos">
        <div class="grade-projetos">
            <div class="projeto">
                <img src="<?php echo RAIZ_PROJETO;?>assets/img/casa-residencial.jpeg" alt="Pintura Residencial Premium">
                <div class="overlay">
                    <h2>Pintura Residencial Premium</h2>
                    <p>Transformamos a sua casa com um toque de sofisticação: pintura completa de paredes internas e externas, escolha personalizada de cores, aplicação de verniz protetor e detalhes decorativos que valorizam cada ambiente, criando um lar moderno e acolhedor.</p>
                </div>
            </div>

            <div class="projeto">
                <img src="<?php echo RAIZ_PROJETO;?>assets/img/pintura-comercial.jpg" alt="Renovação Comercial de Alto Impacto">
                <div class="overlay">
                    <h2>Renovação Comercial de Alto Impacto</h2>
                    <p>Revitalizamos fachadas e interiores de empresas com pintura resistente e cores que reforçam a identidade visual do seu negócio. Incluímos acabamentos de qualidade, rodapés e detalhes que causam excelente impressão aos clientes.</p>
                </div>
            </div>

            <div class="projeto">
                <img src="<?php echo RAIZ_PROJETO;?>assets/img/pintura-predial.jpg" alt="Pintura Industrial e Predial Profissional">
                <div class="overlay">
                    <h2>Pintura Industrial e Predial Profissional</h2>
                    <p>Garantimos durabilidade e funcionalidade em espaços industriais e prediais, aplicando pintura epóxi em pisos, sinalização de segurança e acabamento resistente. Protegemos fachadas e paredes internas, unindo estética e segurança em cada projeto.</p>
                </div>
            </div>

            <div class="projeto alto">
                <img src="<?php echo RAIZ_PROJETO;?>assets/img/texturas.jpg" alt="Projeto Decorativo Exclusivo">
                <div class="overlay">
                    <h2>Projeto Decorativo Exclusivo</h2>
                    <p>Elevamos ambientes com técnicas de pintura artística: texturas sofisticadas, marmorizados, spatulados e efeitos personalizados que tornam cada espaço único. Cada detalhe é pensado para encantar e valorizar o local.</p>
                </div>
            </div>

            <div class="projeto baixo">
                <img src="<?php echo RAIZ_PROJETO;?>assets/img/pintura-fachada.jpg" alt="Reforma Completa de Fachadas">
                <div class="overlay">
                    <h2>Reforma Completa de Fachadas</h2>
                    <p>Transformamos fachadas desgastadas em vitrines de beleza e proteção. Corrigimos imperfeições, aplicamos pintura impermeável de alta durabilidade e realizamos acabamentos detalhados, garantindo estética moderna e resistência ao tempo.</p>
                </div>
            </div>

            <div class="projeto">
                <img src="<?php echo RAIZ_PROJETO;?>assets/img/pintura-interiores.jpg" alt="Pintura e Acabamento de Interiores Sofisticados">
                <div class="overlay">
                    <h2>Pintura e Acabamento de Interiores Sofisticados</h2>
                    <p>Deixamos interiores modernos e acolhedores com pintura impecável, acabamento liso ou texturizado, nivelamento de superfícies e detalhes decorativos. Cada ambiente é planejado para combinar estética, conforto e personalidade.</p>
                </div>
            </div>
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