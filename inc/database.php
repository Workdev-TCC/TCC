<?php
    <?php
class Database {
    private $pdo;
    private $driver;
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $charset;

    /**
     * Construtor da classe
     */
    public function __construct(
        $driver = "mysql",
        $host = "localhost",
        $dbname = "",
        $username = "root",
        $password = "",
        $charset = "utf8"
    ) {
        $this->driver = $driver;
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->charset = $charset;

        $this->connect();
    }

    /**
     * Conecta ao banco
     */
    private function connect() {
        try {
            if ($this->driver === "sqlite") {
                $dsn = "sqlite:" . $this->dbname;
            } else {
                $dsn = "{$this->driver}:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
            }

            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    /**
     * Fecha conexão
     */
    public function close() {
        $this->pdo = null;
    }

    /**
     * Executa SELECT
     */
    public function find($table, $id = null, $primaryKey = 'id') {
        try {
            if ($id) {
                $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $primaryKey = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $stmt = $this->pdo->query("SELECT * FROM $table");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    /**
     * Executa INSERT
     */
    public function insert($table, $data) {
        try {
            $columns = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));
            $sql = "INSERT INTO $table ($columns) VALUES ($values)";
            $stmt = $this->pdo->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    /**
     * Executa UPDATE
     */
    public function update($table, $id, $data, $primaryKey = 'id') {
        try {
            $fields = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
            $sql = "UPDATE $table SET $fields WHERE $primaryKey = :id";
            $stmt = $this->pdo->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    /**
     * Executa DELETE
     */
    public function delete($table, $id, $primaryKey = 'id') {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM $table WHERE $primaryKey = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    /**
     * Cria banco de dados
     */
    public function createDatabase($name) {
        try {
            $sql = "CREATE DATABASE IF NOT EXISTS $name";
            return $this->pdo->exec($sql);
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }

    /**
     * Cria tabela
     */
    public function createTable($sql) {
        try {
            return $this->pdo->exec($sql);
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }
}








?>