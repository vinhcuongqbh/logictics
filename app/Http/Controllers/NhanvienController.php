<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Loainhanvien;
use App\Models\Khohang;


class NhanvienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Hiển thị danh sách Tài khoản đang sử dụng
        $nhanvien = User::where('users.id_trangthai', 1)
            ->join('loainhanviens', 'loainhanviens.id', 'users.id_loainhanvien')
            ->join('khohangs', 'khohangs.id', 'users.id_khohangquanly')
            ->select('users.*', 'loainhanviens.tenloainhanvien', 'khohangs.tenkhohang')
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.nhanvien.index', ['nhanviens' => $nhanvien]);
    }

    public function danghiviec()
    {
        //Hiển thị danh sách Tài khoản đã nghĩ việc
        $nhanvien = User::where('users.id_trangthai', 0)
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.nhanvien.index', ['nhanviens' => $nhanvien]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loainhanvien = Loainhanvien::all();
        $khohang = Khohang::all();
        $password = rand(100000,999999);
        return view('admin.nhanvien.create',['loainhanvien' => $loainhanvien, 'password' => $password, 'khohangs' => $khohang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'id_loainhanvien' => 'required',
            'name' => 'required',
            'sodienthoai' => 'required',
            'email' => 'required|unique:App\Models\User,email',
            'password' => 'required',
            'diachi' => 'required',
        ]);


        //Tạo Nhân viên mới
        $nhanvien = new User;
        $nhanvien->id_loainhanvien = $request->id_loainhanvien;
        $nhanvien->name = $request->name;
        $nhanvien->sodienthoai = $request->sodienthoai;
        $nhanvien->email = $request->email;
        $nhanvien->password = Hash::make($request->password);
        $nhanvien->diachi = $request->diachi;
        $nhanvien->lienhekhac = $request->lienhekhac;
        $nhanvien->id_khohangquanly = $request->id_khohangquanly;
        $nhanvien->id_trangthai = 1;
        $nhanvien->save();

        return redirect()->route('nhanvien.show', $nhanvien->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Hiển thị thông tin Nhân viên
        $nhanvien = User::where('users.id', $id)
            ->join('loainhanviens', 'loainhanviens.id', 'users.id_loainhanvien')
            ->join('khohangs', 'khohangs.id', 'users.id_khohangquanly')
            ->select('users.*', 'loainhanviens.tenloainhanvien', 'khohangs.tenkhohang')
            ->first();

        return view('admin.nhanvien.show', ['nhanvien' => $nhanvien]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nhanvien = User::find($id);
        $loainhanvien = LoaiNhanvien::all();
        $khohang = Khohang::all();


        return view('admin.nhanvien.edit', ['nhanvien' => $nhanvien, 'loainhanviens' => $loainhanvien, 'khohangs' => $khohang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'id_loainhanvien' => 'required',
            'name' => 'required',
            'sodienthoai' => 'required',
            'diachi' => 'required',
        ]);

        //Cập nhật thông tin Nhân viên
        $nhanvien = User::find($id);
        $nhanvien->id_loainhanvien = $request->id_loainhanvien;
        $nhanvien->name = $request->name;
        $nhanvien->sodienthoai = $request->sodienthoai;
        $nhanvien->diachi = $request->diachi;
        $nhanvien->lienhekhac = $request->lienhekhac;
        $nhanvien->id_khohangquanly = $request->id_khohangquanly;
        $nhanvien->save();

        return redirect()->route('nhanvien.show', $nhanvien->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $nhanvien = User::find($id);
        $nhanvien->id_trangthai = 0;
        $nhanvien->save();

        return back();
    }

    public function restore($id)
    {
        $nhanvien = User::find($id);
        $nhanvien->id_trangthai = 1;
        $nhanvien->save();

        return back();
    }

}
