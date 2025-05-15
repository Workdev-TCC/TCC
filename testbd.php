<?php 
    include "config.php";
    include DBAPI;
    if(open_db()){
        $conn=open_db();
        echo "sucesso";
        close_db($conn);
    }else{
        echo "erro";
    }

?>