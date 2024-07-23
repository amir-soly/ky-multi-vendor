jQuery(document).ready(function($) {
    // open Modal
    $(document).on('click', '.open-modal', function() {
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
    $(document).on('click', '#close-modal-store-info, #overlay-modal-store-info', function() {
        // hide modal and overlay
        $('#modal-store-info, #overlay-modal-store-info').addClass('opacity-0 invisible');
    });
    
    $(document).on('submit', '#store_status_form, #store_name_form, #store_about_form, #store_landline_form, #store_website_form, #store_holidays_form', function(e) {

        e.preventDefault();

        let formData = $(this).serialize();
        let ajaxUrl = $('input[name="ajax_url"]').val();

        
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'submit_store_status',
                form_data: formData
            },
            beforeSend: function() {
            },
            success: function(response) {
                console.log(response.success);
                if (response.success) {
                    $('#modal-store-info, #overlay-modal-store-info').addClass('opacity-0 invisible');
                    $('#loader').removeClass('opacity-0 invisible');
                    loadTemplate(ajaxUrl);
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