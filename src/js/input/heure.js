export function verifInputHeure(input, event){
    if (!$.isNumeric(input.value) && input.value !== "") {
        return "";
    }

    if((input.heure.length === 0 || input.minute.length === 0) && event === 'submit'){
        return 'empty';
    }

    if(input.obliger === "1" && input.heure.length === 0 && input.minute.length === 0  && event === 'submit') {
        return 'obliger';
    }

    //fin de la fonction si tous les champs ne sont pas rempli
    if (input.value.length !== 2) { return false; }

    if (input.name.indexOf('heure') !== -1 && verifHeure(input.value) === false) {
        return ""
    }

    if (input.name.indexOf('minute') !== -1 && verifMinute(input.value) === false) {
        return ""
    }
}

export function heureParam(input) {
    input.div = input.$champ.closest('label');
    input.name = input.div.data('nom');
    input.obliger = input.div.data('obliger');

    input.heure = $('input[name = heure_' + input.name + ']').val();
    input.minute = $('input[name = minute_' + input.name + ']').val();

    return input
}

export function initHeure (input) {
    input.div.removeClass('input_erreur input_valide');
}

function verifHeure(heure){
    if (isNaN(heure) === true || heure < 0 || heure > 23) { return false; }
}

function verifMinute(minute) {
    if (isNaN(minute) === true || minute < 0 || minute > 59) { return false; }
}
