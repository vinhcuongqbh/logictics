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
                        <hr>
                        <div style="margin-bottom: 20px;">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                                Thêm Mặt hàng
                            </button>
                        </div>
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm mới mặt hàng</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="loaihang">Loại hàng hóa</label>
                                            <input type="tel" id="loaihang" name="loaihang" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="noidunghang">Nội dung hàng</label>
                                            <input type="text" id="noidunghang" name="noidunghang" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="khoiluong">Khối lượng</label>
                                            <input type="text" id="khoiluong" name="khoiluong" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="kichthuoc">Kích thước</label>
                                            <input type="text" id="kichthuoc" name="kichthuoc" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="giatriuoctinh">Giá trị ước tính</label>
                                            <input type="text" id="giatriuoctinh" name="giatriuoctinh" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="tongchiphi">Tổng chi phí</label>
                                            <input type="text" id="tongchiphi" name="tongchiphi" class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="addRow" data-dismiss="modal">Thêm
                                            Mặt hàng</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Nội dung hàng</th>
                                    <th>Khối lượng</th>
                                    <th>Kích thước</th>
                                    <th>Giá trị ước tính</th>
                                    <th>Chi phí</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="form-group" style="margin-top: 20px;">
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
            $('#addRow').on('click', function() {
                var loaihang = document.getElementById("loaihang").value;
                var noidunghang = document.getElementById("noidunghang").value;
                var khoiluong = document.getElementById("khoiluong").value;
                var kichthuoc = document.getElementById("kichthuoc").value;
                var giatriuoctinh = document.getElementById("giatriuoctinh").value;
                t.row.add([
                    stt,
                    loaihang,
                    noidunghang,
                    khoiluong,
                    kichthuoc,
                    giatriuoctinh,
                ]).draw(false);
                stt++;
                document.getElementById("loaihang").value = "";
                document.getElementById("noidunghang").value = "";
                document.getElementById("khoiluong").value = "";
                document.getElementById("kichthuoc").value = "";
                document.getElementById("giatriuoctinh").value = "";
            });

        });
    </script>
@stop
