<?php
include "../config.php";
include "../inc/Banco.php";
include UTEIS;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        
        $id_usuario   = $_SESSION['id'] ?? null;
        
        // Campos do endereço
        $cep          = $_POST['cep'] ?? '';
        $cidade       = $_POST['cidade'] ?? '';
        $bairro       = $_POST['bairro'] ?? '';
        $rua          = $_POST['rua'] ?? '';
        $numero       = $_POST['numero'] ?? '';
        $complemento  = $_POST['complemento'] ?? '';
        $descricao    = $_POST['descricao'] ?? '';

        // AQUI ESTÁ O NOVO: pega o array de serviços
        $servicos_selecionados = $_POST['tipo_servico'] ?? [];
        
        // Remove valores vazios e duplicados
        $servicos_selecionados = array_unique(array_filter($servicos_selecionados));

        // Se não selecionou nenhum serviço
        if (empty($servicos_selecionados)) {
            throw new Exception("Selecione pelo menos um tipo de serviço.");
        }

        // Converte o array em JSON para salvar no banco
        $servicos_json = json_encode($servicos_selecionados, JSON_UNESCAPED_UNICODE);

        // Monta o endereço
        $endereco = trim("$cidade, $bairro, $rua, $numero");
        if (!empty($complemento)) {
            $endereco .= " - $complemento";
        }

        // Validação básica dos campos obrigatórios
        if (empty($cidade) || empty($bairro) || empty($rua) || empty($numero)) {
            throw new Exception("Preencha todos os campos do endereço.");
        }

        $bd = new Banco();

        $array = [
            "usuario_id"    => $id_usuario,
            "tipo_servico"  => $servicos_json,        // ← Agora salva como JSON
            "descricao"     => $descricao,
            "cep"           => $cep,
            "endereco"      => $endereco,
            "complemento"   => $complemento,
            "status"        => "pendente",
            "data_solicitacao" => date('Y-m-d H:i:s')
        ];

        $bd->save("solicitacoes", $array);

        $_SESSION['message'] = "Solicitação enviada com sucesso!";
        $_SESSION['type'] = "success";
        
    } else {
        throw new Exception("Método inválido ou dados não enviados.");
    }

} catch (Exception $e) {
    $_SESSION['message'] = "Erro: " . $e->getMessage();
    $_SESSION['type'] = 'danger';
}

header("Location: " . RAIZ_PROJETO . "usuarios/views/solicitar_visita.php");
exit();
?>