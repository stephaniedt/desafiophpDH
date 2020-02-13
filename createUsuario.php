<?php
define('MIN_PWD_NUM', 6);
define('MAX_PWD_NUM', 25);

function pwdok($senha)
{
    return strlen($senha) >= MIN_PWD_NUM and strlen($senha) <= MAX_PWD_NUM;
}
session_start();

fopen('usuarios.json', 'a+');

//validações dos campos e criação array erros.
if ($_POST) {

    $erros = array();
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaConf = $_POST['senhaconf'];


    if (empty($nome)) {
        $erros[] = $erronome = "O nome é obrigatório.";
    }

    if (empty($email)) {
        $erros[] = $erroemail = "Email obrigatório.";
    }
    if (!pwdok($senha)) {
        $erros[] = $errosenha = "A senha deve conter de 6 a 25 caracteres.";
    }

    if ($senha == $senhaConf) {
        if (!empty($nome) and !empty($email)) {

            $_POST['senha'] = $_POST['senhaconf'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $user = $_POST;
            fopen('usuarios.json', 'a+');
            $usuariosjson = file_get_contents('usuarios.json');
            $usuariosarray = json_decode($usuariosjson, true);
            $usuariosarray[] = $user;
            $contentjson = json_encode($usuariosarray);
            file_put_contents('usuarios.json', $contentjson);
        } else {
            $erros[] = $erronome = "O nome é obrigatório.";
            $erros[] = $erroemail = "Email obrigatório.";
        }
    } else {
        $erros[] = $errosenhaconf = "A confirmação de senha não confere.";
    }
}

$usuariosjson = file_get_contents('usuarios.json');
$usuariosarray = json_decode($usuariosjson, true);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Cadastro de usuário</title>
</head>

<body>
    <?php require_once('includes/header.php'); ?>

    <main class="container">

        <div class="row mt-4">
            <div class="list-group-flush col-5 border rounded">
                <h3>Usuários</h3>
                <div>
                    <?php if ($usuariosarray) {
                        foreach ($usuariosarray as $user) { ?>
                            <div>
                                <li class="list-group-item d-flex justify-content-between">
                                    <div>
                                        <p><?php echo $user['nome']; ?></p>
                                        <p><?php echo $user['email']; ?></p>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-info btn-block">Editar</button>
                                        <button type="submit" class="btn btn-danger btn-block">Excluir</button>
                                    </div>
                                </li>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
            <div class="col-7">
                <h3>Criar usuário </h3>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nomeusuario">Nome</label>
                        <input type="text" class="form-control" id="nomeusuario" name="nome" placeholder="Nome">
                        <?php if (!empty($erronome)) {
                            echo "<span style ='color: #FF0000'> $erronome </span>";
                        } ?>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1">Email</label>
                        <input type="email" class="form-control" id="inputEmail1" name="email" placeholder="E-mail">
                        <?php if (!empty($erroemail)) {
                            echo "<span style ='color: #FF0000'> $erroemail </span>";
                        } ?>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword1">Senha</label>
                        <small class="d-block">Mínimo 6 caracteres</small>
                        <input type="password" class="form-control" id="inputPassword1" name="senha">
                        <?php if (!empty($errosenha)) {
                            echo "<span style ='color: #FF0000'> $errosenha</span>";
                        } ?>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword2">Confirme sua senha</label>
                        <input type="password" class="form-control" id="inputPassword2" name="senhaconf">
                        <?php if (!empty($errosenhaconf)) {
                            echo "<span style ='color: #FF0000'> $errosenhaconf </span>";
                        } ?>
                    </div>
                    <button type="submit" class="btn btn-info btn-block">Adicionar</button>
                </form>
            </div>
        </div>

    </main>


    <?php require_once('includes/scriptlink.php') ?>
</body>

</html>