<?php
defined('ABSPATH') || exit;


// add the template to the list of page templates
function add_dashboard_seller_template($templates) {
    $templates['dashboard-seller.php'] = 'Dashboard Seller';
    return $templates;
}
add_filter('theme_page_templates', 'add_dashboard_seller_template');

function load_dashboard_seller_template($template) {
    if (is_page() && get_page_template_slug() === 'dashboard-seller.php') {
        $template = MV_DIR_PATH . 'dashboard-seller.php';
    }
    return $template;
}
add_filter('template_include', 'load_dashboard_seller_template');


// add dashboard seller page endpoints
function dashboard_seller_endpoints() {
    add_rewrite_endpoint('products', EP_PAGES);
    add_rewrite_endpoint('add-product', EP_PAGES);
    add_rewrite_endpoint('seller-orders', EP_PAGES);
    
    // Ensure the endpoints are properly flushed
    flush_rewrite_rules();
}
add_action('init', 'dashboard_seller_endpoints');

// check if the current page is a specific endpoint
function is_dashboard_seller_endpoint($endpoint) {
    global $wp_query;
    return isset($wp_query->query_vars[$endpoint]);
}




function is_product_on_sale($mv_id)
{
    global $wpdb;

    // گرفتن اطلاعات محصول بر اساس mv_id
    $prefix = $wpdb->prefix;
    $result = $wpdb->get_row($wpdb->prepare(
        "SELECT sale_price, from_sale_date, to_sale_date FROM {$prefix}kalayadak24_multivendor_products WHERE mv_id = %d",
        $mv_id
    ));

    // بررسی اینکه آیا اطلاعات محصول دریافت شده است یا خیر
    if ($result) {
        $sale_price = $result->sale_price;
        $from_sale_date = $result->from_sale_date;
        $to_sale_date = $result->to_sale_date;

        // بررسی اینکه آیا قیمت فروش ویژه ثبت شده است یا خیر
        if ($sale_price > 0) {
            // گرفتن تاریخ فعلی
            $current_date = date('Y-m-d');

            // بررسی اینکه آیا تاریخ فعلی در محدوده تاریخ‌های شروع و پایان فروش ویژه قرار دارد یا خیر
            if (($from_sale_date <= $current_date) && ($to_sale_date >= $current_date)) {
                return true; // محصول در فروش ویژه است
            }
        }
    }

    return false; // محصول در فروش ویژه نیست
}

?>