<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhohangController;
use App\Http\Controllers\NhanvienController;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\DongiatinhtheokhoiluongController;
use App\Http\Controllers\DongiatinhtheosoluongController;
use App\Http\Controllers\DonhangController;
use App\Http\Controllers\ChuyenhangController;
use App\Http\Controllers\ThongkedonhangController;
use App\Http\Controllers\ThongkedoanhthuController;
use App\Http\Controllers\ThongkeloinhuanController;


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

Route::get('/', [ThongkedonhangController::class, 'thongKeDonHangDashBoard'])->middleware(['auth']);
Route::get('/dashboard', [ThongkedonhangController::class, 'thongKeDonHangDashBoard'])->middleware(['auth']);


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('', [ThongkedonhangController::class, 'thongKeDonHangDashBoard']);

    Route::group(['prefix' => 'khohang'], function () {
        Route::get('', [KhohangController::class, 'index'])->name('khohang');
        Route::get('tamdung', [KhohangController::class, 'tamdung'])->name('khohang.tamdung');
        Route::get('create', [KhohangController::class, 'create'])->name('khohang.create');
        Route::post('store', [KhohangController::class, 'store'])->name('khohang.store');
        Route::get('{id}/', [KhohangController::class, 'show'])->name('khohang.show');
        Route::get('{id}/edit', [KhohangController::class, 'edit'])->name('khohang.edit');
        Route::post('{id}/update', [KhohangController::class, 'update'])->name('khohang.update');
        Route::get('{id}/delete', [KhohangController::class, 'destroy'])->name('khohang.delete');
        Route::get('{id}/restore', [KhohangController::class, 'restore'])->name('khohang.restore');
    });
    
    Route::group(['prefix' => 'dongia'], function () {
        Route::group(['prefix' => 'dongiatinhtheokhoiluong'], function () {
            Route::get('', [DongiatinhtheokhoiluongController::class, 'index'])->name('dongiatinhtheokhoiluong');
            Route::get('create', [DongiatinhtheokhoiluongController::class, 'create'])->name('dongiatinhtheokhoiluong.create');
            Route::post('store', [DongiatinhtheokhoiluongController::class, 'store'])->name('dongiatinhtheokhoiluong.store');
            Route::get('{id}/', [DongiatinhtheokhoiluongController::class, 'show'])->name('dongiatinhtheokhoiluong.show');
            Route::get('{id}/edit', [DongiatinhtheokhoiluongController::class, 'edit'])->name('dongiatinhtheokhoiluong.edit');
            Route::post('{id}/update', [DongiatinhtheokhoiluongController::class, 'update'])->name('dongiatinhtheokhoiluong.update');
            Route::get('{id}/delete', [DongiatinhtheokhoiluongController::class, 'destroy'])->name('dongiatinhtheokhoiluong.delete');
            Route::get('{id}/restore', [DongiatinhtheokhoiluongController::class, 'restore'])->name('dongiatinhtheokhoiluong.restore');
        });

        Route::group(['prefix' => 'dongiatinhtheosoluong'], function () {
            Route::get('', [DongiatinhtheosoluongController::class, 'index'])->name('dongiatinhtheosoluong');
            Route::get('create', [DongiatinhtheosoluongController::class, 'create'])->name('dongiatinhtheosoluong.create');
            Route::post('store', [DongiatinhtheosoluongController::class, 'store'])->name('dongiatinhtheosoluong.store');
            Route::get('{id}/', [DongiatinhtheosoluongController::class, 'show'])->name('dongiatinhtheosoluong.show');
            Route::get('{id}/edit', [DongiatinhtheosoluongController::class, 'edit'])->name('dongiatinhtheosoluong.edit');
            Route::post('{id}/update', [DongiatinhtheosoluongController::class, 'update'])->name('dongiatinhtheosoluong.update');
            Route::get('{id}/delete', [DongiatinhtheosoluongController::class, 'destroy'])->name('dongiatinhtheosoluong.delete');
            Route::get('{id}/restore', [DongiatinhtheosoluongController::class, 'restore'])->name('dongiatinhtheosoluong.restore');
        });
    });

    Route::group(['prefix' => 'nhanvien'], function () {
        Route::get('', [NhanvienController::class, 'index'])->name('nhanvien');
        Route::get('danghiviec', [NhanvienController::class, 'danghiviec'])->name('nhanvien.danghiviec');
        Route::get('create', [NhanvienController::class, 'create'])->name('nhanvien.create');
        Route::post('store', [NhanvienController::class, 'store'])->name('nhanvien.store');
        Route::get('{id}', [NhanvienController::class, 'show'])->name('nhanvien.show');
        Route::get('{id}/edit', [NhanvienController::class, 'edit'])->name('nhanvien.edit');
        Route::post('{id}/update', [NhanvienController::class, 'update'])->name('nhanvien.update');
        Route::get('{id}/delete', [NhanvienController::class, 'destroy'])->name('nhanvien.delete');
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
        Route::get('{id}/delete', [KhachhangController::class, 'destroy'])->name('khachhang.delete');
        Route::get('{id}/restore', [KhachhangController::class, 'restore'])->name('khachhang.restore');
    });

    Route::group(['prefix' => 'donhang'], function () {
        Route::get('dmdangluukho', [DonhangController::class, 'dmdangluukho'])->name('donhang.dmdangluukho');
        Route::get('dmdaxuatkho', [DonhangController::class, 'dmdaxuatkho'])->name('donhang.dmdaxuatkho');
        Route::get('dmthatlac', [DonhangController::class, 'dmthatlac'])->name('donhang.dmthatlac');
        Route::get('tracuu', [DonhangController::class, 'tracuu'])->name('donhang.tracuu');    
        Route::post('ketquatracuu', [DonhangController::class, 'ketquatracuu'])->name('donhang.ketquatracuu');
        Route::post('xuatkho', [DonhangController::class, 'xuatkho'])->name('donhang.xuatkho');
        Route::get('xuattoanbokho', [DonhangController::class, 'xuattoanbokho'])->name('donhang.xuattoanbokho');
        Route::post('nhapkho', [DonhangController::class, 'nhapkho'])->name('donhang.nhapkho');
        Route::get('{id}/thatlac', [DonhangController::class, 'thatlac'])->name('donhang.thatlac');
        Route::get('create', [DonhangController::class, 'create'])->name('donhang.create');
        Route::post('store', [DonhangController::class, 'store'])->name('donhang.store');
        Route::get('{id}/show', [DonhangController::class, 'show'])->name('donhang.show');
        Route::get('{id}/edit', [DonhangController::class, 'edit'])->name('donhang.edit');
        Route::post('{id}/update', [DonhangController::class, 'update'])->name('donhang.update');
        Route::get('{id}/delete', [DonhangController::class, 'destroy'])->name('donhang.delete');
        Route::get('{id}/restore', [DonhangController::class, 'restore'])->name('donhang.restore');
        Route::get('{id}/lichsudonhang', [DonhangController::class, 'lichsudonhang'])->name('donhang.lichsudonhang');
    });

    Route::group(['prefix' => 'chuyenhang'], function () {        
        Route::get('dmchonhapkho', [ChuyenhangController::class, 'dmchonhapkho'])->name('chuyenhang.dmchonhapkho');
        Route::get('dmdanhapkho', [ChuyenhangController::class, 'dmdanhapkho'])->name('chuyenhang.dmdanhapkho');
        Route::get('dmdaxuatkho', [ChuyenhangController::class, 'dmdaxuatkho'])->name('chuyenhang.dmdaxuatkho');
        Route::get('{id}/donhangchonhapkho', [ChuyenhangController::class, 'donhangchonhapkho'])->name('chuyenhang.donhangchonhapkho');
        Route::get('{id}/donhangdaxuatkho', [ChuyenhangController::class, 'donhangdaxuatkho'])->name('chuyenhang.donhangdaxuatkho');
        Route::get('{id}/donhangdanhapkho', [ChuyenhangController::class, 'donhangdanhapkho'])->name('chuyenhang.donhangdanhapkho');
        Route::get('{id}/daxuatkho', [ChuyenhangController::class, 'daxuatkho'])->name('chuyenhang.daxuatkho');
        Route::get('{id}/danhapkho', [ChuyenhangController::class, 'danhapkho'])->name('chuyenhang.danhapkho');
        Route::post('{id}/lichsuchuyenhang', [ChuyenhangController::class, 'lichsuchuyenhang'])->name('chuyenhang.lichsuchuyenhang');
    });

    Route::group(['prefix' => 'thongke'], function () {
        Route::get('thongkedonhang', [ThongkedonhangController::class, 'thongKeDonHangDashBoard'])->name('thongke.thongKeDonHangDashBoard');
        Route::get('thongkedoanhthu', [ThongkedoanhthuController::class, 'thongKeDoanhThuDashBoard'])->name('thongke.thongKeDoanhThuDashBoard');
        Route::get('thongkeloinhuan', [ThongkeloinhuanController::class, 'thongKeLoiNhuanDashBoard'])->name('thongke.thongKeLoiNhuanDashBoard');
    });
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
