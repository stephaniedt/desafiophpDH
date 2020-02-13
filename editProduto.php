<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Editar produto</title>
</head>

<body>
    <?php session_start();
     require('includes/header.php') ?>

    <main class="container">
        <div class="mt-3">

            <h3>Editar produto</h3>
            <form action="" method="post">
                <div class="row">
                    <div class="col">
                        <span>Nome</span>
                        <input type="text" class="form-control" name="prodNome">
                    </div>
                    <div class="col">
                        <span>Preço</span>
                        <input type="text" class="form-control" name="prodValor">
                    </div>
                </div>
                <div class="form-group mt-1">
                    <span>Descrição</span>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="prodInfo"></textarea>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="prodImg">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
                <div>
                    <button type="submit" class="btn btn-info btn-block mt-2" name="prodAdd">Editar</button>
                </div>
            </form>
        </div>
    </main>

    <?php require_once('includes/scriptlink.php') ?>
</body>

</html>