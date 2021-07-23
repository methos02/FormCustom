export function verifDate(input, event){
    //Verification que la value est bien numéric
    if (!isNumb(input.value) && input.value !== "") { return ""}

    //Vérification de l'input
    if (input.jour !== "" && verifJour(input.jour)) { return 'jour';}
    if (input.mois !== "" && verifMois(input.mois)) { return 'mois';}

    //verification que l'un des input du champ ne contient pas des carractères invalide
    if ((!isNumb(input.jour) && input.jour !== "") || (!isNumb(input.mois) && input.mois !== "") || (!isNumb(input.annee) && input.annee !== "")) { return ""; }

    //fin de la fonction si tous les champs ne sont pas rempli
    if (input.jour === "" && input.mois === "" && input.annee === "" && input.obliger === "1" && event === "submit") { return 'empty';}
    if (input.jour === "" && input.mois === "" && input.annee === "" && input.obliger !== "1") { return false; }
    if (input.jour.length !== 2 || input.mois.length !== 2 || input.annee.length !== 4) { return false; }

    if (verifDateCoherence(input.jour, input.mois, input.annee) === false) { return 'coherence'; }

    if(input.date_type !== undefined){
        if(input.date_type === 'futur' && verifDateFutur(input.jour, input.mois, input.annee) === false){ return 'futur'; }
        if(input.date_type === 'scolaire' && verifDateScolaire(input.mois, input.annee) === false){ return 'scolaire'; }
        if(input.date_type === 'passe' && verifDatePasse(input.jour, input.mois, input.annee) === false){ return 'passe'; }
    }
}

export function dateParam(input) {
    input.div = input.$champ.closest('label');
    input.name = input.div.data('nom');
    input.date_type = input.div.data('date_type');
    input.border = input.$champ.closest('label');
    input.obliger = input.div.data('obliger');

    input.jour = input.div.find('input[name = jour_' + input.name + ']').val();
    input.mois = input.div.find('input[name = mois_' + input.name + ']').val();
    input.annee = input.div.find('input[name = annee_' + input.name + ']').val();

    return input;
}

export function initDate(input) {
    input.div.removeClass('input_valide input_erreur');
}

function verifJour(jour){
    return ((jour > 31 || jour < 1) && jour.length === 2);
}

function verifMois(mois){
    return ((mois > 12 || mois < 1) && mois.length === 2);
}

function verifDateCoherence(jour,mois,annee){
    /* Définition du nombre de jours max dans le moi */
    let max_day;

    switch (mois) {
        case '02':
            if (annee % 4 === 0) {
                max_day = (annee % 1000) ? 29 : 30;
            }
            else
                max_day = 28;
            break;

        case '01':
        case '03':
        case '05':
        case '07':
        case '08':
        case '10':
        case '12':
            max_day = 31;
            break;

        case '04':
        case '06':
        case '09':
        case '11':
            max_day = 30;
            break;
    }

    /* Cohérence du jour par rapport au mois */
    if ( jour > max_day || jour === "") {
        return false;
    }
}

function verifDateFutur(jour, mois, annee){
    let d = new Date();

    if(parseInt(annee) < d.getFullYear()){ return false }

    if(parseInt(mois) < d.getMonth()+1 && parseInt(annee) === d.getFullYear()){ return false }

    if(parseInt(jour) < d.getDate() && parseInt(mois) === d.getMonth() +1 && parseInt(annee) === d.getFullYear()){ return false }
}

function verifDateScolaire(mois, annee){
    let annee_valide = anneeValide();

    if (annee_valide[0] !== parseInt(annee) && annee_valide[1] !== parseInt(annee)){ return false; }
    /* Vérification que le mois se situe entre  09/ 1er année et 08/ 2nd année */
    else if((parseInt(mois) < 9 && parseInt(annee) === annee_valide[0]) || (parseInt(mois) > 8 && parseInt(annee) === annee_valide[1])){ return false; }

    return true;
}

function verifDatePasse(jour, mois, annee){
    let d = new Date();

    if(parseInt(annee) > d.getFullYear()){ return false; }
    else if(parseInt(mois) > d.getMonth()+1 && parseInt(annee) === d.getFullYear()){ return false; }
    else if(parseInt(jour) > d.getDate()+1 && parseInt(mois) === d.getMonth() +1 && parseInt(annee) === d.getFullYear()){ return false; }

    return true;
}

function anneeValide(){
    let anneeValide = $('form').attr('data-saison');

    if(anneeValide !== undefined){
        return anneeValide.split('-');
    }

    let d = new Date();
    let annee = d.getFullYear();
    let mois = d.getMonth()+1;

    if(mois >= 9){
        return [annee, annee+1];
    }

    return [annee-1, annee];
}

function isNumb( val ) {
    return !isNaN(parseInt(val))
}
