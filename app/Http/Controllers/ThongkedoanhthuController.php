<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donhang;
use App\Models\Lichsudonhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ThongkedoanhthuController extends Controller
{
    public function thongKeDoanhThuDashBoard()
    {
        //Tính số đơn hàng trong ngày
        $doanhThuTrongNgay = $this->thongKeDoanhThuTheoNgay(Carbon::now());

        //Tính số đơn hàng trong tuần
        $doanhThuTrongTuan = $this->thongKeDoanhThuTheoTuan(Carbon::now());

        //Tính số đơn hàng trong tháng
        $doanhThuTrongThang = $this->thongKeDoanhThuTheoThang(Carbon::now()->month, Carbon::now()->year);

        //Tính số đơn hàng trong năm
        $doanhThuTrongNam = $this->thongKeDoanhThuTheoNam(Carbon::now());

        //Tính tổng số đơn hàng năm hiện tại (theo từng tháng)
        $doanhThuNamHienTai = $this->thongKeChiTietDoanhThuTheoThangTrongNam(Carbon::now()->year);
        //Tính tổng số đơn hàng năm trước (theo từng tháng)
        $doanhThuNamTruoc = $this->thongKeChiTietDoanhThuTheoThangTrongNam(Carbon::now()->year - 1);

        //Tính tỉ lệ tăng trưởng năm hiện tại so với năm trước (tính đến ngày hiện tại)   
        $tiLeTangTruongNam = $this->tiLeTangTruong(Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear(), Carbon::now()->startOfYear(), Carbon::now());

        //Tính tổng số đơn hàng tuần hiện tại (theo từng ngày)
        $doanhThuTuanHienTai = $this->thongKeChiTietDoanhThuTheoNgayTrongTuan(Carbon::now());
        //Tính tổng số đơn hàng tuần trước (theo từng ngày)
        $doanhThuTuanTruoc = $this->thongKeChiTietDoanhThuTheoNgayTrongTuan(Carbon::now()->subWeek());

        //Tính tỉ lệ tăng trưởng tuần hiện tại so với tuần trước (tính đến ngày hiện tại)
        $tiLeTangTruongTuan = $this->tiLeTangTruong(Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek(), Carbon::now()->startOfWeek(), Carbon::now());


        return view('admin.thongke.thongkedoanhthu', [
            'doanhThuTrongNgay' =>  $doanhThuTrongNgay,
            'doanhThuTrongTuan' => $doanhThuTrongTuan,
            'doanhThuTrongThang' => $doanhThuTrongThang,
            'doanhThuTrongNam' => $doanhThuTrongNam,
            'doanhThuNamHienTai' =>  $doanhThuNamHienTai,
            'doanhThuNamTruoc' => $doanhThuNamTruoc,
            'doanhThuTuanHienTai' => $doanhThuTuanHienTai,
            'doanhThuTuanTruoc' => $doanhThuTuanTruoc,
            'tiLeTangTruongNam' => $tiLeTangTruongNam,
            'tiLeTangTruongTuan' => $tiLeTangTruongTuan,
        ]);
    }


    //Hàm tính tỉ lệ tăng trưởng
    public function tiLeTangTruong($ngayBatDauA, $ngayKetThucA, $ngayBatDauB, $ngayKetThucB)
    {
        //Tính tổng đơn hàng từ đầu năm cho đến ngày A
        $tongDoanhThuA = $this->thongKeDoanhThu($ngayBatDauA, $ngayKetThucA);
        //Tính tổng đơn hàng từ đầu năm cho đến ngày B
        $tongDoanhThuB = $this->thongKeDoanhThu($ngayBatDauB, $ngayKetThucB);
        //Tính tỉ lệ của $tongDoanhThuB so với $tongDoanhThuA
        if ($tongDoanhThuB <> 0) {
            $tiLeTangTruong = round(($tongDoanhThuB - $tongDoanhThuA) / $tongDoanhThuA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongDoanhThuB * 100, 2);
        }

        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng năm
    public function tiLeTangTruongNam($namA, $namB)
    {
        $namA = new Carbon($namA . "-01-01");
        $namB = new Carbon($namB . "-01-01");
        //Tính tổng đơn hàng từ đầu năm cho đến ngày A
        $tongDoanhThuA = $this->thongKeDoanhThu($namA->copy()->startOfYear(), $namA->copy()->endOfYear());
        //Tính tổng đơn hàng từ đầu năm cho đến ngày B
        $tongDoanhThuB = $this->thongKeDoanhThu($namB->copy()->startOfYear(), $namB->copy()->endOfYear());
        //Tính tỉ lệ của $tongDoanhThuB so với $tongDoanhThuA
        if ($tongDoanhThuB <> 0) {
            $tiLeTangTruong = round(($tongDoanhThuB - $tongDoanhThuA) / $tongDoanhThuA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongDoanhThuB * 100, 2);
        }
        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng tuần
    public function tiLeTangTruongTuan($ngayA, $ngayB)
    {

        //Tính tổng đơn hàng từ đầu tuần cho đến ngày A
        $tongDoanhThuA = $this->thongKeDoanhThu($ngayA->copy()->startOfWeek(), $ngayA);
        //Tính tổng đơn hàng từ đầu tuần cho đến ngày B
        $tongDoanhThuB = $this->thongKeDoanhThu($ngayB->copy()->startOfWeek(), $ngayB);
        //Tính tỉ lệ của $tongDoanhThuB so với $tongDoanhThuA
        if ($tongDoanhThuB <> 0) {
            $tiLeTangTruong = round(($tongDoanhThuB - $tongDoanhThuA) / $tongDoanhThuA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongDoanhThuB * 100, 2);
        }
        return $tiLeTangTruong;
    }



    //Hàm thống kê Doanh thu
    public function thongKeDoanhThu($ngayBatDau, $ngayKetThuc)
    {
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        $soluongdoanhthu = Lichsudonhang::where('id_trangthai', '2')
            ->where('id_nhanvienquanly', Auth::id())
            ->whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
            ->sum('tongchiphi');
        return round($soluongdoanhthu/1000000, 2);
    }


    //Hàm thống kê Doanh thu theo Năm
    public function thongKeDoanhThuTheoNam($nam)
    {
        $ngayBatDauNam = $nam->copy()->startOfYear();
        $ngayKetThucNam = $nam->copy()->endOfYear();
        $tongDoanhThu = $this->thongKeDoanhThu($ngayBatDauNam, $ngayKetThucNam);
        return $tongDoanhThu;
    }


    //Hàm thống kê Doanh thu theo Tháng
    public function thongKeDoanhThuTheoThang($thang, $nam)
    {
        $ngay = new Carbon($nam . "-" . $thang . "-01");
        $ngayBatDauThang = $ngay->copy()->firstOfMonth();
        $ngayKetThucThang = $ngay->copy()->endOfMonth();
        $tongDoanhThu = $this->thongKeDoanhThu($ngayBatDauThang, $ngayKetThucThang);
        return $tongDoanhThu;
    }


    //Hàm thống kê Doanh thu theo Tuần
    public function thongKeDoanhThuTheoTuan($ngay)
    {
        $ngayBatDauTuan = $ngay->copy()->startOfWeek();
        $ngayKetThucTuan = $ngay->copy()->endOfWeek();
        $tongDoanhThu = $this->thongKeDoanhThu($ngayBatDauTuan, $ngayKetThucTuan);
        return $tongDoanhThu;
    }


    //Hàm thống kê Doanh thu theo Ngày
    public function thongKeDoanhThuTheoNgay($ngay)
    {
        $tongDoanhThu = $this->thongKeDoanhThu($ngay, $ngay);
        return $tongDoanhThu;
    }



    //Hàm thống kê chi tiết Doanh thu theo tháng trong Năm
    public function thongKeChiTietDoanhThuTheoThangTrongNam($nam)
    {
        $tongDoanhThu = array();
        $tongDoanhThu[0] = $nam;
        //Tính Tổng số đơn hàng theo tháng
        for ($thang = 1; $thang <= 12; $thang++) {
            //Tính Tổng số đơn hàng theo tháng Năm hiện tại            
            $tongDoanhThu[$thang] = $this->thongKeDoanhThuTheoThang($thang, $nam);
        }
        return $tongDoanhThu;
    }



    //Hàm thống kê chi tiết Doanh thu theo ngày trong Tuần
    public function thongKeChiTietDoanhThuTheoNgayTrongTuan($ngay)
    {
        $tongDoanhThu = array();

        //Tìm thứ trong tuần của Ngày Hiện tại
        $thuHienTai = $ngay->copy()->dayOfWeek + 1;

        for ($thuTrongTuan = 2; $thuTrongTuan <= 8; $thuTrongTuan++) {
            if ($thuHienTai > $thuTrongTuan) {
                $tongDoanhThu[$thuTrongTuan] = $this->thongKeDoanhThu(
                    $ngay->copy()->subDays($thuHienTai - $thuTrongTuan),
                    $ngay->copy()->subDays($thuHienTai - $thuTrongTuan)
                );
            } elseif ($thuHienTai == $thuTrongTuan) {
                $tongDoanhThu[$thuTrongTuan] = $this->thongKeDoanhThu($ngay, $ngay);
            } else {
                if ($ngay->copy()->addWeek()->lessThan(Carbon::now())) {
                    $tongDoanhThu[$thuTrongTuan] = $this->thongKeDoanhThu(
                        $ngay->copy()->addDays($thuTrongTuan - $thuHienTai),
                        $ngay->copy()->addDays($thuTrongTuan - $thuHienTai)
                    );                    
                } else {
                    $tongDoanhThu[$thuTrongTuan] = null;
                }
            }
        }
        return $tongDoanhThu;
    }
}
