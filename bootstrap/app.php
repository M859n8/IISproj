<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        //вказує шлях до файлу обробки веб запитів
        web: __DIR__.'/../routes/web.php',
        //щлях до файлу для консольних команд
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //додавання або налаштування мідлвейр
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //обробка винятків додатком
    })->create(); //створює екземпляр додатку