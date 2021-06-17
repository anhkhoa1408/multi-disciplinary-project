async function loadChart() {
    await $.ajax({
        type: 'GET',
        url: 'get-avg-data.php',
        success: function (data) {
            console.log(data)
            var newData = JSON.parse(data);
            var temp_humid = [newData[0].Average_Temperature, newData[0].Average_Humidity]
            // console.log(chartData)
            var data = {
                labels: ['Temperature', 'Humidity'],
                datasets: [{
                    label: 'Average',
                    data: temp_humid,
                    fill: true,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',

                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                    ],
                    borderWidth: 1
                }]
            }

            var option = {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            display: false,
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1000,
                }
            }


            var tempGraph = new Chart($('#bar-chart'), {
                type: 'bar',
                data: data,
                options: option
            })
        }
    })
}
