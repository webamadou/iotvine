/*
* @author Amadou Ba - webamadou.com
* abunch of cutom js script
* */
require('jquery-countdown');
$('.contest-countdown').each(function(){
    let end_date = $(this).data('end-date')
    $(this).countdown(end_date, function(event) {
        $(this).html(event.strftime('%w weeks %d days %H:%M:%S'));
    });
    console.log(end_date);
});
/*$('#getting-started').countdown('2015/01/01', function(event) {
    $(this).html(event.strftime('%w weeks %d days %H:%M:%S'));
});*/
