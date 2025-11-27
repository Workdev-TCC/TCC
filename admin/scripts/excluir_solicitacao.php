    <?php
    header("Content-Type: application/json");
    session_start();

    include "../../config.php";
    include "../../inc/Banco.php";
    include_once "../../inc/uteis.php";   // <--- CORRETO

    if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
        echo json_encode(["success" => false, "message" => "Acesso negado"]);
        exit;
    }

    if (!isset($_POST['id'])) {
        echo json_encode(["success" => false, "message" => "ID inválido"]);
        exit;
    }

    $id = intval($_POST['id']);

    try {
        $bd = new Banco();

        // Exclui visitas vinculadas
        $bd->delete("visitas_agendadas", ["solicitacao_id" => $id]);

        // Exclui solicitação
        $res = $bd->delete("solicitacoes", ["id" => $id]);

        if ($res) {
            echo json_encode(["success" => true, "message" => "Solicitação excluída com sucesso!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao excluir solicitação"]);
        }

    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
