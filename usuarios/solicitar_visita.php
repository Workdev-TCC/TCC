
<?php
include "../config.php";
include "../inc/Banco.php";
include UTEIS;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        $id_usuario = $_SESSION['id'];
        $descricao = $_POST['descricao'];
        $cep = $_POST['cep'] ?? ''; // agora opcional
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];
        $complemento = $_POST['complemento'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $tipo_servico_array = $_POST['tipo_servico'] ?? [];
        $tipo_servico = implode(", ", $tipo_servico_array); // une todos em uma string separada por vírgulas


        $endereco = $cidade . ", " . $bairro . ", " . $rua . ", " . $numero . "º.";
        $status = "pendente";

        // agora o cep não é mais obrigatório
        if (!empty($cidade) && !empty($bairro) && !empty($rua) && !empty($numero) && !empty($tipo_servico)) {
            $bd = new Banco;
            $array = [
                "usuario_id" => $id_usuario,
                "descricao" => $descricao,
                "cep" => $cep, // pode ficar vazio
                "endereco" => $endereco,
                "complemento" => $complemento,
                "tipo_servico" => $tipo_servico, // novo campo salvo
                "status" => $status
            ];

            $bd->save("solicitacoes", $array);
            header("Location: " . RAIZ_PROJETO);
            exit();
        }
    }
} catch (Exception $e) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
    $_SESSION['type'] = 'danger';
    header("Location: " . RAIZ_PROJETO);
    exit();
}
?>
