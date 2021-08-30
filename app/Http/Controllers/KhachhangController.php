<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khachhang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KhachhangController extends Controller
{
    public function index()
    {
        //Hiển thị danh sách Tài khoản đang sử dụng
        if (Auth::user()->id_loainhanvien == 1) {
            $khachhang = Khachhang::join('users', 'users.id', 'khachhangs.id_nhanvienquanly')
                ->select('khachhangs.*', 'users.name')
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $khachhang = Khachhang::where('id_nhanvienquanly', Auth::id())
                ->join('users', 'users.id', 'khachhangs.id_nhanvienquanly')
                ->select('khachhangs.*', 'users.name')
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('admin.khachhang.index', ['khachhangs' => $khachhang]);
    }

    // public function daxoa()
    // {
    //     //Hiển thị danh sách Tài khoản đã xóa
    //     $khachhang = Khachhang::where('khachhangs.id_trangthai', 0)
    //         ->join('users', 'users.id', 'khachhangs.id_nhanvienquanly')
    //         ->select('khachhangs.*', 'users.name')
    //         ->orderBy('id', 'asc')
    //         ->get();

    //     return view('admin.khachhang.index', ['khachhangs' => $khachhang]);
    // }


    // public function create()
    // {
    //     return view('admin.khachhang.create');
    // }


    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'tenkhachhang' => 'required',
            'sodienthoai' => 'required|unique:App\Models\Khachhang,sodienthoai',
            'diachi' => 'required',
        ]);

        //Tạo Khách hàng mới
        //Kiểm tra Thông tin Khách hàng đã có trong cơ sở dữ liệu hay chưa
        $count = Khachhang::where('sodienthoai', $request->sodienthoai)->count();

        //Nếu chưa thì thêm mới dữ liệu
        if ($count == 0) {
            $khachhang = new Khachhang;
            $khachhang->tenkhachhang = $request->tenkhachhang;
            $khachhang->sodienthoai = $request->sodienthoai;
            $khachhang->email = $request->email;
            $khachhang->diachi = $request->diachi;
            $khachhang->lienhekhac = $request->lienhekhac;
            $khachhang->id_nhanvienquanly = Auth::id();
            $khachhang->id_trangthai = 1;
            $khachhang->save();
        }

        //return redirect()->action([KhachhangController::class, 'show'], ['id' => $khachhang->id]);
    }

    



    public function show($id)
    {
        //Hiển thị thông tin Khách hàng
        $khachhang = Khachhang::where('khachhangs.id', $id)
            ->join('users', 'users.id', 'khachhangs.id_nhanvienquanly')
            ->select('khachhangs.*', 'users.name')
            ->first();
        return view('admin.khachhang.show', ['khachhang' => $khachhang]);
    }



    public function edit($id)
    {
        $khachhang = Khachhang::find($id);
        $nhanvien = User::select('id', 'name')
            ->where('id_loainhanvien', '>', 1)
            ->where('id_trangthai', 1)
            ->get();

        return view('admin.khachhang.edit', ['khachhang' => $khachhang, 'nhanviens' => $nhanvien]);
    }



    public function update(Request $request, $id)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'tenkhachhang' => 'required',
            'sodienthoai' => 'required',
            'diachi' => 'required',
        ]);

        //Cập nhật thông tin Khách hàng
        $khachhang = Khachhang::find($id);
        $khachhang->tenkhachhang = $request->tenkhachhang;
        $khachhang->sodienthoai = $request->sodienthoai;
        $khachhang->diachi = $request->diachi;
        $khachhang->email = $request->email;
        $khachhang->lienhekhac = $request->lienhekhac;
        //$khachhang->id_nhanvienquanly = $request->id_nhanvienquanly;
        $khachhang->save();

        return redirect()->action([KhachhangController::class, 'show'], ['id' => $id]);
    }



    // public function destroy($id)
    // {
    //     $khachhang = Khachhang::find($id);
    //     $khachhang->id_trangthai = 0;
    //     $khachhang->save();

    //     return back();
    // }



    // public function restore($id)
    // {
    //     $khachhang = Khachhang::find($id);
    //     $khachhang->id_trangthai = 1;
    //     $khachhang->save();

    //     return back();
    // }
}
