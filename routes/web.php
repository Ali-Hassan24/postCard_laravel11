<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('posts.index');
})->name('home');

 Route::redirect('/','posts');
Route::resource('posts', PostController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/{user}/posts',[DashboardController::class,'userPosts'])->name('posts.user');
Route::middleware('auth')->group(function(){
    // user dashboard 
// Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
// Route::view('/dashboard','users.dashboard')->middleware('auth')->name('dashboard');

// logout 
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function(){
    // register 
Route::view('/register','auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);
// login 
Route::view('/login','auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);
// forgot password
Route::view('/forgot-password','auth.forgot-password')->name('password.request');

Route::post('/forgot-password',[RestPasswordController::class,'passwordEmail']);

Route::get('/reset-password/{token}', [RestPasswordController::class,'passwordRest'])->name('passwprd.reset');

Route::post('/reset-password', [RestPasswordController::class,'passwordUpdate'] )->name('password.update');


});

