<?php
/*Template Name: Dashboard Seller */
defined( 'ABSPATH' ) || exit;

$user = wp_get_current_user();
$user_id = $user->ID;

$profile_image = 0;

$seller_wallet_total = get_user_meta(get_current_user_id(), 'seller_wallet_total', true);




?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <?php wp_head(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="flex justify-between flex-col">
    <div>
        <header class="bg-secondary py-4">
            <div class="container flex-cb">
                <span class="text-lg !text-primary font-bold">مرکز فروشندگان</span>
                <img src="<?php echo esc_attr(MV_DIR_URL . 'assets/client/img/logo.png')?>" alt="کالا یدک" width="140">
                <span id="wallet_balance" class="p-2 rounded-full border border-white text-white"><?= wc_price( $seller_wallet_total) ?></span>
            </div>
        </header>
        <div id="messages-container" class="fixed right-1/2 top-6 translate-x-1/2 z-50 flex flex-col gap-3"></div>
        <main>
            <div class="container my-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-3 pl-4 border-l">
                        <?php
                        include MV_DIR_PATH . '/templates/client/aside-menu.php';
                        ?>     
                    </div>
                    <div class="lg:col-span-9 h-fit">
                        <?php
                            if (is_dashboard_seller_endpoint('add-product')) {
                                include MV_DIR_PATH . '/templates/client/products/add-product.php';
                            } elseif(is_dashboard_seller_endpoint('products')) {
                                include MV_DIR_PATH . '/templates/client/products/products.php';
                            } elseif(is_dashboard_seller_endpoint('seller-orders')) {
                                include MV_DIR_PATH . '/templates/client/orders.php';
                            } elseif(is_dashboard_seller_endpoint('store-information')) {
                                include MV_DIR_PATH . '/templates/client/profile/store-info.php';
                            } elseif(is_dashboard_seller_endpoint('seller-information')) {
                                include MV_DIR_PATH . '/templates/client/profile/seller-info.php';
                            } elseif(is_dashboard_seller_endpoint('accounting-information')) {
                                include MV_DIR_PATH . '/templates/client/profile/accounting-info.php';
                            } elseif(is_dashboard_seller_endpoint('agreement')) {
                                include MV_DIR_PATH . '/templates/client/profile/agreement.php';
                            } elseif(is_dashboard_seller_endpoint('documents')) {
                                include MV_DIR_PATH . '/templates/client/profile/documents.php';
                            } elseif(is_dashboard_seller_endpoint('address')) {
                                include MV_DIR_PATH . '/templates/client/address.php';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer class="bg-[#333333] py-4">
        <div class="container flex items-center gap-8 text-lite-text">
            <span>ارتباط با مرکز فروشندگان پرشیا پارت</span>
            <a href="tel:02174391010">۰۲۱۷۴۳۹۱۰۱۰</a>
            <a href="emailto:sellersupport@kalayadak24.com">sellersupport@kalayadak24.com</a>
        </div>
    </footer>
</body>
<?php wp_footer(); ?>
</html>