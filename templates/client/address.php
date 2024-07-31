<?php
defined('ABSPATH') || exit;

?>
<div>
    <div class="flex">
        <button id="store-address-tab" class="px-6 py-1 mr-8 rounded-t-xl border !border-b-0 border-white tab-active">آدرس فروشگاه</button>
        <button id="warehouse-address-tab" class="px-6 py-1 rounded-t-xl border !border-b-0 border-white">آدرس انبار</button>
    </div>
    <div class="border-t">
        <div id="store-address-content">
            <div class="flex-cb py-4 mb-6 border-b">
                <p class="text-dark-gray text-xs">اینجا می‌توانید آدرس‌‌هایتان را ببنید و مدیریت کنید</p>
                <button class="open-modal-map-address py-2.5 px-5 rounded-full bg-[#D5F7D9] text-secondary font-bold btn-flex">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M1 8H15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/><path d="M8 1L8 15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/></svg></span>
                    <span>افزودن آدرس فروشگاه</span>
                </button>
            </div>
            <div>
                <div class="flex-cb pb-5 mb-5 border-b last:border-none">
                    <div class="flex-cb gap-5">
                        <div class="w-36 h-32 bg-slate-200"></div>
                        <div>
                            <p class="text-secondary mb-4">خ احمدی، کوچه احمدی، پلاک 8 واحد8</p>
                            <p class="flex items-center gap-4 mb-4">
                                <span class="text-lite-text">شهر</span>
                                <span class="text-secondary">تهران</span>
                            </p>
                            <p class="flex items-center gap-4">
                                <span class="text-lite-text">کد پستی</span>
                                <span class="text-secondary">12145417852</span>
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <button class="btn-flex py-2 px-9 rounded-xl text-secondary border border-lite-gray">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none"><path d="M14.3321 2.12121L12.8791 0.668235C12.4488 0.237556 11.8761 0 11.2666 0C10.6572 0 10.0844 0.237206 9.65412 0.667886L1.57616 8.74514C1.54293 8.77837 1.51564 8.81581 1.49185 8.85464C1.48485 8.86584 1.4796 8.87704 1.4733 8.88893C1.45651 8.92112 1.44252 8.95436 1.43202 8.98864C1.42957 8.99599 1.42467 9.00299 1.42292 9.01068L0.0206801 14.1977C-0.0349479 14.4034 0.0234789 14.6232 0.173919 14.7736C0.286925 14.8863 0.438764 14.9478 0.594453 14.9478C0.646232 14.9478 0.698361 14.9408 0.749441 14.9272L5.71363 13.5851C5.75316 13.5932 5.79374 13.5977 5.83398 13.5977C5.98652 13.5977 6.13836 13.5396 6.25451 13.4235L14.3321 5.34658C14.7628 4.9159 15.0003 4.34283 15 3.73372C15.0003 3.12461 14.7631 2.55189 14.3321 2.12121ZM5.83433 12.1619L2.83811 9.16567L9.21574 2.78805L12.2123 5.78391L5.83433 12.1619ZM1.43902 13.5089L2.30318 10.3129L4.635 12.6447L1.43902 13.5089ZM13.491 4.50552L13.0537 4.94284L10.0572 1.94698L10.4952 1.5093C10.9073 1.09717 11.6259 1.09717 12.0381 1.5093L13.491 2.96263C13.6971 3.1687 13.8108 3.44299 13.8108 3.73442C13.8108 4.02586 13.6975 4.29945 13.491 4.50552Z" fill="#252E49"/><path d="M9.13858 5.02158L5.40625 8.75391L6.24737 9.59502L9.97969 5.86269L9.13858 5.02158Z" fill="#252E49"/></svg></span>
                            <span>ویرایش آدرس</span>
                        </button>
                        <button class="btn-flex py-2 px-9 rounded-xl text-secondary border border-lite-gray">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="21" viewBox="0 0 18 21" fill="none"><path d="M2.51953 7.03516H15.4846V17.0002C15.4846 18.657 14.1414 20.0002 12.4846 20.0002H5.51953C3.86268 20.0002 2.51953 18.657 2.51953 17.0002V7.03516Z" stroke="#252E49" stroke-width="1.25"/><path d="M1.07812 5.4336C1.07812 4.32903 1.97356 3.43359 3.07813 3.43359H14.9243C16.0288 3.43359 16.9243 4.32902 16.9243 5.43359V7.03499H1.07812V5.4336Z" stroke="#252E49" stroke-width="1.25"/><path d="M6.12109 3.27295C6.12109 2.16838 7.01652 1.27295 8.12109 1.27295H9.88333C10.9879 1.27295 11.8833 2.16838 11.8833 3.27295V3.43379H6.12109V3.27295Z" stroke="#252E49" stroke-width="1.25"/><path d="M5.39844 9.55615V16.7589M8.99984 9.55615V16.7589M12.6012 9.55615V16.7589" stroke="#252E49" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            <span>حذف آدرس</span>
                        </button>
                        <div class="flex-cb gap-4 text-secondary">
                            <label for="return_warehouse">انبار مرجوعی کالا</label>
                            <label for="return_warehouse" class="switch">
                                <input type="checkbox" name="return_warehouse" id="return_warehouse">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="warehouse-address-content" class="hidden">
            <div class="flex-cb py-4 mb-6 border-b">
                <p class="text-dark-gray text-xs">اینجا می‌توانید آدرس‌‌هایتان را ببنید و مدیریت کنید</p>
                <button class="open-modal-map-address py-2.5 px-5 rounded-full bg-[#D5F7D9] text-secondary font-bold btn-flex">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M1 8H15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/><path d="M8 1L8 15" stroke="#252E49" stroke-width="2" stroke-linecap="round"/></svg></span>
                    <span>افزودن آدرس فروشگاه</span>
                </button>
            </div>
            <div>
                <div class="flex-cb pb-5 mb-5 border-b last:border-none">
                    <div class="flex-cb gap-5">
                        <div class="w-36 h-32 bg-slate-200"></div>
                        <div>
                            <p class="text-secondary mb-4">خ احمدی، کوچه احمدی، پلاک 8 واحد8</p>
                            <p class="flex items-center gap-4 mb-4">
                                <span class="text-lite-text">شهر</span>
                                <span class="text-secondary">تهران</span>
                            </p>
                            <p class="flex items-center gap-4">
                                <span class="text-lite-text">کد پستی</span>
                                <span class="text-secondary">12145417852</span>
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <button class="btn-flex py-2 px-9 rounded-xl text-secondary border border-lite-gray">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none"><path d="M14.3321 2.12121L12.8791 0.668235C12.4488 0.237556 11.8761 0 11.2666 0C10.6572 0 10.0844 0.237206 9.65412 0.667886L1.57616 8.74514C1.54293 8.77837 1.51564 8.81581 1.49185 8.85464C1.48485 8.86584 1.4796 8.87704 1.4733 8.88893C1.45651 8.92112 1.44252 8.95436 1.43202 8.98864C1.42957 8.99599 1.42467 9.00299 1.42292 9.01068L0.0206801 14.1977C-0.0349479 14.4034 0.0234789 14.6232 0.173919 14.7736C0.286925 14.8863 0.438764 14.9478 0.594453 14.9478C0.646232 14.9478 0.698361 14.9408 0.749441 14.9272L5.71363 13.5851C5.75316 13.5932 5.79374 13.5977 5.83398 13.5977C5.98652 13.5977 6.13836 13.5396 6.25451 13.4235L14.3321 5.34658C14.7628 4.9159 15.0003 4.34283 15 3.73372C15.0003 3.12461 14.7631 2.55189 14.3321 2.12121ZM5.83433 12.1619L2.83811 9.16567L9.21574 2.78805L12.2123 5.78391L5.83433 12.1619ZM1.43902 13.5089L2.30318 10.3129L4.635 12.6447L1.43902 13.5089ZM13.491 4.50552L13.0537 4.94284L10.0572 1.94698L10.4952 1.5093C10.9073 1.09717 11.6259 1.09717 12.0381 1.5093L13.491 2.96263C13.6971 3.1687 13.8108 3.44299 13.8108 3.73442C13.8108 4.02586 13.6975 4.29945 13.491 4.50552Z" fill="#252E49"/><path d="M9.13858 5.02158L5.40625 8.75391L6.24737 9.59502L9.97969 5.86269L9.13858 5.02158Z" fill="#252E49"/></svg></span>
                            <span>ویرایش آدرس</span>
                        </button>
                        <button class="btn-flex py-2 px-9 rounded-xl text-secondary border border-lite-gray">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="21" viewBox="0 0 18 21" fill="none"><path d="M2.51953 7.03516H15.4846V17.0002C15.4846 18.657 14.1414 20.0002 12.4846 20.0002H5.51953C3.86268 20.0002 2.51953 18.657 2.51953 17.0002V7.03516Z" stroke="#252E49" stroke-width="1.25"/><path d="M1.07812 5.4336C1.07812 4.32903 1.97356 3.43359 3.07813 3.43359H14.9243C16.0288 3.43359 16.9243 4.32902 16.9243 5.43359V7.03499H1.07812V5.4336Z" stroke="#252E49" stroke-width="1.25"/><path d="M6.12109 3.27295C6.12109 2.16838 7.01652 1.27295 8.12109 1.27295H9.88333C10.9879 1.27295 11.8833 2.16838 11.8833 3.27295V3.43379H6.12109V3.27295Z" stroke="#252E49" stroke-width="1.25"/><path d="M5.39844 9.55615V16.7589M8.99984 9.55615V16.7589M12.6012 9.55615V16.7589" stroke="#252E49" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            <span>حذف آدرس</span>
                        </button>
                        <div class="flex-cb gap-4 text-secondary">
                            <label for="return_warehouse">انبار مرجوعی کالا</label>
                            <label for="return_warehouse" class="switch">
                                <input type="checkbox" name="return_warehouse" id="return_warehouse">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <div id="modal-map-address" class="transition-all z-50 fixed-center fixed w-full h-4/5 max-w-4xl max-lg:p-2 opacity-0 invisible">
        <div class="bg-white rounded-2.5 shadow-xl px-10 py-6 relative h-full flex flex-col">
            <div class="flex-cb pb-3 border-b border-slate-300 mb-5">
                <p id="title-modal-map-address" class="text-secondary font-bold">موقعیت مکانی آدرس را مشخص کنید.</p>
                <button id="close-modal-map-address"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" viewBox="0 0 18 22" fill="none"><path d="M17 1L1 21" stroke="#606060"/><path d="M1.5 1L17.5 21" stroke="#606060"/></svg></button>
            </div>
            <div class="map-container relative h-full flex flex-col mb-7">
               <div id="map" class="w-full h-full bg-slate-100 rounded-xl"></div>
               <svg class="absolute-center" width="30" height="36" viewBox="0 0 38 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="marker"><g filter="url(#filter0_d_615_30152)"><ellipse cx="19" cy="18" rx="12" ry="13" fill="black" fill-opacity="0.01"></ellipse></g><path d="M19.9992 23.959C26.1591 23.4512 31 18.2909 31 12C31 5.37258 25.6274 0 19 0C12.3726 0 7 5.37258 7 12C7 18.2909 11.8409 23.4512 18.0008 23.959C18.0003 23.9726 18 23.9863 18 24V35C18 35.5523 18.4477 36 19 36C19.5523 36 20 35.5523 20 35V24C20 23.9863 19.9997 23.9726 19.9992 23.959Z" fill="#0C0C0C"></path><circle cx="19" cy="12" r="5" fill="#fda701"></circle><defs><filter id="filter0_d_615_30152" x="0" y="0" width="38" height="40" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood><feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix><feOffset dy="2"></feOffset><feGaussianBlur stdDeviation="3.5"></feGaussianBlur><feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.3 0"></feColorMatrix><feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_615_30152"></feBlend><feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_615_30152" result="shape"></feBlend></filter></defs></svg>
               <div class="absolute top-4 left-1/2 -translate-x-1/2 w-4/5">
                   <div>
                        <input type="text" id="search_address" name="search_address" class="bg-white rounded-full w-full border-none py-2.5 !pr-16" placeholder="جستجوی آدرس">
                        <div class="absolute right-3 top-1/2 -translate-y-1/2">
                            <span class="border-l border-lite-gray pl-4 block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 19 19" fill="none"><path d="M18.3 17.3481L13.7 13.3301C15.1 11.9581 16 10.0961 16 7.9401C16 3.6281 12.4 0.100098 8 0.100098C3.6 0.100098 0 3.6281 0 7.9401C0 12.2521 3.6 15.7801 8 15.7801C9.9 15.7801 11.6 15.0941 13 14.0161L17.7 18.0341L18.3 17.3481ZM1 7.9401C1 4.1181 4.1 1.0801 8 1.0801C11.9 1.0801 15 4.1181 15 7.9401C15 11.7621 11.9 14.8001 8 14.8001C4.1 14.8001 1 11.7621 1 7.9401Z" fill="#606060" /></svg>
                            </span>
                        </div>
                    </div>
                   <div id="resualt_address_list">
                   </div>
               </div>
           </div>
           <button type="submit" id="open-modal-map-form" class="!bg-primary !text-secondary block rounded-full py-3 px-20 font-bold mr-auto">تایید</button>
        </div>
    </div>
    <div id="modal-map-form" class="transition-all z-50 fixed-center fixed w-full h-fit max-w-md max-lg:p-2 opacity-0 invisible">
        <div class="bg-white rounded-2.5 shadow-xl px-10 py-6 relative h-full flex flex-col">
            <div class="flex-cb pb-3 border-b border-slate-300 mb-5">
                <p id="title-modal-map-address" class="text-secondary font-bold">جزئیات آدرس</p>
                <button id="close-modal-map-form"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" viewBox="0 0 18 22" fill="none"><path d="M17 1L1 21" stroke="#606060"/><path d="M1.5 1L17.5 21" stroke="#606060"/></svg></button>
            </div>
            <form id="address_form">
                <div class="mb-6">
                    <div>
                        <label for="address" class="text-secondary font-bold text-base mb-2.5 block">نشانی پستی</label>
                        <textarea name="address" id="address" rows="4" class="border-lite-gray py-3 px-6 !rounded-2.5 w-full"></textarea>
                    </div>
                    <hr class="my-4 border-slate-300">
                    <div class="flex-cb gap-4 mb-4">
                        <div class="w-full">
                            <label for="province" class="text-secondary font-bold text-base mb-2.5 block">استان</label>
                            <select name="province" id="province" class="border-lite-gray py-3 px-8 !rounded-2.5 w-full appearance-select">
                            </select>
                        </div>
                        <div class="w-full">
                            <label for="city" class="text-secondary font-bold text-base mb-2.5 block">شهر</label>
                            <select name="city" id="city" class="border-lite-gray py-3 px-8 !rounded-2.5 w-full appearance-select">
                            </select>
                        </div>
                    </div>
                    <div class="flex-cb gap-4">
                        <div class="w-[30%]">
                            <label for="plate" class="text-secondary font-bold text-base mb-2.5 block">پلاک</label>
                            <input type="text" inputmode="numeric" name="plate" id="plate" value="" class="ltr !border-lite-gray py-3 px-4 !rounded-2.5 w-full">
                        </div>
                        <div class="w-1/5">
                            <label for="unit" class="text-secondary font-bold text-base mb-2.5 block">واحد</label>
                            <input type="text" inputmode="numeric" name="unit" id="unit" value="" class="ltr !border-lite-gray py-3 px-4 !rounded-2.5 w-full">
                        </div>
                        <div class="w-1/2">
                            <label for="postal_code" class="text-secondary font-bold text-base mb-2.5 block">کد پستی</label>
                            <input type="text" inputmode="numeric" name="postal_code" id="postal_code" value="" class="ltr !border-lite-gray py-3 px-4 !rounded-2.5 w-full">
                        </div>
                    </div>
                    <hr class="my-4 border-slate-300">
                    <div class="flex-cb gap-4">
                        <div class="w-full">
                            <label for="landline1" class="text-secondary font-bold text-base mb-2.5 block">تلفن ثابت ۱</label>
                            <input type="tel" inputmode="tel" name="landline1" id="landline1" value="" class="ltr !border-lite-gray py-3 px-4 !rounded-2.5 w-full">
                        </div>
                        <div class="w-full">
                            <label for="landline2" class="text-secondary font-bold text-base mb-2.5 block">تلفن ثابت ۲</label>
                            <input type="tel" inputmode="tel" name="landline2" id="landline2" value="" class="ltr !border-lite-gray py-3 px-4 !rounded-2.5 w-full">
                        </div>
                    </div>
                </div>
                <button type="submit" class="!bg-primary !text-secondary block rounded-full py-3 px-20 font-bold mr-auto">تایید</button>
            </form>
        </div>
    </div>
    <div id="overlay-modal-address" class="transition-all fixed inset-0 z-40 backdrop-blur-sm bg-slate-900/75 opacity-0 invisible"></div>
</div>