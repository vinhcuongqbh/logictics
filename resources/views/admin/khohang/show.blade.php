@extends('adminlte::page')

@section('title', 'Thông tin Kho hàng')

@section('content_header')

@stop

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kho hàng</h1>
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
                        <h3 class="card-title">Thông tin Kho hàng</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tenkhohang">Tên Kho hàng</label>
                            <input type="text" id="tenkhohang" name="tenkhohang"
                                value="{{ $khohang->tenkhohang }}" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="sodienthoai">Số điện thoại</label>
                            <input type="tel" id="sodienthoai" name="sodienthoai" placeholder="(+81)123-456-789"
                                value="{{ $khohang->sodienthoai }}" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="diachi">Địa chỉ</label>
                            <input type="text" id="diachi" name="diachi" value="{{ $khohang->diachi }}"
                                class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="lienhekhac">Nhân viên quản lý</label>
                            <div>
                                <select class="custom-select" id="idtrinhdo" name="idtrinhdo" disabled>
                                    <option value="{{ $khohang->id_nhanvienquanly }}">
                                        {{ $khohang->tennhanvien }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                @if ($khohang->id_trangthai == 1)
                                    <a href="{{ route('khohang.delete', $khohang->id) }}" onclick="return confirm('Bạn muốn xóa Kho hàng này?')"><button type="button"
                                            class="btn btn-danger float-right"
                                            style="width: 100px; margin: 5px;">XÓA</button></a>
                                @else
                                    <a href="{{ route('khohang.restore', $khohang->id) }}" onclick="return confirm('Bạn muốn phục hồi Kho hàng này?')"><button type="button"
                                            class="btn btn-success float-right" style="width: 100px; margin: 5px;">PHỤC
                                            HỒI</button></a>
                                @endif
                                <a href="{{ route('khohang.edit', $khohang->id) }}"><button type="button"
                                        class="btn btn-secondary float-right"
                                        style="width: 100px; margin: 5px;">SỬA</button></a>
                                <a href="{{ route('khohang.create') }}"><button type="button"
                                        class="btn btn-primary float-right" style="width: 100px; margin: 5px;">TẠO
                                        MỚI</button></a>

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
