@extends('adminlte::page')

@section('title', 'Cập nhật Đơn giá')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-7">
            <h1>ĐƠN GIÁ TÍNH THEO SỐ LƯỢNG</h1>
        </div>
        <div class="col-sm-5">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/admin/dongia/dongiatinhtheosoluong">Đơn giá theo số lượng</a>
                </li>
                <li class="breadcrumb-item active">{{ $dongiatinhtheosoluong->tenmathang }}</li>
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
                    <h3 class="card-title">Cập nhật Đơn giá</h3>
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
                <form action="{{ route('dongiatinhtheosoluong.update', $dongiatinhtheosoluong->id) }}" method="post"
                    id="dongia-create">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tenmathang">Khối lượng max (kg)</label>
                            <input type="text" id="tenmathang" name="tenmathang"
                                value="{{ $dongiatinhtheosoluong->tenmathang }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="dongiaduongkhong">Đơn giá đường không (VNĐ)</label>
                            <input type="text" id="dongiaduongkhong" name="dongiaduongkhong"
                                value="{{ number_format($dongiatinhtheosoluong->dongiaduongkhong, 0, '.', '.') }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="dongiaduongbien">Đơn giá đường biển (VNĐ)</label>
                            <input type="text" id="dongiaduongbien" name="dongiaduongbien"
                                value="{{ number_format($dongiatinhtheosoluong->dongiaduongbien, 0, '.', '.') }}"
                                class="form-control">
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

        $('#dongia-create').validate({
            rules: {
                tenmathang: {
                    required: true,
                },
                dongiaduongkhong: {
                    required: true,
                },
                dongiaduongbien: {
                    required: true,
                },
            },
            messages: {
                tenmathang: {
                    required: "Nhập Tên mặt hàng",
                },
                dongiaduongkhong: {
                    required: "Nhập Đơn giá",
                },
                dongiaduongbien: {
                    required: "Nhập Đơn giá",
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
