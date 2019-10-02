if(typeof CKEDITOR !== 'undefined') {
    let input = $('[data-ckeditor]');
    let name = input.attr('id');

    CKEDITOR.instances[name].on('change', function(){
        CKEDITOR.instances[name].updateElement();
        input.trigger('input');
    });
}