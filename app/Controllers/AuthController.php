<?php
namespace App\Controllers;

use App\Models\User;

class AuthController {

  public function login() {
    header('Content-Type: application/json');
    session_start();

    $input = json_decode(file_get_contents("php://input"), true);

    if (empty($input['email']) || empty($input['password'])) {
      http_response_code(400);
      echo json_encode(['message' => 'Email & password wajib']);
      return;
    }

    $user = (new User())->findByEmail($input['email']);

    if (!$user || !password_verify($input['password'], $user['password'])) {
      http_response_code(401);
      echo json_encode(['message' => 'Email atau password salah']);
      return;
    }

    $_SESSION['user'] = [
      'id' => $user['id'],
      'nama' => $user['nama'],
      'role' => $user['role']
    ];

    echo json_encode(['message' => 'Login berhasil']);
  }

  public function logout() {
    session_start();
    session_destroy();
    echo json_encode(['message' => 'Logout berhasil']);
  }
}
