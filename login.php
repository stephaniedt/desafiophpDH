<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login - Desafio PHP</title>
</head>

<body>
    <?php require_once('includes/header.php'); ?>

    <main>
<div class="container col-4 my-4">

    <form action="" method="POST">
        <div class="form-group">
            <label for="inputEmail1">Email</label>
            <input type="email" class="form-control" id="inputEmail1" name="email" placeholder="E-mail" required>
        </div>
        <div class="form-group">
            <label for="inputPassword1">Senha</label>
            <input type="password" class="form-control" id="inputPassword1" name="senha">
        </div>
            <a href="#" class="d-block mb-2"> <small>Ainda não sou cadastrado</small></a>
        <div class="form-group">
        <button type="submit" class="btn btn-info btn-block" name="btn-login">Login</button>    
        </div>
    </form>
</div>
    </main>

<?php require_once('includes/scriptlink.php')?>
</body>

</html>