<!-- Modal de Perfil -->
<?php if (isset($_SESSION['user'])):?>
<div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="perfilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slide-right">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="perfilModalLabel">Perfil</h5>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo RAIZ_PROJETO;?>usuarios/img/<?php echo $_SESSION['foto'];?>" alt="Foto de Perfil"
                    class="img-perfil mb-3">
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none"> Editar Dados</a></li>
                    <li><a href="#" class="text-decoration-none">Excluir Conta</a></li>
                    <li><a href="#" class="text-decoration-none">Contato</a></li>
                    <li><a href="#" class="text-decoration-none">Sair</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>