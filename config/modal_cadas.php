<!-- Modal de Cadastro -->
<div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg">

            <!-- Cabeçalho bonito -->
            <div class="modal-header flex-column border-0 bg-dark text-white text-center rounded-top-4 p-4">
                <i class="fas fa-user-plus fa-4x mb-3"></i>
                <h2 class="modal-title w-100" id="cadastroModalLabel">Formulário de Cadastro</h2>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                    data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <!-- Corpo do modal -->
            <div class="modal-body p-5">
                <form method="post" action="processa_cadas.php" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="nome" class="form-label">
                            <i class="fas fa-user me-2"></i>Nome
                        </label>
                        <input type="text" class="form-control form-control-lg rounded-3" id="nome" name="usuario[name]"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="emailCadastro" class="form-label">
                            <i class="fas fa-envelope me-2"></i>E-mail
                        </label>
                        <input type="email" class="form-control form-control-lg rounded-3" id="emailCadastro"
                            name="usuario[email]" required>
                    </div>

                    <div class="mb-4">
                        <label for="senhaCadastro" class="form-label">
                            <i class="fas fa-lock me-2"></i>Senha
                        </label>
                        <input type="password" class="form-control form-control-lg rounded-3" id="senhaCadastro"
                            name="usuario[senha]" required>
                    </div>
                    <div class="mb-4">
                        <label for="telefone" class="form-label">
                            <i class="fas fa-phone me-2"></i>Telefone
                        </label>
                        <input type="text" class="form-control form-control-lg rounded-3" id="telefone" name="usuario[telefone]"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="telefone" class="form-label">
                            <i class="fas fa-image me-2"></i>Foto
                        </label>
                        <input type="file" class="form-control form-control-lg rounded-3" id="foto" name="foto">
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-dark btn-lg rounded-pill">
                            <i class="fas fa-user-plus me-2"></i>Cadastrar
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="mb-0">Já tem uma conta?
                            <a href="#" class="text-dark fw-bold" data-bs-dismiss="modal" data-bs-toggle="modal"
                                data-bs-target="#loginModal">Login</a>
                        </p>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>