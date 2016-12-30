<?php
require 'config.php';
?>
<form method="POST">
    <a href="adicionar.php">Cadastrar<a/>
        <br/>
        <br/>
        <a href="sair.php">Sair<a/>
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
            </form>