@extends('adminlte::page')

@section('title', 'AdminPage')

@section('content_header')
<div class="container-fluid">
    <form action="{{ route('thongke.thongKeDoanhThuDashBoard') }}" method="get">
      <div class="row mb-2">
        <div class="col-md-6">
          <h1>THỐNG KÊ DOANH THU</h1>
        </div>
        @if (Auth::user()->id_loainhanvien == 1)
        <div class="col-lg-3 col-6">
          <!-- select -->
          <div class="form-group">
            <select class="form-control" id="nhanvien" name="nhanvien">
              <option value="2">Tổng hợp</option>
              @foreach ($nhanviens as $nhanvien)
              <option value="{{ $nhanvien->id }}" @if ($id_nhanvien==$nhanvien->id) selected @endif>
                {{ $nhanvien->name }}
              </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <button type="submit" class="btn btn-primary">Xem</button>
        </div>
        @endif
      </div>
    </form>
  </div>
<!-- /.container-fluid -->
@stop

@section('content')
<!-- Main content -->
<!-- Content Header (Page header) -->
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3 style="display: inline;">{{  $doanhThuTrongNgay }} <p style="font-size: 20px; display: inline;">triệu</<p>
          </h3>
          <p>Doanh thu trong ngày</p>
        </div>
        <div class="icon">
          <i class="ion ion-cash"></i>
        </div>
        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        <div class="small-box-footer">&#8192;</div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3 style="display: inline;">{{  $doanhThuTrongTuan }} <p style="font-size: 20px; display: inline;">triệu</<p>
          </h3>
          <p>Doanh thu trong tuần</p>
        </div>
        <div class="icon">
          <i class="ion ion-cash"></i>
        </div>
        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        <div class="small-box-footer">&#8192;</div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3 style="display: inline;">{{  $doanhThuTrongThang }} <p style="font-size: 20px; display: inline;">triệu
              </<p>
          </h3>
          <p>Doanh thu trong tháng</p>
        </div>
        <div class="icon">
          <i class="ion ion-cash"></i>
        </div>
        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        <div class="small-box-footer">&#8192;</div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3 style="display: inline;">{{  $doanhThuTrongNam }} <p style="font-size: 20px; display: inline;">triệu</<p>
          </h3>
          <p>Doanh thu trong năm</p>
        </div>
        <div class="icon">
          <i class="ion ion-cash"></i>
        </div>
        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
        <div class="small-box-footer">&#8192;</div>
      </div>
    </div>
    <!-- ./col -->
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">Theo tuần</h3>
            {{-- <a href="javascript:void(0);">Báo cáo chi tiết</a> --}}
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex">
            <p class="d-flex flex-column">
              <span class="text-bold text-lg">{{ $doanhThuTrongTuan }} <sup style="font-size: 15px;">triệu</<sup></span>
              <span>Doanh thu</span>
            </p>
            <p class="ml-auto d-flex flex-column text-right">
              @if ($tiLeTangTruongTuan >0)
              <span class="text-success">
                <i class="fas fa-arrow-up"></i> {{ $tiLeTangTruongTuan }}%
              </span>
              @elseif ($tiLeTangTruongTuan ==0)
              <span class="text-warning">
                <i class="fas fa-arrow-left"></i> {{ $tiLeTangTruongTuan }}%
              </span>
              @else
              <span class="text-danger">
                <i class="fas fa-arrow-down"></i> {{ $tiLeTangTruongTuan }}%
              </span>
              @endif
              <span class="text-muted">So với tuần trước</span>
            </p>
          </div>
          <!-- /.d-flex -->

          <div class="position-relative mb-4">
            <canvas id="bieudotuan-doanhthu" height="200"></canvas>
          </div>

          <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
              <i class="fas fa-square text-primary"></i> Tuần này
            </span>

            <span>
              <i class="fas fa-square text-gray"></i> Tuần trước
            </span>
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">Theo năm</h3>
            {{-- <a href="javascript:void(0);">Báo cáo chi tiết</a> --}}
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex">
            <p class="d-flex flex-column">
              <span class="text-bold text-lg">{{ $doanhThuTrongNam }} <sup style="font-size: 15px;">triệu</<sup></span>
              <span>Doanh thu</span>
            </p>
            <p class="ml-auto d-flex flex-column text-right">
              @if ($tiLeTangTruongNam >0)
              <span class="text-success">
                <i class="fas fa-arrow-up"></i> {{ $tiLeTangTruongNam }}%
              </span>
              @elseif ($tiLeTangTruongNam ==0)
              <span class="text-warning">
                <i class="fas fa-arrow-left"></i> {{ $tiLeTangTruongNam }}%
              </span>
              @else
              <span class="text-danger">
                <i class="fas fa-arrow-down"></i> {{ $tiLeTangTruongNam }}%
              </span>
              @endif
              <span class="text-muted">So với năm trước</span>
            </p>
          </div>
          <!-- /.d-flex -->

          <div class="position-relative mb-4">
            <canvas id="bieudonam-doanhthu" height="200"></canvas>
          </div>

          <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
              <i class="fas fa-square text-primary"></i> {{ $doanhThuNamHienTai[0]}}
            </span>

            <span>
              <i class="fas fa-square text-gray"></i> {{ $doanhThuNamTruoc[0] }}
            </span>
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
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
<!-- jQuery -->
<script src="/vendor/jquery/jquery.min.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="/vendor/chart.js/Chart.min.js"></script>
<!-- AdminLTE dashboard -->
<script>
  $(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  //Biểu đồ doanh thu thống kê theo Năm
  var $salesChart = $('#bieudonam-doanhthu')
  // eslint-disable-next-line no-unused-vars

  var doanhThuNamHienTai = @json($doanhThuNamHienTai);
  var doanhThuNamTruoc = @json($doanhThuNamTruoc);
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [doanhThuNamHienTai[1], doanhThuNamHienTai[2], doanhThuNamHienTai[3], doanhThuNamHienTai[4], doanhThuNamHienTai[5], doanhThuNamHienTai[6], doanhThuNamHienTai[7], doanhThuNamHienTai[8], doanhThuNamHienTai[9], doanhThuNamHienTai[10], doanhThuNamHienTai[11], doanhThuNamHienTai[12]]
        },
        {
          backgroundColor: '#ced4da',
          borderColor: '#ced4da',
          data: [doanhThuNamTruoc[1], doanhThuNamTruoc[2], doanhThuNamTruoc[3], doanhThuNamTruoc[4], doanhThuNamTruoc[5], doanhThuNamTruoc[6], doanhThuNamTruoc[7], doanhThuNamTruoc[8], doanhThuNamTruoc[9], doanhThuNamTruoc[10], doanhThuNamTruoc[11], doanhThuNamTruoc[12]]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

  //Biểu đồ doanh thu thống kê theo tuần
  var $visitorsChart = $('#bieudotuan-doanhthu')
  // eslint-disable-next-line no-unused-vars
  var doanhThuTuanHienTai = @json($doanhThuTuanHienTai);
  var doanhThuTuanTruoc = @json($doanhThuTuanTruoc);
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'CN'],
      datasets: [{
        type: 'line',
        data: [doanhThuTuanHienTai[2], doanhThuTuanHienTai[3], doanhThuTuanHienTai[4], doanhThuTuanHienTai[5], doanhThuTuanHienTai[6], doanhThuTuanHienTai[7], doanhThuTuanHienTai[8] ],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type: 'line',
        data: [doanhThuTuanTruoc[2], doanhThuTuanTruoc[3], doanhThuTuanTruoc[4], doanhThuTuanTruoc[5], doanhThuTuanTruoc[6], doanhThuTuanTruoc[7], doanhThuTuanTruoc[8] ],
        backgroundColor: 'tansparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      }
    ]},
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 10
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
})
</script>
@stop
