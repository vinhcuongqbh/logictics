<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donhang;
use App\Models\LichsuDonhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ThongkeController extends Controller
{
    
   
    public function thongKeDonHangDashBoard()
    {
        //Tính tổng số đơn hàng năm hiện tại (theo từng tháng)
        $namHienTai = $this->thongKeDonHangTheoNam(Carbon::now()->year);
        //Tính tổng số đơn hàng năm trước (theo từng tháng)
        $namTruoc = $this->thongKeDonHangTheoNam(Carbon::now()->year - 1);

        //Tính tỉ lệ đơn hàng Năm hiện tại so với Năm trước
        $ngayHienTai = Carbon::now()->endOfDay();
        $ngayBatDauNamHienTai = Carbon::now()->year . '-01-01 00:00:00.000000';
        $ngayNayNamTruoc = ((Carbon::now()->year) - 1) . '-' . Carbon::now()->month . '-' . Carbon::now()->day . ' 23:59:59.000000';
        $ngayBatDauNamTruoc = ((Carbon::now()->year) - 1) . '-' . '01-01 00:00:00.000000';
        $tongDonHangNamHienTai = $this->thongkedonhang($ngayBatDauNamHienTai, $ngayHienTai);
        $tongDonHangNamTruoc = $this->thongkedonhang($ngayBatDauNamTruoc, $ngayNayNamTruoc);
        if ($tongDonHangNamTruoc <> 0) {
            $tiLeTangTruongNam = round(($tongDonHangNamHienTai - $tongDonHangNamTruoc) / $tongDonHangNamTruoc * 100, 2);
        } else {
            $tiLeTangTruongNam = round($tongDonHangNamHienTai * 100, 2);
        }
        
        //Tỉ lệ Tăng trưởng Tuần   
        $ngayCuaTuanA = Carbon::now()->subDays(7);     
        $ngayCuaTuanB = Carbon::now();
        $tinhTiLeTangTruongTuan = $this->tinhTiLeTangTruongTuan( $ngayCuaTuanA, $ngayCuaTuanB);
        $donHangTuanA = $tinhTiLeTangTruongTuan[0];
        $donHangTuanB = $tinhTiLeTangTruongTuan[1];
        $tongDonHangTuanB = $tinhTiLeTangTruongTuan[2];
        $tiLeTangTruongTuan = $tinhTiLeTangTruongTuan[3];

        return view('admin.thongke.thongkedonhang', [
            'namHienTai' =>  $namHienTai, 'namTruoc' => $namTruoc,
            'tongDonHangNamHienTai' => $tongDonHangNamHienTai, 'tiLeTangTruongNam' => $tiLeTangTruongNam, 
            'donHangTuanTruoc' => $donHangTuanA, 'donHangTuanHienTai' => $donHangTuanB, 'tongDonHangTuanHienTai' => $tongDonHangTuanB,
            'tiLeTangTruongTuan' => $tiLeTangTruongTuan,
        ]);
    }

    public function thongkedonhang($ngayBatDau, $ngayKetThuc)
    {
        $soluongdonhang = Lichsudonhang::where('id_trangthai', '2')
            ->where('id_nhanvienquanly', Auth::id())
            ->whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
            ->count();
        return $soluongdonhang;
    }

    public function thongKeDonHangTheoNam($nam)
    {
        $tongSoDonHang = array();
        $tongSoDonHang[0] = $nam;
        //Tính Tổng số đơn hàng theo tháng
        for ($thang = 1; $thang <= 12; $thang++) {
            //Tính Tổng số đơn hàng theo tháng Năm hiện tại
            $ngayBatDauNam = $nam . '-' . $thang . '-01 00:00:00.000000';
            $ngayKetThucNam = $nam . '-' . $thang . '-31 23:59:59.000000';
            $tongSoDonHang[$thang] = $this->thongkedonhang($ngayBatDauNam, $ngayKetThucNam);
        }

        return $tongSoDonHang;
    }


    public function thongKeDonHangTheoTuan($ngay)
    {
        //Tìm thứ trong tuần của Ngày Hiện tại
        $thuHienTai = $ngay->dayOfWeek;

        for ($thuTrongTuan = 0; $thuTrongTuan <= 6; $thuTrongTuan++) {
            if ($thuHienTai > $thuTrongTuan) {
                $tongSoDonHang[$thuTrongTuan] = $this->thongkedonhang(
                    $ngay->copy()->startOfDay()->subDays($thuHienTai - $thuTrongTuan),
                    $ngay->copy()->endOfDay()->subDays($thuHienTai - $thuTrongTuan)
                );
            } elseif ($thuHienTai == $thuTrongTuan) {
                $tongSoDonHang[$thuTrongTuan] = $this->thongkedonhang($ngay->copy()->startOfDay(), $ngay->endOfDay());
            } else {
                if ($ngay->lessThan(Carbon::Now())) {
                    $tongSoDonHang[$thuTrongTuan] = $this->thongkedonhang(
                        $ngay->copy()->startOfDay()->addDays($thuTrongTuan - $thuHienTai),
                        $ngay->copy()->endOfDay()->addDays($thuTrongTuan - $thuHienTai)
                    );
                } else {
                    $tongSoDonHang[$thuTrongTuan] = null;
                }
            }
        }

        return $tongSoDonHang;
    }


    public function tinhTiLeTangTruongTuan($tuanA, $tuanB)
    {
        //Tính số đơn hàng tuần A (theo từng ngày)
        $donHangTuanA = $this->thongKeDonHangTheoTuan($tuanA);
        //Tính số đơn hàng tuần B (theo từng ngày)
        $donHangTuanB = $this->thongKeDonHangTheoTuan($tuanB);

        //Tính tỉ lệ đơn hàng Tuần B so với Tuần A
        //Tính thứ trong Tuần
        $thuHienTai = $tuanA->dayOfWeek;

        //Tính tổng số đơn hàng tuần A
        $tongDonHangTuanA = 0;
        for ($i = 0; $i <= $thuHienTai; $i++) {
            $tongDonHangTuanA = $tongDonHangTuanA + $donHangTuanA[$i];
        }
        //Tính tổng số đơn hàng tuần B
        $tongDonHangTuanB = 0;
        for ($i = 0; $i <= $thuHienTai; $i++) {
            $tongDonHangTuanB = $tongDonHangTuanB + $donHangTuanB[$i];
        }

        if ($tongDonHangTuanA <> 0) {
            $tiLeTangTruongTuan = round(($tongDonHangTuanB - $tongDonHangTuanA) / $tongDonHangTuanA * 100, 2);
        } else {
            $tiLeTangTruongTuan = round($tongDonHangTuanB * 100, 2);
        }

        return [$donHangTuanA, $donHangTuanB, $tongDonHangTuanB, $tiLeTangTruongTuan];
    }

}
