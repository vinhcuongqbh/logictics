<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Khohang;
use App\Models\User;


class KhohangController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Khohang::class, 'khohang');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $this->authorize('viewAny', Khohang::class);
        //Hiển thị danh sách kho hàng đang sử dụng
        $khohang = Khohang::where('khohangs.id_trangthai', 1)
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.khohang.index', ['khohangs' => $khohang]);
    }


    public function tamdung()
    {
        $this->authorize('viewAny', Khohang::class);
        //Hiển thị danh sách kho hàng đang sử dụng
        $khohang = Khohang::where('khohangs.id_trangthai', 0)
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.khohang.index', ['khohangs' => $khohang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Khohang::class);
        $nhanvien = User::select('id', 'name')
            ->where('id_loainhanvien', '>', 1)
            ->where('id_trangthai', 1)
            ->get();
        return view('admin.khohang.create', ['nhanviens' => $nhanvien]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Khohang::class);
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'tenkhohang' => 'required',
            'diachi' => 'required',
        ]);


        //Tạo Nhân viên mới
        $khohang = new Khohang;
        $khohang->tenkhohang = $request->tenkhohang;
        $khohang->sodienthoai = $request->sodienthoai;
        $khohang->diachi = $request->diachi;
        $khohang->id_trangthai = 1;
        $khohang->save();

        return redirect()->action([KhohangController::class, 'show'], ['id' => $khohang->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Khohang::class);
        //Hiển thị thông tin Kho hàng
        $khohang = Khohang::where('khohangs.id', $id)
            ->orderBy('khohangs.id', 'asc')
            ->first();

        return view('admin.khohang.show', ['khohang' => $khohang]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Khohang $khohang)
    {
        $this->authorize('update', $khohang);
        $khohang = Khohang::find($id);
        $nhanvien = User::select('id', 'name')
            ->where('id_loainhanvien', '>', 1)
            ->where('id_trangthai', 1)
            ->get();

        return view('admin.khohang.edit', ['khohang' => $khohang, 'nhanviens' => $nhanvien]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Khohang $khohang)
    {
        $this->authorize('update', $khohang);
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'tenkhohang' => 'required',
            'diachi' => 'required',
        ]);

        //Cập nhật thông tin Nhân viên
        $khohang = khohang::find($id);
        $khohang->tenkhohang = $request->tenkhohang;
        $khohang->sodienthoai = $request->sodienthoai;
        $khohang->diachi = $request->diachi;
        $khohang->save();

        return redirect()->action([KhohangController::class, 'show'], ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
