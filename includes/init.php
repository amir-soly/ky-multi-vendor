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
?>