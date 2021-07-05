@extends('adminlte::page')

@section('title', 'Thêm mới Đơn hàng')

@section('content_header')

@stop

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ĐƠN HÀNG</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thêm mới Đơn hàng</h3>
                    </div>
                    <!--<form action="{{ route('donhang.store') }}" method="post" id="donhang-create">-->
                    @csrf
                    <div class="card-body">
                        <div class="col-6 float-right">
                            <div class="form-group">
                                <label for="sodienthoainguoigui">Số điện thoại Người gửi</label>
                                <input type="tel" id="sodienthoainguoigui" name="sodienthoainguoigui"
                                    placeholder="(+81)123-456-789" value="{{ old('sodienthoainguoigui') }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tennguoigui">Họ và tên Người gửi</label>
                                <input type="text" id="tennguoigui" name="tennguoigui" value="{{ old('tennguoigui') }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="diachinguoigui">Địa chỉ Người gửi</label>
                                <input type="text" id="diachinguoigui" name="diachinguoigui"
                                    value="{{ old('diachinguoigui') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lienhekhacnguoigui">Liên hệ khác Người gửi</label>
                                <input type="text" id="lienhekhacnguoigui" name="lienhekhacnguoigui"
                                    value="{{ old('lienhekhacnguoigui') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sodienthoainguoinhan">Số điện thoại Người nhận</label>
                                <input type="tel" id="sodienthoainguoinhan" name="sodienthoainguoinhan"
                                    placeholder="(+81)123-456-789" value="{{ old('sodienthoainguoinhan') }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tennguoinhan">Họ và tên Người nhận</label>
                                <input type="text" id="tennguoinhan" name="tennguoinhan" value="{{ old('tennguoinhan') }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="diachinguoinhan">Địa chỉ Người nhận</label>
                                <input type="text" id="diachinguoinhan" name="diachinguoinhan"
                                    value="{{ old('diachinguoinhan') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lienhekhacnguoinhan">Liên hệ khác Người nhận</label>
                                <input type="text" id="lienhekhacnguoinhan" name="lienhekhacnguoinhan"
                                    value="{{ old('lienhekhacnguoinhan') }}" class="form-control">
                            </div>
                        </div>
                        <button id="addRow">Add new row</button>
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ tên người nhận</th>
                                    <th>Số điện thoại người nhận</th>
                                    <th>Địa chỉ người nhận</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="form-group">
                            <div class="col-12">
                                <input type="submit" value="TẠO MỚI" class="btn btn-primary float-right">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <!--</form>-->
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@stop

@section('js')
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(document).ready(function() {
            var t = $('#example').DataTable();
            var stt = 1;
            var tennguoinhan = document.getElementById("tennguoinhan").value;
            var sodienthoainguoinhan = document.getElementById("sodienthoainguoinhan").value;
            var diachinguoinhan = document.getElementById("diachinguoinhan").value;

            $('#addRow').on('click', function() {
                tennguoinhan = document.getElementById("tennguoinhan").value;
                sodienthoainguoinhan = document.getElementById("sodienthoainguoinhan").value;
                diachinguoinhan = document.getElementById("diachinguoinhan").value;
                t.row.add([
                    stt,
                    tennguoinhan,
                    sodienthoainguoinhan,
                    diachinguoinhan,
                ]).draw(false);
                stt++;
            });
        });
    </script>
@stop
