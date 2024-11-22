<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true)); // Визначення константи для відстеження часу старту

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance; // Якщо файл обслуговування існує, завантажте його
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php') // Завантаження додатку
    ->handleRequest(Request::capture()); // Обробка запиту
