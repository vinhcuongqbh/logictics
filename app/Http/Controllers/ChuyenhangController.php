<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khohang;
use App\Models\Donhang;
use App\Models\Chuyenhang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ChuyenhangController extends Controller
{
    //Tạo chuyến hàng mới
    public function taochuyenhangmoi()
    {
        //Tìm id Kho hàng mà nhân viên đang đăng nhập quản lý
        $id_khohangquanly = User::find(Auth::id())->id_khohangquanly;

        //Tạo Chuyến hàng mới
        $chuyenhang = new Chuyenhang;
        $chuyenhang->id_nhanvienquanly = Auth::id();
        $chuyenhang->id_khogui = $id_khohangquanly;
        if ($id_khohangquanly > 2) {
            $chuyenhang->id_khonhan = 2;
        } else if ($id_khohangquanly == 2) {
            $chuyenhang->id_khonhan = 1;
        } else if ($id_khohangquanly == 1) {
            $chuyenhang->id_khonhan = 0;
        }
        $chuyenhang->id_trangthai = 1;
        $chuyenhang->save();

        return $chuyenhang;
    }

    //Xuất kho Chuyến hàng
    public function xuatkho($chuyenhang, $tongdonhang)
    {
        $chuyenhang->tongdonhang = $tongdonhang;
        $chuyenhang->id_trangthai = 3;
        $chuyenhang->save();
    }

    //Nhập kho Chuyến hàng
    public function nhapkho($chuyenhang, $tongdonhang)
    {
        $chuyenhang->tongdonhang = $tongdonhang;
        $chuyenhang->id_trangthai = 2;
        $chuyenhang->save();
    }


    //Danh mục Chuyến hàng đã xuất kho
    public function dmdaxuatkho()
    {
        //Tìm id Kho hàng mà nhân viên đang đăng nhập quản lý
        $id_khohangquanly = User::find(Auth::id())->id_khohangquanly;

        $chuyenhang = Chuyenhang::where('chuyenhangs.id_trangthai', 3)
            ->where('chuyenhangs.id_khogui', $id_khohangquanly)
            ->join('khohangs as khogui', 'khogui.id', 'chuyenhangs.id_khogui')
            ->leftjoin('khohangs as khonhan', 'khonhan.id', 'chuyenhangs.id_khonhan')
            ->join('users', 'users.id', 'chuyenhangs.id_nhanvienquanly')
            ->select('chuyenhangs.*', 'users.name', 'khogui.tenkhohang as khogui', 'khonhan.tenkhohang as khonhan')
            ->get();

        return view('admin.chuyenhang.dmdaxuatkho', ['chuyenhangs' => $chuyenhang]);
    }

    //Danh mục Chuyến hàng chờ nhập kho
    public function dmchonhapkho()
    {
        //Tìm id Kho hàng mà nhân viên đang đăng nhập quản lý
        $id_khohangquanly = User::find(Auth::id())->id_khohangquanly;

        $chuyenhang = Chuyenhang::where('chuyenhangs.id_trangthai', 3)
            ->where('chuyenhangs.id_khonhan', $id_khohangquanly)
            ->join('khohangs as khogui', 'khogui.id', 'chuyenhangs.id_khogui')
            ->leftjoin('khohangs as khonhan', 'khonhan.id', 'chuyenhangs.id_khonhan')
            ->join('users', 'users.id', 'chuyenhangs.id_nhanvienquanly')
            ->select('chuyenhangs.*', 'users.name', 'khogui.tenkhohang as khogui', 'khonhan.tenkhohang as khonhan')
            ->get();

        return view('admin.chuyenhang.dmchonhapkho', ['chuyenhangs' => $chuyenhang]);
    }

    //Danh mục Đơn hàng thuộc Chuyến hàng đã xuất Kho
    public function donhangdaxuatkho($id)
    {
        $donhang = Donhang::where('id_chuyenhang', $id)
            ->where('id_trangthai', 3)
            ->get();

        return view('admin.chuyenhang.donhangdaxuatkho', ['donhangs' => $donhang, 'id_chuyenhang' => $id]);
    }

    //Danh mục Đơn hàng thuộc Chuyến hàng chờ nhập Kho
    public function donhangchonhapkho($id)
    {
        $donhang = Donhang::where('id_chuyenhang', $id)
            ->where('id_trangthai', 3)
            ->get();

        return view('admin.chuyenhang.donhangchonhapkho', ['donhangs' => $donhang, 'id_chuyenhang' => $id]);
    }
}
