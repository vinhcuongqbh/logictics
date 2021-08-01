<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ThongkeController extends Controller
{
    public function thongkedonhang($ngayBatDau, $ngayKetThuc)
    {
        $soluongdonhang = Donhang::where('id_trangthai', '<>', '0')
            ->where('id_nhanvienquanly', Auth::id())
            ->whereBetween('created_at', [$ngayBatDau, $ngayKetThuc])
            ->count();
        return $soluongdonhang;
    }

    public function thongkedonhangtheonam()
    {
        $namHienTai[0] = Carbon::now()->year;
        $namTruoc[0] = Carbon::now()->year - 1;
        //Tính Tổng số đơn hàng theo tháng
        for ($thang = 1; $thang <= 12; $thang++) {
            //Tính Tổng số đơn hàng theo tháng Năm hiện tại
            $ngayBatDauNamHienTai = Carbon::now()->year . '-' . $thang . '-01';
            $ngayKetThucNamHienTai = Carbon::now()->year . '-' . $thang . '-31';
            $namHienTai[$thang] = $this->thongkedonhang($ngayBatDauNamHienTai, $ngayKetThucNamHienTai);

            //Tính Tổng số đơn hàng theo tháng Năm trước
            $ngayBatDauNamTruoc = ((Carbon::now()->year) - 1) . '-' . $thang . '-01';
            $ngayKetThucNamTruoc = ((Carbon::now()->year) - 1) . '-' . $thang . '-31';
            $namTruoc[$thang] = $this->thongkedonhang($ngayBatDauNamTruoc, $ngayKetThucNamTruoc);
        }

        //Tính tỉ lệ đơn hàng Năm hiện tại so với Năm trước
        $ngayHienTai = Carbon::now();
        $ngayBatDauNamHienTai = Carbon::now()->year . '-01-01';
        $ngayNayNamTruoc = ((Carbon::now()->year) - 1) . '-' . Carbon::now()->month . '-' . Carbon::now()->day;
        $ngayBatDauNamTruoc = ((Carbon::now()->year) - 1) . '-' . '01-01';
        $tongDonHangNamHienTai = $this->thongkedonhang($ngayBatDauNamHienTai, $ngayHienTai);
        $tongDonHangNamTruoc = $this->thongkedonhang($ngayBatDauNamTruoc, $ngayNayNamTruoc);
        if ($tongDonHangNamTruoc <> 0)
            $tiLeTangTruong = round(($tongDonHangNamHienTai - $tongDonHangNamTruoc) / $tongDonHangNamTruoc * 100, 2);
        else
            $tiLeTangTruong = round($tongDonHangNamHienTai * 100, 2);

        return view('admin.index', ['namHienTai' => $namHienTai, 'namTruoc' => $namTruoc, 'tongDonHangNamHienTai' => $tongDonHangNamHienTai, 'tiLeTangTruong' => $tiLeTangTruong]);
    }


    public function thongkedonhangtheotuan()
    {
        //Tìm Ngày Hiện tại
        $newDay = new Carbon("2021-7-28");
        $ngayHienTai = $newDay->copy()->startOfDay();
        $ngayKetThuc = $newDay->copy()->endOfDay();
        //Tìm thứ trong tuần của Ngày Hiện tại
        $thuHienTai = $ngayHienTai->dayOfWeek;
        
        for ($thuTrongTuan = 0; $thuTrongTuan <= 6; $thuTrongTuan++) {
            if ($thuHienTai > $thuTrongTuan)
                $tuanHienTai[$thuTrongTuan] = $this->thongkedonhang($ngayKetThuc->copy()->startOfDay()->subDays($thuHienTai-$thuTrongTuan), $ngayKetThuc->copy()->endOfDay()->subDays($thuHienTai-$thuTrongTuan));
            elseif ($thuHienTai == $thuTrongTuan)
                $tuanHienTai[$thuTrongTuan] = $this->thongkedonhang($ngayHienTai, $ngayKetThuc);
            else
                $tuanHienTai[$thuTrongTuan] = $this->thongkedonhang($ngayKetThuc->copy()->startOfDay()->addDays($thuTrongTuan-$thuHienTai), $ngayKetThuc->copy()->endOfDay()->addDays($thuTrongTuan-$thuHienTai));
        }

        return view('admin.index', ['tuanHienTai' => $tuanHienTai]);
    }
}
