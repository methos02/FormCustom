import {initialisation} from "../tools/init";
import {resultVerif} from "../tools/resultVerif";

export function verifMdp(input, event){
    let prefixe;

    if (input.value.length < 6 && input.obliger === "1") {
        prefixe = (event === "focusout" || event === "submit")? "length" : false;
    }

    if(input.mdp_2.length !== 0 && input.mdp_2.val().length !== 0 && input.mdp_2.data('statut') !== 'erreur'){
        verif2Mdp(input, event);
    }

    return prefixe;
}

function verif2Mdp(input, event){
    let prefixe;
    let input_2 = defineInput_2(input);
    let mdp1 = input.mdp_1.val();
    let mdp2 = input.mdp_2.val();

    initialisation(input_2);

    if (mdp1 !== mdp2) {
        prefixe = (event === "focusout" || event === "submit")? 'different': false;
    }

    resultVerif(input_2, prefixe);
}

export function mdpParam (input) {
    input.name = input.name.split('_')[0];

    input.mdp_1  = $('input[name = '+ input.name +']');
    input.mdp_2  = $('input[name = '+ input.name +'_confirmation]');
    input.isConfirm = input.mdp_2.attr('name') === input.$champ.attr('name');

    return input;
}

function defineInput_2(input) {
    return {
        $champ: input.mdp_2,
        border: input.mdp_2,
        div: input.mdp_2.closest('label'),
        erreur: input.mdp_2.attr('data-message'),
        type : input.mdp_2.data('type'),
        message: input.mdp_2.closest('label'),
    }
}