<?php

class User {
  private string $name;
  private string $email;
  private ?int $id;

  public function __construct(string $name, string $email, ?int $id = null) {
    $this->setName($name);
    $this->setEmail($email);
    $this->setId($id);
  } 

  public function getName(): string {
    return $this->name;
  }
  private function setName(string $name) {
    $this->name = ucwords(strtolower(trim($name)));
  }
  
  public function getEmail(): string {
    return $this->email;
  }
  private function setEmail(string $email) {
    $this->email = strtolower(trim($email));
  }

  public function getId(): int {
    return $this->id;
  }
  private function setId(?int $id) {
    if($id === null)
      $this->id = $id;
    else
    $this->id = trim($id);
  }
}


interface UserDAO {
  public function add(User $user);
  public function findAll(): array;
  public function findByEmail(string $email): ?User;
  public function checkEmail(string $emal, int $id): bool;
  public function findById(int $id): ?User;
  public function update(User $user);
  public function delete(User $user);
}
