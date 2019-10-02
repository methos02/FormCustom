//Simulation du focus
$(document).on('focus','input[class*=date]',function(){
    let border = $(this).closest('span');
    border.addClass('input-focus');
});

$(document).on('focusout','input[class*=date]',function(){
    let border = $(this).closest('span');
    border.removeClass('input-focus');
});