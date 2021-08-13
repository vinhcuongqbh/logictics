@extends('adminlte::page')

@section('title', 'Thêm mới Nhân viên')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>NHÂN VIÊN</h1>
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
                    <h3 class="card-title">Thêm mới Nhân viên</h3>
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
                <form action="{{ route('nhanvien.store') }}" method="post" id="nhanvien-create">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputStatus">Loại nhân viên</label>
                            <select id="id_loainhanvien" name="id_loainhanvien" class="form-control custom-select">
                                <option selected disabled></option>
                                @foreach ($loainhanvien as $i)
                                <option value="{{ $i->id }}">{{ $i->tenloainhanvien }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Họ và tên</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sodienthoai">Số điện thoại</label>
                            <input type="tel" id="sodienthoai" name="sodienthoai" placeholder="(+81)123-456-789"
                                value="{{ old('sodienthoai') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="diachi">Địa chỉ</label>
                            <input type="text" id="diachi" name="diachi" value="{{ old('diachi') }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật mã</label>
                            <input type="text" id="password" name="password" value="{{ $password }}"
                                class="form-control">
                        </div>                        
                        <div class="form-group">
                            <label for="lienhekhac">Liên hệ khác</label>
                            <input type="text" id="lienhekhac" name="lienhekhac" value="{{ old('lienhekhac') }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tilechietkhau">Tỉ lệ chiết khấu</label>
                            <input type="number" id="tilechietkhau" name="tilechietkhau" value="{{ old('tilechietkhau') }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="id_khohangquanly">Kho hàng quản lý</label>
                            <div>
                                <select class="custom-select" id="id_khohangquanly" name="id_khohangquanly">
                                    {{-- <option value="0"></option> --}}
                                    @foreach ($khohangs as $khohang)
                                    <option value="{{ $khohang->id }}">
                                        {{ $khohang->tenkhohang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <input type="submit" value="TẠO MỚI" class="btn btn-primary float-right"
                                    style="width: 100px;">
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

            $('#nhanvien-create').validate({
                rules: {
                    id_loainhanvien: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    sodienthoai: {
                        required: true,
                    },                    
                    diachi: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                },
                messages: {
                    id_loainhanvien: {
                        required: "Chọn Loại nhân viên",
                    },
                    name: {
                        required: "Nhập Họ tên của Nhân viên",
                    },
                    sodienthoai: {
                        required: "Nhập Số điện thoại của Nhân viên",
                    },                    
                    diachi: {
                        required: "Nhập Địa chỉ của Nhân viên",
                    },
                    email: {
                        required: "Nhập Email của Nhân viên",
                    },
                    password: {
                        required: "Nhập Mật mã cho tài khoản của Nhân viên",
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