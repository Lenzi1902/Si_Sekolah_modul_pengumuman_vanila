<?php
namespace App\Controllers;

use App\Models\Pengumuman;

class PengumumanController {

public function index() {
  header('Content-Type: application/json');

  $pengumuman = new Pengumuman();

  if (isset($_GET['kelas_id'])) {
    $data = $pengumuman->byKelas($_GET['kelas_id']);
  } elseif (isset($_GET['target'])) {
    $data = $pengumuman->byTarget($_GET['target']);
  } else {
    $data = $pengumuman->all();
  }

  echo json_encode($data);
}


  public function store() {
    header('Content-Type: application/json');

    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['judul'], $input['isi'], $input['target'], $input['created_by'])) {
      http_response_code(400);
      echo json_encode(['message' => 'Data pengumuman tidak lengkap']);
      return;
    }

    $pengumuman = new Pengumuman();
    $success = $pengumuman->create($input);

    if ($success) {
      echo json_encode(['message' => 'Pengumuman berhasil ditambahkan']);
    } else {
      http_response_code(500);
      echo json_encode(['message' => 'Gagal menambahkan pengumuman']);
    }
  }
}
