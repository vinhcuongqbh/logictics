<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NhanvienController;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\KhohangController;
use App\Http\Controllers\DonhangController;
use App\Http\Controllers\ChuyenhangController;
use App\Http\Controllers\ThongkeController;


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
    return view('admin.index');
})->middleware(['auth']);

Route::get('admin', function () {
    return view('admin.index');
})->middleware(['auth']);

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::group(['prefix' => 'nhanvien'], function () {
        Route::get('', [NhanvienController::class, 'index'])->name('nhanvien');
        Route::get('danghiviec', [NhanvienController::class, 'danghiviec'])->name('nhanvien.danghiviec');
        Route::get('create', [NhanvienController::class, 'create'])->name('nhanvien.create');
        Route::post('store', [NhanvienController::class, 'store'])->name('nhanvien.store');
        Route::get('{id}', [NhanvienController::class, 'show'])->name('nhanvien.show');
        Route::get('{id}/edit', [NhanvienController::class, 'edit'])->name('nhanvien.edit');
        Route::post('{id}/update', [NhanvienController::class, 'update'])->name('nhanvien.update');
        Route::get('{id}/delete', [NhanvienController::class, 'delete'])->name('nhanvien.delete');
        Route::get('{id}/restore', [NhanvienController::class, 'restore'])->name('nhanvien.restore');
    });
    Route::group(['prefix' => 'khachhang'], function () {
        Route::get('', [KhachhangController::class, 'index'])->name('khachhang');
        Route::get('daxoa', [KhachhangController::class, 'daxoa'])->name('khachhang.daxoa');
        Route::get('create', [KhachhangController::class, 'create'])->name('khachhang.create');
        Route::post('store', [KhachhangController::class, 'store'])->name('khachhang.store');
        Route::get('{id}/', [KhachhangController::class, 'show'])->name('khachhang.show');
        Route::get('{id}/edit', [KhachhangController::class, 'edit'])->name('khachhang.edit');
        Route::post('{id}/update', [KhachhangController::class, 'update'])->name('khachhang.update');
        Route::get('{id}/delete', [KhachhangController::class, 'delete'])->name('khachhang.delete');
        Route::get('{id}/restore', [KhachhangController::class, 'restore'])->name('khachhang.restore');
    });

    Route::group(['prefix' => 'khohang'], function () {
        Route::get('', [KhohangController::class, 'index'])->name('khohang');
        Route::get('tamdung', [KhohangController::class, 'tamdung'])->name('khohang.tamdung');
        Route::get('create', [KhohangController::class, 'create'])->name('khohang.create');
        Route::post('store', [KhohangController::class, 'store'])->name('khohang.store');
        Route::get('{id}/', [KhohangController::class, 'show'])->name('khohang.show');
        Route::get('{id}/edit', [KhohangController::class, 'edit'])->name('khohang.edit');
        Route::post('{id}/update', [KhohangController::class, 'update'])->name('khohang.update');
        Route::get('{id}/delete', [KhohangController::class, 'delete'])->name('khohang.delete');
        Route::get('{id}/restore', [KhohangController::class, 'restore'])->name('khohang.restore');
    });

    Route::group(['prefix' => 'donhang'], function () {
        Route::get('dmdangluukho', [DonhangController::class, 'dmdangluukho'])->name('donhang.dmdangluukho');
        Route::get('dmdaxuatkho', [DonhangController::class, 'dmdaxuatkho'])->name('donhang.dmdaxuatkho');
        Route::post('xuatkho', [DonhangController::class, 'xuatkho'])->name('donhang.xuatkho');
        Route::get('xuattoanbokho', [DonhangController::class, 'xuattoanbokho'])->name('donhang.xuattoanbokho');
        Route::post('nhapkho', [DonhangController::class, 'nhapkho'])->name('donhang.nhapkho');
        Route::get('{id}/thatlac', [DonhangController::class, 'thatlac'])->name('donhang.thatlac');

        Route::get('create', [DonhangController::class, 'create'])->name('donhang.create');
        Route::post('store', [DonhangController::class, 'store'])->name('donhang.store');
        Route::get('{id}/show', [DonhangController::class, 'show'])->name('donhang.show');
        Route::get('{id}/edit', [DonhangController::class, 'edit'])->name('donhang.edit');
        Route::get('{id}/delete', [DonhangController::class, 'delete'])->name('donhang.delete');
        Route::get('{id}/restore', [DonhangController::class, 'restore'])->name('donhang.restore');
        Route::get('{id}/lichsudonhang', [DonhangController::class, 'lichsudonhang'])->name('donhang.lichsudonhang');

    });

    Route::group(['prefix' => 'chuyenhang'], function () {
        Route::get('dmdaxuatkho', [ChuyenhangController::class, 'dmdaxuatkho'])->name('chuyenhang.dmdaxuatkho');
        Route::get('dmchonhapkho', [ChuyenhangController::class, 'dmchonhapkho'])->name('chuyenhang.dmchonhapkho');
        Route::get('{id}/donhangdaxuatkho', [ChuyenhangController::class, 'donhangdaxuatkho'])->name('chuyenhang.donhangdaxuatkho');
        Route::get('{id}/donhangchonhapkho', [ChuyenhangController::class, 'donhangchonhapkho'])->name('chuyenhang.donhangchonhapkho');

        Route::get('{id}/daxuatkho', [ChuyenhangController::class, 'daxuatkho'])->name('chuyenhang.daxuatkho');
        Route::get('{id}/danhapkho', [ChuyenhangController::class, 'danhapkho'])->name('chuyenhang.danhapkho');
        Route::post('{id}/lichsuchuyenhang', [ChuyenhangController::class, 'lichsuchuyenhang'])->name('chuyenhang.lichsuchuyenhang');
    });

    Route::group(['prefix' => 'thongke'], function () {
        Route::get('thongkedonhangtheonam', [ThongkeController::class, 'thongkedonhangtheonam'])->name('thongke.thongkedonhangtheonam');       
        Route::get('thongkedonhangtheotuan', [ThongkeController::class, 'thongkedonhangtheotuan'])->name('thongke.thongkedonhangtheotuan');       
    });

});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
