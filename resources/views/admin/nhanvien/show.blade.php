@extends('adminlte::page')

@section('title', 'Thông tin Nhân viên')

@section('content_header')

@stop

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>NHÂN VIÊN</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin Nhân viên</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputStatus">Loại nhân viên</label>
                            <select id="id_loainhanvien" name="id_loainhanvien" class="form-control custom-select" disabled>
                                <option value="{{ $nhanvien->id_loainhanvien }}">{{ $nhanvien->tenloainhanvien }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Họ và tên</label>
                            <input type="text" id="name" name="name" value="{{ $nhanvien->name }}"
                                class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="sodienthoai">Số điện thoại</label>
                            <input type="tel" id="sodienthoai" name="sodienthoai" placeholder="(+81)123-456-789"
                                value="{{ $nhanvien->sodienthoai }}" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ $nhanvien->email }}"
                                class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="diachi">Địa chỉ</label>
                            <input type="text" id="diachi" name="diachi" value="{{ $nhanvien->diachi }}"
                                class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="lienhekhac">Liên hệ khác</label>
                            <input type="text" id="lienhekhac" name="lienhekhac" value="{{ $nhanvien->lienhekhac }}"
                                class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="id_khohangquanly">Kho hàng quản lý</label>
                            <div>
                                <select class="custom-select" id="id_khohangquanly" name="id_khohangquanly" disabled>
                                        <option value="{{ $nhanvien->id_khohangquanly }}">
                                            {{ $nhanvien->tenkhohang }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                @if ($nhanvien->id_trangthai == 1)
                                    <a href="{{ route('nhanvien.delete', $nhanvien->id) }}" onclick="return confirm('Bạn muốn xóa Nhân viên này?')"><button type="button"
                                            class="btn btn-danger float-right"
                                            style="width: 100px; margin: 5px;">XÓA</button></a>
                                @else
                                    <a href="{{ route('nhanvien.restore', $nhanvien->id) }}" onclick="return confirm('Bạn muốn phục hồi Nhân viên này?')"><button type="button"
                                            class="btn btn-success float-right" style="width: 100px; margin: 5px;">PHỤC
                                            HỒI</button></a>
                                @endif
                                <a href="{{ route('nhanvien.edit', $nhanvien->id) }}"><button type="button" class="btn btn-secondary float-right" style="width: 100px; margin: 5px;">SỬA</button></a>
                                <a href="{{ route('nhanvien.create') }}"><button type="button" class="btn btn-primary float-right" style="width: 100px; margin: 5px;">THÊM MỚI</button></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop

@section('css')
@stop

@section('js')

@stop
