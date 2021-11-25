<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lichsuchuyenhang;

class LichsuchuyenhangController extends Controller
{
    public function luusukien($id_chuyenhang, $machuyenhang, $ngaygui, $ngaynhan, $tongdonhang, $id_nhanvienquanly, $id_khogui, $id_khonhan, $id_trangthai)
    {
        //Lưu sự kiện của Chuyến hàng
        $lichsuchuyenhang = new Lichsuchuyenhang;
        $lichsuchuyenhang->ngaygui = $ngaygui;
        $lichsuchuyenhang->ngaynhan = $ngaynhan;
        $lichsuchuyenhang->tongdonhang = $tongdonhang;
        $lichsuchuyenhang->id_chuyenhang = $id_chuyenhang;
        $lichsuchuyenhang->machuyenhang = $machuyenhang;
        $lichsuchuyenhang->id_nhanvienquanly = $id_nhanvienquanly;
        $lichsuchuyenhang->id_khogui = $id_khogui;
        $lichsuchuyenhang->id_khonhan = $id_khonhan;
        $lichsuchuyenhang->id_trangthai = $id_trangthai;
        $lichsuchuyenhang->save();
    }


    public function xoasukien($id_chuyenhang, $id_trangthai)
    {
        //Xóa sự kiện của Chuyến hàng
        $lichsuchuyenhang = Lichsuchuyenhang::where('id_chuyenhang', $id_chuyenhang)
                            ->where('id_trangthai', $id_trangthai)
                            ->get();
        foreach ($lichsuchuyenhang as $i) {
            $i->delete();
        }        
    }
}
