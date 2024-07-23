<?php
defined('ABSPATH') || exit;


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

    // Ensure the endpoints are properly flushed
    flush_rewrite_rules();
}

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

add_action('woocommerce_before_calculate_totals', 'add_custom_price');
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


function mv_seller_store_info_meta($seller_id, $store_data, $meta_field) {
    $seller_id = intval($seller_id);
    
    $store_data = sanitize_text_field($store_data);
    $meta_field = sanitize_text_field($meta_field);
    
    $valid_meta_fields = array('seller_status', 'store_bio', 'store_name', 'store_phone', 'store_site', 'store_vacation');
    if (!in_array($meta_field, $valid_meta_fields)) {
        return;
    }
    
    $current_store_data = get_user_meta($seller_id, 'mv_store_data', true);
    
    if (!is_array($current_store_data)) {
        $current_store_data = array();
    }

    $current_store_data[$meta_field] = $store_data;

    $data_check = update_user_meta($seller_id, 'mv_store_data', $current_store_data);
    return $data_check;

}


function mv_get_store_data($seller_id, $meta_field) {
    $seller_id = intval($seller_id);

    $meta_field = sanitize_text_field($meta_field);

    $valid_meta_fields = array('seller_status', 'store_bio', 'store_name', 'store_phone', 'store_site', 'store_vacation');
    
 

    $store_data = get_user_meta($seller_id, 'mv_store_data', true);

    if (!is_array($store_data)) {
        $store_data = array();
    }

    if (isset($store_data[$meta_field]) && !empty($store_data[$meta_field])) {
        echo  esc_html($store_data[$meta_field]);
    } else {
        // switch ($meta_field) {
        //     case 'seller_status':
        //         $not_set_message = 'وضعیت';
        //         break;
        //     case 'store_bio':
        //         $not_set_message = 'درباره ما';
        //         break;
        //     case 'store_name':
        //         $not_set_message = 'فروشگاه';
        //         break;
        //     case 'store_phone':
        //         $not_set_message = 'شماره تماس';
        //         break;
        //     case 'store_site':
        //         $not_set_message = 'وبسایت';
        //         break;
        //     case 'store_vacation':
        //         $not_set_message = 'تعطیلات';
        //         break;
            
        // }
        // echo  esc_html($not_set_message) ;


        return false;
    }
}

