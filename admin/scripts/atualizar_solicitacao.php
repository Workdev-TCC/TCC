<?php
include("../../config.php");
include "../../inc/Banco.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Método inválido."]);
    exit;
}

$id = $_POST["id"] ?? null;
$status = $_POST["status"] ?? "";
$data = $_POST["data"] ?? null;
$hora = $_POST["hora"] ?? null;
$justificativa = $_POST["justificativa"] ?? null;

if (!$id) {
    echo json_encode(["success" => false, "message" => "ID da solicitação não informado."]);
    exit;
}

try {
    $bd = new Banco();
    $db = $bd->open_db();
    $db->beginTransaction();

    // Atualiza a solicitação
    $sql = "UPDATE solicitacoes 
            SET status = :status, observacao_admin = :obs 
            WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ":status" => $status,
        ":obs" => $justificativa ?: null,
        ":id" => $id
    ]);

    // 🔧 Gerenciar a tabela visitas_agendadas
    if ($status === "marcado") {
        // Verifica se já existe visita para esta solicitação
        $check = $db->prepare("SELECT id FROM visitas_agendadas WHERE solicitacao_id = :id");
        $check->execute([":id" => $id]);
        $visita = $check->fetch(PDO::FETCH_ASSOC);

        if ($visita) {
            // Atualiza data/hora da visita existente
            $upd = $db->prepare("UPDATE visitas_agendadas 
                                 SET data_visita = :data, hora_visita = :hora 
                                 WHERE solicitacao_id = :id");
            $upd->execute([
                ":data" => $data,
                ":hora" => $hora,
                ":id" => $id
            ]);
        } else {
            // Cria uma nova visita
            $ins = $db->prepare("INSERT INTO visitas_agendadas (solicitacao_id, data_visita, hora_visita) 
                                 VALUES (:id, :data, :hora)");
            $ins->execute([
                ":id" => $id,
                ":data" => $data,
                ":hora" => $hora
            ]);
        }
    } else {
        // Se mudou para pendente ou recusado → remove a visita agendada
        $del = $db->prepare("DELETE FROM visitas_agendadas WHERE solicitacao_id = :id");
        $del->execute([":id" => $id]);
    }

    $db->commit();

    echo json_encode(["success" => true, "message" => "Solicitação atualizada com sucesso."]);

} catch (Exception $e) {
    if (isset($db)) $db->rollBack();
    echo json_encode(["success" => false, "message" => "Erro ao atualizar: " . $e->getMessage()]);
}
