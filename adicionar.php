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
    $foto = $_FILE['foto'];

    // Se a foto estiver sido selecionada
    if (!empty($foto['name'])) {

        // Largura máxima em pixels
        $largura = 150;
        // Altura máxima em pixels
        $altura = 180;
        // Tamanho máximo do arquivo em bytes
        $tamanho = 1000;

        // Verifica se o arquivo é uma imagem
        if (!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])) {
            $error[1] = "Isso não é uma imagem.";
        }

        // Pega as dimensões da imagem
        $dimensoes = getimagesize($foto["tmp_name"]);

        // Verifica se a largura da imagem é maior que a largura permitida
        if ($dimensoes[0] > $largura) {
            $error[2] = "A largura da imagem não deve ultrapassar " . $largura . " pixels";
        }

        // Verifica se a altura da imagem é maior que a altura permitida
        if ($dimensoes[1] > $altura) {
            $error[3] = "Altura da imagem não deve ultrapassar " . $altura . " pixels";
        }

        // Verifica se o tamanho da imagem é maior que o tamanho permitido
        if ($foto["size"] > $tamanho) {
            $error[4] = "A imagem deve ter no máximo " . $tamanho . " bytes";
        }

        // Se não houver nenhum erro
        if (count($error) == 0) {

            // Pega extensão da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);


            // Caminho de onde ficará a imagem
            $caminho_imagem = $_SERVER['DOCUMENT_ROOT'] . 'sistemacomlogin/fotos/' . $foto["tmp_name"];

            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto["tmp_name"], $caminho_imagem);
        }

        // Se houver mensagens de erro, exibe-as
        if (count($error) != 0) {
            foreach ($error as $erro) {
                echo $erro . "<br />";
            }
        }
    }
    $sql = "INSERT INTO usuarios SET usu_nome='$nome', usu_email='$email', usu_senha='$senha', usu_ativo=1, usu_imagem='$nome_imagem'";
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
    <?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        echo' Nome<br/>';
        echo'<input type="text" name="nome"value="' . $dados["usu_nome"] . '"/><br/><br/>';
        echo'Email<br/>';
        echo'<input type="text" name="email" value="' . $dados["usu_email"] . '"/><br/><br/>';

        echo' <input type="submit" value="Alterar">';
    } else {
        echo' Nome<br/>';
        echo'<input type="text" name="nome"/><br/><br/>';
        echo'Email<br/>';
        echo' <input type="text" name="email"/><br/><br/>';
        echo'Senha<br/>';
        echo'<input type="text" name="senha"/><br/><br/>';
        echo'Imagem de perfil<br/>';
        echo'<input type="file" name="foto"/><br/><br/>';
        echo' <input type="submit" value="Cadastrar">';
    }
    ?>
</form>