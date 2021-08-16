@extends('adminlte::page')

@section('title', 'Thông tin Khách hàng')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-3">
            <h1>KHÁCH HÀNG</h1>
        </div>
        <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/admin/khachhang">Khách hàng</a></li>
                <li class="breadcrumb-item active">{{ $khachhang->tenkhachhang }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-7">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin Khách hàng</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="tenkhachhang">Họ và tên</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="tenkhachhang" name="tenkhachhang"
                                value="{{ $khachhang->tenkhachhang }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="sodienthoai">Số điện thoại</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="tel" id="sodienthoai" name="sodienthoai" placeholder="(+81)123-456-789"
                                value="{{ $khachhang->sodienthoai }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="diachi">Địa chỉ</label>
                        </div>
                        <div class="col-sm-9">
                            <textarea id="diachi" name="diachi" class="form-control" rows="2" style="resize: none" disabled>{{ $khachhang->diachi }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="email" id="email" name="email" value="{{ $khachhang->email }}"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="lienhekhac">Liên hệ khác</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="lienhekhac" name="lienhekhac" value="{{ $khachhang->lienhekhac }}"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="lienhekhac">Nhân viên quản lý</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="custom-select" id="idtrinhdo" name="idtrinhdo" disabled>
                                <option value="{{ $khachhang->id_nhanvienquanly }}">
                                    {{ $khachhang->name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        {{-- <div class="col-3 col-md-2">
                            <a href="{{ route('khachhang.create') }}"><button type="button"
                                    class="btn btn-block btn-primary">THÊM
                                    MỚI</button></a>
                        </div> --}}
                        <div class="col-3 col-md-2">
                            <a href="{{ route('khachhang.edit', $khachhang->id) }}"><button type="button"
                                    class="btn btn-block btn-secondary">SỬA</button></a>
                        </div>
                        {{-- <div class="col-3 col-md-2">
                            @if ($khachhang->id_trangthai == 1)
                                <a href="{{ route('khachhang.delete', $khachhang->id) }}"
                                    onclick="return confirm('Bạn muốn xóa Khách hàng này?')"><button type="button"
                                        class="btn btn-block btn-danger">XÓA</button></a>
                            @else
                                <a href="{{ route('khachhang.restore', $khachhang->id) }}"
                                    onclick="return confirm('Bạn muốn phục hồi Khách hàng này?')"><button type="button"
                                        class="btn btn-block btn-success">PHỤC
                                        HỒI</button></a>
                            @endif
                        </div> --}}
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
