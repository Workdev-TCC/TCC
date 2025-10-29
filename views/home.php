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
      <a href="<?php echo RAIZ_PROJETO; ?>auth/views/login.php" class="btn-modal">
        Fazer login <i class="fas fa-sign-in-alt"></i> 
      </a>
      <a href="<?php echo RAIZ_PROJETO; ?>auth/views/cadastro.php" class="btn-modal btn-secundario">
        Cadastrar-se <i class="fas fa-user-plus"></i>
      </a>
    </div>
  </div>
</div>

<section class="servicos">
    <div class="img">
        <img src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
    </div>
    <div class="servicos-text">
        <h1>NOSSOS SERVIÇOS</h1>
        <ul>
            <li>Pintura Residencial</li>
            <li>Pintura Comercial</li>
            <li>Texturas e Efeitos Especias</li>
            <li>Tratamento de Imperfeições</li>
        </ul>
        <a class="servicos-btn"  href="#">MAIS INFORMAÇÕES</a>
    </div>
</section>
<section class="sobre">
    <div class="sobre-text">
        <h1>SOBRE NÓS</h1>
        <h2><strong>Zupinturas</strong></h2>
        <p>Em 2009, <strong>Exupério Pereira</strong>, que até então era garçom, decidiu dar um passo ousado e fundou sua própria empresa no ramo de pintura.
        Inspirado pelos irmãos, que já atuavam na área, ele encontrou motivação e coragem para começar do zero. Desde então, a <strong>ZUPINTURAS</strong> vem
        se destacando com responsabilidade, experiência e compromisso com a qualidade, transformando imóveis com excelência e profissionalismo.</p>
    </div>
    <div class="sobre-img">
        <img src="<?php echo RAIZ_PROJETO;?>assets/img/sobre.jpg" alt="erro">
    </div>
</section>
<section class="localizacao">
    <div class="localizacao-text">
        <h1>Locais de Atendimento</h1>
        <div class="linha">

        </div>
    </div>
    <div class="maps">
        
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117105.12419236638!2d-47.54910125225094!3d-23.477227189201994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c5f54bcad87989%3A0x4a9099fb9d10cb8e!2sSorocaba%2C%20SP!5e0!3m2!1spt-BR!2sbr!4v1755983447293!5m2!1spt-BR!2sbr"
        width="1360"
        height="400" 
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        id="map1"
        referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1ECiKyD7ZmJuNclG7y0HtW-qd-LUfCuo&ehbc=2E312F&noprof=1" width="1000" id="map2" height="400" style="display:none"></iframe>
    </div>

    <div class="info">
        <div class="informacao">
            <h2>Nossas regiões de atendimento:</h2>
            <p>São nas cidades: <strong>Sorocaba, Itu, Pilar do Sul</strong> e <strong>Piedade</strong></p>
        </div>
        <div class="contato">
            <h2>Contato</h2>
                <p><strong>(11) 3456-7890</strong></p>
        </div>
    </div>
</section>

<section class="faqs">
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
window.addEventListener('load', () => {
  const waveTitle = document.querySelector('.wave-hover');
  if (waveTitle) {
    waveTitle.classList.add('active');
  }
});

document.addEventListener("DOMContentLoaded", function() {
  const modal = document.getElementById("modalLogin");
  const abrir = document.getElementById("abrirModal");
  const fechar = document.querySelector(".fechar");

  if (abrir) {
    abrir.addEventListener("click", () => modal.classList.add("ativo"));
  }

  if (fechar) {
    fechar.addEventListener("click", () => modal.classList.remove("ativo"));
  }

  window.addEventListener("click", (e) => {
    if (e.target === modal) modal.classList.remove("ativo");
  });
});
</script>
