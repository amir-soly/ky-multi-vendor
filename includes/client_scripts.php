<?php
defined( 'ABSPATH' ) || exit;

// enqueue scripts to head
function enqueue_scripts_head() {
    if (is_page_template('dashboard-seller.php')) { ?> 
        <style>
            :root {
         
            }
        </style>
    <?php }
}
add_action('wp_head', 'enqueue_scripts_head');

// enqueue scripts file to client page
function enqueue_scripts() {
    # tailwind
    wp_register_style('output-tailwind', MV_DIR_URL . 'assets/client/css/output.css', array(), filemtime(MV_DIR_PATH . 'assets/client/css/output.css'), 'all');
    
    #scripts
    wp_register_script('add-product', MV_DIR_URL . 'assets/client/js/add-product.js', array('jquery'), filemtime(MV_DIR_PATH . 'assets/client/js/add-product.js'), true);
    wp_register_script('products', MV_DIR_URL . 'assets/client/js/products.js', array('jquery'), filemtime(MV_DIR_PATH . 'assets/client/js/products.js'), true);

    if (is_page_template('dashboard-seller.php')) {
        wp_enqueue_style('output-tailwind');

        if (is_dashboard_seller_endpoint('add-product')) {
            wp_enqueue_script('add-product');
        } elseif (is_dashboard_seller_endpoint('products')) {
            wp_enqueue_script('products');
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

