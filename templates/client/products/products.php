<?php
defined( 'ABSPATH' ) || exit;

?>
<div>
    <div class="flex items-center gap-6 mb-7">
        <h1 class="font-bold text-secondary text-base">مدیریت محصولات</h1>
        <p class="text-xs">برای ویرایش و مدیریت مشخصات، گروه، تصویر محصولات و درج تنوع (گارانتی، به همراه رنگ یا سایز) از این قسمت استفاده نمایید</p>
    </div>
    <div>
        <p class="text-sm text-paragraph mb-4">جستجو و فیلتر</p>
        <div class="mb-6">
            <p class="text-xxs mb-3">جستجو در:</p>
            <div class="flex items-stretch gap-4">
                <select name="" id="" class="w-1/4 px-3 py-2.5 rounded-3xl !border-gray appearance-select">
                    <option value="">همه موارد</option>
                </select>
                <div class="w-3/4 relative">
                    <input type="text" class="bg-white rounded-3xl w-full !border-gray !pr-16" placeholder="نام محصول">
                    <div class="absolute right-3 top-1/2 -translate-y-1/2">
                        <span class="border-l border-lite-gray pl-4 block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 19 19" fill="none"><path d="M18.3 17.3481L13.7 13.3301C15.1 11.9581 16 10.0961 16 7.9401C16 3.6281 12.4 0.100098 8 0.100098C3.6 0.100098 0 3.6281 0 7.9401C0 12.2521 3.6 15.7801 8 15.7801C9.9 15.7801 11.6 15.0941 13 14.0161L17.7 18.0341L18.3 17.3481ZM1 7.9401C1 4.1181 4.1 1.0801 8 1.0801C11.9 1.0801 15 4.1181 15 7.9401C15 11.7621 11.9 14.8001 8 14.8001C4.1 14.8001 1 11.7621 1 7.9401Z" fill="#606060"/></svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="flex items-stretch gap-4 flex-wrap">
                <div class="w-1/4">
                    <label for="" class="text-xxs mb-3 block">گروه کالایی:</label>
                    <select name="" id="" class="w-full px-3 py-2.5 rounded-3xl !border-gray appearance-select">
                        <option value="">انتخاب کنید</option>
                    </select>
                </div>
                <div class="w-1/4">
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
                </div>
            </div>
        </div>
        <hr class="border-gray my-5">
        <div class="flex-cb">
            <a href="/dashboard-seller/add-product/" class="text-secondary font-bold text-xs btn-flex bg-[#D5F7D9] rounded-3xl py-2.5 px-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M1 8H15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/><path d="M8 1L8 15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/></svg>
                <span>افزودن کالای جدید</span>
            </a>
            <div class="flex items-center gap-5">
                <p class="text-sm">
                    <span>تعداد نتایج:</span>
                    <span>۱۳۷۷ مورد</span>
                </p>
                <div class="btn-flex">
                    <label for="">نمایش</label>
                    <select name="" id="" class="pr-4 pl-8 py-2 rounded-3xl !border-gray text-xs appearance-select">
                        <option value="">جدیدترین</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>