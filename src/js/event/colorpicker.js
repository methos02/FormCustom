import Picker from 'vanilla-picker';
import {regexList} from "../../config/js/regex";

let els = document.querySelectorAll('[data-action=color_picker]');
let pickers = [];
let open = true;

$(document).on('click', '[data-action=color_picker]', function(e){
    e.preventDefault();
});

els.forEach(function(el){
    pickers.push(new Picker({
        alpha: false,
        parent:el,
        onChange(color) {
            if(open === false) {
                let btn = $(this.domElement).closest('[data-action=color_picker]');
                let input = btn.siblings('input[data-type]');

                btn.css('background-color', color.rgbaString);

                input.val(shortColor(color));
                input.trigger('input');
            }
        },

        onOpen(color) {
            let input = $(this.domElement).closest('[data-action=color_picker]').siblings('input[data-type=colorpicker]');
            let newColor = input.val();
            let regex = new RegExp(regexList['colorpicker']);
            open = false;

            if(regex.test(newColor)) {
                this.setColor(newColor);
                return;
            }

            input.val(shortColor(color));
            changeBtnColor($(input), shortColor(color));
            input.trigger('input');
        },

        onClose() {
            open = true;
        }
    }));
});

$(document).on('keyup', '[data-type="colorpicker"]', function(){
    let color = $(this).hasClass('input_valide')? $(this).val(): '';
    changeBtnColor($(this), color);
});

$(document).on('focusout','[data-type="colorpicker"]', function(){
    let c = $(this).val();

    if($(this).hasClass('input_valide') && c.length === 4) {
        let newColor = '#' + c.charAt(1) + c.charAt(1) + c.charAt(2) + c.charAt(2) + c.charAt(3) + c.charAt(3);
        $(this).val(newColor);
    }
});

function shortColor(color) {
    return color.hex.substring(0,7);
}

function changeBtnColor ($input, color) {
    let btn = $input.siblings('[data-action=color_picker]');
    btn.css('background-color', color);
}