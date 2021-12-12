@extends('adminlte::page')

@section('title', 'AdminPage')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-3">
            <h1>THỐNG KÊ TỔNG HỢP</h1>
        </div>
        <div class="col-sm-9">
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('thongke.ketquathongke') }}" method="get" id="thongke-index">
                        @csrf
                        <div class="form-group row">
                            @if (Auth::user()->id_loainhanvien == 1)
                            <div class="col-sm-12 col-md-2">
                                <label>Nhân viên</label>
                                <select class="form-control" id="nhanvien" name="nhanvien">
                                    <option value="2">Tổng hợp</option>
                                    @foreach ($nhanviens as $nhanvien)
                                    <option value="{{ $nhanvien->id }}" @if ($id_nhanvien==$nhanvien->id) selected
                                        @endif>
                                        {{ $nhanvien->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                                <input type="hidden" id="nhanvien" name="nhanvien" value="{{ Auth::id() }}">
                            @endif
                            <div class="col-12 col-md-2">
                                <label>Ngày bắt đầu</label>
                                <input type="date" id="ngaybatdau" name="ngaybatdau" class="form-control">
                            </div>
                            <div class="col-12 col-md-2">
                                <label>Ngày kết thúc</label>
                                <input type="date" id="ngayketthuc" name="ngayketthuc" class="form-control">
                            </div>
                            <div class="col-12 col-md-2">
                                <button type="submit" class="btn btn-primary"
                                    style="position: absolute; bottom: 0;">Xem</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.form -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="donhang-table" class="table table-bordered table-striped">
                        <thead style="text-align: center">
                            <tr>
                                <th rowspan="2">ID<br>Nhân viên</th>
                                <th rowspan="2">Tên Nhân viên</th>
                                <th colspan="3">Số đơn hàng đã nhận</th>
                                <th colspan="3">Số đơn hàng thất lạc</th>
                                <th colspan="3">Khối lượng đã nhận (kg)</th>
                                <th colspan="3">Doanh thu (triệu)</th>
                                {{-- <th colspan="3">Chiết khấu (triệu)</th> --}}
                            </tr>
                            <tr>
                                <th>Tổng</th>
                                <th>Đ.Không</th>
                                <th>Đ.Biển</th>                                
                                <th>Tổng</th>
                                <th>Đ.Không</th>
                                <th>Đ.Biển</th>
                                <th>Tổng</th>
                                <th>Đ.Không</th>
                                <th>Đ.Biển</th>
                                <th>Tổng</th>
                                <th>Đ.Không</th>
                                <th>Đ.Biển</th>
                                {{-- <th>Tổng</th>
                                <th>Đ.Không</th>
                                <th>Đ.Biển</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i=1;$i<=5;$i++) <tr>
                                @for ($j=1;$j<=14;$j++) <td>
                                    </td>
                                    @endfor
                                    </tr>
                                    @endfor
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
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css">
<!-- IonIcons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
<!-- jquery-validation -->
<script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="/vendor/jquery-validation/additional-methods.min.js"></script>
<!-- Page specific script -->
<script>
    //Kiểm tra dữ liệu đầu vào
    $(function() {
        $('#thongke-index').validate({
            rules: {
                ngaybatdau: {
                    required: true,                   
                },
                ngayketthuc: {
                    required: true,
                },
            },
            messages: {
                ngaybatdau: {
                    required: "Nhập Ngày bắt đầu",                  
                },
                ngayketthuc: {
                    required: "Nhập Ngày kết thúc",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('div').append(error);

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