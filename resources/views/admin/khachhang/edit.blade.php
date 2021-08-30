@extends('adminlte::page')

@section('title', 'Cập nhật thông tin Khách hàng')

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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('khachhang.update', $khachhang->id) }}" method="post" id="khachhang-edit">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="tenkhachhang">Họ và tên</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="tenkhachhang" name="tenkhachhang"
                                    value="{{ $khachhang->tenkhachhang }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="sodienthoai">Số điện thoại</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="tel" id="sodienthoai" name="sodienthoai" placeholder="(+81)123-456-789"
                                    value="{{ $khachhang->sodienthoai }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="diachi">Địa chỉ</label>
                            </div>
                            <div class="col-sm-9">
                                <textarea id="diachi" name="diachi" class="form-control" rows="2"
                                    style="resize: none">{{ $khachhang->diachi }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="email" id="email" name="email" value="{{ $khachhang->email }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="lienhekhac">Liên hệ khác</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="lienhekhac" name="lienhekhac"
                                    value="{{ $khachhang->lienhekhac }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="lienhekhac">Nhân viên quản lý</label>
                            </div>
                            <div class="col-sm-9">
                                <select class="custom-select" id="id_nhanvienquanly" name="id_nhanvienquanly" disabled>
                                    @foreach ($nhanviens as $nhanvien)
                                        <option value="{{ $nhanvien->id }}" @if ($khachhang->id_nhanvienquanly == $nhanvien->id) selected @endif>
                                            {{ $nhanvien->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-4 col-md-3">
                                <button type="submit" class="btn btn-block btn-primary">CẬP NHẬT</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@stop

@section('css')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css">
@stop

@section('js')
<!-- jquery-validation -->
<script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="/vendor/jquery-validation/additional-methods.min.js"></script>
<!-- Page specific script -->
<script>
    $(function() {

        $('#khachhang-edit').validate({
            rules: {
                tenkhachhang: {
                    required: true,
                },
                sodienthoai: {
                    required: true,
                },
                diachi: {
                    required: true,
                },
            },
            messages: {
                tenkhachhang: {
                    required: "Nhập Họ tên của Nhân viên",
                },
                sodienthoai: {
                    required: "Nhập Số điện thoại của Nhân viên",
                },
                diachi: {
                    required: "Nhập Địa chỉ của Nhân viên",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);

            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@stop
