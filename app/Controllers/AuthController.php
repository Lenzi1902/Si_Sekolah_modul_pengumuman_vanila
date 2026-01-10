<?php
namespace App\Controllers;

use App\Models\User;

class AuthController {

  public function login() {
    header('Content-Type: application/json');

    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['email'], $input['password'])) {
      http_response_code(400);
      echo json_encode(['message' => 'Email dan password wajib']);
      return;
    }

    $userModel = new User();
    $user = $userModel->findByEmail($input['email']);

    if (!$user || !password_verify($input['password'], $user['password'])) {
      http_response_code(401);
      echo json_encode(['message' => 'Email atau password salah']);
      return;
    }

    echo json_encode([
      'message' => 'Login berhasil',
      'user' => [
        'id' => $user['id'],
        'nama' => $user['nama'],
        'email' => $user['email'],
        'role' => $user['role']
      ]
    ]);
  }
}
