<?php
    include("../../config.php");
    include HEADER_TEMPLATE;
    include "../../inc/Banco.php";
    include_once UTEIS;
    if(empty($_SESSION['tipo'])){
    header("Location:".RAIZ_PROJETO);
    exit;
}

    $busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';
    $bd = new Banco;

    try {
        if ($busca !== '') {
            // Monta a condição de busca
            if (is_numeric($busca)) {
                // Se for número, pode estar buscando por ID
                $usuarios = $bd->select(
                    "usuarios",
                    "*",
                    ["id" => $busca],
                    true,
                    0,
                    "fetch_all_assoc"
                );
            } else {
                // Busca por nome ou e-mail (case-insensitive)
                $conn = $bd->open_db();
                $stmt = $conn->prepare("
                    SELECT * FROM usuarios
                    WHERE LOWER(nome) LIKE LOWER(:busca)
                       OR LOWER(email) LIKE LOWER(:busca)
                ");
                $stmt->execute([':busca' => "%$busca%"]);
                $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } else {
            // Sem filtro → lista todos
            $usuarios = $bd->select("usuarios", "*", [], true, 0, "fetch_all_assoc");
        }
    } catch (Exception $e) {
        $usuarios = [];
        $_SESSION['message'] = "Erro ao carregar usuários: " . $e->getMessage();
        $_SESSION['type'] = 'danger';
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
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h2 class="text-center mb-0">Lista de Usuários</h2>

        <div class="d-flex gap-2">
            <!-- Campo de pesquisa -->
            <form method="get" class="d-flex" role="search">
                <input type="text" name="busca" class="form-control me-2" 
                       placeholder="Buscar por nome, e-mail ou ID" 
                       value="<?= htmlspecialchars($busca) ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Pesquisar
                </button>
            </form>

            

            <!-- Botão de recarregar -->
            <button onclick="location.href='?'" class="btn btn-outline-primary">
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

                                <td class="text-center">
                                   <button class="btn btn-primary btn-sm btn-detalhes" data-id="<?= $usuario['id'] ?>">
                                        <i class="bi bi-gear"></i> Ação
                                    </button>
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
<!-- Modal Bootstrap -->
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalUsuarioLabel">Detalhes do Usuário</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body" id="conteudoModal">
        <div class="text-center p-3">Carregando...</div>
      </div>
      <div class="modal-footer" id="footerModal">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<?php
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>
