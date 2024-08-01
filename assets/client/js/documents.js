import {customMessage} from './functions.js?v=1.0.0';
jQuery(document).ready(function($) {
    // open Modal
    $(document).on('click', '.open-modal', function() {
        let dataTitle = $(this).find('span').text();
        let formId = $(this).data('form');
        
        // set the modal title and form ID
        $('#title-modal-documents').text(dataTitle + ' را وارد کنید');
        $('#meta_field').val(formId);
        
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
        $('#meta_field').val('');
    });

    // handle file input and preview
    $(document).on('click', '.image-button', function(e) {
        e.preventDefault();
        $('#document').click();
    });

    $(document).on('change', '#document', function(e) {
        e.preventDefault();

        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // display the uploaded image as background in the button
                $('.image-button').css('background-image', 'url(' + e.target.result + ')');
                $('.image-button span').addClass('opacity-0');
            };

            reader.readAsDataURL(file);
        }
    });

    $(document).on('submit','#documents_form', function(e){
        e.preventDefault();
    
        // get the file input
        const fileInput = $('#document')[0].files[0];
        const metaField = $('#meta_field').val();
        if (!fileInput) {
            alert('خالیه');
            return;
        }
    
        let formData = new FormData();
        formData.append('document', fileInput);
        formData.append('meta_field', metaField);
        formData.append('action', 'upload_document');

        let submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true).html('<svg class="animate-spin mx-auto" xmlns="http://www.w3.org/2000/svg" width="21px" height="21px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 12a9 9 0 11-6.219-8.56"></path> </g></svg>');
        $.ajax({
            url: stm_wpcfto_ajaxurl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
            },
            success: function(response) {
                submitButton.prop('disabled', false).html('تایید');

                if (response.success) {
                    $('#modal-documents, #overlay-modal-documents').addClass('opacity-0 invisible');
                    $('#loader').removeClass('opacity-0 invisible');
                    loadTemplate();
                    
                    customMessage('اطلاعات با موفقیت ثبت شد.', 'success');
                } else {
                    customMessage(response.data.message, 'warnig');
                }
            },
            error: function(error) {
                submitButton.prop('disabled', false).html('تایید');
                customMessage('مشکلی پیش آمده دوباره امتحان کنید.', 'error');
            }
        });
    });


    function loadTemplate() {
        $.ajax({
            url: stm_wpcfto_ajaxurl,
            type: 'POST',
            data: {
                action: 'mv_get_template_part',
                template: 'client/profile-fields/documents'
            },
            success: function(html) {
                $('#container-fields').html(html);
                $('#loader').addClass('opacity-0 invisible');
            },
            error: function(error) {
                console.error('Error in loading template', error);
                $('#loader').addClass('opacity-0 invisible');
            }
        });
    };
});