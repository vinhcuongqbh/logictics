@extends('adminlte::page')

@section('title', 'Thêm mới Đơn giá')

@section('content_header')

@stop

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ĐƠN GIÁ TÍNH THEO KHỐI LƯỢNG</h1>
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
                                <input type="text" id="khoiluongmax" name="khoiluongmax" value="{{ old('khoiluongmax') }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="dongia">Đơn giá (VNĐ)</label>
                                <input type="text" id="dongia" name="dongia" value="{{ old('dongia') }}" class="form-control">
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

            $('#dongia-create').validate({
                rules: {
                    khoiluongmax: {
                        required: true,
                    },
                    dongia: {
                        required: true,
                    },
                },
                messages: {
                    khoiluongmax: {
                        required: "Nhập Khối lượng lớn nhất tính theo Đơn giá này",
                    },
                    dongia: {
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
