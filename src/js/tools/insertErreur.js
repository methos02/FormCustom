export function insertErreur(input, message){
    input.border.attr('data-statut','erreur');
    input.border.addClass('input_erreur');
    input.border.trigger('custom_erreur');
    input.border[0].dispatchEvent(new Event("custom_erreur"));

    // if(message === undefined || message === "") {
    //     console.log("Erreur avec l'input : " + input.name);
    // }

    if(message !== undefined && message !== ""){
        input.message.append('<span class="input_message" data-message="erreur">' + message + '</span>');
        input.message.find('.label-input').hide();
        // console.log(message);
    }
}
