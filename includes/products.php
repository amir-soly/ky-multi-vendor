<?php
global $wpdb;


class doctors_List_Table extends WP_List_Table
{
    // تعیین ستون‌های جدول
    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'thumb' => '<span class="wc-image tips">تصویر</span>',
            'seller' => 'فروشنده',
            'product_name' => 'عنوان محصول',
            'sku' => 'شناسه',
            'stock' => 'موجودی',
            'price' => 'قیمت',
            'terms' => 'دسته بندی',

        );
        return $columns;
    }

    // دریافت داده‌ها از دیتابیس
    function prepare_items()
    {
        global $wpdb;
        $users_table = $wpdb->prefix . 'users';

        $table_name = $wpdb->prefix . 'mv_seller_products_data'; // نام جدول پیشفرض وردپرس
        $meta_key_map = [
            'published' => 'published',
            'pending' => 'pending',
            'deleted' => 'deleted',
            'default' => 'all_products',
        ];

        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'default';
        $value_name = $meta_key_map[$tab];

        $query_where = "WHERE status ";
        $query_prepared_args = [];

        if ($tab == 'default') {
            $query_where .= "IN (%s, %s, %s)";
            $query_prepared_args = ['pending', 'published', 'deleted'];
        } else {
            $query_where .= "= %s";
            $query_prepared_args = [$value_name];
        }

        // if ( ! empty( $search ) ) {
        // 	$query_where .= " AND seller_id IN (SELECT ID FROM $users_table WHERE user_login LIKE %s)";
        // 	$query_prepared_args[] = '%' . $wpdb->esc_like( $search ) . '%';
        // }


        $per_page = 10; // تعداد آیتم‌ها در هر صفحه

        $columns = $this->get_columns();
        $hidden = array(); // ستون‌های مخفی
        $sortable = array(); // ستون‌های قابل مرتب‌سازی

        $this->_column_headers = array($columns, $hidden, $sortable);

        // بررسی وجود صفحه فعلی
        $current_page = $this->get_pagenum();


        $query = $wpdb->prepare(
            "SELECT * FROM $table_name $query_where",
            $query_prepared_args,
        );

        $data = $wpdb->get_results($query, ARRAY_A);

        $this->items = $data;

        // تنظیمات صفحه‌بندی و تعداد آیتم‌ها در هر صفحه
        $total_items = count($data);
        $this->set_pagination_args(array(
            'total_items' => $total_items,
            'per_page' => $per_page,
        ));
        $this->set_items_per_page($per_page);
    }



    // تعیین محتوای هر سلول
    function column_default($item, $column_name)
    {
        $product_id = $item['product_id'];
        switch ($column_name) {
            case 'thumb':
                $src = get_the_post_thumbnail_url($product_id, 'thumbnail');
                if ($src) {
                    return '<a href="#"><img src="' . $src . '" width="40px" height="40px" class="attachment-thumbnail size-thumbnail" alt="" decoding="async" loading="lazy" srcset="' . $src . '" sizes="(max-width: 40px) 100vw, 40px" /></a>';
                } else {
                    return '<a href="#"><img src="' . wc_placeholder_img_src() . '" width="40px" height="40px" class="attachment-thumbnail size-thumbnail" alt="" decoding="async" loading="lazy" srcset="' . wc_placeholder_img_src() . '" sizes="(max-width: 40px) 100vw, 40px" /></a>';
                };

            case 'product_name':
                return get_the_title($product_id);
            case 'seller':
                return get_the_author_meta('display_name', $item['seller_id']);
            case 'sku':
                $wc_product = wc_get_product($product_id);
                return $wc_product->get_sku();
            case 'stock':

                if($item['stock'] > 0){
                    return '<mark class="instock">موجود</mark>('.$item["stock"].')';
                }else{
                    return '<mark class="outofstock">ناموجود</mark>';

                };
            case 'price':
                if(is_product_on_sale($item['mv_id'])){
                    return'<del aria-hidden="true">' . wc_price($item['regular_price']) . '</del>
                    <ins>' . wc_price($item['sale_price']). '</ins>';
                }else{
                    return  wc_price($item['regular_price']);
                }
            case 'terms':
                return wc_get_product_category_list($product_id);

            default:
                return print_r($item, true);
        }
    }

    // نمایش ستون عملیات
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />',
            $item['mv_id']
        );
    }

    function column_title($item)
    {
        $actions = array(
            'edit' => sprintf('<a href="?page=%s&action=%s&user=%s">ویرایش</a>', 'add-doctor', 'edit', $item['mv_id']),
            'delete' => sprintf('<a href="?page=%s&action=%s&user=%s">حذف</a>', $_REQUEST['page'], 'delete', $item['mv_id']),
        );

        $title = sprintf('<strong class="row-title">%s</strong>', $item['status']);
        $row_actions = $this->row_actions($actions);

        return $title . $row_actions;
    }




    // تابع نمایش جدول
    function show_doctors_table()
    {

        echo '<style>
        mark.instock {    
    font-weight: 700;
    background: transparent none;
    line-height: 1;
     color: #7ad03a;}
        span.wc-image.tips::before {
    font-family: Dashicons;
    font-weight: 400;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    margin: 0;
    text-indent: 0;
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    text-align: center;
    content: "\f128";
}



th.manage-column.column-thumb.column-primary {
    width: 52px;
    text-align: center;
    white-space: nowrap;

}


table.wp-list-table span.wc-featured, table.wp-list-table span.wc-image {
    display: block;
    text-indent: -9999px;
    position: relative;
    height: 1em;
    width: 1em;
    margin: 0 auto;
}</style>';

        echo '<div class="wrap">';
        echo '<h1 class="wp-heading-inline">لیست محصولات فروشندگان</h1>';
        echo '<div class="content-action">';

        $current_tab = isset($_GET['tab']) ? $_GET['tab'] : '';

        $all_class = empty($current_tab) ? 'current' : '';
        $published_class = ($current_tab == 'published') ? 'current' : '';
        $pending_class = ($current_tab == 'pending') ? 'current' : '';
        $deleted_class = ($current_tab == 'deleted') ? 'current' : '';

        echo '<ul class="subsubsub">';
        echo '<li><a href="admin.php?page=mv-management" class="' . $all_class . '">همه</a> | </li>';
        echo '<li><a href="admin.php?page=mv-management&tab=published" class="' . $published_class . '">تایید شده</a> | </li>';
        echo '<li><a href="admin.php?page=mv-management&tab=pending" class="' . $pending_class . '">در انتظار تایید</a> | </li>';
        echo '<li><a href="admin.php?page=mv-management&tab=deleted" class="' . $deleted_class . '">رد شده</a></li>';
        echo '</ul>';

        // echo '<form method="get" id="search-box">';
        // echo '<input type="hidden" name="page" value="' . $_REQUEST['page'] . '"/>';
        // echo 'جست و جو بر اساس نام محصول: <input type="text" name="s" value="' . (isset($_REQUEST['s']) ? esc_attr($_REQUEST['s']) : '') . '"/>';
        // echo '<input type="submit" name="" id="search-submit" class="button" value="جست و جو">';
        // echo '</form>';
        echo '</div>';

        $table = new doctors_List_Table();
        $table->prepare_items();
        $table->views();
        echo '<form method="post">';
        $table->display();
        echo '</form>';
        echo '</div>';
    }
}

$table = new doctors_List_Table();

$table->show_doctors_table();
