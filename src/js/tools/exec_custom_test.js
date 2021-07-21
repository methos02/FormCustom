import {tests} from "../../../ressources/js/form-custom/custom_test";
import {msgErreur} from "../../../ressources/js/form-custom/message";

export function exec_custom_test(input) {
    if(tests[input.custom].test(input) === false) {
        msgErreur[input.type][input.custom + '_' + input.erreur] = tests[input.custom].message;
        return input.custom;
    }
}
