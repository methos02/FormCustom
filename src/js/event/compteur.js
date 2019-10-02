$(document).on('input update-compteur','textarea', function(){
    let $resume = $(this);
    let name = $resume.attr('name');
    let $compteur = $('#compteur-' + name);

    if($compteur.length !== 0) {
        let length = $resume.val().length;
        $compteur.find('[data-part=nb]').html( length );
    }
});