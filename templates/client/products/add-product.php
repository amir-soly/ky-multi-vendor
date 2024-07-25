<?php
defined('ABSPATH') || exit;
?>
<div>
    <h1 class="font-bold text-secondary mb-4 text-base">جستجو یا درج محصول</h1>
    <p class="text-xs mb-5">محصولی که قصد فروش آن را دارید، جستجو کنید. در غیر این‌صورت از "ایجاد کالای جدید" اقدام به درج کالای خود کنید</p>
    <div class="bg-back p-5 rounded-3xl mb-9">
        <p class="mb-4 text-xs">جستجوی کالا در میان کالاهای دیجی‌کالا بر اساس:</p>
        <form id="mv_search_prodcu_form" class="flex gap-4">
            <div class="w-3/4 relative">
                <input type="text" id="mv_product_search" name="mv_product_search" class="bg-white rounded-full w-full border-none py-2.5 !pr-16" placeholder="نام محصول">
                <div class="absolute right-3 top-1/2 -translate-y-1/2">
                    <span class="border-l border-lite-gray pl-4 block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 19 19" fill="none"><path d="M18.3 17.3481L13.7 13.3301C15.1 11.9581 16 10.0961 16 7.9401C16 3.6281 12.4 0.100098 8 0.100098C3.6 0.100098 0 3.6281 0 7.9401C0 12.2521 3.6 15.7801 8 15.7801C9.9 15.7801 11.6 15.0941 13 14.0161L17.7 18.0341L18.3 17.3481ZM1 7.9401C1 4.1181 4.1 1.0801 8 1.0801C11.9 1.0801 15 4.1181 15 7.9401C15 11.7621 11.9 14.8001 8 14.8001C4.1 14.8001 1 11.7621 1 7.9401Z" fill="#606060" /></svg>
                    </span>
                </div>
            </div>
            <button name="mv_search_submit" id="mv_search_submit" class="bg-secondary text-white rounded-full py-2.5 w-1/4">جستجو</button>
        </form>
    </div>
    <div id="product_results_container" class="hidden">
        <div class="flex-cb">
            <h3 class="text-secondary font-bold text-base">نتایج جستجو</h3>
            <p class="text-sm">
                <span>تعداد نتایج:</span>
                <span id="results_count">مورد</span>
            </p>
        </div>
        <hr class="border-gray my-5">
        <div id="product_results"></div>
    </div>
</div>
<div>
    <div id="modal-product-info" class="transition-all z-50 fixed-center fixed w-full h-fit max-w-3xl max-lg:p-2 opacity-0 invisible">
        <div class="bg-white rounded-2.5 shadow-xl px-9 py-6 relative">
            <div class="flex-cb pb-3 border-b border-slate-300 mb-5">
                <p class="text-secondary font-bold">همین کالا را می فروشید؟</p>
                <button class="close-modal-product-info"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" viewBox="0 0 18 22" fill="none"><path d="M17 1L1 21" stroke="#606060"/><path d="M1.5 1L17.5 21" stroke="#606060"/></svg></button>
            </div>
            <div>
                <p class="text-black mb-6">اگر مشخصات این کالا با کالای شما منطبق است می توانید این کالا را بفروشید.</p>
                <div class="flex items-center gap-4">
                    <img src="" alt="" width="80">
                    <div>
                        <table class="text-xxs table-fixed">
                            <tr>
                                <td class="font-bold px-2 py-1">عنوان کالا</td>
                                <td id="popup-title" class="px-2 py-1"></td>
                            </tr>
                            <tr>
                                <td class="font-bold px-2 py-1">کد کالا (DKP)</td>
                                <td id="popup-sku" class="px-2 py-1"></td>
                            </tr>
                            <tr>
                                <td class="font-bold px-2 py-1">قیمت مرجع</td>
                                <td id="popup-price" class="px-2 py-1"></td>
                            </tr>
                            <tr>
                                <td class="font-bold px-2 py-1">کمیسیون</td>
                                <td id="popup-commission" class="px-2 py-1"></td>
                            </tr>
                            <tr>
                                <td class="font-bold px-2 py-1">برند</td>
                                <td id="popup-brand" class="px-2 py-1"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <hr class="border-slate-300 my-3">
            <div class="flex items-center justify-end gap-2.5">
                <button class="close-modal-product-info !bg-lite-gray !text-secondary block rounded-full py-2.5 px-10 font-bold">بازگشت</button>
                <button class="!bg-primary !text-secondary block rounded-full py-2.5 px-4 font-bold sale-this">فروش همین کالا</button>
            </div>
        </div>
    </div>
    <div id="modal-add-product" class="transition-all z-50 fixed-center fixed w-full h-fit max-w-3xl max-lg:p-2 opacity-0 invisible">
        <div class="bg-white rounded-2.5 shadow-xl px-9 py-6 relative">
            <div class="flex-cb pb-3 border-b border-slate-300 mb-5">
                <p class="text-secondary font-bold">ثبت اطلاعات محصول</p>
                <button id="close-modal-add-product">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" viewBox="0 0 18 22" fill="none">
                        <path d="M17 1L1 21" stroke="#606060"/>
                        <path d="M1.5 1L17.5 21" stroke="#606060"/>
                    </svg>
                </button>
            </div>
            <form id="add_product_form">
                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <label for="mv_regular_price" class="text-secondary text-xs mb-2.5 block">قیمت محصول</label>
                        <input type="text" name="mv_regular_price" id="mv_regular_price" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
                    </div>
                    <div>
                        <div class="flex-cb text-xs mb-2.5">
                            <label for="mv_sale_price" class="text-secondary">قیمت فروش ویژه محصول</label>
                            <button type="button" id="toggle-sale-schedule" class="text-blue-600 underline">زمان بندی فروش</button>
                        </div>
                        <input type="text" name="mv_sale_price" id="mv_sale_price" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
                    </div>
                    <div class="sale-date-fields hidden">
                        <label for="mv_from_sale_date" class="text-secondary text-xs mb-2.5 block">تاریخ شروع فروش ویژه</label>
                        <input type="text" name="mv_from_sale_date" id="mv_from_sale_date" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
                    </div>
                    <div class="sale-date-fields hidden">
                        <label for="mv_to_sale_date" class="text-secondary text-xs mb-2.5 block">تاریخ پایان فروش ویژه</label>
                        <input type="text" name="mv_to_sale_date" id="mv_to_sale_date" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
                    </div>
                    <div>
                        <label for="mv_stock" class="text-secondary text-xs mb-2.5 block">موجودی محصول</label>
                        <input type="text" name="mv_stock" id="mv_stock" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
                    </div>
                    <div>
                        <label for="mv_min_stock" class="text-secondary text-xs mb-2.5 block">حداقل موجودی محصول</label>
                        <input type="text" name="mv_min_stock" id="mv_min_stock" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
                    </div>
                    <div class="col-span-full flex-cc gap-2">
                        <label for="mv_sold_individually" class="text-secondary text-xs">تک فروشی محصول</label>
                        <input type="checkbox" name="mv_sold_individually" id="mv_sold_individually" value="yes">
                    </div>
                </div>
                <button type="submit" id="final_submit_add" product-id="" user-id="" class="!bg-primary !text-secondary block rounded-full py-3 font-bold w-full">ثبت محصول</button>
            </form>
        </div>
    </div>
    <div id="overlay-modal-product" class="transition-all fixed inset-0 z-40 backdrop-blur-sm bg-slate-900/75 opacity-0 invisible"></div>
</div>