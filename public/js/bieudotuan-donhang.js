$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true


  var $visitorsChart = $('#bieudotuan-donhang')
  // eslint-disable-next-line no-unused-vars
  var donHangTuanHienTai = @json($donHangTuanHienTai);
  var donHangTuanTruoc = @json($donHangTuanTruoc);
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['CN', 'Thứ 2', 'Thứ 3', 'Thú 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'],
      datasets: [{
        type: 'line',
        data: [donHangTuanHienTai[0], donHangTuanHienTai[1], donHangTuanHienTai[2], donHangTuanHienTai[3], donHangTuanHienTai[4], donHangTuanHienTai[5], donHangTuanHienTai[6]],
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
        data: [donHangTuanTruoc[0], donHangTuanTruoc[1], donHangTuanTruoc[2], donHangTuanTruoc[3], donHangTuanTruoc[4], donHangTuanTruoc[5], donHangTuanTruoc[6]],
        backgroundColor: 'tansparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
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