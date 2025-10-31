<?php
    include("../../config.php");
    include HEADER_TEMPLATE;
    include "../../inc/Banco.php";
    include_once UTEIS;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    try {
        $bd=new Banco;
        $usuarioId = $_SESSION['id'];

        $my_solicitacoes = $bd->select(
            'solicitacoes s 
            LEFT JOIN visitas_agendadas v ON s.id = v.solicitacao_id',
            's.*, v.data_visita, v.hora_visita',
            ['s.usuario_id' => $usuarioId],
            true,
            0,
            'fetch_all_assoc'
        );

    } catch (Exception $e) {
        $_SESSION['message']=getMessage($e);
        $_SESSION['type']="danger";
    }
?>
<?php if (!empty($_SESSION['message'])) : ?>
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>
<div class="minhas-solicitacoes-page">
    <h2 class="mb-2">Minhas Solicitações</h2>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <div class="flex-grow-1 me-3">
    
            <!-- Campo de pesquisa alinhado abaixo do título -->
            <div class="input-group w-75">
                <span class="input-group-text bg-dark text-white">
                    <i class="fa fa-search"></i>
                </span>
                <input type="text" id="pesquisar" class="form-control" placeholder="Pesquisar por ID, CEP ou Data...">
            </div>
        </div>
    
        <div class="d-flex gap-2 mt-3 mt-md-0">
            <!-- Botão de filtro -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filtroDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-filter"></i> Filtro
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="filtroDropdown">
                    <li><a class="dropdown-item active" href="<?php echo RAIZ_PROJETO;?>usuarios/views/gerenciar_solicitacoes.php">Pendentes</a></li>
                    <li><a class="dropdown-item" href="<?php echo RAIZ_PROJETO;?>usuarios/views/solicitacoes_marcadas.php">Marcados</a></li>
                    <li><a class="dropdown-item " href="#">Recusadas</a></li>
                </ul>
            </div>
    
            <!-- Botão de recarregar -->
            <button onclick="location.reload()" class="btn btn-outline-primary">
                <i class="fa fa-refresh"></i> Recarregar
            </button>
    
            <!-- Nova Solicitação -->
            <a href="<?php echo RAIZ_PROJETO; ?>usuarios/views/solicitar_visita.php" class="btn btn-outline-primary">
                <i class="fa fa-plus"></i> Nova Solicitação
            </a>
        </div>
    </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <?php if (!empty($my_solicitacoes)): ?>
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>ID da Solicitação</th>
                                <th>CEP</th>
                                <th>Status</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Contato do Adm</th>
                                <th>Ver Mais</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($my_solicitacoes as $mys): ?>
                                <tr>
                                    <td class="text-center"><?= htmlspecialchars($mys['id']); ?></td>
                                    <td><?= htmlspecialchars($mys['cep']); ?></td>
                                    <td><?= htmlspecialchars($mys['status']); ?></td>
                                    <?php if($mys['status']!=="pendente" && $mys['status']!=="recusado"):?>
                                        <td><?= !empty($mys['data_visita']) ? htmlspecialchars(date('d/m/Y', strtotime($mys['data_visita']))) : '--/--/----'; ?></td>
                                        <td><?= !empty($mys['hora_visita']) ? htmlspecialchars($mys['hora_visita']) : '--:--'; ?></td>
                                    <?php else: ?>
                                        <td>--/--/----</td>
                                        <td>--:--</td>
                                    <?php endif; ?>
                                    <!-- Botão WhatsApp -->
                                    <td class="text-center">
                                        <a href="https://wa.me/5515999999999" target="_blank" class="btn btn-success btn-sm">
                                            <i class="fa-brands fa-whatsapp fa-2x"></i>
                                        </a>
                                    </td>
                                   <td class="text-center">
                                        <?php
                                            $dataFormatada = date('d/m/Y H:i', strtotime($mys['data_solicitacao']));
                                        ?>
                                        <button
                                            class="btn btn-info btn-sm ver-mais-btn"
                                            data-endereco="<?= htmlspecialchars($mys['endereco'], ENT_QUOTES); ?>"
                                            data-complemento="<?= htmlspecialchars($mys['complemento'], ENT_QUOTES); ?>"
                                            data-descricao="<?= htmlspecialchars($mys['descricao'], ENT_QUOTES); ?>"
                                            data-data="<?= $dataFormatada; ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#verMaisModal">
                                            <i class="fa fa-eye"></i> Ver mais
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-warning text-center">Nenhuma solicitação encontrada.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Modal Dark -->
    <div class="modal fade" id="verMaisModal" tabindex="-1" aria-labelledby="verMaisModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light rounded-3 shadow-lg border-0">
          <div class="modal-header border-secondary">
            <h5 class="modal-title" id="verMaisModalLabel">
              <i class="fa fa-info-circle me-2"></i>Detalhes da Solicitação
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <strong>Endereço:</strong>
              <p id="modal-endereco" class="mb-2 text-muted"></p>
            </div>
            <div class="mb-3">
              <strong>Complemento:</strong>
              <p id="modal-complemento" class="mb-2 text-muted"></p>
            </div>
            <div class="mb-3">
              <strong>Descrição:</strong>
              <p id="modal-descricao" class="mb-2 text-muted"></p>
            </div>
            <div class="mb-3">
              <strong>Data da Solicitação:</strong>
              <p id="modal-data" class="mb-2 text-muted"></p>
            </div>
          </div>
          <div class="modal-footer border-secondary">
            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">
              <i class="fa fa-times me-1"></i> Fechar
            </button>
          </div>
        </div>
      </div>
    </div>
</div>


<?php
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>