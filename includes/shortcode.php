<?php

add_shortcode('mv_seller_list', 'mv_seller_list');

function mv_seller_list()
{
    global $post;
    global $wpdb;

    $product_id = $post->ID;
    $prefix = $wpdb->prefix;
    $result = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM {$prefix}kalayadak24_multivendor_products WHERE product_id = %d",
        $product_id
    ));

    foreach ($result as $row) {
        $mv_id = $row->mv_id;
        $seller_id = $row->seller_id;
        $regular_price = $row->regular_price;
        $sale_price = $row->sale_price;
        $from_sale_date = $row->from_sale_date;
        $to_sale_date = $row->to_sale_date;
        $stock = $row->stock;

        if ($row->status == 'published' && $stock > 0) {?>
            <div class="vendor">
                <div class="right">
                    <p class="shop-title with-icon-row">
                        <?php
                        ppIcon('shop');
                        ?>
                        نام فروشگاه: <strong class="value">امیررضا</strong>
                    </p>
                    <p class="delivery with-icon-row">
                        <?php ppIcon('delivery-truck'); ?>
                        ارسال توسط کالا یدک
                    </p>
                </div>
                <div class="left">
                    <div class="price-container">
                        <?php
                        echo ppFormatPrice2(
                            $regular_price,
                            [
                                'tag' => 'p',
                                'prefix' => '<span class="title">قیمت</span>'
                            ]
                        );

                        if (is_product_on_sale($mv_id)) {
                            echo ppFormatPrice2( $sale_price, [
                                'showCurrency'   => false,
                                'tag'            => 'p',
                                'containerClass' => 'regular-price'
                            ]);
                        }
                        ?>
                    </div>
                    <button type="button" data-product-id="<?php echo $product_id ?>" data-seller-id="<?php echo $seller_id; ?>" class="btn yellow add-to-cart-btn">
                        افزودن به سبد خرید
                    </button>
                </div>
            </div>
<?php
        };
    };
};
