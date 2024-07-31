jQuery(document).ready(function($) {
    $('#store-address-tab').on('click', function() {
        $('#store-address-tab').addClass('tab-active');
        $('#warehouse-address-tab').removeClass('tab-active');
        $('#store-address-content').removeClass('hidden');
        $('#warehouse-address-content').addClass('hidden');
    });

    $('#warehouse-address-tab').on('click', function() {
        $('#warehouse-address-tab').addClass('tab-active');
        $('#store-address-tab').removeClass('tab-active');
        $('#warehouse-address-content').removeClass('hidden');
        $('#store-address-content').addClass('hidden');
    });

    $('.open-modal-map-address').click(function() {
        $('#modal-map-address').removeClass('opacity-0 invisible');
        $('#overlay-modal-address').removeClass('opacity-0 invisible');
    });

    $('#close-modal-map-address').click(function() {
        $('#modal-map-address').addClass('opacity-0 invisible');
        $('#overlay-modal-address').addClass('opacity-0 invisible');
    });

    $('#close-modal-map-form').click(function() {
        $('#modal-map-form').addClass('opacity-0 invisible');
        $('#overlay-modal-address').addClass('opacity-0 invisible');
    });

    $('#open-modal-map-form').click(function() {
        $('#modal-map-form').removeClass('opacity-0 invisible');
        $('#modal-map-address').addClass('opacity-0 invisible');
        $('#overlay-modal-address').removeClass('opacity-0 invisible');
    });

    $('#overlay-modal-address').click(function() {
        $('#modal-map-form').addClass('opacity-0 invisible');
        $('#modal-map-address').addClass('opacity-0 invisible');
        $('#overlay-modal-address').addClass('opacity-0 invisible');
    });
});