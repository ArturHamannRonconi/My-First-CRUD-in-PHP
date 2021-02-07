<?php

class Usuario {
  private string $nome;
  private string $email;
  private ?int $id;

  public function __construct(string $nome, string $email, ?int $id = null) {
    $this->setNome($nome);
    $this->setEmail($email);
    $this->setId($id);
  } 

  public function getNome(): string {
    return $this->nome;
  }
  private function setNome(string $nome) {
    $this->nome = ucwords(trim($nome));
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


interface UsuarioDAO {
  public function add(Usuario $usuario);
  public function findAll(): array;
  public function findByEmail(string $email): ?Usuario;
  public function checkEmail(string $emal, int $id): bool;
  public function findById(int $id): ?Usuario;
  public function update(Usuario $usuario);
  public function delete(Usuario $usuario);
}
