<?php
require_once 'config.php';
require_once 'dao/UsuarioDaoMysql.php';
$usuario = false;
$id = filter_input(INPUT_GET, 'id');
$usuarioDao = new UsuarioDaoMysql($pdo);
if ($id) {
    $usuario = $usuarioDao->findById($id);
}
if ($usuario === false) {
    header("Location:index.php");
    exit;
}


?>

<h1>Editar</h1>
<hr>

<form action="editar_action.php" method="post">
    <input type="hidden" name="id" value="<?= $usuario->getId(); ?>">
    <input type="text" name="nome" value="<?= $usuario->getNome(); ?>"><br><br>
    <input type="email" name="email" value="<?= $usuario->getEmail(); ?>"><br><br>
    <input type="submit" value="Editar">
</form>