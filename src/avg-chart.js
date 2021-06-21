var tempGraph

function loadChart(interval) {
    $.ajax({
        type: "POST",
        url: 'get-avg-data.php',
        data: {
            date: interval
        },
        success: function (data) {
            var newData = JSON.parse(data);
            var temp_humid = [newData[0].Average_Temperature, newData[0].Average_Humidity]
            var data = {
                labels: ['Temperature', 'Humidity'],
                datasets: [{
                    label: 'Average',
                    data: temp_humid,
                    fill: true,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(75, 192, 192, 0.7)',

                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(75, 192, 192)',
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
                        },
                        ticks: {
                            stepSize: 20
                        }
                    },
                },
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1000,
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
                
            }
            
            if(tempGraph)
                tempGraph.destroy()

            tempGraph = new Chart($('#bar-chart'), {
                type: 'bar',
                data: data,
                options: option
            })
        }
    })
}

// Function to catch chart content click event
$('.drop-down-icon').click(function() {
    if($('.avg-chart-content-date').css('display') == 'block')
        $('.avg-chart-content-date').css('display', 'none')
    else 
        $('.avg-chart-content-date').css('display', 'block')
})

var contentList = Array.from($('.avg-chart-content-date li'))
contentList.forEach(content => {
    content.onclick = function() {
        if (content.innerHTML === 'Today')
        {
            loadChart(0);
        }
        else if (content.innerHTML === 'Yesterday')
        {
            loadChart(1)
        } 
        else
        {
            loadChart(7)
        }
        $('.avg-chart-content-date').css('display', 'none')
    }
});


 