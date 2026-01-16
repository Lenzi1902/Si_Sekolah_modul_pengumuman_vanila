<?php
namespace App\Controllers;

use App\Models\Absensi;
use App\Core\Auth;

class AbsensiController {

  public function store() {
    Auth::role(['guru', 'admin']);

    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['siswa_id'], $input['tanggal'], $input['status'])) {
      http_response_code(400);
      echo json_encode(['message' => 'Data absensi tidak lengkap']);
      return;
    }

    (new Absensi())->create(
      (int)$input['siswa_id'],
      $input['tanggal'],
      $input['status']
    );

    echo json_encode(['message' => 'Absensi disimpan']);
  }

  public function index() {
    Auth::check();

    if (!isset($_GET['siswa_id'])) {
      http_response_code(400);
      echo json_encode(['message' => 'siswa_id wajib']);
      return;
    }

    $data = (new Absensi())->getBySiswa((int)$_GET['siswa_id']);
    echo json_encode($data);
  }
}
