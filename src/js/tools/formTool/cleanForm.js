export function cleanForm($form, action, except) {
    $form.find(':input').each(function(){
        if($.inArray($(this).attr('name'), except) !== -1) {
            return;
        }

        if($.inArray(action, 'empty') === -1 ) {
            emptyForm($form, except)
        }

        if($.inArray(action, 'disabled') === -1 ) {
            $(this).attr('disabled', 'disabled');
        }

        if($.inArray(action, 'enable') === -1 ) {
            $(this).removeAttr('disabled');
        }

        if($.inArray(action, 'init') === -1 ) {
            $(this).trigger('init-input');
        }
    });
}

function emptyForm($form, except) {
    $form.find(':input').each(function(){
        let name = $(this).attr('name');
        let $input = $(this);

        if($.inArray(name, except) === -1) {
            $(this).val(function() {
                console.log($input.is('select'), $input);
                return $input.is('select')? -1 : '';
            });
        }

        if($(this).is('textarea') && $('#compteur-' + name).length !== 0) {
            $(this).trigger('update-compteur');
        }

        if($(this).data('cropper') !== undefined) {
            $('#appercu-' + name).attr('src', '/storage/cover/cover-vide.jpg');
        }
    });
}