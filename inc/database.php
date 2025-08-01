<?php 
   
    // abre DB
    function open_db(){
         try {
            $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $pdo;
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    // fecha DB
    function close_db($conn){
        $conn=null;
    }

    //função que busca de registros na tabela
    function find($table, $id = null) {
        $db = open_db();
        $found = null;
        try {
            if ($id) {
                $sql = "SELECT * FROM $table WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $found = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $sql = "SELECT * FROM $table";
                $stmt = $db->query($sql);
                $found = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return $found;
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
        close_db($db);
    }

    function find_all($table) {
        return find($table);
    }
    // função salva no banco de dados
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
    // função atualiza no banco de dados
    function update($table, $id, $array) {
        $db = open_db();
        $fields = "";
        $cleaned_array = [];
        foreach ($array as $key => $value) {
            $cleaned_key = trim($key, "'");
            $cleaned_array[$cleaned_key] = $value;
        }
        foreach ($cleaned_array as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");
        $sql = "UPDATE $table SET $fields WHERE id = :id";
        try {
            $stmt = $db->prepare($sql);
            foreach ($cleaned_array as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $_SESSION['message'] = "Registro atualizado com sucesso.";
            $_SESSION['type'] = "success";
        } catch (Exception $e) {
            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';
        }
        close_db($db);
    }
// função remove do banco de dados
    function remove($table, $id) {
        $db = open_db();
        try {
            $sql = "DELETE FROM $table WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $_SESSION['message'] = "Registro removido com sucesso.";
            $_SESSION['type'] = 'success';
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
        close_db($db);
    }
     function clear_messages(){
        $_SESSION['message']=null;
        $_SESSION['type']=null;
    }
?>