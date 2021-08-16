<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Donhang;
use App\Models\Khachhang;
use App\Models\Lichsudonhang;
use App\Models\Chuyenhang;
use App\Models\Dongiatinhtheokhoiluong;
use App\Models\Dongiatinhtheosoluong;
use App\Models\Dongiahangcongkenh;
use App\Models\Chitietdonhang;


class DonhangController extends Controller
{

    public function create()
    {
        $dongiatinhtheokhoiluong = Dongiatinhtheokhoiluong::orderBy('khoiluongmax', 'desc')->get();
        $dongiatinhtheosoluong = Dongiatinhtheosoluong::all();
        $dongiahangcongkenh = Dongiahangcongkenh::all();
        $tilechietkhau = Auth::user()->tilechietkhau;

        return view(
            'admin.donhang.create',
            [
                'dongiatinhtheokhoiluong' => $dongiatinhtheokhoiluong,
                'dongiatinhtheosoluong' => $dongiatinhtheosoluong,
                'dongiahangcongkenh' => $dongiahangcongkenh,
                'tilechietkhau' => $tilechietkhau,
            ]
        );
    }

    public function store(Request $request)
    {
        //Lưu thông tin người gửi
        $khachhang = new Khachhang;
        $khachhang->tenkhachhang = $request->tennguoigui;
        $khachhang->sodienthoai = $request->sodienthoainguoigui;
        $khachhang->diachi = $request->diachinguoigui;
        $khachhang->email = $request->emailnguoigui;
        $khachhang->id_nhanvienquanly = Auth::id();
        $khachhang->id_trangthai = 1;
        $khachhang->save();

        // //Lưu thông tin người nhận
        // $khachhang = new Khachhang;
        // $khachhang->tenkhachhang = $request->tennguoinhan;
        // $khachhang->sodienthoai = $request->sodienthoainguoinhan;
        // $khachhang->diachi = $request->diachinguoinhan;
        // $khachhang->email = $request->emailnguoinhan;
        // $khachhang->id_nhanvienquanly = Auth::id();
        // $khachhang->id_trangthai = 1;
        // $khachhang->save();


        //Tìm id Kho hàng mà nhân viên đang đăng nhập quản lý
        $id_khohangquanly = User::find(Auth::id())->id_khohangquanly;

        //Tạo đơn hàng mới
        $donhang = new Donhang;
        $donhang->id_nhanvienkhoitao = Auth::id();
        $donhang->id_nhanvienquanly = Auth::id();
        $donhang->id_khogui = $id_khohangquanly;
        $donhang->id_trangthai = 1;
        $donhang->tongchiphi = $request->tongchiphi2;
        $donhang->chietkhau = $request->chietkhau;
        $donhang->tennguoigui = $request->tennguoigui;
        $donhang->sodienthoainguoigui = $request->sodienthoainguoigui;
        $donhang->diachinguoigui = $request->diachinguoigui;
        $donhang->emailnguoigui = $request->emailnguoigui;
        $donhang->tennguoinhan = $request->tennguoinhan;
        $donhang->sodienthoainguoinhan = $request->sodienthoainguoinhan;
        $donhang->diachinguoinhan = $request->diachinguoinhan;
        $donhang->emailnguoinhan = $request->emailnguoinhan;
        $donhang->save();

        //Tạo Chi tiết đơn hàng
        $chiTietDonHangclient = json_decode($request->chiTietDonHang, true);
        foreach ($chiTietDonHangclient as $value) {
            $chitietdonhang = new Chitietdonhang;
            $chitietdonhang->id_donhang = $donhang->id;
            $chitietdonhang->tenmathang = $value['tenmathang'];
            if ($value['soluong'] <> null) $chitietdonhang->soluong = $value['soluong'];
            if ($value['khoiluong'] <> null) $chitietdonhang->khoiluong = $value['khoiluong'];
            if ($value['kichthuoc'] <> null) $chitietdonhang->kichthuoc = $value['kichthuoc'];
            if ($value['giatriuoctinh'] <> null) $chitietdonhang->giatriuoctinh = str_replace(".", "", $value['giatriuoctinh']);
            $chitietdonhang->chiphi = str_replace(".", "", $value['chiphi']);
            $chitietdonhang->save();
        }

        //Lưu sự kiện "Khởi tạo" cho Đơn hàng
        $lichsudonhangController = new LichsudonhangController;
        $lichsudonhangController->luusukien($donhang->id, $donhang->id_nhanvienquanly, $donhang->id_khogui, $donhang->id_khonhan, $donhang->id_trangthai);

        //Nhập Đơn hàng vào kho
        $donhang->id_trangthai = 2;
        $donhang->save();

        //Lưu sự kiện "Nhập kho" cho Đơn hàng
        $lichsudonhangController->luusukien($donhang->id, $donhang->id_nhanvienquanly, $donhang->id_khogui, $donhang->id_khonhan, $donhang->id_trangthai);

        return redirect()->action([DonhangController::class, 'show'], ['id' => $donhang->id]);
    }

    public function show($id)
    {
        //Hiển thị thông tin Đơn hàng
        $donhang = Donhang::find($id);
        $chitietdonhang = Chitietdonhang::where('id_donhang', $id)->get();
        $qrcode = $donhang->id;
        // $qrcode = "Mã đơn hàng: ".$donhang->id.
        // "\nNgười gửi: ".$donhang->tennguoigui.
        // "\nSĐT Người gửi: ".$donhang->sodienthoainguoigui.
        // "\nĐịa chỉ Người gửi: ".$donhang->diachinguoigui.
        // "\nNgười nhận: ".$donhang->tennguoinhan.
        // "\nSĐT Người nhận: ".$donhang->sodienthoainguoinhan.
        // "\nĐịa chỉ Người nhận: ".$donhang->diachinguoinhan;

        //Hiển thị lịch sử đơn hàng
        $lichsudonhangController = new LichsudonhangController;
        $lichsudonhang = $lichsudonhangController->lichsudonhang($id);

        return view(
            'admin.donhang.show',
            [
                'donhang' => $donhang,
                'chitietdonhangs' => $chitietdonhang,
                'lichsudonhangs' => $lichsudonhang,
                'qrcode' => $qrcode
            ]
        );
    }



    public function edit($id)
    {
        $donhang = Donhang::find($id);

        //Hiển thị thông tin Đơn hàng
        $dongiatinhtheokhoiluong = Dongiatinhtheokhoiluong::orderBy('khoiluongmax', 'desc')->get();
        $dongiatinhtheosoluong = Dongiatinhtheosoluong::all();
        $dongiahangcongkenh = Dongiahangcongkenh::all();
        $chitietdonhang = Chitietdonhang::where('id_donhang', $id)->get();
        $qrcode = $donhang->id;
        // $qrcode = "Mã đơn hàng: ".$donhang->id.
        // "\nNgười gửi: ".$donhang->tennguoigui.
        // "\nSĐT Người gửi: ".$donhang->sodienthoainguoigui.
        // "\nĐịa chỉ Người gửi: ".$donhang->diachinguoigui.
        // "\nNgười nhận: ".$donhang->tennguoinhan.
        // "\nSĐT Người nhận: ".$donhang->sodienthoainguoinhan.
        // "\nĐịa chỉ Người nhận: ".$donhang->diachinguoinhan;

        //Hiển thị lịch sử đơn hàng
        $lichsudonhangController = new LichsudonhangController;
        $lichsudonhang = $lichsudonhangController->lichsudonhang($id);


        return view(
            'admin.donhang.edit',
            [
                'donhang' => $donhang,
                'dongiatinhtheokhoiluong' => $dongiatinhtheokhoiluong,
                'dongiatinhtheosoluong' => $dongiatinhtheosoluong,
                'dongiahangcongkenh' => $dongiahangcongkenh,
                'chitietdonhangs' => $chitietdonhang,
                'lichsudonhangs' => $lichsudonhang,
                'qrcode' => $qrcode
            ]
        );
    }



    public function update(Request $request, $id)
    {
        //  //Cập nhật thông tin khách hàng
        //  $khachhang = Khachhang::find($request->sodienthoainguoigui);
        //  $khachhang->tenkhachhang = $request->tennguoigui;
        //  $khachhang->sodienthoai = $request->sodienthoainguoigui;
        //  $khachhang->diachi = $request->diachinguoigui;
        //  $khachhang->id_nhanvienquanly = Auth::id();
        //  $khachhang->id_trangthai = 1;
        //  $khachhang->save();


        //Tìm id Kho hàng mà nhân viên đang đăng nhập quản lý
        $id_khohangquanly = User::find(Auth::id())->id_khohangquanly;

        //Cập nhật thông tin đơn hàng
        $donhang = Donhang::find($id);
        $donhang->tennguoigui = $request->tennguoigui;
        $donhang->sodienthoainguoigui = $request->sodienthoainguoigui;
        $donhang->diachinguoigui = $request->diachinguoigui;
        $donhang->tennguoinhan = $request->tennguoinhan;
        $donhang->sodienthoainguoinhan = $request->sodienthoainguoinhan;
        $donhang->diachinguoinhan = $request->diachinguoinhan;
        $donhang->tongchiphi = $request->tongchiphi2;
        $donhang->save();

        //Xóa Chi tiết đơn hàng trước khi tạo mới
        $chitietdonhang = Chitietdonhang::where('id_donhang', $id)->delete();

        //Tạo Chi tiết đơn hàng
        $chiTietDonHangclient = json_decode($request->chiTietDonHang, true);
        foreach ($chiTietDonHangclient as $value) {
            $chitietdonhang = new Chitietdonhang;
            $chitietdonhang->id_donhang = $donhang->id;
            $chitietdonhang->tenmathang = $value['tenmathang'];
            if ($value['soluong'] <> null) $chitietdonhang->soluong = $value['soluong'];
            if ($value['khoiluong'] <> null) $chitietdonhang->khoiluong = $value['khoiluong'];
            if ($value['kichthuoc'] <> null) $chitietdonhang->kichthuoc = $value['kichthuoc'];
            if ($value['giatriuoctinh'] <> null) $chitietdonhang->giatriuoctinh = str_replace(".", "", $value['giatriuoctinh']);
            $chitietdonhang->chiphi = str_replace(".", "", $value['chiphi']);
            $chitietdonhang->save();
        }

        return redirect()->action([DonhangController::class, 'show'], ['id' => $donhang->id]);
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
    }

    public function xuattoanbokho()
    {
        //Tạo chuyến hàng mới
        $chuyenhangController = new ChuyenhangController;
        $chuyenhang = $chuyenhangController->taochuyenhangmoi();

        //Cập nhật thông tin xuất kho cho Đơn hàng
        //Tìm id Kho hàng mà nhân viên đang đăng nhập quản lý
        $id_khohangquanly = User::find(Auth::id())->id_khohangquanly;

        //Cập nhật thông tin xuất kho cho từng Đơn hàng
        $donhangs = Donhang::where('id_khogui', $id_khohangquanly)
            ->where('id_trangthai', 2)
            ->get();
        foreach ($donhangs as $donhang) {
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
        return back();
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
            $donhang->id_khonhan = null;
            $donhang->id_trangthai = 2;
            $donhang->save();

            //Lưu sự kiện cho từng Đơn hàng
            $lichsudonhangController = new LichsudonhangController;
            $lichsudonhangController->luusukien($donhang->id, $donhang->id_nhanvienquanly, $donhang->id_khogui, $donhang->id_khonhan, $donhang->id_trangthai, $donhang->tongchiphi);
        }

        //Lưu sự kiện cho Chuyến hàng
        $lichsuchuyenhangController = new LichsuchuyenhangController;
        $lichsuchuyenhangController->luusukien($chuyenhang->id, $chuyenhang->id_nhanvienquanly, $chuyenhang->id_khogui, $chuyenhang->id_khonhan, $chuyenhang->id_trangthai);

        return back();
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
        $donhang = Lichsudonhang::where('lichsudonhangs.id_trangthai', 3)
            ->where('lichsudonhangs.id_khogui', User::find(Auth::id())->id_khohangquanly)
            ->whereBetween('lichsudonhangs.created_at', [Carbon::now()->subMonth(), Carbon::now()])
            ->leftjoin('donhangs', 'donhangs.id', 'lichsudonhangs.id_donhang')
            ->orderBy('lichsudonhangs.created_at', 'desc')
            ->get();

        return view('admin.donhang.dmdaxuatkho', ['donhangs' => $donhang]);
    }

    public function lichsudonhang($id)
    {
        $lichsudonhangController = new LichsudonhangController;
        $lichsudonhang = $lichsudonhangController->lichsudonhang($id);

        return view('admin.donhang.lichsudonhang', ['lichsudonhangs' => $lichsudonhang]);
    }

    //Xóa Đơn hàng
    public function destroy($id)
    {
        $donhang = Donhang::find($id);
        $donhang->id_trangthai = 8;
        $donhang->delete();

        //Lưu sự kiện "Xóa" cho Đơn hàng
        $lichsudonhangController = new LichsudonhangController;
        $lichsudonhangController->luusukien($donhang->id, $donhang->id_nhanvienquanly, $donhang->id_khogui, $donhang->id_khonhan, $donhang->id_trangthai);

        return redirect()->action([DonhangController::class, 'dmdangluukho']);
    }

    //Cập nhật Đơn hàng thất lạc
    public function thatlac($id)
    {
        $donhang = Donhang::find($id);
        $donhang->id_trangthai = 6;
        $donhang->save();

        return back();
    }
}
