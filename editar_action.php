<?php

require_once 'config.php';
require_once 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$name = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($id && $name && $email) {
    $usuario = $usuarioDao->findById($id);

    if ($usuarioDao->findByEmailId($email, $id)) {

        $usuario->setNome($name);
        $usuario->setEmail($email);

        $usuarioDao->update($usuario);
        header("Location:index.php");
        exit;
    } else {
        header("Location:index.php");
        exit;
    }
} else {
    header("Location:editar.php?id=".$id);
    exit;
}
