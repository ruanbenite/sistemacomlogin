<?php

session_start();
require'config.php';

if (isset($_GET['id']) && !empty($_GET['id']) && $_SESSION['id'] != $_GET['id']) {
    $id = addslashes($_GET['id']);
    $idlogado = $_SESSION['id'];
    $sql = "SELECT * FROM usuarios WHERE usu_id = '$id'";
    $sql = $pdo->query($sql);
    $dado = $sql->fetch();
    if ($dado['usu_email'] != 'adm') {
        $sql = "DELETE FROM usuarios WHERE usu_id = '$id' AND usu_id <> '$idlogado'";
        $pdo->query($sql);
        header("Location: index.php");
    } else {
        header("Location: erroExcluir.php");
    }
} else {
    header("Location: erroExcluir.php");
}