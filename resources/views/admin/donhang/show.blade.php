@extends('adminlte::page')

@section('title', 'Thông tin Đơn hàng')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>ĐƠN HÀNG</h1>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin Đơn hàng</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5" style="float: left; padding: 0px 30px;">
                            <div class="form-group row" style="text-align: center">
                                <label for="nguoigui" class="col-sm-12 col-form-label">THÔNG TIN NGƯỜI GỬI</label>
                            </div>
                            <div class="form-group row">
                                <label for="sodienthoainguoigui" class="col-sm-3 col-form-label">Số ĐT</label>
                                <div class="col-sm-9">
                                    <input type="tel" id="sodienthoainguoigui" name="sodienthoainguoigui"
                                        placeholder="(+81)123-456-789" value="{{ $donhang->sodienthoainguoigui }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tennguoigui" class="col-sm-3 col-form-label">Họ và tên</label>
                                <div class="col-sm-9">
                                    <input type="text" id="tennguoigui" name="tennguoigui"
                                        value="{{ $donhang->tennguoigui }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="diachinguoigui" class="col-sm-3 col-form-label">Địa chỉ</label>
                                <div class="col-sm-9">
                                    <input type="text" id="diachinguoigui" name="diachinguoigui"
                                        value="{{ $donhang->diachinguoigui }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="emailnguoigui" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" id="emailnguoigui" name="emailnguoigui"
                                        value="{{ $donhang->emailnguoigui }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5" style="float: left; padding: 0px 30px;">
                            <div class="form-group row" style="text-align: center">
                                <label for="nguoinhan" class="col-sm-12 col-form-label">THÔNG TIN NGƯỜI NHẬN</label>
                            </div>
                            <div class="form-group row">
                                <label for="sodienthoainguoinhan" class="col-sm-3 col-form-label">Số ĐT</label>
                                <div class="col-sm-9">
                                    <input type="tel" id="sodienthoainguoinhan" name="sodienthoainguoinhan"
                                        placeholder="(+81)123-456-789" value="{{ $donhang->sodienthoainguoinhan }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tennguoinhan" class="col-sm-3 col-form-label">Họ và tên</label>
                                <div class="col-sm-9">
                                    <input type="text" id="tennguoinhan" name="tennguoinhan"
                                        value="{{ $donhang->tennguoinhan }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="diachinguoinhan" class="col-sm-3 col-form-label">Địa chỉ</label>
                                <div class="col-sm-9">
                                    <input type="text" id="diachinguoinhan" name="diachinguoinhan"
                                        value="{{ $donhang->diachinguoinhan }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="emailnguoinhan" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" id="emailnguoinhan" name="emailnguoinhan"
                                        value="{{ $donhang->emailnguoinhan }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2" style="display: inline-block; text-align: center;">
                            <div>
                                {!! QrCode::encoding('UTF-8')->generate($qrcode); !!}<br>
                                QRCODE
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="donhang-table-div">
                                <table id="donhang-table" class="table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>STT</th>
                                            <th>Tên Mặt hàng</th>
                                            <th>Số lượng (Cái)</th>
                                            <th>Khối lượng (Kg)</th>
                                            <th>Kích thước</th>
                                            <th>Giá trị ước tính</th>
                                            <th>Chi phí</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($chitietdonhangs as $chitietdonhang)
                                        <tr>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: left">{{ $chitietdonhang->tenmathang }}</td>
                                            <td style="text-align: center">{{ $chitietdonhang->soluong }}</td>
                                            <td style="text-align: center">{{ $chitietdonhang->khoiluong }}</td>
                                            <td style="text-align: center">{{ $chitietdonhang->kichthuoc }}</td>

                                            <td style="text-align: center">
                                                @if ($chitietdonhang->giatriuoctinh <> 0)
                                                    {{ number_format($chitietdonhang->giatriuoctinh, 0, '.', '.') }}
                                                    @endif
                                            </td>
                                            <td style="text-align: right">
                                                {{ number_format($chitietdonhang->chiphi, 0, '.', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="text-align: center">
                                            <th></th>
                                                <th>Tổng</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            <th id="tongchiphi" style="text-align: right">
                                                {{ number_format($donhang->tongchiphi, 0, '.', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="form-group" style="margin-top: 20px;">
                                <div class="col-12">
                                    <a href="{{ route('donhang.delete', $donhang->id) }}"><button type="button"
                                            value="XÓA" class="btn btn-outline-danger float-right"
                                            style="width: 100px; margin-left: 10px">XÓA</button></a>
                                    <a href="{{ route('donhang.edit', $donhang->id) }}"><button type="button"
                                            value="SỬA" class="btn btn-outline-secondary float-right"
                                            style="width: 100px; margin-left: 10px">SỬA</button></a>
                                    <a href="{{ route('donhang.create') }}"><button type="button" value="TẠO MỚI"
                                            class="btn btn-outline-primary float-right"
                                            style="width: 100px; margin-left: 10px">TẠO MỚI</button></a>
                                    <button type="button" onClick="window.print()" value="IN"
                                        class="btn btn-outline-primary float-right"
                                        style="width: 100px; margin-left: 10px">IN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lịch sử Đơn hàng</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="lichsudonhang-table" class="table table-bordered table-striped">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>TT</th>
                                        <th>Thời gian (Múi giờ GMT+9)</th>
                                        <th>Sự kiện</th>
                                        <th>Nhân viên thực hiện</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lichsudonhangs as $lichsudonhang)
                                    <tr>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: center;">
                                            {{ $lichsudonhang->created_at }}
                                        </td>
                                        <td>
                                            @if ($lichsudonhang->id_trangthai == 1)
                                            Đơn hàng được khởi tạo
                                            @elseif ($lichsudonhang->id_trangthai == 2)
                                            {{ $lichsudonhang->tentrangthai }} vào <b>{{ $lichsudonhang->khogui }}</b>
                                            ({{ $lichsudonhang->diachikhogui }})
                                            @elseif ($lichsudonhang->id_trangthai == 3)
                                            @if ($lichsudonhang->id_khonhan == 0)
                                            {{ $lichsudonhang->tentrangthai }} từ <b>{{ $lichsudonhang->khogui }}</b>
                                            ({{ $lichsudonhang->diachikhogui }}) đến địa chỉ <b>Người
                                                nhận</b>
                                            @else
                                            {{ $lichsudonhang->tentrangthai }} từ <b>{{ $lichsudonhang->khogui }}</b>
                                            ({{ $lichsudonhang->diachikhogui }}) đến
                                            <b>{{ $lichsudonhang->khonhan }}</b> ({{ $lichsudonhang->diachikhonhan }})
                                            @endif
                                            @else
                                            {{ $lichsudonhang->tentrangthai }}
                                            @endif
                                        </td>
                                        <td style="text-align: center">{{ $lichsudonhang->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
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
<!-- DataTables -->
<link rel="stylesheet" href="/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css">

@stop

@section('js')
<script src="/vendor/jquery/jquery.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/vendor/jszip/jszip.min.js"></script>
<script src="/vendor/pdfmake/pdfmake.min.js"></script>
<script src="/vendor/pdfmake/vfs_fonts.js"></script>
<script src="/vendor/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/vendor/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/vendor/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(document).ready(function() {
        var donhangTable = $('#donhang-table').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "searching": false,
            "paging": false,
            "order": [
                [0, 'desc']
            ],
        });
        //End: Tạo Table Đơn hàng


        donhangTable.on('order.dt search.dt', function() {
            donhangTable.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();


        //Bảng Lịch sử đơn hàng
        var lichsudonhangTable = $('#lichsudonhang-table').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "searching": false,
            "paging": false,
            "order": [
                [0, 'desc']
            ],
        });
        //End: Tạo Table Đơn hàng


        lichsudonhangTable.on('order.dt search.dt', function() {
            lichsudonhangTable.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });
</script>
@stop
