<?php
defined('ABSPATH') || exit;

$seller_id = get_current_user_id();

$not_upload_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="24" viewBox="0 0 32 24" fill="none"><path d="M15.6797 1.04798L15.6797 12.8364" stroke="#242E49" stroke-width="2" stroke-linecap="round"/><path d="M20.6445 6.01138L15.681 1L10.7174 6.01138" stroke="#242E49" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M1 14.3569V22.9998H15.5357H30.0714V14.3569" stroke="#242E49" stroke-width="2" stroke-linecap="round"/></svg>';

$uploaded_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="12" fill="#39B54A"/><path fill-rule="evenodd" clip-rule="evenodd" d="M9.88094 18.3448L4.29102 13.0521L6.27696 10.9546L9.93309 14.4163L17.9382 6.83691L19.9241 8.9344L10.086 18.2494L9.94143 18.402L9.93309 18.3941L9.93024 18.3968L9.88094 18.3448Z" fill="white"/></svg>'
?>
<div class="grid grid-cols-2 gap-4 relative p-1">
    <div class="bg-back rounded-2.5 px-6 py-3 cursor-pointer open-modal" data-form="national_card_img">
        <div class="flex-cb">
            <div class="w-20 h-16 object-cover flex-cc">
                <?= mv_get_seller_document_meta($seller_id,'national_card_img', 'url') ? '<img src='. mv_get_seller_document_meta($seller_id,"national_card_img", "url").' alt="">' : $not_upload_svg;?>
            </div>
            <span class="text-paragraph">تصویر روی کارت ملی</span>
            <span>
            <?= mv_get_seller_document_meta($seller_id,'national_card_img', 'url') ? $uploaded_svg : '';?>
            </span>
        </div>
    </div>
    <div class="bg-back rounded-2.5 px-6 py-3 cursor-pointer open-modal" data-form="birth_certificate_img">
        <div class="flex-cb">
            <div class="w-20 h-16 object-cover flex-cc">
                <?= mv_get_seller_document_meta($seller_id,'birth_certificate_img', 'url') ? '<img src='. mv_get_seller_document_meta($seller_id,"birth_certificate_img", "url").' alt="">' : $not_upload_svg;?>
            </div>
            <span class="text-paragraph">تصویر صفحه اول شناسنامه</span>
            <div class="w-6 h-6">
            <?= mv_get_seller_document_meta($seller_id,'birth_certificate_img', 'url') ? $uploaded_svg : '';?>
            </div>
        </div>
    </div>
    <div class="bg-back rounded-2.5 px-6 py-3 cursor-pointer open-modal" data-form="business_license_img">
        <div class="flex-cb">
            <div class="w-20 h-16 object-cover flex-cc">
                <?= mv_get_seller_document_meta($seller_id,'business_license_img', 'url') ? '<img src='. mv_get_seller_document_meta($seller_id,"business_license_img", "url").' alt="">' : $not_upload_svg;?>
                </div>
            <span class="text-paragraph">تصویر جواز کسب (اختیاری)</span>
            <div class="w-6 h-6">
            <?= mv_get_seller_document_meta($seller_id,'business_license_img', 'url') ? $uploaded_svg : '';?>
            </div>
        </div>
    </div>
    <div id="loader" class="transition-all absolute inset-0 w-full h-full backdrop-blur-sm flex-cc z-10 text-black opacity-0 invisible">
        <span><svg class="animate-spin mx-auto" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 11-6.219-8.56"></path></svg></span>
    </div>
</div>
<div>
    <div id="modal-documents" class="transition-all z-50 fixed-center fixed w-full h-fit max-w-md max-lg:p-2 opacity-0 invisible">
        <div class="bg-white rounded-2.5 shadow-xl px-10 py-6 relative">
            <div class="flex-cb pb-3 border-b border-slate-300 mb-5">
                <p id="title-modal-documents" class="text-secondary font-bold"></p>
                <button id="close-modal-documents"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" viewBox="0 0 18 22" fill="none"><path d="M17 1L1 21" stroke="#606060"/><path d="M1.5 1L17.5 21" stroke="#606060"/></svg></button>
            </div>
            <form id="documents_form" enctype="multipart/form-data">
                <div class="flex items-center gap-6 mb-6">
                    
                <button class="relative overflow-hidden p-9 rounded-2.5 flex-cc flex-col gap-4 border image-button">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="32" height="24" viewBox="0 0 32 24" fill="none"><path d="M15.6797 1.04798L15.6797 12.8364" stroke="#242E49" stroke-width="2" stroke-linecap="round"/><path d="M20.6445 6.01138L15.681 1L10.7174 6.01138" stroke="#242E49" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M1 14.3569V22.9998H15.5357H30.0714V14.3569" stroke="#242E49" stroke-width="2" stroke-linecap="round"/></svg></span>
                        <span class="text-xxs font-bold text-slate-300">بارگذاری تصویر</span>
                    </button>
                    <div>
                        <p class="text-xs text-dark-gray mb-2">شرایط تصویر:</p>
                        <ul class="space-y-2 list-inside text-xs text-dark-gray">
                            <li>صاف و خوانا</li>
                            <li>حجم کمتر از ۲ مگابایت</li>
                        </ul>
                    </div>
                </div>
                <input type="hidden" id="meta_field" name="meta_field" value="">
                <input type="file" name="document" id="document" class="hidden" accept="image/*">
                <button type="submit" class="!bg-primary !text-secondary block rounded-full py-3 px-20 font-bold mr-auto">تایید</button>
            </form>
        </div>
    </div>
    <div id="overlay-modal-documents" class="transition-all fixed inset-0 z-40 backdrop-blur-sm bg-slate-900/75 opacity-0 invisible"></div>
</div>