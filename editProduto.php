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
    require('includes/header.php');
    function validaProduto($nome, $valor)
    {
        $erros = [];
        if (empty($nome)) {
            $erros[] = "O campo nome é obrigatório";
        }
        if (!is_numeric($valor)) {
            $erros[] = "O preço deve ser um valor numérico";
        }

        return $erros;
    }

    function getProduto($prodId)
    {
        $produtosarray = json_decode(file_get_contents('produtos.json'), true);
        foreach ($produtosarray as $prod) {
            if ($prod['id'] == $prodId) {
                return $prod;
            }
        }
    }

    if (isset($_GET['id'])) {
        $prodId = $_GET['id'];
        $prod = getProduto($prodId);
    }


    if ($_POST) {

        $valor = $_POST['prodValor'];
        $nome = $_POST['prodNome'];
        $info = $_POST['prodInfo'];
        $erros = validaProduto($nome, $valor);

        if(isset($_FILES['prodImg']['name'])) {

            $img = date("ymdHis").'_'.$_FILES['prodImg']['name'];
            $imgfile = $_FILES['prodImg']['tmp_name'];
            $caminho = "img/" . $img;
            move_uploaded_file($imgfile, $caminho);
        }
        else {
            
            $img = $prod['prodImg'];
        } 


        if (!empty($erros)) {
            foreach ($erros as $erro) {
                echo "<li style = 'color: #FF0000'> $erro </li>";
            }
        } else {
            
            $prod_edit = [
                "prodNome" => $nome,
                "prodValor" => $valor,
                "prodInfo" => $info,
                "prodImg" => $img
            ];
            $updatedProd = array_merge($prod, $prod_edit);
            $produtosarray = json_decode(file_get_contents('produtos.json'), true);
            foreach ($produtosarray as $i => $prod) {
                if ($prod['id'] == $prodId) {
                    $produtosarray[$i] = $updatedProd;
                }
            }
            file_put_contents('produtos.json', json_encode($produtosarray, JSON_PRETTY_PRINT));
            
            header('Location: indexProdutos.php');
        }      
}

    ?>

    <main class="container">

        <div class="mt-3">

            <h3>Editar produto</h3>
            <form action="" method="post" enctype='multipart/form-data'>
                <div class="row">
                    <div class="col">
                        <span>Nome</span>
                        <input type="text" class="form-control" name="prodNome" value="<?php echo $prod['prodNome'] ?>">
                    </div>
                    <div class="col">
                        <span>Preço</span>
                        <input type="text" class="form-control" name="prodValor" value="<?php echo $prod['prodValor'] ?>">
                    </div>
                </div>
                <div class="form-group mt-1">
                    <span>Descrição</span>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="prodInfo" value=""><?php echo $prod['prodInfo'] ?></textarea>
                </div>
                <div class="">
                    <img src="img/<?php echo $prod['prodImg'] ?>" class="mx-auto d-block img-fluid" style="width: 480px; height: 480px" alt="">
                </div>

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="prodImg">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
                <div>
                    <button type="submit" class="btn btn-warning btn-block mt-2">Editar</button>
                    <a class="btn btn-info btn-block my-2" href="indexProdutos.php">Voltar</a>
                </div>
            </form>
        </div>
    </main>

    <?php require_once('includes/scriptlink.php') ?>
</body>

</html>