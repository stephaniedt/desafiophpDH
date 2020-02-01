<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Cadastro de usuário</title>
</head>

<body>
    <?php require_once('includes/header.php'); ?>

    <main class="container">
        <div class="row mt-4">
            <div class="col-5 border rounded">
             <h3>Usuários</h3>

             
            </div>
            <div class="col-7">
            <h3>Adicionar usuários  </h3>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nomeusuario">Nome</label>
                        <input type="text" class="form-control" id="nomeusuario" name="nome" placeholder="Nome" required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1">Email</label>
                        <input type="email" class="form-control" id="inputEmail1" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword1">Senha</label>
                        <small class="d-block">Mínimo 6 caracteres</small>
                        <input type="password" class="form-control" id="inputPassword1" name="senha">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword2">Confirme sua senha</label>
                        <input type="password" class="form-control" id="inputPassword2" name="senhaconf">
                    </div>
                    <button type="submit" class="btn btn-info btn-block">Adicionar</button>
                </form>
            </div>
        </div>
    </main>


    <?php require_once('includes/scriptlink.php') ?>
</body>

</html>