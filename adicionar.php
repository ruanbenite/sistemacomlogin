<?php
require 'config.php';
$id = 0;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = addslashes($_GET['id']);
    $sql = "SELECT * FROM usuarios WHERE usu_id='$id'";
    $sql = $pdo->query($sql);
    if ($sql->rowCount() > 0) {
        $dados = $sql->fetch();
    } else {
        header("Location: index.php");
    }
}
//insert
if (isset($_POST['senha']) && !empty($_POST['senha']) && isset($_POST['nome']) && !empty($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));
    $sql = "INSERT INTO usuarios SET usu_nome='$nome', usu_email='$email', usu_senha='$senha', usu_ativo=1";
    $pdo->query($sql);
    header('Location: index.php');
}
//update
if ((isset($_POST['nome']) && !empty($_POST['nome']))) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $sql = "UPDATE usuarios SET usu_nome='$nome', usu_email='$email' WHERE usu_id='$id'";
    $pdo->query($sql);
    header('Location: index.php');
}
?>
<form method="POST">
    <?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        echo' Nome<br/>';
        echo'<input type="text" name="nome"value="' . $dados["usu_nome"] . '"/><br/><br/>';
        echo'Email<br/>';
        echo'<input type="text" name="email" value="' . $dados["usu_email"] . '"/><br/><br/>';
        echo'<br/>';
        echo' <input type="submit" value="Editar">';
    } else {
        echo' Nome<br/>';
        echo'<input type="text" name="nome"/><br/><br/>';
        echo'Email<br/>';
        echo' <input type="text" name="email"/><br/><br/>';
        echo'Senha<br/>';
        echo'<input type="text" name="senha"/><br/>';
        echo' <input type="submit" value="Cadastrar">';
    }
    ?>
</form>