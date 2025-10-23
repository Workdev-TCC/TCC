<?php
require_once("../config.php");
require_once("../inc/Banco.php");
if(empty($_SESSION['tipo'])){
    header("Location:".RAIZ_PROJETO);
    exit;
}
try{
    $bd = new Banco();

    $id = $_POST['id'] ?? null;
    $data = $_POST['data_visita'] ?? null;
    $hora = $_POST['hora_visita'] ?? null;
    $status = $_POST['status'] ?? null;

    if (!$id || !$data || !$hora || !$status) {
        die("Erro: Dados incompletos.");
    }

    // Atualiza o status na tabela solicitacoes
    $bd->update("solicitacoes", ["status" => $status], ["id" => $id]);

    // Verifica se já existe visita agendada para essa solicitação
    $visita = $bd->select("visitas_agendadas", "*", ["solicitacao_id" => $id], false, 1, "fetch_assoc");

    if ($visita) {
        // Atualiza a visita
        $bd->update("visitas_agendadas", [
            "data_visita" => $data,
            "hora_visita" => $hora
        ], ["solicitacao_id" => $id]);
    } else {
        // Cria nova visita
        $bd->save("visitas_agendadas", [
            "solicitacao_id" => $id,
            "data_visita" => $data,
            "hora_visita" => $hora,
            "observacoes" => "Gerado automaticamente pelo sistema"
        ]);
    }
}catch(Exception $e){
     if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
    $_SESSION['type'] = 'danger';
    header("Location: " . RAIZ_PROJETO);
    exit();
}

