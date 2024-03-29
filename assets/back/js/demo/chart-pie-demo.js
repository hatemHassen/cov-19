// Set new default font family and font color to mimic Bootstrap's default styling
import Chart from 'chart.js'
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
let data =JSON.parse(ctx.dataset.nodes);
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Active", "Passive"],
    datasets: [{
      data: data,
      backgroundColor: ['#e74a3b', '#1cc88a'],
      hoverBackgroundColor: ['#e74a3b', '#1cc88a'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
