<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ThongketonghopController extends Controller
{
    public function thongKeTongHopDashBoard(Request $request)
    {      
        $nhanvien = User::all();
        $id_nhanvien = $request->nhanvien;
        return view('admin.thongke.thongketonghop', [
            'nhanviens' =>  $nhanvien,   
            'id_nhanvien' => $id_nhanvien,        
        ]);
    }


    //Kết quả thống kê
    public function ketQuaThongKe(Request $request)
    {
        $nhanvien = User::all();
        $id_nhanvien = $request->nhanvien;
        $ngayBatDau = new Carbon($request->ngaybatdau);
        $ngayKetThuc = new Carbon($request->ngayketthuc);

        $thongke = new ThongkedonhangController;
        $sodonhangdanhan = $thongke->thongKeDonHang($id_nhanvien, $ngayBatDau, $ngayKetThuc);
        echo $sodonhangdanhan;
        return view('admin.thongke.ketquathongke',[ 
            'nhanviens' => $nhanvien,
            'id_nhanvien' => $id_nhanvien,
            '$sodonhangdanhan' => $sodonhangdanhan,
        ]);
    }
}
