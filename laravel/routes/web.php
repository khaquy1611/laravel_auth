<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'user-role:user', 'checkLastLogin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'userHome'])->name('home');
});


Route::middleware(['auth', 'user-role:editor', 'checkLastLogin'])->group(function () {
    Route::get('/editor/home', [App\Http\Controllers\HomeController::class, 'editorHome'])->name('home.editor');
});

Route::middleware(['auth', 'user-role:admin', 'checkLastLogin'])->group(function () {
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('home.admin');
});
