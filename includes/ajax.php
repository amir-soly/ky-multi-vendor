<?php
defined('ABSPATH') || exit;
add_action('wp_ajax_mv_add_product', 'mv_add_product');
add_action('wp_ajax_nopriv_mv_add_product', 'mv_add_product');
function mv_add_product()
{
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $regular_price = isset($_POST['regular_price']) ? floatval($_POST['regular_price']) : 0;
    $sale_price = isset($_POST['sale_price']) ? $_POST['sale_price'] : " ";
    $from_sale_date = isset($_POST['from_sale_date']) ? sanitize_text_field($_POST['from_sale_date']) : '';
    $to_sale_date = isset($_POST['to_sale_date']) ? sanitize_text_field($_POST['to_sale_date']) : '';
    $stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;
    $min_stock = isset($_POST['min_stock']) ? intval($_POST['min_stock']) : 0;
    $sold_individually = isset($_POST['sold_individually']) ? sanitize_text_field($_POST['sold_individually']) : 'no';

    $status = "pending";

    if ($user_id == 0) {
        wp_send_json_error(array(
            'message' => 'آیدی کاربر معتبر نیست',
        ));
        die();
    }

    if ($product_id == 0) {
        wp_send_json_error(array(
            'message' => 'آیدی محصول معتبر نیست',
        ));
        die();
    }

    if ($regular_price == 0) {
        wp_send_json_error(array(
            'message' => 'مبلغ نمی تواند خالی یا 0 باشد',
        ));
        die();
    }
    if ($sale_price == 0) {
        wp_send_json_error(array(
            'message' => 'مبلغ فروش ویژه نمی تواند خالی یا 0 باشد',
        ));
        die();
    }

    if ($stock == 0) {
        wp_send_json_error(array(
            'message' => 'موجودی انبار نمی تواند خالی یا 0 باشد',
        ));
        die();
    }

    if (!check_product_existence($product_id, $user_id)) {
        $mv_ID = insert_product_data_into_table($product_id, $user_id, $regular_price, $sale_price, $from_sale_date, $to_sale_date, $stock, $min_stock, $sold_individually, $status, '');

        if ($mv_ID) {
            wp_send_json_success(array(
                'message' => 'Product added successfully!',
                'mv_ID' => $mv_ID
            ));
        } else {
            echo "خطا در وارد کردن داده!";
            wp_send_json_error("خطا در وارد کردن داده!", $mv_ID);
            die();
        }
    } else {
        wp_send_json_error(array(
            'message' => "این محصول برای این کاربر قبلاً ثبت شده است!",
        ));
        die();
    }
}
add_action('wp_ajax_search_products', 'handle_search_products');
add_action('wp_ajax_nopriv_search_products', 'handle_search_products');
function handle_search_products()
{
    global $wpdb;

    // sanitize input values
    $action = isset($_POST['action_type']) ? sanitize_text_field($_POST['action_type']) : '';
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $search_value = isset($_POST['search_query']) ? sanitize_text_field($_POST['search_query']) : '';

    // set up WP_Query parameters for search
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 30,
        'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
    );

    // if search value is not empty, add it to the query parameters
    if (!empty($search_value)) {
        $args['s'] = $search_value;
    }

    // add category parameter to query if exists
    if ($category_id) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $category_id,
            ),
        );
    }

    $search = new WP_Query($args);
    $search_results = $search->have_posts() ? $search->posts : [];

    if ($action == 'list_products') {
        if ($search_results) {
            $mainIDs = wp_list_pluck($search_results, 'ID');
            $seller_id = get_current_user_id();
            $result = $wpdb->get_results($wpdb->prepare(
                "SELECT product_id FROM {$wpdb->prefix}mv_seller_products_data
                 WHERE seller_id = %d",
                $seller_id
            ));

            // build an array of product IDs related to the seller
            $seller_product_ids = array_column($result, 'product_id');
            $matched_products = array_intersect($mainIDs, $seller_product_ids);

            if ($matched_products) {
                $products = array_map(function ($product_id) use ($seller_product_ids) {
                    return array(
                        'seller_id' => get_current_user_id(),
                        'product_id' => $product_id,
                        'title' => get_the_title($product_id),
                        'thumbnail' => get_the_post_thumbnail_url($product_id, 'thumbnail'),
                        'terms' => wc_get_product_category_list($product_id),
                        'status' => in_array($product_id, $seller_product_ids) ? 'exists' : 'not_exists',
                    );
                }, $matched_products);

                wp_send_json_success(array('products' => $products));
            } else {
                wp_send_json_error('No matching products found.');
            }
        } else {
            wp_send_json_error('No products found.');
        }
    } elseif ($action == 'add_product') {
        if ($search_results) {
            $seller_id = get_current_user_id();
            $result = $wpdb->get_results($wpdb->prepare(
                "SELECT product_id FROM {$wpdb->prefix}mv_seller_products_data
                 WHERE seller_id = %d",
                $seller_id
            ));

            $seller_product_ids = array_column($result, 'product_id');

            $products = array_map(function ($product) use ($seller_product_ids) {
                $product_id = $product->ID;
                $wc_product = wc_get_product($product_id);

                return array(
                    'seller_id' => get_current_user_id(),
                    'product_id' => $product_id,
                    'title' => get_the_title($product_id),
                    'thumbnail' => get_the_post_thumbnail_url($product_id, 'thumbnail'),
                    'price' => wc_price($wc_product->get_price()),
                    'terms' => wc_get_product_category_list($product_id),
                    'exists' => in_array($product_id, $seller_product_ids) ? 'true' : 'false',
                    'sku' => $wc_product->get_sku(),
                );
            }, $search_results);

            wp_send_json_success(array('products' => $products));
        } else {
            wp_send_json_error('No products found.');
        }
    }

    wp_die(); // end AJAX execution
}
add_action('wp_ajax_submit_store_status', 'handle_submit_store_status');
add_action('wp_ajax_nopriv_submit_store_status', 'handle_submit_store_status');
function handle_submit_store_status()
{

    parse_str($_POST['form_data'], $form_data);

    $seller_id = isset($form_data['seller_id']) ? intval($form_data['seller_id']) : 0;
    $store_data = isset($form_data['store_data']) ? sanitize_text_field($form_data['store_data']) : '';
    $meta_field = isset($form_data['meta_field']) ? sanitize_text_field($form_data['meta_field']) : '';
    $user = get_userdata($seller_id);
    if (!$user && !in_array('mv_seller', $user->roles)) {
        wp_send_json_error(array(
            'message' => 'User does not exist or is not seller',
        ));
    }


    $data_check = mv_seller_store_info_meta($seller_id, $store_data, $meta_field);
    if ($data_check) {
        wp_send_json_success(array(
            'message' => 'store mv_store_data added successfully',
        ));
    } else {
        wp_send_json_error(array(
            'message' => 'there is an error while adding',
        ));
    }


    wp_die();
}
add_action('wp_ajax_mv_get_template_part', 'mv_get_template_part');
add_action('wp_ajax_nopriv_mv_get_template_part', 'mv_get_template_part');
function mv_get_template_part()
{
    $template = sanitize_text_field($_POST['template']);

    ob_start();
    mv_template_part($template);
    $html = ob_get_clean();

    echo $html;
    wp_die();
}
add_action('wp_ajax_submit_seller_status', 'handle_submit_seller_status');
add_action('wp_ajax_nopriv_submit_seller_status', 'handle_submit_seller_status');
function handle_submit_seller_status()
{

    parse_str($_POST['form_data'], $form_data);

    $seller_id = isset($form_data['seller_id']) ? intval($form_data['seller_id']) : 0;
    $seller_data = isset($form_data['seller_data']) ? sanitize_text_field($form_data['seller_data']) : '';

    $meta_field = isset($form_data['meta_field']) ? sanitize_text_field($form_data['meta_field']) : '';
    $user = get_userdata($seller_id);



    if (!$user && !in_array('mv_seller', $user->roles)) {
        wp_send_json_error(array(
            'message' => 'User does not exist or is not seller',
        ));
    }


    if ($meta_field == 'seller_first_name,seller_last_name') {

        $seller_data1 = isset($form_data['seller_data1']) ? sanitize_text_field($form_data['seller_data1']) : '';
        $meta_data = array(
            'field1' =>  $seller_data,
            'field2' =>  $seller_data1,
        );
        $meta_fields = explode(',', $meta_field);

        $index = 0;
        foreach ($meta_fields as $meta_field) {
            $data_value = isset($meta_data['field' . ($index + 1)]) ? $meta_data['field' . ($index + 1)] : '';
            $data_check = mv_seller_info_meta($seller_id, $data_value, $meta_field);

            $index++;
        }

        if ($data_check) {
            wp_send_json_success(array(
                'message' => 'store mv_store_data added successfully',
            ));
        } else {
            wp_send_json_error(array(
                'message' => 'there is an error while adding',
            ));
        }
    } else {

        $data_check = mv_seller_info_meta($seller_id, $seller_data, $meta_field);
        if ($data_check) {
            wp_send_json_success(array(
                'message' => 'store mv_store_data added successfully',
            ));
        } else {
            wp_send_json_error(array(
                'message' => 'there is an error while adding',
            ));
        }
    }




    wp_die();
}

add_action('wp_ajax_upload_document', 'handle_upload_document');
add_action('wp_ajax_nopriv_upload_document', 'handle_upload_document');
function handle_upload_document()
{

    function log_message($message) {
        $existing_log = get_transient('n_custom_log') ?: '';
        $new_log = $existing_log . date('[Y-m-d H:i:s] ') . $message . "\n";
        set_transient('n_custom_log', $new_log, 3600);
    }
    $seller_id = get_current_user_id();

    $meta_field = isset($_POST['meta_field']) ? sanitize_text_field($_POST['meta_field']) : '';
    $user = get_userdata($seller_id);

    $document = isset($_FILES['document']) ? sanitize_text_field($_FILES['document']) : '';

    if (!$user && !in_array('mv_seller', $user->roles)) {
        wp_send_json_error(array(
            'message' => 'User does not exist or is not seller',
        ));
    }
    if (empty($_FILES['document'])) {
        wp_send_json_error(array(
            'message' => 'No document uploaded',
        ));
    }

    // تنظیمات آپلود
    $upload = wp_handle_upload($_FILES['document'], array('test_form' => false));
    if (isset($upload['error'])) {
        wp_send_json_error(array(
            'message' => $upload['error'],
        ));
    }

    $status = 'pending';
    $data_check = mv_seller_document_meta($seller_id, $upload['url'], $meta_field , $status);
    
    if($data_check){
        wp_send_json_success(array(
            'message' => 'store mv_seller_document added successfully',
        ));
    }else{
        wp_send_json_error(array(
            'message' => 'there is an error while adding',
        ));
    }
    wp_die();
}
