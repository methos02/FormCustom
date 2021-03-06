import {validateFile} from "../input/file";

export function validate (input) {
    let elem_statut = input.type === 'multiselect' ? input.border : input.$champ;
    elem_statut.attr('data-statut','valide');

    if (input.type === 'file') {validateFile(input); return;}
    input.border.addClass('input_valide');
    input.$champ.trigger('custom_valide');
}
