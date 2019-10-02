$('[data-type=checkbox]').on('change',function(){
    $(this).trigger('init-input');

    if( $(this).is(':checked')){
        $(this).addClass("input_valide");
    } else if( $(this).attr('data-obliger')) {
        $(this).addClass('input_erreur');
    }
});