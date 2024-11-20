<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchProductController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('main');
});
//маршрут з анонімною функцією , просто повертає певну в'юху



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



// Route::get('/profile', function () {
//     return view('profile'); // Сторінка профілю, якщо юзер в дб
// })->name('profile');
// Route::get('/profile', [RegistrationController::class, 'showProfile'])->name('profile');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile', [RegistrationController::class, 'showProfile'])->name('profile');
// });

// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile', function () {
//         return view('profile', ['user' => Auth::user()]);
//     })->name('profile');
// });

Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');

//це не потрібно
Route::post('/profile/update', [RegistrationController::class, 'update'])->name('profile.update');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'loginClick'])->name('loginClick');

Route::post('/register', [RegistrationController::class, 'regProfile'])->name('regProfile');

// Route::get('/search', function () {
//     return view('search.search'); // Сторінка пошуку
// })->name('search');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // Ще не настав час


Route::get('/search',[SearchProductController::class, 'search'])->name('search');

Route::get('/product/{id}', [ProductController::class, 'showProduct'])->name('productPage');