<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donhang;
use App\Models\Lichsudonhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ThongkedonhangController extends Controller
{
    public function thongKeDonHangDashBoard()
    {
        //Tính số đơn hàng trong ngày
        $donHangTrongNgay = $this->thongKeDonHangTheoNgay(Carbon::now());

        //Tính số đơn hàng trong tuần
        $donHangTrongTuan = $this->thongKeDonHangTheoTuan(Carbon::now());

        //Tính số đơn hàng trong tháng
        $donHangTrongThang = $this->thongKeDonHangTheoThang(Carbon::now()->month, Carbon::now()->year);

        //Tính số đơn hàng trong năm
        $donHangTrongNam = $this->thongKeDonHangTheoNam(Carbon::now());

        //Tính tổng số đơn hàng năm hiện tại (theo từng tháng)
        $donHangNamHienTai = $this->thongKeChiTietDonHangTheoThangTrongNam(Carbon::now()->year);
        //Tính tổng số đơn hàng năm trước (theo từng tháng)
        $donHangNamTruoc = $this->thongKeChiTietDonHangTheoThangTrongNam(Carbon::now()->year - 1);

        //Tính tỉ lệ tăng trưởng năm hiện tại so với năm trước (tính đến ngày hiện tại)   
        $tiLeTangTruongNam = $this->tiLeTangTruong(Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear(), Carbon::now()->startOfYear(), Carbon::now());

        //Tính tổng số đơn hàng tuần hiện tại (theo từng ngày)
        $donHangTuanHienTai = $this->thongKeChiTietDonHangTheoNgayTrongTuan(Carbon::now());
        //Tính tổng số đơn hàng tuần trước (theo từng ngày)
        $donHangTuanTruoc = $this->thongKeChiTietDonHangTheoNgayTrongTuan(Carbon::now()->subWeek());

        //Tính tỉ lệ tăng trưởng tuần hiện tại so với tuần trước (tính đến ngày hiện tại)
        $tiLeTangTruongTuan = $this->tiLeTangTruong(Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek(), Carbon::now()->startOfWeek(), Carbon::now());

        return view('admin.thongke.thongkedonhang', [
            'donHangTrongNgay' =>  $donHangTrongNgay,
            'donHangTrongTuan' => $donHangTrongTuan,
            'donHangTrongThang' => $donHangTrongThang,
            'donHangTrongNam' => $donHangTrongNam,
            'donHangNamHienTai' =>  $donHangNamHienTai,
            'donHangNamTruoc' => $donHangNamTruoc,
            'donHangTuanTruoc' => $donHangTuanTruoc,
            'donHangTuanHienTai' => $donHangTuanHienTai,
            'tiLeTangTruongNam' => $tiLeTangTruongNam,
            'tiLeTangTruongTuan' => $tiLeTangTruongTuan,
        ]);
    }


    //Hàm tính tỉ lệ tăng trưởng
    public function tiLeTangTruong($ngayBatDauA, $ngayKetThucA, $ngayBatDauB, $ngayKetThucB)
    {
        //Tính tổng đơn hàng từ đầu năm cho đến ngày A
        $tongDonHangA = $this->thongKeDonHang($ngayBatDauA, $ngayKetThucA);
        //Tính tổng đơn hàng từ đầu năm cho đến ngày B
        $tongDonHangB = $this->thongKeDonHang($ngayBatDauB, $ngayKetThucB);
        //Tính tỉ lệ của $tongDonHangB so với $tongDonHangA
        if ($tongDonHangB <> 0) {
            $tiLeTangTruong = round(($tongDonHangB - $tongDonHangA) / $tongDonHangA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongDonHangB * 100, 2);
        }

        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng năm
    public function tiLeTangTruongNam($namA, $namB)
    {
        $namA = new Carbon($namA . "-01-01");
        $namB = new Carbon($namB . "-01-01");
        //Tính tổng đơn hàng từ đầu năm cho đến ngày A
        $tongDonHangA = $this->thongKeDonHang($namA->copy()->startOfYear(), $namA->copy()->endOfYear());
        //Tính tổng đơn hàng từ đầu năm cho đến ngày B
        $tongDonHangB = $this->thongKeDonHang($namB->copy()->startOfYear(), $namB->copy()->endOfYear());
        //Tính tỉ lệ của $tongDonHangB so với $tongDonHangA
        if ($tongDonHangB <> 0) {
            $tiLeTangTruong = round(($tongDonHangB - $tongDonHangA) / $tongDonHangA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongDonHangB * 100, 2);
        }
        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng tuần
    public function tiLeTangTruongTuan($ngayA, $ngayB)
    {

        //Tính tổng đơn hàng từ đầu tuần cho đến ngày A
        $tongDonHangA = $this->thongKeDonHang($ngayA->copy()->startOfWeek(), $ngayA);
        //Tính tổng đơn hàng từ đầu tuần cho đến ngày B
        $tongDonHangB = $this->thongKeDonHang($ngayB->copy()->startOfWeek(), $ngayB);
        //Tính tỉ lệ của $tongDonHangB so với $tongDonHangA
        if ($tongDonHangB <> 0) {
            $tiLeTangTruong = round(($tongDonHangB - $tongDonHangA) / $tongDonHangA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongDonHangB * 100, 2);
        }
        return $tiLeTangTruong;
    }



    //Hàm thống kê Đơn hàng
    public function thongKeDonHang($ngayBatDau, $ngayKetThuc)
    {
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        $soluongdonhang = Lichsudonhang::where('id_trangthai', '2')
            ->where('id_nhanvienquanly', Auth::id())
            ->whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
            ->count();
        return $soluongdonhang;
    }


    //Hàm thống kê Đơn hàng theo Năm
    public function thongKeDonHangTheoNam($nam)
    {
        $ngayBatDauNam = $nam->copy()->startOfYear();
        $ngayKetThucNam = $nam->copy()->endOfYear();
        $tongDonHang = $this->thongKeDonHang($ngayBatDauNam, $ngayKetThucNam);
        return $tongDonHang;
    }


    //Hàm thống kê Đơn hàng theo Tháng
    public function thongKeDonHangTheoThang($thang, $nam)
    {
        $ngay = new Carbon($nam . "-" . $thang . "-01");
        $ngayBatDauThang = $ngay->copy()->firstOfMonth();
        $ngayKetThucThang = $ngay->copy()->endOfMonth();
        $tongDonHang = $this->thongKeDonHang($ngayBatDauThang, $ngayKetThucThang);
        return $tongDonHang;
    }


    //Hàm thống kê Đơn hàng theo Tuần
    public function thongKeDonHangTheoTuan($ngay)
    {
        $ngayBatDauTuan = $ngay->copy()->startOfWeek();
        $ngayKetThucTuan = $ngay->copy()->endOfWeek();
        $tongDonHang = $this->thongKeDonHang($ngayBatDauTuan, $ngayKetThucTuan);
        return $tongDonHang;
    }


    //Hàm thống kê Đơn hàng theo Ngày
    public function thongKeDonHangTheoNgay($ngay)
    {
        $tongDonHang = $this->thongKeDonHang($ngay, $ngay);
        return $tongDonHang;
    }



    //Hàm thống kê chi tiết Đơn hàng theo tháng trong Năm
    public function thongKeChiTietDonHangTheoThangTrongNam($nam)
    {
        $tongDonHang = array();
        $tongDonHang[0] = $nam;
        //Tính Tổng số đơn hàng theo tháng
        for ($thang = 1; $thang <= 12; $thang++) {
            //Tính Tổng số đơn hàng theo tháng Năm hiện tại            
            $tongDonHang[$thang] = $this->thongKeDonHangTheoThang($thang, $nam);
        }
        return $tongDonHang;
    }



    //Hàm thống kê chi tiết Đơn hàng theo ngày trong Tuần
    public function thongKeChiTietDonHangTheoNgayTrongTuan($ngay)
    {
        $tongDonHang = array();

        //Tìm thứ trong tuần của Ngày Hiện tại
        $thuHienTai = $ngay->copy()->dayOfWeek + 1;

        for ($thuTrongTuan = 2; $thuTrongTuan <= 8; $thuTrongTuan++) {
            if ($thuHienTai > $thuTrongTuan) {
                $tongDonHang[$thuTrongTuan] = $this->thongKeDonHang(
                    $ngay->copy()->subDays($thuHienTai - $thuTrongTuan),
                    $ngay->copy()->subDays($thuHienTai - $thuTrongTuan)
                );
            } elseif ($thuHienTai == $thuTrongTuan) {
                $tongDonHang[$thuTrongTuan] = $this->thongKeDonHang($ngay, $ngay);
            } else {
                if ($ngay->copy()->addWeek()->lessThan(Carbon::now())) {
                    $tongDonHang[$thuTrongTuan] = $this->thongKeDonHang(
                        $ngay->copy()->addDays($thuTrongTuan - $thuHienTai),
                        $ngay->copy()->addDays($thuTrongTuan - $thuHienTai)
                    );                    
                } else {
                    $tongDonHang[$thuTrongTuan] = null;
                }
            }
        }
        return $tongDonHang;
    }
}
