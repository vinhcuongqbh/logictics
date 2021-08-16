@extends('adminlte::page')

@section('title', 'Nhân viên')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-3">
            <h1>NHÂN VIÊN</h1>
        </div>
        <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                <li class="breadcrumb-item active">Nhân viên</li>
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
                            <a href="{{ route('nhanvien.create') }}"><button type="button"
                                    class="btn btn-primary">THÊM
                                    MỚI</button></a>
                        </div>
                        {{-- <div class="col-3">
                            <a href="{{ route('nhanvien') }}">
                        <button type="button" class="btn btn-block btn-outline-primary">Đang làm</button>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('nhanvien.danghiviec') }}">
                            <button type="button" class="btn btn-block btn-outline-danger">Đã nghỉ</button>
                        </a>
                    </div> --}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="nhanvien-table" class="table table-bordered table-striped">
                        <thead style="text-align: center">
                            <tr>
                                <th data-priority="1">ID</th>
                                <th data-priority="2">Họ và tên</th>
                                <th>Số điện thoại</th>
                                <th>Cấp bậc</th>
                                <th>Chiết khấu (%)</th>
                                <th data-priority="3">Kho quản lý</th>
                                <th data-priority="4">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nhanviens as $nhanvien)
                                <tr>
                                    <td style="text-align: center"><a
                                            href="{{ route('nhanvien.show', $nhanvien->id) }}">{{ $nhanvien->id }}</a>
                                    </td>
                                    <td><a
                                            href="{{ route('nhanvien.show', $nhanvien->id) }}">{{ $nhanvien->name }}</a>
                                    </td>
                                    <td style="text-align: center"><a
                                            href="{{ route('nhanvien.show', $nhanvien->id) }}">{{ $nhanvien->sodienthoai }}</a>
                                    </td>
                                    <td style="text-align: center"><a
                                            href="{{ route('nhanvien.show', $nhanvien->id) }}">{{ $nhanvien->tenloainhanvien }}</a>
                                    </td>
                                    <td style="text-align: center"><a
                                            href="{{ route('nhanvien.show', $nhanvien->id) }}">{{ $nhanvien->tilechietkhau }}</a>
                                    </td>
                                    <td><a
                                            href="{{ route('nhanvien.show', $nhanvien->id) }}">{{ $nhanvien->tenkhohang }}</a>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="{{ route('nhanvien.edit', $nhanvien->id) }}" style="padding: 3px">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if ($nhanvien->id_trangthai == 1)
                                            <a href="{{ route('nhanvien.delete', $nhanvien->id) }}"
                                                onclick="return confirm('Bạn muốn xóa Nhân viên này?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('nhanvien.restore', $nhanvien->id) }}"
                                                onclick="return confirm('Bạn muốn phục hồi Nhân viên này?')">
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
<style>
.toolbar {
    float: left;
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
<!-- Page specific script -->
<script>
    $(function() {
        $("#nhanvien-table").DataTable({
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
        }).buttons().container().appendTo('#nhanvien-table_wrapper .col-md-6:eq(0)');
    });
</script>
@stop
