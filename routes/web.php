<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

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

Route::get("/", [HomeController::class,"index"])->name('index.home');
Route::get("/about-us", [HomeController::class,"about"])->name('index.about');

Route::get('/services',[ServicesController::class,'index'])->name('index.services');
Route::get('/faq',[FaqController::class,'index'])->name('index.faq');
Route::get( '/blog',[BlogController::class,'index'])->name('index.blog');
Route::get('/contact',[ContactController::class,'index'])->name('index.contact');



Route::group(['prefix'=> 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function(){
        // here we will define guest route
        Route::get('/login', [AdminLoginController::class,'index'])->name('admin.login');
        Route::post('/login', [AdminLoginController::class,'authenticate'])->name('admin.auth');
    });

    Route::group(['middleware' => 'admin.auth'], function(){
        // here we will define password protected routes

        /* Route::view('/dashboard','admin.dashboard')->name('admin.dashboard'); */
        Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
        Route::get('/logout',[AdminLoginController::class,'logout'])->name('admin.logout');
    });

});