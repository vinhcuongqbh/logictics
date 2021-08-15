<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ThongkeloinhuanController extends Controller
{
    public function thongKeLoiNhuanDashBoard(Request $request)
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
        //Tính lợi nhuận số đơn hàng trong ngày
        $loiNhuanTrongNgay = $this->thongKeLoiNhuanTheoNgay($id_nhanvien, Carbon::now());

        //Tính lợi nhuận số đơn hàng trong tuần
        $loiNhuanTrongTuan = $this->thongKeLoiNhuanTheoTuan($id_nhanvien, Carbon::now());

        //Tính lợi nhuận số đơn hàng trong tháng
        $loiNhuanTrongThang = $this->thongKeLoiNhuanTheoThang($id_nhanvien, Carbon::now()->month, Carbon::now()->year);

        //Tính lợi nhuận số đơn hàng trong năm
        $loiNhuanTrongNam = $this->thongKeLoiNhuanTheoNam($id_nhanvien, Carbon::now());

        //Tính lợi nhuận tổng số đơn hàng năm hiện tại (theo từng tháng)
        $loiNhuanNamHienTai = $this->thongKeChiTietLoiNhuanTheoThangTrongNam($id_nhanvien, Carbon::now()->year);
        //Tính lợi nhuận tổng số đơn hàng năm trước (theo từng tháng)
        $loiNhuanNamTruoc = $this->thongKeChiTietLoiNhuanTheoThangTrongNam($id_nhanvien, Carbon::now()->year - 1);

        //Tính tỉ lệ tăng trưởng năm hiện tại so với năm trước (tính đến ngày hiện tại)
        $tiLeTangTruongNam = $this->tiLeTangTruong($id_nhanvien, Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear(), Carbon::now()->startOfYear(), Carbon::now());

        //Tính lợi nhuận tổng số đơn hàng tuần hiện tại (theo từng ngày)
        $loiNhuanTuanHienTai = $this->thongKeChiTietLoiNhuanTheoNgayTrongTuan($id_nhanvien, Carbon::now());
        //Tính lợi nhuận tổng số đơn hàng tuần trước (theo từng ngày)
        $loiNhuanTuanTruoc = $this->thongKeChiTietLoiNhuanTheoNgayTrongTuan($id_nhanvien, Carbon::now()->subWeek());

        //Tính tỉ lệ tăng trưởng tuần hiện tại so với tuần trước (tính đến ngày hiện tại)
        $tiLeTangTruongTuan = $this->tiLeTangTruong($id_nhanvien, Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek(), Carbon::now()->startOfWeek(), Carbon::now());

        //Danh sách nhân viên
        $nhanvien = User::where('id_loainhanvien', '>', 1)->get();

        return view('admin.thongke.thongkeloinhuan', [
            'loiNhuanTrongNgay' =>  $loiNhuanTrongNgay,
            'loiNhuanTrongTuan' => $loiNhuanTrongTuan,
            'loiNhuanTrongThang' => $loiNhuanTrongThang,
            'loiNhuanTrongNam' => $loiNhuanTrongNam,
            'loiNhuanNamHienTai' =>  $loiNhuanNamHienTai,
            'loiNhuanNamTruoc' => $loiNhuanNamTruoc,
            'loiNhuanTuanHienTai' => $loiNhuanTuanHienTai,
            'loiNhuanTuanTruoc' => $loiNhuanTuanTruoc,
            'tiLeTangTruongNam' => $tiLeTangTruongNam,
            'tiLeTangTruongTuan' => $tiLeTangTruongTuan,
            'nhanviens' => $nhanvien,
            'id_nhanvien' => $id_nhanvien,
        ]);
    }



    //Hàm thống kê Lợi nhuận
    public function thongKeLoiNhuan($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $tongDoanhThu = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])->sum('tongchiphi');
            $tongChietKhau = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])->sum('chietkhau');
            $tongLoiNhuan = $tongDoanhThu - $tongChietKhau;
        } else {
            $tongLoiNhuan = Donhang::where('id_nhanvienkhoitao', $id_nhanvien)
                ->whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->sum('chietkhau');
        }
        return round($tongLoiNhuan / 1000000, 2);
    }


    //Hàm thống kê Lợi nhuận theo Năm
    public function thongKeLoiNhuanTheoNam($id_nhanvien, $nam)
    {
        $ngayBatDauNam = $nam->copy()->startOfYear();
        $ngayKetThucNam = $nam->copy()->endOfYear();
        $tongLoiNhuan = $this->thongKeLoiNhuan($id_nhanvien, $ngayBatDauNam, $ngayKetThucNam);
        return $tongLoiNhuan;
    }


    //Hàm thống kê Lợi nhuận theo Tháng
    public function thongKeLoiNhuanTheoThang($id_nhanvien, $thang, $nam)
    {
        $ngay = new Carbon($nam . "-" . $thang . "-01");
        $ngayBatDauThang = $ngay->copy()->firstOfMonth();
        $ngayKetThucThang = $ngay->copy()->endOfMonth();
        $tongLoiNhuan = $this->thongKeLoiNhuan($id_nhanvien, $ngayBatDauThang, $ngayKetThucThang);
        return $tongLoiNhuan;
    }


    //Hàm thống kê Lợi nhuận theo Tuần
    public function thongKeLoiNhuanTheoTuan($id_nhanvien, $ngay)
    {
        $ngayBatDauTuan = $ngay->copy()->startOfWeek();
        $ngayKetThucTuan = $ngay->copy()->endOfWeek();
        $tongLoiNhuan = $this->thongKeLoiNhuan($id_nhanvien, $ngayBatDauTuan, $ngayKetThucTuan);
        return $tongLoiNhuan;
    }


    //Hàm thống kê Lợi nhuận theo Ngày
    public function thongKeLoiNhuanTheoNgay($id_nhanvien, $ngay)
    {
        $tongLoiNhuan = $this->thongKeLoiNhuan($id_nhanvien, $ngay, $ngay);
        return $tongLoiNhuan;
    }



    //Hàm thống kê chi tiết Lợi nhuận theo tháng trong Năm
    public function thongKeChiTietLoiNhuanTheoThangTrongNam($id_nhanvien, $nam)
    {
        $tongLoiNhuan = array();
        $tongLoiNhuan[0] = $nam;
        //Tính lợi nhuận tổng số đơn hàng theo tháng
        for ($thang = 1; $thang <= 12; $thang++) {
            //Tính lợi nhuận tổng số đơn hàng theo tháng của Năm hiện tại
            $tongLoiNhuan[$thang] = $this->thongKeLoiNhuanTheoThang($id_nhanvien, $thang, $nam);
        }
        return $tongLoiNhuan;
    }



    //Hàm thống kê chi tiết Lợi nhuận theo ngày trong Tuần
    public function thongKeChiTietLoiNhuanTheoNgayTrongTuan($id_nhanvien, $ngay)
    {
        $tongLoiNhuan = array();
        $ngayBatDauTuan = $ngay->copy()->startOfWeek();
        for ($thu = 2; $thu <= 8; $thu++) {
            //Tính Tổng số đơn hàng theo ngày của Tuần hiện tại
            if ($ngayBatDauTuan->lte(Carbon::now())) {
                $tongLoiNhuan[$thu] = $this->thongKeLoiNhuanTheoNgay($id_nhanvien, $ngayBatDauTuan);
                $ngayBatDauTuan->addDay();
            } else {
                $tongLoiNhuan[$thu] = null;
            }
        }

        return $tongLoiNhuan;
    }



    //Hàm tính tỉ lệ tăng trưởng
    public function tiLeTangTruong($id_nhanvien, $ngayBatDauA, $ngayKetThucA, $ngayBatDauB, $ngayKetThucB)
    {
        //Tính tổng đơn hàng từ đầu năm cho đến ngày A
        $tongLoiNhuanA = $this->thongKeLoiNhuan($id_nhanvien, $ngayBatDauA, $ngayKetThucA);
        //Tính tổng đơn hàng từ đầu năm cho đến ngày B
        $tongLoiNhuanB = $this->thongKeLoiNhuan($id_nhanvien, $ngayBatDauB, $ngayKetThucB);
        //Tính tỉ lệ của $tongLoiNhuanB so với $tongLoiNhuanA
        if ($tongLoiNhuanA <> 0) {
            $tiLeTangTruong = round(($tongLoiNhuanB - $tongLoiNhuanA) / $tongLoiNhuanA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongLoiNhuanB * 100, 2);
        }

        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng năm
    public function tiLeTangTruongNam($id_nhanvien, $namA, $namB)
    {
        $namA = new Carbon($namA . "-01-01");
        $namB = new Carbon($namB . "-01-01");
        //Tính tổng đơn hàng từ đầu năm cho đến ngày A
        $tongLoiNhuanA = $this->thongKeLoiNhuan($id_nhanvien, $namA->copy()->startOfYear(), $namA->copy()->endOfYear());
        //Tính tổng đơn hàng từ đầu năm cho đến ngày B
        $tongLoiNhuanB = $this->thongKeLoiNhuan($id_nhanvien, $namB->copy()->startOfYear(), $namB->copy()->endOfYear());
        //Tính tỉ lệ của $tongLoiNhuanB so với $tongLoiNhuanA
        if ($tongLoiNhuanB <> 0) {
            $tiLeTangTruong = round(($tongLoiNhuanB - $tongLoiNhuanA) / $tongLoiNhuanA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongLoiNhuanB * 100, 2);
        }
        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng tuần
    public function tiLeTangTruongTuan($id_nhanvien, $ngayA, $ngayB)
    {

        //Tính tổng đơn hàng từ đầu tuần cho đến ngày A
        $tongLoiNhuanA = $this->thongKeLoiNhuan($id_nhanvien, $ngayA->copy()->startOfWeek(), $ngayA);
        //Tính tổng đơn hàng từ đầu tuần cho đến ngày B
        $tongLoiNhuanB = $this->thongKeLoiNhuan($id_nhanvien, $ngayB->copy()->startOfWeek(), $ngayB);
        //Tính tỉ lệ của $tongLoiNhuanB so với $tongLoiNhuanA
        if ($tongLoiNhuanB <> 0) {
            $tiLeTangTruong = round(($tongLoiNhuanB - $tongLoiNhuanA) / $tongLoiNhuanA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongLoiNhuanB * 100, 2);
        }
        return $tiLeTangTruong;
    }
}
