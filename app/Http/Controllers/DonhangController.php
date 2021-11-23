<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\Lichsuchuyenhang;
use App\Models\Thongtincongty;
use App\Models\Hinhthucgui;



class DonhangController extends Controller
{
    public function create()
    {
        $khachhang = Khachhang::where('id_nhanvienquanly', Auth::id())->get();
        $dongiatinhtheokhoiluong = Dongiatinhtheokhoiluong::orderBy('khoiluongmax', 'desc')->get();
        $dongiatinhtheosoluong = Dongiatinhtheosoluong::all();
        $dongiahangcongkenh = Dongiahangcongkenh::all();
        $tilechietkhau = Auth::user()->tilechietkhau;
        $hinhthucgui = Hinhthucgui::all();

        return view(
            'admin.donhang.create',
            [
                'khachhang' => $khachhang,
                'dongiatinhtheokhoiluong' => $dongiatinhtheokhoiluong,
                'dongiatinhtheosoluong' => $dongiatinhtheosoluong,
                'dongiahangcongkenh' => $dongiahangcongkenh,
                'tilechietkhau' => $tilechietkhau,
                'hinhthucgui' => $hinhthucgui,
            ]
        );
    }

    public function store(Request $request)
    {
        //Lưu thông tin người gửi
        //Kiểm tra Thông tin Khách hàng đã có trong cơ sở dữ liệu hay chưa
        $count = Khachhang::where('sodienthoai', $request->sodienthoainguoigui)->count();

        //Nếu chưa thì thêm mới dữ liệu
        if ($count == 0) {
            $khachhang = new Khachhang;
            $khachhang->tenkhachhang = $request->tennguoigui;
            $khachhang->id_loaikhachhang = 0;
            $khachhang->sodienthoai = $request->sodienthoainguoigui;
            $khachhang->diachi = $request->diachinguoigui;
            $khachhang->email = $request->emailnguoigui;
            $khachhang->id_nhanvienquanly = Auth::id();
            $khachhang->id_trangthai = 1;
            $khachhang->save();
        }

        //Lưu thông tin người nhận
        //Kiểm tra Thông tin Khách hàng đã có trong cơ sở dữ liệu hay chưa
        $count = Khachhang::where('sodienthoai', $request->sodienthoainguoinhan)->count();

        //Nếu chưa thì thêm mới dữ liệu
        if ($count == 0) {
            $khachhang = new Khachhang;
            $khachhang->tenkhachhang = $request->tennguoinhan;
            $khachhang->id_loaikhachhang = 1;
            $khachhang->sodienthoai = $request->sodienthoainguoinhan;
            $khachhang->diachi = $request->diachinguoinhan;
            $khachhang->email = $request->emailnguoinhan;
            $khachhang->id_nhanvienquanly = Auth::id();
            $khachhang->id_trangthai = 1;
            $khachhang->save();
        }

        //Tìm id Kho hàng mà nhân viên đang đăng nhập quản lý
        $id_khohangquanly = User::find(Auth::id())->id_khohangquanly;

        //Tạo đơn hàng mới
        $donhang = new Donhang;
        $donhang->matracuu = strtoupper(uniqid());
        $donhang->id_nhanvienkhoitao = Auth::id();
        $donhang->id_nhanvienquanly = Auth::id();
        $donhang->id_khogui = $id_khohangquanly;
        $donhang->id_trangthai = 1;
        $donhang->id_hinhthucgui =  $request->hinhthucgui;
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
        $donhang->tongkhoiluong = $request->tongkhoiluong;
        $donhang->ghichu = $request->ghichu;
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
        $lichsudonhangController->luusukien(
            $donhang->id,
            $donhang->matracuu,
            $donhang->id_nhanvienquanly,
            $donhang->id_chuyenhang,
            $donhang->id_khogui,
            $donhang->id_khonhan,
            $donhang->id_trangthai,
            $donhang->ghichu,
        );

        //Nhập Đơn hàng vào kho
        $donhang->id_trangthai = 2;
        $donhang->save();

        //Lưu sự kiện "Nhập kho" cho Đơn hàng
        $lichsudonhangController->luusukien(
            $donhang->id,
            $donhang->matracuu,
            $donhang->id_nhanvienquanly,
            $donhang->id_chuyenhang,
            $donhang->id_khogui,
            $donhang->id_khonhan,
            $donhang->id_trangthai,
            null,
        );

        return redirect()->action([DonhangController::class, 'show'], ['id' => $donhang->id]);
    }

    public function show($id)
    {
        //Hiển thị thông tin Đơn hàng
        $donhang = Donhang::where('donhangs.id', $id)
            ->join('hinhthucguis', 'hinhthucguis.id', 'donhangs.id_hinhthucgui')
            ->select('donhangs.*', 'hinhthucguis.tenhinhthucgui')
            ->first();         

        $chitietdonhang = Chitietdonhang::where('id_donhang', $id)->get();
        $qrcode = "ETRACK" . $donhang->matracuu;
        // $qrcode = "Mã đơn hàng: ".$donhang->id.
        // "\nNgười gửi: ".$donhang->tennguoigui.
        // "\nSĐT Người gửi: ".$donhang->sodienthoainguoigui.
        // "\nĐịa chỉ Người gửi: ".$donhang->diachinguoigui.
        // "\nNgười nhận: ".$donhang->tennguoinhan.
        // "\nSĐT Người nhận: ".$donhang->sodienthoainguoinhan.
        // "\nĐịa chỉ Người nhận: ".$donhang->diachinguoinhan;
        $thongtincongty = Thongtincongty::find(1);

        //Hiển thị lịch sử đơn hàng
        $lichsudonhangController = new LichsudonhangController;
        $lichsudonhang = $lichsudonhangController->lichsudonhang($id);

        return view(
            'admin.donhang.show',
            [
                'donhang' => $donhang,
                'chitietdonhangs' => $chitietdonhang,
                'lichsudonhangs' => $lichsudonhang,
                'qrcode' => $qrcode,
                'thongtincongty' => $thongtincongty,
            ]
        );
    }



    public function edit($id)
    {
        $donhang = Donhang::find($id);
        $hinhthucgui = Hinhthucgui::all();
        $tilechietkhau = Auth::user()->tilechietkhau;

        //Hiển thị thông tin Đơn hàng
        $dongiatinhtheokhoiluong = Dongiatinhtheokhoiluong::orderBy('khoiluongmax', 'desc')->get();
        $dongiatinhtheosoluong = Dongiatinhtheosoluong::all();
        $dongiahangcongkenh = Dongiahangcongkenh::all();
        $chitietdonhang = Chitietdonhang::where('id_donhang', $id)->get();
        $qrcode = "ETRACK" . $donhang->matracuu;
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
                'qrcode' => $qrcode,
                'tilechietkhau' => $tilechietkhau,
                'hinhthucgui' => $hinhthucgui,
            ]
        );
    }



    public function update(Request $request, $id)
    {
        //Cập nhật thông tin Người gửi
        $khachhang = Khachhang::where('sodienthoai', $request->sodienthoainguoiguicu)->first();
        if ($khachhang != null) {
            $khachhang->tenkhachhang = $request->tennguoigui;
            $khachhang->id_loaikhachhang = 0;
            $khachhang->sodienthoai = $request->sodienthoainguoigui;
            $khachhang->diachi = $request->diachinguoigui;
            $khachhang->email = $request->emailnguoigui;
            $khachhang->id_trangthai = 1;
            $khachhang->save();
        }

        //Cập nhật thông tin Người nhận
        $khachhang = Khachhang::where('sodienthoai', $request->sodienthoainguoinhancu)->first();
        if ($khachhang != null) {
            $khachhang->tenkhachhang = $request->tennguoinhan;
            $khachhang->id_loaikhachhang = 1;
            $khachhang->sodienthoai = $request->sodienthoainguoinhan;
            $khachhang->diachi = $request->diachinguoinhan;
            $khachhang->email = $request->emailnguoinhan;
            $khachhang->id_trangthai = 1;
            $khachhang->save();
        }

        //Tìm id Kho hàng mà nhân viên đang đăng nhập quản lý
        $id_khohangquanly = User::find(Auth::id())->id_khohangquanly;

        //Cập nhật thông tin đơn hàng
        $donhang = Donhang::find($id);
        $donhang->tennguoigui = $request->tennguoigui;
        $donhang->sodienthoainguoigui = $request->sodienthoainguoigui;
        $donhang->diachinguoigui = $request->diachinguoigui;
        $donhang->emailnguoigui = $request->emailnguoigui;
        $donhang->tennguoinhan = $request->tennguoinhan;
        $donhang->sodienthoainguoinhan = $request->sodienthoainguoinhan;
        $donhang->diachinguoinhan = $request->diachinguoinhan;
        $donhang->emailnguoinhan = $request->emailnguoinhan;
        $donhang->tongchiphi = $request->tongchiphi2;
        $donhang->chietkhau = $request->chietkhau;
        $donhang->tongkhoiluong = $request->tongkhoiluong;
        $donhang->ghichu = $request->ghichu;
        $donhang->id_hinhthucgui = $request->hinhthucgui;
        $donhang->save();

        //Lưu sự kiện cho từng Đơn hàng
        $lichsudonhangController = new LichsudonhangController;
        $lichsudonhangController->luusukien(
            $donhang->id,
            $donhang->matracuu,
            $donhang->id_nhanvienquanly,
            $donhang->id_chuyenhang,
            $donhang->id_khogui,
            $donhang->id_khonhan,
            8,
            $donhang->ghichu,
        );

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



    public function themdonhang(Request $request)
    {
        //Cập nhật thông tin xuất kho cho Đơn hàng
        //$id_donhangduocchons = $request->input('id_donhangduocchon');

        $id_duocchons = json_decode($request->id_duocchon, true);

        //Tìm chuyến hàng
        $chuyenhang = Chuyenhang::find($request->id_chuyenhang);
        $tongdonhang = $chuyenhang->tongdonhang;
        if ($chuyenhang->id_trangthai == 3) {
            if ($id_duocchons <> null) {
                foreach ($id_duocchons as $id_duocchon) {
                    //Cập nhật thông tin xuất kho cho từng Đơn hàng
                    $donhang = Donhang::find($id_duocchon['value']);
                    if ($donhang->id_trangthai == 2) {
                        $donhang->id_khonhan = $chuyenhang->id_khonhan;
                        $donhang->id_chuyenhang = $chuyenhang->id;
                        $donhang->id_trangthai = 3;
                        $donhang->save();

                        //Lưu sự kiện cho từng Đơn hàng
                        $lichsudonhangController = new LichsudonhangController;
                        $lichsudonhangController->luusukien(
                            $donhang->id,
                            $donhang->matracuu,
                            $donhang->id_nhanvienquanly,
                            $donhang->id_chuyenhang,
                            $donhang->id_khogui,
                            $donhang->id_khonhan,
                            $donhang->id_trangthai,
                            null,
                        );
                        $tongdonhang++;
                    }
                }

                //Cập nhật thông tin xuất kho cho Chuyến hàng
                $chuyenhangController = new ChuyenhangController;
                $chuyenhangController->xuatkho($chuyenhang, $tongdonhang);

                //Lưu sự kiện cho Chuyến hàng
                $lichsuchuyenhangController = new LichsuchuyenhangController;
                //Xóa sự kiện cho Chuyến hàng
                $lichsuchuyenhangController->xoasukien($chuyenhang->id, 3);
                $lichsuchuyenhangController->luusukien(
                    $chuyenhang->id,
                    Carbon::now(),
                    null,
                    $tongdonhang,
                    $chuyenhang->id_nhanvienquanly,
                    $chuyenhang->id_khogui,
                    $chuyenhang->id_khonhan,
                    $chuyenhang->id_trangthai
                );
            }
        }

        return back();
    }



    public function xuatkho(Request $request)
    {
        //Cập nhật thông tin xuất kho cho Đơn hàng
        // $id_donhangduocchons = $request->input('id_donhangduocchon');        

        $id_duocchons = json_decode($request->id_duocchon, true);

        if ($id_duocchons <> null) {
            //Tạo chuyến hàng mới
            $chuyenhangController = new ChuyenhangController;
            $chuyenhang = $chuyenhangController->taochuyenhangmoi();
            $tongdonhang = 0;

            foreach ($id_duocchons as $id_duocchon) {
                //Cập nhật thông tin xuất kho cho từng Đơn hàng
                $donhang = Donhang::find($id_duocchon['value']);
                //if chỗ này để tránh trường hợp mở nhiều tab cùng một nội dung; xuất đơn hàng đi rồi xuất lại
                if ($donhang->id_trangthai == 2) {
                    $donhang->id_khonhan = $chuyenhang->id_khonhan;
                    $donhang->id_chuyenhang = $chuyenhang->id;
                    $donhang->id_trangthai = 3;
                    $donhang->save();

                    //Lưu sự kiện cho từng Đơn hàng
                    $lichsudonhangController = new LichsudonhangController;
                    $lichsudonhangController->luusukien(
                        $donhang->id,
                        $donhang->matracuu,
                        $donhang->id_nhanvienquanly,
                        $donhang->id_chuyenhang,
                        $donhang->id_khogui,
                        $donhang->id_khonhan,
                        $donhang->id_trangthai,
                        null,
                    );
                    $tongdonhang++;
                }
            }

            //Cập nhật thông tin xuất kho cho Chuyến hàng
            $chuyenhangController->xuatkho($chuyenhang, $tongdonhang);

            //Lưu sự kiện cho Chuyến hàng
            $lichsuchuyenhangController = new LichsuchuyenhangController;
            $lichsuchuyenhangController->luusukien(
                $chuyenhang->id,
                Carbon::now(),
                null,
                $tongdonhang,
                $chuyenhang->id_nhanvienquanly,
                $chuyenhang->id_khogui,
                $chuyenhang->id_khonhan,
                $chuyenhang->id_trangthai
            );
        }

        return back();
    }

    public function xuattoanbokho()
    {
        //Cập nhật thông tin xuất kho cho Đơn hàng
        //Tìm id Kho hàng mà nhân viên đang đăng nhập quản lý
        $id_khohangquanly = User::find(Auth::id())->id_khohangquanly;

        //Cập nhật thông tin xuất kho cho từng Đơn hàng
        $donhangs = Donhang::where('id_khogui', $id_khohangquanly)
            ->where('id_trangthai', 2)
            ->get();

        if ($donhangs->count() <> 0) {
            //Tạo chuyến hàng mới
            $chuyenhangController = new ChuyenhangController;
            $chuyenhang = $chuyenhangController->taochuyenhangmoi();

            $tongdonhang = 0;
            foreach ($donhangs as $donhang) {
                $donhang->id_khonhan = $chuyenhang->id_khonhan;
                $donhang->id_chuyenhang = $chuyenhang->id;
                $donhang->id_trangthai = 3;
                $donhang->save();

                //Lưu sự kiện cho từng Đơn hàng
                $lichsudonhangController = new LichsudonhangController;
                $lichsudonhangController->luusukien(
                    $donhang->id,
                    $donhang->matracuu,
                    $donhang->id_nhanvienquanly,
                    $donhang->id_chuyenhang,
                    $donhang->id_khogui,
                    $donhang->id_khonhan,
                    $donhang->id_trangthai,
                    null,
                );

                $tongdonhang++;
            }

            //Cập nhật thông tin xuất kho cho Chuyến hàng
            $chuyenhangController->xuatkho($chuyenhang, $tongdonhang);

            //Lưu sự kiện cho Chuyến hàng
            $lichsuchuyenhangController = new LichsuchuyenhangController;
            $lichsuchuyenhangController->luusukien(
                $chuyenhang->id,
                Carbon::now(),
                null,
                $tongdonhang,
                $chuyenhang->id_nhanvienquanly,
                $chuyenhang->id_khogui,
                $chuyenhang->id_khonhan,
                $chuyenhang->id_trangthai
            );
        }

        return back();
    }


    public function nhapkho(Request $request)
    {
        //Tìm Chuyến hàng
        $chuyenhang = Chuyenhang::find($request->id_chuyenhang);

        //Tìm các đơn hàng thuộc Chuyến hàng
        $donhangs = Donhang::where('id_chuyenhang', $request->id_chuyenhang)
            ->where('id_trangthai', 3)
            ->get();

        //Cập nhật thông tin nhập kho cho từng Đơn hàng
        $tongdonhang = 0;
        foreach ($donhangs as $donhang) {
            $donhang->id_nhanvienquanly = Auth::id();
            //$donhang->id_chuyenhang = null;
            $donhang->id_khogui = User::find(Auth::id())->id_khohangquanly;
            $donhang->id_khonhan = null;
            $donhang->id_trangthai = 2;
            $donhang->save();

            //Lưu sự kiện cho từng Đơn hàng
            $lichsudonhangController = new LichsudonhangController;
            $lichsudonhangController->luusukien(
                $donhang->id,
                $donhang->matracuu,
                $donhang->id_nhanvienquanly,
                $donhang->id_chuyenhang,
                $donhang->id_khogui,
                $donhang->id_khonhan,
                $donhang->id_trangthai,
                null,
            );

            $tongdonhang++;
        }

        //Cập nhật thông tin nhập kho cho Chuyến hàng
        $chuyenhangController = new ChuyenhangController;
        $chuyenhangController->nhapkho($chuyenhang, $tongdonhang);

        //Lưu sự kiện cho Chuyến hàng
        $lichsuchuyenhangController = new LichsuchuyenhangController;
        $lichsuchuyenhangController->luusukien(
            $chuyenhang->id,
            null,
            Carbon::now(),
            $tongdonhang,
            $chuyenhang->id_nhanvienquanly,
            $chuyenhang->id_khogui,
            $chuyenhang->id_khonhan,
            $chuyenhang->id_trangthai
        );

        return back();
    }

    public function hoanlaixuatkho($id)
    {
        $donhang = Donhang::find($id);
        $id_chuyenhang = $donhang->id_chuyenhang;
        $chuyenhang = Chuyenhang::find($id_chuyenhang);

        if ($chuyenhang->id_trangthai == 3) {
            //Cập nhật thông tin hoàn lại cho Đơn hàng
            $donhang->id_khonhan = null;
            $donhang->id_chuyenhang = null;
            $donhang->id_trangthai = 2;
            $donhang->save();

            //Xóa sự kiện xuất kho cho Đơn hàng 
            $lichsudonhangs = LichsuDonhang::where('id_donhang', $id)
                ->where('id_chuyenhang', $id_chuyenhang)
                ->where('id_trangthai', 3)
                ->first();
            $lichsudonhangs->delete();

            //Cập nhật thông tin hoàn lại cho Chuyến hàng
            $chuyenhang = Chuyenhang::find($id_chuyenhang);
            $chuyenhang->tongdonhang = $chuyenhang->tongdonhang - 1;
            $chuyenhang->save();

            //Cập nhật thông tin hoàn lại cho Chuyến hàng
            $lichsuchuyenhang = Lichsuchuyenhang::where('id_chuyenhang', $id_chuyenhang)
                ->where('id_trangthai', 3)
                ->first();
            $lichsuchuyenhang->tongdonhang = $lichsuchuyenhang->tongdonhang - 1;
            $lichsuchuyenhang->save();            
        }
        return back();
    }

    public function hoanlainhapkho(Request $request)
    {
        //Tìm Chuyến hàng
        $chuyenhang = Chuyenhang::find($request->id_chuyenhang);

        //Tìm các đơn hàng thuộc Chuyến hàng
        $donhangs = LichsuDonhang::where('id_chuyenhang', $request->id_chuyenhang)
            ->where('id_trangthai', 3)
            ->get();

        //Cập nhật thông tin hoàn lại cho từng Đơn hàng
        foreach ($donhangs as $i) {
            $donhang = Donhang::find($i->id_donhang);
            $donhang->id_nhanvienquanly = $i->id_nhanvienquanly;
            $donhang->id_khogui = $i->id_khogui;
            $donhang->id_khonhan = $i->id_khonhan;
            $donhang->id_trangthai = $i->id_trangthai;
            $donhang->save();
        }

        //Xóa sự kiện nhập kho cho từng Đơn hàng 
        $lichsudonhangs = LichsuDonhang::where('id_chuyenhang', $request->id_chuyenhang)
            ->where('id_trangthai', 2)
            ->get();
        foreach ($lichsudonhangs as $i) {
            $i->delete();
        }

        //Cập nhật thông tin hoàn lại cho Chuyến hàng
        $chuyenhangController = new ChuyenhangController;
        $chuyenhangController->hoanlai($chuyenhang);

        //Xóa sự kiện nhập kho cho Chuyến hàng
        $lichsuchuyenhangController = new LichsuchuyenhangController;
        $lichsuchuyenhangController->xoasukien($request->id_chuyenhang, 2);

        return back();
    }

    //Danh sách Đơn hàng đang lưu Kho
    public function dmdangluukho()
    {
        $donhang = Donhang::where('donhangs.id_trangthai', 2)
            ->where('donhangs.id_khogui', User::find(Auth::id())->id_khohangquanly)
            ->orderBy('id', 'desc')
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



    //Danh sách Đơn hàng đã tạo
    public function dmdatao()
    {
        $donhang = Lichsudonhang::where('lichsudonhangs.id_trangthai', 1)
            ->where('lichsudonhangs.id_khogui', User::find(Auth::id())->id_khohangquanly)
            ->leftjoin('donhangs', 'donhangs.id', 'lichsudonhangs.id_donhang')
            ->orderBy('lichsudonhangs.id_donhang', 'desc')
            ->paginate(25);

        return view('admin.donhang.dmdatao', ['donhangs' => $donhang]);
    }



    //Danh sách Đơn hàng bị thất lạc
    public function dmthatlac()
    {
        $donhang = Donhang::where('donhangs.id_trangthai', 6)
            ->where('donhangs.id_khogui', User::find(Auth::id())->id_khohangquanly)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.donhang.dmthatlac', ['donhangs' => $donhang]);
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
        $donhang->id_nhanvienquanly = Auth::id();
        $donhang->id_trangthai = 7;
        $donhang->save();

        //Lưu sự kiện "Xóa" cho Đơn hàng
        $lichsudonhangController = new LichsudonhangController;
        $lichsudonhangController->luusukien(
            $donhang->id,
            $donhang->matracuu,
            $donhang->id_nhanvienquanly,
            $donhang->id_chuyenhang,
            $donhang->id_khogui,
            $donhang->id_khonhan,
            $donhang->id_trangthai,
            null,
        );

        return redirect()->action([DonhangController::class, 'dmdangluukho']);
    }



    //Cập nhật Đơn hàng thất lạc
    public function thatlac($id)
    {
        $donhang = Donhang::find($id);
        $donhang->id_chuyenhang = null;
        $donhang->id_khonhan = null;
        $donhang->id_trangthai = 6;
        $donhang->save();

        echo $donhang->id_chuyenhang;

        //Lưu sự kiện "Thất lạc" cho Đơn hàng
        $lichsudonhangController = new LichsudonhangController;
        $lichsudonhangController->luusukien(
            $donhang->id,
            $donhang->matracuu,
            Auth::id(),
            $donhang->id_chuyenhang,
            $donhang->id_khogui,
            $donhang->id_khonhan,
            $donhang->id_trangthai,
            null,
        );

        return back();
    }



    //Phục hồi Đơn hàng
    public function restore($id)
    {
        $donhang = Donhang::find($id);
        $donhang->id_nhanvienquanly = Auth::id();
        $donhang->id_trangthai = 2;
        $donhang->save();

        //Lưu sự kiện "Phục hồi" cho Đơn hàng
        $lichsudonhangController = new LichsudonhangController;
        $lichsudonhangController->luusukien(
            $donhang->id,
            $donhang->matracuu,
            $donhang->id_nhanvienquanly,
            $donhang->id_chuyenhang,
            $donhang->id_khogui,
            $donhang->id_khonhan,
            $donhang->id_trangthai,
            null,
        );

        return back();
    }



    //Trang Tra cứu Đơn hàng
    public function tracuu()
    {
        return view('admin.donhang.tracuu');
    }



    //Kết quản tra cứu Đơn hàng
    public function ketquatracuu(Request $request)
    {
        if (Auth::user()->id_loainhanvien <= 2) {
            $donhang = Donhang::where('matracuu', $request->thongtintimkiem)
                ->orwhere('tennguoigui', 'LIKE', "%{$request->thongtintimkiem}%")
                ->orwhere('sodienthoainguoigui', 'LIKE', "%{$request->thongtintimkiem}%")
                ->orwhere('emailnguoigui', 'LIKE', "%{$request->thongtintimkiem}%")
                //->orwhere('tennguoinhan', 'LIKE', "%{$request->thongtintimkiem}%")
                //->orwhere('sodienthoainguoinhan', 'LIKE', "%{$request->thongtintimkiem}%")
                //->orwhere('emailnguoinhan', 'LIKE', "%{$request->thongtintimkiem}%")
                ->orderby('created_at', 'desc')
                ->get();
        } elseif (Auth::user()->id_loainhanvien > 2) {
            $donhang = Donhang::where('id_nhanvienkhoitao', Auth::id())
                ->where('matracuu', $request->thongtintimkiem)
                ->orwhere('tennguoigui', 'LIKE', "%{$request->thongtintimkiem}%")
                ->orwhere('sodienthoainguoigui', 'LIKE', "%{$request->thongtintimkiem}%")
                ->orwhere('emailnguoigui', 'LIKE', "%{$request->thongtintimkiem}%")
                //->orwhere('tennguoinhan', 'LIKE', "%{$request->thongtintimkiem}%")
                //->orwhere('sodienthoainguoinhan', 'LIKE', "%{$request->thongtintimkiem}%")
                //->orwhere('emailnguoinhan', 'LIKE', "%{$request->thongtintimkiem}%")
                ->orderby('created_at', 'desc')
                ->get();
        }
        return view('admin.donhang.ketquatracuu', ['thongtintimkiem' => $request->thongtintimkiem, 'donhangs' => $donhang]);
    }
}
