$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  var $salesChart = $('#bieudonam-donhang')
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
})

