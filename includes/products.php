<?php
global $wpdb;




if (isset($_GET['action']) && isset($_GET['mv_id'])) {

    if ($_GET['action'] == 'edit') {
        $mv_id = $_GET['mv_id'];
        $table_name = $wpdb->prefix . 'mv_seller_products_data'; // نام جدول پیشفرض وردپرس

        $query = $wpdb->prepare(
            "SELECT * FROM $table_name WHERE mv_id= $mv_id "
        );

        $data = $wpdb->get_row($query, ARRAY_A);

        if (isset($_POST['mv_edit_panel_product'])) {
            $seller_id = isset($_POST['seller_id']) ? intval($_POST['seller_id']) : 0;
            $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
            $regular_price = isset($_POST['mv_regular_price']) ? floatval($_POST['mv_regular_price']) : 0.0;
            $sale_price = isset($_POST['mv_sale_price']) ? floatval($_POST['mv_sale_price']) : 0.0;
            $from_sale_date = isset($_POST['mv_from_sale_date']) ? sanitize_text_field($_POST['mv_from_sale_date']) : '';
            $to_sale_date = isset($_POST['mv_to_sale_date']) ? sanitize_text_field($_POST['mv_to_sale_date']) : '';
            $stock = isset($_POST['mv_stock']) ? intval($_POST['mv_stock']) : 0;
            $min_stock = isset($_POST['mv_min_stock']) ? intval($_POST['mv_min_stock']) : 0;
            $status = 'published';
            $sold_individually = isset($_POST['mv_sold_individually']) ? sanitize_text_field($_POST['mv_sold_individually']) : 'no';
            $action = $_GET['action'];
            insert_product_data_into_table($product_id, $seller_id, $regular_price, $sale_price, $from_sale_date, $to_sale_date, $stock, $min_stock, $sold_individually, $status , $action);
        }

?>
        <form id="add_product_form" method="POST">
            <input type="hidden" name="mv_edit_panel_product">
            <input type="hidden" name="seller_id" value="<?= $data['seller_id']; ?>">

            <input type="hidden" name="product_id" value="<?= $data['product_id']; ?>">

            <div class=" grid grid-cols-2 gap-4 mb-5">
            <div>
                <label for="mv_regular_price" class="text-secondary text-xs mb-2.5 block">قیمت محصول</label>
                <input type="text" name="mv_regular_price" id="mv_regular_price" value="<?= $data['regular_price']; ?>" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
            </div>
            <div>
                <div class="flex-cb text-xs mb-2.5">
                    <label for="mv_sale_price" class="text-secondary">قیمت فروش ویژه محصول</label>
                    <button type="button" id="toggle-sale-schedule" class="text-blue-600 underline">زمان بندی فروش</button>
                </div>
                <input type="text" name="mv_sale_price" value="<?= $data['sale_price']; ?>" id="mv_sale_price" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
            </div>
            <div class="sale-date-fields hidden">
                <label for="mv_from_sale_date" class="text-secondary text-xs mb-2.5 block">تاریخ شروع فروش ویژه</label>
                <input type="text" name="mv_from_sale_date" value="<?= $data['from_sale_date']; ?>" id="mv_from_sale_date" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
            </div>
            <div class="sale-date-fields hidden">
                <label for="mv_to_sale_date" class="text-secondary text-xs mb-2.5 block">تاریخ پایان فروش ویژه</label>
                <input type="text" name="mv_to_sale_date" value="<?= $data['to_sale_date']; ?>" id="mv_to_sale_date" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
            </div>
            <div>
                <label for="mv_stock" class="text-secondary text-xs mb-2.5 block">موجودی محصول</label>
                <input type="text" name="mv_stock" id="mv_stock" value="<?= $data['stock']; ?>" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
            </div>
            <div>
                <label for="mv_min_stock" class="text-secondary text-xs mb-2.5 block">حداقل موجودی محصول</label>
                <input type="text" name="mv_min_stock" value="<?= $data['min_stock']; ?>" id="mv_min_stock" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
            </div>
            <div class="col-span-full flex-cc gap-2">
                <label for="mv_sold_individually" class="text-secondary text-xs">تک فروشی محصول</label>
                <input type="checkbox" name="mv_sold_individually" id="mv_sold_individually" value="yes">
            </div>
            </div>
            <button type="submit" id="add_product_submit" product-id="" user-id="" class="!bg-primary !text-secondary block rounded-full py-3 font-bold w-full">ثبت محصول</button>
        </form>
    <?php
        return;
    } else {
        $action = $_GET['action'];
        switch ($action) {
            case 'published':
                update_product_status($_GET['mv_id'], $action);
                break;
            case 'pending':
                update_product_status($_GET['mv_id'], $action);
                break;
            case 'rejected':
                update_product_status($_GET['mv_id'], $action);
                break;
            case 'quited':
                update_product_status($_GET['mv_id'], $action);
                break;
        }
    }
}
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
            'rejected' => 'rejected',
            'default' => 'all_products',
        ];
        $search = isset($_GET['s']) ? trim($_GET['s']) : '';
        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'default';
        $value_name = $meta_key_map[$tab];

        $query_where = "WHERE status ";
        $query_prepared_args = [];

        if ($tab == 'default') {
            $query_where .= "IN (%s, %s, %s)";
            $query_prepared_args = ['pending', 'published', 'rejected'];
        } else {
            $query_where .= "= %s";
            $query_prepared_args = [$value_name];
        }


        if (isset($_POST['filter'])) {
            global $wpdb;
            $filter = sanitize_text_field($_POST['filter']);

            switch ($filter) {
                case 'newest':
                    $query_where .= 'ORDER BY created_at DESC';
                    break;
                case 'expensive':
                    $query_where .= 'ORDER BY sale_price DESC';
                    break;
                case 'cheapest':
                    $query_where .= 'ORDER BY sale_price ASC';
                    break;
            }
        }
        if (!empty($search)) {
            $query_where .= " AND seller_id IN (SELECT ID FROM $users_table WHERE user_login LIKE %s)";
            $query_prepared_args[] = '%' . $wpdb->esc_like($search) . '%';
        }


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

                if ($item['stock'] > 0) {
                    return '<mark class="instock">موجود</mark>(' . $item["stock"] . ')';
                } else {
                    return '<mark class="outofstock">ناموجود</mark>';
                };
            case 'price':
                if (is_product_on_sale($item['mv_id'])) {
                    return '<del aria-hidden="true">' . wc_price($item['regular_price']) . '</del>
                    <ins>' . wc_price($item['sale_price']) . '</ins>';
                } else {
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

    // function column_title($item)
    // {
    //     $actions = array(
    //         'edit' => sprintf('<a href="?page=%s&action=%s&user=%s">ویرایش</a>', 'add-doctor', 'edit', $item['mv_id']),
    //         'delete' => sprintf('<a href="?page=%s&action=%s&user=%s">حذف</a>', $_REQUEST['page'], 'delete', $item['mv_id']),
    //     );

    //     $title = sprintf('<strong class="row-title">%s</strong>', $item['status']);
    //     $row_actions = $this->row_actions($actions);

    //     return $title . $row_actions;
    // }

    public function handle_row_actions($item, $column_name, $primary)
    {
        if ($primary !== $column_name) {
            return '';
        }

        $actions = array();
        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'default';


        $actions['trash'] = sprintf('<a href="?page=%s&action=%s&mv_id=%d">حذف</a>', $_REQUEST['page'], 'trash', $item['mv_id']);
        $actions['quited'] = sprintf('<a href="?page=%s&action=%s&mv_id=%d">انصراف</a>', $_REQUEST['page'], 'quited', $item['mv_id']);
        $actions['edit'] = sprintf('<a href="?page=%s&action=%s&mv_id=%d">ویرایش</a>', $_REQUEST['page'], 'edit', $item['mv_id']);
        if ($tab !== 'pending') {
            $actions['rejected'] = sprintf('<a href="?page=%s&action=%s&mv_id=%d">رد</a>', $_REQUEST['page'], 'rejected',   $item['mv_id']);
        }
        if ($tab !== 'published') {
            $actions['published'] = sprintf('<a href="?page=%s&action=%s&mv_id=%d">انتشار</a>', $_REQUEST['page'], 'published',   $item['mv_id']);
        }

        return $this->row_actions($actions);
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
        $rejected_class = ($current_tab == 'rejected') ? 'current' : '';

        echo '<ul class="subsubsub">';
        echo '<li><a href="admin.php?page=mv-products" class="' . $all_class . '">همه</a> | </li>';
        echo '<li><a href="admin.php?page=mv-products&tab=published" class="' . $published_class . '">تایید شده</a> | </li>';
        echo '<li><a href="admin.php?page=mv-products&tab=pending" class="' . $pending_class . '">در انتظار تایید</a> | </li>';
        echo '<li><a href="admin.php?page=mv-products&tab=rejected" class="' . $rejected_class . '">رد شده</a></li>';
        echo '</ul>';

        // echo '<form method="get" id="search-box">';
        // echo '<input type="hidden" name="page" value="' . $_REQUEST['page'] . '"/>';
        // echo 'جست و جو بر اساس نام محصول: <input type="text" name="s" value="' . (isset($_REQUEST['s']) ? esc_attr($_REQUEST['s']) : '') . '"/>';
        // echo '<input type="submit" name="" id="search-submit" class="button" value="جست و جو">';
        // echo '</form>';

    ?>
        <form method="POST" action="">
            <label for="filter">فیلتر بر اساس:</label>
            <select id="filter" name="filter">
                <option value="newest" <?php selected(isset($_POST['filter']) && $_POST['filter'] == 'newest'); ?>>جدیدترین</option>
                <option value="expensive" <?php selected(isset($_POST['filter']) && $_POST['filter'] == 'expensive'); ?>>گرانترین</option>
                <option value="cheapest" <?php selected(isset($_POST['filter']) && $_POST['filter'] == 'cheapest'); ?>>ارزانترین</option>
            </select>
            <button type="submit">جستجو</button>
        </form>



<?php
        echo '<form method="get" id="search-box">';
        echo '<input type="hidden" name="page" value="' . $_REQUEST['page'] . '"/>';
        echo 'جست و جو بر اساس شماره موبایل: <input type="text" name="s" value="' . (isset($_REQUEST['s']) ? esc_attr($_REQUEST['s']) : '') . '"/>';
        echo '<input type="submit" name="" id="search-submit" class="button" value="جست و جو">';
        echo '</form>';
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
