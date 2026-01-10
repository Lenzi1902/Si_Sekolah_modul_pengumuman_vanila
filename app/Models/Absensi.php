<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Absensi {
  private PDO $db;

  public function __construct() {
    $this->db = Database::getConnection();
  }

  public function create(int $siswaId, string $tanggal, string $status) {
    $stmt = $this->db->prepare(
      "INSERT INTO absensi (siswa_id, tanggal, status) VALUES (?, ?, ?)"
    );
    return $stmt->execute([$siswaId, $tanggal, $status]);
  }

  public function getBySiswa(int $siswaId) {
    $stmt = $this->db->prepare(
      "SELECT * FROM absensi WHERE siswa_id = ? ORDER BY tanggal DESC"
    );
    $stmt->execute([$siswaId]);
    return $stmt->fetchAll();
  }
}
