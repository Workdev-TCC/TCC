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
            }catch(Exception $e){
                 if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                 }
                $_SESSION['message'] = $e->getMessage();
                $_SESSION['type'] = 'danger';
            }
            $this->close_db();
        }
        //EDIT
        public function update($table,$array,$where){
            //camposUp=array assoc
            //where=array assoc
            $db=$this->open_db();
            $campos_sql="";
            $placeholders=[];

            foreach($array as $key => $value){
                $campos_sql.=" {$key} = :{$key},";
                $ph=":{$key}";
                $placeholders[$ph]=$value;
            }
            $campos_sql=rtrim($campos_sql,",");
            $sql="UPDATE {$table} SET{$campos_sql}";
            
            foreach($where as $campo => $valor){
                $campo=trim($campo,"'");
                $ph=":{$campo}";
                $condicoes[]="{$campo} = {$ph}";
                $placeholders[$ph]=$valor;
            }
            $sql.=" WHERE ".implode("AND",$condicoes);
           
            $stmt=$db->prepare($sql);
            foreach($placeholders as $ph => $value){
                $type=is_int($value)? PDO::PARAM_INT : PDO::PARAM_STR; 
                $stmt->bindValue("{$ph}",$value,$type);
            }
            if( $stmt->execute()){
                $_SESSION['message'] ="atualização realizada com sucesso";
                $_SESSION['type'] = 'success'; 
                return true;
            }
            return false;
           

            $this->close_db();
        }
        //SELECT 
      public function select($table, $retorno = "*", $onde = [], $pegarVarios = true, $limit = 0, $return_type = 'fetch_all_assoc')
        {
            $db = $this->open_db();
            $resultado = $this->montarSelectSql($table, $retorno, $onde, $limit);
            $sql = $resultado['sql'];
            $placeholders = $resultado['params'];

            $stmt = $db->prepare($sql);

            if (!empty($placeholders)) {
                foreach ($placeholders as $ph => $valor) {
                    $type = is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR;
                    $stmt->bindValue($ph, $valor, $type);
                }
            }

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                switch ($return_type) {
                    case 'fetch_all_col':
                        return $stmt->fetchAll(PDO::FETCH_COLUMN);
                    case 'fetch_assoc':
                        return $stmt->fetch(PDO::FETCH_ASSOC);
                    case 'fetch_all_assoc':
                    default:
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }

            return null;
        }

        private function montarSelectSql($tabela, $retorno, $where = [], $limit = 0)
        {
            $campos = is_array($retorno) ? implode(", ", $retorno) : $retorno;

            // Aqui o segredo: $tabela pode conter joins e aliases
            $sql = "SELECT {$campos} FROM {$tabela}";

            $placeholders = [];
            $condicoes = [];

            if (!empty($where)) {
                foreach ($where as $campo => $valor) {
                    $campo = trim($campo, "'");
                    $ph = ":" . str_replace('.', '_', $campo); // evita conflito com alias
                    $condicoes[] = "{$campo} = {$ph}";
                    $placeholders[$ph] = $valor;
                }
                $sql .= " WHERE " . implode(" AND ", $condicoes);
            }

            if ($limit > 0) {
                $sql .= " LIMIT " . (int)$limit;
            }

            return [
                'sql' => $sql,
                'params' => $placeholders
            ];
        }


    }
?>