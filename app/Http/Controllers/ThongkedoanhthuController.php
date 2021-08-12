<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lichsudonhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ThongkedoanhthuController extends Controller
{
    public function thongKeDoanhThuDashBoard(Request $request)
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
        //Tính doanh thu số đơn hàng trong ngày
        $doanhThuTrongNgay = $this->thongKeDoanhThuTheoNgay($id_nhanvien, Carbon::now());

        //Tính doanh thu số đơn hàng trong tuần
        $doanhThuTrongTuan = $this->thongKeDoanhThuTheoTuan($id_nhanvien, Carbon::now());

        //Tính doanh thu số đơn hàng trong tháng
        $doanhThuTrongThang = $this->thongKeDoanhThuTheoThang($id_nhanvien, Carbon::now()->month, Carbon::now()->year);

        //Tính doanh thu số đơn hàng trong năm
        $doanhThuTrongNam = $this->thongKeDoanhThuTheoNam($id_nhanvien, Carbon::now());

        //Tính doanh thu tổng số đơn hàng năm hiện tại (theo từng tháng)
        $doanhThuNamHienTai = $this->thongKeChiTietDoanhThuTheoThangTrongNam($id_nhanvien, Carbon::now()->year);
        //Tính doanh thu tổng số đơn hàng năm trước (theo từng tháng)
        $doanhThuNamTruoc = $this->thongKeChiTietDoanhThuTheoThangTrongNam($id_nhanvien, Carbon::now()->year - 1);

        //Tính tỉ lệ tăng trưởng năm hiện tại so với năm trước (tính đến ngày hiện tại)
        $tiLeTangTruongNam = $this->tiLeTangTruong($id_nhanvien, Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear(), Carbon::now()->startOfYear(), Carbon::now());

        //Tính doanh thu tổng số đơn hàng tuần hiện tại (theo từng ngày)
        $doanhThuTuanHienTai = $this->thongKeChiTietDoanhThuTheoNgayTrongTuan($id_nhanvien, Carbon::now());
        //Tính doanh thu tổng số đơn hàng tuần trước (theo từng ngày)
        $doanhThuTuanTruoc = $this->thongKeChiTietDoanhThuTheoNgayTrongTuan($id_nhanvien, Carbon::now()->subWeek());

        //Tính tỉ lệ tăng trưởng tuần hiện tại so với tuần trước (tính đến ngày hiện tại)
        $tiLeTangTruongTuan = $this->tiLeTangTruong($id_nhanvien, Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek(), Carbon::now()->startOfWeek(), Carbon::now());

        //Danh sách nhân viên
        $nhanvien = User::where('id_loainhanvien', '>', 1)->get();

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
            'nhanviens' => $nhanvien,
            'id_nhanvien' => $id_nhanvien,
        ]);
    }



    //Hàm thống kê Doanh thu
    public function thongKeDoanhThu($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $soluongdoanhthu = Lichsudonhang::where('id_trangthai', '2')
                ->where('id_nhanvienquanly', 3)
                ->whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->sum('tongchiphi');
        } else {
            $soluongdoanhthu = Lichsudonhang::where('id_trangthai', '2')
                ->where('id_nhanvienquanly', $id_nhanvien)
                ->whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->sum('tongchiphi');
        }
        return round($soluongdoanhthu / 1000000, 2);
    }


    //Hàm thống kê Doanh thu theo Năm
    public function thongKeDoanhThuTheoNam($id_nhanvien, $nam)
    {
        $ngayBatDauNam = $nam->copy()->startOfYear();
        $ngayKetThucNam = $nam->copy()->endOfYear();
        $tongDoanhThu = $this->thongKeDoanhThu($id_nhanvien, $ngayBatDauNam, $ngayKetThucNam);
        return $tongDoanhThu;
    }


    //Hàm thống kê Doanh thu theo Tháng
    public function thongKeDoanhThuTheoThang($id_nhanvien, $thang, $nam)
    {
        $ngay = new Carbon($nam . "-" . $thang . "-01");
        $ngayBatDauThang = $ngay->copy()->firstOfMonth();
        $ngayKetThucThang = $ngay->copy()->endOfMonth();
        $tongDoanhThu = $this->thongKeDoanhThu($id_nhanvien, $ngayBatDauThang, $ngayKetThucThang);
        return $tongDoanhThu;
    }


    //Hàm thống kê Doanh thu theo Tuần
    public function thongKeDoanhThuTheoTuan($id_nhanvien, $ngay)
    {
        $ngayBatDauTuan = $ngay->copy()->startOfWeek();
        $ngayKetThucTuan = $ngay->copy()->endOfWeek();
        $tongDoanhThu = $this->thongKeDoanhThu($id_nhanvien, $ngayBatDauTuan, $ngayKetThucTuan);
        return $tongDoanhThu;
    }


    //Hàm thống kê Doanh thu theo Ngày
    public function thongKeDoanhThuTheoNgay($id_nhanvien, $ngay)
    {
        $tongDoanhThu = $this->thongKeDoanhThu($id_nhanvien, $ngay, $ngay);
        return $tongDoanhThu;
    }



    //Hàm thống kê chi tiết Doanh thu theo tháng trong Năm
    public function thongKeChiTietDoanhThuTheoThangTrongNam($id_nhanvien, $nam)
    {
        $tongDoanhThu = array();
        $tongDoanhThu[0] = $nam;
        //Tính doanh thu tổng số đơn hàng theo tháng
        for ($thang = 1; $thang <= 12; $thang++) {
            //Tính doanh thu tổng số đơn hàng theo tháng của Năm hiện tại
            $tongDoanhThu[$thang] = $this->thongKeDoanhThuTheoThang($id_nhanvien, $thang, $nam);
        }
        return $tongDoanhThu;
    }



    //Hàm thống kê chi tiết Doanh thu theo ngày trong Tuần
    public function thongKeChiTietDoanhThuTheoNgayTrongTuan($id_nhanvien, $ngay)
    {
        $tongDoanhThu = array();
        $ngayBatDauTuan = $ngay->copy()->startOfWeek();
        for ($thu = 2; $thu <= 8; $thu++) {
            //Tính Tổng số đơn hàng theo ngày của Tuần hiện tại
            if ($ngayBatDauTuan->lte(Carbon::now())) {
                $tongDoanhThu[$thu] = $this->thongKeDoanhThuTheoNgay($id_nhanvien, $ngayBatDauTuan);
                $ngayBatDauTuan->addDay();
            } else {
                $tongDoanhThu[$thu] = null;
            }
        }

        return $tongDoanhThu;
    }



    //Hàm tính tỉ lệ tăng trưởng
    public function tiLeTangTruong($id_nhanvien, $ngayBatDauA, $ngayKetThucA, $ngayBatDauB, $ngayKetThucB)
    {
        //Tính tổng đơn hàng từ đầu năm cho đến ngày A
        $tongDoanhThuA = $this->thongKeDoanhThu($id_nhanvien, $ngayBatDauA, $ngayKetThucA);
        //Tính tổng đơn hàng từ đầu năm cho đến ngày B
        $tongDoanhThuB = $this->thongKeDoanhThu($id_nhanvien, $ngayBatDauB, $ngayKetThucB);
        //Tính tỉ lệ của $tongDoanhThuB so với $tongDoanhThuA
        if ($tongDoanhThuB <> 0) {
            $tiLeTangTruong = round(($tongDoanhThuB - $tongDoanhThuA) / $tongDoanhThuA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongDoanhThuB * 100, 2);
        }

        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng năm
    public function tiLeTangTruongNam($id_nhanvien, $namA, $namB)
    {
        $namA = new Carbon($namA . "-01-01");
        $namB = new Carbon($namB . "-01-01");
        //Tính tổng đơn hàng từ đầu năm cho đến ngày A
        $tongDoanhThuA = $this->thongKeDoanhThu($id_nhanvien, $namA->copy()->startOfYear(), $namA->copy()->endOfYear());
        //Tính tổng đơn hàng từ đầu năm cho đến ngày B
        $tongDoanhThuB = $this->thongKeDoanhThu($id_nhanvien, $namB->copy()->startOfYear(), $namB->copy()->endOfYear());
        //Tính tỉ lệ của $tongDoanhThuB so với $tongDoanhThuA
        if ($tongDoanhThuB <> 0) {
            $tiLeTangTruong = round(($tongDoanhThuB - $tongDoanhThuA) / $tongDoanhThuA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongDoanhThuB * 100, 2);
        }
        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng tuần
    public function tiLeTangTruongTuan($id_nhanvien, $ngayA, $ngayB)
    {

        //Tính tổng đơn hàng từ đầu tuần cho đến ngày A
        $tongDoanhThuA = $this->thongKeDoanhThu($id_nhanvien, $ngayA->copy()->startOfWeek(), $ngayA);
        //Tính tổng đơn hàng từ đầu tuần cho đến ngày B
        $tongDoanhThuB = $this->thongKeDoanhThu($id_nhanvien, $ngayB->copy()->startOfWeek(), $ngayB);
        //Tính tỉ lệ của $tongDoanhThuB so với $tongDoanhThuA
        if ($tongDoanhThuB <> 0) {
            $tiLeTangTruong = round(($tongDoanhThuB - $tongDoanhThuA) / $tongDoanhThuA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongDoanhThuB * 100, 2);
        }
        return $tiLeTangTruong;
    }
}
