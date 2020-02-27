<?php
session_start();
define('MIN_PWD_NUM', 6);
define('MAX_PWD_NUM', 25);

function pwdok($senha) {
    
    return strlen($senha) >= MIN_PWD_NUM and strlen($senha) <= MAX_PWD_NUM;
}

function validaUsuario($nome, $email, $senha, $senhaConf) {
    $erros = [];
    
    if (empty($nome) OR false) {
        $erros['erronome'] = "O nome é obrigatório e deve conter somente letras.";
    }
    
    if (empty($email) OR false) {
        $erros['erroemail'] = "Email obrigatório.";
    }
    if (!pwdok($senha)) {
        $erros['errosenha']  = "A senha deve conter de 6 a 25 caracteres.";
    }
    if ($senha != $senhaConf) {
        $erros['errosenhaconf'] = "A confirmação de senha não confere.";
    } 

    return $erros;
}

function filterName($name){
    $name = filter_var(trim($name), FILTER_SANITIZE_STRING);
    if(filter_var($name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        return $name;
    } else{
        return false;
    }
}  

function filterEmail($email){
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return $email;
    } else{
        return FALSE;
    }
}

function getUsers() {
    $usuariosjson = file_get_contents('usuarios.json');
    $usuariosarray = json_decode($usuariosjson, true);
    return $usuariosarray;
}

function definirID($usuariosarray)
{
    $posicao = (count($usuariosarray) - 1);
    if ($posicao >= 0) {
        $ultimo_id = $usuariosarray[$posicao]['id'];
        return $ultimo_id + 1;
    } else {
        return 1;
    }
}
if ($_POST) {

    $nome = filterName($_POST['nome']);
    $email = filterEmail($_POST['email']);
    $senha = $_POST['senha'];
    $senhaConf = $_POST['senhaconf'];
    $erros = validaUsuario($nome, $email, $senha, $senhaConf);

    if (empty($erros)) {
        $_POST['senha'] = $_POST['senhaconf'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $user = $_POST;
        fopen('usuarios.json', 'a+');
        $usuariosjson = file_get_contents('usuarios.json');
        $usuariosarray = json_decode($usuariosjson, true);
        $user['id'] = definirID($usuariosarray);
        $usuariosarray[] = $user;
        $contentjson = json_encode($usuariosarray);
        file_put_contents('usuarios.json', $contentjson);
    }
   
}

$usuariosarray = getUsers();

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
    <?php require('includes/header.php'); ?>

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
                                    <?php if (isset($_SESSION['email'])) {?>
                                        <a class="btn btn-info btn-block" href="editUsuario.php?id=<?php echo $user['id']?>">Editar</a>
                                        <a class="btn btn-danger btn-block" href="deleteuser.php?id=<?php echo $user['id']?>">Excluir</a>
                                    <?php }  else { ?>
                                        <a href="index.php">Fazer Login</a>
                                    <?php } ?>
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
                        <?php echo isset($erros['erronome']) ? "<span style ='color: #FF0000'>". $erros['erronome'] ."</span>"  : "" ?>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1">Email</label>
                        <input type="email" class="form-control" id="inputEmail1" name="email" placeholder="E-mail">
                        <?php echo isset($erros['erroemail']) ? "<span style ='color: #FF0000'>". $erros['erroemail'] ."</span>" : "" ?>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword1">Senha</label>
                        <small class="d-block">Mínimo 6 caracteres</small>
                        <input type="password" class="form-control" id="inputPassword1" name="senha">
                    <?php echo isset($erros['errosenha']) ? "<span style ='color: #FF0000'>". $erros['errosenha'] ."</span>" : "" ?>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword2">Confirme sua senha</label>
                        <input type="password" class="form-control" id="inputPassword2" name="senhaconf">
                        <?php echo isset($erros['errosenhaconf']) ? "<span style ='color: #FF0000'>". $erros['errosenhaconf']. "</span>" : "" ?>
                    </div>
                    <button type="submit" class="btn btn-info btn-block">Adicionar</button>
                    
                </form>
            </div>
        </div>

    </main>


    <?php require('includes/scriptlink.php') ?>
</body>

</html>