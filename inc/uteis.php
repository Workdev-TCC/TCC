<!-- todas funções de utilidades, mascaras e etc devem estar aqui -->
<?php 
 
    function verifica_login ($bd,$table,$campoemail,$camposenha,$login,$senha){
        $sql= "SELECT * FROM $table WHERE $campoemail = :login AND $camposenha = :password LIMIT 1";
        $stmt= $bd->prepare($sql);
        $stmt->bindParam(":login",$login,PDO::PARAM_STR);
        $stmt->bindParam(":password",$senha,PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() >0){
            $dados=$stmt->fetch(PDO::FETCH_ASSOC);
            return $dados;
            
        }
        return null;
    }
    


 
 ?>