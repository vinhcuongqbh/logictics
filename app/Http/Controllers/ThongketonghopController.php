<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donhang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class ThongketonghopController extends Controller
{
    public function thongKeTongHopDashBoard(Request $request)
    {
        $nhanvien = User::where('id_loainhanvien', '>', 1)->get();
        $id_nhanvien = $request->nhanvien;
        return view('admin.thongke.thongketonghop', [
            'nhanviens' =>  $nhanvien,
            'id_nhanvien' => $id_nhanvien,
        ]);
    }


    //Kết quả thống kê
    public function ketQuaThongKe(Request $request)
    {
        $nhanviens = User::where('id_loainhanvien', '>', 1)->get();
        $id_nhanvien = $request->nhanvien;
        $ngayBatDau = new Carbon($request->ngaybatdau);
        $ngayKetThuc = new Carbon($request->ngayketthuc);

        $thongkedonhang = new ThongkedonhangController;
        $thongkedoanhthu = new ThongkedoanhthuController;
        $thongkeloinhuan = new ThongkeloinhuanController;

        //Tạo Collection để lưu trữ dữ liệu thống kê
        $thongke = collect();

        if ($id_nhanvien == 2) {
            foreach ($nhanviens as $nhanvien) {
                $sodonhangdanhanduongkhong = $thongkedonhang->thongKeDonHangDuongKhong($nhanvien->id, $ngayBatDau, $ngayKetThuc);
                $sodonhangdanhanduongbien = $thongkedonhang->thongKeDonHangDuongBien($nhanvien->id, $ngayBatDau, $ngayKetThuc);
                $sodonhangdanhan = $sodonhangdanhanduongkhong + $sodonhangdanhanduongbien;
                $sodonhangthatlacduongkhong = $thongkedonhang->thongKeDonHangThatLacDuongKhong($nhanvien->id, $ngayBatDau, $ngayKetThuc);
                $sodonhangthatlacduongbien = $thongkedonhang->thongKeDonHangThatLacDuongBien($nhanvien->id, $ngayBatDau, $ngayKetThuc);
                $sodonhangthatlac = $sodonhangthatlacduongkhong + $sodonhangthatlacduongbien;
                $doanhthu =  $thongkedoanhthu->thongKeDoanhThu($nhanvien->id, $ngayBatDau, $ngayKetThuc);
                $loinhuan =  $thongkeloinhuan->thongKeLoiNhuan($nhanvien->id, $ngayBatDau, $ngayKetThuc);

                $thongke->push([
                    'id_nhanvien' => $nhanvien->id,
                    'tennhanvien' => $nhanvien->name,
                    'sodonhangdanhan' => $sodonhangdanhan,
                    'sodonhangdanhanduongkhong' => $sodonhangdanhanduongkhong,
                    'sodonhangdanhanduongbien' => $sodonhangdanhanduongbien,
                    'sodonhangthatlac' => $sodonhangthatlac,
                    'sodonhangthatlacduongkhong' => $sodonhangthatlacduongkhong,
                    'sodonhangthatlacduongbien' => $sodonhangthatlacduongbien,
                    'doanhthu' => $doanhthu,
                    'loinhuan' => $loinhuan,
                ]);
            }
        } else {
            $sodonhangdanhanduongkhong = $thongkedonhang->thongKeDonHangDuongKhong($id_nhanvien, $ngayBatDau, $ngayKetThuc);
            $sodonhangdanhanduongbien = $thongkedonhang->thongKeDonHangDuongBien($id_nhanvien, $ngayBatDau, $ngayKetThuc);
            $sodonhangdanhan = $sodonhangdanhanduongkhong + $sodonhangdanhanduongbien;
            $sodonhangthatlacduongkhong = $thongkedonhang->thongKeDonHangThatLacDuongKhong($id_nhanvien, $ngayBatDau, $ngayKetThuc);
            $sodonhangthatlacduongbien = $thongkedonhang->thongKeDonHangThatLacDuongBien($id_nhanvien, $ngayBatDau, $ngayKetThuc);
            $sodonhangthatlac = $sodonhangthatlacduongkhong + $sodonhangthatlacduongbien;
            $doanhthu =  $thongkedoanhthu->thongKeDoanhThu($id_nhanvien, $ngayBatDau, $ngayKetThuc);
            $loinhuan =  $thongkeloinhuan->thongKeLoiNhuan($id_nhanvien, $ngayBatDau, $ngayKetThuc);

            $thongke->push([
                'id_nhanvien' => $id_nhanvien,
                'tennhanvien' => User::find($id_nhanvien)->name,
                'sodonhangdanhan' => $sodonhangdanhan,
                'sodonhangdanhanduongkhong' => $sodonhangdanhanduongkhong,
                'sodonhangdanhanduongbien' => $sodonhangdanhanduongbien,
                'sodonhangthatlac' => $sodonhangthatlac,
                'sodonhangthatlacduongkhong' => $sodonhangthatlacduongkhong,
                'sodonhangthatlacduongbien' => $sodonhangthatlacduongbien,
                'doanhthu' => $doanhthu,
                'loinhuan' => $loinhuan,
            ]);
        }


        return view('admin.thongke.ketquathongke', [
            'nhanviens' => $nhanviens,
            'id_nhanvien' => $id_nhanvien,
            'ngaybatdau' => $request->ngaybatdau,
            'ngayketthuc' => $request->ngayketthuc,
            'thongkes' => $thongke,
        ]);
    }
}
