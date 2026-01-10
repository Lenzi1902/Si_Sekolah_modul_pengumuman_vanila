<?php

use App\Controllers\AuthController;
use App\Controllers\PengumumanController;
use App\Controllers\AbsensiController;

/* Auth */
$router->post('/api/login', [AuthController::class, 'login']);
$router->post('/api/absensi', [AbsensiController::class, 'store']);

/* Pengumuman */
$router->get('/api/pengumuman', [PengumumanController::class, 'index']);
$router->post('/api/pengumuman', [PengumumanController::class, 'store']);
