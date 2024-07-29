<?php
function mv_admin_panel_menu() {
    add_menu_page(
        'مدیریت چند فروشندگی',
        'مدیریت چند فروشندگی',
        'manage_options',
        'mv-management',
        'mv_management',
        'dashicons-admin-tools',
        20
    );

    add_submenu_page(
        'mv-management',
        'محصولات چند فروشندگی',
        'محصولات',
        'manage_options',
        'mv-products',
        'mv_products'
    );
}
add_action('admin_menu', 'mv_admin_panel_menu');

function mv_management() {

}

function mv_products() {
    require __DIR__ . '/products.php';

}
