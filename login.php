<?php
session_start();
require'config.php';
if (isset($_POST['senha']) && !empty($_POST['senha']) && isset($_POST['email']) && !empty($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));
    $sql = "SELECT * FROM usuarios WHERE usu_email='$email' AND usu_senha='$senha'";
    echo $sql;

    $sql = $pdo->query($sql);
    $dado = $sql->fetch();

    if ($sql->rowCount() > 0) {
        $_SESSION['id'] = $dado['usu_id'];
        $_SESSION['email'] = $dado['usu_email'];
        $_SESSION['senha'] = $dado['usu_senha'];
        $_SESSION['nome'] = $dado['usu_nome'];
        $_SESSION['foto'] = $dado['usu_imagem'];
        header("Location: index.php");
    }
}
?>
<link href="css/layout.css" rel="stylesheet" type="text/css"/>
<fieldset>
    <legend>Login</legend>
    <form method="POST">

        E-mail<br/>
        <input type="text" name="email"/>
        <br/><br/>
        Senha<br/>
        <input type="text" name="senha">
        <br/><br/>
        <input type="submit" value="Logar"/>
        <br/><br/>
        <i>Acesso padrão Email: adm e Senha: adm<i/>
            <br/>
    </form>
</fieldset>