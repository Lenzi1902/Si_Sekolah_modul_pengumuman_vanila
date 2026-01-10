<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Pengumuman {
  private PDO $db;

  public function __construct() {
    $this->db = Database::getConnection();
  }

  public function all() {
    return $this->db
      ->query("SELECT * FROM pengumuman ORDER BY created_at DESC")
      ->fetchAll();
  }

  public function byTarget(string $target) {
    $stmt = $this->db->prepare(
      "SELECT * FROM pengumuman WHERE target = ? ORDER BY created_at DESC"
    );
    $stmt->execute([$target]);
    return $stmt->fetchAll();
  }

  public function byKelas(int $kelasId) {
    $stmt = $this->db->prepare(
      "SELECT * FROM pengumuman WHERE target = 'kelas' AND kelas_id = ?"
    );
    $stmt->execute([$kelasId]);
    return $stmt->fetchAll();
  }

  public function create(array $data) {
    $stmt = $this->db->prepare(
      "INSERT INTO pengumuman (judul, isi, target, kelas_id, created_by)
       VALUES (?, ?, ?, ?, ?)"
    );

    return $stmt->execute([
      $data['judul'],
      $data['isi'],
      $data['target'],
      $data['kelas_id'] ?? null,
      $data['created_by']
    ]);
  }
}
