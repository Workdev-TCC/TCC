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
        'solicitacoes s LEFT JOIN usuarios u ON s.usuario_id = u.id LEFT JOIN visitas_agendadas v ON s.id = v.solicitacao_id',
        's.id, s.usuario_id, s.descricao, s.cep, s.endereco, s.complemento, s.status, s.observacao_admin, s.data_solicitacao,
         u.nome AS nome_usuario, u.email, u.telefone,
         v.data_visita, v.hora_visita',
        ['s.status' => 'pendente'],
        true,
        0,
        'fetch_all_assoc'
    );
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['type'] = 'danger';
}
?>
<div class="gerenciar-pendentes">
    
    <div class="container-fluid mt-4 px-3">
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
    
        <div class="card shadow-sm">
            <div class="card-body p-2 p-md-3">
                <?php if (!empty($solicitacoes)): ?>
                    <div class="table-responsive">
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
                                                <option value="marcado">Marcado</option>
                                                <option value="recusado">Recusado</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" class="form-control form-control-sm data-visita" value="<?= $s['data_visita'] ?? '' ?>">
                                        </td>
                                        <td>
                                            <input type="time" class="form-control form-control-sm hora-visita" value="<?= $s['hora_visita'] ?? '' ?>">
                                        </td>
                                        <td class="text-center">
                                            <a href="https://wa.me/5515996298363?text=Olá! Vim do site ZuPinturas e gostaria de solicitar um orçamento!" target="_blank" class="btn btn-success btn-contato">
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
                    <div class="alert alert-warning text-center mb-0">Nenhuma solicitação pendente encontrada.</div>
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

const modalExcluir = new bootstrap.Modal(document.getElementById("modalExcluir"));
let idParaExcluir = null;

// Detecta clique no botão excluir (delegation)
document.addEventListener("click", e => {
    const btn = e.target.closest(".excluir-btn");
    if (btn) {
        const tr = btn.closest("tr");
        idParaExcluir = tr ? tr.dataset.id : null;
        modalExcluir.show();
    }
});

// Confirma exclusão — recarrega a página automaticamente
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
  const pageContainer = document.querySelector('.gerenciar-pendentes');
  if (!pageContainer) return; // Se não encontrar a página, sai

  if (window.innerWidth <= 768) {
    const tableRows = pageContainer.querySelectorAll('tbody tr');
    const headers = pageContainer.querySelectorAll('thead th');
    
    tableRows.forEach(row => {
      const cells = row.querySelectorAll('td');
      
      // Remove botão excluir mobile existente se houver
      const existingExcluirMobile = row.querySelector('.btn-excluir-mobile');
      if (existingExcluirMobile) {
        existingExcluirMobile.remove();
      }
      
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
      
      // Adiciona o botão excluir no final do card
      const excluirBtn = cells[0].querySelector('.excluir-btn');
      if (excluirBtn) {
        const excluirContainer = document.createElement('div');
        excluirContainer.className = 'btn-excluir-mobile';
        excluirContainer.innerHTML = excluirBtn.outerHTML;
        row.appendChild(excluirContainer);
      }
    });
  } else {
    // Restaura para desktop
    const tableRows = pageContainer.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
      const cells = row.querySelectorAll('td');
      
      // Remove botão excluir mobile se existir
      const excluirMobile = row.querySelector('.btn-excluir-mobile');
      if (excluirMobile) {
        excluirMobile.remove();
      }
      
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
    window.addEventListener('resize', adaptTableForMobile)
});
</script>


<?php
include SIDEBAR;
include USERBAR;
include FOOTER_TEMPLATE;
?>
