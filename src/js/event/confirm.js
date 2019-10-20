$(document).on('click', '[data-confirm]', function(e){
    e.preventDefault();
    let confirm = $(this).data('confirm');
    let div_parent = $(this).closest('[data-div_confirm]');

    div_parent.hide();
    div_parent.siblings('[data-div_confirm]').show();
});