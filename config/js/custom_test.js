export let tests = {
    'video_cat' : {
        'test' : function(input) {
            let free_cat_id = ['1'];
            let free_cat = false;
            let paye_cat = false;

            $.each(input.checkboxs, function(index, checkbox){
                if(!$(checkbox).is(':checked')) {return true}

                free_cat_id.indexOf($(checkbox).val()) !== -1 ? free_cat = true : paye_cat = true;
            });

            return !(free_cat === true && paye_cat === true);
        },
        'message': "Payantes et gratuites sélectionnées."
    }
};
