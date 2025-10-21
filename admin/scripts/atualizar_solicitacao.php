<?php
include("../../inc/Banco.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bd = new Banco();
    $id = $_POST['id'];
    $status = $_POST['status'];
    $data = $_POST['data'] ?? null;
    $hora = $_POST['hora'] ?? null;
    $justificativa = $_POST['justificativa'] ?? null;

    try {
        if ($status === 'marcado') {
            // Atualiza solicitação
            $bd->update('solicitacoes', ['status' => 'marcado'], ['id' => $id]);

            // Cria ou atualiza visita agendada
            $visita = $bd->select('visitas_agendadas', '*', ['solicitacao_id' => $id], false, 1, 'fetch_assoc');
            if ($visita) {
                $bd->update('visitas_agendadas', [
                    'data_visita' => $data,
                    'hora_visita' => $hora
                ], ['solicitacao_id' => $id]);
            } else {
                $bd->save('visitas_agendadas', [
                    'solicitacao_id' => $id,
                    'data_visita' => $data,
                    'hora_visita' => $hora
                ]);
            }

            echo json_encode(['success' => true, 'message' => 'Visita marcada com sucesso!']);
        }
        elseif ($status === 'recusado') {
            $bd->update('solicitacoes', [
                'status' => 'recusado',
                'observacao_admin' => $justificativa
            ], ['id' => $id]);

            echo json_encode(['success' => true, 'message' => 'Solicitação recusada com justificativa.']);
        }
        else {
            $bd->update('solicitacoes', ['status' => 'pendente'], ['id' => $id]);
            echo json_encode(['success' => true, 'message' => 'Status alterado para pendente.']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erro: ' . $e->getMessage()]);
    }
}
?>
