@extends('adminlte::page')

@section('title', 'Thêm mới Đơn hàng')

@section('content_header')

@stop

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ĐƠN HÀNG</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thêm mới Đơn hàng</h3>
                    </div>
                    <form class="form-horizontal" action="{{ route('donhang.store') }}" method="post" id="donhang-create">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6" style="float: left; padding: 0px 30px;">
                                    <div class="form-group row" style="text-align: center">
                                        <label for="nguoigui" class="col-sm-12 col-form-label">THÔNG TIN NGƯỜI GỬI</label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sodienthoainguoigui" class="col-sm-3 col-form-label">Số điện
                                            thoại</label>
                                        <div class="col-sm-9">
                                            <input type="tel" id="sodienthoainguoigui" name="sodienthoainguoigui"
                                                placeholder="(+81)123-456-789" value="{{ old('sodienthoainguoigui') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tennguoigui" class="col-sm-3 col-form-label">Họ và tên</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="tennguoigui" name="tennguoigui"
                                                value="{{ old('tennguoigui') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="diachinguoigui" class="col-sm-3 col-form-label">Địa chỉ</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="diachinguoigui" name="diachinguoigui"
                                                value="{{ old('diachinguoigui') }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="float: left; padding: 0px 30px;">
                                    <div class="form-group row" style="text-align: center">
                                        <label for="nguoinhan" class="col-sm-12 col-form-label">THÔNG TIN NGƯỜI NHẬN</label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sodienthoainguoinhan" class="col-sm-3 col-form-label">Số điện
                                            thoại</label>
                                        <div class="col-sm-9">
                                            <input type="tel" id="sodienthoainguoinhan" name="sodienthoainguoinhan"
                                                placeholder="(+81)123-456-789" value="{{ old('sodienthoainguoinhan') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tennguoinhan" class="col-sm-3 col-form-label">Họ và tên</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="tennguoinhan" name="tennguoinhan"
                                                value="{{ old('tennguoinhan') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="diachinguoinhan" class="col-sm-3 col-form-label">Địa chỉ</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="diachinguoinhan" name="diachinguoinhan"
                                                value="{{ old('diachinguoinhan') }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div style="margin-bottom: 20px;">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#modal-lg" style="width: 80px;">
                                            Thêm
                                        </button>
                                        <button type="button" class="btn btn-secondary" id="editRow"
                                            style="width: 80px; margin-left: 10px;">
                                            Sửa
                                        </button>
                                        <button type="button" class="btn btn-danger" id="deleteRow"
                                            style="width: 80px; margin-left: 10px;">
                                            Xóa
                                        </button>
                                    </div>
                                    <div class="modal fade" id="modal-lg">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Thêm mới mặt hàng</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label for="mathang" class="col-sm-3 col-form-label">Mặt
                                                            hàng</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" id="mathang" name="mathang"
                                                                list="danhmucmathang" class="form-control">
                                                            <datalist id="danhmucmathang">
                                                                @foreach ($danhmucmathangs as $danhmucmathang)
                                                                    <option value="{{ $danhmucmathang->tenmathang }}" />
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="soluong" class="col-sm-3 col-form-label">Số
                                                            lượng</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" id="soluong" name="soluong"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="khoiluong" class="col-sm-3 col-form-label">Khối
                                                            lượng</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" id="khoiluong" name="khoiluong"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kichthuoc" class="col-sm-3 col-form-label">Kích
                                                            thước</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" id="kichthuoc" name="kichthuoc"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="giatriuoctinh" class="col-sm-3 col-form-label">Giá trị
                                                            ước tính</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" id="giatriuoctinh" name="giatriuoctinh"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="chiphi" class="col-sm-3 col-form-label">Chi phí</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" id="chiphi" name="chiphi"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" id="addRow"
                                                        data-dismiss="modal">Thêm
                                                        Mặt hàng</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                    <div id="donhang-table-div">
                                        <table id="donhang-table" class="table table-bordered table-striped"
                                            style="width:100%">
                                            <thead>
                                                <tr style="text-align: center">
                                                    <th>STT</th>
                                                    <th>Tên Mặt hàng</th>
                                                    <th>Số lượng (Cái)</th>
                                                    <th>Khối lượng (Kg)</th>
                                                    <th>Kích thước</th>
                                                    <th>Chi phí</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr style="text-align: center">
                                                    <th colspan="5">Tổng chi phí</th>
                                                    <th id="tongchiphi"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="form-group" style="margin-top: 20px;">
                                        <div class="col-12">
                                            <input type="submit" value="TẠO MỚI" class="btn btn-primary float-right">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <input type="hidden" id="tongchiphi2" name="tongchiphi2">
                        <input type="hidden" id="chiTietDonHang" name="chiTietDonHang">
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->

@stop

@section('css')
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
    <!-- jquery-validation -->
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery-validation/additional-methods.min.js"></script>

    <!-- Page specific script -->
    <script>
        var chiTietDonHang = [];
        var stt = 0;

        $(document).ready(function() {
            //Start: Tạo Table Đơn hàng
            var donhangTable = $('#donhang-table').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "ordering": false,
                "paging": false,
            });
            //End: Tạo Table Đơn hàng



            //Start: Thêm row vào table
            $('#addRow').on('click', function() {
                //Start: Lấy dữ liệu từ các input
                stt++;
                var mathang = document.querySelector("#mathang").value;
                var soluong = document.querySelector("#soluong").value;
                var khoiluong = document.querySelector("#khoiluong").value;
                var kichthuoc = document.querySelector("#kichthuoc").value;
                var giatriuoctinh = document.querySelector("#giatriuoctinh").value;
                var chiphi = document.querySelector("#chiphi").value;

                donhangTable.row.add([
                    stt,
                    mathang,
                    soluong,
                    khoiluong,
                    kichthuoc,
                    //giatriuoctinh,
                    chiphi,
                ]).draw(false);

                //Thêm row vào input hidden datatable
                const row = {
                    "stt": stt,
                    "mathang": mathang,
                    //"noidunghang": noidunghang,
                    "soluong": soluong,
                    "khoiluong": khoiluong,
                    "kichthuoc": kichthuoc,
                    "giatriuoctinh": giatriuoctinh,
                    "chiphi": chiphi,
                }
                chiTietDonHang.push(row);
                document.querySelector("#chiTietDonHang").value = JSON.stringify(chiTietDonHang);
                //End: Lấy dữ liệu từ các input



                //Hiển thị Tổng chi phí
                document.querySelector("#tongchiphi").innerHTML = Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(donhangTable.column(5).data().sum());
                document.querySelector("#tongchiphi2").value = donhangTable.column(5).data().sum();
                //End: Tính Tổng chi phí



                //Start: Làm trống dữ liệu input
                document.querySelector("#mathang").value = "";
                document.querySelector("#soluong").value = "";
                document.querySelector("#khoiluong").value = "";
                document.querySelector("#kichthuoc").value = "";
                document.querySelector("#giatriuoctinh").value = "";
                document.querySelector("#chiphi").value = "";
                //End: Làm trống dữ liệu input
            });



            //Start: Lựa chọn row
            donhangTable.on('click', 'tbody tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    donhangTable.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            }); //End: Lựa chọn row



            //Start: Xóa Row
            $('#deleteRow').click(function() {
                donhangTable.row('.selected').remove().draw(false);

                //Hiển thị Tổng chi phí
                document.querySelector("#tongchiphi").innerHTML = Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(donhangTable.column(5).data().sum());
                document.querySelector("#tongchiphi2").value = donhangTable.column(5).data().sum();
                //End: Tính Tổng chi phí
            }); //End: Xóa row



            //Start: Tính chi chí
            const dongiatinhtheokhoiluong = @json($dongiatinhtheokhoiluong);
            const dongiatinhtheosoluong = @json($dongiatinhtheosoluong);
            const dongiahangcongkenh = @json($dongiahangcongkenh);

            const tinhChiPhi = function() {
                let soluong = document.querySelector("#soluong").value;
                let khoiluong = document.querySelector("#khoiluong").value;
                document.querySelector("#chiphi").value = "";

                if (soluong != 0 && khoiluong == "") {
                    let tenmathang = document.querySelector("#mathang").value;
                    let chiphi = soluong * parseInt(dongiatinhtheosoluong.find(e => e.tenmathang ==
                            tenmathang)?.dongia ||
                        0);
                    document.querySelector("#chiphi").value = chiphi;
                }

                if (khoiluong != 0 && soluong == "") {
                    for (var i = 0; i < dongiatinhtheokhoiluong.length; i++) {
                        if (khoiluong < dongiatinhtheokhoiluong[i].khoiluongmax) {
                            dongia = dongiatinhtheokhoiluong[i].dongia;
                        }
                    }
                    let chiphi = khoiluong * parseInt(dongia || 0);
                    document.querySelector("#chiphi").value = chiphi;
                }
            }

            document.querySelector("#mathang").addEventListener('blur', tinhChiPhi);
            document.querySelector("#soluong").addEventListener('blur', tinhChiPhi);
            document.querySelector("#khoiluong").addEventListener('blur', tinhChiPhi);
            //End: Tính Chi phí



            //Start: Hàm tính Tổng chi phí
            $.fn.dataTable.Api.register('column().data().sum()', function() {
                return this.reduce(function(a, b) {
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
                    return x + y;
                });
            });
            //End: Hàm tính Tổng chi phí
        });
    </script>

    <script>
        //Kiểm tra dữ liệu đầu vào
        $(function() {
            $('#donhang-create').validate({
                rules: {
                    sodienthoainguoigui: {
                        required: true,
                    },
                    tennguoigui: {
                        required: true,
                    },
                    diachinguoigui: {
                        required: true,
                    },
                    sodienthoainguoinhan: {
                        required: true,
                    },
                    tennguoinhan: {
                        required: true,
                    },
                    diachinguoinhan: {
                        required: true,
                    },
                },
                messages: {
                    sodienthoainguoigui: {
                        required: "Nhập Số điện thoại của Người gửi",
                    },
                    tennguoigui: {
                        required: "Nhập Họ tên của Người gửi",
                    },
                    diachinguoigui: {
                        required: "Nhập Địa chỉ của Người gửi",
                    },
                    sodienthoainguoinhan: {
                        required: "Nhập Số điện thoại của Người nhận",
                    },
                    tennguoinhan: {
                        required: "Nhập Họ tên của Người nhận",
                    },
                    diachinguoinhan: {
                        required: "Nhập Địa chỉ của Người nhận",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-sm-9').append(error);

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
