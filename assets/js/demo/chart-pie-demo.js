// Gunakan data yang sudah diinisialisasi dari PHP
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: "doughnut",
  data: pieData, // Gunakan data dari PHP
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: "#dddfeb",
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false,
    },
    cutoutPercentage: 80,
  },
});
