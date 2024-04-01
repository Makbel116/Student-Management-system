// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var dataFromView = JSON.parse(ctx.getAttribute("data-values"));
var studentCountsPerBatch = JSON.parse(
    ctx.getAttribute("student-counts-per-batch")
);

var backgroundColors = generateBackgroundColors(dataFromView.length);
var myLineChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: dataFromView,
        datasets: [
            {
                label: "Students per Batch",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: studentCountsPerBatch,
            },
        ],
    },
    options: {
        scales: {
            xAxes: [
                {
                    gridLines: {
                        display: false,
                    },
                    ticks: {
                        maxRotation: 0,
                        autoSkip: false,
                    },
                },
            ],
            yAxes: [
                {
                    ticks: {
                        min: 0,
                        maxTicksLimit: 5,
                    },
                    gridLines: {
                        display: true,
                    },
                },
            ],
        },
        legend: {
            display: false,
        },
        tooltips: {
            callbacks: {
                label: function (tooltipItem, data) {
                    var datasetLabel =
                        data.datasets[tooltipItem.datasetIndex].label || "";
                    return datasetLabel + ": " + tooltipItem.yLabel;
                },
            },
        },
    },
});
