<?php
require 'config.php';
session_start();
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: login.php");
}
?>
<link href="css/layout.css" rel="stylesheet" type="text/css"/>
<fieldset>
    <legend>Perfil:</legend>
    <?php
    echo"<div id='img'><img src='" . $_SERVER['DOCUMENT_ROOT'] . "/sistemacomlogin/fotos/" . $_SESSION['foto'] . "'></div>";
    echo"ID: " . $_SESSION['id'];
    echo"<br/>";
    echo"nome: " . $_SESSION['nome'];
    echo"<br/>";
    echo"email: " . $_SESSION['email'];
    echo"<br/>";
    echo"senha: " . $_SESSION['senha'];
    echo"<br/>";
    echo"<h5><a href='sair.php'>Troca de usuário<a/></h5>";
    ?>
</fieldset>
<form method="POST">

    <div>
        <h3><a href="adicionar.php">Cadastrar<a/></h3>
    </div>

    <table>


        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT * FROM usuarios";
        $sql = $pdo->query($sql);
        if ($sql->rowCount() > 0) {
            foreach ($sql->fetchAll() as $dados) {
                echo"<tr>";
                echo"<td>" . $dados['usu_nome'] . "</td>";
                echo"<td>" . $dados['usu_email'] . "</td>";
                echo"<td>" . $dados['usu_senha'] . "</td>";
                echo"<td>" . $dados['usu_ativo'] . "</td>";
                echo'<td><a href="adicionar.php?id=' . $dados['usu_id'] . '">Editar<a/>    -   <a href="excluir.php?id=' . $dados['usu_id'] . '">Excluir<a/></td>';
                echo"</tr>";
            }
        }
        ?>
    </table>

</form>
<br/>

<?php
?>