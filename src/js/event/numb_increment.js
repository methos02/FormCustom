$(document).on('click', '[data-input=numb_increment] [data-action]:not(disabled)', function(e){
    e.preventDefault();
    let $input = $(this).siblings('input');
    let val = $input.val() === "" ? 0 : parseInt($input.val());
    let increment = $(this).data('action') === 'increase' ? 1 : -1;

    if($input.data('statut') === "erreur" || (val === 0 && increment === -1)) return ;

    $input.val(val + increment);
});