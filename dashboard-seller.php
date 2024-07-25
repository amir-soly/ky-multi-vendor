<?php
/*Template Name: Dashboard Seller */
defined( 'ABSPATH' ) || exit;

$user = wp_get_current_user();
$user_id = $user->ID;

$profile_image = 0;
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <?php wp_head(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="messages-container" class="fixed right-1/2 top-6 translate-x-1/2 z-50 flex flex-col gap-3"></div>
    <main>
        <div class="container my-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-3">
 
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
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>
<?php wp_footer(); ?>
</html>