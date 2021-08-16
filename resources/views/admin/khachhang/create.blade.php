@extends('adminlte::page')

@section('title', 'Thêm mới Khách hàng')

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
                <li class="breadcrumb-item active">Thêm mới</li>
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
                    <h3 class="card-title">Thêm mới Khách hàng</h3>
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
                <form action="{{ route('khachhang.store') }}" method="post" id="khachhang-create">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="tenkhachhang">Họ và tên</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="tenkhachhang" name="tenkhachhang"
                                    value="{{ old('tenkhachhang') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="sodienthoai">Số điện thoại</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="tel" id="sodienthoai" name="sodienthoai" placeholder="(+81)123-456-789"
                                    value="{{ old('sodienthoai') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="diachi">Địa chỉ</label>
                            </div>
                            <div class="col-sm-9">
                                <textarea id="diachi" name="diachi" class="form-control" rows="2"
                                    style="resize: none">{{ old('diachi') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="lienhekhac">Liên hệ khác</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="lienhekhac" name="lienhekhac" value="{{ old('lienhekhac') }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-4 col-md-3">
                                <button type="submit" class="btn btn-block btn-primary">TẠO MỚI</button>
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
        $('#khachhang-create').validate({
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
                    required: "Nhập Họ tên của Khách hàng",
                },
                sodienthoai: {
                    required: "Nhập Số điện thoại của Khách hàng",
                },
                diachi: {
                    required: "Nhập Địa chỉ của Khách hàng",
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
