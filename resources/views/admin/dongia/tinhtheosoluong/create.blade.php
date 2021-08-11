@extends('adminlte::page')

@section('title', 'Thêm mới Đơn giá')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>ĐƠN GIÁ TÍNH THEO SỐ LƯỢNG</h1>
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
                <form action="{{ route('dongiatinhtheosoluong.store') }}" method="post" id="dongia-create">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tenmathang">Tên mặt hàng</label>
                            <input type="text" id="tenmathang" name="tenmathang" value="{{ old('tenmathang') }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="dongia">Đơn giá (VNĐ)</label>
                            <input type="text" id="dongia" name="dongia" value="{{ old('dongia') }}"
                                class="form-control">
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
{{-- <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="/vendor/jquery-validation/additional-methods.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<!-- Page specific script -->
<script>
    $(function() {

            $('#dongia-create').validate({
                rules: {
                    tenmathang: {
                        required: true,
                    },
                    dongia: {
                        required: true,
                    },
                },
                messages: {
                    tenmathang: {
                        required: "Nhập Tên mặt hàng",
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