<?php
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FarmerProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchProductController;
use App\Http\Controllers\SelfPickingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

//mainpage show
Route::get('/', function () {
    return view('main');
});
Route::get('/', function () {
    return view('main');
})->name('main');

//register page show
Route::get('/register', function () {
    return view('register');
})->name('register');
//login page show
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'loginClick'])->name('loginClick'); //login button

Route::post('/register', [RegistrationController::class, 'regProfile'])->name('regProfile'); //register button

//search page show
Route::get('/search',[SearchProductController::class, 'search'])->name('search');
//product page show 
Route::get('/product/{id}', [ProductController::class, 'showProduct'])->name('productPage');
//shows page add product
Route::get('/addproduct', [ProductController::class, 'showCreateForm'])->name('addproduct'); 
//add product to db
Route::post('/addproduct', [ProductController::class, 'createProduct'])->name('createProduct'); 
//create an order with this product
Route::post('/product/{id}', [OrderController::class, 'createOrder'])->name('createOrder');

//show profile page with required information
Route::get('/profile', [OrderController::class, 'showOrdersSelfPickings'])
    ->name('profile')
    ->middleware('auth'); 
//upd profile data
Route::post('/profile/update', [RegistrationController::class, 'update'])->name('profile.update');
//logout button
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 

//userlist button (for admin)
Route::get('/userlist', [AdminPageController::class, 'index'])->name('users.list');
//delete-user button 
Route::delete('/userlist/{id}', [AdminPageController::class, 'destroy'])->name('users.destroy'); 

//manipulation with products on user(farmer) page
Route::get('/products/{id}/edit', [FarmerProductController::class, 'edit'])->name('editproduct'); 
Route::put('/products/{id}', [FarmerProductController::class, 'update'])->name('products.update');
Route::delete('/product/{id}', [FarmerProductController::class, 'destroy'])->name('products.destroy');

//change order status on user(farmer) page
Route::put('/orders/{id}/ready', [OrderController::class, 'statusPrepeared'])->name('orderReady');
//farmer starts self picking 
Route::post('/self-picking/{id}', [SelfPickingController::class, 'create'])->name('selfpicking.start');

//subscribe on self picking for user(customer)
Route::post('/self-picking/{id}/subscribe', [SelfPickingController::class, 'subscribe'])->name('self-picking.subscribe');
//change order status on user(customer) page
Route::post('/rate-product/{id}', [OrderController::class, 'rate'])->name('rateProduct');

//for the "create(suggest) a category" page
Route::get('/createcategory', [CategoryController::class, 'showCategories'])->name('createcategory');
Route::post('/createcategory', [CategoryController::class, 'create'])->name('createCategory');

//admin page for suggested categories management
Route::get('/categories', [AdminPageController::class, 'showCategories'])->name('categorylist');
Route::post('/categories/{id}/approve', [AdminPageController::class, 'approveCategory'])->name('categoriesApprove');
Route::post('/categories/{id}/delete', [AdminPageController::class, 'deleteCategory'])->name('categoriesDelete');

