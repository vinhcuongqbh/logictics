@extends('adminlte::page')

@section('title', 'Chuyến hàng')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-4">
            <h1>CHUYẾN HÀNG ĐÃ XUẤT KHO</h1>
        </div>
        <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                <li class="breadcrumb-item active">Chuyến hàng</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-auto">
                            </div>
                            <div class="col-auto">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="chuyenhang-table" class="table table-bordered table-striped">
                        <thead style="text-align: center">
                            <tr>
                                <th>ID</th>
                                <th>Kho gửi</th>
                                <th>Kho nhận</th>
                                <th>Ngày gửi</th>
                                <th>Ngày nhận</th>
                                <th>Tổng số đơn hàng</th>
                                <th>Nhân viên quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chuyenhangs as $chuyenhang)
                            <tr>
                                <td style="text-align: center"><a
                                        href="{{ route('chuyenhang.donhangdaxuatkho', $chuyenhang->id) }}">{{ $chuyenhang->id }}</a>
                                </td>
                                <td><a
                                        href="{{ route('chuyenhang.donhangdaxuatkho', $chuyenhang->id) }}">{{ $chuyenhang->khogui }}</a>
                                </td>
                                <td><a
                                        href="{{ route('chuyenhang.donhangdaxuatkho', $chuyenhang->id) }}">{{ $chuyenhang->khonhan }}</a>
                                </td>
                                <td style="text-align: center"><a
                                        href="{{ route('chuyenhang.donhangdaxuatkho', $chuyenhang->id) }}">{{ $chuyenhang->created_at }}</a>
                                </td>
                                <td style="text-align: center"><a
                                        href="{{ route('chuyenhang.donhangdaxuatkho', $chuyenhang->id) }}">{{ $chuyenhang->updated_at }}</a>
                                </td>
                                <td style="text-align: center"><a
                                        href="{{ route('chuyenhang.donhangdaxuatkho', $chuyenhang->id) }}">{{ $chuyenhang->tongdonhang }}</a>
                                </td>
                                <td style="text-align: center"><a
                                        href="{{ route('chuyenhang.donhangdaxuatkho', $chuyenhang->id) }}">{{ $chuyenhang->name }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
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
<!-- Page specific script -->
<script>
    $(function() {
            $("#chuyenhang-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "pageLength": 25,
                "searching": true,
                "autoWidth": false,
                "buttons": ["copy", "excel", "pdf", "print"],
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
                "ordering": false,                 
                "order": [[ 0, "desc" ]], 
            }).buttons().container().appendTo('#chuyenhang-table_wrapper .col-md-6:eq(0)');
        });
</script>
@stop