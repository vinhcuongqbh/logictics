<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dongiatinhtheosoluong;

class DongiatinhtheosoluongController extends Controller
{
    public function index()    
    {
        $this->authorize('viewAny', Dongiatinhtheosoluong::class);

        //Hiển thị danh sách đơn giá
        $dongiatinhtheosoluong = Dongiatinhtheosoluong::orderBy('tenmathang', 'asc')->get();

        return view('admin.dongia.tinhtheosoluong.index', ['dongiatinhtheosoluongs' => $dongiatinhtheosoluong]);
    }



    public function create()
    {
        $this->authorize('create', Dongiatinhtheosoluong::class);

        return view('admin.dongia.tinhtheosoluong.create');
    }



    public function store(Request $request)
    {
        $this->authorize('create', Dongiatinhtheosoluong::class);

        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'tenmathang' => 'required',
            'dongiaduongkhong' => 'required',
            'dongiaduongbien' => 'required',
        ]);

        //Tạo Đơn giá mới
        $dongiatinhtheosoluong = new Dongiatinhtheosoluong();
        $dongiatinhtheosoluong->tenmathang = $request->tenmathang;
        $dongiatinhtheosoluong->dongiaduongkhong = str_replace(".","", $request->dongiaduongkhong);
        $dongiatinhtheosoluong->dongiaduongbien = str_replace(".","", $request->dongiaduongbien);
        $dongiatinhtheosoluong->save();

        return redirect()->action([DongiatinhtheosoluongController::class, 'index']);
    }



    // public function show($id)
    // {
    //     $this->authorize('view', Khohang::class);
    //     //Hiển thị thông tin Kho hàng
    //     $khohang = Khohang::where('khohangs.id', $id)
    //         ->orderBy('khohangs.id', 'asc')
    //         ->first();

    //     return view('admin.khohang.show', ['khohang' => $khohang]);
    // }



    public function edit($id)
    {
        $this->authorize('update', Dongiatinhtheosoluong::class);

        $dongiatinhtheosoluong = Dongiatinhtheosoluong::find($id);

        return view('admin.dongia.tinhtheosoluong.edit', ['dongiatinhtheosoluong' => $dongiatinhtheosoluong]);
    }



    public function update(Request $request, $id)
    {
        $this->authorize('update', Dongiatinhtheosoluong::class);

        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'tenmathang' => 'required',
            'dongiaduongkhong' => 'required',
            'dongiaduongbien' => 'required',
        ]);

        //Cập nhật thông tin Kho hàng
        $dongiatinhtheosoluong = Dongiatinhtheosoluong::find($id);
        $dongiatinhtheosoluong->tenmathang = $request->tenmathang;
        $dongiatinhtheosoluong->dongiaduongkhong = str_replace(".","", $request->dongiaduongkhong);
        $dongiatinhtheosoluong->dongiaduongbien = str_replace(".","", $request->dongiaduongbien);
        $dongiatinhtheosoluong->save();

        return redirect()->action([DongiatinhtheosoluongController::class, 'index']);
    }


    public function destroy($id)
    {
        $this->authorize('delete', Dongiatinhtheosoluong::class);

        $dongiatinhtheosoluong = Dongiatinhtheosoluong::find($id);
        $dongiatinhtheosoluong->delete();

        return back();
    }

    // public function restore($id, Khohang $khohang)
    // {
    //     $this->authorize('restore', $khohang);
    //     $khohang = Khohang::find($id);
    //     $khohang->id_trangthai = 1;
    //     $khohang->save();

    //     return back();
    // }
}
