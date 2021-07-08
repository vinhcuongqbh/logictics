<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donhang;
use App\Models\Dongia;
use App\Models\Khohang;
use App\Models\Chuyenhang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DonhangController extends Controller
{

    public function create()
    {
        $dongia = Dongia::all();

        return view('admin.donhang.create', ['dongias' => $dongia]);
    }

    public function xuatkho(Request $request)
    {
        //Tạo chuyến hàng mới
        $chuyenhangController = new ChuyenhangController;
        $chuyenhang = $chuyenhangController->taochuyenhangmoi();

        //Cập nhật thông tin xuất kho cho Đơn hàng
        $id_donhangsduocchon = $request->input('id_donhangduocchon');
        if ($id_donhangsduocchon <> null) {
            foreach ($id_donhangsduocchon as $id_donhangduocchon) {
                //Cập nhật thông tin xuất kho cho từng Đơn hàng
                $donhang = Donhang::find($id_donhangduocchon);
                $donhang->id_khonhan = $chuyenhang->id_khonhan;
                $donhang->id_chuyenhang = $chuyenhang->id;
                $donhang->id_trangthai = 3;
                $donhang->save();

                //Lưu sự kiện cho từng Đơn hàng
                $lichsudonhangController = new LichsudonhangController;
                $lichsudonhangController->luusukien($donhang->id, $donhang->id_nhanvienquanly, $donhang->id_khogui, $donhang->id_khonhan, $donhang->id_trangthai);
            }

            //Cập nhật thông tin xuất kho cho Chuyến hàng
            $chuyenhangController->xuatkho($chuyenhang);

            //Lưu sự kiện cho Chuyến hàng
            $lichsuchuyenhangController = new LichsuchuyenhangController;
            $lichsuchuyenhangController->luusukien($chuyenhang->id, $chuyenhang->id_nhanvienquanly, $chuyenhang->id_khogui, $chuyenhang->id_khonhan, $chuyenhang->id_trangthai);
        }

        return back();
        //return redirect()->route('donhang.dmdangluukho');
    }


    public function nhapkho(Request $request)
    {
        //Tìm Chuyến hàng
        $chuyenhang = Chuyenhang::find($request->id_chuyenhang);

        //Cập nhật thông tin nhập kho cho Chuyến hàng
        $chuyenhangController = new ChuyenhangController;
        $chuyenhangController->nhapkho($chuyenhang);

        $donhangs = Donhang::where('id_chuyenhang', $request->id_chuyenhang)
            ->where('id_trangthai', 3)
            ->get();

        //Cập nhật thông tin nhập kho cho từng Đơn hàng
        foreach ($donhangs as $donhang) {
            $donhang->id_nhanvienquanly = Auth::id();
            $donhang->id_chuyenhang = null;
            $donhang->id_khogui = User::find(Auth::id())->id_khohangquanly;
            $donhang->id_khonhan = 998;
            $donhang->id_trangthai = 2;
            $donhang->save();

                //Lưu sự kiện cho từng Đơn hàng
                $lichsudonhangController = new LichsudonhangController;
                $lichsudonhangController->luusukien($donhang->id, $donhang->id_nhanvienquanly, $donhang->id_khogui, $donhang->id_khonhan, $donhang->id_trangthai);
            }

            //Lưu sự kiện cho Chuyến hàng
            $lichsuchuyenhangController = new LichsuchuyenhangController;
            $lichsuchuyenhangController->luusukien($chuyenhang->id, $chuyenhang->id_nhanvienquanly, $chuyenhang->id_khogui, $chuyenhang->id_khonhan, $chuyenhang->id_trangthai);

        return back();
        //return redirect()->route('donhang.dmdangluukho');
    }


    //Danh sách Đơn hàng đang lưu Kho
    public function dmdangluukho()
    {
        $donhang = Donhang::where('donhangs.id_trangthai', 2)
            ->where('donhangs.id_khogui', User::find(Auth::id())->id_khohangquanly)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.donhang.dmdangluukho', ['donhangs' => $donhang]);
    }

    //Danh sách Đơn hàng đã xuất Kho
    public function dmdaxuatkho()
    {
        $donhang = Donhang::where('donhangs.id_trangthai', 3)
            ->where('donhangs.id_khogui', User::find(Auth::id())->id_khohangquanly)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.donhang.dmdaxuatkho', ['donhangs' => $donhang]);
    }

    public function lichsudonhang($id)
    {

        $lichsudonhangController = new LichsudonhangController;
        $lichsudonhang = $lichsudonhangController->lichsudonhang($id);

        return view('admin.donhang.lichsudonhang', ['lichsudonhangs' => $lichsudonhang]);
    }

    //Xóa đơn hàng
    public function delete($id)
    {
        $donhang = Donhang::find($id);
        $donhang->id_trangthai = 0;
        $donhang->save();

        return back();
    }
}
