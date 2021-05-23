$(document).ready(function () {
    $.ajax({
        url: "get-chart-data.php",
        type: "GET",
        success: function (data) {
            var newData = JSON.parse(data);
            var tempData = [];
            var humidData = [];
            var timeData = [];
            // var avgTemp = 0, avgHumid = 0;
            for (var i = 0; i < newData.length; i++) {
                let time = new Date(newData[i].Time_Receive);
                tempData.push(newData[i].Temperature);
                humidData.push(newData[i].Humidity);
                timeData.push(time.toLocaleTimeString('en-GB', {
                    hour: '2-digit',
                    minute: '2-digit'
                }));
                // avgTemp += newData[i].timeData / newData.length;
                // avgHumid += newData[i].humidData / newData.length;
            }

            var temp = {
                labels: timeData,
                datasets: [{

                    label: 'Temperature',
                    data: tempData,
                    fill: false,
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.1
                }]
            }

            var humid = {
                labels: timeData,
                datasets: [{

                    label: 'Humidity',
                    data: humidData,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            }

            var options = {
                responsive: true,
                scales: {
                    xAxes: [{
                        
                    }],
                    yAxes: [{

                    }]
                },
                maintainAspectRatio: false,
                animation: {
                    duration: 1500,
                }
            }

            var tempGraph = new Chart($('#temp-chart'), {
                type: 'line',
                data: temp,
                options: options
            })

            var humidGraph = new Chart($('#humid-chart'), {
                type: 'line',
                data: humid,
                options: options
            })

            $('.temp .export-btn').click(function () {
                tempGraph.toBase64Image();
                var a = document.createElement('a');
                a.href = tempGraph.toBase64Image();
                a.download = 'Temperature.png';
                a.click();
            })

            $('.humid .export-btn').click(function () {
                tempGraph.toBase64Image();
                var a = document.createElement('a');
                a.href = humidGraph.toBase64Image();
                a.download = 'Humid.png';
                a.click();
            })
        }
    })
})