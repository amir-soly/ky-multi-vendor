<?php
defined('ABSPATH') || exit;


$seller_id = get_current_user_id();
?>
<div class="grid grid-cols-2 gap-4 relative p-1">
    <div class="bg-back rounded-2.5 px-6 py-3">
        <div class="flex-cb">
            <div>
                <span class="block mb-2.5 text-lite-text text-sm">وضعیت فروشنده</span>
                <p class="text-secondary text-base"><?php mv_get_store_data($seller_id,'seller_status');?></p>
            </div>
            <button class="open-modal p-2" data-form="store_status_form"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M17.1985 2.54545L15.455 0.801883C14.9386 0.285067 14.2513 0 13.52 0C12.7886 0 12.1013 0.284648 11.5849 0.801463L1.8914 10.4942C1.85151 10.534 1.81877 10.579 1.79022 10.6256C1.78182 10.639 1.77552 10.6524 1.76797 10.6667C1.74781 10.7053 1.73102 10.7452 1.71843 10.7864C1.71549 10.7952 1.70961 10.8036 1.70751 10.8128L0.0248161 17.0373C-0.0419374 17.2841 0.0281747 17.5478 0.208703 17.7283C0.34431 17.8635 0.526517 17.9374 0.713343 17.9374C0.775479 17.9374 0.838033 17.929 0.899329 17.9126L6.85635 16.3021C6.90379 16.3118 6.95249 16.3173 7.00077 16.3173C7.18382 16.3173 7.36603 16.2476 7.50541 16.1082L17.1985 6.4159C17.7154 5.89908 18.0004 5.2114 18 4.48047C18.0004 3.74954 17.7158 3.06227 17.1985 2.54545ZM7.00119 14.5943L3.40574 10.9988L11.0589 3.34565L14.6548 6.94069L7.00119 14.5943ZM1.72682 16.2106L2.76381 12.3754L5.562 15.1736L1.72682 16.2106ZM16.1893 5.40662L15.6645 5.93141L12.0686 2.33637L12.5942 1.81116C13.0888 1.3166 13.9511 1.3166 14.4457 1.81116L16.1893 3.55515C16.4365 3.80243 16.573 4.13158 16.573 4.48131C16.573 4.83103 16.437 5.15934 16.1893 5.40662Z" fill="#252E49"/><path d="M10.9632 6.02609L6.48438 10.5049L7.49371 11.5142L11.9725 7.03543L10.9632 6.02609Z" fill="#252E49"/></svg></button>
        </div>
    </div>
    <div class="bg-back rounded-2.5 px-6 py-3">
        <div class="flex-cb">
            <div>
                <span class="block mb-2.5 text-lite-text text-sm">نام فروشگاه</span>
                <p class="text-secondary text-base"><?php mv_get_store_data($seller_id,'store_name');?></p>
            </div>
            <button class="open-modal p-2" data-form="store_name_form"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M17.1985 2.54545L15.455 0.801883C14.9386 0.285067 14.2513 0 13.52 0C12.7886 0 12.1013 0.284648 11.5849 0.801463L1.8914 10.4942C1.85151 10.534 1.81877 10.579 1.79022 10.6256C1.78182 10.639 1.77552 10.6524 1.76797 10.6667C1.74781 10.7053 1.73102 10.7452 1.71843 10.7864C1.71549 10.7952 1.70961 10.8036 1.70751 10.8128L0.0248161 17.0373C-0.0419374 17.2841 0.0281747 17.5478 0.208703 17.7283C0.34431 17.8635 0.526517 17.9374 0.713343 17.9374C0.775479 17.9374 0.838033 17.929 0.899329 17.9126L6.85635 16.3021C6.90379 16.3118 6.95249 16.3173 7.00077 16.3173C7.18382 16.3173 7.36603 16.2476 7.50541 16.1082L17.1985 6.4159C17.7154 5.89908 18.0004 5.2114 18 4.48047C18.0004 3.74954 17.7158 3.06227 17.1985 2.54545ZM7.00119 14.5943L3.40574 10.9988L11.0589 3.34565L14.6548 6.94069L7.00119 14.5943ZM1.72682 16.2106L2.76381 12.3754L5.562 15.1736L1.72682 16.2106ZM16.1893 5.40662L15.6645 5.93141L12.0686 2.33637L12.5942 1.81116C13.0888 1.3166 13.9511 1.3166 14.4457 1.81116L16.1893 3.55515C16.4365 3.80243 16.573 4.13158 16.573 4.48131C16.573 4.83103 16.437 5.15934 16.1893 5.40662Z" fill="#252E49"/><path d="M10.9632 6.02609L6.48438 10.5049L7.49371 11.5142L11.9725 7.03543L10.9632 6.02609Z" fill="#252E49"/></svg></button>
        </div>
    </div>
    <div class="bg-back rounded-2.5 px-6 py-3">
        <div class="flex-cb">
            <div>
                <span class="block mb-2.5 text-lite-text text-sm">درباره فروشگاه</span>
                <p class="text-secondary text-base"><?php mv_get_store_data($seller_id,'store_bio');?></p>
            </div>
            <button class="open-modal p-2" data-form="store_about_form"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M1 8H15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/><path d="M8 1L8 15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/></svg></button>
        </div>
    </div>
    <div class="bg-back rounded-2.5 px-6 py-3">
        <div class="flex-cb">
            <div>
                <span class="block mb-2.5 text-lite-text text-sm">شماره تلفن ثابت فروشگاه</span>
                <p class="text-secondary text-base"><?php mv_get_store_data($seller_id,'store_phone');?></p>
            </div>
            <button class="open-modal p-2" data-form="store_landline_form"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M1 8H15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/><path d="M8 1L8 15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/></svg></button>
        </div>
    </div>
    <div class="bg-back rounded-2.5 px-6 py-3">
        <div class="flex-cb">
            <div>
                <span class="block mb-2.5 text-lite-text text-sm">وب‌سایت فروشگاه</span>
                <p class="text-secondary text-base"><?php mv_get_store_data($seller_id,'store_site');?></p>
            </div>
            <button class="open-modal p-2" data-form="store_website_form"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M1 8H15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/><path d="M8 1L8 15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/></svg></button>
        </div>
    </div>
    <div class="bg-back rounded-2.5 px-6 py-3">
        <div class="flex-cb">
            <div>
                <span class="block mb-2.5 text-lite-text text-sm">روزهای تعطیل فروشگاه</span>
                <p class="text-secondary text-base"><?php mv_get_store_data($seller_id,'store_vacation');?></p>
            </div>
            <button class="open-modal p-2" data-form="store_holidays_form"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M1 8H15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/><path d="M8 1L8 15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/></svg></button>
        </div>
    </div>
    <div id="loader" class="transition-all absolute inset-0 w-full h-full backdrop-blur-sm flex-cc z-10 text-black opacity-0 invisible">
        <span><svg class="animate-spin mx-auto" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 12a9 9 0 11-6.219-8.56"></path> </g></svg></span>
    </div>
</div>
<div>
    <div id="modal-store-info" class="transition-all z-50 fixed-center fixed w-full h-fit max-w-md max-lg:p-2 opacity-0 invisible">
        <div class="bg-white rounded-2.5 shadow-xl px-10 py-6 relative">
            <div class="flex-cb pb-3 border-b border-slate-300 mb-5">
                <p id="title-modal-store-info" class="text-secondary font-bold">نام فروشگاه را وارد کنید</p>
                <button id="close-modal-store-info"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" viewBox="0 0 18 22" fill="none"><path d="M17 1L1 21" stroke="#606060"/><path d="M1.5 1L17.5 21" stroke="#606060"/></svg></button>
            </div>
            <input type="hidden" name="ajax_url" value="<?php echo admin_url('admin-ajax.php'); ?>">

            <form id="store_status_form" class="hidden">
                <div class="mb-6">
                    <label for="store_status" class="text-secondary font-bold text-base mb-2.5 block">وضعیت فروشنده</label>
                    <input type="text" name="store_data" id="store_status" value="<?php mv_get_store_data($seller_id,'seller_status');?>" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
                    <input type="hidden" name="meta_field" value="seller_status">
                    <input type="hidden" name="seller_id" value="<?php echo get_current_user_id(); ?>">

                </div>
                <button type="submit" class="!bg-primary !text-secondary block rounded-full py-3 px-20 font-bold mr-auto">تایید</button>
            </form>
            <form id="store_name_form" class="hidden">
                <div class="mb-6">
                    <label for="store_name" class="text-secondary font-bold text-base mb-2.5 block">نام فروشگاه</label>
                    <input type="text" name="store_data" value="<?php mv_get_store_data($seller_id,'store_name');?>" id="store_name" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
                    <input type="hidden" name="meta_field" value="store_name">
                    <input type="hidden" name="seller_id" value="<?php echo get_current_user_id(); ?>">
                </div>
                <button type="submit" class="!bg-primary !text-secondary block rounded-full py-3 px-20 font-bold mr-auto">تایید</button>
            </form>
            <form id="store_about_form" class="hidden">
                <div class="mb-6">
                    <label for="store_about" class="text-secondary font-bold text-base mb-2.5 block">درباره فروشگاه</label>
                    <textarea name="store_data" id="store_about" value="<?php mv_get_store_data($seller_id,'store_bio');?>" rows="4" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full"></textarea>
                    <input type="hidden" name="meta_field" value="store_bio">
                    <input type="hidden" name="seller_id" value="<?php echo get_current_user_id(); ?>">
                </div>
                <button type="submit" class="!bg-primary !text-secondary block rounded-full py-3 px-20 font-bold mr-auto">تایید</button>
            </form>
            <form id="store_landline_form" class="hidden">
                <div class="mb-6">
                    <label for="store_landline" class="text-secondary font-bold text-base mb-2.5 block">شماره تلفن ثابت فروشگاه</label>
                    <input type="tel" inputmode="tel" name="store_data" value="<?php mv_get_store_data($seller_id,'store_phone');?>" id="store_landline" class="ltr border-lite-gray py-3 px-6 !rounded-2.5 w-full">
                    <input type="hidden" name="meta_field" value="store_phone">
                    <input type="hidden" name="seller_id" value="<?php echo get_current_user_id(); ?>">
                </div>
                <button type="submit" class="!bg-primary !text-secondary block rounded-full py-3 px-20 font-bold mr-auto">تایید</button>
            </form>
            <form id="store_website_form" class="hidden">
                <div class="mb-6">
                    <label for="store_website" class="text-secondary font-bold text-base mb-2.5 block">وب‌سایت فروشگاه</label>
                    <input type="url" inputmode="url" value="<?php mv_get_store_data($seller_id,'store_site');?>" name="store_data" id="store_website" class="ltr border-lite-gray py-3 px-6 !rounded-2.5 w-full">
                    <input type="hidden" name="meta_field" value="store_site">
                    <input type="hidden" name="seller_id" value="<?php echo get_current_user_id(); ?>">
                </div>
                <button type="submit" class="!bg-primary !text-secondary block rounded-full py-3 px-20 font-bold mr-auto">تایید</button>
            </form>
            <form id="store_holidays_form" class="hidden">
                <div class="mb-6">
                    <label for="store_holidays" class="text-secondary font-bold text-base mb-2.5 block">روزهای تعطیل فروشگاه</label>
                    <input type="text" name="store_data" value="<?php mv_get_store_data($seller_id,'store_vacation');?>" id="store_holidays" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full">
                    <input type="hidden" name="meta_field" value="store_vacation">
                    <input type="hidden" name="seller_id" value="<?php echo get_current_user_id(); ?>">
                </div>
                <button type="submit" class="!bg-primary !text-secondary block rounded-full py-3 px-20 font-bold mr-auto">تایید</button>
            </form>
        </div>
    </div>
    <div id="overlay-modal-store-info" class="transition-all fixed inset-0 z-40 backdrop-blur-sm bg-slate-900/75 opacity-0 invisible"></div>
</div>