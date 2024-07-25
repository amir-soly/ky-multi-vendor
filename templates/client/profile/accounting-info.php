<?php
defined('ABSPATH') || exit;
?>
<div>
    <div class="mb-9">
        <h1 class="font-bold text-secondary text-base mb-4">اطلاعات حسابداری</h1>
        <p class="text-xs">حساب بانکی باید به نام مالک پنل باشد</p>
    </div>
    <div id="container-fields">
    <?php
        include MV_DIR_PATH . '/templates/client/profile-fields/accounting-info.php';
    ?>
    </div>
</div>