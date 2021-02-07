<?php
require_once 'models/User.php';

class UserDaoMysql implements UserDAO {
  private PDO $pdo;

  public function __construct(PDO $engine) {
    $this->pdo = $engine;
  }

  public function add(User $user) {
    $sql = $this->pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $sql->bindValue(":name", $user->getName());
    $sql->bindValue(":email", $user->getEmail());
    $sql->execute();
  }
  public function findAll(): array {
    $arrayUsers = [];
    $sql = $this->pdo->query("SELECT * FROM users");
    if($sql->rowCount() > 0){
      $data = $sql->fetchAll(PDO::FETCH_ASSOC);

      foreach ($data as $item) {
        $user = new User($item["name"], $item["email"], $item["id"]);
        array_push($arrayUsers, $user);
      }
    }
    return $arrayUsers;
  }
  public function findByEmail(string $email): ?User {
    $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
    $sql->bindValue(":email", $email);
    $sql->execute();

    if($sql->rowCount() === 0)
      return null;
    
    $UserData = $sql->fetch();
    $userFound = new User($UserData["name"], $UserData["email"], $UserData["id"]);
    return $userFound;
  }
  public function checkEmail(string $email, int $id): bool {
    $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND id <> :id");
    $sql->bindValue(":email", $email);
    $sql->bindValue(":id", $id);
    $sql->execute();

    return ($sql->rowCount() > 0) ? true:false;
  }
  public function findById(int $id): ?User {
    $sql = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();


    if($sql->rowCount() === 0)
      return null;
  
    $UserData = $sql->fetch();
    $userFound = new User($UserData["name"], $UserData["email"], $UserData["id"]);
    return $userFound;
  }
  public function update(User $user) {
    $sql = $this->pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $sql->bindValue(":name", $user->getName());
    $sql->bindValue(":email", $user->getEmail());
    $sql->bindValue(":id", $user->getId());
    $sql->execute();
  }
  public function delete(User $user) {
    $sql = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
    $sql->bindValue(":id", $user->getId());
    $sql->execute();
  }
}