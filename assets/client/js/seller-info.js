jQuery(document).ready(function($) {
    // open Modal
    $(document).on('click','.open-modal', function() {
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
     $(document).on('submit','#close-modal-seller-info, #overlay-modal-seller-info', function(e) {
        // hide modal and overlay
        $('#modal-seller-info, #overlay-modal-seller-info').addClass('opacity-0 invisible');
    });

    $('#seller_name_form').on('submit', function(e) {
        e.preventDefault();
    });

    $(document).on('submit', '#seller_email_form, #seller_phone_number_form, #seller_national_code_form, #seller_name_form', function(e) {

        e.preventDefault();

        let formData = $(this).serialize();
        let ajaxUrl = $('input[name="ajax_url"]').val();

        console.log(formData);
        $.ajax({
            url: stm_wpcfto_ajaxurl,
            type: 'POST',
            data: {
                action: 'submit_seller_status',
                form_data: formData
            },
            beforeSend: function() {
            },
            success: function(response) {
                console.log(response.success);
                if (response.success) {
                    $('#modal-seller-info, #overlay-modal-seller-info').addClass('opacity-0 invisible');
                    $('#loader').removeClass('opacity-0 invisible');
                    loadTemplate(stm_wpcfto_ajaxurl);
                }
            },
            error: function(error) {
                console.error('Error in form submission', error);
            }
        });
    });


    function loadTemplate(ajaxUrl) {
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'mv_get_template_part',
                template: 'client/profile-fields/seller-info'
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