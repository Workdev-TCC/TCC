<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg">

            <!-- Cabeçalho bonito com cinza escuro -->
            <div class="modal-header flex-column border-0 bg-dark text-white text-center rounded-top-4 p-4">
                <i class="fas fa-user-circle fa-4x mb-3"></i>
                <h2 class="modal-title w-100" id="loginModalLabel">Formulário de Login</h2>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                    data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <!-- Corpo do modal -->
            <div class="modal-body p-5">
                <form method="post" action="<?php echo RAIZ_PROJETO;?>config/auth.php">
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>E-mail
                        </label>
                        <input type="email" class="form-control form-control-lg rounded-3" id="email" name="email"
                            required autofocus>
                    </div>

                    <div class="mb-4">
                        <label for="senha" class="form-label">
                            <i class="fas fa-lock me-2"></i>Senha
                        </label>
                        <input type="password" class="form-control form-control-lg rounded-3" id="senha" name="senha"
                            required>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-dark btn-lg rounded-pill">
                            <i class="fas fa-sign-in-alt me-2"></i>Entrar
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="mb-0">Não tem cadastro?
                            <a href="#" class="text-dark fw-bold" data-bs-dismiss="modal" data-bs-toggle="modal"
                                data-bs-target="#cadastroModal">Cadastre-se!</a>
                        </p>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>