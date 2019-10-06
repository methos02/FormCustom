import {cleanForm} from "./tools/formTool/cleanForm";
import {resetFile} from "./tools/formTool/resetFile";
import {external_init} from "./tools/init";
import {insertErreur} from "./tools/insertErreur";
import {hydrateForm} from "./tools/formTool/hydrateForm";
import {defineParamInput} from "./tools/defineParamInput";

export let FormCustom = {
    cleanForm: cleanForm,
    resetFile : resetFile,
    external_init : external_init,
    insertErreur : insertErreur,
    hydrateForm : hydrateForm,
    defineParamInput : defineParamInput
};