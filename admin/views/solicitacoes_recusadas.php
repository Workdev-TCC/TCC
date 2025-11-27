<?php
include("../../config.php");
include HEADER_TEMPLATE;
include "../../inc/Banco.php";
include_once UTEIS;

// Verifica sessão
if (empty($_SESSION['tipo'])) {
    header("Location:" . RAIZ_PROJETO);
    exit;
}

if ($_SESSION['tipo'] !== 'admin') {
    header("Location: ../../usuarios/views/gerenciar_solicitacoes.php");
    exit;
}

// Buscar solicitações recusadas
try {
    $bd = new Banco();
    $solicitacoes = $bd->select(
        'solicitacoes s 
         LEFT JOIN usuarios u ON s.usuario_id = u.id 
         LEFT JOIN visitas_agendadas v ON s.id = v.solicitacao_id',
        's.id, s.usuario_id, s.descricao, s.cep, s.endereco, s.complemento, 
         s.status, s.observacao_admin, s.data_solicitacao,
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

<div class="gerenciar-recusadas">
<div class="container mt-5">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div class="d-flex flex-column flex-sm-row align-items-center gap-2 w-100 w-md-auto justify-content-center justify-content-md-end">

            <!-- Paginação -->
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

            <!-- Recarregar -->
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
                                <th>Mensagem do Admin</th>
                                <th>Data Solicitação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($solicitacoes as $s): ?>
                            <tr data-id="<?= $s['id'] ?>" id="linha-<?= $s['id'] ?>">
                                <td><?= $s['id'] ?></td>
                                <td><?= htmlspecialchars($s['nome_usuario']) ?></td>
                                <td><?= htmlspecialchars($s['cep']) ?></td>
                                <td><span class="badge bg-danger">Recusado</span></td>
                                <td><?= htmlspecialchars($s['observacao_admin'] ?? '—') ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($s['data_solicitacao'])) ?></td>

                                <td>
                                 <button class="btn btn-danger btn-sm excluir-btn" data-id="<?= $s['id'] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>

                    </table>

                <?php else: ?>
                    <div class="alert alert-warning text-center">
                        Nenhuma solicitação recusada encontrada.
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

</div>
</div>
   
<div class="modal fade" id="modalExcluir" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Excluir Solicitação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        Tem certeza que deseja excluir esta solicitação?
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-danger" id="btnConfirmarExcluir">Excluir</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  // Elementos
  const modalEl = document.getElementById("modalExcluir");
  const confirmarBtn = document.getElementById("btnConfirmarExcluir");
  if (!modalEl) {
    console.error("Modal não encontrado: elemento #modalExcluir ausente.");
    return;
  }
  if (!confirmarBtn) {
    console.error("Botão de confirmar exclusão não encontrado: #btnConfirmarExcluir ausente.");
    return;
  }

  let idParaExcluir = null;
  let modalInstance = null;
  let fallbackBackdrop = null;

  // Fallbacks para abrir/fechar modal se bootstrap não estiver presente
  const hasBootstrap = (typeof bootstrap !== "undefined" && typeof bootstrap.Modal === "function");

  const showFallbackModal = () => {
    modalEl.classList.add("show");
    modalEl.style.display = "block";
    document.body.classList.add("modal-open");

    // criar backdrop
    fallbackBackdrop = document.createElement("div");
    fallbackBackdrop.className = "modal-backdrop fade show";
    document.body.appendChild(fallbackBackdrop);
  };

  const hideFallbackModal = () => {
    modalEl.classList.remove("show");
    modalEl.style.display = "none";
    document.body.classList.remove("modal-open");
    if (fallbackBackdrop && fallbackBackdrop.parentNode) {
      fallbackBackdrop.parentNode.removeChild(fallbackBackdrop);
      fallbackBackdrop = null;
    }
  };

  if (hasBootstrap) {
    try {
      modalInstance = new bootstrap.Modal(modalEl, { keyboard: true });
    } catch (err) {
      console.error("Erro ao instanciar bootstrap.Modal:", err);
    }
  } else {
    console.warn("Bootstrap Modal não encontrado — usando fallback simples. Recomendo incluir bootstrap.bundle.min.js antes deste script.");
  }

  // Delegação de clique para botões .excluir-btn
  document.addEventListener("click", (e) => {
    const btn = e.target.closest(".excluir-btn");
    if (!btn) return;

    idParaExcluir = btn.dataset.id;
    if (!idParaExcluir) {
      console.warn("Botão .excluir-btn sem data-id.");
      return;
    }

    // Mostrar modal usando bootstrap se disponível ou fallback
    if (modalInstance && typeof modalInstance.show === "function") {
      modalInstance.show();
    } else {
      showFallbackModal();
    }
  });

  // Confirmar exclusão
  confirmarBtn.addEventListener("click", () => {
    if (!idParaExcluir) {
      alert("ID inválido para exclusão.");
      return;
    }

    confirmarBtn.disabled = true;
    confirmarBtn.innerText = "Excluindo...";

    fetch("../../admin/scripts/excluir_solicitacao.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id=" + encodeURIComponent(idParaExcluir)
    })
    .then(r => r.json())
    .then(res => {
      confirmarBtn.disabled = false;
      confirmarBtn.innerText = "Excluir";

      alert(res.message || "Resposta sem mensagem do servidor.");

      if (res.success) {
        const linha = document.getElementById("linha-" + idParaExcluir);
        if (linha) {
          // efeito visual simples antes de remover
          linha.style.transition = "opacity 300ms ease, height 300ms ease, padding 300ms ease";
          linha.style.opacity = "0";
          setTimeout(() => linha.remove(), 320);
        }
      }

      // fechar modal
      if (modalInstance && typeof modalInstance.hide === "function") {
        modalInstance.hide();
      } else {
        hideFallbackModal();
      }

      idParaExcluir = null;
    })
    .catch(err => {
      confirmarBtn.disabled = false;
      confirmarBtn.innerText = "Excluir";
      console.error("Erro na requisição:", err);
      alert("Erro ao excluir (ver console).");
    });
  });

  // Se quiser fechar o fallback clicando no backdrop
  document.addEventListener("click", (e) => {
    if (!hasBootstrap && fallbackBackdrop && e.target === fallbackBackdrop) {
      hideFallbackModal();
    }
  });

  // Log simples pra debug
  console.info("Script de exclusão inicializado. Bootstrap presente:", hasBootstrap);
});
</script>



<?php
include SIDEBAR;
include USERBAR;
include FOOTER_TEMPLATE;
?>
