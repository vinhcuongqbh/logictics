@extends('adminlte::page')

@section('title', 'Khách hàng')

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
                        <h1>KHÁCH HÀNG</h1>
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
                                            <a href="{{ route('khachhang.create') }}"><button type="button"
                                                    class="btn btn-primary float-left" style="margin-right: 10px;">THÊM
                                                    MỚI</button></a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('khachhang') }}"><button type="button"
                                                    class="btn btn-outline-primary float-left"
                                                    style="margin-right: 10px;">ĐANG SỬ DỤNG</button></a>

                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('khachhang.daxoa') }}"><button type="button"
                                                    class="btn btn-outline-danger float-left" style="margin-right: 10px;">ĐÃ
                                                    XÓA</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="khachhang-table" class="table table-bordered table-striped">
                                    <thead style="text-align: center">
                                        <tr>
                                            <th>ID</th>
                                            <th>Họ và tên</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Nhân viên quản lý</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($khachhangs as $khachhang)
                                            <tr>
                                                <td style="text-align: center"><a
                                                        href="{{ route('khachhang.show', $khachhang->id) }}">{{ $khachhang->id }}</a>
                                                </td>
                                                <td><a
                                                        href="{{ route('khachhang.show', $khachhang->id) }}">{{ $khachhang->tenkhachhang }}</a>
                                                </td>
                                                <td style="text-align: center"><a
                                                        href="{{ route('khachhang.show', $khachhang->id) }}">{{ $khachhang->sodienthoai }}</a>
                                                </td>
                                                <td><a
                                                        href="{{ route('khachhang.show', $khachhang->id) }}">{{ $khachhang->diachi }}</a>
                                                </td>
                                                <td><a
                                                        href="{{ route('nhanvien.show', $khachhang->id_nhanvienquanly) }}">{{ $khachhang->tennhanvien }}</a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="{{ route('khachhang.edit', $khachhang->id) }}" style="padding: 3px">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if ($khachhang->id_trangthai == 1)
                                                        <a href="{{ route('khachhang.delete', $khachhang->id) }}"
                                                            onclick="return confirm('Bạn muốn xóa Khách hàng này?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('khachhang.restore', $khachhang->id) }}"
                                                            onclick="return confirm('Bạn muốn phục hồi Khách hàng này?')">
                                                            <i class="fas fa-undo"></i>
                                                        </a>
                                                    @endif
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
    <!-- Bootstrap 4 -->
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
            $("#khachhang-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "lengthChange": true,
                "pageLength": 25,
                "autoWidth": false,
                "searching": true,
                "buttons": ["copy", "excel", "pdf", "print", ]
            }).buttons().container().appendTo('#khachhang-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
