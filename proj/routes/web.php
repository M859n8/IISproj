<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('main');
});
//маршрут з анонімною функцією , просто повертає певну в'юху

Route::get('/search', function () {
    return view('search.search'); // Сторінка пошуку
})->name('search');

Route::get('/cart', function () {
    return view('cart'); // Сторінка кошика
})->name('cart');

Route::get('/categories', function () {
    return view('search.search'); // Сторінка категорій
})->name('categories');

Route::get('/', function () {
    return view('main'); // Сторінка кошика
})->name('main');

//взаємодія з дб??
Route::get('/search/results', function () {
    $query = request('query'); // Отримуємо пошуковий запит із форми
    // Додай логіку для обробки пошукового запиту та повернення результатів.
    return view('search.results', ['query' => $query]); // Передаємо пошуковий запит у в'юху
})->name('search.results');


//додай свій контролер
Route::get('/profile', function () {
    return view('profile'); // Сторінка профілю
})->name('profile');

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/register', function () {
    return view('register');
})->name('register');