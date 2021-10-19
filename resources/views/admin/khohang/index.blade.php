@extends('adminlte::page')

@section('title', 'Kho hàng')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-3">
            <h1>KHO HÀNG</h1>
        </div>
        <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                <li class="breadcrumb-item active">Kho hàng</li>
            </ol>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-auto">
                            <a href="{{ route('khohang.create') }}"><button type="button" class="btn btn-primary">THÊM
                                    MỚI</button></a>
                        </div>
                        {{-- <div class="col-auto">
                                <a href="{{ route('khohang') }}"><button type="button"
                                        class="btn btn-outline-primary float-left" style="margin-right: 10px;">ĐANG SỬ
                                        DỤNG</button></a>

                            </div>
                            <div class="col-auto">
                                <a href="{{ route('khohang.tamdung') }}"><button type="button"
                                        class="btn btn-outline-danger float-left"
                                        style="width: 100px; margin-right: 10px;">TẠM DỪNG</button></a>
                            </div> --}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="khohang-table" class="table table-bordered table-striped">
                        <thead style="text-align: center">
                            <tr>
                                <th data-priority="1">ID</th>
                                <th data-priority="2">Tên Kho hàng</th>
                                <th>Số điện thoại</th>
                                <th data-priority="4">Địa chỉ</th>
                                <th data-priority="3">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($khohangs as $khohang)
                                <tr>
                                    <td style="text-align: center"><a
                                            href="{{ route('khohang.show', $khohang->id) }}">{{ $khohang->id }}</a>
                                    </td>
                                    <td><a
                                            href="{{ route('khohang.show', $khohang->id) }}">{{ $khohang->tenkhohang }}</a>
                                    </td>
                                    <td style="text-align: center"><a
                                            href="{{ route('khohang.show', $khohang->id) }}">{{ $khohang->sodienthoai }}</a>
                                    </td>
                                    <td><a
                                            href="{{ route('khohang.show', $khohang->id) }}">{{ $khohang->diachi }}</a>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="{{ route('khohang.edit', $khohang->id) }}" style="padding: 3px">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- @if ($khohang->id > 2)
                                            @if ($khohang->id_trangthai == 1)
                                                <a href="{{ route('khohang.delete', $khohang->id) }}"
                                                    onclick="return confirm('Bạn muốn đóng Kho hàng này?')">
                                                    <i class="fas fa-minus-circle"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('khohang.restore', $khohang->id) }}"
                                                    onclick="return confirm('Bạn muốn phục hồi Kho hàng này?')">
                                                    <i class="fas fa-undo"></i>
                                                </a>
                                            @endif
                                        @endif --}}
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
{{-- <link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css"> --}}
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
        $("#khohang-table").DataTable({
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
        }).buttons().container().appendTo('#khohang-table_wrapper .col-md-6:eq(0)');
    });
</script>
@stop
