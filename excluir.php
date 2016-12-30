<?php

require'config.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = addslashes($_GET['id']);
    $sql = "DELETE FROM usuarios WHERE usu_id='$id'";
    $pdo->query($sql);
    header("Location: index.php");
}