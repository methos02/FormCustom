import {tests} from "formcustom/js/custom_test";
import {msgErreur} from "formcustom/js/message";

export function exec_custom_test(input) {
    if(tests[input.custom].test(input) === false) {
        msgErreur[input.type][input.custom + '_' + input.erreur] = tests[input.custom].message;
        return input.custom;
    }
}
