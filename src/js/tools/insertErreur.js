export function insertErreur(input, message){
    let elem_statut = input.type === 'multiselect' ? input.border : input.$champ;
    elem_statut.attr('data-statut','erreur');

    input.border.addClass('input_erreur');
    input.$champ.trigger('custom_erreur');

    if(message !== undefined && message !== ""){
        input.message.append('<span class="input_message" data-message="erreur">' + message + '</span>');
        input.message.find('.label-input').hide();
        console.log(message);
    }
}
