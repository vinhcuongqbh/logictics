<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NhanvienController;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\KhohangController;
use App\Http\Controllers\ChuyenhangController;
use App\Http\Controllers\DonhangController;

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
    return view('home');
});

Route::get('/admin/nhanvien', [NhanvienController::class, 'index']);
Route::get('/admin/khachhang', [KhachhangController::class, 'index']);
Route::get('/admin/khohang', [KhohangController::class, 'index']);
Route::get('/admin/chuyenhang', [ChuyenhangController::class, 'index']);
Route::get('/admin/donhang', [DonhangController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
