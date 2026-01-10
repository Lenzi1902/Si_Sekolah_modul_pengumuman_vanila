<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class User {
  private PDO $db;

  public function __construct() {
    $this->db = Database::getConnection();
  }

  public function findByEmail(string $email) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
  }

  public function create(array $data) {
    $stmt = $this->db->prepare(
      "INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)"
    );
    return $stmt->execute([
      $data['nama'],
      $data['email'],
      password_hash($data['password'], PASSWORD_DEFAULT),
      $data['role']
    ]);
  }
}
