<?php
session_start();
$host = "localhost";
$user = "root"; // Ajuste conforme seu ambiente
$pass = ""; // Ajuste conforme seu ambiente
$dbname = "sistema_login";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}
?>