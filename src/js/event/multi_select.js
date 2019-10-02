$(document).mouseup(function(e) {
    let container = $("[data-options]");
    let $input = defineInput($(e.target));

    if($input !== false && !$input.hasClass('options-open')) {
        $input.find('[data-options]').slideDown(300);
        $input.addClass('options-open');
        return;
    }

    if(!container.is(e.target) && container.has(e.target).length === 0) {
        container.slideUp(300, function(){
            $('[data-input=multi-select]').removeClass('options-open');
        });
    }
});

$(document).on('change', '[data-type=multiselect]', function(){
    let $input = $(this).closest('[data-input=multi-select]');
    let nb_checked = $input.find('input:checked').length;

    $input.find('[data-nb]').html(nb_checked);

    if(nb_checked > 1) {
        $input.find('[data-s]').show();
        return
    }

    $input.find('[data-s]').hide();
});

function defineInput($target) {
    if($target.is('[data-input=multi-select]')) {
        return $target;
    }

    if($target.closest('[data-input=multi-select]').length !== 0) {
        return $target.closest('[data-input=multi-select]');
    }

    return false;
}