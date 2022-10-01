<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\{RegisterController,LoginController,LogoutController,UsersController,PostsController,RolesController,PermissionsController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    /**
     * Home Routes
     */
    Route::get('/', [HomeController::class,'index'])->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', [RegisterController::class,'show'])->name('register.show');
        Route::post('/register', [RegisterController::class,'register'])->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', [LoginController::class,'show'])->name('login.show');
        Route::post('/login', [LoginController::class,'login'])->name('login.perform');

    });

    // Route::group(['middleware' => ['auth', 'permission']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', [LogoutController::class,'perform'])->name('logout.perform');

        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', [UsersController::class,'index'])->name('users.index');
            Route::get('/create', [UsersController::class,'create'])->name('users.create');
            Route::post('/create', [UsersController::class,'store'])->name('users.store');
            Route::get('/{user}/show', [UsersController::class,'show'])->name('users.show');
            Route::get('/{user}/edit', [UsersController::class,'edit'])->name('users.edit');
            Route::patch('/{user}/update', [UsersController::class,'update'])->name('users.update');
            Route::delete('/{user}/delete', [UsersController::class,'destroy'])->name('users.destroy');
        });

        /**
         * User Routes
         */
        Route::group(['prefix' => 'posts'], function() {
            Route::get('/', [PostsController::class,'index'])->name('posts.index');
            Route::get('/create', [PostsController::class,'create'])->name('posts.create');
            Route::post('/create', [PostsController::class,'store'])->name('posts.store');
            Route::get('/{post}/show', [PostsController::class,'show'])->name('posts.show');
            Route::get('/{post}/edit', [PostsController::class,'edit'])->name('posts.edit');
            Route::patch('/{post}/update', [PostsController::class,'update'])->name('posts.update');
            Route::delete('/{post}/delete', [PostsController::class,'destroy'])->name('posts.destroy');
        });

        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
    // });
});
