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




?>