import {regexList} from "../../config/js/regex";

import {defineParamInput} from "./defineParamInput";
import {initialisation} from "./init";
import {verifDatalist} from "../input/datalist";
import {verifByType} from "./verifByType";
import {resultVerif} from "./resultVerif";
import {exec_custom_test} from "./exec_custom_test";

let multiInput = ['date', 'heure'];
let paternInput = ['iban', 'site', 'tel', 'colorpicker', 'mail'];

export function verifInput(champ, event){
    let prefixe;
    let input = defineParamInput(champ);
    let regex = new RegExp(regexList[input.type]);

    if (input.type === 'datalist') {
        verifDatalist(input);
        return;
    }

    initialisation(input);

    if (input.obliger !== '1' && input.value === "" && multiInput.indexOf(input.type) === -1) {input.$champ.trigger('empty'); return false;}

    if(input.value === "" && input.obliger === "1") {
        prefixe = 'empty';
    }

    if (prefixe === undefined && !regex.test(input.value)) {
        prefixe = (event !== 'focusout' && paternInput.indexOf(input.type) !== -1)? false : "";
    }

    if(prefixe === undefined) {
        prefixe = verifByType(input, event);
    }

    if(prefixe === undefined && input.custom !== undefined) {
        prefixe = exec_custom_test(input);
    }

    resultVerif(input, prefixe)
}
