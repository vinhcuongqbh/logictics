@extends('adminlte::page')

@section('title', 'Đơn giá')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-7">
            <h1>ĐƠN GIÁ THEO SỐ LƯỢNG</h1>
        </div>
        <div class="col-sm-5">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                <li class="breadcrumb-item active">Đơn giá theo số lượng</li>
            </ol>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-auto">
                            <a href="{{ route('dongiatinhtheosoluong.create') }}"><button type="button"
                                    class="btn btn-primary">THÊM MỚI</button></a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dongia-table" class="table table-bordered table-striped">
                        <thead style="text-align: center">
                            <tr>
                                <th>STT</th>
                                <th>Tên Mặt hàng</th>
                                <th>Đơn giá đường không (VNĐ)</th>
                                <th>Đơn giá đường biển (VNĐ)</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dongiatinhtheosoluongs as $dongiatinhtheosoluong)
                                <tr>
                                    <td style="text-align: center"></td>
                                    <td>{{ $dongiatinhtheosoluong->tenmathang }}
                                    </td>
                                    <td style="text-align: right">
                                        {{ number_format($dongiatinhtheosoluong->dongiaduongkhong, 0, '.', '.') }}
                                    </td>
                                    <td style="text-align: right">
                                        {{ number_format($dongiatinhtheosoluong->dongiaduongbien, 0, '.', '.') }}
                                    </td>
                                    <td style="text-align: center">
                                        <a href="{{ route('dongiatinhtheosoluong.edit', $dongiatinhtheosoluong->id) }}"
                                            style="padding: 3px">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('dongiatinhtheosoluong.delete', $dongiatinhtheosoluong->id) }}"
                                            onclick="return confirm('Bạn muốn xóa Đơn giá này?')">
                                            <i class="fas fa-trash-alt"></i>
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
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> --}}
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
    $(document).ready(function() {
        var dongiaTable = $("#dongia-table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "pageLength": 25,
            "searching": true,
            "autoWidth": false,
            "paging": true,
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
            "order": [
                [0, 'desc']
            ],
        });

        //Start: Tạo cột Số thứ tự
        dongiaTable.on('order.dt search.dt', function() {
            dongiaTable.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        //End: Tạo cột Số thứ tự
    });
</script>
@stop
