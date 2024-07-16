<?php
defined('ABSPATH') || exit;

?>
<div>
    <div class="flex items-center gap-6 mb-7">
        <h1 class="font-bold text-secondary text-base">تاریخچه سفارشات</h1>
        <p class="text-xs">اطلاعات و جزییات مربوط به کلیه سفارش‌های خود را در این قسمت پیگیری کنید.</p>
    </div>
    <div>
        <p class="text-sm text-paragraph mb-4">جستجو و فیلتر</p>
        <div class="mb-6">
            <div class="flex items-end gap-4">
                <div class="w-1/4">
                    <label for="pro_list_cat" class="text-xxs block mb-3">وضعیت سفارش:</label>
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
                        <input type="text" id="pro_list_search_box" name="pro_list_search_box" class="bg-white rounded-3xl w-full !border-gray !pr-16" placeholder="جستجو کنید...">
                        <div class="absolute right-3 top-1/2 -translate-y-1/2">
                            <span class="border-l border-lite-gray pl-4 block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 19 19" fill="none"><path d="M18.3 17.3481L13.7 13.3301C15.1 11.9581 16 10.0961 16 7.9401C16 3.6281 12.4 0.100098 8 0.100098C3.6 0.100098 0 3.6281 0 7.9401C0 12.2521 3.6 15.7801 8 15.7801C9.9 15.7801 11.6 15.0941 13 14.0161L17.7 18.0341L18.3 17.3481ZM1 7.9401C1 4.1181 4.1 1.0801 8 1.0801C11.9 1.0801 15 4.1181 15 7.9401C15 11.7621 11.9 14.8001 8 14.8001C4.1 14.8001 1 11.7621 1 7.9401Z" fill="#606060" /></svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="flex items-stretch gap-4 flex-wrap">
                <div class="w-1/4">
                    <label for="" class="text-xxs mb-3 block">از تاریخ:</label>
                    <input type="text" class="w-full px-3 py-2.5 rounded-3xl !border-gray">
                </div>
                <div class="w-1/4">
                    <label for="" class="text-xxs mb-3 block">تا تاریخ:</label>
                    <input type="text" class="w-full px-3 py-2.5 rounded-3xl !border-gray">
                </div>
            </div>
        </div>
        <hr class="border-gray my-5">
        <div class="flex-cb mb-6">
            <a href="/dashboard-seller/add-product/" class="text-paragraph text-xs btn-flex bg-white border border-[#39B54A] rounded-full py-2.5 px-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M0 17.781C0 12.5858 0 7.40895 0 2.22164C3.84044 1.48022 7.67565 0.741418 11.5239 0C11.5239 6.66754 11.5239 13.3246 11.5239 20C7.68348 19.2612 3.84305 18.5224 0 17.781ZM9.37003 13.9146C9.33871 13.8598 9.32043 13.8207 9.29954 13.7867C8.55025 12.5571 7.80096 11.3301 7.04645 10.1031C6.99163 10.0117 6.98902 9.9517 7.04645 9.86033C7.77747 8.65944 8.50326 7.45856 9.22905 6.25506C9.25516 6.21329 9.27605 6.16891 9.30999 6.11147C8.66513 6.11147 8.04638 6.10886 7.43024 6.11408C7.38846 6.11408 7.33103 6.16108 7.30753 6.20024C7.14044 6.50046 6.97596 6.80329 6.81932 7.10873C6.48514 7.75617 6.08047 8.37228 5.87161 9.07975C5.87161 9.08237 5.85856 9.08498 5.85856 9.08498C5.77762 8.87613 5.71235 8.66467 5.61837 8.46365C5.26591 7.71179 4.90563 6.96515 4.55317 6.21329C4.51662 6.13236 4.47224 6.10886 4.38608 6.10886C3.75428 6.11147 3.12509 6.11147 2.49328 6.11147C2.45673 6.11147 2.42018 6.11408 2.36535 6.11931C2.40451 6.18718 2.43323 6.23939 2.46195 6.29161C3.15903 7.48727 3.85349 8.68294 4.55317 9.87339C4.61844 9.98303 4.61061 10.0561 4.54273 10.1606C3.77517 11.3562 3.01021 12.5571 2.24787 13.7554C2.21915 13.8024 2.19043 13.8494 2.15388 13.9094C2.19304 13.912 2.21393 13.9146 2.23481 13.9146C2.87445 13.9146 3.51409 13.9172 4.15373 13.912C4.20072 13.912 4.26338 13.8676 4.28688 13.8259C4.49052 13.4578 4.69416 13.0871 4.88474 12.7111C5.18759 12.1081 5.58443 11.5468 5.76979 10.8837C5.76979 10.8811 5.78023 10.8785 5.76979 10.8837C5.84811 11.0847 5.90816 11.2883 6.00476 11.4763C6.40943 12.2569 6.82454 13.0296 7.23182 13.8076C7.2762 13.8937 7.33103 13.9199 7.42501 13.9172C8.02549 13.912 8.62597 13.9146 9.22644 13.9146C9.26821 13.9146 9.30999 13.9146 9.37003 13.9146Z" fill="#39B54A"/><path d="M12.3203 2.30273C12.3751 2.30273 12.4221 2.30273 12.4691 2.30273C14.7353 2.30273 17.0014 2.30273 19.2702 2.30273C19.7427 2.30273 20.0012 2.5638 20.0012 3.03893C20.0012 7.68584 20.0012 12.3301 20.0012 16.9771C20.0012 17.4261 19.7375 17.6924 19.2884 17.6924C17.0119 17.6924 14.7379 17.6924 12.4613 17.6924C12.4195 17.6924 12.3751 17.6924 12.3229 17.6924C12.3229 16.9222 12.3229 16.1652 12.3229 15.3898C13.0827 15.3898 13.8424 15.3898 14.61 15.3898C14.61 14.8677 14.61 14.3638 14.61 13.8417C13.8476 13.8417 13.0879 13.8417 12.3203 13.8417C12.3203 13.3248 12.3203 12.8236 12.3203 12.3067C13.0853 12.3067 13.8424 12.3067 14.6126 12.3067C14.6126 11.7897 14.6126 11.2885 14.6126 10.7664C13.8502 10.7664 13.0879 10.7664 12.3203 10.7664C12.3203 10.2495 12.3203 9.75085 12.3203 9.23394C13.0827 9.23394 13.845 9.23394 14.6152 9.23394C14.6152 8.71182 14.6152 8.20797 14.6152 7.69107C13.8528 7.69107 13.0931 7.69107 12.3229 7.69107C12.3229 7.17677 12.3229 6.67553 12.3229 6.16124C13.0957 6.16124 13.8633 6.16124 14.6387 6.16124C14.6387 5.6365 14.6387 5.12743 14.6387 4.60008C13.8685 4.60008 13.1009 4.60008 12.3229 4.60008C12.3203 3.83256 12.3203 3.07287 12.3203 2.30273ZM18.4556 7.6989C17.4244 7.6989 16.4088 7.6989 15.3906 7.6989C15.3906 8.2158 15.3906 8.71965 15.3906 9.22872C16.4192 9.22872 17.4348 9.22872 18.4556 9.22872C18.4556 8.71443 18.4556 8.21058 18.4556 7.6989ZM15.388 13.8495C15.388 14.3612 15.388 14.8677 15.388 15.3767C16.4166 15.3767 17.4348 15.3767 18.453 15.3767C18.453 14.8625 18.453 14.3612 18.453 13.8495C17.4296 13.8495 16.414 13.8495 15.388 13.8495ZM18.453 12.304C18.453 11.7897 18.453 11.2859 18.453 10.7742C18.4191 10.7716 18.3956 10.7664 18.3695 10.7664C17.4087 10.7664 16.4479 10.7664 15.4846 10.7638C15.3932 10.7638 15.3775 10.8003 15.3775 10.8786C15.3801 11.3224 15.3775 11.7663 15.3801 12.2101C15.3801 12.2388 15.388 12.2675 15.3906 12.304C16.414 12.304 17.4296 12.304 18.453 12.304ZM18.4556 4.62358C18.4295 4.61836 18.4164 4.61314 18.4034 4.61314C17.4296 4.61314 16.4532 4.61314 15.4793 4.61053C15.3801 4.61053 15.3775 4.66013 15.3801 4.73323C15.3827 5.1196 15.3801 5.50858 15.3801 5.89495C15.3801 5.97588 15.3801 6.05681 15.3801 6.14035C16.4166 6.14035 17.4348 6.14035 18.4556 6.14035C18.4556 5.62867 18.4556 5.13004 18.4556 4.62358Z" fill="#39B54A"/></svg>
                <span>دریافت فایل اکسل</span>
            </a>
            <p class="text-sm">
                <span>تعداد نتایج:</span>
                <span><?= $total_count?> مورد</span>
            </p>
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
        <table class="border-collapse table-fixed w-full">
            <thead class="max-lg:hidden">
                <tr>
                    <th class="w-1/12 border-b p-3 border-slate-400 text-center">ردیف</th>
                    <th class="w-2/12 border-b p-3 border-slate-400 text-center">کد سفارش</th>
                    <th class="w-2/12 border-b p-3 border-slate-400 text-center">تاریخ ثبت‌ سفارش</th>
                    <th class="w-2/12 border-b p-3 border-slate-400 text-center">وضعیت</th>
                    <th class="w-2/12 border-b p-3 border-slate-400 text-center">مجموع</th>
                    <th class="w-2/12 border-b p-3 border-slate-400"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="even:bg-back/30 border-b last:border-b-0">
                    <td class="p-3 text-center font-light" data-label="ردیف">1</td>
                    <td class="p-3 text-center" data-label="کد سفارش">#35325</td>
                    <td class="p-3 text-center" data-label="تاریخ ثبت‌ سفارش">1403/5/2</td>
                    <td class="p-3 text-center" data-label="وضعيت"><span class="w-full block rounded-full py-2 text-center text-green-700 bg-green-700/25">تکمیل شده</span></td>
                    <td class="p-3 text-center" data-label="مجموع">140,000 تومان</td>
                    <td class="p-3"><a href="#" class="bg-secondary w-full block rounded-full text-center text-white py-2">نمایش</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>