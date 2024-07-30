<?php
defined( 'ABSPATH' ) || exit;

$user = wp_get_current_user();
?>
<div>
    <div class="flex-cb mb-6">
        <div class="btn-flex">
            <span><svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="24" cy="24" r="24" fill="#D9D9D9"></circle><circle cx="24" cy="15" r="9" fill="white"></circle><path fill-rule="evenodd" clip-rule="evenodd" d="M4.82227 38.4315C8.10072 31.1048 15.4544 26 24.0004 26C32.5463 26 39.9 31.1048 43.1784 38.4315C38.7984 44.2429 31.8381 48 24.0004 48C16.1626 48 9.20229 44.2429 4.82227 38.4315Z" fill="white"></path></svg></span>
            <span class="text-base text-paragraph"><?php echo esc_html($user->display_name ); ?></span>
        </div>
        <a href="<?php echo esc_attr(home_url('dashboard-seller/seller-information/')); ?>" class="p-2 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none"><path d="M14.3321 2.12121L12.8791 0.668235C12.4488 0.237556 11.8761 0 11.2666 0C10.6572 0 10.0844 0.237206 9.65412 0.667886L1.57616 8.74514C1.54293 8.77837 1.51564 8.81581 1.49185 8.85464C1.48485 8.86584 1.4796 8.87704 1.4733 8.88893C1.45651 8.92112 1.44252 8.95436 1.43202 8.98864C1.42957 8.99599 1.42467 9.00299 1.42292 9.01068L0.0206801 14.1977C-0.0349479 14.4034 0.0234789 14.6232 0.173919 14.7736C0.286925 14.8863 0.438764 14.9478 0.594453 14.9478C0.646232 14.9478 0.698361 14.9408 0.749441 14.9272L5.71363 13.5851C5.75316 13.5932 5.79374 13.5977 5.83398 13.5977C5.98652 13.5977 6.13836 13.5396 6.25451 13.4235L14.3321 5.34658C14.7628 4.9159 15.0003 4.34283 15 3.73372C15.0003 3.12461 14.7631 2.55189 14.3321 2.12121ZM5.83433 12.1619L2.83811 9.16567L9.21574 2.78805L12.2123 5.78391L5.83433 12.1619ZM1.43902 13.5089L2.30318 10.3129L4.635 12.6447L1.43902 13.5089ZM13.491 4.50552L13.0537 4.94284L10.0572 1.94698L10.4952 1.5093C10.9073 1.09717 11.6259 1.09717 12.0381 1.5093L13.491 2.96263C13.6971 3.1687 13.8108 3.44299 13.8108 3.73442C13.8108 4.02586 13.6975 4.29945 13.491 4.50552Z" fill="#CCCCCC"/><path d="M9.13858 5.02158L5.40625 8.75391L6.24737 9.59502L9.97969 5.86269L9.13858 5.02158Z" fill="#CCCCCC"/></svg></a>
    </div>
    <ul class="space-y-2" id="aside-menu">
        <li>
            <a href="<?php echo esc_attr(home_url('dashboard-seller/seller-information/')); ?>" class="flex items-center gap-4 py-2 <?php echo is_dashboard_seller_endpoint('seller-information')? 'active': ''; ?>">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24" fill="none"><circle cx="8.76833" cy="5.07692" r="4.57692" stroke="#B3B3B3"/><path d="M0.5 18.1538C0.5 14.0117 3.85786 10.6538 8 10.6538H9.53846C13.6806 10.6538 17.0385 14.0117 17.0385 18.1538V23.5H0.5V18.1538Z" stroke="#B3B3B3"/></svg></span>
                <span class="font-bold">اطلاعات مالک کسب و کار</span>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_attr(home_url('dashboard-seller/store-information/')); ?>" class="flex items-center gap-4 py-2 <?php echo is_dashboard_seller_endpoint('store-information')? 'active': ''; ?>">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" viewBox="0 0 23 20" fill="none"><path d="M2.65789 9.4375H1L3.76316 1H19.7895L22 9.4375H20.3421M2.65789 9.4375V19H13.7105V9.4375M2.65789 9.4375H13.7105M13.7105 9.4375H20.3421M20.3421 19V9.4375" stroke="#B3B3B3" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                <span class="font-bold">اطلاعات فروشگاه</span>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_attr(home_url('dashboard-seller/address')); ?>" class="flex items-center gap-4 py-2 <?php echo is_dashboard_seller_endpoint('address')? 'active': ''; ?>">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none"><path d="M6.93923 4.99436C9.69754 2.23605 14.207 2.27343 16.9653 5.03174V5.03174C19.2726 7.33902 19.7567 10.9441 18.1003 13.7554L12.0645 24L5.86702 13.6059C4.21094 10.8284 4.65262 7.28097 6.93923 4.99436V4.99436Z" stroke="#B3B3B3"/><circle cx="11.9363" cy="10.3768" r="3.2918" stroke="#B3B3B3"/></svg></span>
                <span class="font-bold">آدرس ها</span>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_attr(home_url('dashboard-seller/accounting-information/')); ?>" class="flex items-center gap-4 py-2 <?php echo is_dashboard_seller_endpoint('accounting-information')? 'active': ''; ?>">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 17" fill="none"><rect x="0.5" y="0.5" width="23" height="16" rx="3.5" stroke="#B3B3B3"/><line x1="1" y1="7.5" x2="24" y2="7.5" stroke="#B3B3B3"/><line x1="1" y1="4.5" x2="24" y2="4.5" stroke="#B3B3B3"/></svg></span>
                <span class="font-bold">حسابداری</span>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_attr(home_url('dashboard-seller/documents')); ?>" class="flex items-center gap-4 py-2 <?php echo is_dashboard_seller_endpoint('documents')? 'active': ''; ?>">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="25" height="27" viewBox="0 0 25 27" fill="none"><path d="M16.8815 2.64307L24.0006 4.28592L19.072 25.6431L9.21484 22.905" stroke="#B3B3B3" stroke-linecap="round" stroke-linejoin="round"/><path d="M4.70115 1H16.3333V22.9048H1V4.83333M4.70115 1L1 4.83333M4.70115 1V4.83333H1" stroke="#B3B3B3" stroke-linecap="round" stroke-linejoin="round"/><path d="M3.19141 8.6665H14.1438" stroke="#B3B3B3" stroke-linecap="round" stroke-linejoin="round"/><path d="M3.19141 11.4048H14.1438" stroke="#B3B3B3" stroke-linecap="round" stroke-linejoin="round"/><path d="M3.19141 14.1431H14.1438" stroke="#B3B3B3" stroke-linecap="round" stroke-linejoin="round"/><path d="M3.19141 16.8809H14.1438" stroke="#B3B3B3" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                <span class="font-bold">مدارک</span>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_attr(home_url('dashboard-seller/agreement')); ?>" class="flex items-center gap-4 py-2 <?php echo is_dashboard_seller_endpoint('agreement')? 'active': ''; ?>">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none"><path d="M17.5 11V2C17.5 1.44772 17.0523 1 16.5 1H6.44237C6.16062 1 5.89195 1.11885 5.70243 1.32733L1.26006 6.21393C1.09272 6.39801 1 6.63784 1 6.88661V23C1 23.5523 1.44772 24 2 24H16.5C17.0523 24 17.5 23.5523 17.5 23V16M5 10H13.5M5 14.5H8.75H14M5 19H12M12 19L13 15.5L21.5 7L24 9.5L15.5 18L12 19Z" stroke="#B3B3B3" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                <span class="font-bold">قرارداد</span>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_attr(wp_logout_url(home_url())); ?>" class="flex items-center gap-4 py-2">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="25" height="18" viewBox="0 0 25 18" fill="none"><path d="M17.4662 12.8557V13.6241C17.4662 15.7098 15.7098 17.4662 13.6241 17.4662H4.84212C2.7564 17.4662 1 15.7098 1 13.6241V4.84212C1 2.7564 2.7564 1 4.84212 1H13.6241C15.7098 1 17.4662 2.7564 17.4662 4.84212V5.8301" stroke="#B3B3B3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M10.2801 9.2334L23.4531 9.2334" stroke="#B3B3B3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M20.7068 12.5264L24 9.23312L20.7068 5.93987" stroke="#B3B3B3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                <span class="font-bold">خروج از حساب کاربری</span>
            </a>
        </li>
    </ul>
</div>