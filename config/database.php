<?php 
    include(UTEIS);
    function open_db(){
        try{
            $conn= new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER, DB_PASS);
            ;$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(Exception $e){
            throw $e;
        }
    }

    function close_db(&$pdo) {
        $pdo = null;
    }

    function clear_messages(){
        $_SESSION['message']=null;
        $_SESSION['type']=null;
    }

    function save($table, $array) {
        $db = open_db();

        

        
        $columns = implode(", ", array_keys($array));

        
        $values = ":" . implode(", :", array_keys($array));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

    
        
        try {
            $stmt = $db->prepare($sql);
            foreach ($array as $key => $value) {
                $stmt->bindValue(":" . $key, $value);
            }
            $stmt->execute();
            $_SESSION['message'] = 'Registro cadastrado com sucesso.';
            $_SESSION['type'] = 'success';
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
        close_db($db);
    }




?>