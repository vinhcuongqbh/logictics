@extends('adminlte::page')

@section('title', 'Thêm mới Khách hàng')

@section('content_header')

@stop

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>KHÁCH HÀNG</h1>
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
                            <div class="form-group">
                                <label for="tenkhachhang">Họ và tên</label>
                                <input type="text" id="tenkhachhang" name="tenkhachhang" value="{{ old('tenkhachhang') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="sodienthoai">Số điện thoại</label>
                                <input type="tel" id="sodienthoai" name="sodienthoai" placeholder="(+81)123-456-789" value="{{ old('sodienthoai') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="diachi">Địa chỉ</label>
                                <input type="text" id="diachi" name="diachi" value="{{ old('diachi') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lienhekhac">Liên hệ khác</label>
                                <input type="text" id="lienhekhac" name="lienhekhac" value="{{ old('lienhekhac') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="col-12">
                                    <input type="submit" value="TẠO MỚI" class="btn btn-primary float-right">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop

@section('css')
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
                    email: {
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
                    email: {
                        required: "Nhập Email của Khách hàng",
                    },
                    diachi: {
                        required: "Nhập địa chỉ của Khách hàng",
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
