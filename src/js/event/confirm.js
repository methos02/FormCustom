$(document).on('click', 'input[data-confirm=true]', function(e){
    e.preventDefault();
    $(this).hide();
    $(this).siblings('[data-confirm]').show();
});

$(document).on('click', 'input[data-confirm=false]', function(e){
    e.preventDefault();
    let span = $(this).closest('span[data-confirm]');
    span.hide();
    span.siblings('[data-confirm]').show();
});