<?php
require 'config.php';
session_start();
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("Location: login.php");
}
?>
<form method="POST">
    <h3><a href="adicionar.php">Cadastrar<a/></h3><br/><br/>

    <table border="15px" width="100%">
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
    <fieldset border="10px">
        <legend>Perfil:</legend>
        <?php
        echo"ID: " . $_SESSION['id'];
        echo"<br/>";
        echo"nome: " . $_SESSION['nome'];
        echo"<br/>";
        echo"email: " . $_SESSION['email'];
        echo"<br/>";
        echo"senha: " . $_SESSION['senha'];
        ?>
    </fieldset>
</form>
<br/>
<h3><a href="sair.php">Troca de usuário<a/></h3>
<?php

?>