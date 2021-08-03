<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donhang;
use App\Models\LichsuDonhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ThongkeController extends Controller
{
    public function dashboard()
    {
        //Tính tổng số đơn hàng năm hiện tại (theo từng tháng)
        $namHienTai = $this->thongkedonhangtheonam(Carbon::now()->year);
        //Tính tổng số đơn hàng năm trước (theo từng tháng)
        $namTruoc = $this->thongkedonhangtheonam(Carbon::now()->year - 1);

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

        //Tính tổng số đơn hàng tuần hiện tại (theo từng ngày)
        $tuanHienTai = $this->thongkedonhangtheotuan(Carbon::now());
        //Tính tổng số đơn hàng tuần trước (theo từng ngày)
        $tuanTruoc = $this->thongkedonhangtheotuan(Carbon::now()->subDays(7));

        //Tính tỉ lệ đơn hàng Tuần hiện tại so với Tuần trước
        $thuHienTai = Carbon::now()->dayOfWeek;
        $tongDonHangTuanHienTai = 0;
        for ($i = 0; $i <= $thuHienTai; $i++) {
            $tongDonHangTuanHienTai = $tongDonHangTuanHienTai + $tuanHienTai[$i];
        }

        $tongDonHangTuanTruoc = 0;
        for ($i = 0; $i <= $thuHienTai; $i++) {
            $tongDonHangTuanTruoc = $tongDonHangTuanTruoc + $tuanTruoc[$i];
        }

        if ($tongDonHangTuanTruoc <> 0) {
            $tiLeTangTruongTuan = round(($tongDonHangTuanHienTai - $tongDonHangTuanTruoc) / $tongDonHangTuanTruoc * 100, 2);
        } else {
            $tiLeTangTruongTuan = round($tongDonHangTuanHienTai * 100, 2);
        }

        return view('admin.index', [
            'namHienTai' =>  $namHienTai, 'namTruoc' => $namTruoc,
            'tongDonHangNamHienTai' => $tongDonHangNamHienTai, 'tiLeTangTruongNam' => $tiLeTangTruongNam,
            'tuanHienTai' => $tuanHienTai, 'tuanTruoc' => $tuanTruoc, 'tongDonHangTuanHienTai' => $tongDonHangTuanHienTai,
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

    public function thongkedonhangtheonam($nam)
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


    public function thongkedonhangtheotuan($ngay)
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
}
