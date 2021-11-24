<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ThongkechietkhauController extends Controller
{
    public function thongKeChietKhauDashBoard(Request $request)
    {
        //Kiểm tra xem $id_nhanvien có tồn tại
        if ($request->nhanvien == null) {
            if (Auth::user()->id_loainhanvien != 1) {
                $request->nhanvien = Auth::user()->id;
            } else {
                $request->nhanvien = 2;
            }
        }

        $id_nhanvien = $request->nhanvien;
        //Tính chiết khấu số đơn hàng trong ngày
        $chietKhauTrongNgay = $this->thongKeChietKhauTheoNgay($id_nhanvien, Carbon::now());

        //Tính chiết khấu số đơn hàng trong tuần
        $chietKhauTrongTuan = $this->thongKeChietKhauTheoTuan($id_nhanvien, Carbon::now());

        //Tính chiết khấu số đơn hàng trong tháng
        $chietKhauTrongThang = $this->thongKeChietKhauTheoThang($id_nhanvien, Carbon::now()->month, Carbon::now()->year);

        //Tính chiết khấu số đơn hàng trong năm
        $chietKhauTrongNam = $this->thongKeChietKhauTheoNam($id_nhanvien, Carbon::now());

        //Tính chiết khấu tổng số đơn hàng năm hiện tại (theo từng tháng)
        $chietKhauNamHienTai = $this->thongKeChiTietChietKhauTheoThangTrongNam($id_nhanvien, Carbon::now()->year);
        //Tính chiết khấu tổng số đơn hàng năm trước (theo từng tháng)
        $chietKhauNamTruoc = $this->thongKeChiTietChietKhauTheoThangTrongNam($id_nhanvien, Carbon::now()->year - 1);

        //Tính tỉ lệ tăng trưởng năm hiện tại so với năm trước (tính đến ngày hiện tại)
        $tiLeTangTruongNam = $this->tiLeTangTruong($id_nhanvien, Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear(), Carbon::now()->startOfYear(), Carbon::now());

        //Tính chiết khấu tổng số đơn hàng tuần hiện tại (theo từng ngày)
        $chietKhauTuanHienTai = $this->thongKeChiTietChietKhauTheoNgayTrongTuan($id_nhanvien, Carbon::now());
        //Tính chiết khấu tổng số đơn hàng tuần trước (theo từng ngày)
        $chietKhauTuanTruoc = $this->thongKeChiTietChietKhauTheoNgayTrongTuan($id_nhanvien, Carbon::now()->subWeek());

        //Tính tỉ lệ tăng trưởng tuần hiện tại so với tuần trước (tính đến ngày hiện tại)
        $tiLeTangTruongTuan = $this->tiLeTangTruong($id_nhanvien, Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek(), Carbon::now()->startOfWeek(), Carbon::now());

        //Danh sách nhân viên
        $nhanvien = User::where('id_loainhanvien', '>', 1)->get();

        return view('admin.thongke.thongkechietkhau', [
            'chietKhauTrongNgay' =>  $chietKhauTrongNgay,
            'chietKhauTrongTuan' => $chietKhauTrongTuan,
            'chietKhauTrongThang' => $chietKhauTrongThang,
            'chietKhauTrongNam' => $chietKhauTrongNam,
            'chietKhauNamHienTai' =>  $chietKhauNamHienTai,
            'chietKhauNamTruoc' => $chietKhauNamTruoc,
            'chietKhauTuanHienTai' => $chietKhauTuanHienTai,
            'chietKhauTuanTruoc' => $chietKhauTuanTruoc,
            'tiLeTangTruongNam' => $tiLeTangTruongNam,
            'tiLeTangTruongTuan' => $tiLeTangTruongTuan,
            'nhanviens' => $nhanvien,
            'id_nhanvien' => $id_nhanvien,
        ]);
    }



    //Hàm thống kê Chiết khấu
    public function thongKeChietKhau($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {           
            $tongChietKhau = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                //->where('id_trangthai', '<>', '6')
                ->where('id_trangthai', '<>', '7')
                ->sum('chietkhau');           
        } else {
            $tongChietKhau = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                //->where('id_trangthai', '<>', '6')
                ->where('id_trangthai', '<>', '7')
                ->where('id_nhanvienkhoitao', $id_nhanvien)
                ->sum('chietkhau');
        }

        return round($tongChietKhau / 1000000, 2);
    }



    //Hàm thống kê Chiết khấu Duong Khong
    public function thongKeChietKhauDuongKhong($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {           
            $tongChietKhau = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 1)
                //->where('id_trangthai', '<>', '6')
                ->where('id_trangthai', '<>', '7')
                ->sum('chietkhau');         
        } else {
            $tongChietKhau = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 1)
                //->where('id_trangthai', '<>', '6')
                ->where('id_trangthai', '<>', '7')
                ->where('id_nhanvienkhoitao', $id_nhanvien)
                ->sum('chietkhau');
        }
        
        return round($tongChietKhau / 1000000, 2);
    }



    //Hàm thống kê Chiết khấu Duong Bien
    public function thongKeChietKhauDuongBien($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {            
            $tongChietKhau = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 2)
                //->where('id_trangthai', '<>', '6')
                ->where('id_trangthai', '<>', '7')
                ->sum('chietkhau');           
        } else {
            $tongChietKhau = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 2)
                //->where('id_trangthai', '<>', '6')
                ->where('id_trangthai', '<>', '7')
                ->where('id_nhanvienkhoitao', $id_nhanvien)
                ->sum('chietkhau');
        }
        
        return round($tongChietKhau / 1000000, 2);
    }


    //Hàm thống kê Chiết khấu theo Năm
    public function thongKeChietKhauTheoNam($id_nhanvien, $nam)
    {
        $ngayBatDauNam = $nam->copy()->startOfYear();
        $ngayKetThucNam = $nam->copy()->endOfYear();
        $tongChietKhau = $this->thongKeChietKhau($id_nhanvien, $ngayBatDauNam, $ngayKetThucNam);
        return $tongChietKhau;
    }


    //Hàm thống kê Chiết khấu theo Tháng
    public function thongKeChietKhauTheoThang($id_nhanvien, $thang, $nam)
    {
        $ngay = new Carbon($nam . "-" . $thang . "-01");
        $ngayBatDauThang = $ngay->copy()->firstOfMonth();
        $ngayKetThucThang = $ngay->copy()->endOfMonth();
        $tongChietKhau = $this->thongKeChietKhau($id_nhanvien, $ngayBatDauThang, $ngayKetThucThang);
        return $tongChietKhau;
    }


    //Hàm thống kê Chiết khấu theo Tuần
    public function thongKeChietKhauTheoTuan($id_nhanvien, $ngay)
    {
        $ngayBatDauTuan = $ngay->copy()->startOfWeek();
        $ngayKetThucTuan = $ngay->copy()->endOfWeek();
        $tongChietKhau = $this->thongKeChietKhau($id_nhanvien, $ngayBatDauTuan, $ngayKetThucTuan);
        return $tongChietKhau;
    }


    //Hàm thống kê Chiết khấu theo Ngày
    public function thongKeChietKhauTheoNgay($id_nhanvien, $ngay)
    {
        $tongChietKhau = $this->thongKeChietKhau($id_nhanvien, $ngay, $ngay);
        return $tongChietKhau;
    }



    //Hàm thống kê chi tiết Chiết khấu theo tháng trong Năm
    public function thongKeChiTietChietKhauTheoThangTrongNam($id_nhanvien, $nam)
    {
        $tongChietKhau = array();
        $tongChietKhau[0] = $nam;
        //Tính chiết khấu tổng số đơn hàng theo tháng
        for ($thang = 1; $thang <= 12; $thang++) {
            //Tính chiết khấu tổng số đơn hàng theo tháng của Năm hiện tại
            $tongChietKhau[$thang] = $this->thongKeChietKhauTheoThang($id_nhanvien, $thang, $nam);
        }
        return $tongChietKhau;
    }



    //Hàm thống kê chi tiết Chiết khấu theo ngày trong Tuần
    public function thongKeChiTietChietKhauTheoNgayTrongTuan($id_nhanvien, $ngay)
    {
        $tongChietKhau = array();
        $ngayBatDauTuan = $ngay->copy()->startOfWeek();
        for ($thu = 2; $thu <= 8; $thu++) {
            //Tính Tổng số đơn hàng theo ngày của Tuần hiện tại
            if ($ngayBatDauTuan->lte(Carbon::now())) {
                $tongChietKhau[$thu] = $this->thongKeChietKhauTheoNgay($id_nhanvien, $ngayBatDauTuan);
                $ngayBatDauTuan->addDay();
            } else {
                $tongChietKhau[$thu] = null;
            }
        }

        return $tongChietKhau;
    }



    //Hàm tính tỉ lệ tăng trưởng
    public function tiLeTangTruong($id_nhanvien, $ngayBatDauA, $ngayKetThucA, $ngayBatDauB, $ngayKetThucB)
    {
        //Tính tổng đơn hàng từ đầu năm cho đến ngày A
        $tongChietKhauA = $this->thongKeChietKhau($id_nhanvien, $ngayBatDauA, $ngayKetThucA);
        //Tính tổng đơn hàng từ đầu năm cho đến ngày B
        $tongChietKhauB = $this->thongKeChietKhau($id_nhanvien, $ngayBatDauB, $ngayKetThucB);
        //Tính tỉ lệ của $tongChietKhauB so với $tongChietKhauA
        if ($tongChietKhauA <> 0) {
            $tiLeTangTruong = round(($tongChietKhauB - $tongChietKhauA) / $tongChietKhauA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongChietKhauB * 100, 2);
        }

        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng năm
    public function tiLeTangTruongNam($id_nhanvien, $namA, $namB)
    {
        $namA = new Carbon($namA . "-01-01");
        $namB = new Carbon($namB . "-01-01");
        //Tính tổng đơn hàng từ đầu năm cho đến ngày A
        $tongChietKhauA = $this->thongKeChietKhau($id_nhanvien, $namA->copy()->startOfYear(), $namA->copy()->endOfYear());
        //Tính tổng đơn hàng từ đầu năm cho đến ngày B
        $tongChietKhauB = $this->thongKeChietKhau($id_nhanvien, $namB->copy()->startOfYear(), $namB->copy()->endOfYear());
        //Tính tỉ lệ của $tongChietKhauB so với $tongChietKhauA
        if ($tongChietKhauB <> 0) {
            $tiLeTangTruong = round(($tongChietKhauB - $tongChietKhauA) / $tongChietKhauA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongChietKhauB * 100, 2);
        }
        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng tuần
    public function tiLeTangTruongTuan($id_nhanvien, $ngayA, $ngayB)
    {

        //Tính tổng đơn hàng từ đầu tuần cho đến ngày A
        $tongChietKhauA = $this->thongKeChietKhau($id_nhanvien, $ngayA->copy()->startOfWeek(), $ngayA);
        //Tính tổng đơn hàng từ đầu tuần cho đến ngày B
        $tongChietKhauB = $this->thongKeChietKhau($id_nhanvien, $ngayB->copy()->startOfWeek(), $ngayB);
        //Tính tỉ lệ của $tongChietKhauB so với $tongChietKhauA
        if ($tongChietKhauB <> 0) {
            $tiLeTangTruong = round(($tongChietKhauB - $tongChietKhauA) / $tongChietKhauA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongChietKhauB * 100, 2);
        }
        return $tiLeTangTruong;
    }
}
