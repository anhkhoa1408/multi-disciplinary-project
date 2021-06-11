$(document).ready(function () {
    $.ajax({
        url: "get-chart-data.php",
        type: "GET",
        success: function (data) {
            // console.log(data)
            var newData = JSON.parse(data);
            var tempData = [];
            var humidData = [];
            var timeData = [];
            for (var i = 0; i < newData.length; i++) {
                let time = new Date(newData[i].Time);
                tempData.push(newData[i].Average_Temperature);
                humidData.push(newData[i].Average_Humidity);
                timeData.push(time.getDate() + '/' + time.getMonth() + '/' + time.getFullYear());
            }

            var temp = {
                labels: timeData,
                datasets: [{

                    label: 'Temperature',
                    data: tempData,
                    fill: false,
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.1,
                    
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

            var temp_option = {
                scales: {
                    xAxes: {
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Day',
                            color: 'Blue',
                            font: {
                                size: 15
                            }
                        }
                    },
                    yAxes: {
                        min: 0,
                        max: 100,
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Temperature',
                            color: 'Blue',
                            font: {
                                size: 15
                            }
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 4000,
                }
            };

            var humid_option = {
                scales: {
                    xAxes: {
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Day',
                            color: 'Blue',
                            font: {
                                size: 15
                            }
                        }
                    },
                    yAxes: {
                        min: 0,
                        max: 100,
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Humidity',
                            color: 'Blue',
                            font: {
                                size: 15
                            }
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 4000,
                }
            };

            var tempGraph = new Chart($('#temp-chart'), {
                type: 'line',
                data: temp,
                options: temp_option
            })

            var humidGraph = new Chart($('#humid-chart'), {
                type: 'line',
                data: humid,
                options: humid_option
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