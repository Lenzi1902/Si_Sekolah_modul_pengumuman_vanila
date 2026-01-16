<?php

use App\Controllers\AuthController;
use App\Controllers\AbsensiController;
use App\Controllers\PengumumanController;

$router->post('/api/login', [AuthController::class, 'login']);
$router->post('/api/logout', [AuthController::class, 'logout']);

$router->post('/api/absensi', [AbsensiController::class, 'store']);
$router->get('/api/absensi', [AbsensiController::class, 'index']);

$router->get('/api/pengumuman', [PengumumanController::class, 'index']);
$router->post('/api/pengumuman', [PengumumanController::class, 'store']);
