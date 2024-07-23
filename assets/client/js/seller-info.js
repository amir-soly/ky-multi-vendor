jQuery(document).ready(function($) {
    // open Modal
    $('.open-modal').on('click', function() {
        let dataTitle = $(this).parent().find('span').text();
        let formId = $(this).data('form');
        
        // set the modal title
        $('#title-modal-seller-info').text(dataTitle + ' را وارد کنید');
        
        // hide all forms in the modal
        $('#modal-seller-info form').addClass('hidden');
        
        // show the selected form
        $('#' + formId).removeClass('hidden');
        
        // show modal and overlay
        $('#modal-seller-info, #overlay-modal-seller-info').removeClass('opacity-0 invisible');
    });

    // close Modal
    $('#close-modal-seller-info, #overlay-modal-seller-info').on('click', function() {
        // hide modal and overlay
        $('#modal-seller-info, #overlay-modal-seller-info').addClass('opacity-0 invisible');
    });

    $('#seller_name_form').on('submit', function(e) {
        e.preventDefault();
    });
});