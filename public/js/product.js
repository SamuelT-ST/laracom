$( document ).ready(function() {
    $('#is_group_product').on('click', function () {
        if($('#is_group_product:checked').length > 0){
            $('#products_list').fadeIn();
        } else{
            $('#products_list').fadeOut();
        }
    });

    if($('#is_group_product:checked').length > 0){
        $('#products_list').show();
    }
});