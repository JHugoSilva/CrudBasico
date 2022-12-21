<?php

require_once 'models/Usuario.php';

class UsuarioDaoMysql implements UsuarioDAO {

    private $pdo;

    public function __construct(PDO $drive)
    {
        $this->pdo = $drive;
    }

    public function add(Usuario $usuario){
        $sql = $this->pdo->prepare("INSERT INTO usuarios(nome, email) VALUES(:name, :email)");
        $sql->bindValue(":name", $usuario->getNome());
        $sql->bindValue(":email", $usuario->getEmail());
        $sql->execute();

        $usuario->setId($this->pdo->lastInsertId());
        return $usuario;
    }

    public function findAll(){
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM usuarios");

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($data as $item) {
                $usuario = new Usuario();

                $usuario->setId($item['id']);
                $usuario->setNome($item['nome']);
                $usuario->setEmail($item['email']);

                $array[] = $usuario;
            }
        }
        return $array;
    }

    public function findById($id){

        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $data = $sql->fetch(\PDO::FETCH_ASSOC);

            $usuario = new Usuario();
            $usuario->setId($data['id']);
            $usuario->setNome($data['nome']);
            $usuario->setEmail($data['email']);
            return $usuario;

        } else {
            return false;
        }
    }

    public function update(Usuario $usuario){
        $sql = $this->pdo->prepare("UPDATE usuarios SET nome=:nome, email=:email WHERE id=:id");
        $sql->bindValue(':id', $usuario->getId());
        $sql->bindValue(':nome', $usuario->getNome());
        $sql->bindValue(':email', $usuario->getEmail());
        $sql->execute();
        return true;
    }

    public function delete($id){
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return true;
    }

    public function findByEmail($email)
    {
        $sql = $this->pdo->prepare("SELECT email FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $data = $sql->fetch(\PDO::FETCH_ASSOC);

            $usuario = new Usuario();
            $usuario->setId($data['id']);
            $usuario->setNome($data['nome']);
            $usuario->setEmail($data['email']);
            return $usuario;

        } else {
            return false;
        }
    }

    public function findByEmailId($email, $id)
    {
        $sql = $this->pdo->prepare("SELECT email FROM usuarios WHERE email = :email AND id <>:id");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
           return false;
        } else {
            return true;
        }
    }
}