@extends('adminlte::page')

@section('title', 'AdminPage')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-3">
            <h1>THỐNG KÊ TỔNG HỢP</h1>
        </div>
        <div class="col-sm-9">
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('thongke.ketquathongke') }}" method="get" id="thongke-index">
                        @csrf                                    
                            <div class="form-group row">
                                @if (Auth::user()->id_loainhanvien == 1)
                                <div class="col-2">
                                    <select class="form-control" id="nhanvien" name="nhanvien">
                                        <option value="2">Tổng hợp</option>
                                        @foreach ($nhanviens as $nhanvien)
                                        <option value="{{ $nhanvien->id }}" @if ($id_nhanvien==$nhanvien->id) selected
                                            @endif>
                                            {{ $nhanvien->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                <div class="col-2">
                                    <input type="date" id="ngaybatdau" name="ngaybatdau" class="form-control">
                                </div>
                                <div class="col-2">
                                    <input type="date" id="ngaybatdau" name="ngayketthuc" class="form-control">
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">Xem</button>
                                </div>   
                            </div>       
                    </form>
                    <!-- /.form -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="donhang-table" class="table table-bordered table-striped">
                        <thead style="text-align: center">
                            <tr>
                                <th>STT</th>
                                <th>Tên Nhân viên</th>
                                <th>Số đơn hàng đã nhận</th>
                                <th>Số đơn hàng thất lạc</th>
                                <th>Doanh thu</th>
                                <th>Lợi nhuận</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($donhangs as $donhang)
                            <tr>
                                <td style="text-align: center"><a href="{{ route('donhang.show', $donhang->id) }}">{{
                                        $donhang->matracuu }}</a>
                                </td>
                                <td><a href="{{ route('donhang.show', $donhang->id) }}">{{ $donhang->tennguoigui }}</a>
                                </td>
                                <td style="text-align: center"><a href="{{ route('donhang.show', $donhang->id) }}">{{
                                        $donhang->sodienthoainguoigui }}</a>
                                </td>
                                <td><a href="{{ route('donhang.show', $donhang->id) }}">{{ $donhang->tennguoinhan }}</a>
                                </td>
                                <td style="text-align: center"><a href="{{ route('donhang.show', $donhang->id) }}">{{
                                        $donhang->sodienthoainguoinhan }}</a>
                                </td>
                                <td style="text-align: right"><a href="{{ route('donhang.show', $donhang->id) }}">{{
                                        number_format($donhang->tongchiphi, 0, '.', '.') }}
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                    {{-- <div class="pagination justify-content-center" style="margin-top: 20px;">
                        {{ $donhangs->links() }}
                    </div> --}}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
@stop

@section('css')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css">
<!-- IonIcons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css">
@stop

@section('js')
<!-- jQuery -->
<script src="/vendor/jquery/jquery.min.js"></script>
@stop