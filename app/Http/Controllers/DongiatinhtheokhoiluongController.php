<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dongiatinhtheokhoiluong;

class DongiatinhtheokhoiluongController extends Controller
{
    public function index()    {

        //Hiển thị danh sách đơn giá
        $dongiatinhtheokhoiluong = Dongiatinhtheokhoiluong::orderBy('khoiluongmax', 'asc')->get();

        return view('admin.dongia.tinhtheokhoiluong.index', ['dongiatinhtheokhoiluongs' => $dongiatinhtheokhoiluong]);
    }



    public function create()
    {
        return view('admin.dongia.tinhtheokhoiluong.create');
    }



    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'khoiluongmax' => 'required',
            'dongiaduongkhong' => 'required',
            'dongiaduongbien' => 'required',
        ]);

        //Tạo Đơn giá mới
        $dongiatinhtheokhoiluong = new Dongiatinhtheokhoiluong();
        $dongiatinhtheokhoiluong->khoiluongmax = $request->khoiluongmax;
        $dongiatinhtheokhoiluong->dongiaduongkhong = str_replace(".","", $request->dongiaduongkhong);
        $dongiatinhtheokhoiluong->dongiaduongbien = str_replace(".","", $request->dongiaduongbien);
        $dongiatinhtheokhoiluong->save();

        return redirect()->action([DongiatinhtheokhoiluongController::class, 'index']);
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

        $dongiatinhtheokhoiluong = Dongiatinhtheokhoiluong::find($id);

        return view('admin.dongia.tinhtheokhoiluong.edit', ['dongiatinhtheokhoiluong' => $dongiatinhtheokhoiluong]);
    }



    public function update(Request $request, $id)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'khoiluongmax' => 'required',
            'dongiaduongkhong' => 'required',
            'dongiaduongbien' => 'required',
        ]);

        //Cập nhật thông tin Kho hàng
        $dongiatinhtheokhoiluong = Dongiatinhtheokhoiluong::find($id);
        $dongiatinhtheokhoiluong->khoiluongmax = $request->khoiluongmax;
        $dongiatinhtheokhoiluong->dongiaduongkhong = str_replace(".","", $request->dongiaduongkhong);
        $dongiatinhtheokhoiluong->dongiaduongbien = str_replace(".","", $request->dongiaduongbien);
        $dongiatinhtheokhoiluong->save();

        return redirect()->action([DongiatinhtheokhoiluongController::class, 'index']);
    }


    public function destroy($id)
    {
        $dongiatinhtheokhoiluong = Dongiatinhtheokhoiluong::find($id);
        $dongiatinhtheokhoiluong->delete();

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
