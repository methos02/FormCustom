$(document).on('keydown','input[data-type=date], input[data-type=heure]',function(e){
    let input = $(this).closest('label');
    let value = $(this).val();
    let name = $(this).attr('name');

    //revenir a l'input précédent en cas de leftMove
    if(e.keyCode === 8 && value.length === 0) {
        if(name.indexOf('annee') !== -1) {
            leftMove(input, 'mois');
        } else if(name.indexOf('mois') !== -1) {
            leftMove(input, 'jour');
        } else if(name.indexOf('minute') !== -1) {
            leftMove(input, 'heure');
        }
        e.preventDefault();
    }

    //Changer d'input avec les fleche
    if(value.slice(0, this.selectionStart).length === 2 && e.keyCode === 39){
        if(name.indexOf('jour') !== -1) {
            rightMove(input, 'mois');
        } else if(name.indexOf('mois') !== -1) {
            rightMove(input, 'annee');
        } else if(name.indexOf('heure') !== -1) {
            rightMove(input, 'minute');
        }
        e.preventDefault();

    }

    if(value.slice(0, this.selectionStart).length === 0 && e.keyCode === 37){
        if(name.indexOf('annee') !== -1) {
            leftMove(input, 'mois');
        } else if(name.indexOf('mois') !== -1) {
            leftMove(input, 'jour');
        } else if(name.indexOf('minute') !== -1) {
            leftMove(input, 'heure');
        }
        e.preventDefault();
    }

    //auto completion
    if(e.keyCode === 9 && value.length === 1){
        $(this).val('0' + value);
    }

    // Allow: leftMove, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        // Allow: Ctrl+A
        (e.keyCode === 65 && e.ctrlKey === true) ||
        // Allow: Ctrl+C
        (e.keyCode === 67 && e.ctrlKey === true) ||
        // Allow: Ctrl+X
        (e.keyCode === 88 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
        // let it happen, don't do anything
        return;
    }

    // Ensure that it is a number and stop the keypress
    if ((!e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});

$(document).on('keyup','input[data-type=date], input[data-type=heure]',function(e){
    let input = $(this).closest('label');
    let value = $(this).val();
    let name = $(this).attr('name');

    if(value.length === 2 && ((e.keyCode > 48 && e.keyCode < 57) || (e.keyCode > 96 && e.keyCode < 105))){
        if(name.indexOf('jour') !== -1) {
            rightMove(input, 'mois');
        } else if(name.indexOf('mois') !== -1) {
            rightMove(input, 'annee');
        } else if(name.indexOf('heure') !== -1) {
            rightMove(input, 'minute');
        }
    }
});

function leftMove(gen_input,name) {
    let prec_input = $(gen_input).find('input[name*=' + name +']');
    let value = prec_input.val();

    prec_input.focus().val(value);
}

function rightMove(gen_input,name) {
    let prec_input = $(gen_input).find('input[name*=' + name +']');
    prec_input.focus();
}
