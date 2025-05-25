<?php 


function excluirfotofolder($pdo,$tabela,$campo){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    try{
        $pastaImagens=RAIZ_PROJETO."usuarios/img";
        $stmt= $pdo->query("SELECT " . $campo . " FROM ". $tabela ." WHERE ". $campo ." IS NOT NULL AND ". $campo ." != ''");
        $fotosBanco = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        $arquivos = scandir($pastaImagens);
        foreach ($arquivos as $arquivo) {
            if ($arquivo !== '.' && $arquivo !== '..') {
                if (!in_array($arquivo, $fotosBanco)) {
                    $caminhoCompleto = $pastaImagens . '/' . $arquivo;
                    if (is_file($caminhoCompleto)) {
                        unlink($caminhoCompleto);
                    }
                }
            }
        }


    }catch (Exception $e) {
        $_SESSION['message'] = "Erro no upload: " . $e->getMessage();
        $_SESSION['type'] = "danger";
        header("Location:".RAIZ_PROJETO);
        exit();
    }

}

// ------------------------------------------------------------------------------------------
function upload2($arquivo, $caminho_pasta) {
    try {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $ok=0;

        if (!isset($arquivo) || $arquivo['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Nenhum arquivo enviado ou erro no envio.");
        }

        $nome_temp = $arquivo['tmp_name'];
        $nome_original = basename($arquivo['name']);
        $tipo_arquivo = strtolower(pathinfo($nome_original, PATHINFO_EXTENSION));
        $tamanho_arquivo = $arquivo['size'];
        

        // Verifica se é imagem
        $check = getimagesize($nome_temp);
        if ($check === false) {
            throw new Exception("O arquivo não é uma imagem.");
        }

        // Verifica extensão
        $permitidos = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($tipo_arquivo, $permitidos)) {
            throw new Exception("São permitidos apenas arquivos: JPG, JPEG, PNG, GIF.");
        }
        if ($tamanho_arquivo > 2 * 1024 * 1024) {
            throw new Exception("O arquivo excede o limite de 2MB.");
        }

        $arquivo_destino = $caminho_pasta."/".$nome_original;

        // Verifica se já existe
        if (file_exists($arquivo_destino)) {
            $ok=2;
            $_SESSION['message'] = "Arquivo: " . htmlspecialchars($nome_original)."ja existe no sistema sera reutilizado " ;
            $_SESSION['type'] = "success";
        }
        if($ok!=2){
            if (move_uploaded_file($nome_temp, $arquivo_destino)) {
                $_SESSION['message'] = "Arquivo enviado com sucesso: " . htmlspecialchars($nome_original);
                $_SESSION['type'] = "success";
                
            } else {
                throw new Exception("Erro ao mover o arquivo para o destino.");
            }
        }
        return true;
        

    } catch (Exception $e) {
        $_SESSION['message'] = "Erro no upload: " . $e->getMessage();
        $_SESSION['type'] = "danger";
        header("Location:../index.php");
        exit();
    }
}



function criptografia($senha){
		$custo = '08';
		$salt = 'Cf1f11ePArKlBJomM0F6aJ';
		$hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
		return $hash;
	}






?>