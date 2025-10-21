<?php
include("../../config.php");
include "../../inc/Banco.php";

session_start();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$bd = new Banco;
$conn = $bd->open_db();

$stmt = $conn->prepare("SELECT id, nome, email, telefone, foto, tipo, data_criacao FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<div class='alert alert-warning text-center'>Usuário não encontrado.</div>";
    exit;
}
?>

<div class="text-center mb-3">
    <img src="<?php echo RAIZ_PROJETO;?>usuarios/img/<?= htmlspecialchars($usuario['foto']) ?>" alt="Foto do usuário"
         class="rounded-circle shadow mb-3" width="120" height="120">
</div>

<ul class="list-group mb-3">
    <li class="list-group-item"><strong>ID:</strong> <?= htmlspecialchars($usuario['id']) ?></li>
    <li class="list-group-item"><strong>Nome:</strong> <?= htmlspecialchars($usuario['nome']) ?></li>
    <li class="list-group-item"><strong>E-mail:</strong> <?= htmlspecialchars($usuario['email']) ?></li>
    <?php if (!empty($usuario['telefone'])): ?>
        <li class="list-group-item"><strong>Telefone:</strong> <?= htmlspecialchars($usuario['telefone']) ?></li>
    <?php endif; ?>
    <li class="list-group-item"><strong>Data de Criação:</strong> <?= htmlspecialchars($usuario['data_criacao']) ?></li>
</ul>

<?php if ($_SESSION['tipo'] === 'admin' && $usuario['tipo'] !== 'admin'): ?>
    <button class="btn btn-danger w-100" id="btnExcluirUsuario" data-id="<?= $usuario['id'] ?>">
        <i class="bi bi-trash"></i> Excluir Usuário
    </button>
<?php endif; ?>
