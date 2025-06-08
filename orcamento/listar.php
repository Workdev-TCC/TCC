<?php      
include('../config.php');
include DBAPI;
include HEADER_TEMPLATE;
?>
<?php 
$msg = '';
$type = '';

if (!empty($_GET['msg']) && !empty($_GET['type'])) {
    $msg = $_GET['msg'];
    $type = $_GET['type'];
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
      $_SESSION['message'] = $msg;
      $_SESSION['type'] = $type;
}
?>
<div class="container-fluid responsive-table-container">
    <h2 class="title">Lista de Orçamentos</h2>
    <?php 
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php clear_messages(); ?>
    <?php endif; ?>

    <?php $dados = listar_ordem("orcamentos", "data_orcamento", "DESC"); ?>

    <?php if (count($dados) === 0): ?>
    <p class="no-data-msg">Nenhum orçamento encontrado.</p>
    <?php else: ?>
    <div class="table-wrapper">
        <table class="table table-striped table-bordered table-sm">
            <thead class="table-head">
                <tr>
                    <th class="col-id">ID</th>
                    <th class="col-area">Área</th>
                    <th class="col-demao">Demãos</th>
                    <th class="col-rendimento">Rendimento</th>
                    <th class="col-preco-tinta">Preço Tinta</th>
                    <th class="col-mao-obra">Mão de Obra</th>
                    <th class="col-extras">Extras</th>
                    <th class="col-litros">Litros</th>
                    <th class="col-material">Material</th>
                    <th class="col-lucro">Lucro</th>
                    <th class="col-total-sem-lucro">Total sem lucro</th>
                    <th class="col-total-final">Total final</th>
                    <th class="col-data">Data</th>
                </tr>
            </thead>
            <tbody class="table-body">
                <?php foreach ($dados as $data): ?>
                <tr>
                    <td class="col-id"><?= $data['id'] ?></td>
                    <td class="col-area"><?= $data['area'] ?> m²</td>
                    <td class="col-demao"><?= $data['demao'] ?></td>
                    <td class="col-rendimento"><?= $data['rendimento'] ?> m²/L</td>
                    <td class="col-preco-tinta">R$ <?= $data['preco_tinta'] ?></td>
                    <td class="col-mao-obra">R$ <?= $data['mao_obra'] ?></td>
                    <td class="col-extras">R$ <?= $data['extras'] ?></td>
                    <td class="col-litros"><?= $data['litros_necessarios'] ?> L</td>
                    <td class="col-material">R$ <?= $data['gasto_material'] ?></td>
                    <td class="col-lucro">R$ <?= $data['lucro_aplicado'] ?></td>
                    <td class="col-total-sem-lucro">R$ <?= $data['valor_sem_lucro'] ?></td>
                    <td class="col-total-final"><strong>R$ <?= $data['valor_final'] ?></strong></td>
                    <td class="col-data"><?= $data['data_orcamento'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php  include FOOTER_TEMPLATE; ?>