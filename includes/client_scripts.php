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
    wp_enqueue_script('jquery');
    wp_enqueue_script('add-product', MV_DIR_URL . 'assets/client/js/add-product.js', array('jquery'), null, true);

    
    wp_enqueue_style('output-tailwind', MV_DIR_URL . 'assets/client/css/output.css', array(), filemtime(MV_DIR_PATH . 'assets/client/css/output.css'), 'all');
    
    if (is_page_template('dashboard-seller.php')) {
        wp_enqueue_style('output-tailwind');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

