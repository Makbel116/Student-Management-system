// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
document.addEventListener("DOMContentLoaded", function() {
  var ctx = document.getElementById("myPieChart");
  var dataFromView = JSON.parse(ctx.getAttribute('data-values'));
  var studentCountsPerCourse = JSON.parse(ctx.getAttribute('student-counts-per-course'));
  var backgroundColors = generateBackgroundColors(dataFromView.length);

  var myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: dataFromView,
          datasets: [{
              data: studentCountsPerCourse,
              backgroundColor: backgroundColors,
          }],
      },
  });
});

function generateBackgroundColors(count) {
  var colors = [];
  for (var i = 0; i < count; i++) {
      colors.push(getRandomColor());
  }
  return colors;
}

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}