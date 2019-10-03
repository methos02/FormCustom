/* Version 4.0 */
//import des modules
import '../css/formCustom.scss';
import '../img/empty_img.png';
import '../img/empty_video.png';
import {insertErreur} from "./tools/insertErreur";
import {getMessage} from "./tools/getMessage";
import {verifInput} from "./tools/verifInput";

/* ------------- */
/*  VERIF INPUT  */
/* ------------- */
$(document).on('input focusout','input[type=text][data-type], textarea[data-type], input[type=password][data-type]', function(e){
    verifInput(this, e.type);
});

$(document).on('change','[data-type=select], [data-type=file], [data-type=multiselect]',function(e){
    verifInput(this, e.type);
});

/* ------------ */
/*  VERIF FORM  */
/* ------------ */
$(document).on('click', 'button[data-verif], input[type=submit][data-verif], a[data-verif]', function (e){
    e.preventDefault();
    let name = $(this).data('verif');
    let form = $('form[name=' + name + ']');

    //verrification des adresses
    form.find('input[data-type=rue]').each(function() {
        let name = ($(this).attr('name').split('_'))[1];
        let inputs = form.find(':input[name=rue_' + name + '], :input[name=cp_' + name + '], :input[name=ville_' + name + ']');
        let inputs_valide = inputs.filter(function() { return $(this).hasClass('input_valide')});

        if((inputs_valide.length !== 3 && inputs_valide.length !== 0) || (inputs_valide.length !== 3 && form.find(':input[name=numbRue_' + name + ']').val() !== '')) {
            inputs.filter(function () {
                return $(this).val() === ''
            }).each(function(){
                let message = $(this).data('message');
                let type = $(this).data('type');

                insertErreur(this, getMessage(type, message, 'empty_'));
            });
        }
    });

    form.find('div[class*=cke_editor_]').each(function() {
        let name = $(this).attr('id').split('_')[1];
        CKEDITOR.instances[name].updateElement();
    });

    //faire le test des inputs non verifier
    form.find(':input[data-type]:not([type=hidden], [type=submit])').filter(function () {
        return noStatut(this) || statutMultiInput(this);
    }).each(function(){
        verifInput(this, 'submit');
    });

    if(form.find(':input[data-statut=erreur]').length === 0) {
        form.trigger('submit');
        return;
    }

    form.trigger('form_erreur');
});

function noStatut(input) { return $(input).data('type').indexOf('multi') === -1 && checkStatut(input);
}

function statutMultiInput(input) {
    return $(input).data('type').indexOf('multi') !== -1 && checkStatut($(input).closest('.label-compact'));
}

function checkStatut(input) {
    return ['valide', 'erreur'].indexOf($(input).data('statut')) === -1;
}

/* import des events */
import './event/keyDown';
import './event/keyUp';
import './event/checkbox';
import './event/ck_editor';
import './event/datalist';
import './event/file';
import './event/date_heure';
import './event/colorpicker';
import './event/img_cropper';
import './event/multi_select';
import './event/confirm';
import './event/uForm';
import './event/compteur';
import './event/init';
