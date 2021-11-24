<?php

namespace App\Http\Controllers;

use App\Models\Donhang;
use App\Models\Chuyenhang;
use App\Models\Lichsudonhang;
use App\Models\Lichsuchuyenhang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChuyenhangController extends Controller
{
    //Tạo Chuyến hàng mới
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
        $chuyenhang->tongdonhang = 0;
        $chuyenhang->id_trangthai = 1;
        $chuyenhang->save();

        return $chuyenhang;
    }

    //Xuất kho Chuyến hàng
    public function xuatkho($chuyenhang, $tongdonhang)
    {
        $chuyenhang->tongdonhang = $tongdonhang;
        $chuyenhang->id_trangthai = 3;
        $chuyenhang->ngaygui = Carbon::now();
        $chuyenhang->save();
    }

    //Nhập kho Chuyến hàng
    public function nhapkho($chuyenhang, $tongdonhang)
    {
        $chuyenhang->tongdonhang = $tongdonhang;
        $chuyenhang->id_trangthai = 2;
        $chuyenhang->ngaynhan = Carbon::now();
        $chuyenhang->save();
    }

    //Hoàn lại Chuyến hàng
    public function hoanlai($chuyenhang)
    {
        $lichsuchuyenhang = Lichsuchuyenhang::where('id_chuyenhang', $chuyenhang->id)
            ->where('id_trangthai', 3)
            ->first();

        $chuyenhang->ngaynhan = $lichsuchuyenhang->ngaynhan;
        $chuyenhang->id_khogui = $lichsuchuyenhang->id_khogui;
        $chuyenhang->id_trangthai = $lichsuchuyenhang->id_trangthai;
        $chuyenhang->save();
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

    //Danh mục Chuyến hàng đã nhập kho
    public function dmdanhapkho()
    {
        //Tìm id Kho hàng mà nhân viên đang đăng nhập quản lý
        $id_khohangquanly = User::find(Auth::id())->id_khohangquanly;

        $chuyenhang = Lichsuchuyenhang::where('lichsuchuyenhangs.id_trangthai', 2)
            ->where('lichsuchuyenhangs.id_khonhan', $id_khohangquanly)
            ->join('khohangs as khogui', 'khogui.id', 'lichsuchuyenhangs.id_khogui')
            ->leftjoin('khohangs as khonhan', 'khonhan.id', 'lichsuchuyenhangs.id_khonhan')
            ->join('users', 'users.id', 'lichsuchuyenhangs.id_nhanvienquanly')
            ->join('chuyenhangs', 'chuyenhangs.id', 'lichsuchuyenhangs.id_chuyenhang')
            ->select('lichsuchuyenhangs.*', 'users.name', 'khogui.tenkhohang as khogui', 'khonhan.tenkhohang as khonhan', 'chuyenhangs.ngaygui', 'chuyenhangs.ngaynhan')
            ->get();

        return view('admin.chuyenhang.dmdanhapkho', ['chuyenhangs' => $chuyenhang]);
    }

    //Danh mục Chuyến hàng đã xuất kho
    public function dmdaxuatkho()
    {
        //Tìm id Kho hàng mà nhân viên đang đăng nhập quản lý
        $id_khohangquanly = User::find(Auth::id())->id_khohangquanly;

        $chuyenhang = Lichsuchuyenhang::where('lichsuchuyenhangs.id_trangthai', 3)
            ->where('lichsuchuyenhangs.id_khogui', $id_khohangquanly)
            ->join('khohangs as khogui', 'khogui.id', 'lichsuchuyenhangs.id_khogui')
            ->leftjoin('khohangs as khonhan', 'khonhan.id', 'lichsuchuyenhangs.id_khonhan')
            ->join('users', 'users.id', 'lichsuchuyenhangs.id_nhanvienquanly')
            ->join('chuyenhangs', 'chuyenhangs.id', 'lichsuchuyenhangs.id_chuyenhang')
            ->select('lichsuchuyenhangs.*', 'users.name', 'khogui.tenkhohang as khogui', 'khonhan.tenkhohang as khonhan', 'chuyenhangs.ngaygui', 'chuyenhangs.ngaynhan')
            ->get();

        return view('admin.chuyenhang.dmdaxuatkho', ['chuyenhangs' => $chuyenhang]);
    }

    //Danh mục Đơn hàng thuộc Chuyến hàng đã xuất Kho
    public function donhangdaxuatkho($id)
    {
        $donhang = Lichsudonhang::where('lichsudonhangs.id_chuyenhang', $id)
            ->where('lichsudonhangs.id_trangthai', 3)
            ->join('donhangs', 'donhangs.id', 'lichsudonhangs.id_donhang')
            ->get();

        $donhang2 = Donhang::where('donhangs.id_trangthai', 2)
            ->where('donhangs.id_khogui', User::find(Auth::id())->id_khohangquanly)
            ->orderBy('id', 'desc')
            ->get();

        $chuyenhang = Chuyenhang::find($id);

        return view('admin.chuyenhang.donhangdaxuatkho', ['donhangs' => $donhang, 'donhang2s' => $donhang2, 'chuyenhang' => $chuyenhang]);
    }


    //Danh mục Đơn hàng thuộc Chuyến hàng đã nhập Kho
    public function donhangdanhapkho($id)
    {
        $donhang = Lichsudonhang::where('lichsudonhangs.id_chuyenhang', $id)
            ->where('lichsudonhangs.id_trangthai', 2)
            ->join('donhangs', 'donhangs.id', 'lichsudonhangs.id_donhang')
            ->get();



        return view('admin.chuyenhang.donhangdanhapkho', ['donhangs' => $donhang, 'id_chuyenhang' => $id]);
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
