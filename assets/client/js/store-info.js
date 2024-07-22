jQuery(document).ready(function($) {
    // open Modal
    $('.open-modal').on('click', function() {
        let dataTitle = $(this).parent().find('span').text();
        let formId = $(this).data('form');
        
        // set the modal title
        $('#title-modal-store-info').text(dataTitle + ' را وارد کنید');
        
        // hide all forms in the modal
        $('#modal-store-info form').addClass('hidden');
        
        // show the selected form
        $('#' + formId).removeClass('hidden');
        
        // show modal and overlay
        $('#modal-store-info, #overlay-modal-store-info').removeClass('opacity-0 invisible');
    });

    // close Modal
    $('#close-modal-store-info, #overlay-modal-store-info').on('click', function() {
        // hide modal and overlay
        $('#modal-store-info, #overlay-modal-store-info').addClass('opacity-0 invisible');
    });

    $('#store_name_form').on('submit', function(e) {
        e.preventDefault();
    });
});