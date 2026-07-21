<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'frontend',
    'namespace' => 'App\Http\Controllers\Frontend',
], function () {
    Route::get('/home', [App\Http\Controllers\Frontend\HomeController::class, 'index']);

    Route::get('/register', [App\Http\Controllers\Frontend\MemberController::class, 'register']);
    Route::post('/register', [App\Http\Controllers\Frontend\MemberController::class, 'PostRegister'])->name('register.post');

    Route::get('/login', [App\Http\Controllers\Frontend\MemberController::class, 'login']);
    Route::post('/login', [App\Http\Controllers\Frontend\MemberController::class, 'PostLogin'])->name('login.post');
    
    Route::get('/logout', [App\Http\Controllers\Frontend\MemberController::class, 'logout']);

    Route::get('/blog/list', [App\Http\Controllers\Frontend\BlogController::class, 'list']);
    Route::get('/blog/detail', [App\Http\Controllers\Frontend\BlogController::class, 'detail']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Admin',
], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::get('/profile', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::post('/profile', [App\Http\Controllers\Admin\UserController::class, 'UpdateProfile'])->name('profile.update');

    Route::get('/country', [App\Http\Controllers\Admin\CountryController::class, 'index']);
    Route::get('/country/create', [App\Http\Controllers\Admin\CountryController::class, 'create']);
    Route::post('/country/create', [App\Http\Controllers\Admin\CountryController::class, 'store'])->name('country.store');
    Route::get('/country/delete/{id}', [App\Http\Controllers\Admin\CountryController::class, 'delete'])->name('country.delete');

    Route::get('/blog', [App\Http\Controllers\Admin\BlogController::class, 'index']);
    Route::get('/blog/create', [App\Http\Controllers\Admin\BlogController::class, 'create']);
    Route::post('/blog/create', [App\Http\Controllers\Admin\BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/update/{id}', [App\Http\Controllers\Admin\BlogController::class, 'edit']);
    Route::post('/blog/update/{id}', [App\Http\Controllers\Admin\BlogController::class, 'update'])->name('blog.update');
    Route::get('/blog/delete/{id}', [App\Http\Controllers\Admin\BlogController::class, 'delete'])->name('blog.delete');
});
    