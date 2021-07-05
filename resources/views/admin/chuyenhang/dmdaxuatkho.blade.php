@extends('adminlte::page')

@section('title', 'Chuyến hàng')

@section('content_header')

@stop

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CHUYẾN HÀNG</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
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
                                            <th>Nhân viên quản lý</th>
                                            <th>Lịch sử chuyến hàng</th>
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
                                                <td style="text-align: center"><a
                                                        href="{{ route('chuyenhang.donhangdaxuatkho', $chuyenhang->id) }}">{{ $chuyenhang->khonhan }}</a>
                                                </td>
                                                <td><a
                                                        href="{{ route('chuyenhang.donhangdaxuatkho', $chuyenhang->id) }}">{{ $chuyenhang->created_at }}</a>
                                                </td>
                                                <td><a href="{{ route('chuyenhang.donhangdaxuatkho', $chuyenhang->id) }}"></a>
                                                </td>
                                                <td><a
                                                        href="{{ route('chuyenhang.donhangdaxuatkho', $chuyenhang->id) }}">{{ $chuyenhang->name }}</a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="{{ route('chuyenhang.lichsuchuyenhang', $chuyenhang->id) }}"
                                                        style="padding: 3px">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
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
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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
                "lengthChange": true,
                "pageLength": 25,
                "autoWidth": false,
                "searching": true,
                "buttons": ["copy", "excel", "pdf", "print", ]
            }).buttons().container().appendTo('#chuyenhang-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
