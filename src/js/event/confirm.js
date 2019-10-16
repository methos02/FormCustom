$(document).on('click', 'button[data-confirm]', function(e){
    e.preventDefault();
    let confirm = $(this).data('confirm');
    let div_parent = $(this).closest('div[data-confirm=' + confirm + ']');

    div_parent.hide();
    div_parent.siblings('div[data-confirm=' + confirm + ']').show();
});