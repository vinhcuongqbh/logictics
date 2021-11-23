@extends('adminlte::page')

@section('title', 'Cập nhật thông tin Nhân viên')

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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('nhanvien.update', $nhanvien->id) }}" method="post" id="nhanvien-edit">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="id_loainhanvien">Loại nhân viên</label>
                            </div>
                            <div class="col-sm-9">
                                <select id="id_loainhanvien" name="id_loainhanvien" class="form-control custom-select">
                                    @foreach ($loainhanviens as $loainhanvien)
                                        <option value="{{ $loainhanvien->id }}" @if ($loainhanvien->id == $nhanvien->id_loainhanvien) {{ 'selected' }} @endif>
                                            {{ $loainhanvien->tenloainhanvien }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="name">Họ và tên</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="name" name="name" value="{{ $nhanvien->name }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="sodienthoai">Số điện thoại</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="tel" id="sodienthoai" name="sodienthoai"
                                    value="{{ $nhanvien->sodienthoai }}" class="form-control">
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
                                <label for="diachi">Địa chỉ</label>
                            </div>
                            <div class="col-sm-9">
                                <textarea id="diachi" name="diachi" class="form-control" rows="2"
                                    style="resize: none;">{{ $nhanvien->diachi }}</textarea>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="lienhekhac">Liên hệ khác</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" id="lienhekhac" name="lienhekhac"
                                    value="{{ $nhanvien->lienhekhac }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="tilechietkhau">Chiết khấu (%)</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="number" id="tilechietkhau" name="tilechietkhau"
                                    value="{{ $nhanvien->tilechietkhau }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="id_khohangquanly">Kho hàng quản lý</label>
                            </div>
                            <div class="col-sm-9">
                                <select class="custom-select" id="id_khohangquanly" name="id_khohangquanly">
                                    {{-- <option value="0"></option> --}}
                                    @foreach ($khohangs as $khohang)
                                        <option value="{{ $khohang->id }}" @if ($nhanvien->id_khohangquanly == $khohang->id) {{ 'selected' }} @endif>
                                            {{ $khohang->tenkhohang }}</option>
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

        $('#nhanvien-edit').validate({
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
                email: {
                    required: true,
                },
                password: {
                    required: true,
                },
                diachi: {
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
                email: {
                    required: "Nhập Email của Nhân viên",
                },
                password: {
                    required: "Nhập Mật mã cho tài khoản của Nhân viên",
                },
                diachi: {
                    required: "Nhập Địa chỉ của Nhân viên",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.col-sm-9').append(error);

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
