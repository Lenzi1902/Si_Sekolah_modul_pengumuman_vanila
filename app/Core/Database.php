<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
  private static ?PDO $conn = null;

  public static function getConnection(): PDO {
    if (self::$conn === null) {
      try {
        $env = parse_ini_file(__DIR__ . '/../../.env');

        self::$conn = new PDO(
          "mysql:host={$env['DB_HOST']};dbname={$env['DB_NAME']};charset=utf8mb4",
          $env['DB_USER'],
          $env['DB_PASS'] ?? '',
          [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
          ]
        );
      } catch (PDOException $e) {
        die("DB Error: " . $e->getMessage());
      }
    }
    return self::$conn;
  }
}
