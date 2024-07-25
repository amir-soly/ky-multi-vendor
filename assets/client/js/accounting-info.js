jQuery(document).ready(function($) {
    // open Modal
    $('.open-modal').on('click', function() {
        let dataTitle = $(this).parent().find('span').text();
        let formId = $(this).data('form');
        
        // set the modal title
        $('#title-modal-accounting-info').text(dataTitle + ' را وارد کنید');
        
        // hide all forms in the modal
        $('#modal-accounting-info form').addClass('hidden');
        
        // show the selected form
        $('#' + formId).removeClass('hidden');
        
        // show modal and overlay
        $('#modal-accounting-info, #overlay-modal-accounting-info').removeClass('opacity-0 invisible');
    });

    // close Modal
    $('#close-modal-accounting-info, #overlay-modal-accounting-info').on('click', function() {
        // hide modal and overlay
        $('#modal-accounting-info, #overlay-modal-accounting-info').addClass('opacity-0 invisible');
    });
});