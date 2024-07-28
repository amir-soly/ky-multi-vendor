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
    require __DIR__ . '/products.php';

}

function mv_products() {
    echo '<h1>Welcome to My Custom Submenu Page</h1>';
    echo '<p>Here is the content of my custom submenu page.</p>';
}
