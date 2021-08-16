@extends('adminlte::page')

@section('title', 'Thông tin Nhân viên')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-3">
            <h1>NHÂN VIÊN</h1>
        </div>
        <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/admin/nhanvien">Nhân viên</a></li>
                <li class="breadcrumb-item active">{{ $nhanvien->name }}</li>
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
                    <h3 class="card-title">Thông tin Nhân viên</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="id_loainhanvien">Loại nhân viên</label>
                        </div>
                        <div class="col-sm-9">
                            <select id="id_loainhanvien" name="id_loainhanvien" class="form-control custom-select"
                                disabled>
                                <option value="{{ $nhanvien->id_loainhanvien }}">{{ $nhanvien->tenloainhanvien }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="name">Họ và tên</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" value="{{ $nhanvien->name }}"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="sodienthoai">Số điện thoại</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="tel" id="sodienthoai" name="sodienthoai" placeholder="(+81)123-456-789"
                                value="{{ $nhanvien->sodienthoai }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="diachi">Địa chỉ</label>
                        </div>
                        <div class="col-sm-9">
                            <textarea id="diachi" name="diachi" class="form-control" rows="2" style="resize: none;"
                                disabled>{{ $nhanvien->diachi }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="email" id="email" name="email" value="{{ $nhanvien->email }}"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="lienhekhac">Liên hệ khác</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="lienhekhac" name="lienhekhac" value="{{ $nhanvien->lienhekhac }}"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="tilechietkhau">Chiết khấu (%)</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="number" id="tilechietkhau" name="tilechietkhau"
                                value="{{ $nhanvien->tilechietkhau }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="id_khohangquanly">Kho hàng quản lý</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="custom-select" id="id_khohangquanly" name="id_khohangquanly" disabled>
                                <option value="{{ $nhanvien->id_khohangquanly }}">
                                    {{ $nhanvien->tenkhohang }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        {{-- <div class="col-3 col-md-2">
                            <a href="{{ route('nhanvien.create') }}"><button type="button"
                                    class="btn btn-block btn-primary">THÊM</button></a>
                        </div> --}}
                        <div class="col-3 col-md-2">
                            <a href="{{ route('nhanvien.edit', $nhanvien->id) }}"><button type="button"
                                    class="btn btn-block btn-secondary">SỬA</button></a>
                        </div>
                        <div class="col-3 col-md-2">
                            @if ($nhanvien->id_trangthai == 1)
                                <a href="{{ route('nhanvien.delete', $nhanvien->id) }}"
                                    onclick="return confirm('Bạn muốn xóa Nhân viên này?')"><button type="button"
                                        class="btn btn-block btn-danger">XÓA</button></a>
                            @else
                                <a href="{{ route('nhanvien.restore', $nhanvien->id) }}"
                                    onclick="return confirm('Bạn muốn phục hồi Nhân viên này?')"><button type="button"
                                        class="btn btn-block btn-success">PHỤC HỒI</button></a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
</div><!-- /.container-fluid -->
@stop

@section('css')
@stop

@section('js')
@stop
