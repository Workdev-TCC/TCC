<?php
include("../../config.php");
include HEADER_TEMPLATE;
include DBAPI;
include "../../inc/Banco.php";
include_once UTEIS;

$bd = new Banco;

// Processa ações enviadas via modal
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id_solicitacao"];
    $acao = $_POST["acao"];

    if ($acao === "rejeitar") {
        $observacao = $_POST["observacao_adm"];
        $bd->update("solicitacoes", [
            "status" => "rejeitado",
            "observacao_adm" => $observacao
        ], ["id" => $id]);
    }

    if ($acao === "agendar") {
        $data = $_POST["data_visita"];
        $hora = $_POST["hora_visita"];
        $obs = $_POST["observacoes"];

        // Cria visita
        $bd->insert("visitas_agendadas", [
            "solicitacao_id" => $id,
            "data_visita" => $data,
            "hora_visita" => $hora,
            "observacoes" => $obs
        ]);

        // Atualiza status
        $bd->update("solicitacoes", ["status" => "marcado"], ["id" => $id]);
    }

    // header("Location: listar_solicitacoes_pendentes.php");
    // exit;
}

$solicitacoes = $bd->select(
    "solicitacoes s INNER JOIN usuarios u ON s.usuario_id = u.id",
    [
        "s.id AS id_solicitacao",
        "u.nome AS nome_usuario",
        "u.telefone",
        "s.data_solicitacao",
        "s.cidade",
        "s.bairro",
        "s.rua",
        "s.numero",
        "s.status"
    ],
    ["s.status" => "pendente"],
    true,
    0,
    "fetch_all_assoc"
);
?>

<div class="container mt-5">
    <div class="d-flex justify-content-center gap-3 mb-4">
        <a href="listar_solicitacoes_pendentes.php" class="btn btn-primary active">Pendentes</a>
        <a href="listar_solicitacoes_agendadas.php" class="btn btn-outline-success">Agendadas</a>
        <a href="listar_solicitacoes_rejeitadas.php" class="btn btn-outline-danger">Rejeitadas</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3 text-center">Solicitações Pendentes</h4>

            <?php if (!empty($solicitacoes)): ?>
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Data</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($solicitacoes as $s): 
                        $endereco = "{$s['cidade']}, {$s['bairro']}, {$s['rua']}, {$s['numero']}";
                    ?>
                    <tr>
                        <td><?= $s['id_solicitacao'] ?></td>
                        <td><?= htmlspecialchars($s['nome_usuario']) ?></td>
                        <td><?= htmlspecialchars($endereco) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($s['data_solicitacao'])) ?></td>
                        <td>
                            <button 
                                class="btn btn-danger btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalRejeitar"
                                data-id="<?= $s['id_solicitacao'] ?>"
                                data-nome="<?= htmlspecialchars($s['nome_usuario']) ?>"
                            >
                                <i class="bi bi-x-circle"></i> Rejeitar
                            </button>

                            <button 
                                class="btn btn-primary btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalAgendar"
                                data-id="<?= $s['id_solicitacao'] ?>"
                                data-nome="<?= htmlspecialchars($s['nome_usuario']) ?>"
                            >
                                <i class="bi bi-calendar-check"></i> Agendar
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <div class="alert alert-warning text-center">Nenhuma solicitação pendente.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- 🟥 Modal Rejeitar -->
<div class="modal fade" id="modalRejeitar" tabindex="-1" aria-labelledby="modalRejeitarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <form method="POST">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="modalRejeitarLabel">Rejeitar Solicitação</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_solicitacao" id="idRejeitar">
          <input type="hidden" name="acao" value="rejeitar">
          <p><strong>Solicitação:</strong> <span id="nomeRejeitar"></span></p>
          <div class="mb-3">
            <label class="form-label">Motivo da rejeição</label>
            <textarea class="form-control" name="observacao_adm" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Confirmar Rejeição</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- 🟩 Modal Agendar -->
<div class="modal fade" id="modalAgendar" tabindex="-1" aria-labelledby="modalAgendarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <form method="POST">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalAgendarLabel">Agendar Visita</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_solicitacao" id="idAgendar">
          <input type="hidden" name="acao" value="agendar">
          <p><strong>Solicitação:</strong> <span id="nomeAgendar"></span></p>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Data da visita</label>
              <input type="date" class="form-control" name="data_visita" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Hora</label>
              <input type="time" class="form-control" name="hora_visita" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Observações</label>
            <textarea class="form-control" name="observacoes" rows="3" placeholder="Detalhes adicionais..."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Confirmar Agendamento</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
const modalRejeitar = document.getElementById('modalRejeitar');
modalRejeitar.addEventListener('show.bs.modal', event => {
  const button = event.relatedTarget;
  document.getElementById('idRejeitar').value = button.getAttribute('data-id');
  document.getElementById('nomeRejeitar').textContent = button.getAttribute('data-nome');
});

const modalAgendar = document.getElementById('modalAgendar');
modalAgendar.addEventListener('show.bs.modal', event => {
  const button = event.relatedTarget;
  document.getElementById('idAgendar').value = button.getAttribute('data-id');
  document.getElementById('nomeAgendar').textContent = button.getAttribute('data-nome');
});
</script>

<?php
include SIDEBAR;
include USERBAR;
include FOOTER_TEMPLATE;
?>
