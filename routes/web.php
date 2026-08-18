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

    Route::get('/product-detail/{id}', [App\Http\Controllers\Frontend\HomeController::class, 'detail'])->name('product.detail');
    
    //Search
    Route::get('/product/search', [App\Http\Controllers\Frontend\HomeController::class, 'SearchName'])->name('frontend.search'); 
    Route::get('/product/search-price', [App\Http\Controllers\Frontend\HomeController::class, 'SearchPrice'])->name('frontend.search-price');

    //cart
    Route::get('/cart/buy', [App\Http\Controllers\Frontend\CartController::class, 'AddCart'])->name('frontend.cart.add');
    Route::get('/cart-product', [App\Http\Controllers\Frontend\CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/update', [App\Http\Controllers\Frontend\CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/delete', [App\Http\Controllers\Frontend\CartController::class, 'deleteCart'])->name('cart.delete');
    Route::get('/cart/checkout', [App\Http\Controllers\Frontend\CartController::class, 'checkout'])->name('cart.checkout');

    //email
    Route::get('/send-email', [App\Http\Controllers\MailController::class, 'index'])->name('email.send');

    //blog
    Route::get('/blog/list', [App\Http\Controllers\Frontend\BlogController::class, 'list']);
    Route::get('/blog/detail/{id}', [App\Http\Controllers\Frontend\BlogController::class, 'detail']);
    Route::post('/blog/detail/rate', [App\Http\Controllers\Frontend\BlogController::class, 'rate'])->name('blog.rate');
    Route::post('/blog/detail/comment', [App\Http\Controllers\Frontend\BlogController::class, 'comment'])->name('blog.comment');
    

    Route::group(['middleware' => 'memberNotLogin'], function () {

        Route::get('/register', [App\Http\Controllers\Frontend\MemberController::class, 'register']);
        Route::post('/register', [App\Http\Controllers\Frontend\MemberController::class, 'PostRegister'])->name('register.post');

        Route::get('/login', [App\Http\Controllers\Frontend\MemberController::class, 'login']);
        Route::post('/login', [App\Http\Controllers\Frontend\MemberController::class, 'PostLogin'])->name('login.post');
    });

    Route::group(['middleware' => 'member'], function () {
        
        //member
        Route::get('/account/update', [App\Http\Controllers\Frontend\MemberController::class, 'profile']);
        Route::post('/account/update', [App\Http\Controllers\Frontend\MemberController::class, 'update'])->name('account.update');
        Route::get('/logout', [App\Http\Controllers\Frontend\MemberController::class, 'logout']);

        //product
        Route::get('/account/my-product', [App\Http\Controllers\Frontend\ProductController::class, 'index'])->name('product.list');
        Route::get('/account/create-product', [App\Http\Controllers\Frontend\ProductController::class, 'create']);
        Route::post('/account/create-product', [App\Http\Controllers\Frontend\ProductController::class, 'addProduct'])->name('product.create');
        Route::get('/account/update-product/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'edit']);
        Route::post('/account/update-product/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'update'])->name('product.update');
        Route::get('/account/delete-product/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'delete'])->name('product.delete');
        
        //blog
        
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['admin']
], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::get('/profile', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::post('/profile', [App\Http\Controllers\Admin\UserController::class, 'UpdateProfile'])->name('profile.update');

    Route::get('/country', [App\Http\Controllers\Admin\CountryController::class, 'index']);
    Route::get('/country/create', [App\Http\Controllers\Admin\CountryController::class, 'create']);
    Route::post('/country/create', [App\Http\Controllers\Admin\CountryController::class, 'store'])->name('country.store');
    Route::get('/country/delete/{id}', [App\Http\Controllers\Admin\CountryController::class, 'delete'])->name('country.delete');

    Route::get('/brand', [App\Http\Controllers\Admin\BrandController::class, 'listbrand']);
    Route::get('/brand/create', [App\Http\Controllers\Admin\BrandController::class, 'index']);
    Route::post('/brand/create', [App\Http\Controllers\Admin\BrandController::class, 'create'])->name('brand.create');
    Route::get('/brand/delete/{id}', [App\Http\Controllers\Admin\BrandController::class, 'delete'])->name('brand.delete');

    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'listcategory']);
    Route::get('/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::post('/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
    Route::get('/category/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/blog', [App\Http\Controllers\Admin\BlogController::class, 'index']);
    Route::get('/blog/create', [App\Http\Controllers\Admin\BlogController::class, 'create']);
    Route::post('/blog/create', [App\Http\Controllers\Admin\BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/update/{id}', [App\Http\Controllers\Admin\BlogController::class, 'edit']);
    Route::post('/blog/update/{id}', [App\Http\Controllers\Admin\BlogController::class, 'update'])->name('blog.update');
    Route::get('/blog/delete/{id}', [App\Http\Controllers\Admin\BlogController::class, 'delete'])->name('blog.delete');
});
    