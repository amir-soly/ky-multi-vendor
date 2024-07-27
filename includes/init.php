<?php
defined('ABSPATH') || exit;



function mv_seller_products_data() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'mv_seller_products_data';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        mv_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        product_id bigint(20) UNSIGNED NOT NULL,
        seller_id bigint(20) UNSIGNED NOT NULL,
        regular_price decimal(10,2) NOT NULL,
        sale_price decimal(10,2) DEFAULT NULL,
        from_sale_date date DEFAULT NULL,
        to_sale_date date DEFAULT NULL,
        stock int(11) NOT NULL,
        min_stock int(11) NOT NULL,
        sold_individually boolean DEFAULT FALSE,
        status varchar(20) NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (mv_id),
        KEY product_id (product_id),
        KEY seller_id (seller_id)
    ) $charset_collate;";
    
     $wpdb->query($sql);

}

add_action('plugins_loaded', 'mv_seller_products_data');


// add the template to the list of page templates
add_filter('theme_page_templates', 'add_dashboard_seller_template');
function add_dashboard_seller_template($templates)
{
    $templates['dashboard-seller.php'] = 'Dashboard Seller';
    return $templates;
}

add_filter('template_include', 'load_dashboard_seller_template');
function load_dashboard_seller_template($template)
{
    if (is_page() && get_page_template_slug() === 'dashboard-seller.php') {
        $template = MV_DIR_PATH . 'dashboard-seller.php';
    }
    return $template;
}

// add dashboard seller page endpoints
add_action('init', 'dashboard_seller_endpoints');
function dashboard_seller_endpoints()
{
    add_rewrite_endpoint('products', EP_PAGES);
    add_rewrite_endpoint('add-product', EP_PAGES);
    add_rewrite_endpoint('seller-orders', EP_PAGES);
    add_rewrite_endpoint('store-information', EP_PAGES);
    add_rewrite_endpoint('seller-information', EP_PAGES);
    add_rewrite_endpoint('accounting-information', EP_PAGES);
    add_rewrite_endpoint('agreement', EP_PAGES);
    add_rewrite_endpoint('documents', EP_PAGES);

    // Ensure the endpoints are properly flushed
    flush_rewrite_rules();
}

add_action('woocommerce_before_calculate_totals', 'add_custom_price');
function add_custom_price($cart_object) {
    global $wpdb;
    $prefix = $wpdb->prefix;

    foreach ($cart_object->cart_contents as $key => $value) {
        $product_id = $value['product_id'];
        $seller_id = $value['seller_id'];

        // دریافت قیمت محصول از جدول بر اساس seller_id و product_id
        $query = $wpdb->prepare(
            "SELECT regular_price, sale_price FROM {$prefix}mv_seller_products_data WHERE product_id = %d AND seller_id = %d",
            $product_id, $seller_id
        );
        $row = $wpdb->get_row($query);

        if ($row) {
            $custom_price = $row->regular_price;
            $value['data']->set_price($custom_price); // تنظیم قیمت جدید
        }
    }
}

add_action('woocommerce_checkout_create_order_line_item', 'transfer_seller_id_to_order_items', 10, 4);
function transfer_seller_id_to_order_items($item, $cart_item_key, $values, $order) {
    if (isset($values['seller_id'])) {
        $item->add_meta_data('seller_id', $values['seller_id'], true);
    }
}
add_action('woocommerce_after_order_itemmeta', 'display_seller_id_in_admin_order_items', 10, 3);
function display_seller_id_in_admin_order_items($item_id, $item, $product) {
    if ($item->get_meta('seller_id')) {
        echo '<p><strong>' . __('Seller ID') . ':</strong> ' . $item->get_meta('seller_id') . '</p>';
    }
}


