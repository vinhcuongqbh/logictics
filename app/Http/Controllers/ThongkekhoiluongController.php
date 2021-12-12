<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ThongkekhoiluongController extends Controller
{
    public function thongKeKhoiLuongDashBoard(Request $request)
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

        //Tính số khối lượng trong ngày
        $khoiLuongTrongNgay = $this->thongKeKhoiLuongTheoNgay($id_nhanvien, Carbon::now());

        //Tính số khối lượng trong tuần
        $khoiLuongTrongTuan = $this->thongKeKhoiLuongTheoTuan($id_nhanvien, Carbon::now());

        //Tính số khối lượng trong tháng
        $khoiLuongTrongThang = $this->thongKeKhoiLuongTheoThang($id_nhanvien, Carbon::now()->month, Carbon::now()->year);

        //Tính số khối lượng trong năm
        $khoiLuongTrongNam = $this->thongKeKhoiLuongTheoNam($id_nhanvien, Carbon::now());

        //Tính tổng số khối lượng năm hiện tại (theo từng tháng)
        $khoiLuongNamHienTai = $this->thongKeChiTietKhoiLuongTheoThangTrongNam($id_nhanvien, Carbon::now()->year);
        //Tính tổng số khối lượng năm trước (theo từng tháng)
        $khoiLuongNamTruoc = $this->thongKeChiTietKhoiLuongTheoThangTrongNam($id_nhanvien, Carbon::now()->year - 1);

        //Tính tỉ lệ tăng trưởng năm hiện tại so với năm trước (tính đến ngày hiện tại)
        $tiLeTangTruongNam = $this->tiLeTangTruong($id_nhanvien, Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear(), Carbon::now()->startOfYear(), Carbon::now());

        //Tính tổng số khối lượng tuần hiện tại (theo từng ngày)
        $khoiLuongTuanHienTai = $this->thongKeChiTietKhoiLuongTheoNgayTrongTuan($id_nhanvien, Carbon::now());
        //Tính tổng số khối lượng tuần trước (theo từng ngày)
        $khoiLuongTuanTruoc = $this->thongKeChiTietKhoiLuongTheoNgayTrongTuan($id_nhanvien, Carbon::now()->subWeek());

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

        return view('admin.thongke.thongkekhoiluong', [
            'khoiLuongTrongNgay' =>  $khoiLuongTrongNgay,
            'khoiLuongTrongTuan' => $khoiLuongTrongTuan,
            'khoiLuongTrongThang' => $khoiLuongTrongThang,
            'khoiLuongTrongNam' => $khoiLuongTrongNam,
            'khoiLuongNamHienTai' =>  $khoiLuongNamHienTai,
            'khoiLuongNamTruoc' => $khoiLuongNamTruoc,
            'khoiLuongTuanTruoc' => $khoiLuongTuanTruoc,
            'khoiLuongTuanHienTai' => $khoiLuongTuanHienTai,
            'tiLeTangTruongNam' => $tiLeTangTruongNam,
            'tiLeTangTruongTuan' => $tiLeTangTruongTuan,
            'nhanviens' => $nhanvien,
            'id_nhanvien' => $id_nhanvien,
        ]);
    }



    //Hàm thống kê Tổng khối lượng
    public function thongKeKhoiLuong($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $tongkhoiluong = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                //->where('id_trangthai', '<>', 6)
                ->where('id_trangthai', '<>', 7)
                ->sum('tongkhoiluong');
        } else {
            $tongkhoiluong = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                //->where('id_trangthai', '<>', 6)
                ->where('id_trangthai', '<>', 7)
                ->where('id_nhanvienkhoitao', $id_nhanvien)               
                ->sum('tongkhoiluong');
        }

        return $tongkhoiluong;
    }



    //Hàm thống kê Tổng khối lượng đường không
    public function thongKeKhoiLuongDuongKhong($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $tongkhoiluong = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 1)
                //->where('id_trangthai', '<>', 6)
                ->where('id_trangthai', '<>', 7)
                ->sum('tongkhoiluong');
        } else {
            $tongkhoiluong = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 1)
                //->where('id_trangthai', '<>', 6)
                ->where('id_trangthai', '<>', 7)
                ->where('id_nhanvienkhoitao', $id_nhanvien)               
                ->sum('tongkhoiluong');
        }

        return $tongkhoiluong;
    }



    //Hàm thống kê Tổng khối lượng đường biển
    public function thongKeKhoiLuongDuongBien($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $tongkhoiluong = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 2)
                //->where('id_trangthai', '<>', 6)
                ->where('id_trangthai', '<>', 7)
                ->sum('tongkhoiluong');
        } else {
            $tongkhoiluong = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 2)
                //->where('id_trangthai', '<>', 6)
                ->where('id_trangthai', '<>', 7)
                ->where('id_nhanvienkhoitao', $id_nhanvien)               
                ->sum('tongkhoiluong');
        }

        return $tongkhoiluong;
    }


    //Hàm thống kê Tổng khối lượng Thất lạc
    public function thongKeKhoiLuongThatLac($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $tongkhoiluong = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_trangthai', 6)
                ->sum('tongkhoiluong');
        } else {
            $tongkhoiluong = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_trangthai', 6)
                ->where('id_nhanvienkhoitao', $id_nhanvien)               
                ->sum('tongkhoiluong');
        }

        return $tongkhoiluong;
    }



    //Hàm thống kê Tổng khối lượng Thất lạc đường không
    public function thongKeKhoiLuongThatLacDuongKhong($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $tongkhoiluong = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 1)
                ->where('id_trangthai', 6)
                ->sum('tongkhoiluong');
        } else {
            $tongkhoiluong = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 1)
                ->where('id_trangthai', 6)
                ->where('id_nhanvienkhoitao', $id_nhanvien)               
                ->sum('tongkhoiluong');
        }

        return $tongkhoiluong;
    }



    //Hàm thống kê Tổng khối lượng Thất lạc đường biển
    public function thongKeKhoiLuongThatLacDuongBien($id_nhanvien, $ngayBatDau, $ngayKetThuc)
    {
        //Nếu Ngày Kết thúc lớn hơn Ngày hiện tại thì Ngày kết thúc = Ngày hiện tại
        $ngayBatDau = $ngayBatDau->copy()->startOfDay();
        if ($ngayKetThuc->greaterThan(Carbon::now())) {
            $ngayKetThuc = Carbon::now()->endOfDay();
        } else {
            $ngayKetThuc = $ngayKetThuc->copy()->endOfDay();
        }

        if ($id_nhanvien == 2) {
            $tongkhoiluong = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 2)
                ->where('id_trangthai', 6)
                ->sum('tongkhoiluong');
        } else {
            $tongkhoiluong = Donhang::whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
                ->where('id_hinhthucgui', 2)
                ->where('id_trangthai', 6)
                ->where('id_nhanvienkhoitao', $id_nhanvien)               
                ->sum('tongkhoiluong');
        }

        return $tongkhoiluong;
    }


    //Hàm thống kê Tổng khối lượng theo Năm
    public function thongKeKhoiLuongTheoNam($id_nhanvien, $nam)
    {
        $ngayBatDauNam = $nam->copy()->startOfYear();
        $ngayKetThucNam = $nam->copy()->endOfYear();
        $tongKhoiLuong = $this->thongKeKhoiLuong($id_nhanvien, $ngayBatDauNam, $ngayKetThucNam);
        return $tongKhoiLuong;
    }


    //Hàm thống kê Tổng khối lượng theo Tháng
    public function thongKeKhoiLuongTheoThang($id_nhanvien, $thang, $nam)
    {
        $ngay = new Carbon($nam . "-" . $thang . "-01");
        $ngayBatDauThang = $ngay->copy()->firstOfMonth();
        $ngayKetThucThang = $ngay->copy()->endOfMonth();
        $tongKhoiLuong = $this->thongKeKhoiLuong($id_nhanvien, $ngayBatDauThang, $ngayKetThucThang);
        return $tongKhoiLuong;
    }


    //Hàm thống kê Tổng khối lượng theo Tuần
    public function thongKeKhoiLuongTheoTuan($id_nhanvien, $ngay)
    {
        $ngayBatDauTuan = $ngay->copy()->startOfWeek();
        $ngayKetThucTuan = $ngay->copy()->endOfWeek();
        $tongKhoiLuong = $this->thongKeKhoiLuong($id_nhanvien, $ngayBatDauTuan, $ngayKetThucTuan);
        return $tongKhoiLuong;
    }


    //Hàm thống kê Tổng khối lượng theo Ngày
    public function thongKeKhoiLuongTheoNgay($id_nhanvien, $ngay)
    {
        $tongKhoiLuong = $this->thongKeKhoiLuong($id_nhanvien, $ngay, $ngay);
        return $tongKhoiLuong;
    }



    //Hàm thống kê chi tiết Tổng khối lượng theo tháng trong Năm
    public function thongKeChiTietKhoiLuongTheoThangTrongNam($id_nhanvien, $nam)
    {
        $tongKhoiLuong = array();
        //Array[0] để chứa tên năm
        $tongKhoiLuong[0] = $nam;
        //Tính Tổng khối lượng theo tháng
        for ($thang = 1; $thang <= 12; $thang++) {
            //Tính Tổng khối lượng theo tháng của Năm hiện tại
            $tongKhoiLuong[$thang] = $this->thongKeKhoiLuongTheoThang($id_nhanvien, $thang, $nam);
        }
        return $tongKhoiLuong;
    }



    //Hàm thống kê chi tiết Tổng khối lượng theo ngày trong Tuần
    public function thongKeChiTietKhoiLuongTheoNgayTrongTuan($id_nhanvien, $ngay)
    {
        $tongKhoiLuong = array();
        $ngayBatDauTuan = $ngay->copy()->startOfWeek();
        for ($thu = 2; $thu <= 8; $thu++) {
            //Tính Tổng khối lượng theo ngày của Tuần hiện tại
            if ($ngayBatDauTuan->lte(Carbon::now())) {
                $tongKhoiLuong[$thu] = $this->thongKeKhoiLuongTheoNgay($id_nhanvien, $ngayBatDauTuan);
                $ngayBatDauTuan->addDay();
            } else {
                $tongKhoiLuong[$thu] = null;
            }
        }

        return $tongKhoiLuong;
    }



    //Hàm tính tỉ lệ tăng trưởng
    public function tiLeTangTruong($id_nhanvien, $ngayBatDauA, $ngayKetThucA, $ngayBatDauB, $ngayKetThucB)
    {
        //Tính tổng khối lượng từ đầu năm cho đến ngày A
        $tongKhoiLuongA = $this->thongKeKhoiLuong($id_nhanvien, $ngayBatDauA, $ngayKetThucA);
        //Tính tổng khối lượng từ đầu năm cho đến ngày B
        $tongKhoiLuongB = $this->thongKeKhoiLuong($id_nhanvien, $ngayBatDauB, $ngayKetThucB);
        //Tính tỉ lệ của $tongKhoiLuongB so với $tongKhoiLuongA
        if ($tongKhoiLuongA <> 0) {
            $tiLeTangTruong = round(($tongKhoiLuongB - $tongKhoiLuongA) / $tongKhoiLuongA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongKhoiLuongB * 100, 2);
        }

        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng năm
    public function tiLeTangTruongNam($id_nhanvien, $namA, $namB)
    {
        $namA = new Carbon($namA . "-01-01");
        $namB = new Carbon($namB . "-01-01");
        //Tính tổng khối lượng từ đầu năm cho đến ngày A
        $tongKhoiLuongA = $this->thongKeKhoiLuong($id_nhanvien, $namA->copy()->startOfYear(), $namA->copy()->endOfYear());
        //Tính tổng khối lượng từ đầu năm cho đến ngày B
        $tongKhoiLuongB = $this->thongKeKhoiLuong($id_nhanvien, $namB->copy()->startOfYear(), $namB->copy()->endOfYear());
        //Tính tỉ lệ của $tongKhoiLuongB so với $tongKhoiLuongA
        if ($tongKhoiLuongB <> 0) {
            $tiLeTangTruong = round(($tongKhoiLuongB - $tongKhoiLuongA) / $tongKhoiLuongA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongKhoiLuongB * 100, 2);
        }
        return $tiLeTangTruong;
    }



    //Hàm tính tỉ lệ tăng trưởng tuần
    public function tiLeTangTruongTuan($id_nhanvien, $ngayA, $ngayB)
    {

        //Tính tổng khối lượng từ đầu tuần cho đến ngày A
        $tongKhoiLuongA = $this->thongKeKhoiLuong($id_nhanvien, $ngayA->copy()->startOfWeek(), $ngayA);
        //Tính tổng khối lượng từ đầu tuần cho đến ngày B
        $tongKhoiLuongB = $this->thongKeKhoiLuong($id_nhanvien, $ngayB->copy()->startOfWeek(), $ngayB);
        //Tính tỉ lệ của $tongKhoiLuongB so với $tongKhoiLuongA
        if ($tongKhoiLuongB <> 0) {
            $tiLeTangTruong = round(($tongKhoiLuongB - $tongKhoiLuongA) / $tongKhoiLuongA * 100, 2);
        } else {
            $tiLeTangTruong = round($tongKhoiLuongB * 100, 2);
        }
        return $tiLeTangTruong;
    }
}
