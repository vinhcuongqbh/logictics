<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dongiatinhtheosoluong;

class DongiatinhtheosoluongController extends Controller
{        
    public function index()    {
        
        //Hiển thị danh sách đơn giá
        $dongiatinhtheosoluong = Dongiatinhtheosoluong::orderBy('tenmathang', 'asc')->get();      

        return view('admin.dongia.tinhtheosoluong.index', ['dongiatinhtheosoluongs' => $dongiatinhtheosoluong]);
    }
   

   
    public function create()
    {       
        return view('admin.dongia.tinhtheosoluong.create');
    }

   

    public function store(Request $request)
    {        
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'tenmathang' => 'required',
            'dongia' => 'required',
        ]);

        //Tạo Đơn giá mới
        $dongiatinhtheosoluong = new Dongiatinhtheosoluong();
        $dongiatinhtheosoluong->tenmathang = $request->tenmathang;
        $dongiatinhtheosoluong->dongia = str_replace(".","", $request->dongia);      
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
       
        $dongiatinhtheosoluong = Dongiatinhtheosoluong::find($id);       

        return view('admin.dongia.tinhtheosoluong.edit', ['dongiatinhtheosoluong' => $dongiatinhtheosoluong]);
    }

   

    public function update(Request $request, $id)
    {        
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'tenmathang' => 'required',
            'dongia' => 'required',
        ]);

        //Cập nhật thông tin Kho hàng
        $dongiatinhtheosoluong = Dongiatinhtheosoluong::find($id);
        $dongiatinhtheosoluong->tenmathang = $request->tenmathang;
        $dongiatinhtheosoluong->dongia = str_replace(".","", $request->dongia);   
        $dongiatinhtheosoluong->save();

        return redirect()->action([DongiatinhtheosoluongController::class, 'index']);
    }

   
    public function destroy($id)
    {    
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
