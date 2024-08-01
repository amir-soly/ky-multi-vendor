import {customMessage} from './functions.js?v=1.0.0';

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
    $(document).on('submit', '#accounting_card_number_form, #accounting_vat_exempt_form', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();
        let submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true).html('<svg class="animate-spin mx-auto" xmlns="http://www.w3.org/2000/svg" width="21px" height="21px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 12a9 9 0 11-6.219-8.56"></path> </g></svg>');
        
        $.ajax({
            url: stm_wpcfto_ajaxurl,
            type: 'POST',
            data: {
                action: 'submit_seller_accounting',
                form_data: formData
            },
            beforeSend: function() {
            },
            success: function(response) {
                submitButton.prop('disabled', false).html('تایید');

                if (response.success) {
                    $('#modal-store-info, #overlay-modal-store-info').addClass('opacity-0 invisible');
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
                template: 'client/profile-fields/store-info'
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