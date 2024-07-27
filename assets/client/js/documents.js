jQuery(document).ready(function($) {
    // open Modal
    $(document).on('click', '.open-modal', function() {
        let dataTitle = $(this).find('span').text();
        let formId = $(this).data('form');
        
        // set the modal title and form ID
        $('#title-modal-documents').text(dataTitle + ' را وارد کنید');
        $('#meta_filed').val(formId);
        
        // show modal and overlay
        $('#modal-documents, #overlay-modal-documents').removeClass('opacity-0 invisible');
    });

    // close Modal
    $(document).on('click', '#close-modal-documents, #overlay-modal-documents', function() {
        // hide modal and overlay
        $('#modal-documents, #overlay-modal-documents').addClass('opacity-0 invisible');

        // reset the image button and hidden input field
        $('.image-button').css('background-image', 'none');
        $('.image-button span').removeClass('opacity-0');
        $('#meta_filed').val('');
    });

    // handle file input and preview
    $(document).on('click', '.image-button', function(e) {
        e.preventDefault();
        $('#document').click();
    });

    $(document).on('change', '#document', function(e) {
        e.preventDefault();

        const fileInput = $(this);
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // display the uploaded image as background in the button
                $('.image-button').css('background-image', 'url(' + e.target.result + ')');
                $('.image-button span').addClass('opacity-0');
            };

            reader.readAsDataURL(file);

            // hide the file input after selection
            fileInput.val('');
        }
    });

    $('#documents_form').submit(function(e){
        e.preventDefault();
    });
});