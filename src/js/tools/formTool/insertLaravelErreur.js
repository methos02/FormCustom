import {FormCustom} from "../../global_function";

export function insertLaravelErreur(erreurs) {

    $.each(erreurs.errors, function(name, erreur) {
        let $input = $('[name=' + name + ']');

        if($input.length === 0) return false;

        let input = FormCustom.defineParamInput($input);
        FormCustom.insertErreur(input, erreur);
    });
}