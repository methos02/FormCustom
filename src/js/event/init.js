import {defineParamInput} from "../tools/defineParamInput";
import {initialisation} from "../tools/init";

$(document).on('init-input', ':input',function(){
    let input = defineParamInput(this);
    initialisation(input);
});