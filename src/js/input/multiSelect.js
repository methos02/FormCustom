export function verifMultiSelect(input) {
    if(input.obliger === 1 && input.values.length === 0) {
        return 'empty';
    }
}

export function multiSelectParam(input) {
    input.div = input.$champ.closest('[data-input]');
    input.border = input.$champ.closest('[data-input]');
    input.obliger = input.div.data('obliger');
    input.erreur = input.div.data('message');
    input.message = input.$champ.closest('[data-input]');
    input.checkboxs = input.border.find('input[type=checkbox]');

    input.values = getValues(input);

    return input;
}

function getValues(input) {
    let $inputs = input.div.find(':checked');
    let values = [];

    $.each($inputs, function(key, item){
        values.push($(item).val());
    });

    return values;
}
