<?php
    include("../../config.php");
    include HEADER_TEMPLATE;
    include "../../inc/Banco.php";
    include_once UTEIS;

    try {
        $bd= new Banco;
        $usuarios=$bd->select("usuarios","*",[],true,0,"fetch_all_assoc");
    } catch (Exception $e) {
        
    }
?>
<?php if (!empty($_SESSION['message'])) : ?>
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center mb-0">Lista de Usuários</h2>

        <div class="d-flex gap-2">
            <!-- Botão de filtro -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filtroDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-funnel"></i> Filtro
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="filtroDropdown">
                    <li><a class="dropdown-item" href="#">Filtrar por ID</a></li>
                    <li><a class="dropdown-item" href="#">Filtrar por Nome</a></li>
                    <li><a class="dropdown-item" href="#">Filtrar por Email</a></li>
                    <li><a class="dropdown-item" href="#">Filtrar por Telefone</a></li>
                </ul>
            </div>

            <!-- Botão de recarregar -->
            <button onclick="location.reload()" class="btn btn-outline-primary">
                <i class="bi bi-arrow-clockwise"></i> Recarregar
            </button>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <?php if (count($usuarios) > 0): ?>
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Contato</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars($usuario['id']) ?></td>
                                <td><?= htmlspecialchars($usuario['nome']) ?></td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>

                                <!-- Botão WhatsApp -->
                                <td class="text-center">
                                    <?php if (!empty($usuario['telefone'])): 
                                        $telefoneLimpo = preg_replace('/\D/', '', $usuario['telefone']);
                                        $linkZap = "https://wa.me/55{$telefoneLimpo}";
                                    ?>
                                        <a href="<?= $linkZap ?>" target="_blank" class="btn btn-success btn-sm">
                                            <i class="bi bi-whatsapp"></i> WhatsApp
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">Sem contato</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Botão de ação -->
                                <td class="text-center">
                                    <a href="#" class="btn btn-primary btn-sm">
                                        <i class="bi bi-gear"></i> Ação
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning text-center">Nenhum usuário encontrado.</div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>