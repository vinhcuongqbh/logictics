<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khohang;
use App\Models\User;


class KhohangController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Khohang::class);

        //Hiển thị danh sách kho hàng đang sử dụng
        $khohang = Khohang::orderBy('id', 'asc')->get();

        return view('admin.khohang.index', ['khohangs' => $khohang]);
    }

   

    public function create()
    {
        $this->authorize('create', Khohang::class);

        $nhanvien = User::select('id', 'name')
            ->where('id_loainhanvien', '>', 1)
            ->where('id_trangthai', 1)
            ->get();
        return view('admin.khohang.create', ['nhanviens' => $nhanvien]);
    }

    


    public function store(Request $request)
    {
        $this->authorize('create', Khohang::class);

        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'tenkhohang' => 'required',
            'diachi' => 'required',
        ]);


        //Tạo Kho hàng mới
        $khohang = new Khohang;
        $khohang->tenkhohang = $request->tenkhohang;
        $khohang->sodienthoai = $request->sodienthoai;
        $khohang->diachi = $request->diachi;
        $khohang->id_trangthai = 1;
        $khohang->save();

        return redirect()->action([KhohangController::class, 'show'], ['id' => $khohang->id]);
    }

   


    public function show($id)
    {
        $this->authorize('view', Khohang::class);

        //Hiển thị thông tin Kho hàng
        $khohang = Khohang::where('khohangs.id', $id)
            ->orderBy('khohangs.id', 'asc')
            ->first();

        return view('admin.khohang.show', ['khohang' => $khohang]);
    }

   


    public function edit($id)
    {
        $this->authorize('update', Khohang::class);

        $khohang = Khohang::find($id);
        $nhanvien = User::select('id', 'name')
            ->where('id_loainhanvien', '>', 1)
            ->where('id_trangthai', 1)
            ->get();

        return view('admin.khohang.edit', ['khohang' => $khohang, 'nhanviens' => $nhanvien]);
    }

   


    public function update(Request $request, $id)
    {
        $this->authorize('update', Khohang::class);

        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'tenkhohang' => 'required',
            'diachi' => 'required',
        ]);

        //Cập nhật thông tin Kho hàng
        $khohang = khohang::find($id);
        $khohang->tenkhohang = $request->tenkhohang;
        $khohang->sodienthoai = $request->sodienthoai;
        $khohang->diachi = $request->diachi;
        $khohang->save();

        return redirect()->action([KhohangController::class, 'show'], ['id' => $id]);
    }

    


    public function destroy($id, Khohang $khohang)
    {
        $this->authorize('delete', $khohang);

        $khohang = Khohang::find($id);
        $khohang->id_trangthai = 0;
        $khohang->save();

        return back();
    }



    public function restore($id, Khohang $khohang)
    {
        $this->authorize('restore', $khohang);

        $khohang = Khohang::find($id);
        $khohang->id_trangthai = 1;
        $khohang->save();

        return back();
    }



    // public function tamdung()
    // {
    //     $this->authorize('viewAny', Khohang::class);
    //     //Hiển thị danh sách kho hàng đang sử dụng
    //     $khohang = Khohang::where('khohangs.id_trangthai', 0)
    //         ->orderBy('id', 'asc')
    //         ->get();

    //     return view('admin.khohang.index', ['khohangs' => $khohang]);
    // }
}
