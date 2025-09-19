<?php
    class Banco {
        private $host;
        private $password;
        private $user;
        private $name;

        private $pdo;

        public function __construct
        (
             $host = "localhost",
             $password= '',
             $user="root",
             $name="zupinturas"
        ) 
        {
            $this->host=$host;
            $this->name=$name;
            $this->password=$password;
            $this->user=$user;

        }

        public function open_db(){
            try{
                $this->pdo= new PDO("mysql:host=".$this->host.";dbname=".$this->name.";charset=utf8",$this->user, $this->password);

                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->pdo;
            }catch(PDOException $e){
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
           
        }

        public function close_db(){
            $this->pdo=null;
        }

            // INSERT
        public function save($table, $array){
            $db=$this->open_db();
            $colunas=implode(", ",array_keys($array));
            $placeholders=":".implode(", :",array_keys($array));
            $sql="INSERT INTO $table ($colunas) VALUES ($placeholders)";
            try{
                $stmt=$db->prepare($sql);
                foreach($array as $key => $value){
                    $stmt->bindValue(":".$key,$value);
                }
                $stmt->execute();
                 if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                 }
                $_SESSION['message'] ="Cadastro ralizado com sucesso";
                $_SESSION['type'] = 'success';                
            }catch(Exeption $e){
                 if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                 }
                $_SESSION['message'] = $e->getMessage();
                $_SESSION['type'] = 'danger';
            }
            $this->close_db();
        }
//melhorar depois 
        public function selectLogin($table,$email,$senha){
            $db=$this->open_db();
            $sql = "SELECT * FROM $table WHERE email = :login AND senha = :senha LIMIT 1";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":login", $email,PDO::PARAM_STR);
            $stmt->bindParam(":senha", $senha,PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                return $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return null;
        }
    }
?>