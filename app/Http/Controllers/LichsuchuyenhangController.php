<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lichsuchuyenhang;

class LichsuchuyenhangController extends Controller
{
    public function luusukien($id_chuyenhang, $tongdonhang, $id_nhanvienquanly, $id_khogui, $id_khonhan, $id_trangthai)
    {
        //Lưu sự kiện của đơn hàng
        $lichsuchuyenhang = new Lichsuchuyenhang;
        $lichsuchuyenhang->tongdonhang = $tongdonhang;
        $lichsuchuyenhang->id_chuyenhang = $id_chuyenhang;
        $lichsuchuyenhang->id_nhanvienquanly = $id_nhanvienquanly;
        $lichsuchuyenhang->id_khogui = $id_khogui;
        $lichsuchuyenhang->id_khonhan = $id_khonhan;
        $lichsuchuyenhang->id_trangthai = $id_trangthai;
        $lichsuchuyenhang->save();
    }
}
