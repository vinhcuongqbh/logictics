<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Loainhanvien;
use App\Models\Khohang;


class NhanvienController extends Controller
{
    public function index()
    {
        //Hiển thị danh sách Tài khoản đang sử dụng
        $nhanvien = User::join('loainhanviens', 'loainhanviens.id', 'users.id_loainhanvien')
            ->leftjoin('khohangs', 'khohangs.id', 'users.id_khohangquanly')
            ->select('users.*', 'loainhanviens.tenloainhanvien', 'khohangs.tenkhohang')
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.nhanvien.index', ['nhanviens' => $nhanvien]);
    }



    public function danghiviec()
    {
        //Hiển thị danh sách Tài khoản đã nghỉ việc
        $nhanvien = User::where('users.id_trangthai', 0)
            ->join('loainhanviens', 'loainhanviens.id', 'users.id_loainhanvien')
            ->leftjoin('khohangs', 'khohangs.id', 'users.id_khohangquanly')
            ->select('users.*', 'loainhanviens.tenloainhanvien', 'khohangs.tenkhohang')
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.nhanvien.index', ['nhanviens' => $nhanvien]);
    }



    public function create()
    {
        $loainhanvien = Loainhanvien::all();
        $khohang = Khohang::all();
        $password = rand(100000, 999999);
        return view('admin.nhanvien.create', ['loainhanvien' => $loainhanvien, 'password' => $password, 'khohangs' => $khohang]);
    }



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
        $nhanvien->diachi = $request->diachi;
        $nhanvien->email = $request->email;
        $nhanvien->password = Hash::make($request->password);
        $nhanvien->lienhekhac = $request->lienhekhac;
        $nhanvien->id_khohangquanly = $request->id_khohangquanly;
        $nhanvien->tilechietkhau = $request->tilechietkhau;
        $nhanvien->id_trangthai = 1;
        $nhanvien->save();

        return redirect()->route('nhanvien.show', $nhanvien->id);
    }



    public function show($id)
    {

        //Hiển thị thông tin Nhân viên
        $nhanvien = User::where('users.id', $id)
            ->join('loainhanviens', 'loainhanviens.id', 'users.id_loainhanvien')
            ->leftjoin('khohangs', 'khohangs.id', 'users.id_khohangquanly')
            ->select('users.*', 'loainhanviens.tenloainhanvien', 'khohangs.tenkhohang')
            ->first();

        return view('admin.nhanvien.show', ['nhanvien' => $nhanvien]);
    }



    public function edit($id)
    {
        $nhanvien = User::find($id);
        $loainhanvien = LoaiNhanvien::all();
        $khohang = Khohang::all();


        return view('admin.nhanvien.edit', ['nhanvien' => $nhanvien, 'loainhanviens' => $loainhanvien, 'khohangs' => $khohang]);
    }



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
        $nhanvien->tilechietkhau = $request->tilechietkhau;
        $nhanvien->id_khohangquanly = $request->id_khohangquanly;
        $nhanvien->save();

        return redirect()->route('nhanvien.show', $nhanvien->id);
    }


    //Khóa tài khoản Nhân viên
    public function destroy($id)
    {
        $nhanvien = User::find($id);
        $nhanvien->id_trangthai = 0;
        $nhanvien->save();

        return back();
    }


    //Mở lại tài khoản Nhân viên
    public function restore($id)
    {
        $nhanvien = User::find($id);
        $nhanvien->id_trangthai = 1;
        $nhanvien->save();

        return back();
    }


    //Cấp lại mật mã tài khoản Nhân viên
    public function resetpass(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'password' => 'required',
        ]);


        //Cấp lại mật mã tài khoản Nhân viên
        $nhanvien = User::find($request->id_nhanvien);
        $nhanvien->password = Hash::make($request->password);
        $nhanvien->save();

        return back();
    }


    //Hiển thị thông tin tài khoản
    public function thongtintaikhoan()
    {
        //Lấy id nhân viên đang đăng nhập
        $id_nhanvien = Auth::id();

        return redirect()->action(
            [NhanvienController::class, 'show'],
            ['id' => $id_nhanvien]
        );
    }



    //Thoát tài khoản 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
