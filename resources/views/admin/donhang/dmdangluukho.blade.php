@extends('adminlte::page')

@section('title', 'Đơn hàng')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-3">
            <h1>ĐƠN HÀNG</h1>
        </div>
        <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                <li class="breadcrumb-item active">Đơn hàng</li>
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
            <form action="{{ route('donhang.xuatkho') }}" method="post" id="donhang-index">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <a href="{{ route('donhang.create') }}"><button type="button"
                                        class="btn btn-primary">THÊM
                                        MỚI</button></a>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-success">XUẤT KHO</button>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('donhang.xuattoanbokho') }}"><button type="button"
                                        class="btn btn-outline-success">XUẤT HẾT</button></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="donhang-table" class="table table-bordered table-striped">
                            <thead style="text-align: center">
                                <tr>
                                    <th>ID</th>
                                    <th data-priority="1">Chọn</th>
                                    <th data-priority="2">Người gửi</th>
                                    <th>Số ĐT Người gửi</th>
                                    <th>Người nhận</th>
                                    <th>Số ĐT Người nhận</th>
                                    <th data-priority="3">Tổng chi phí</th>
                                    <th data-priority="4">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donhangs as $donhang)
                                <tr>
                                    <td style="text-align: center"><a
                                            href="{{ route('donhang.show', $donhang->id) }}">{{ $donhang->id }}</a>
                                    </td>
                                    <td style="text-align: center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="id_donhangduocchon"
                                                value="{{ $donhang->id }}" name="id_donhangduocchon[]">
                                        </div>
                                    </td>
                                    <td><a
                                            href="{{ route('donhang.show', $donhang->id) }}">{{ $donhang->tennguoigui }}</a>
                                    </td>
                                    <td style="text-align: center"><a
                                            href="{{ route('donhang.show', $donhang->id) }}">{{ $donhang->sodienthoainguoigui }}</a>
                                    </td>
                                    <td><a
                                            href="{{ route('donhang.show', $donhang->id) }}">{{ $donhang->tennguoinhan }}</a>
                                    </td>
                                    <td style="text-align: center"><a
                                            href="{{ route('donhang.show', $donhang->id) }}">{{ $donhang->sodienthoainguoinhan }}</a>
                                    </td>
                                    <td style="text-align: right"><a
                                            href="{{ route('donhang.show', $donhang->id) }}">{{ number_format($donhang->tongchiphi, 0, '.', '.') }}
                                    </td>
                                    <td style="text-align: center">
                                        <a href="{{ route('donhang.edit', $donhang->id) }}" style="padding: 3px">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if ($donhang->id_trangthai > 0)
                                        <a href="{{ route('donhang.delete', $donhang->id) }}"
                                            onclick="return confirm('Bạn muốn xóa Đơn hàng này?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        @else
                                        <a href="{{ route('donhang.restore', $donhang->id) }}"
                                            onclick="return confirm('Bạn muốn phục hồi Đơn hàng này?')">
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
            </form>
            <!-- /.form -->
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
            $("#donhang-table").DataTable({
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
            }).buttons().container().appendTo('#donhang-table_wrapper .col-md-6:eq(0)');
        });
</script>
@stop