<?php 
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
        "SELECT sale_price, from_sale_date, to_sale_date FROM {$prefix}mv_seller_products_data WHERE mv_id = %d",
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
    $table_name = $wpdb->prefix . 'mv_seller_products_data';
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
function check_product_existence($product_id, $user_id)
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'mv_seller_products_data';

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
function insert_product_data_into_table($product_id, $seller_id, $regular_price, $sale_price, $from_sale_date, $to_sale_date, $stock, $min_stock, $sold_individually, $status ,$action)
{
    global $wpdb;
    if (empty($action)) {
        $action = 'insert'; // مقدار پیش‌فرض برای اکشن
    }
    $table_name = $wpdb->prefix . 'mv_seller_products_data';

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

    if ($action === 'edit') {
        // اگر اکشن edit بود، بروزرسانی رکورد
        $where = array(
            'product_id' => $product_id,
            'seller_id' => $seller_id
        );
        $where_format = array(
            '%d', // product_id
            '%d'  // seller_id
        );
        $wpdb->update($table_name, $data, $where, $format, $where_format);

        // بررسی موفقیت عملیات بروزرسانی
        if ($wpdb->last_error) {
            return $wpdb->last_error; // بازگرداندن خطا در صورت وجود
        } else {
            return $wpdb->rows_affected; // بازگرداندن تعداد رکوردهای بروزرسانی شده
        }
    } else {
        // اگر اکشن insert بود، افزودن رکورد جدید
        $wpdb->insert($table_name, $data, $format);

        // بررسی موفقیت عملیات افزودن
        if ($wpdb->last_error) {
            return $wpdb->last_error; // بازگرداندن خطا در صورت وجود
        } else {
            return $wpdb->insert_id; // بازگرداندن ID رکورد افزوده شده
        }
    }
}
function mv_template_part( $template ) {
    require MV_DIR_PATH . '/templates/' . $template . '.php';
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
        return esc_html($store_data[$meta_field]);
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
function mv_seller_info_meta($seller_id, $seller_data, $meta_field) {
    $seller_id = intval($seller_id);
    
    $seller_data = sanitize_text_field($seller_data);
    $meta_field = sanitize_text_field($meta_field);
    
    $valid_meta_fields = array('seller_email', 'seller_phone', 'seller_national_code', 'seller_last_name', 'seller_first_name');
    if (!in_array($meta_field, $valid_meta_fields)) {
        return;
    }
    
    $current_seller_data = get_user_meta($seller_id, 'mv_seller_data', true);
    
    if (!is_array($current_seller_data)) {
        $current_seller_data = array();
    }

    $current_seller_data[$meta_field] = $seller_data;

    $data_check = update_user_meta($seller_id, 'mv_seller_data', $current_seller_data);
    return $data_check;

}
function mv_get_seller_data($seller_id, $meta_field) {
    $seller_id = intval($seller_id);

    $meta_field = sanitize_text_field($meta_field);

    $valid_meta_fields = array('seller_email', 'seller_phone', 'seller_national_code', 'seller_last_name', 'seller_first_name');
    

    $seller_data = get_user_meta($seller_id, 'mv_seller_data', true);

    if (!is_array($seller_data)) {
        $seller_data = array();
    }

    if (isset($seller_data[$meta_field]) && !empty($seller_data[$meta_field])) {
        return esc_html($seller_data[$meta_field]);
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
function update_product_status($mv_id, $new_status)
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'mv_seller_products_data';

    $data = array(
        'status' => sanitize_text_field($new_status),
    );

    $where = array(
        'mv_id' => intval($mv_id),
    );

    $updated = $wpdb->update($table_name, $data, $where);

    if ($updated === false) {
        return 'خطا در به‌روزرسانی وضعیت';
    } elseif ($updated === 0) {
        return 'هیچ رکوردی به‌روزرسانی نشد';
    } else {
        return 'وضعیت با موفقیت به‌روزرسانی شد';
    }
}
