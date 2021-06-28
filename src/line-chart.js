$(document).ready(function () {
    var date = new Date();
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
                timeData.push(time.getDate() + '/' + (parseInt(time.getMonth()) + 1).toString() + '/' + time.getFullYear());
            }

            var temp = {
                labels: timeData,
                datasets: [{

                    label: 'Temperature',
                    data: tempData,
                    fill: true,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.3)',
                    tension: 0.5,
                    pointHoverRadius: 4,
                }]
            }

            var humid = {
                labels: timeData,
                datasets: [{

                    label: 'Humidity',
                    data: humidData,
                    fill: true,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.3)',
                    tension: 0.5,
                    pointHoverRadius: 4,
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
                            color: 'rgba(0, 0, 0, 0.8)',
                            font: {
                                size: 16
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
                            color: 'rgba(0, 0, 0, 0.8)',
                            font: {
                                size: 16
                            }
                        },
                        ticks: {
                            stepSize: 20
                        }
                    },
                    
                },
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 2000,
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Last updated ' + date.getDate() + '/' + (parseInt(date.getMonth()) + 1).toString() + '/' + date.getFullYear(),
                        position: 'bottom',
                        align: 'start',
                        padding: {
                            top: 10
                        },
                        font: {
                            size: 13,
                            weight: '500'
                        }
                    }
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
                            color: 'rgba(0, 0, 0, 0.7)',
                            font: {
                                size: 16
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
                            color: 'rgba(0, 0, 0, 0.7)',
                            font: {
                                size: 16
                            }
                        },
                        ticks: {
                            stepSize: 20
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 2000,
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Last updated ' + date.getDate() + '/' + (parseInt(date.getMonth()) + 1).toString() + '/' + date.getFullYear(),
                        position: 'bottom',
                        align: 'start',
                        padding: {
                            top: 10
                        },
                        font: {
                            size: 13,
                            weight: '500'
                        }
                    }
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