@extends('adminlte::page')

@section('title', 'Cập nhật Đơn hàng')

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
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin Đơn hàng</h3>
                </div>
                <form class="form-horizontal" action="{{ route('donhang.update', $donhang->id) }}" method="post"
                    id="donhang-update">
                    @csrf
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
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tennguoigui" class="col-sm-3 col-form-label">Họ và tên</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="tennguoigui" name="tennguoigui"
                                            value="{{ $donhang->tennguoigui }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diachinguoigui" class="col-sm-3 col-form-label">Địa chỉ</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="diachinguoigui" name="diachinguoigui"
                                            value="{{ $donhang->diachinguoigui }}" class="form-control">
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
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tennguoinhan" class="col-sm-3 col-form-label">Họ và tên</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="tennguoinhan" name="tennguoinhan"
                                            value="{{ $donhang->tennguoinhan }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diachinguoinhan" class="col-sm-3 col-form-label">Địa chỉ</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="diachinguoinhan" name="diachinguoinhan"
                                            value="{{ $donhang->diachinguoinhan }}" class="form-control">
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
                                <div style="margin-bottom: 20px;">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#create-modal" style="width: 80px;">
                                        Thêm
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="editRow" data-toggle="modal"
                                        data-target="#edit-modal" style="width: 80px; margin-left: 10px;" disabled>
                                        Sửa
                                    </button>
                                    <button type="button" class="btn btn-danger" id="deleteRow"
                                        style="width: 80px; margin-left: 10px;" disabled>
                                        Xóa
                                    </button>
                                </div>
                                <div class="modal fade" id="create-modal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Thêm mới Mặt hàng</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="tenmathang" class="col-sm-3 col-form-label">Mặt
                                                        hàng</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="tenmathang" list="danhmucmathang"
                                                            class="form-control">
                                                        <datalist id="danhmucmathang">
                                                            @foreach ($danhmucmathangs as $danhmucmathang)
                                                            <option value="{{ $danhmucmathang->tenmathang }}" />
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="soluong" class="col-sm-3 col-form-label">Số
                                                        lượng</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="soluong" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="khoiluong" class="col-sm-3 col-form-label">Khối
                                                        lượng</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="khoiluong" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="kichthuoc" class="col-sm-3 col-form-label">Kích
                                                        thước</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="kichthuoc" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="giatriuoctinh" class="col-sm-3 col-form-label">Giá trị
                                                        ước tính</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="giatriuoctinh" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="chiphi" class="col-sm-3 col-form-label">Chi phí</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="chiphi" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="addRow"
                                                    data-dismiss="modal">Thêm mới</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                                <div class="modal fade" id="edit-modal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Sửa Mặt hàng</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="tenmathangEdit" class="col-sm-3 col-form-label">Mặt
                                                        hàng</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="tenmathangEdit" list="danhmucmathang"
                                                            class="form-control">
                                                        <datalist id="danhmucmathang">
                                                            @foreach ($danhmucmathangs as $danhmucmathang)
                                                            <option value="{{ $danhmucmathang->tenmathang }}" />
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="soluongEdit" class="col-sm-3 col-form-label">Số
                                                        lượng</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="soluongEdit" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="khoiluongEdit" class="col-sm-3 col-form-label">Khối
                                                        lượng</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="khoiluongEdit" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="kichthuocEdit" class="col-sm-3 col-form-label">Kích
                                                        thước</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="kichthuocEdit" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="giatriuoctinhEdit" class="col-sm-3 col-form-label">Giá
                                                        trị
                                                        ước tính</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="giatriuoctinhEdit" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="chiphiEdit" class="col-sm-3 col-form-label">Chi
                                                        phí</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="chiphiEdit" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="updateRow"
                                                    data-dismiss="modal">Cập nhật</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="donhang-table-div">
                                    <table id="donhang-table" class="table table-bordered table-striped"
                                        style="width:100%">
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
                                                    @if ($chitietdonhang->giatriuoctinh)
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
                                                <th colspan="6">Tổng chi phí</th>
                                                <th id="tongchiphi" style="text-align: right">
                                                    {{ number_format($donhang->tongchiphi, 0, '.', '.') }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="form-group" style="margin-top: 20px;">
                                    <div class="col-12">
                                        <input type="submit" id="submitForm" value="CẬP NHẬT"
                                            class="btn btn-primary float-right">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" id="tongchiphi2" name="tongchiphi2">
                    <input type="hidden" id="chiTietDonHang" name="chiTietDonHang">
                </form>
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
                                            {{ $lichsudonhang->tentrangthai }} vào
                                            <b>{{ $lichsudonhang->khogui }}</b>
                                            ({{ $lichsudonhang->diachikhogui }})
                                            @elseif ($lichsudonhang->id_trangthai == 3)
                                            @if ($lichsudonhang->id_khonhan == 0)
                                            {{ $lichsudonhang->tentrangthai }} từ
                                            <b>{{ $lichsudonhang->khogui }}</b>
                                            ({{ $lichsudonhang->diachikhogui }}) đến địa chỉ <b>Người
                                                nhận</b>
                                            @else
                                            {{ $lichsudonhang->tentrangthai }} từ
                                            <b>{{ $lichsudonhang->khogui }}</b>
                                            ({{ $lichsudonhang->diachikhogui }}) đến
                                            <b>{{ $lichsudonhang->khonhan }}</b>
                                            ({{ $lichsudonhang->diachikhonhan }})
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


</section>
<!-- /.content -->

@stop

@section('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

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
<!-- jquery-validation -->
<script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="/vendor/jquery-validation/additional-methods.min.js"></script>
<script>
    var chiTietDonHang = [];
        var rowIndex;
         //
         jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
                return this.flatten().reduce( function ( a, b ) {
                    // if ( typeof a === 'string' ) {
                    //     a = a.replace(/[^\d.-]/g, '') * 1;
                    // }
                    // if ( typeof b === 'string' ) {
                    //     b = b.replace(/[^\d.-]/g, '') * 1;
                    // }
                    x = a.toString().replaceAll(".","");
                    y = b.toString().replaceAll(".","");                    
                    return parseInt(x) + parseInt(y);
                }, 0 );
            } );

        $(document).ready(function() {
            //Start: Tạo Table Đơn hàng
            var donhangTable = $('#donhang-table').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "paging": false,
                "columns": [{
                        "data": "stt",
                        "className": "dt-body-center",
                    },
                    {
                        "data": "tenmathang",
                        "className": "dt-body-left",
                    },
                    {
                        "data": "soluong",
                        "className": "dt-body-center",
                    },
                    {
                        "data": "khoiluong",
                        "className": "dt-body-center",
                    },
                    {
                        "data": "kichthuoc",
                        "className": "dt-body-center",
                    },
                    {
                        "data": "giatriuoctinh",
                        "className": "dt-body-center",
                    },
                    {
                        "data": "chiphi",
                        "className": "dt-body-right",
                    }
                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": "_all",
                }, ],
                "order": [
                    [0, 'desc']
                ],
            });
            //End: Tạo Table Đơn hàng



            //Start: Tạo cột Số thứ tự
            donhangTable.on('order.dt search.dt', function() {
                donhangTable.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            //End: Tạo cột Số thứ tự



            //Start: Lựa chọn row
            donhangTable.on('click', 'tbody tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    document.querySelector("#editRow").disabled = true;
                    document.querySelector("#deleteRow").disabled = true;
                } else {
                    donhangTable.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    document.querySelector("#editRow").disabled = false;
                    document.querySelector("#deleteRow").disabled = false;
                    rowIndex = donhangTable.row(this).index();
                }
            });
            //End: Lựa chọn row



            //Start: Thêm Row
            $('#addRow').on('click', function() {
                //Start: Lấy dữ liệu từ các input
                donhangTable.row.add({
                    "stt": null,
                    "tenmathang": document.querySelector("#tenmathang").value,
                    "soluong": document.querySelector("#soluong").value,
                    "khoiluong": document.querySelector("#khoiluong").value,
                    "kichthuoc": document.querySelector("#kichthuoc").value,
                    "giatriuoctinh": document.querySelector("#giatriuoctinh").value,
                    "chiphi": document.querySelector("#chiphi").value,
                }).draw();

                lamtrongdulieu();
            });
            //End: Thêm Row



            //Start: Sửa Row
            $('#editRow').on('click', function() {
                document.querySelector("#tenmathangEdit").value = donhangTable.row(rowIndex).data()
                    .tenmathang;
                document.querySelector("#soluongEdit").value = donhangTable.row(rowIndex).data().soluong;
                document.querySelector("#khoiluongEdit").value = donhangTable.row(rowIndex).data()
                    .khoiluong;
                document.querySelector("#kichthuocEdit").value = donhangTable.row(rowIndex).data()
                    .kichthuoc;
                document.querySelector("#giatriuoctinhEdit").value = donhangTable.row(rowIndex).data()
                    .giatriuoctinh;
                document.querySelector("#chiphiEdit").value = donhangTable.row(rowIndex).data().chiphi;
            });
            //End: Sửa Row


            //Start: Cập nhật Row
            $('#updateRow').on('click', function() {
                donhangTable.row(rowIndex).data({
                    "stt": null,
                    "tenmathang": document.querySelector("#tenmathangEdit").value,
                    "soluong": document.querySelector("#soluongEdit").value,
                    "khoiluong": document.querySelector("#khoiluongEdit").value,
                    "kichthuoc": document.querySelector("#kichthuocEdit").value,
                    "giatriuoctinh": document.querySelector("#giatriuoctinhEdit").value || null,
                    "chiphi": document.querySelector("#chiphiEdit").value,
                }).draw();
            });
            //End: Cập nhật Row


            //Start: Xóa Row
            $('#deleteRow').click(function() {
                donhangTable.row('.selected').remove().draw(false);
                document.querySelector("#editRow").disabled = true;
                document.querySelector("#deleteRow").disabled = true;
            }); //End: Xóa row



            //Start: Tính chi chí
            var dongiatinhtheokhoiluong = @json($dongiatinhtheokhoiluong);
            var dongiatinhtheosoluong = @json($dongiatinhtheosoluong);
            var dongiahangcongkenh = @json($dongiahangcongkenh);

            var tinhChiPhi = function() {
                let soluong = document.querySelector("#soluong").value;
                let khoiluong = document.querySelector("#khoiluong").value;
                document.querySelector("#chiphi").value = "";

                if (soluong != 0 && khoiluong == "") {
                    let tenmathang = document.querySelector("#tenmathang").value;
                    let chiphi = soluong * parseInt(dongiatinhtheosoluong.find(e => e.tenmathang ==
                            tenmathang)?.dongia ||
                        0);
                    document.querySelector("#chiphi").value = chiphi.toLocaleString();
                }

                if (khoiluong != 0 && soluong == "") {
                    for (var i = 0; i < dongiatinhtheokhoiluong.length; i++) {
                        if (khoiluong < dongiatinhtheokhoiluong[i].khoiluongmax) {
                            dongia = dongiatinhtheokhoiluong[i].dongia;
                        }
                    }
                    let chiphi = khoiluong * parseInt(dongia || 0);
                    document.querySelector("#chiphi").value = chiphi.toLocaleString();
                }
            }

            document.querySelector("#tenmathang").addEventListener('blur', tinhChiPhi);
            document.querySelector("#soluong").addEventListener('blur', tinhChiPhi);
            document.querySelector("#khoiluong").addEventListener('blur', tinhChiPhi);
            //End: Tính Chi Phí



            //Start: Tính Chi phí Edit
            var tinhChiPhiEdit = function() {
                let soluong = document.querySelector("#soluongEdit").value;
                let khoiluong = document.querySelector("#khoiluongEdit").value;
                document.querySelector("#chiphiEdit").value = "";

                if (soluong != 0 && khoiluong == "") {
                    let tenmathang = document.querySelector("#tenmathangEdit").value;
                    let chiphi = soluong * parseInt(dongiatinhtheosoluong.find(e => e.tenmathang ==
                            tenmathang)?.dongia ||
                        0);
                    document.querySelector("#chiphiEdit").value = chiphi.toLocaleString();
                }

                if (khoiluong != 0 && soluong == "") {
                    for (var i = 0; i < dongiatinhtheokhoiluong.length; i++) {
                        if (khoiluong < dongiatinhtheokhoiluong[i].khoiluongmax) {
                            dongia = dongiatinhtheokhoiluong[i].dongia;
                        }
                    }
                    let chiphi = khoiluong * parseInt(dongia || 0);
                    document.querySelector("#chiphiEdit").value = chiphi.toLocaleString();
                }
            }

            document.querySelector("#tenmathangEdit").addEventListener('blur', tinhChiPhiEdit);
            document.querySelector("#soluongEdit").addEventListener('blur', tinhChiPhiEdit);
            document.querySelector("#khoiluongEdit").addEventListener('blur', tinhChiPhiEdit);
            //End: Tính Chi phí Edit



            //Start: Hàm tính tổng chi phí
            const tongchiphi = function() {
                document.querySelector("#tongchiphi").innerHTML = (donhangTable.column(6).data().sum()).toLocaleString();
            }
            //End: Hàm tính tổng chi phí



            //Start: Cập nhật lại Tổng Chi phí khi Table thay đổi
            donhangTable.on('draw', function() {
                tongchiphi();
            }).draw();
            //End: Cập nhật lại Tổng Chi phí khi Table thay đổi


            //Gán giá trị cho #chiTietDonHang và #tongChiPhi2
            $('#submitForm').on('click', function() {
                document.querySelector("#chiTietDonHang").value = JSON.stringify(donhangTable.data().toArray());
                document.querySelector("#tongchiphi2").value = donhangTable.column(6).data().sum();
            });



            //Start: Hàm làm trống dữ liệu input
            const lamtrongdulieu = function() {
                document.querySelector("#tenmathang").value = "";
                document.querySelector("#soluong").value = "";
                document.querySelector("#khoiluong").value = "";
                document.querySelector("#kichthuoc").value = "";
                document.querySelector("#giatriuoctinh").value = "";
                document.querySelector("#chiphi").value = "";
            }
            //End: Hàm làm trống dữ liệu input
           
        });
</script>

<script>
    $(document).ready(function() {       
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

<script>
    //Kiểm tra dữ liệu đầu vào
        $(function() {
            $('#donhang-update').validate({
                rules: {
                    sodienthoainguoigui: {
                        required: true,
                    },
                    tennguoigui: {
                        required: true,
                    },
                    diachinguoigui: {
                        required: true,
                    },
                    sodienthoainguoinhan: {
                        required: true,
                    },
                    tennguoinhan: {
                        required: true,
                    },
                    diachinguoinhan: {
                        required: true,
                    },
                },
                messages: {
                    sodienthoainguoigui: {
                        required: "Nhập Số điện thoại của Người gửi",
                    },
                    tennguoigui: {
                        required: "Nhập Họ tên của Người gửi",
                    },
                    diachinguoigui: {
                        required: "Nhập Địa chỉ của Người gửi",
                    },
                    sodienthoainguoinhan: {
                        required: "Nhập Số điện thoại của Người nhận",
                    },
                    tennguoinhan: {
                        required: "Nhập Họ tên của Người nhận",
                    },
                    diachinguoinhan: {
                        required: "Nhập Địa chỉ của Người nhận",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-9').append(error);

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