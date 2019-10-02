import {initialisation} from "../tools/init";
import {insertErreur} from "../tools/insertErreur";
import {getMessage} from "../tools/getMessage";
import {foundDatalistOption} from "../input/datalist";

let PATH_DATALIST = '/t-dataliste_';

$(document).on('input','input[id*=liste-]',function ()  {
    let $input = $(this);
    let name = $input.attr('name');
    let page = $input.data('page');
    let message = $input.data('message');
    let $list = $('#' + name);
    let search = $('#liste-' + name).val();

    initialisation($input);

    if(search === "") {
        $list.html('');
        $('input[name=id_' + name + ']').val('').trigger('changeDatalist');
        return;
    }

    if(foundDatalistOption(name, search) === false && search !== "") {
        $.post(PATH_DATALIST + page, {search:search, name: name}, function(data){
            if(data.message !== ""){
                insertErreur($input, getMessage('dataList', message, data.message));
                return;
            }

            $('#liste-' + name).removeAttr('autocomplete');
            if(data.datalist !== '') {
                $('#' + name).html(data.datalist);
            } else {
                $('#empty').html(data.empty);
            }

            getDatalistOption(name, search);
        }, 'json');

        return;
    }

    getDatalistOption(name, search);
});

$(document).on('click', 'button[data-action=datalist_reset]', function(e){
    e.preventDefault();
    let input = $(this).closest('label');

    input.find('input[type=hidden]').val('');
    input.find('datalist').html('');
    input.find('input[type=text]').removeClass('input_valide input_erreur').val('').trigger('resetDatalist');
});

function getDatalistOption (name, search) {
    let idOption = false;
    let $datalist = $('#' + name);
    let $inputHiden = $('input[name=id_' + name + ']');

    $datalist.find('option').each( function(){
        let valOption = $(this).val();
        if(valOption.toLowerCase() === search.toLowerCase()) {
            idOption = $(this).data('id_' + name);
        }
    });

    if(idOption !== false) {
        $inputHiden.val(idOption).trigger('changeDatalist');
        return idOption;
    }

    $inputHiden.val('');
    return idOption;
}