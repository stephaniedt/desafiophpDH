<?php

session_start();
$loginemail = $_POST['email'];
$loginsenha = $_POST['senha'];
$jusers = file_get_contents('usuarios.json');
$users = json_decode($jusers, true);

if ($_POST) {

    foreach ($users as $user) {
        
        if($user['email'] == $loginemail and (password_verify($loginsenha, $user['senha']) == $loginsenha)) {
            $_SESSION['email'] = $loginemail;
            $_SESSION['senha'] = $loginsenha;
            header('location:indexProdutos.php');
            exit;
            
        }
        else {
            unset ($_SESSION['email']);
            unset ($_SESSION['senha']);
            header('location:index.php');
        }
    }
}
    









?>