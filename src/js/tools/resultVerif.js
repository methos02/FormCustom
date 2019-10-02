import {getMessage} from "./getMessage";
import {insertErreur} from "./insertErreur";
import {validate} from "./validate";

export function resultVerif(input, prefixe){
    if(prefixe !== undefined) {
        let message = getMessage(input, prefixe);
        insertErreur(input, message);
        return false;
    }

    validate(input);
}