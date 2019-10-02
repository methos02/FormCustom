import {initTextarea} from "../input/textarea";
import {initFile} from "../input/file";
import {initHeure} from "../input/heure";
import {initDate} from "../input/date";
import {defineParamInput} from "./defineParamInput";

export function initialisation(input){
    input.border.removeClass('input_valide input_erreur');
    input.$champ.removeAttr('data-statut');

    if(!input.$champ.is('[data-cropper]')) {
        input.div.find('.label-input').show();
    }

    input.div.find('.input_message').remove();

    if (input.type === 'texte') {initTextarea(input.champ)}
    if (input.type === 'file') {initFile(input)}
    if (input.type === 'heure') {initHeure(input)}
    if (input.type === 'date') {initDate(input)}
}

export function external_init(input) {
    let $input = defineParamInput(input);
    initialisation($input);
}
