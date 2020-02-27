<?php 
$usuariosarray = json_decode(file_get_contents('usuarios.json'), true);
$userID = $_GET['id'];
foreach ($usuariosarray as $i => $user) {
    if ($user['id'] == $userID) {
        array_splice($usuariosarray, $i, 1);
    }
}
file_put_contents('usuarios.json', json_encode($usuariosarray,JSON_PRETTY_PRINT));



header('Location: createUsuario.php');