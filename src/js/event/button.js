$(document).on('show-loader', 'button', function(){
   $(this).find('img[alt=loader]').show();
   $(this).find('[data-value]').hide();
});

$(document).on('close-loader', 'button', function(){
    $(this).find('img[alt=loader]').hide();
    $(this).find('[data-value]').show();
});