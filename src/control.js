$('.drop-icon').click(function() {
    console.log(1)
    if($('.user .user-setting').css('display') == 'block')
    {
        $('.user .user-setting').css('display', 'none');
    }
    else
    {
        $('.user .user-setting').css('display', 'block');
    }
})


$('.menu-toggle-icon').click(function(e) {
    if($('.toggle-all').css('display') == 'block')
    {
        $('.toggle-all').css('display', 'none');
    }
    else
    {
        $('.toggle-all').css('display', 'block');
    }
})


$('.drop-down-icon').click(function() {
    if($('.avg-chart-content-date').css('display') == 'block')
    {
        $('.avg-chart-content-date').css('display', 'none');
    }
    else
    {
        $('.avg-chart-content-date').css('display', 'block')
    }
})

$(document).mouseup(function(e) 
{
    var toggleContainer = $(".toggle-all");
    var userContainer = $('.user .user-setting');
    var chartContainer = $('.avg-chart-content-date')
    
    var menuChart = $('.drop-down-icon');
    var menuIcon = $('.menu-toggle-icon');
    var userIcon = $('.drop-icon');

    if (!menuIcon.is(e.target)) 
    {
        if (toggleContainer.css('display') == 'block')
        {
            toggleContainer.css('display', 'none');
        }
        else 
            toggleContainer.css('display', 'none');
    } 
    if (!userIcon.is(e.target)) 
    {
        if(userContainer.css('display') == 'block')
        {
            userContainer.css('display', 'none');
        }
        else
            userContainer.css('display', 'none');
    }
    if (!menuChart.is(e.target)) 
    {
        if(chartContainer.css('display') == 'block')
        {
            chartContainer.css('display', 'none');
        }
        else
            chartContainer.css('display', 'none');
    }
});

$('#switch-time-btn').click(function() {
    var checkTimeState = $('#switch-time-btn').prop('checked');
    if (checkTimeState === true)
    {
        $('#switch-time-btn + .slider').css('--col', 'rgb(76, 228, 76)');
    }
    else
    {
        $('#switch-time-btn + .slider').css('--col', 'red')
    }
    localStorage.setItem('timeState', checkTimeState);
})

$('#switch-para-btn').click(function() {
    var checkParaState = $('#switch-para-btn').prop('checked');
    if (checkParaState === true)
    {
        $('#switch-para-btn + .slider').css('--col', 'rgb(76, 228, 76)');
    }
    else
    {
        $('#switch-para-btn + .slider').css('--col', 'red');
    }
    localStorage.setItem('paraState', checkParaState);
})

$('#toggle-on-all').click(function() {
    if($('#switch-para-btn').prop('checked') === false)
    {
        $('#switch-para-btn').prop('checked', true);
        $('#switch-para-btn + .slider').css('--col', 'rgb(76, 228, 76)');
        localStorage.setItem('timeState', true);
    }
    if($('#switch-time-btn').prop('checked') === false)
    {
        $('#switch-time-btn').prop('checked', true);
        $('#switch-time-btn + .slider').css('--col', 'rgb(76, 228, 76)');
        localStorage.setItem('paraState', true);
    }
})

$('#toggle-off-all').click(function() {
    if($('#switch-para-btn').prop('checked') === true)
    {
        $('#switch-para-btn').prop('checked', false);
        $('#switch-para-btn + .slider').css('--col', 'red');
        localStorage.setItem('timeState', false);
    }
    if($('#switch-time-btn').prop('checked') === true)
    {
        $('#switch-time-btn').prop('checked', false);
        $('#switch-time-btn + .slider').css('--col', 'red');
        localStorage.setItem('paraState', false);
    }
})