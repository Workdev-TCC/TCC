<?php 
function formatarDados($tipo, $valor) {
    $valor = trim($valor);
    $valor = preg_replace('/\s+/', ' ', $valor); // remove espaços múltiplos

    switch (strtolower($tipo)) {
        case 'telefone':
            // Remove tudo que não for número
            $valor = preg_replace('/\D/', '', $valor);
            if (strlen($valor) == 11) {
                // Formato com DDD e 9 dígitos (celular)
                return '(' . substr($valor, 0, 2) . ') ' . substr($valor, 2, 5) . '-' . substr($valor, 7);
            } elseif (strlen($valor) == 10) {
                // Fixo com DDD
                return '(' . substr($valor, 0, 2) . ') ' . substr($valor, 2, 4) . '-' . substr($valor, 6);
            } else {
                return 'Telefone inválido';
            }

        case 'cep':
            $valor = preg_replace('/\D/', '', $valor);
            if (strlen($valor) == 8) {
                return substr($valor, 0, 5) . '-' . substr($valor, 5);
            } else {
                return 'CEP inválido';
            }

        case 'cpf':
            $valor = preg_replace('/\D/', '', $valor);
            if (strlen($valor) == 11) {
                return substr($valor, 0, 3) . '.' . substr($valor, 3, 3) . '.' . substr($valor, 6, 3) . '-' . substr($valor, 9);
            } else {
                return 'CPF inválido';
            }

        case 'inscricao_estadual':
            $valor = preg_replace('/\D/', '', $valor);
            if (strlen($valor) >= 9 && strlen($valor) <= 14) {
                // Exemplo: 123.456.789.000
                return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{0,5})/", "$1.$2.$3.$4", $valor);
            } else {
                return 'IE inválida';
            }

        case 'nome':
            // Deixa apenas letras e espaços
            $valor = mb_strtolower($valor, 'UTF-8'); // tudo minúsculo
            return mb_convert_case($valor, MB_CASE_TITLE, 'UTF-8'); // primeira de cada palavra maiúscula

        default:
            return 'Tipo inválido';
    }
}

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
            if($tamanho_arquivo> 5000000000){
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
        $_SESSION['message']="Aconteceu um erro". $e->getMessage();
        $_SESSION['type']="danger";
    }
}


function criptografia($senha){
		$custo = '08';
		$salt = 'Cf1f11ePArKlBJomM0F6aJ';
		$hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
		return $hash;
	}






?>