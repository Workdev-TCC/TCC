<?php 
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
    function listar_ordem($table, $order, $tipo = "DESC") {
        $pdo = open_db();
        try {
            $sql = "SELECT * FROM " . $table . " ORDER BY " . $order . " " . $tipo;
            $stmt = $pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = "danger";
            return []; // ← retorna array vazio em caso de erro
        } finally {
            close_db($pdo);
        }
    }
    

    function save($table, $array) {
        $db = open_db();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
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
            return true;
              
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
            return false;
           
        }
        close_db($db);
    }

    function update($table,$id,$array){
        $db=open_db();
        $items = null;

		foreach ($array as $key => $value) {
			$items .= trim($key, "'") . "='$value',";
		}

		// remove a ultima virgula
		$items = rtrim($items, ',');

		$sql  = "UPDATE " . $table;
		$sql .= " SET $items ";
		$sql .= " WHERE id=" . $id . ";";
        try {
			$db->query($sql);
			if (session_status() === PHP_SESSION_NONE) {
				session_start();
			}
			$_SESSION['message'] = "Registro atualizado com sucesso.";
			$_SESSION['type'] = "success";

		} catch (Exception $e) {

			$_SESSION['message'] = 'Não foi possivel realizar a operacao.';
			$_SESSION['type'] = 'danger';
		} 
        close_db($db);
    }




?>