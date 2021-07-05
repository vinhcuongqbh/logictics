<?php

namespace App\Http\Controllers;

use App\Models\Lichsudonhang;
use Illuminate\Http\Request;

class LichsudonhangController extends Controller
{
    public function index($id)
    {
        //Hiển thị Lịch sử đơn hàng
        $lichsudonhang = Lichsudonhang::where('id_donhang', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.lichsudonhang.index', ['lichsudonhangs' => $lichsudonhang]);
    }

    public function luusukien($id_donhang, $id_nhanvienquanly, $id_khogui, $id_khonhan, $id_trangthai)
    {
        //Lưu sự kiện của đơn hàng
        $lichsudonhang = new Lichsudonhang;
        $lichsudonhang->id_donhang = $id_donhang;
        $lichsudonhang->id_nhanvienquanly = $id_nhanvienquanly;
        $lichsudonhang->id_khogui = $id_khogui;
        $lichsudonhang->id_khonhan = $id_khonhan;
        $lichsudonhang->id_trangthai = $id_trangthai;
        $lichsudonhang->save();
    }

    public function lichsudonhang($id_donhang)
    {
        $lichsudonhang = Lichsudonhang::where('lichsudonhangs.id_donhang', $id_donhang)
            ->join('trangthais', 'trangthais.id', 'lichsudonhangs.id_trangthai')
            ->join('khohangs as khogui', 'khogui.id', 'lichsudonhangs.id_khogui')
            ->join('khohangs as khonhan', 'khonhan.id', 'lichsudonhangs.id_khonhan')
            ->select('lichsudonhangs.*', 'trangthais.tentrangthai', 'khogui.tenkhohang as khogui', 'khogui.diachi as diachikhogui', 'khonhan.tenkhohang as khonhan', 'khonhan.diachi as diachikhonhan')
            ->orderBy('id', 'asc')
            ->get();

        return $lichsudonhang;
    }
}
