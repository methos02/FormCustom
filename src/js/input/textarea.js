export function verifTexte(input){
    let max = $('#compteur-' + input.name ).find('[data-part=max]').html();

    if(max !== undefined && input.value.length > max){
        return 'length';
    }
}

export function textParam(input) {
    let cke = $('#cke_' + input.name);

    input.border = cke.length !== 0 ? cke: input.border;
    input.message  = cke.length !== 0 ? cke.find('[id*=_contents]'): input.div;

    return input;
}

export function initTextarea(input) {
    $('#cke_' + input.name).find('.message-cke').remove();
}