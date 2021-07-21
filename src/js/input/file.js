import {fileType} from "../../../ressources/js/form-custom/fileType";
import {filesParam} from "../../../ressources/js/form-custom/filesParam";

let PATH_APPERCU = {'img' : '/img/empty_img.png', 'video': '/img/empty_video.png'};

export function verifFile(input){
    if (input.file === undefined && input.obliger === "1") {
        return 'empty';
    }

    if (input.file.size > input.param.size) {
        return 'size';
    }

    if (fileType[input.extention] === undefined) {
        return 'datatype';
    }

    if (fileType[input.extention].indexOf(input.file.type) === -1) {
        return 'type';
    }

    if (input.extention === "img" || input.extention === "photo" || input.extention === "webimg") {
        return verifImg(input);
    }
}

export function fileParam(input) {
    input.file = input.champ.files !== undefined ? input.champ.files[0] : undefined;
    input.fileName = input.div.find('[data-fileName]');
    input.option = input.$champ.data('option');
    input.extention = input.$champ.data('accept');
    input.param = getDefautFileParam(input.option);
    input.message = input.$champ.closest('.label-compact');
    input.div = input.$champ.closest('.label-compact');

    return input;
}

export function initFile(input) {
    input.fileName.html('Aucun fichier');
    input.div.find('[data-appercu]').attr('src', PATH_APPERCU.type);
}

export function validateFile(input) {
    input.fileName.html(input.file.name);

    if (input.$champ.data('cropper') !== undefined) {
        input.$champ.trigger('cropper'); return;
    }

    if (input.extention === "video" || input.extention === "webvideo") {
        validateVideo(input);
    }
}

function verifImg(input){
    let reader = new FileReader();
    let img = new Image;

    reader.onload = function (e) {
        img.src = e.target.result;
        img.onload = function() {
            let img_width = this.width;
            let img_height = this.height;

            if (img_width > input.param.widthMax || img_height > input.param.heightMax) {
                return "sizeMax";
            }

            if (img_width < input.param.widthMin || img_height < input.param.heightMin) {
                return "sizeMin";
            }

            if (input.param.forme === 'carre' && (img_width !== img_height)) {
                return "carre";
            }

            if (input.param.forme === 'cover' && (img_width !== (img_height * 8) / 5)) {
                return "cover";
            }

            if(input.$champ.is('[data-cropper]')) {return;}

            input.div.find('[data-input]').attr('src', e.target.result).show();
            input.div.find('[data-preview]').hide();
            input.div.find('[data-fileName]').html(input.file.name);
        }
    };

    reader.readAsDataURL(input.file);
}

function validateVideo(input){
    let input_preview =  input.div.find('video[data-input]');

    input.div.find('[data-preview]').hide();
    input_preview.addClass('input_valide').show();

    input_preview.attr({'src' : URL.createObjectURL(input.file), 'type' : input.file.type});
    document.querySelector('video[data-input]').load();

    input.div.find('[data-fileName]').html(input.file.name);
}

function getDefautFileParam (option) {
    if(option === undefined || filesParam[option] === undefined) {return filesParam.defaut;}
    return filesParam[option];
}
