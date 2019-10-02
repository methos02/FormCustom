import {verifDate} from "../input/date";
import {verifInputHeure} from "../input/heure";
import {verifTexte} from "../input/textarea";
import {verifMdp} from "../input/mdp";
import {verifSelect} from "../input/select";
import {verifFile} from "../input/file";
import {verifMultiSelect} from "../input/multiSelect";

export function verifByType(input, event) {
    let erreur;

    if (input.type === 'date'){
        erreur = verifDate(input, event);
    }

    if (input.type === 'heure') {
        erreur = verifInputHeure(input, event);
    }

    if (input.type === 'texte') {
        erreur = verifTexte(input);
    }

    if (input.type === 'mdp') {
        erreur = verifMdp(input, event);
    }

    if (input.type === 'select') {
        erreur = verifSelect(input);
    }

    if (input.type === 'file') {
        erreur = verifFile(input);
    }

    if (input.type === 'multiselect') {
        erreur = verifMultiSelect(input);
    }

    return erreur;
}
