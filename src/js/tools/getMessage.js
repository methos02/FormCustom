import {msgErreur} from "formcustom/js/message";
import {fileType} from "formcustom/js/fileType";

export function getMessage(input, prefix) {
    if(prefix === false) {return "";}

    prefix = prefix === "" ? "" : prefix + "_";
    input.erreur = (input.erreur === undefined || msgErreur[input.type][prefix + input.erreur] === undefined)? "defaut" : input.erreur;

    let message = msgErreur[input.type][prefix + input.erreur];

    if(input.extention !== undefined && fileType[input.extention] !== undefined && prefix === 'type_') {
        message = message + fileType[input.extention].join(', ');
    }

    return message;
}
