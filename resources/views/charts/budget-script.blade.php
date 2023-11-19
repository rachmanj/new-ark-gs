<script>
    $(function () {
        'use strict'

        var ticksStyle = {
          fontColor: '#495057',
          fontStyle: 'bold'
        }

        var mode      = 'index'
        var intersect = true

        let regulers = {!! json_encode($reguler_daily) !!}
        let projects = regulers.map((item) => item.project);
        let budgets = regulers.map((item) => item.budget / 1000000);
        let sent_amounts = regulers.map((item) => item.sent_amount / 1000000);

        var $regulerChart = $('#reguler-chart')

        var regulerChart = new Chart($regulerChart, {
          type: 'bar',
          data: {
            labels: projects,
            datasets: [
              {
                label: 'Budget',
                data: budgets,
                backgroundColor: '#ced4da'
              },
              {
                label: 'PO Sent',
                data: sent_amounts,
                backgroundColor: '#007bff'
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
              display: true
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
                  suggestedMax: 200,
                  
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

        // capex chart

        let capexs = {!! json_encode($capex_daily) !!}
        let capexProjects = capexs.map((item) => item.project);
        let capexBudgets = capexs.map((item) => item.budget / 1000000);
        let capexSentAmounts = capexs.map((item) => item.sent_amount / 1000000);

        var $capexChart = $('#capex-chart')

        var capexChart = new Chart($capexChart, {
          type: 'bar',
          data: {
            labels: capexProjects,
            datasets: [
              {
                label: 'Budget',
                data: capexBudgets,
                backgroundColor: '#ced4da'
              },
              {
                label: 'PO Sent',
                data: capexSentAmounts,
                backgroundColor: '#007bff'
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
              display: true
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
                  suggestedMax: 200,
                  
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