<?php
namespace App\Core;

class Auth {

  public static function check() {
    session_start();
    if (!isset($_SESSION['user'])) {
      http_response_code(401);
      echo json_encode(['message' => 'Unauthorized']);
      exit;
    }
  }

  public static function role(array $roles) {
    self::check();
    if (!in_array($_SESSION['user']['role'], $roles)) {
      http_response_code(403);
      echo json_encode(['message' => 'Forbidden']);
      exit;
    }
  }

  public static function user() {
    session_start();
    return $_SESSION['user'] ?? null;
  }
}
