$(document).on('click','button[data-file]:not([disabled]), .label-file', function(e){
    if(!$(e.target).is('input[type=file]')) {e.preventDefault();}
    if(!$(e.target).is('button') && !$(e.target).is('input[type=file]') && !$(e.target).is('span[class*=glyphicon]')){return;}

    let $input =  $(this).closest('.file-compact');
    let name = $(this).attr("data-file");
    let type = $input.find('video').length !== 0 ? 'video' : 'img';

    init($input);

    if(type === 'img') {
        $input.find('[data-input]').attr('src', '');
    }

    if(type === 'video') {
        if(document.querySelector('video[data-preview]') !== null){document.querySelector('video[data-preview]').pause();}
        document.querySelector('video[data-input]').pause();
        $input.find('[data-input] img').attr('src', '');
    }

    $input.find('input[type=file][name= ' + name + ']').trigger('click');
});

function init($input) {
    $input.find('[data-preview]').show();
    $input.find('[data-input]').hide();
    $input.find('[data-fileName]').html(' Aucun Fichier ');
    $input.find('input').val('');
}
