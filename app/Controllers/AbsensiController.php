<?php
namespace App\Controllers;

use App\Models\Absensi;

class AbsensiController {

  public function store() {
    header('Content-Type: application/json');

    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['siswa_id'], $input['tanggal'], $input['status'])) {
      http_response_code(400);
      echo json_encode(['message' => 'Data absensi tidak lengkap']);
      return;
    }

    $absensi = new Absensi();
    $success = $absensi->create(
      $input['siswa_id'],
      $input['tanggal'],
      $input['status']
    );

    if ($success) {
      echo json_encode(['message' => 'Absensi berhasil disimpan']);
    } else {
      http_response_code(500);
      echo json_encode(['message' => 'Gagal menyimpan absensi']);
    }
  }

  public function index() {
    header('Content-Type: application/json');

    if (!isset($_GET['siswa_id'])) {
      http_response_code(400);
      echo json_encode(['message' => 'siswa_id wajib']);
      return;
    }

    $absensi = new Absensi();
    $data = $absensi->getBySiswa($_GET['siswa_id']);

    echo json_encode($data);
  }
}
