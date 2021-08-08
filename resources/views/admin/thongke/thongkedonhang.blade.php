@extends('adminlte::page')

@section('title', 'AdminPage')

@section('content_header')

@stop

@section('content')
<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>THỐNG KÊ ĐƠN HÀNG</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<div class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{  $donHangTrongNgay }}</h3>

            <p>Đơn hàng trong ngày</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
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
            <h3>{{  $donHangTrongTuan }}</sup></h3>

            <p>Đơn hàng trong tuần</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
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
            <h3>{{  $donHangTrongThang }}</h3>

            <p>Đơn hàng trong tháng</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
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
            <h3>{{  $donHangTrongNam }}</h3>

            <p>Đơn hàng trong năm</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
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
              <a href="javascript:void(0);">Báo cáo chi tiết</a>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <p class="d-flex flex-column">
                <span class="text-bold text-lg">{{ $donHangTrongTuan }}</span>
                <span>Đơn hàng</span>
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
              <canvas id="bieudotuan-donhang" height="200"></canvas>
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
              <a href="javascript:void(0);">Báo cáo chi tiết</a>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <p class="d-flex flex-column">
                <span class="text-bold text-lg">{{ $donHangTrongNam }}</span>
                <span>Đơn hàng</span>
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
              <canvas id="bieudonam-donhang" height="200"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
              <span class="mr-2">
                <i class="fas fa-square text-primary"></i> {{ $donHangNamHienTai[0]}}
              </span>

              <span>
                <i class="fas fa-square text-gray"></i> {{ $donHangNamTruoc[0] }}
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
</div>
<!-- /.content -->
</div>

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

  //Biểu đồ đơn hàng thống kê theo Năm
  var $salesChart = $('#bieudonam-donhang')
  // eslint-disable-next-line no-unused-vars

  var donHangNamHienTai = @json($donHangNamHienTai);
  var donHangNamTruoc = @json($donHangNamTruoc);
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [donHangNamHienTai[1], donHangNamHienTai[2], donHangNamHienTai[3], donHangNamHienTai[4], donHangNamHienTai[5], donHangNamHienTai[6], donHangNamHienTai[7], donHangNamHienTai[8], donHangNamHienTai[9], donHangNamHienTai[10], donHangNamHienTai[11], donHangNamHienTai[12]]
        },
        {
          backgroundColor: '#ced4da',
          borderColor: '#ced4da',
          data: [donHangNamTruoc[1], donHangNamTruoc[2], donHangNamTruoc[3], donHangNamTruoc[4], donHangNamTruoc[5], donHangNamTruoc[6], donHangNamTruoc[7], donHangNamTruoc[8], donHangNamTruoc[9], donHangNamTruoc[10], donHangNamTruoc[11], donHangNamTruoc[12]]
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

  //Biểu đồ đơn hàng thống kê theo tuần
  var $visitorsChart = $('#bieudotuan-donhang')
  // eslint-disable-next-line no-unused-vars
  var donHangTuanHienTai = @json($donHangTuanHienTai);
  var donHangTuanTruoc = @json($donHangTuanTruoc);
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'CN'],
      datasets: [{
        type: 'line',
        data: [donHangTuanHienTai[2], donHangTuanHienTai[3], donHangTuanHienTai[4], donHangTuanHienTai[5], donHangTuanHienTai[6], donHangTuanHienTai[7], donHangTuanHienTai[8] ],
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
        data: [donHangTuanTruoc[2], donHangTuanTruoc[3], donHangTuanTruoc[4], donHangTuanTruoc[5], donHangTuanTruoc[6], donHangTuanTruoc[7], donHangTuanTruoc[8] ],
        backgroundColor: 'transparent',
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