<?php
defined('ABSPATH') || exit;


global $wpdb;

$seller_id = get_current_user_id();

$result = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}mv_seller_products_list WHERE seller_id = %d", $seller_id));
$total_count = count($result);

$product_categories = get_terms(array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false, // نمایش دسته‌بندی‌های خالی نیز
));


?>
<div>
    <div class="flex items-center gap-6 mb-7">
        <h1 class="font-bold text-secondary text-base">مدیریت محصولات</h1>
        <p class="text-xs">برای ویرایش و مدیریت مشخصات، گروه، تصویر محصولات و درج تنوع (گارانتی، به همراه رنگ یا سایز) از این قسمت استفاده نمایید</p>
    </div>
    <div>
        <p class="text-sm text-paragraph mb-4">جستجو و فیلتر</p>
        <div class="mb-6">
            <div class="flex items-end gap-4">
                <div class="w-1/4">
                    <label for="pro_list_cat" class="text-xxs block mb-3">گروه کالایی:</label>
                    <select name="pro_list_cat" id="pro_list_cat" class="w-full px-3 py-2.5 rounded-3xl !border-gray appearance-select">
                        <option value="">انتخاب کنید</option>
                        <?php 

                        foreach ($product_categories as $category ) {
                            echo '<option value="'.esc_html($category->term_id).'">'.esc_html($category->name).'</option>';
                        };
                   
                        ?>
                    </select>
                </div>
                <div class="w-3/4">
                    <div class="relative">
                        <input type="text" id="pro_list_search_box" name="pro_list_search_box" class="bg-white rounded-3xl w-full !border-gray !pr-16" placeholder="نام محصول">
                        <div class="absolute right-3 top-1/2 -translate-y-1/2">
                            <span class="border-l border-lite-gray pl-4 block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 19 19" fill="none">
                                    <path d="M18.3 17.3481L13.7 13.3301C15.1 11.9581 16 10.0961 16 7.9401C16 3.6281 12.4 0.100098 8 0.100098C3.6 0.100098 0 3.6281 0 7.9401C0 12.2521 3.6 15.7801 8 15.7801C9.9 15.7801 11.6 15.0941 13 14.0161L17.7 18.0341L18.3 17.3481ZM1 7.9401C1 4.1181 4.1 1.0801 8 1.0801C11.9 1.0801 15 4.1181 15 7.9401C15 11.7621 11.9 14.8001 8 14.8001C4.1 14.8001 1 11.7621 1 7.9401Z" fill="#606060" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="flex items-stretch gap-4 flex-wrap">
               
                <!-- <div class="w-1/4">
                    <label for="" class="text-xxs mb-3 block">وضعیت تایید کالا:</label>
                    <select name="" id="" class="w-full px-3 py-2.5 rounded-3xl !border-gray appearance-select">
                        <option value="">انتخاب کنید</option>
                    </select>
                </div>
                <div>
                    <label for="" class="text-xxs mb-3 block">اصالت کالا:</label>
                    <div class="btn-flex">
                        <button class="px-6 py-2.5 rounded-3xl border border-gray transition-all hover:bg-primary hover:text-secondary hover:border-primary">همه کالاها</button>
                        <button class="px-6 py-2.5 rounded-3xl border border-gray transition-all hover:bg-primary hover:text-secondary hover:border-primary">اصل</button>
                        <button class="px-6 py-2.5 rounded-3xl border border-gray transition-all hover:bg-primary hover:text-secondary hover:border-primary">غیر اصل</button>
                    </div>
                </div> -->
            </div>
        </div>
        <hr class="border-gray my-5">
        <div class="flex-cb mb-6">
            <a href="/dashboard-seller/add-product/" class="text-secondary font-bold text-xs btn-flex bg-[#D5F7D9] rounded-3xl py-2.5 px-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M1 8H15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/><path d="M8 1L8 15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/></svg>
                <span>افزودن کالای جدید</span>
            </a>
            <div class="flex items-center gap-5">
                <p class="text-sm">
                    <span>تعداد نتایج:</span>
                    <span><?= $total_count?> مورد</span>
                </p>
                <div class="btn-flex">
                    <label for="">نمایش</label>
                    <select name="" id="" class="pr-4 pl-8 py-2 rounded-3xl !border-gray text-xs appearance-select">
                        <option value="">جدیدترین</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- <table class="border-collapse table-fixed w-full">
            <thead class="max-lg:hidden">
                <tr>
                    <th class="px-2 w-1/12"><span class="w-full block border border-gray text-center py-2 rounded-full">ردیف</span></th>
                    <th class="px-2 w-5/12"><span class="w-full block border border-gray text-center py-2 rounded-full">عنوان</span></th>
                    <th class="px-2 w-3/12"><span class="w-full block border border-gray text-center py-2 rounded-full">دسته بندی</span></th>
                    <th class="px-2 w-2/12"><span class="w-full block border border-gray text-center py-2 rounded-full">وضعيت</span></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="p-2 text-center" data-label="ردیف">1</td>
                    <td class="p-2" data-label="عنوان">
                        <div class="flex-cb gap-4">
                            <img src="http://persiapartstore.test/wp-content/uploads/2023/05/01.Siemens-BSM-1669202183-min.jpg" alt="" width="45" class="rounded-md">
                            <p>روغن موتور بی‌ ام‌ و TwinPower Turbo Silver | گارانتی اصالت و سلامت فیزیکی کالا</p>
                        </div>
                    </td>
                    <td class="p-2 text-center" data-label="دسته بندی">روغن و مکمل</td>
                    <td class="p-2 text-center" data-label="وضعيت">تایید شده</td>
                    <td class="p-2"><a href="#" class="bg-secondary w-full block rounded-full text-center text-white py-2">ویرایش</a></td>
                </tr>
            </tbody>
        </table> -->
        <div class="relative">
            <table class="border-collapse table-fixed w-full" id="products_table">
                <thead class="max-lg:hidden">
                    <tr>
                        <th class="w-1/12 border-b p-3 border-slate-400 text-center">ردیف</th>
                        <th class="w-5/12 border-b p-3 border-slate-400 text-center">عنوان</th>
                        <th class="w-2/12 border-b p-3 border-slate-400 text-center">دسته بندی</th>
                        <th class="w-2/12 border-b p-3 border-slate-400 text-center">وضعیت</th>
                        <th class="w-2/12 border-b p-3 border-slate-400"></th>
                    </tr>
                </thead>
                <tbody id="products_list">
                    <?php
                    $counter = 1;
                    foreach ($result as $row) {
                        $product_id = $row->product_id;
                        $status='';
                        switch ($row->status) {
                            case 'pending':
                                $status = 'در انتظار تایید' ;
                                break;
                            case 'published':
                                $status = 'تایید شده' ;
                                break;
                            case 'rejected':
                                $status = 'رد شده' ;
                                break;
                        }
    
                        $url = add_query_arg(
                            array(
                                'action' => 'edit',
                                'seller' => $row->seller_id,
                                'product' => $row->product_id,
                            ),
                            home_url('dashboard-seller/add-product')
                        );
                        
                        ?>
                        <tr class="even:bg-back/30 border-b last:border-b-0">
                            <td class="p-3 text-center font-light" data-label="ردیف"><?= $counter++;?></td>
                            <td class="p-3" data-label="عنوان">
                                <div class="flex-cb gap-4">
                                    <img src="<?= get_the_post_thumbnail_url($product_id, 'thumbnail'); ?>" alt="" width="45" class="rounded-md">
                                    <p><?= get_the_title($product_id) ?></p>
                                </div>
                            </td>
                            <td class="p-3 text-center" data-label="دسته بندی"><?= wc_get_product_category_list($product_id);?>
                            </td>
                            <td class="p-3 text-center" data-label="وضعيت"><span class="w-full block rounded-full py-2 text-center text-green-700 bg-green-700/25"><?= $status ?></span></td>
                            <td class="p-3"><a href="<?= get_permalink($product_id); ?>" class="bg-secondary w-full block rounded-full text-center text-white py-2">ویرایش</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div id="loader" class="transition-all absolute inset-0 w-full h-full backdrop-blur-sm flex-cc z-10 text-black opacity-0 invisible">
                <span><svg class="animate-spin mx-auto" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 12a9 9 0 11-6.219-8.56"></path> </g></svg></span>
            </div>
        </div>
    </div>
</div>