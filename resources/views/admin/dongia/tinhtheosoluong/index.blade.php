@extends('adminlte::page')

@section('title', 'Đơn giá')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-xs-12">
            <h1>ĐƠN GIÁ TÍNH THEO SỐ LƯỢNG</h1>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div>
                            <div class="col-auto">
                                <a href="{{ route('dongiatinhtheosoluong.create') }}"><button type="button"
                                        class="btn btn-primary float-left"
                                        style="width: 100px; margin-right: 10px;">THÊM
                                        MỚI</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dongia-table" class="table table-bordered table-striped">
                        <thead style="text-align: center">
                            <tr>
                                <th>STT</th>
                                <th>Tên mặt hàng</th>
                                <th>Đơn giá (VNĐ)</th>
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
                                    {{ number_format($dongiatinhtheosoluong->dongia, 0, '.', '.') }}</td>
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
<!-- Page specific script -->
<script>
    $(document).ready(function() {
        var dongiaTable = $("#dongia-table").DataTable({
                "responsive": true,
                "searching": true, 
                "paging": true, 
                "lengthChange": false,
                "pageLength": 25,
                "autoWidth": false,               
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