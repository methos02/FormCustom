import {validate} from "../tools/validate";
import {insertErreur} from "../tools/insertErreur";
import {getMessage} from "../tools/getMessage";

export function verifDatalist(input){
    let prefix;

    if(input.value === "" && input.obliger === "1"){
        prefix = 'empty';
    }

    if (input.value === "" && !foundDatalistOption (input.$champ, input.value)) {
        prefix = 'unfound';
    }

    if(prefix !== undefined) {
        insertErreur(input.champ, getMessage(input, prefix));
        return;
    }

    validate(input);
}

export function foundDatalistOption (name, value) {
    let found = false;
    let $datalist = $('#' + name);

    $datalist.find('option').each( function(){
        let valOption = $(this).val();

        if(valOption.toLowerCase().indexOf(value.toLowerCase()) !== -1) {
            found = true;
        }
    });

    return found;
}