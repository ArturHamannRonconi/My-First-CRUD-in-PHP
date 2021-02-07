<?php
require_once 'models/Usuario.php';

class UsuarioDaoMysql implements UsuarioDAO {
  private PDO $pdo;

  public function __construct(PDO $engine) {
    $this->pdo = $engine;
  }

  public function add(Usuario $usuario) {
    $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:name, :email)");
    $sql->bindValue(":name", $usuario->getNome());
    $sql->bindValue(":email", $usuario->getEmail());
    $sql->execute();

    $usuario->setId($this->pdo->lastInsertId());
    return $usuario;
  }
  public function findAll(): array {
    $arrayUsuarios = [];
    $sql = $this->pdo->query("SELECT * FROM usuarios");
    if($sql->rowCount() > 0){
      $data = $sql->fetchAll(PDO::FETCH_ASSOC);

      foreach ($data as $item) {
        $usuario = new Usuario($item["nome"], $item["email"], $item["id"]);
        array_push($arrayUsuarios, $usuario);
      }
    }
    return $arrayUsuarios;
  }
  public function findByEmail(string $email): ?Usuario {
    $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $sql->bindValue(":email", $email);
    $sql->execute();

    if($sql->rowCount() === 0)
      return null;
    
    $dadosDoUsuario = $sql->fetch();
    $usuarioEncontrado = new Usuario($dadosDoUsuario["nome"], $dadosDoUsuario["email"], $dadosDoUsuario["id"]);
    return $usuarioEncontrado;
  }
  public function checkEmail(string $email, int $id): bool {
    $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND id <> :id");
    $sql->bindValue(":email", $email);
    $sql->bindValue(":id", $id);
    $sql->execute();

    return ($sql->rowCount() > 0) ? true:false;

  }
  public function findById(int $id): ?Usuario {
    $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();


    if($sql->rowCount() === 0)
      return null;
  
    $dadosDoUsuario = $sql->fetch();
    $usuarioEncontrado = new Usuario($dadosDoUsuario["nome"], $dadosDoUsuario["email"], $dadosDoUsuario["id"]);
    return $usuarioEncontrado;
  }
  public function update(Usuario $usuario) {
    $sql = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id");
    $sql->bindValue(":nome", $usuario->getNome());
    $sql->bindValue(":email", $usuario->getEmail());
    $sql->bindValue(":id", $usuario->getId());
    $sql->execute();
  }
  public function delete(Usuario $usuario) {
    $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $sql->bindValue(":id", $usuario->getId());
    $sql->execute();
  }
}