@extends('adminlte::page')

@section('title', 'Thông tin Khách hàng')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>KHÁCH HÀNG</h1>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin Khách hàng</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="tenkhachhang">Họ và tên</label>
                        <input type="text" id="tenkhachhang" name="tenkhachhang" value="{{ $khachhang->tenkhachhang }}"
                            class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="sodienthoai">Số điện thoại</label>
                        <input type="tel" id="sodienthoai" name="sodienthoai" placeholder="(+81)123-456-789"
                            value="{{ $khachhang->sodienthoai }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="diachi">Địa chỉ</label>
                        <input type="text" id="diachi" name="diachi" value="{{ $khachhang->diachi }}"
                            class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ $khachhang->email }}" class="form-control"
                            disabled>
                    </div>
                    <div class="form-group">
                        <label for="lienhekhac">Liên hệ khác</label>
                        <input type="text" id="lienhekhac" name="lienhekhac" value="{{ $khachhang->lienhekhac }}"
                            class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="lienhekhac">Nhân viên quản lý</label>
                        <div>
                            <select class="custom-select" id="idtrinhdo" name="idtrinhdo" disabled>
                                <option value="{{ $khachhang->id_nhanvienquanly }}">
                                    {{ $khachhang->name }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            @if ($khachhang->id_trangthai == 1)
                            <a href="{{ route('khachhang.delete', $khachhang->id) }}"
                                onclick="return confirm('Bạn muốn xóa Khách hàng này?')"><button type="button"
                                    class="btn btn-danger float-right"
                                    style="width: 100px; margin: 5px;">XÓA</button></a>
                            @else
                            <a href="{{ route('khachhang.restore', $khachhang->id) }}"
                                onclick="return confirm('Bạn muốn phục hồi Khách hàng này?')"><button type="button"
                                    class="btn btn-success float-right" style="width: 100px; margin: 5px;">PHỤC
                                    HỒI</button></a>
                            @endif
                            <a href="{{ route('khachhang.edit', $khachhang->id) }}"><button type="button"
                                    class="btn btn-secondary float-right"
                                    style="width: 100px; margin: 5px;">SỬA</button></a>
                            <a href="{{ route('khachhang.create') }}"><button type="button"
                                    class="btn btn-primary float-right" style="width: 100px; margin: 5px;">THÊM
                                    MỚI</button></a>

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@stop

@section('css')
@stop

@section('js')
@stop
