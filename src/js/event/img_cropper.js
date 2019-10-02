import Cropper from 'cropperjs/dist/cropper';

let cropper;

$(document).on('cropper', 'input[data-cropper]', function(){
    let input = this;
    if (input.files[0] === undefined) { return; }

    let reader = new FileReader();
    /**
     * @param {string} e.target.result source de l'image
     */
    reader.onload = function (e) {
        $('#img-retouche').attr('src', e.target.result);
        init_jcropp($(input));
    };

    reader.readAsDataURL(input.files[0]);

    $('#Modal-resize').trigger('modal-open');
    $('[data-cropper=btn]').toggle();
    $(this).trigger('init-cropper');
});

//init jCropper
function init_jcropp ($input){
    if(cropper instanceof Cropper) {cropper.destroy();}
    let image = document.getElementById('img-retouche');

    cropper = new Cropper (image, {
        aspectRatio: getRatio($input),
        cropBoxMovable: false,
        cropBoxResizable: false,
        preview: $('[data-preview]'),
        center: false,
        guides: false,
        viewMode: 1,
        minContainerHeight: getCropperHeight(),
        dragMode: 'move',
        ready() {save_cropp_param()},
        crop() {save_cropp_param()}
    });
}

//calcul de la hauteur crop: screen - h form - h modal header - margin
function getCropperHeight() {
    return $(window).height() - 44 - 83 - 90;
}

function getRatio($input) {
    return $input.is('[data-ratio]')? eval($input.data('ratio')): NaN;
}

function save_cropp_param () {
    let param_cropper = cropper.getData();

    $('input[name=x]').val(param_cropper.x);
    $('input[name=y]').val(param_cropper.y);
    $('input[name=width]').val(param_cropper.width);
    $('input[name=height]').val(param_cropper.height);
}

//Zoom - Dezoom
$(document).on('click', 'button[data-method=zoom]', function(e){
    e.preventDefault();
    let ratio = Number($(this).attr('data-option'));
    cropper.zoom(ratio);
});

//affichage modif
$(document).on('click', '[data-crop=save]', function(e){
    e.preventDefault();
    $('#Modal-resize').trigger('modal-close');
});

//modifier le croppage
$(document).on('click', '[data-crop=modif]', function (e){
    e.preventDefault();
    $('#Modal-resize').trigger('modal-open');
});

//annuler croppage
$(document).on('click', '[data-crop=cancel]', function(e){
    e.preventDefault();
    let div_crop = $('.img-cropper');
    init_modal();
    $('[data-cropper=btn]').toggle();
    cropper.destroy();
    div_crop.find('input[type=hidden]').val('');
    div_crop.find('input[data-cropper]').trigger('init-input').trigger('reset-cropper');
});

function init_modal() {
    $('#Modal-resize').trigger('modal-close');
    setTimeout(function () {$('#img-retouche').attr('src', '/images/loader.gif');}, 100);
}