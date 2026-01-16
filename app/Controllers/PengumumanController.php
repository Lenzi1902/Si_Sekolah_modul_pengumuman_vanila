<?php
namespace App\Controllers;

use App\Models\Pengumuman;
use App\Core\Auth;

class PengumumanController {

  public function index() {
    Auth::check();

    $model = new Pengumuman();

    if (isset($_GET['kelas_id'])) {
      $data = $model->byKelas((int)$_GET['kelas_id']);
    } elseif (isset($_GET['target'])) {
      $data = $model->byTarget($_GET['target']);
    } else {
      $data = $model->all();
    }

    echo json_encode($data);
  }

  public function store() {
    Auth::role(['admin', 'guru']);

    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['judul'], $input['isi'], $input['target'])) {
      http_response_code(400);
      echo json_encode(['message' => 'Data tidak lengkap']);
      return;
    }

    $input['created_by'] = Auth::user()['id'];

    (new Pengumuman())->create($input);
    echo json_encode(['message' => 'Pengumuman ditambahkan']);
  }
}
