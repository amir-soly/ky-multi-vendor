<?php
defined('ABSPATH') || exit;


// add the template to the list of page templates
function add_dashboard_seller_template($templates)
{
    $templates['dashboard-seller.php'] = 'Dashboard Seller';
    return $templates;
}
add_filter('theme_page_templates', 'add_dashboard_seller_template');

function load_dashboard_seller_template($template)
{
    if (is_page() && get_page_template_slug() === 'dashboard-seller.php') {
        $template = MV_DIR_PATH . 'dashboard-seller.php';
    }
    return $template;
}
add_filter('template_include', 'load_dashboard_seller_template');


// add dashboard seller page endpoints
function dashboard_seller_endpoints()
{
    add_rewrite_endpoint('products', EP_PAGES);
    add_rewrite_endpoint('add-product', EP_PAGES);
    add_rewrite_endpoint('seller-orders', EP_PAGES);
    add_rewrite_endpoint('store-information', EP_PAGES);

    // Ensure the endpoints are properly flushed
    flush_rewrite_rules();
}
add_action('init', 'dashboard_seller_endpoints');

// check if the current page is a specific endpoint
function is_dashboard_seller_endpoint($endpoint)
{
    global $wp_query;
    return isset($wp_query->query_vars[$endpoint]);
}




function is_product_on_sale($mv_id)
{
    global $wpdb;

    $prefix = $wpdb->prefix;
    $result = $wpdb->get_row($wpdb->prepare(
        "SELECT sale_price, from_sale_date, to_sale_date FROM {$prefix}kalayadak24_multivendor_products WHERE mv_id = %d",
        $mv_id
    ));

    if ($result) {
        $sale_price = $result->sale_price;
        $from_sale_date = $result->from_sale_date;
        $to_sale_date = $result->to_sale_date;
        if ($sale_price > 0) {
            $current_date = date('Y-m-d');
            if (($from_sale_date <= $current_date) && ($to_sale_date >= $current_date)) {
                return true;
            }
        }
    }

    return false;
}


function update_mv_stock($mv_id, $old_stock, $quantity)
{
    global $wpdb;
    $new_stock = $old_stock - $quantity;
    $table_name = $wpdb->prefix . 'kalayadak24_multivendor_products';
    $data = array(
        'stock' => $new_stock
    );
    $where = array(
        'mv_id' => $mv_id
    );
    $format = array(
        '%d'
    );
    $where_format = array(
        '%d'
    );
    $wpdb->update($table_name, $data, $where, $format, $where_format);
    if ($wpdb->last_error) {
        return $wpdb->last_error;
    } else {
        return true;
    }
}




function add_custom_price($cart_object) {
    global $wpdb;
    $prefix = $wpdb->prefix;

    foreach ($cart_object->cart_contents as $key => $value) {
        $product_id = $value['product_id'];
        $seller_id = $value['seller_id'];

        // دریافت قیمت محصول از جدول بر اساس seller_id و product_id
        $query = $wpdb->prepare(
            "SELECT regular_price, sale_price FROM {$prefix}kalayadak24_multivendor_products WHERE product_id = %d AND seller_id = %d",
            $product_id, $seller_id
        );
        $row = $wpdb->get_row($query);

        if ($row) {
            $custom_price = $row->regular_price;
            $value['data']->set_price($custom_price); // تنظیم قیمت جدید
        }
    }
}

add_action('woocommerce_before_calculate_totals', 'add_custom_price');



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


function get_orders_by_seller_id($seller_id) {
    $orders_by_seller = [];

    $args = array(
        'post_type'      => 'shop_order',
        'post_status'    => array_keys(wc_get_order_statuses()),
        'posts_per_page' => -1,
    );

    $orders = get_posts($args);

    foreach ($orders as $order_post) {
        $order = wc_get_order($order_post->ID);

        $seller_items = [];
        $total_amount = 0;

        foreach ($order->get_items() as $item_id => $item) {
            if ($item->get_meta('seller_id') == $seller_id) {
                $seller_items[] = $item;
                $total_amount += $item->get_total(); 
            }
        }

        if (!empty($seller_items)) {
            $orders_by_seller[$order->get_id()] = [
                'items' => $seller_items,
                'total_amount' => $total_amount,
                'date' => $order->get_date_created()->date_i18n('Y/m/d'),
                'status' => wc_get_order_status_name($order->get_status())
            ];
        }
    }

    return $orders_by_seller;
}



