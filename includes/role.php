<?php 


function add_mv_seller_role() {
    add_role(
        'mv_seller',
        __('فروشنده', 'text_domain'),
        array(
            'read' => true, 
        )
    );

    add_role(
        'mv_seller_assistant',
        __('شاگرد فروشگاه', 'text_domain'),
        array(
            'read' => true,
            
        )
    );
}
add_action('init', 'add_mv_seller_role');

function mv_seller_redirect_dashboard() {
    if (current_user_can('mv_seller') && is_admin()) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('admin_init', 'mv_seller_redirect_dashboard');

function add_custom_capabilities() {
    $role = get_role('mv_seller');
    $role->add_cap('edit_products'); // قابلیت ویرایش محصولات
    $role->add_cap('publish_products'); // قابلیت انتشار محصولات
    $role->add_cap('edit_published_products'); // قابلیت ویرایش محصولات منتشر شده
    // قابلیت‌های دیگر را در صورت نیاز اضافه کنید
}
add_action('admin_init', 'add_custom_capabilities');


