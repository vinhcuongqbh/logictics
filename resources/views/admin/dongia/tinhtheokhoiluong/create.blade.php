@extends('adminlte::page')

@section('title', 'Thêm mới Đơn giá')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-7">
            <h1>ĐƠN GIÁ THEO KHỐI LƯỢNG</h1>
        </div>
        <div class="col-sm-5">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/admin/dongia/dongiatinhtheokhoiluong">Đơn giá theo khối lượng</a>
                </li>
                <li class="breadcrumb-item active">Thêm mới</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm mới Đơn giá</h3>
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
                <form action="{{ route('dongiatinhtheokhoiluong.store') }}" method="post" id="dongia-create">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="khoiluongmax">Khối lượng max (kg)</label>
                            <input type="number" id="khoiluongmax" name="khoiluongmax"
                                value="{{ old('khoiluongmax') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="dongia">Đơn giá (VNĐ)</label>
                            <input type="number" id="dongia" name="dongia" value="{{ old('dongia') }}"
                                class="form-control">
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
{{-- <link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css"> --}}
@stop

@section('js')
<!-- jquery-validation -->
<script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="/vendor/jquery-validation/additional-methods.min.js"></script>
<!-- Page specific script -->
<script>
    $(function() {

        $('#dongia-create').validate({
            rules: {
                khoiluongmax: {
                    required: true,
                    number: true,
                },
                dongia: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                khoiluongmax: {
                    required: "Nhập Khối lượng lớn nhất tính theo Đơn giá này",
                    number: "Nhập kiểu số",
                },
                dongia: {
                    required: "Nhập Đơn giá",
                    number: "Nhập kiểu số",
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
