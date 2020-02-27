<?php
session_start();
require_once('includes/header.php');

function validaProduto($nome, $valor, $img)
{
    $erros = [];
    if (empty($nome)) {
        $erros[] = "O campo nome é obrigatório";
    }
    if (!is_numeric($valor)) {
        $erros[] = "O preço deve ser um valor numérico";
    }

    if (!$img) {
        $erros[] = "Insira a imagem do produto, ela é obrigatória.";
    }
    return $erros;
}


function definirID($produtosarray)
{
    $posicao = (count($produtosarray) - 1);
    if ($posicao >= 0) {
        $ultimo_id = $produtosarray[$posicao]['id'];
        return $ultimo_id + 1;
    } else {
        return 1;
    }
}

function getProdutos() {
    
      return json_decode(file_get_contents('produtos.json'), true);


}


function salvaProduto($produto)
{
    fopen('produtos.json', 'a+');
    $produtosarray = getProdutos();
    $produto['id'] = definirID($produtosarray);
    $produto['prodImg'] = date("ymdHis").'_'.$_FILES['prodImg']['name'];
    $produtosarray[] = $produto;
    $contentjson = json_encode($produtosarray);
    file_put_contents('produtos.json', $contentjson);
    $img = $_FILES["prodImg"]["tmp_name"];
    $caminho = "img/".$produto['prodImg'];
    move_uploaded_file($img, $caminho);

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Adicionar produto</title>
</head>

<body>
    <main class="container">
        <div class="mt-3">

            <h3>Adicionar produto</h3>
            <?php

            if ($_POST) {
               
                $valor = $_POST['prodValor'];
                $nome = $_POST['prodNome'];
                $img = $_FILES['prodImg']['name'];
                $erros = validaProduto($nome, $valor, $img);

                if (!empty($erros)) {
                    foreach ($erros as $erro) {
                        echo "<li style = 'color: #FF0000'> $erro </li>";
                    }
                } else {

                    $produto = $_POST;
                    salvaProduto($produto);
                    header('Location: indexProdutos.php');
                }
            }


            ?>
            <form action="" method="post" enctype='multipart/form-data'>
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
                    <button type="submit" class="btn btn-info btn-block mt-2">Adicionar</button>
                </div>
            </form>
        </div>
    </main>
    <?php require_once('includes/scriptlink.php') ?>
</body>

</html>