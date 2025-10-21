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
    // Filtro para mostrar apenas as solicitações marcadas
    $solicitacoes = $bd->select(
        'solicitacoes s LEFT JOIN usuarios u ON s.usuario_id = u.id LEFT JOIN visitas_agendadas v ON s.id = v.solicitacao_id',
        's.id, s.usuario_id, s.descricao, s.cep, s.endereco, s.complemento, s.status, s.observacao_admin, s.data_solicitacao,
         u.nome AS nome_usuario, u.email, u.telefone,
         v.data_visita, v.hora_visita',
        ['s.status' => 'marcado'], // <-- Aqui está o filtro
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
        <h2>Solicitações Marcadas</h2>

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
                            <th>Data Visita</th>
                            <th>Hora</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($solicitacoes as $s): ?>
                            <tr data-id="<?= $s['id'] ?>">
                                <td><?= $s['id'] ?></td>
                                <td><?= htmlspecialchars($s['nome_usuario']) ?></td>
                                <td><?= htmlspecialchars($s['cep']) ?></td>
                                <td>
                                    <select class="form-select status-select">
                                        <option value="pendente" <?= $s['status'] == 'pendente' ? 'selected' : '' ?>>Pendente</option>
                                        <option value="marcado" <?= $s['status'] == 'marcado' ? 'selected' : '' ?>>Marcado</option>
                                        <option value="recusado" <?= $s['status'] == 'recusado' ? 'selected' : '' ?>>Recusado</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="date" class="form-control data-visita" value="<?= $s['data_visita'] ?? '' ?>">
                                </td>
                                <td>
                                    <input type="time" class="form-control hora-visita" value="<?= $s['hora_visita'] ?? '' ?>">
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm salvar-btn">
                                        <i class="fa fa-save"></i> Salvar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning text-center">Nenhuma solicitação marcada encontrada.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal de justificativa -->
<div class="modal fade" id="modalJustificativa" tabindex="-1" aria-labelledby="modalJustificativaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="modalJustificativaLabel">Justificativa de Recusa</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <textarea id="justificativaTexto" class="form-control" rows="4" placeholder="Digite o motivo da recusa..."></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-danger" id="confirmarRecusa">Salvar Recusa</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    let justificativaModal = new bootstrap.Modal(document.getElementById("modalJustificativa"));
    let solicitacaoSelecionada = null;

    document.querySelectorAll(".salvar-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            const tr = this.closest("tr");
            const id = tr.dataset.id;
            const status = tr.querySelector(".status-select").value;
            const data = tr.querySelector(".data-visita").value;
            const hora = tr.querySelector(".hora-visita").value;

            if (status === "marcado") {
                if (!data || !hora) {
                    alert("Preencha a data e a hora antes de salvar.");
                    return;
                }
                salvarAlteracao(id, status, data, hora, "");
            } else if (status === "recusado") {
                solicitacaoSelecionada = { id, status, data, hora };
                justificativaModal.show();
            } else {
                salvarAlteracao(id, status, "", "", "");
            }
        });
    });

    document.getElementById("confirmarRecusa").addEventListener("click", () => {
        const justificativa = document.getElementById("justificativaTexto").value.trim();
        if (justificativa === "") {
            alert("Por favor, preencha a justificativa.");
            return;
        }
        salvarAlteracao(
            solicitacaoSelecionada.id,
            solicitacaoSelecionada.status,
            "",
            "",
            justificativa
        );
        justificativaModal.hide();
        document.getElementById("justificativaTexto").value = "";
    });

    function salvarAlteracao(id, status, data, hora, justificativa) {
        fetch("../../admin/scripts/atualizar_solicitacao.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
                id, status, data, hora, justificativa
            })
        })
        .then(r => r.json())
        .then(res => {
            alert(res.message);
            if (res.success) location.reload();
        })
        .catch(err => alert("Erro: " + err));
    }
});
</script>

<?php
include SIDEBAR;
include USERBAR;
include FOOTER_TEMPLATE;
?>
