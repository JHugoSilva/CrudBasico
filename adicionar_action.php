<?php

require_once 'config.php';
require_once 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$name = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');

if ($name && $email) {

    if ($usuarioDao->findByEmail($email) === false) {
        $novoUsuario = new Usuario();
        $novoUsuario->setNome($name);
        $novoUsuario->setEmail($email);

        $id = $usuarioDao->add($novoUsuario);
        header("Location:index.php");
        exit;
    } else {
        header("Location:adicionar.php");
        exit;
    }
} else {
    header("Location:adicionar.php");
    exit;
}
