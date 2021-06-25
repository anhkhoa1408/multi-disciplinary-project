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
    $.ajax({
        url: 'Server/user_toggle.php',
        type: 'POST',
        data: {
            type: "toggle_time",
            state: checkTimeState?1:0
        },
    });
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
    $.ajax({
        url: 'Server/user_toggle.php',
        type: 'POST',
        data: {
            type: "toggle_para",
            state: checkParaState?1:0
        },
    });
})

$('#toggle-on-all').click(function() {
    if($('#switch-para-btn').prop('checked') === false)
    {
        $('#switch-para-btn').prop('checked', true);
        $('#switch-para-btn + .slider').css('--col', 'rgb(76, 228, 76)');
        localStorage.setItem('paraState', true);
        $.ajax({
            url: 'Server/user_toggle.php',
            type: 'POST',
            data: {
                type: "toggle_para",
                state: 1
            },
        });
    }
    if($('#switch-time-btn').prop('checked') === false)
    {
        $('#switch-time-btn').prop('checked', true);
        $('#switch-time-btn + .slider').css('--col', 'rgb(76, 228, 76)');
        localStorage.setItem('timeState', true);
        $.ajax({
            url: 'Server/user_toggle.php',
            type: 'POST',
            data: {
                type: "toggle_time",
                state: 1
            },
        });
    }
})

$('#toggle-off-all').click(function() {
    if($('#switch-para-btn').prop('checked') === true)
    {
        $('#switch-para-btn').prop('checked', false);
        $('#switch-para-btn + .slider').css('--col', 'red');
        localStorage.setItem('paraState', false);
        $.ajax({
            url: 'Server/user_toggle.php',
            type: 'POST',
            data: {
                type: "toggle_para",
                state: 0
            },
        });
    }
    if($('#switch-time-btn').prop('checked') === true)
    {
        $('#switch-time-btn').prop('checked', false);
        $('#switch-time-btn + .slider').css('--col', 'red');
        localStorage.setItem('timeState', false);
        $.ajax({
            url: 'Server/user_toggle.php',
            type: 'POST',
            data: {
                type: "toggle_time",
                state: 0
            },
        });
    }
})


$('.nav-toggle').click(function() {
    var navToggle = document.querySelector('#nav-section');
    console.log(navToggle.classList)
    if (navToggle.classList.contains('close')) {
        navToggle.classList.remove('close')
        navToggle.classList.add('open')
    } else {
        navToggle.classList.remove('open')
        navToggle.classList.add('close')
    }
})