<?php

session_start();
define('MIN_PWD_NUM', 6);
define('MAX_PWD_NUM', 25);

function pwdok($senha)
{

    return strlen($senha) >= MIN_PWD_NUM and strlen($senha) <= MAX_PWD_NUM;
}

function validaUsuario($nome, $email)
{
    $erros = [];

    if (empty($nome) or false) {
        $erros['erronome'] = "O nome é obrigatório e deve conter somente letras.";
    }

    if (empty($email) or false) {
        $erros['erroemail'] = "Email obrigatório.";
    }
    return $erros;
}

function validaPwd($senha, $senhaConf) {

    if (!pwdok($senha)) {
        $erros['errosenha']  = "A senha deve conter de 6 a 25 caracteres.";
    }
    if ($senha != $senhaConf) {
        $erros['errosenhaconf'] = "A confirmação de senha não confere.";
    }
}

function filterName($name)
{
    $name = filter_var(trim($name), FILTER_SANITIZE_STRING);
    if (filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        return $name;
    } else {
        return false;
    }
}

function filterEmail($email)
{
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email;
    } else {
        return FALSE;
    }
}

function getUsers()
{

    return json_decode(file_get_contents('usuarios.json'), true);
}

function userById($userID)
{
    $usuariosarray = getusers();
    foreach ($usuariosarray as $user) {
        if ($user['id'] == $userID) {
            return $user;
        }
    }
}

if (isset($_GET['id'])) {
    $userID = $_GET['id'];
    $user = userById($userID);
}

if ($_POST) {

    $nome = filterName($_POST['nome']);
    $email = filterEmail($_POST['email']);
    $senha = $_POST['senha'];
    $senhaConf = $_POST['senhaconf'];
    $erros = validaUsuario($nome, $email);

    if (empty($senha) and empty($senhaConf)) {
        $senha = $senhaConf = $user['senha'];
    } elseif ($senha == $senhaConf) {
        if (!pwdok($senha)) {
            $erros['errosenha']  = "A senha deve conter de 6 a 25 caracteres.";
        } else {
            $senha = $senhaConf =  password_hash($_POST['senha'], PASSWORD_DEFAULT);
        }
    } else {
        $erros['errosenhaconf'] = "As senhas não conferem.";
    }

    if (empty($erros)) {
        $user_edit = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'senhaconf' => $senhaConf
        ];

        $updatedUser = array_merge($user, $user_edit);
        $usuariosarray = getUsers();
        foreach ($usuariosarray as $i => $user) {
            if ($user['id'] == $userID) {
                $usuariosarray[$i] = $updatedUser;
            }
        }
        file_put_contents('usuarios.json', json_encode($usuariosarray, JSON_PRETTY_PRINT));
        header('Location: createUsuario.php');
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Deletar usuário</title>
</head>

<body>
    <?php require('includes/header.php'); ?>
    <div class="container mt-4">
        <h3>Deletar usuário </h3>
        <form action="" method="POST">

            <div class="form-group">
                <label for="nomeusuario">Nome</label>
                <input type="text" class="form-control" id="nomeusuario" name="nome" value="<?php echo $user['nome'] ?>">
                <?php echo isset($erros['erronome']) ? "<span style ='color: #FF0000'>" . $erros['erronome'] . "</span>"  : "" ?>
            </div>
            <div class="form-group">
                <label for="inputEmail1">Email</label>
                <input type="email" class="form-control" id="inputEmail1" name="email" value="<?php echo $user['email'] ?>">
                <?php echo isset($erros['erroemail']) ? "<span style ='color: #FF0000'>" . $erros['erroemail'] . "</span>" : "" ?>
            </div>
            <div class="form-group">
                <label for="inputPassword1">Senha</label>
                <small class="d-block">Mínimo 6 caracteres</small>
                <input type="password" class="form-control" id="inputPassword1" name="senha">
                <?php echo isset($erros['errosenha']) ? "<span style ='color: #FF0000'>" . $erros['errosenha'] . "</span>" : "" ?>
            </div>
            <div class="form-group">
                <label for="inputPassword2">Confirme sua senha</label>
                <input type="password" class="form-control" id="inputPassword2" name="senhaconf">
                <?php echo isset($erros['errosenhaconf']) ? "<span style ='color: #FF0000'>" . $erros['errosenhaconf'] . "</span>" : "" ?>
            </div>
            <button type="submit" class="btn btn-warning btn-block">Atualizar</button>
            <a class="btn btn-info btn-block my-2" href="createUsuario.php">Voltar</a>

        </form>
    </div>
    <?php require('includes/scriptlink.php') ?>
</body>

</html>