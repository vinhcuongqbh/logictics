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
        <h1>THỐNG KÊ DOANH THU</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<div class="content">
  <div class="container-fluid">
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
                <span class="text-bold text-lg">{{ $tongDonHangTuanHienTai }}</span>
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
              <canvas id="visitors-chart" height="200"></canvas>
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
                <span class="text-bold text-lg">{{ $tongDonHangNamHienTai }}</span>              
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
              <canvas id="sales-chart" height="200"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
              <span class="mr-2">
                <i class="fas fa-square text-primary"></i>  {{ $namHienTai[0]}}
              </span>

              <span>
                <i class="fas fa-square text-gray"></i>  {{ $namTruoc[0] }}
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

<!-- AdminLTE -->
<script src="/vendor/adminlte/dist/js/adminlte.js"></script>

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

  var $salesChart = $('#sales-chart')
  // eslint-disable-next-line no-unused-vars

  var namHienTai = @json($namHienTai);
  var namTruoc = @json($namTruoc);
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [namHienTai[1], namHienTai[2], namHienTai[3], namHienTai[4], namHienTai[5], namHienTai[6], namHienTai[7], namHienTai[8], namHienTai[9], namHienTai[10], namHienTai[11], namHienTai[12]]
        },
        {
          backgroundColor: '#ced4da',
          borderColor: '#ced4da',
          data: [namTruoc[1], namTruoc[2], namTruoc[3], namTruoc[4], namTruoc[5], namTruoc[6], namTruoc[7], namTruoc[8], namTruoc[9], namTruoc[10], namTruoc[11], namTruoc[12]]
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

  var $visitorsChart = $('#visitors-chart')
  // eslint-disable-next-line no-unused-vars
  var tuanHienTai = @json($tuanHienTai); 
  var tuanTruoc = @json($tuanTruoc); 
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['CN', 'Thứ 2', 'Thứ 3', 'Thú 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'],
      datasets: [{
        type: 'line',
        data: [tuanHienTai[0], tuanHienTai[1], tuanHienTai[2], tuanHienTai[3], tuanHienTai[4], tuanHienTai[5], tuanHienTai[6] ],
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
        data: [tuanTruoc[0], tuanTruoc[1], tuanTruoc[2], tuanTruoc[3], tuanTruoc[4], tuanTruoc[5], tuanTruoc[6] ],
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