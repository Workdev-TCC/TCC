<!-- todas funções de utilidades, mascaras e etc devem estar aqui -->
<?php 
    function uploadImg($file){
        try {
            if (empty($file['tmp_name']) || $file['error'] === 4) {
                return false;
            }
            $dir= ABSOLUTE_PATH."usuarios/img/";
            $img_type = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
            $nome_unico = uniqid("img_", true) . "." . $img_type;
            $target_file = $dir . $nome_unico;
            

            $check = getimagesize($file["tmp_name"]);
            if (!$check) {
                throw new Exception("Não é uma imagem");
            }

            if ($file["size"] > 50000000) {
                throw new Exception("Arquivo muito grande");
            }
            if($img_type !== "jpg" && $img_type!=="png" && $img_type!=="jpeg"){
                throw new Exception("Só é aceito JPG ou PNG");     
            }
            if(move_uploaded_file($file['tmp_name'],$target_file)){
                return $nome_unico;

            }
            return false;
            
        } catch (Exception $e) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
            $_SESSION['type'] = 'danger';
            return false;
        }
    }

    function limparDir($db) {
        try {
            $dir = ABSOLUTE_PATH . "usuarios/img/";
            
            if (!is_dir($dir)) {
                throw new Exception("Diretório não encontrado: " . $dir);
            }

            // 1. Buscar imagens do banco
            $imagens_banco=$db->select("usuarios","foto",[],true,0,"fetch_all_col");
            // $sql = "SELECT foto FROM usuarios";
            // $stmt = $db->open_db()->prepare($sql);
            // $stmt->execute();
            // $imagens_banco = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Garante que login.png nunca seja apagada
            $imagens_validas = array_merge($imagens_banco, ["login.png","semimagem.jpg"]);

            // 2. Listar arquivos da pasta
            $arquivos = scandir($dir);

            foreach ($arquivos as $arquivo) {
                if ($arquivo === "." || $arquivo === "..") {
                    continue;
                }

                $caminho = $dir . $arquivo;

                // 3. Se não estiver no banco e for arquivo, apaga
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
    function criptografia($senha){
		$custo = '08';
		$salt = 'Cf1f11ePArKlBJomM0F6aJ';
		$hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
		return $hash;
	}
    
 ?>