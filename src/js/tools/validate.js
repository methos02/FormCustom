import {validateFile} from "../input/file";

export function validate (input) {
    input.border.attr('data-statut','valide');

    if (input.type === 'file') {validateFile(input); return;}
    input.border.addClass('input_valide');
    input.border.trigger('custom_valide');
    input.border[0].dispatchEvent(new Event("custom_valide"));
}
