<?php
include "../config.php";
include "../inc/Banco.php";
include UTEIS;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {

        $id_usuario  = $_SESSION['id'] ?? null;

        // Endereço
        $cep         = trim($_POST['cep'] ?? '');
        $cidade      = trim($_POST['cidade'] ?? '');
        $bairro      = trim($_POST['bairro'] ?? '');
        $rua         = trim($_POST['rua'] ?? '');
        $numero      = trim($_POST['numero'] ?? '');
        $complemento = trim($_POST['complemento'] ?? '');
        $descricao   = trim($_POST['descricao'] ?? '');

        // Serviços selecionados
        $servicos_selecionados = $_POST['tipo_servico'] ?? [];
        $servicos_selecionados = array_unique(array_filter($servicos_selecionados));

        if (empty($servicos_selecionados)) {
            throw new Exception("Selecione pelo menos um tipo de serviço.");
        }

        $servicos_json = json_encode($servicos_selecionados, JSON_UNESCAPED_UNICODE);

        // Validação do endereço
        if (empty($cep) || empty($cidade) || empty($bairro) || empty($rua) || empty($numero)) {
            throw new Exception("O endereço não foi carregado corretamente. Digite o CEP e aguarde o preenchimento automático.");
        }

        // Monta o endereço final
        $endereco = "$cidade, $bairro, $rua, Nº $numero";
        if (!empty($complemento)) {
            $endereco .= " - $complemento";
        }

        // Salvar no BD
        $bd = new Banco();
        $array = [
            "usuario_id"        => $id_usuario,
            "tipo_servico"      => $servicos_json,
            "descricao"         => $descricao,
            "cep"               => $cep,
            "endereco"          => $endereco,
            "complemento"       => $complemento,
            "status"            => "pendente",
            "data_solicitacao"  => date('Y-m-d H:i:s')
        ];

        $bd->save("solicitacoes", $array);

        $_SESSION['message'] = "Solicitação enviada com sucesso!";
        $_SESSION['type'] = "success";

        header("Location: " . RAIZ_PROJETO . "usuarios/views/gerenciar_solicitacoes.php");
        exit();

    } else {
        throw new Exception("Método inválido ou dados não enviados.");
    }

} catch (Exception $e) {

    $_SESSION['message'] = "Erro: " . $e->getMessage();
    $_SESSION['type'] = "danger";


    header("Location: " . RAIZ_PROJETO . "usuarios/views/solicitar_visita.php");
    exit();
}

?>
