<?php
    include "../../config.php";
    include "../../inc/Banco.php";
    include HEADER_TEMPLATE;
    if(empty($_SESSION['tipo'])){
    header("Location:".RAIZ_PROJETO);
    exit;
}
?>


<div class="container table-container">
    <h2 class="text-center mb-4">Solicitações Pendentes</h2>
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
    <div class="card shadow-sm">
        <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table table-bordered table-striped align-middle text-center mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID da Solicitação</th>
                        <th>CEP</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Contato</th>
                        <th>Ver Mais</th>
                        <th>Salvar</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if (!empty($solicitacoes)): ?>
                        <?php foreach ($solicitacoes as $s): ?>
                            <tr id="row<?= $s['id_solicitacao'] ?>">
                                <td><?= $s['id_solicitacao'] ?></td>
                                <td><?= htmlspecialchars($s['cep']) ?></td>
                                <td>
                                    <button class="btn btn-outline-secondary btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#statusModal<?= $s['id_solicitacao'] ?>">
                                        <?= ucfirst($s['status']) ?>
                                    </button>
                                </td>
                                <td>
                                    <input type="date" class="form-control form-control-sm text-center" id="data<?= $s['id_solicitacao'] ?>">
                                </td>
                                <td>
                                    <input type="time" class="form-control form-control-sm text-center" id="hora<?= $s['id_solicitacao'] ?>">
                                </td>
                                <td>
                                    <a href="https://wa.me/55<?= preg_replace('/\D/', '', $s['telefone']) ?>" 
                                       target="_blank" class="btn btn-whatsapp btn-sm">
                                        WhatsApp
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm text-white" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#verMaisModal<?= $s['id_solicitacao'] ?>">Ver</button>
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm salvar" 
                                            data-id="<?= $s['id_solicitacao'] ?>">Salvar</button>
                                </td>
                            </tr>

                            <!-- Modal Status -->
                            <div class="modal fade" id="statusModal<?= $s['id_solicitacao'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title">Alterar Status</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p>Escolha uma ação para a solicitação <strong>#<?= $s['id_solicitacao'] ?></strong></p>
                                            <button class="btn btn-success m-2 status-btn" 
                                                    data-id="<?= $s['id_solicitacao'] ?>" 
                                                    data-status="marcado">Aceitar</button>
                                            <button class="btn btn-danger m-2 status-btn" 
                                                    data-id="<?= $s['id_solicitacao'] ?>" 
                                                    data-status="recusado">Recusar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Ver Mais -->
                            <div class="modal fade" id="verMaisModal<?= $s['id_solicitacao'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title">Detalhes da Solicitação</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Cliente:</strong> <?= htmlspecialchars($s['nome']) ?></p>
                                            <p><strong>Telefone:</strong> <?= htmlspecialchars($s['telefone']) ?></p>
                                            <p><strong>CEP:</strong> <?= htmlspecialchars($s['cep']) ?></p>
                                            <p><strong>Descrição:</strong><br><?= nl2br(htmlspecialchars($s['descricao'])) ?></p>
                                            <p><strong>Status:</strong> <?= ucfirst($s['status']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8" class="text-muted">Nenhuma solicitação pendente encontrada.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de aviso -->
<div class="modal fade" id="avisoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-body">
                <p class="fs-5">⚠️ Por favor, aperte em <strong>Salvar</strong> para confirmar as alterações.</p>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok, entendi</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    // Ao clicar em mudar o status (Aceitar/Recusar)
    $(".status-btn").click(function(){
        const id = $(this).data("id");
        const status = $(this).data("status");

        $(`#statusModal${id}`).modal('hide');
        $(`#row${id} td:nth-child(3) button`).text(status.charAt(0).toUpperCase() + status.slice(1));

        // Mostra aviso para salvar
        const aviso = new bootstrap.Modal(document.getElementById('avisoModal'));
        aviso.show();

        // Armazena novo status no elemento
        $(`#row${id}`).attr("data-status", status);
    });

    // Botão salvar (envia para PHP)
    $(".salvar").click(function(){
        const id = $(this).data("id");
        const data = $(`#data${id}`).val();
        const hora = $(`#hora${id}`).val();
        const status = $(`#row${id}`).attr("data-status") || "pendente";

        if(!data || !hora){
            alert("Preencha data e hora antes de salvar!");
            return;
        }

        $.post("../salvar_pedido.php", {
            id: id,
            data_visita: data,
            hora_visita: hora,
            status: status
        }, function(resp){
            alert(resp);
            location.reload();
        });
    });
});
</script>

</body>
</html>
