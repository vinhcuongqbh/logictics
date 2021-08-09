@extends('adminlte::page')

@section('title', 'Cập nhật thông tin Kho hàng')

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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('khohang.update', $khohang->id) }}" method="post" id="khohang-edit">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tenkhohang">Tên Kho hàng</label>
                                <input type="text" id="tenkhohang" name="tenkhohang"
                                    value="{{ $khohang->tenkhohang }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="sodienthoai">Số điện thoại</label>
                                <input type="tel" id="sodienthoai" name="sodienthoai" placeholder="(+81)123-456-789"
                                    value="{{ $khohang->sodienthoai }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="diachi">Địa chỉ</label>
                                <input type="text" id="diachi" name="diachi" value="{{ $khohang->diachi }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary float-right" style="width: 100px">CẬP NHẬT</button>
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

        $('#khohang-edit').validate({
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
                    required: "Nhập Tên Kho hàng",
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
