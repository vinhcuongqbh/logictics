<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ThongkedonhangController extends Controller
{
    public function thongKeDonHangDashBoard(Request $request)
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

        //Tính số đơn hàng trong ngày
        $donHangTrongNgay = $this->thongKeDonHangTheoNgay($id_nhanvien, Carbon::now());

        //Tính số đơn hàng trong tuần
        $donHangTrongTuan = $this->thongKeDonHangTheoTuan($id_nhanvien, Carbon::now());

        //Tính số đơn hàng trong tháng
        $donHangTrongThang = $this->thongKeDonHangTheoThang($id_nhanvien, Carbon::now()->month, Carbon::now()->year);

        //Tính số đơn hàng trong năm
        $donHangTrongNam = $this->thongKeDonHangTheoNam($id_nhanvien, Carbon::now());

        //Tính tổng số đơn hàng năm hiện tại (theo từng tháng)
        $donHangNamHienTai = $this->thongKeChiTietDonHangTheoThangTrongNam($id_nhanvien, Carbon::now()->year);
        //Tính tổng số đơn hàng năm trước (theo từng tháng)
        $donHangNamTruoc = $this->thongKeChiTietDonHangTheoThangTrongNam($id_nhanvien, Carbon::now()->year - 1);

        //Tính tỉ lệ tăng trưởng năm hiện tại so với năm trước (tính đến ngày hiện tại)
        $tiLeTangTruongNam = $this->tiLeTangTruong($id_nhanvien, Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear(), Carbon::now()->startOfYear(), Carbon::now());

        //Tính tổng số đơn hàng tuần hiện tại (theo từng ngày)
        $donHangTuanHienTai = $this->thongKeChiTietDonHangTheoNgayTrongTuan($id_nhanvien, Carbon::now());
        //Tính tổng số đơn hàng tuần trước (theo từng ngày)
        $donHangTuanTruoc = $this->thongKeChiTietDonHangTheoNgayTrongTuan($id_nhanvien, Carbon::now()->subWeek());

        //Tính tỉ lệ tăng trưởng tuần hiện tại so với tuần trước (tính đến ngày hiện tại)
        $tiLeTangTruongTuan = $this->tiLeTangTruong(
            $id_nhanvien,
            Carbon::now()->subWeek()->startOfWeek(),
            Carbon::now()->subWeek(),
            Carbon::now()->startOfWeek(),
            Carbon::now()
        );

        //Danh sách nhân viên
        $nhanvien = User::where('id_loainhanvien', '>', 1)->get();

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
            'nhanviens' => $nhanvien,
            'id_nhanvien' => $id_nhanvien,
        ]);
    }



    //Hàm thống kê Đơn hàng
    public function thongKeDonHang($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $soluongdonhang = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                //->where('id_trangthai', '<>', 6)
                ->where('id_trangthai', '<>', 7)
                ->count();
        } else {
            $soluongdonhang = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                //->where('id_trangthai', '<>', 6)
                ->where('id_trangthai', '<>', 7)
                ->where('id_nhanvienkhoitao', $id_nhanvien)               
                ->count();
        }

        return $soluongdonhang;
    }



    //Hàm thống kê Đơn hàng đường không
    public function thongKeDonHangDuongKhong($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $soluongdonhang = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 1)
                //->where('id_trangthai', '<>', 6)
                ->where('id_trangthai', '<>', 7)
                ->count();
        } else {
            $soluongdonhang = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 1)
                //->where('id_trangthai', '<>', 6)
                ->where('id_trangthai', '<>', 7)
                ->where('id_nhanvienkhoitao', $id_nhanvien)               
                ->count();
        }

        return $soluongdonhang;
    }



    //Hàm thống kê Đơn hàng đường biển
    public function thongKeDonHangDuongBien($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $soluongdonhang = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 2)
                //->where('id_trangthai', '<>', 6)
                ->where('id_trangthai', '<>', 7)
                ->count();
        } else {
            $soluongdonhang = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 2)
                //->where('id_trangthai', '<>', 6)
                ->where('id_trangthai', '<>', 7)
                ->where('id_nhanvienkhoitao', $id_nhanvien)               
                ->count();
        }

        return $soluongdonhang;
    }


    //Hàm thống kê Đơn hàng Thất lạc
    public function thongKeDonHangThatLac($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $soluongdonhang = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_trangthai', 6)
                ->count();
        } else {
            $soluongdonhang = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_trangthai', 6)
                ->where('id_nhanvienkhoitao', $id_nhanvien)               
                ->count();
        }

        return $soluongdonhang;
    }



    //Hàm thống kê Đơn hàng Thất lạc đường không
    public function thongKeDonHangThatLacDuongKhong($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $soluongdonhang = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 1)
                ->where('id_trangthai', 6)
                ->count();
        } else {
            $soluongdonhang = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 1)
                ->where('id_trangthai', 6)
                ->where('id_nhanvienkhoitao', $id_nhanvien)               
                ->count();
        }

        return $soluongdonhang;
    }



    //Hàm thống kê Đơn hàng Thất lạc đường biển
    public function thongKeDonHangThatLacDuongBien($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $soluongdonhang = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 2)
                ->where('id_trangthai', 6)
                ->count();
        } else {
            $soluongdonhang = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 2)
                ->where('id_trangthai', 6)
                ->where('id_nhanvienkhoitao', $id_nhanvien)               
                ->count();
        }

        return $soluongdonhang;
    }


    //Hàm thống kê Đơn hàng theo Năm
    public function thongKeDonHangTheoNam($id_nhanvien, $nam)
    {
        $ngayBatDauNam = $nam->copy()->startOfYear();
        $ngayKetThucNam = $nam->copy()->endOfYear();
        $tongDonHang = $this->thongKeDonHang($id_nhanvien, $ngayBatDauNam, $ngayKetThucNam);
        return $tongDonHang;
    }


    //Hàm thống kê Đơn hàng theo Tháng
    public function thongKeDonHangTheoThang($id_nhanvien, $thang, $nam)
    {
        $ngay = new Carbon($nam . "-" . $thang . "-01");
        $ngayBatDauThang = $ngay->copy()->firstOfMonth();
        $ngayKetThucThang = $ngay->copy()->endOfMonth();
        $tongDonHang = $this->thongKeDonHang($id_nhanvien, $ngayBatDauThang, $ngayKetThucThang);
        return $tongDonHang;
    }


    //Hàm thống kê Đơn hàng theo Tuần
    public function thongKeDonHangTheoTuan($id_nhanvien, $ngay)
    {
        $ngayBatDauTuan = $ngay->copy()->startOfWeek();
        $ngayKetThucTuan = $ngay->copy()->endOfWeek();
        $tongDonHang = $this->thongKeDonHang($id_nhanvien, $ngayBatDauTuan, $ngayKetThucTuan);
        return $tongDonHang;
    }


    //Hàm thống kê Đơn hàng theo Ngày
    public function thongKeDonHangTheoNgay($id_nhanvien, $ngay)
    {
        $tongDonHang = $this->thongKeDonHang($id_nhanvien, $ngay, $ngay);
        return $tongDonHang;
    }



    //Hàm thống kê chi tiết Đơn hàng theo tháng trong Năm
    public function thongKeChiTietDonHangTheoThangTrongNam($id_nhanvien, $nam)
    {
        $tongDonHang = array();
        //Array[0] để chứa tên năm
        $tongDonHang[0] = $nam;
        //Tính Tổng số đơn hàng theo tháng
        for ($thang = 1; $thang <= 12; $thang++) {
            //Tính Tổng số đơn hàng theo tháng của Năm hiện tại
            $tongDonHang[$thang] = $this->thongKeDonHangTheoThang($id_nhanvien, $thang, $nam);
        }
        return $tongDonHang;
    }



    //Hàm thống kê chi tiết Đơn hàng theo ngày trong Tuần
    public function thongKeChiTietDonHangTheoNgayTrongTuan($id_nhanvien, $ngay)
    {
        $tongDonHang = array();
        $ngayBatDauTuan = $ngay->copy()->startOfWeek();
        for ($thu = 2; $thu <= 8; $thu++) {
            //Tính Tổng số đơn hàng theo ngày của Tuần hiện tại
            if ($ngayBatDauTuan->lte(Carbon::now())) {
                $tongDonHang[$thu] = $this->thongKeDonHangTheoNgay($id_nhanvien, $ngayBatDauTuan);
                $ngayBatDauTuan->addDay();
            } else {
                $tongDonHang[$thu] = null;
            }
        }

        return $tongDonHang;
    }



    //Hàm tính tỉ lệ tăng trưởng
    public function tiLeTangTruong($id_nhanvien, $ngayBatDauA, $ngayKetThucA, $ngayBatDauB, $ngayKetThucB)
    {
        //Tính tổng đơn hàng từ đầu năm cho đến ngày A
        $tongDonHangA = $this->thongKeDonHang($id_nhanvien, $ngayBatDauA, $ngayKetThucA);
        //Tính tổng đơn hàng từ đầu năm cho đến ngày B
        $tongDonHangB = $this->thongKeDonHang($id_nhanvien, $ngayBatDauB, $ngayKetThucB);
        //Tính tỉ lệ của $tongDonHangB so với $tongDonHangA
        if ($tongDonHangA <> 0) {
            $tiLeTangTruong = round(($tongDonHangB - $tongDonHangA) / $tongDonHangA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongDonHangB * 100, 2);
        }

        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng năm
    public function tiLeTangTruongNam($id_nhanvien, $namA, $namB)
    {
        $namA = new Carbon($namA . "-01-01");
        $namB = new Carbon($namB . "-01-01");
        //Tính tổng đơn hàng từ đầu năm cho đến ngày A
        $tongDonHangA = $this->thongKeDonHang($id_nhanvien, $namA->copy()->startOfYear(), $namA->copy()->endOfYear());
        //Tính tổng đơn hàng từ đầu năm cho đến ngày B
        $tongDonHangB = $this->thongKeDonHang($id_nhanvien, $namB->copy()->startOfYear(), $namB->copy()->endOfYear());
        //Tính tỉ lệ của $tongDonHangB so với $tongDonHangA
        if ($tongDonHangB <> 0) {
            $tiLeTangTruong = round(($tongDonHangB - $tongDonHangA) / $tongDonHangA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongDonHangB * 100, 2);
        }
        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng tuần
    public function tiLeTangTruongTuan($id_nhanvien, $ngayA, $ngayB)
    {

        //Tính tổng đơn hàng từ đầu tuần cho đến ngày A
        $tongDonHangA = $this->thongKeDonHang($id_nhanvien, $ngayA->copy()->startOfWeek(), $ngayA);
        //Tính tổng đơn hàng từ đầu tuần cho đến ngày B
        $tongDonHangB = $this->thongKeDonHang($id_nhanvien, $ngayB->copy()->startOfWeek(), $ngayB);
        //Tính tỉ lệ của $tongDonHangB so với $tongDonHangA
        if ($tongDonHangB <> 0) {
            $tiLeTangTruong = round(($tongDonHangB - $tongDonHangA) / $tongDonHangA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongDonHangB * 100, 2);
        }
        return $tiLeTangTruong;
    }
}
