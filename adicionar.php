<?php
session_start();
require 'config.php';
$id = 0;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = addslashes($_GET['id']);
    $sql = "SELECT * FROM usuarios WHERE usu_id='$id'";
    $sql = $pdo->query($sql);
    if ($sql->rowCount() > 0) {
        $dados = $sql->fetch();
        $emailadm = $dados['usu_email'];
    } else {
        header("Location: index.php");
    }
}
//insert
if (isset($_POST['senha']) && !empty($_POST['senha']) && isset($_POST['nome']) && !empty($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));
    $arquivo = $_FILES['arquivo'];
    $nomedoarquivo = 0;
    if (isset($arquivo['tmp_name']) && !empty($arquivo['tmp_name'])) {
        $nomedoarquivo = md5(time() . rand(0, 99)) . '.png';
        move_uploaded_file($arquivo['tmp_name'], 'fotos/' . $nomedoarquivo);
    }
    $sql = "INSERT INTO usuarios SET usu_nome='$nome', usu_email='$email', usu_senha='$senha', usu_ativo=1, usu_imagem='$nomedoarquivo'";
    $pdo->query($sql);
    header('Location: index.php');
}
//update
if ((isset($_POST['nome']) && !empty($_POST['nome']))) {
    if ($emailadm != 'adm') {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $sql = "UPDATE usuarios SET usu_nome='$nome', usu_email='$email' WHERE usu_id = '$id'";
        $pdo->query($sql);
        header('Location: index.php');
    } else {
        header('Location: erroEditar.php');
    }
}
?>
<form method="POST" enctype="multipart/form-data">
    <link href="css/layout.css" rel="stylesheet" type="text/css"/>
    <?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        echo'<fieldset><legend>Alteração</legend>';
        echo' Nome<br/>';
        echo'<input type="text" name="nome"value="' . $dados["usu_nome"] . '"/><br/><br/>';
        echo'Email<br/>';
        echo'<input type="text" name="email" value="' . $dados["usu_email"] . '"/><br/><br/>';
        echo' <input type="submit" value="Alterar">';
        echo'</fieldset>';
    } else {
        echo'<fieldset><legend>Alteração</legend>';
        echo' Nome<br/>';
        echo'<input type="text" name="nome"/><br/><br/>';
        echo'Email<br/>';
        echo' <input type="text" name="email"/><br/><br/>';
        echo'Senha<br/>';
        echo'<input type="text" name="senha"/><br/><br/>';
        echo'Imagem de perfil<br/>';
        echo'<input type="file" name="arquivo"/><br/><br/>';
        echo' <input type="submit" value="Cadastrar">';
        echo'</fieldset>';
    }
    ?>
</form>