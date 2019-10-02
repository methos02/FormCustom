$(document).on('keyup','input[data-type=date], input[data-type=heure]',function(e){
    let input = $(this).closest('span[class*=border-]');
    let value = $(this).val();
    let name = $(this).attr('name');

    // Obliger les nombres
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        return;
    }

    //switch auto
    if($(this).hasClass('date-jm') && value.length >= 2){
        if(name.indexOf('jour') !== -1){
            $(input).find('input[name*=mois]').focus();
        } else {
            $(input).find('input[name*=annee]').focus();
        }
    } else if(name.indexOf('heure') !== -1 && value.length === 2) {
        $(input).find('input[name*=minute]').focus();
    }
});