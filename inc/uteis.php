<?php 


function upload($pasta_destino,$arquivo_destino,$tipo_arquivo,$nome_temp,$tamanho_arquivo){
    try{
        $nomearquivo= basename($arquivo_destino);
        $ok=1;

        //verifica se é uma imagem
        if(isset($_POST["submit"])) {
            $check=getimagesize($nome_temp);
            if($check !== false){
                $_SESSION['message']="O arquivo é uma imagem -".$check["mime"].".";
                $_SESSION['type']="info" ;
                $ok=1;
                
                
            }else{
                $ok=0;
                
                throw new Exception("O arquivo não é uma imagem");
            }

            //verifica se ja existe essa imagem na pasta
            if(file_exists($arquivo_destino)){
                $ok=0;
                return true;
                
                
            
                throw new Exception("essa imagem ja existe no nosso sistema ");
            }

            //verifica o tamanho do arquivo
            if($tamanho_arquivo> 500000000000000000000){
                $ok=0;

                
                throw new Exception("arquivo muito grande ");
            }
            
            //verifica tipo do arquivo
            if($tipo_arquivo!="jpg"&&$tipo_arquivo!="jpeg"&&$tipo_arquivo!="png"&&$tipo_arquivo!="gif"){
                $ok=0;
            
                
                throw new Exception("são permetidos apenas jpeg,jpg,png,gif ");
                    
            }

            if($ok==0){
                throw new Exception("upload não podera prosseguir ");
                exit();
                
            }else{
                $caminho_tmp= $_FILES["foto"]["tmp_name"];
                if(move_uploaded_file($caminho_tmp,$arquivo_destino)){
                    $_SESSION['message']="O arquivo". htmlspecialchars($nomearquivo)." foi armazenado";
                    $_SESSION['type']="success";
                    return true;
            
                    
                }else{
                    throw new Exception("Desculpe mas o upload nao pode ser feito");
                    return false;
                }
                
                    
            }
        }
    }catch(Exception $e){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
       }
        $_SESSION['message']="Aconteceu um erro". $e->getMessage();
        $_SESSION['type']="danger";
        header('Location:../index.php');
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