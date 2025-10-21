<?php
include("../../config.php");
include HEADER_TEMPLATE;
include "../../inc/Banco.php";
include_once UTEIS;

if ($_SESSION['tipo'] !== 'admin') {
    header("Location: ../../usuarios/views/gerenciar_solicitacoes.php");
    exit;
}

try {
    $bd = new Banco();
    // Filtro para mostrar apenas as solicitações recusadas
    $solicitacoes = $bd->select(
        'solicitacoes s 
         LEFT JOIN usuarios u ON s.usuario_id = u.id 
         LEFT JOIN visitas_agendadas v ON s.id = v.solicitacao_id',
        's.id, s.usuario_id, s.descricao, s.cep, s.endereco, s.complemento, s.status, s.observacao_admin, s.data_solicitacao,
         u.nome AS nome_usuario, u.email, u.telefone,
         v.data_visita, v.hora_visita',
        ['s.status' => 'recusado'],
        true,
        0,
        'fetch_all_assoc'
    );
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['type'] = 'danger';
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2>Solicitações Recusadas</h2>

        <div class="d-flex align-items-center gap-2">
            <!-- Paginação entre tipos -->
            <nav aria-label="Navegação de solicitações">
                <ul class="pagination mb-0">
                    <?php $current = basename($_SERVER['PHP_SELF']); ?>

                    <li class="page-item <?= $current === 'gerenciar_solicitacoes.php' ? 'active' : '' ?>">
                        <a class="page-link" href="<?php echo RAIZ_PROJETO; ?>admin/views/gerenciar_solicitacoes.php"
                           <?= $current === 'gerenciar_solicitacoes.php' ? 'aria-current="page"' : '' ?>>
                            Todos
                        </a>
                    </li>

                    <li class="page-item <?= $current === 'solicitacoes_pendentes.php' ? 'active' : '' ?>">
                        <a class="page-link" href="<?php echo RAIZ_PROJETO; ?>admin/views/solicitacoes_pendentes.php"
                           <?= $current === 'solicitacoes_pendentes.php' ? 'aria-current="page"' : '' ?>>
                            Pendentes
                        </a>
                    </li>

                    <li class="page-item <?= $current === 'solicitacoes_marcadas.php' ? 'active' : '' ?>">
                        <a class="page-link" href="<?php echo RAIZ_PROJETO; ?>admin/views/solicitacoes_marcadas.php"
                           <?= $current === 'solicitacoes_marcadas.php' ? 'aria-current="page"' : '' ?>>
                            Marcados
                        </a>
                    </li>

                    <li class="page-item <?= $current === 'solicitacoes_recusadas.php' ? 'active' : '' ?>">
                        <a class="page-link" href="<?php echo RAIZ_PROJETO; ?>admin/views/solicitacoes_recusadas.php"
                           <?= $current === 'solicitacoes_recusadas.php' ? 'aria-current="page"' : '' ?>>
                            Recusadas
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Botão de recarregar -->
            <button class="btn btn-outline-primary ms-2" onclick="location.reload()">
                <i class="fa fa-refresh"></i> Recarregar
            </button>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <?php if (!empty($solicitacoes)): ?>
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>CEP</th>
                            <th>Status</th>
                            <th>Mensagem do Admin</th>
                            <th>Data Solicitação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($solicitacoes as $s): ?>
                            <tr>
                                <td><?= $s['id'] ?></td>
                                <td><?= htmlspecialchars($s['nome_usuario']) ?></td>
                                <td><?= htmlspecialchars($s['cep']) ?></td>
                                <td><span class="badge bg-danger">Recusado</span></td>
                                <td><?= htmlspecialchars($s['observacao_admin'] ?? '—') ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($s['data_solicitacao'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning text-center">Nenhuma solicitação recusada encontrada.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
include SIDEBAR;
include USERBAR;
include FOOTER_TEMPLATE;
?>
