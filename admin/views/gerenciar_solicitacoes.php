<?php 
// arquivo: admin/views/gerenciar_solicitacoes.php
include("../../config.php");
include HEADER_TEMPLATE;
include "../../inc/Banco.php";
include_once UTEIS;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
        'solicitacoes s LEFT JOIN usuarios u ON s.usuario_id = u.id LEFT JOIN visitas_agendadas v ON s.id = v.solicitacao_id',
        's.id, s.usuario_id, s.descricao, s.cep, s.endereco, s.complemento, s.status, s.observacao_admin, s.data_solicitacao,
         u.nome AS nome_usuario, u.email, u.telefone,
         v.data_visita, v.hora_visita',
        [],
        true,
        0,
        'fetch_all_assoc'
    );
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['type'] = 'danger';
}
?>
<div class="page-gerenciar-solicitacoes"> <!-- CLASE ESPECÍFICA AQUI -->
<div class="container mt-4 px-3">
    <!-- Cabeçalho e navegação -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-3">
        <div class="d-flex flex-wrap justify-content-center align-items-center gap-2 w-100 w-md-auto">
            <nav aria-label="Navegação de solicitações">
                <ul class="pagination pagination-sm mb-0 flex-wrap justify-content-center">
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

            <button class="btn btn-outline-primary btn-sm ms-md-2" onclick="location.reload()">
                <i class="fa fa-refresh"></i> Recarregar
            </button>
        </div>
    </div>

    <!-- Tabela -->
    <div class="card shadow-sm">
        <div class="card-body p-2 p-md-3">
            <?php if (!empty($solicitacoes)): ?>
               <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
    <table class="table table-bordered table-striped align-middle text-center mb-0">
        <thead class="table-dark">
            <tr>
                <th style="width:70px;">Ação</th> <!-- botão excluir -->
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
                    <!-- BOTÃO EXCLUIR -->
                    <td>
                        <button class="btn btn-danger btn-sm excluir-btn" title="Excluir solicitação">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>

                    <td><?= $s['id'] ?></td>
                    <td><?= htmlspecialchars($s['nome_usuario']) ?></td>
                    <td><?= htmlspecialchars($s['cep']) ?></td>
                    <td>
                        <select class="form-select form-select-sm status-select">
                            <option value="pendente" <?= $s['status'] == 'pendente' ? 'selected' : '' ?>>Pendente</option>
                            <option value="marcado" <?= $s['status'] == 'marcado' ? 'selected' : '' ?>>Marcado</option>
                            <option value="recusado" <?= $s['status'] == 'recusado' ? 'selected' : '' ?>>Recusado</option>
                        </select>
                    </td>
                    <td>
                        <input type="date" class="form-control form-control-sm data-visita" value="<?= $s['data_visita'] ?? '' ?>">
                    </td>
                    <td>
                        <input type="time" class="form-control form-control-sm hora-visita" value="<?= $s['hora_visita'] ?? '' ?>">
                    </td>
                    <td>
                        <a href="https://wa.me/55<?= preg_replace('/\D/', '', $s['telefone']); ?>" target="_blank" class="btn btn-success btn-contato">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </td>
                    <td>
                        <button class="btn-roxo salvar-btn">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
            <?php else: ?>
                <div class="alert alert-warning text-center mb-0">Nenhuma solicitação encontrada.</div>
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

<!-- Modal de Exclusão -->
<div class="modal fade" id="modalExcluir" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title">Excluir Solicitação</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir esta solicitação permanentemente?
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-danger" id="confirmarExclusao">Excluir</button>
      </div>
    </div>
  </div>
</div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    function aplicarCorStatusSelect() {
        document.querySelectorAll("select.status-select").forEach(sel => {
            sel.classList.remove("pendente", "marcado", "recusado");
            sel.classList.add(sel.value);
        });
    }

    // Aplica ao carregar
    aplicarCorStatusSelect();

    // Aplica quando o usuário troca o valor
    document.addEventListener("change", e => {
        if (e.target.classList.contains("status-select")) {
            aplicarCorStatusSelect();
        }
    });

    const justificativaModal = new bootstrap.Modal(document.getElementById("modalJustificativa"));
    const modalExcluir = new bootstrap.Modal(document.getElementById("modalExcluir"));
    let solicitacaoSelecionada = null;
    let idParaExcluir = null;

    // Configura os botões salvar - busca dentro da página específica
    function setupSaveButtons() {
        const pageContainer = document.querySelector('.page-gerenciar-solicitacoes');
        if (!pageContainer) return; // Se não encontrar a página, sai
        
        pageContainer.querySelectorAll(".salvar-btn").forEach(btn => {
            // Remove event listener antigo e adiciona novo
            const newBtn = btn.cloneNode(true);
            btn.parentNode.replaceChild(newBtn, btn);
            
            newBtn.addEventListener("click", function() {
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
    }

    // Inicial configura
    setupSaveButtons();

    document.getElementById("confirmarRecusa")?.addEventListener("click", () => {
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

    // =========================
    //     EXCLUSÃO
    // =========================

    // Detecta clique no botão excluir (delegation)
    document.addEventListener("click", e => {
        const btn = e.target.closest(".excluir-btn");
        if (btn) {
            const tr = btn.closest("tr");
            idParaExcluir = tr ? tr.dataset.id : null;
            modalExcluir.show();
        }
    });

// Confirma exclusão — versão que recarrega a página automaticamente
document.getElementById("confirmarExclusao").addEventListener("click", () => {
    if (!idParaExcluir) {
        alert("ID inválido.");
        modalExcluir.hide();
        return;
    }

    fetch("../../admin/scripts/excluir_solicitacao.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ id: idParaExcluir })
    })
    .then(response => {
        if (!response.ok) throw new Error("Erro: " + response.status);
        return response.json();
    })
    .then(res => {
        alert(res.message);

        if (res.success) {
            // Atualiza a página inteira automaticamente:
            location.reload();
        }
    })
    .catch(err => {
        alert("Erro ao excluir: " + err.message);
    })
    .finally(() => {
        modalExcluir.hide();
        idParaExcluir = null;
    });
});


    // Adaptação mobile APENAS para esta página
    function adaptTableForMobile() {
        const pageContainer = document.querySelector('.page-gerenciar-solicitacoes');
        if (!pageContainer) return; // Se não encontrar a página, sai
        
        if (window.innerWidth <= 768) {
            const tableRows = pageContainer.querySelectorAll('tbody tr');
            const headers = pageContainer.querySelectorAll('thead th');
            
            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                
                cells.forEach((cell, index) => {
                    if (headers[index]) {
                        cell.setAttribute('data-label', headers[index].textContent.trim());
                    }
                    
                    // Apenas para a célula do usuário (segunda coluna)
                    if (index === 2 && !cell.classList.contains('mobile-adapted')) {
                        const usuarioText = cell.textContent.trim();
                        const originalId = row.dataset.id;
                        
                        cell.classList.add('mobile-adapted');
                        cell.innerHTML = `
                            <div class="nome-usuario">${usuarioText}</div>
                            <div class="info-adicional">Solicitação #${originalId}</div>
                        `;
                    }
                });
            });
        } else {
            // Restaura para desktop
            const tableRows = pageContainer.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                cells.forEach((cell, index) => {
                    cell.removeAttribute('data-label');
                    
                    if (index === 2 && cell.classList.contains('mobile-adapted')) {
                        const nomeUsuario = cell.querySelector('.nome-usuario');
                        if (nomeUsuario) {
                            cell.textContent = nomeUsuario.textContent;
                        }
                        cell.classList.remove('mobile-adapted');
                    }
                });
            });
        }
        
        // Re-configura os botões após modificar o DOM
        setTimeout(setupSaveButtons, 100);
    }
    
    // Executa na carga inicial
    adaptTableForMobile();
    
    // Executa no redimensionamento da tela
    window.addEventListener('resize', adaptTableForMobile);
});
</script>

<?php
include SIDEBAR;
include USERBAR;
include FOOTER_TEMPLATE;
?>
