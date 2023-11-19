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


      // npi chart

      let npis = {!! json_encode($npi_daily) !!}
      let npiProjects = npis.map((item) => item.project);
      let npiIncomingQty = npis.map((item) => item.incoming_qty);
      let npiOutgoingQty = npis.map((item) => item.outgoing_qty);


      var $npiChart = $('#npi-chart')

      var npiChart = new Chart($npiChart, {
        type: 'bar',
        data: {
          labels: npiProjects,
          datasets: [
            {
              label: 'Incoming',
              data: npiIncomingQty,
              backgroundColor: '#ced4da'
            },
            {
              label: 'Outgoing',
              data: npiOutgoingQty,
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


      // grpo chart

      let grpos = {!! json_encode($grpo_daily) !!}
      let grpoProjects = grpos.map((item) => item.project);
      let grpoAmounts = grpos.map((item) => item.grpo_amount / 1000000);
      let grpoPoAmounts = grpos.map((item) => item.po_sent_amount / 1000000);

      var $grpoChart = $('#grpo-chart')

      var grpoChart = new Chart($grpoChart, {
        type: 'bar',
        data: {
          labels: grpoProjects,
          datasets: [
            {
              label: 'PO Sent',
              data: grpoPoAmounts,
              backgroundColor: '#ced4da'
            },
            {
              label: 'GRPO',
              data: grpoAmounts,
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