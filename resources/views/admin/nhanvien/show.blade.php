@extends('adminlte::page')

@section('title', 'Thông tin Nhân viên')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-3">
            <h1>NHÂN VIÊN</h1>
        </div>
        {{-- <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/admin/nhanvien">Nhân viên</a></li>
                <li class="breadcrumb-item active">{{ $nhanvien->name }}</li>
            </ol>
        </div> --}}
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
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="id_loainhanvien">Loại nhân viên</label>
                        </div>
                        <div class="col-sm-9">
                            <select id="id_loainhanvien" name="id_loainhanvien" class="form-control custom-select"
                                disabled>
                                <option value="{{ $nhanvien->id_loainhanvien }}">{{ $nhanvien->tenloainhanvien }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="name">Họ và tên</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" value="{{ $nhanvien->name }}" class="form-control"
                                disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="sodienthoai">Số điện thoại</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="tel" id="sodienthoai" name="sodienthoai" placeholder="(+81)123-456-789"
                                value="{{ $nhanvien->sodienthoai }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="diachi">Địa chỉ</label>
                        </div>
                        <div class="col-sm-9">
                            <textarea id="diachi" name="diachi" class="form-control" rows="2" style="resize: none;"
                                disabled>{{ $nhanvien->diachi }}</textarea>
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
                            <label for="lienhekhac">Liên hệ khác</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="lienhekhac" name="lienhekhac" value="{{ $nhanvien->lienhekhac }}"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="tilechietkhau">Chiết khấu (%)</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="number" id="tilechietkhau" name="tilechietkhau"
                                value="{{ $nhanvien->tilechietkhau }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="id_khohangquanly">Kho hàng quản lý</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="custom-select" id="id_khohangquanly" name="id_khohangquanly" disabled>
                                <option value="{{ $nhanvien->id_khohangquanly }}">
                                    {{ $nhanvien->tenkhohang }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-3 col-md-2">
                            <button type="button" class="btn btn-block btn-primary"
                                style="padding-left:0px; padding-right:0px" data-toggle="modal"
                                data-target="#reset-pass">ĐỔI MẬT MÃ</button>
                        </div>
                        @if (Auth::user()->id_loainhanvien == 1)
                        <div class="col-3 col-md-2">
                            <a href="{{ route('nhanvien.edit', $nhanvien->id) }}"><button type="button"
                                    class="btn btn-block btn-secondary">SỬA</button></a>
                        </div>
                        <div class="col-3 col-md-2">
                            @if ($nhanvien->id_trangthai == 1)
                            <a href="{{ route('nhanvien.delete', $nhanvien->id) }}"
                                onclick="return confirm('Bạn muốn khóa tài khoản Nhân viên này?')"><button type="button"
                                    class="btn btn-block btn-danger">KHÓA</button></a>
                            @else
                            <a href="{{ route('nhanvien.restore', $nhanvien->id) }}"
                                onclick="return confirm('Bạn muốn phục hồi Nhân viên này?')"><button type="button"
                                    class="btn btn-block btn-success">PHỤC HỒI</button></a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div><!-- /.container-fluid -->

{{-- Cấp lại mật mã --}}
<form action="{{ route('nhanvien.resetpass') }}" method="post" id="form-resetpass">
    @csrf
    <div class="modal fade" id="reset-pass">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đổi mật mã</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="password" class="col-form-label">Mật mã mới</label>
                        </div>
                        <div class="col-8">
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="confirmpassword" class="col-form-label">Nhập lại Mật mã mới</label>
                        </div>
                        <div class="col-8">
                            <input type="password" id="confirmpassword" name="confirmpassword" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" id="id_nhanvien" name="id_nhanvien" value="{{ $nhanvien->id }}">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>
@stop

@section('css')
@stop

@section('js')
<!-- jquery-validation -->
<script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="/vendor/jquery-validation/additional-methods.min.js"></script>
<script>
    //Kiểm tra dữ liệu đầu vào
    $(function() {
        $('#form-resetpass').validate({
            rules: {
                password: {
                    required: true,
                },      
                confirmpassword: {
                    equalTo: "#password"
                }  
            },
            messages: {
                password: {
                    required: "Nhập Mật mã mới",
                },
                confirmpassword: "Mật mã mới chưa chính xác",
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('div').append(error);

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