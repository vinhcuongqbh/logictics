@extends('adminlte::page')

@section('title', 'Thông tin Đơn hàng')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-3">
            <h1>ĐƠN HÀNG</h1>
        </div>
        <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/admin/donhang/dmdangluukho">Đơn hàng</a></li>
                <li class="breadcrumb-item active">{{ $donhang->id }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    {{-- Thông tin đơn hàng --}}
    <div id="thongtindonhang" class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin Đơn hàng</h3>
                </div>
                <div class="card-body">
                    {{-- Thông tin Hình thức gửi --}}
                    <div class="row justify-content-between">
                        <div class="col-sm-5">  
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label for="hinhthucgui" class="col-form-label">Vận tải</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    <select id="hinhthucgui" name="hinhthucgui" class="form-control custom-select" disabled>
                                        <option value="{{ $donhang->id_hinhthucgui }}">{{ $donhang->tenhinhthucgui }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- Thông tin Người gửi và Người nhận --}}
                    <div class="row" id="rowshow">                        
                        {{-- Thông tin Người gửi --}}
                        <div id="nguoigui" class="col-sm-5 col-12">
                            <div id="thongtinnguoigui" style="text-align: center">
                                <label for="nguoigui" class="col-form-label"><u>THÔNG TIN NGƯỜI GỬI</u></label>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label for="sodienthoainguoigui" class="col-form-label">Số ĐT</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    <input type="tel" id="sodienthoainguoigui" name="sodienthoainguoigui"
                                        placeholder="(+81)123-456-789" value="{{ $donhang->sodienthoainguoigui }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label for="tennguoigui" class="col-form-label">Họ tên</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    <input type="text" id="tennguoigui" name="tennguoigui"
                                        value="{{ $donhang->tennguoigui }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label for="diachinguoigui" class="col-form-label">Địa chỉ</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    <textarea id="diachinguoigui" name="diachinguoigui" class="form-control" rows="2"
                                        style="resize: none" disabled>{{ $donhang->diachinguoigui }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label for="emailnguoigui" class="col-form-label">Email</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    <input type="text" id="emailnguoigui" name="emailnguoigui"
                                        value="{{ $donhang->emailnguoigui }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        {{-- Thông tin người nhận --}}
                        <div id="nguoinhan" class="col-sm-5 col-12">
                            <div id="thongtinnguoinhan" style="text-align: center">
                                <label for="nguoinhan" class="col-form-label"><u>THÔNG TIN NGƯỜI NHẬN</u></label>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label for="sodienthoainguoinhan" class="col-form-label">Số ĐT</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    <input type="tel" id="sodienthoainguoinhan" name="sodienthoainguoinhan"
                                        placeholder="(+81)123-456-789" value="{{ $donhang->sodienthoainguoinhan }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label for="tennguoinhan" class="col-form-label">Họ tên</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    <input type="text" id="tennguoinhan" name="tennguoinhan"
                                        value="{{ $donhang->tennguoinhan }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label for="diachinguoinhan" class="col-form-label">Địa chỉ</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    <textarea id="diachinguoinhan" name="diachinguoinhan" class="form-control" rows="2"
                                        style="resize: none" disabled>{{ $donhang->diachinguoinhan }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label for="emailnguoinhan" class="col-form-label">Email</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    <input type="text" id="emailnguoinhan" name="emailnguoinhan"
                                        value="{{ $donhang->emailnguoinhan }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        {{-- Mã QR Code --}}
                        <div class="col-sm-2 col-12" style="text-align: center; padding: 40px 0px 20px 0px;">
                            <div class="row">
                                <div class="col" id="qrcode">
                                    {!! QrCode::encoding('UTF-8')->generate($qrcode); !!}<br>
                                    {{ $donhang->id }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Thông tin in ra Đơn hàng --}}
                    <div class="row" id="logo" style="display: none;">
                        <div class="col" style="text-align: center;">
                            <img src="/img/logo.png" style="width: 300px;">
                        </div>
                    </div>
                    <div class="row" id="rowhide" style="display: none;">
                        {{-- Mã QR Code --}}
                        <div class="col-sm-2 col-12" style="text-align: center; padding: 40px 0px 20px 0px;">
                            <div class="row">
                                <div class="col" id="qrcode">
                                    {!! QrCode::encoding('UTF-8')->generate($qrcode); !!}<br>
                                    {{ $donhang->id }}
                                </div>
                                <div class="col-8" id="thongtincongty" style="text-align: left">
                                    <h4><b>{{ $thongtincongty->tencongty }}</b></h4>
                                    <h4><b>Địa chỉ: </b>{{ $thongtincongty->diachi }}</h4>
                                    <h4><b>Số điện thoại: </b>{{ $thongtincongty->sodienthoai }}</h4>
                                    <h4><b>Website: </b>{{ $thongtincongty->website }}</h4>
                                </div>
                            </div>
                        </div>
                        {{-- Thông tin Người gửi --}}
                        <div class="col-sm-5 col-12">
                            <div style="text-align: center">
                                <label><u>THÔNG TIN NGƯỜI GỬI</u></label>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label>Số ĐT</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    {{ $donhang->sodienthoainguoigui }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label>Họ tên</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    {{ $donhang->tennguoigui }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label>Địa chỉ</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    {{ $donhang->diachinguoigui }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label>Email</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    {{ $donhang->emailnguoigui }}
                                </div>
                            </div>
                        </div>
                        {{-- Thông tin người nhận --}}
                        <div class="col-sm-5 col-12" style="margin-top: 20px">
                            <div style="text-align: center">
                                <label><u>THÔNG TIN NGƯỜI NHẬN</u></label>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label>Số ĐT</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    {{ $donhang->sodienthoainguoinhan }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label>Họ tên</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    {{ $donhang->tennguoinhan }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label>Địa chỉ</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    {{ $donhang->diachinguoinhan }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label>Email</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    {{ $donhang->emailnguoinhan }}
                                </div>
                            </div>
                        </div>
                        {{-- Thông tin Đơn hàng --}}
                        <div class="col-12" style="margin-top: 20px">
                            <div style="text-align: center">
                                <label><u>THÔNG TIN ĐƠN HÀNG</u></label>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label>Mặt hàng</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    @foreach ($chitietdonhangs as $chitietdonhang)
                                    @if ($chitietdonhang->soluong <> null) <b>{{ $chitietdonhang->tenmathang }}</b> x {{
                                        $chitietdonhang->soluong }} cái,
                                        @elseif ($chitietdonhang->khoiluong <> null) <b>{{ $chitietdonhang->tenmathang
                                                }}</b> x {{ $chitietdonhang->khoiluong }} kg,
                                            @elseif ($chitietdonhang->kichthuoc <> null) <b>{{
                                                    $chitietdonhang->tenmathang }}</b> x {{ $chitietdonhang->kichthuoc
                                                }},
                                                @endif
                                                @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 col-xl-2">
                                    <label>Tổng chi phí</label>
                                </div>
                                <div class="col-9 col-xl-9">
                                    {{ number_format($donhang->tongchiphi, 0, '.', '.') }} VNĐ
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- Table Danh sách mặt hàng --}}
                    <div id="donhang-table-div" class="form-group">
                        <table id="donhang-table" class="table table-bordered table-striped">
                            <thead>
                                <tr style="text-align: center">
                                    <th>STT</th>
                                    <th data-priority="1">Tên Mặt hàng</th>
                                    <th data-priority="2">Số lượng (cái)</th>
                                    <th data-priority="3">Khối lượng (kg)</th>
                                    <th>Kích thước</th>
                                    <th>Giá trị ước tính (VNĐ)</th>
                                    <th data-priority="4">Chi phí (VNĐ)</th>
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
                                    <th id="tongchiphi"
                                        style="text-align: right; padding-right:10px; text; font-weight: bold;">
                                        {{ number_format($donhang->tongchiphi, 0, '.', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="ghichu" class="form-group">
                        <label for="ghichu">Ghi chú</label>
                        <input type="text" id="ghichu" name="ghichu" value="" class="form-control" disabled>
                    </div>
                    <div id="button" class="form-group row justify-content-end">
                        <div class="col-3 col-md-1">
                            <button type="button" onClick="window.print()" value="IN"
                                class="btn btn-block btn-primary">IN</button>
                        </div>
                        @if ((($donhang->id_trangthai == 2) && ($donhang->id_nhanvienquanly == $donhang->id_nhanvienkhoitao)) || (($donhang->id_trangthai == 2) && (Auth::user()->id_loainhanvien <=2)))
                            <div class="col-3 col-md-1">
                                <a href="{{ route('donhang.edit', $donhang->id) }}">
                                    <button type="button" value="SỬA" class="btn btn-block btn-secondary">SỬA</button>
                                </a>
                            </div>
                        @endif
                        @if (($donhang->id_trangthai == 2) && ($donhang->id_nhanvienquanly == $donhang->id_nhanvienkhoitao))
                            <div class="col-3 col-md-1">
                                <a href="{{ route('donhang.delete', $donhang->id) }}">
                                    <button type="button" value="XÓA" class="btn btn-block btn-danger">XÓA</button>
                                </a>
                            </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

    {{-- Lịch sử đơn hàng --}}
    <div id="lichsudonhang" class="row">
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
                                        <th>Thời gian (GMT+9)</th>
                                        <th>Sự kiện</th>
                                        <th>Ghi chú</th>
                                        <th>Nhân viên</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lichsudonhangs as $lichsudonhang)
                                    <tr>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: center;">
                                            {{ date('d-m-Y H:i:s', strtotime($lichsudonhang->created_at)) }}
                                        </td>
                                        <td>
                                            @if ($lichsudonhang->id_trangthai == 1) Đơn hàng được khởi tạo
                                            @elseif ($lichsudonhang->id_trangthai == 2) {{ $lichsudonhang->tentrangthai }} vào <b>{{ $lichsudonhang->khogui }}</b>
                                            @elseif ($lichsudonhang->id_trangthai == 3)
                                                @if ($lichsudonhang->id_khonhan == 0) {{ $lichsudonhang->tentrangthai }} từ <b>{{ $lichsudonhang->khogui }}</b> đến địa chỉ <b>Người nhận</b>
                                                @else {{ $lichsudonhang->tentrangthai }} từ <b>{{ $lichsudonhang->khogui }}</b> đến <b>{{ $lichsudonhang->khonhan }}</b>
                                                @endif
                                            @else  {{ $lichsudonhang->tentrangthai }}
                                            @endif
                                        </td>
                                        <td>{{ $lichsudonhang->ghichu }}</td>
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
                <!-- /.cardbody -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div id="phieuin" style="display: none">
        <div>
            <table class="table table-borderless">
                <tr>
                    <td style="width: 30%; padding: 0px; text-align: center;"> 
                        @if ($donhang->id_hinhthucgui == 1)                       
                            <h3>SEA - BIỂN <br> <i class="fas fa-anchor"></i></h3>
                        @else
                            <h3>AIR - BAY <br> <i class="fas fa-plane"></i></h3>                            
                        @endif                        
                    </td>
                    <td style="width: 50%;"></td>
                    <td style="width: 20%; padding: 0px; text-align: center; vertical-align: middle;">{!! QrCode::encoding('UTF-8')->generate($qrcode); !!} <br> {{ $donhang->id }} </td>
                </tr>
            </table>
        </div>
        <hr>
        <div>
            <table class="table table-borderless">
                <tr>
                    <td style="width: 40%; text-align: center; vertical-align: top;"><img src="/img/logo.png" style="width: 200px;"></td>
                    <td style="width: 60%; text-align: center; vertical-align: top;"><h3><b>CÔNG TY VẬN CHUYỂN ETRACK</b></h3></td>
                </tr>
            </table>
        </div>        
        <div>
            <table class="table table-bordered" style="border-color:black;">
                <tr>
                    <td colspan="2" style="width: 30%;">Ngày xử lý</td>
                    <td>{{ $donhang->created_at }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 30%;">Mã Tracking</td>
                    <td>{{ $donhang->id }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 30%;">Cân nặng</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 30%;">Nội dung hàng hóa</td>
                    <td>
                        @foreach ($chitietdonhangs as $chitietdonhang)
                            {{ $chitietdonhang->tenmathang }},
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" style="width: 10%; text-align: center; writing-mode: vertical-lr">NGƯỜI NHẬN</td>
                    <td style="width: 20%;">Địa chỉ</td>
                    <td style="width: 70%;">{{ $donhang->diachinguoinhan }}</td>
                </tr>
                <tr>
                    <td>Họ tên</td>
                    <td>{{ $donhang->tennguoinhan }}</td>
                </tr>
                <tr>
                    <td>SĐT</td>
                    <td>{{ $donhang->sodienthoainguoinhan }}</td>
                </tr>
                <tr>
                    <td rowspan="2" style="width: 10%; text-align: center; writing-mode: vertical-lr">NGƯỜI GỬI</td>
                    <td style="width: 20%;">Họ tên</td>
                    <td style="width: 70%;">{{ $donhang->tennguoigui }}</td>
                </tr>
                <tr>
                    <td>SĐT</td>
                    <td>{{ $donhang->sodienthoainguoigui }}</td>
                </tr>
            </table>
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
{{--
<link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

<style type="text/css">
    @page {
        size: A6 portrait;
        margin: 0px;
    }

    @media print {

        body {
            font-size: 110%;
            padding: 0px;
        }

        .container-fluid {
            width: 72%;
            padding: 0px;
            margin: 40px 20px;

        }

        #thongtindonhang, #lichsudonhang {
            display: none !important;
        }    
        
        #phieuin{
            display: inline !important;
        }

        table.table-bordered{
            border: 1px solid black !important;
            margin-top:20px;
        }
        table.table-bordered > thead > tr > th{
            border: 1px solid black !important;
        }
        table.table-bordered > tbody > tr > td{
            border: 1px solid black !important;
            padding: 7px;
        }
    }
</style>

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
            "info": false,
            "language": {
                "search": "Tìm kiếm:",
                "emptyTable": "Không có dữ liệu phù hợp",
                "zeroRecords": "Không tìm thấy dữ liệu phù hợp",
                "info": "Hiển thị _START_ - _END_ trong tổng _TOTAL_ kết quả",
                "infoEmpty": "",
                "infoFiltered": "(Tìm kiếm trong tổng _MAX_ bản ghi)",
                "paginate": {
                    "first": "Đầu tiên",
                    "last": "Cuối cùng",
                    "next": "Sau",
                    "previous": "Trước"
                },
            },
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": "_all",
            }],     
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
            "info": false,
            "language": {
                "search": "Tìm kiếm:",
                "emptyTable": "Không có dữ liệu phù hợp",
                "zeroRecords": "Không tìm thấy dữ liệu phù hợp",
                "info": "Hiển thị _START_ - _END_ trong tổng _TOTAL_ kết quả",
                "infoEmpty": "",
                "infoFiltered": "(Tìm kiếm trong tổng _MAX_ bản ghi)",
                "paginate": {
                    "first": "Đầu tiên",
                    "last": "Cuối cùng",
                    "next": "Sau",
                    "previous": "Trước"
                },
            },     
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": "_all",
            }],
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