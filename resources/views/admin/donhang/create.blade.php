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
                            <div class="col-sm-6" style="float: left">
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
                            <div class="col-sm-6" style="float: left">
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
                                        data-target="#modal-lg">
                                        Thêm Mặt hàng
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
                                                    <label for="mathang" class="col-sm-3 col-form-label">Loại hàng
                                                        hóa</label>
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
                                                <!--
                                                        <div class="form-group row">
                                                            <label for="noidunghang" class="col-sm-3 col-form-label">Nội dung
                                                                hàng</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" id="noidunghang" name="noidunghang"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    -->
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
                                    <table id="donhang-table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="text-align: center">
                                                <th>STT</th>
                                                <th>Tên Mặt hàng</th>
                                                <th>Số lượng (Cái)</th>
                                                <th>Khối lượng (Kg)</th>
                                                <th>Kích thước</th>
                                                <th>Giá trị ước tính</th>
                                                <th>Chi phí</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr style="text-align: center">
                                                <th colspan="6">Tổng chi phí</th>
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
                    <input type="hidden" id="tongchiphi2" name="tongchiphi2" value="10000">
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
<!-- Theme style -->
<link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@stop

@section('js')
<!-- jquery-validation -->
<script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="/vendor/jquery-validation/additional-methods.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Page specific script -->
<script>
    var chiTietDonHang = [];
    var stt = 1;

    //Tính chi chí
    const dongiatinhtheokhoiluong = @json($dongiatinhtheokhoiluong); 
    const dongiatinhtheosoluong = @json($dongiatinhtheosoluong);
    const dongiahangcongkenh = @json($dongiahangcongkenh);

    const tinhChiPhi = function() {
        let soluong = document.querySelector("#soluong").value;
        let khoiluong = document.querySelector("#khoiluong").value; 

        if (soluong != 0) {
            let tenmathang = document.querySelector("#mathang").value;            
            let chiphi = soluong * parseInt(dongiatinhtheosoluong.find(e => e.tenmathang == tenmathang)?.dongia || 0);
            document.querySelector("#chiphi").value = chiphi;
        }

        if (khoiluong != 0) {
            for(var i = 0; i < dongiatinhtheokhoiluong.length; i++) {
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


    //Tổng chi phí
    $.fn.dataTable.Api.register('column().data().sum()', function() {
        return this.reduce(function(a, b) {
            var x = parseFloat(a) || 0;
            var y = parseFloat(b) || 0;
            return x + y;
        });
    });

    //Đơn hàng Table
    $(document).ready(function() {
        var t = $('#donhang-table').DataTable({
            "columnDefs": [
                {"className": "dt-center", "targets": 0},
                {"className": "dt-left", "targets": 1},
                {"className": "dt-center", "targets": 2},
                {"className": "dt-center", "targets": 3},
                {"className": "dt-center", "targets": 4},
                {"className": "dt-center", "targets": 5},
                {"className": "dt-right", "targets": 6},
            ]
        });

        //Thêm row vào table
        $('#addRow').on('click', function() {
            //Lấy dữ liệu từ các input
            var mathang = document.querySelector("#mathang").value;
            //var noidunghang = document.querySelector("#noidunghang").value;
            var soluong = document.querySelector("#soluong").value;
            var khoiluong = document.querySelector("#khoiluong").value;
            var kichthuoc = document.querySelector("#kichthuoc").value;
            var giatriuoctinh = document.querySelector("#giatriuoctinh").value;
            var chiphi = document.querySelector("#chiphi").value;
            t.row.add([
                stt,
                mathang,
                //noidunghang,
                soluong,
                khoiluong,
                kichthuoc,
                giatriuoctinh,
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

            //Lựa chọn row
            $('#donhang-table tbody').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    t.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            //Tính Tổng chi phí
            document.querySelector("#tongchiphi").innerHTML = Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(t.column(6).data().sum());
            document.querySelector("#tongchiphi2").value = t.column(6).data().sum();

            //Làm trống dữ liệu input
            stt++;
            document.querySelector("#mathang").innerHTML = "";
            //document.querySelector("#noidunghang").value = "";
            document.querySelector("#soluong").value = "";
            document.querySelector("#khoiluong").value = "";
            document.querySelector("#kichthuoc").value = "";
            document.querySelector("#giatriuoctinh").value = "";
            document.querySelector("#chiphi").value = "";
        });
    });

    /*
    //Gửi data lên server bằng javascript
    function sendDataToServer() {
        let duLieuGuiDi = {
            nguoigui: document.querySelector("#tennguoigui").value,
            nguoinhan: document.querySelector("#tennguoinhan").value,
            chitietdonhang: chiTietDonHang
        }
        axios.post("http://127.0.0.1:8000/admin/donhang/store", duLieuGuiDi).then(function(e){
            if (e.data == "success") {
                alert("OK")
            } else {
                alert("Fail roi ")
            }
        })
    }
    */
</script>
<script>
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
                loaihang: {
                    required: true,
                },
                chiphi: {
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
                    required: "Nhập địa chỉ của Người gửi",
                },
                sodienthoainguoinhan: {
                    required: "Nhập Số điện thoại của Người nhận",
                },
                tennguoinhan: {
                    required: "Nhập Họ tên của Người nhận",
                },
                diachinguoinhan: {
                    required: "Nhập địa chỉ của Người nhận",
                },
                loaihang: {
                    required: "Nhập tên Mặt hàng",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);

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