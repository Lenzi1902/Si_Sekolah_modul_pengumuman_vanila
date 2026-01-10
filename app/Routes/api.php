<?php

use App\Controllers\AuthController;
use App\Controllers\PengumumanController;

/* Auth */
$router->post('/api/login', [AuthController::class, 'login']);

/* Pengumuman */
$router->get('/api/pengumuman', [PengumumanController::class, 'index']);
$router->post('/api/pengumuman', [PengumumanController::class, 'store']);
