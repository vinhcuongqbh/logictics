@extends('adminlte::page')

@section('title', 'Thêm mới Kho hàng')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-3">
            <h1>Kho hàng</h1>
        </div>
        <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/admin/khohang">Kho hàng</a></li>
                <li class="breadcrumb-item active">Tạo mới</li>
            </ol>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm mới Kho hàng</h3>
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
                <form action="{{ route('khohang.store') }}" method="post" id="khohang-create">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tenkhohang">Tên Kho hàng</label>
                            <input type="text" id="tenkhohang" name="tenkhohang" value="{{ old('tenkhohang') }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sodienthoai">Số điện thoại</label>
                            <input type="tel" id="sodienthoai" name="sodienthoai" placeholder="(+81)123-456-789"
                                value="{{ old('sodienthoai') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="diachi">Địa chỉ</label>
                            <textarea id="diachi" name="diachi" rows="2" style="resize: none;"
                                class="form-control">{{ old('diachi') }}</textarea>
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

        $('#khohang-create').validate({
            rules: {
                tenkhohang: {
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
                tenkhohang: {
                    required: "Nhập Tên của Kho hàng",
                },
                sodienthoai: {
                    required: "Nhập Số điện thoại của Kho hàng",
                },
                diachi: {
                    required: "Nhập Địa chỉ của Kho hàng",
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
