

$(document).ready(function(){
    $('input.timepicker').timepicker({
        timeFormat: 'HH:mm:ss',
        interval: 10,
        minTime: '7',
        maxTime: '6:00pm',
        startTime: '10:00',
        dynamic: true,
        dropdown: true,
        scrollbar: true
    });
});
