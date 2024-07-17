<?php
function check_product_existence($product_id, $user_id)
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'kalayadak24_multivendor_products';

    // Query to check if the product for this user already exists
    $query = $wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name WHERE product_id = %d AND seller_id = %d",
        $product_id,
        $user_id
    );

    $result = $wpdb->get_var($query);

    if ($result > 0) {
        return true; // Product already exists for this user
    } else {
        return false; // Product does not exist for this user
    }
}

function insert_product_data_into_table($product_id, $seller_id, $regular_price, $sale_price, $from_sale_date, $to_sale_date, $stock, $min_stock, $sold_individually, $status)
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'kalayadak24_multivendor_products';

    $data = array(
        'product_id' => $product_id,
        'seller_id' => $seller_id,
        'regular_price' => $regular_price,
        'sale_price' => $sale_price,
        'from_sale_date' => $from_sale_date,
        'to_sale_date' => $to_sale_date,
        'stock' => $stock,
        'min_stock' => $min_stock,
        'sold_individually' => $sold_individually,
        'status' => $status,
    );

    $format = array(
        '%d', // product_id
        '%d', // seller_id
        '%f', // regular_price
        '%f', // sale_price
        '%s', // from_sale_date
        '%s', // to_sale_date
        '%d', // stock
        '%d', // min_stock
        '%s', // sold_individually
        '%s', // status
    );

    $wpdb->insert($table_name, $data, $format);

    // Check if the insert was successful
    if ($wpdb->last_error) {
        return $wpdb->last_error; // Return false if there was an error
    } else {
        return $wpdb->insert_id; // Return true if the insert was successful
    }
}


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
            'is_sent' => false,
        ));
        die();
    }

    if ($product_id == 0) {
        wp_send_json_error(array(
            'message' => 'آیدی محصول معتبر نیست',
            'is_sent' => false,
        ));
        die();
    }

    if ($regular_price == 0) {
        wp_send_json_error(array(
            'message' => 'مبلغ نمی تواند خالی یا 0 باشد',
            'is_sent' => false,
        ));
        die();
    }
    if ($sale_price == 0) {
        wp_send_json_error(array(
            'message' => 'مبلغ فروش ویژه نمی تواند خالی یا 0 باشد',
            'is_sent' => false,
        ));
        die();
    }

    if ($stock == 0) {
        wp_send_json_error(array(
            'message' => 'موجودی انبار نمی تواند خالی یا 0 باشد',
            'is_sent' => false,
        ));
        die();
    }
    if (!check_product_existence($product_id, $user_id)) {


        $mv_ID = insert_product_data_into_table($product_id, $user_id, $regular_price, $sale_price, $from_sale_date, $to_sale_date, $stock, $min_stock, $sold_individually, $status);

        if ($mv_ID) {
            wp_send_json_success(array(
                'message' => 'Product added successfully!',
                'is_sent' => true,
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
            'is_sent' => false,
        ));
        die();
    }
}
add_action('wp_ajax_mv_add_product', 'mv_add_product');
add_action('wp_ajax_nopriv_mv_add_product', 'mv_add_product');



add_action('wp_ajax_search_products', 'handle_search_products');
add_action('wp_ajax_nopriv_search_products', 'handle_search_products'); // برای کاربران مهمان

function handle_search_products()
{
    global $wpdb;

    // دریافت و تمیز کردن مقادیر ورودی
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $search_value = isset($_POST['search_query']) ? sanitize_text_field($_POST['search_query']) : '';

    // تنظیم پارامترهای WP_Query برای جستجو
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
        's' => $search_value, // جستجو بر اساس کلمه
    );

    // اضافه کردن پارامتر دسته‌بندی به کوئری در صورت وجود
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
    // نمایش نتایج
    if ($search_results) {
        $mainIDs = [];
        foreach ($search_results as $product) {
            $mainIDs[] = $product->ID;
        }

        // دریافت فروشگاه‌های محصولات از جدول سفارشی
        $seller_id = get_current_user_id();
        $result = $wpdb->get_results($wpdb->prepare(
            "SELECT product_id FROM {$wpdb->prefix}kalayadak24_multivendor_products WHERE seller_id = %d",
            $seller_id
        ));

        // ساخت آرایه از شناسه‌های محصول‌های مربوط به فروشنده
        $seller_product_ids = array_column($result, 'product_id');
        // نمایش نتایج مربوط به شناسه‌های محصولات فروشنده
        $matched_products = array_intersect($mainIDs, $seller_product_ids);

        if ($matched_products) {

            $products=[];
            foreach ($matched_products as $product_id) {
                $thumbnail_url = get_the_post_thumbnail_url($product_id, 'thumbnail');
                $tittle= get_the_title($product_id);
                $terms = wc_get_product_category_list($product_id);;
                $status= 'pending';
                $products[] = 
                    array(
                        'seller_id'=> $seller_id,
                        'pro_id'=>$product_id,
                        'thumbnail' =>  $thumbnail_url,
                        'tittle'=> $tittle,
                        'terms' => $terms,
                        'status' =>$status,
                    );
            }

            wp_send_json_success(array(
                'is_sent' => true,
                'products' =>  $products,

            ));
        } else {
            echo 'No matching products found.';
        }
    } else {
        echo 'No products found.';
    }

    wp_die(); // پایان اجرای AJAX
}
