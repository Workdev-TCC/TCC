<?php 

/* 
|--------------------------------------------------------
| uploadImg — Função flexível para upload de imagens
|--------------------------------------------------------
| $file      → $_FILES['algum_arquivo']
| $subpasta  → caminho a partir do ABSOLUTE_PATH
| Exemplo:
| uploadImg($_FILES['imagem'], "assets/img/projetos/");
*/

function uploadImg($file, $subpasta = "usuarios/img/") {
    try {
        if (empty($file['tmp_name']) || $file['error'] === 4) {
            return false;
        }

        // Caminho completo
        $dir = ABSOLUTE_PATH . $subpasta;

        // Cria diretório se não existir
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        // Extensão
        $img_type = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Nome único
        $nome_unico = uniqid("img_", true) . "." . $img_type;
        $target_file = $dir . $nome_unico;

        // Verifica se é imagem
        $check = getimagesize($file["tmp_name"]);
        if (!$check) {
            throw new Exception("O arquivo enviado não é uma imagem.");
        }

        // Limite 50 MB
        if ($file["size"] > 50000000) {
            throw new Exception("Arquivo muito grande (máx 50MB).");
        }

        // Tipos aceitos
        $ext_permitidas = ["jpg", "jpeg", "png"];
        if (!in_array($img_type, $ext_permitidas)) {
            throw new Exception("Só é aceito JPG ou PNG.");
        }

        // Move imagem para o destino final
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            return $nome_unico;
        }

        return false;

    } catch (Exception $e) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['message'] = "Erro no upload: " . $e->getMessage();
        $_SESSION['type'] = "danger";
        return false;
    }
}




/* 
|--------------------------------------------------------
| limparDir — Remove imagens que não existem no banco
|--------------------------------------------------------
| $db → instância da classe Banco
*/

function limparDir($db) {
    try {
        $dir = ABSOLUTE_PATH . "usuarios/img/";

        if (!is_dir($dir)) {
            throw new Exception("Diretório não encontrado: " . $dir);
        }

        // Busca imagens existentes no banco
        $imagens_banco = $db->select("usuarios", "foto", [], true, 0, "fetch_all_col");

        // Evita deletar imagens padrão
        $imagens_validas = array_merge($imagens_banco, ["login.png", "semimagem.jpg"]);

        // Lista arquivos do diretório
        $arquivos = scandir($dir);

        foreach ($arquivos as $arquivo) {
            if ($arquivo === "." || $arquivo === "..") continue;

            $caminho = $dir . $arquivo;

            // Se não está no banco e for arquivo → apaga
            if (is_file($caminho) && !in_array($arquivo, $imagens_validas)) {
                unlink($caminho);
            }
        }

        return true;

    } catch (Exception $e) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['message'] = "Erro ao limpar imagens órfãs: " . $e->getMessage();
        $_SESSION['type'] = 'danger';
        return false;
    }
}




/* 
|--------------------------------------------------------
| criptografia — Criptografa senhas com Blowfish
|--------------------------------------------------------
*/

function criptografia($senha){
    $custo = '08';
    $salt = 'Cf1f11ePArKlBJomM0F6aJ';
    return crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
}

?>
