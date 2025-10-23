<?php
include("../../config.php");
include HEADER_TEMPLATE;
include "../../inc/Banco.php";
include_once UTEIS;
if(empty($_SESSION['tipo'])){
    header("Location:".RAIZ_PROJETO);
    exit;
}

if ($_SESSION['tipo'] !== 'admin') {
    header("Location: ../../usuarios/views/gerenciar_solicitacoes.php");
    exit;
}

try {
    $bd = new Banco();
    $solicitacoes = $bd->select(
        'solicitacoes s 
         LEFT JOIN usuarios u ON s.usuario_id = u.id 
         LEFT JOIN visitas_agendadas v ON s.id = v.solicitacao_id',
        's.id, s.usuario_id, s.descricao, s.cep, s.endereco, s.complemento, s.status, 
         s.observacao_admin, s.data_solicitacao, 
         u.nome AS nome_usuario, u.email, u.telefone,
         v.data_visita, v.hora_visita',
        ['s.status' => 'marcado'],
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
    <!-- Cabeçalho e navegação -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <h2 class="mb-3 mb-md-0 text-center text-md-start">Solicitações Marcadas</h2>

        <div class="d-flex flex-column flex-sm-row align-items-center gap-2 w-100 w-md-auto justify-content-center justify-content-md-end">
            <nav aria-label="Navegação de solicitações" class="flex-shrink-0">
                <ul class="pagination mb-0 flex-wrap justify-content-center">
                    <?php $current = basename($_SERVER['PHP_SELF']); ?>
                    <li class="page-item <?= $current === 'gerenciar_solicitacoes.php' ? 'active' : '' ?>">
                        <a class="page-link" href="<?= RAIZ_PROJETO; ?>admin/views/gerenciar_solicitacoes.php">Todos</a>
                    </li>
                    <li class="page-item <?= $current === 'solicitacoes_pendentes.php' ? 'active' : '' ?>">
                        <a class="page-link" href="<?= RAIZ_PROJETO; ?>admin/views/solicitacoes_pendentes.php">Pendentes</a>
                    </li>
                    <li class="page-item <?= $current === 'solicitacoes_marcadas.php' ? 'active' : '' ?>">
                        <a class="page-link" href="<?= RAIZ_PROJETO; ?>admin/views/solicitacoes_marcadas.php">Marcados</a>
                    </li>
                    <li class="page-item <?= $current === 'solicitacoes_recusadas.php' ? 'active' : '' ?>">
                        <a class="page-link" href="<?= RAIZ_PROJETO; ?>admin/views/solicitacoes_recusadas.php">Recusadas</a>
                    </li>
                </ul>
            </nav>

            <button class="btn btn-outline-primary mt-2 mt-sm-0" onclick="location.reload()">
                <i class="fa fa-refresh"></i> Recarregar
            </button>
        </div>
    </div>

    <!-- Tabela -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
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
                                <th>Contato</th>
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
                                        <div class="d-flex flex-column align-items-center gap-1">
                                            <!-- WhatsApp -->
                                            <a href="https://wa.me/55<?= preg_replace('/\D/', '', $s['telefone']) ?>" 
                                               target="_blank" class="btn btn-success btn-sm w-100">
                                                <i class="fa-brands fa-whatsapp"></i> WhatsApp
                                            </a>
                                            <!-- Telefone -->
                                            <span class="small"><?= htmlspecialchars($s['telefone']) ?></span>
                                            <!-- Email -->
                                            <a href="mailto:<?= htmlspecialchars($s['email']) ?>" class="small text-decoration-none text-primary">
                                                <?= htmlspecialchars($s['email']) ?>
                                            </a>
                                        </div>
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
</div>

<!-- Modal de justificativa -->
<div class="modal fade" id="modalJustificativa" tabindex="-1" aria-labelledby="modalJustificativaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title">Justificativa de Recusa</h5>
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

            if (status === "marcado" && (!data || !hora)) {
                alert("Preencha a data e a hora antes de salvar.");
                return;
            }

            if (status === "recusado") {
                solicitacaoSelecionada = { id, status, data, hora };
                justificativaModal.show();
            } else {
                salvarAlteracao(id, status, data, hora, "");
            }
        });
    });

    document.getElementById("confirmarRecusa").addEventListener("click", () => {
        const justificativa = document.getElementById("justificativaTexto").value.trim();
        if (!justificativa) {
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
            body: new URLSearchParams({ id, status, data, hora, justificativa })
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
