<?php
$produtosarray = json_decode(file_get_contents('produtos.json'), true);
$prodId = $_GET['id'];
foreach ($produtosarray as $i => $prod) {
    if ($prod['id'] == $prodId) {
        array_splice($produtosarray, $i, 1);
    }
}
file_put_contents('produtos.json', json_encode($produtosarray, JSON_PRETTY_PRINT));


header('Location: indexProdutos.php');

