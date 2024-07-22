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
<style>

    /* پس زمینه تیره برای پاپ آپ */
    #popup_overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 999;
    }

    /* باکس پاپ آپ */
    #add_product_popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        z-index: 1000;
    }

    /* استایل فیلدها */
    .row {
        margin-bottom: 15px;
    }

    .row label {
        display: block;
        margin-bottom: 5px;
    }

    .row input, .row select {
        width: calc(100% - 20px);
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* دکمه سابمیت */
    #mv_submit_product {
        display: inline-block;
        padding: 10px 20px;
        background: #0073aa;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    #mv_submit_product:hover {
        background: #005a87;
    }
</style>

<div id="popup_overlay"></div>

<div id="add_product_popup" style="display: none;">
    <div class="row">
        <label for="mv_regular_price">قیمت محصول</label>
        <input type="number" name="mv_regular_price" id="mv_regular_price">
    </div>
    <div class="row">
        <label for="mv_sale_price">قیمت فروش ویژه محصول</label>
        <input type="number" name="mv_sale_price" id="mv_sale_price">
    </div>
    <div class="row">
        <label for="mv_from_sale_date">تاریخ شروع فروش ویژه</label>
        <input type="date" name="mv_from_sale_date" id="mv_from_sale_date">
    </div>
    <div class="row">
        <label for="mv_to_sale_date">تاریخ پایان فروش ویژه</label>
        <input type="date" name="mv_to_sale_date" id="mv_to_sale_date">
    </div>
    <div class="row">
        <label for="mv_stock">موجودی محصول</label>
        <input type="number" name="mv_stock" id="mv_stock">
    </div>
    <div class="row">
        <label for="mv_min_stock">حداقل موجودی محصول</label>
        <input type="number" name="mv_min_stock" id="mv_min_stock">
    </div>
    <div class="row">
        <label for="mv_sold_individually">تک فروشی محصول</label>
        <select name="mv_sold_individually" id="mv_sold_individually">
            <option value="yes">بله</option>
            <option value="no">خیر</option>
        </select>
    </div>
    <div class="row">
        <input type="submit" value="ثبت محصول" id="mv_submit_product">
    </div>
    <div class="row">
        <p class="alert-box"></p>
    </div>
</div>