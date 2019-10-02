//switch Uform
$(document).on('click', '[data-btn_uform]', function(e){
    e.preventDefault();
    let el = this;
    let affiche = $(el).data('btn_uform');

    $(el).closest('.uform').find('[data-btn_uform]').each(function () {
        $(this).toggleClass('btn-uform-select', el === this);
    });

    $('div[data-uform]').each(function () {
        $(this).toggle($(this).data('uform') === affiche);
    });
});