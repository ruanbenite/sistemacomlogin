<?php
$dns = "mysql:dbname=sistemacomlogin;host=localhost";
$dbuser = "root";
$dbpassword = "";
try {

    $pdo = new PDO($dns, $dbuser, $dbpassword);
} catch (PDOException $e) {

    echo"Falha ao conectar no banco" . $e->getMessage();
}