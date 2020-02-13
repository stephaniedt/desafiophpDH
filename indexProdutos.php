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
require_once('includes/header.php'); ?>

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
                <tr>
                    <th scope="row">1</th>
                    <td>Produto 1</td>
                    <td>Descrição produto 1</td>
                    <td>R$ 10,00</td>
                    <td> 
                        
                         <a href="editProduto.php" class="btn btn-info" name="edit-prod">Editar</a>
                         <a href="editProduto.php" class="btn btn-danger" name="delete-prod">Excluir</a>
                    </td>
                </tr>
            </tbody>
    </main>

    <?php require_once('includes/scriptlink.php') ?>

</body>
</html>