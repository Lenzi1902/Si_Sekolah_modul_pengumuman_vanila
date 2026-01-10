<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = new Router();

require_once __DIR__ . '/../app/Routes/api.php';

$router->run();
