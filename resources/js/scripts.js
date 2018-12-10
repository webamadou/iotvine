/*
* @author Amadou Ba - webamadou.com
* a bunch of custom js script
* */
require('jquery-countdown');//We use the countdown library to display the remainning time for each contest
//On each element with the class .contest-countdown we apply the countdown library
$('.contest-countdown').each(function(){
    let end_date = $(this).data('end-date');//Each div element has an attribute end-date that is the end of the timer
    $(this).countdown(end_date, function(event) {
        $(this).html(event.strftime('%w weeks %d days %H:%M:%S'));
    });
});
/*$('#getting-started').countdown('2015/01/01', function(event) {
    $(this).html(event.strftime('%w weeks %d days %H:%M:%S'));
});*/
/*
On second page of update/create contest the click on a network will display the corresponding entries
 */
$('body').on('click', '.networks-wrapper', function(e){
    let target = $(this).data('target');
    $('.list-entries').removeClass('active');
    $(`#${target}`).addClass('active');
});
/*
    When a class entry-link is clicked we display the form to add a new entry
*/
$('body').on('click','.entry-link, .edit-entry',function(e){
    e.preventDefault();
    let entry_id    = $(this).data('id');//We get the entry id from the div attributes
    let entry_name  = $(this).html();

    let entry_link  = $(`input[name="entry_${entry_id}_link"]`).val();
    entry_link      = entry_link===undefined?'':entry_link;
    //let configs     = $(`input[name="entry_${entry_id}_config"]`).val();
    let point_per_entry = $(`input[name="entry_${entry_id}_point_per_entry"]`).val();
    let description = $(`input[name="entry_${entry_id}_description"]`).val();
    console.log(entry_link,point_per_entry,description);
    $(`#fields-wrapper textarea[name="description"]`).val(description);
    $(`#fields-wrapper input[name="point_per_entry"]`).val(point_per_entry);
    /*The field entry link is the only field that changes on the entry form.
    It is depending on the value of the entry_name. We save that value in the variable entry_field.
    */
    let entry_field = `<div class="col-xs-12"><div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">${entry_name}</span>
                        </div>
                        <input type="hidden" value="${entry_id}" id="entry_id" name="entry_id" value="${entry_link}">
                        <input type="text" class="form-control" name="entry_link" id="entry_link" placeholder="Add ${{entry_name}}" value="${entry_link}">
                    </div></div>`;
    $('#entry-link').html(entry_field);
    $('#entries-form').addClass('active');//We add the class active to the div entries-form to display the hidden form
});

$('body').on('click','.save-entry', function(e){
    e.preventDefault();
    if($(`#fields-wrapper input[name="entry_link"]`).val() !== ''){
        let entry_link  = $(`#fields-wrapper input[name="entry_link"]`).val();
        let entry_id    = $(`#fields-wrapper input[name="entry_id"]`).val();
        let configs     = $(`#fields-wrapper textarea[name="configs"]`).val();
        let description     = $(`#fields-wrapper textarea[name="description"]`).val();
        let point_per_entry = $(`#fields-wrapper input[name="point_per_entry"]`).val();
        let entry_line  = `<input type="hidden" name="entry[]" value="${entry_id}">
                            <input type="hidden" name="entry_${entry_id}_link" value="${entry_link}">
                            <input type="hidden" name="entry_${entry_id}_description" value="${description}">
                            <input type="hidden" name="entry_${entry_id}_point_per_entry" value="${point_per_entry}">
                            <input type="hidden" name="entry_${entry_id}_config" value="${configs}">
                            <div class="col-lg-1 col-sm-1 col-xs-12"><i class="fa fa-"></i></div>
                            <div class="col-lg-9 col-sm-9 col-xs-12">${entry_link}</div>
                            <div class="col-lg-1 col-sm-1 col-xs-12 edit-entry" data-id="${entry_id}"><i class="fa fa-pencil"></i></div>
                            <div class="col-lg-1 col-sm-1 col-xs-12 remove-entry" data-id="${entry_id}"><i class="fa fa-times"></i></div>`;
        $(`.entry-lines #entry_${entry_id}`).remove();//We remove to avoid duplications
        $(`.entry-lines`).append(`<div class="entry-line row" id="entry_${entry_id}"></div>`);
        $(`#entry_${entry_id}`).html(entry_line);
        $('#entries-form').removeClass('active');
        $('.list-entries').removeClass('active');
    }
});

//$('body').on('click','.remove-entry',function(e){alert('youpi')})
$('body').on('click','.remove-entry',function (e) {
    e.preventDefault();
    let entry_id = $(this).data('id');
    $(`#entry_${entry_id}`).fadeOut(400).remove();
});
//A click on the button 'abort-saving' of the entry form will hide the form
$('body').on('click','.abort-saving',function (e) {
    e.preventDefault();
    $('.list-entries').removeClass('active');
    $('#entries-form').removeClass('active');
});
/*
On the page three of create/iupdate contest we can add a prize without leaving the page
*/
