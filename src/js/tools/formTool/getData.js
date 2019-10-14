export function getObjData($form) {
    let array = $form.serializeArray();
    let obj = {};

    $.map(array, function(n, i){
       obj[n['name']] = n['value'];
    });

    return obj;
}