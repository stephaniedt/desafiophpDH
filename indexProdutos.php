<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Home</title>
</head>

<body>

    <?php
    session_start();
    require_once('includes/header.php');

    function getProdutos() {
        
        return json_decode(file_get_contents('produtos.json'), true);
    }

    $produtosarray = getProdutos();
    ?>

    <main class="container mt-4">
        <h3>Lista de produtos</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($produtosarray) {
                    foreach ($produtosarray as $prod) : ?>
                        <tr>
                            <th scope="row"> <?php echo $prod['id']; ?></th>
                            <td><?php echo $prod['prodNome']; ?></td>
                            <td><?php echo $prod['prodInfo']; ?></td>
                            <td><?php echo 'R$ ' . number_format($prod['prodValor'], 2, ',', '.'); ?></td>
                            <td>
                                <a href="editProduto.php?id=<?php echo $prod['id'] ?>" class="btn btn-info" name="edit-prod">Editar</a>
                                <a href="deleteProduto.php?id=<?php echo $prod['id'] ?>" class="btn btn-danger" name="delete-prod">Excluir</a>
                            </td>
                        </tr>
                <?php endforeach;
                } ?>
            </tbody>
    </main>

    <?php require_once('includes/scriptlink.php') ?>

</body>

</html>