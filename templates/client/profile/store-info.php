<?php
defined('ABSPATH') || exit;
?>
<div>
    <div class="mb-9">
        <h1 class="font-bold text-secondary text-base mb-4">اطلاعات فروشگاه</h1>
        <p class="text-xs">برای اینکه فروشگاه شما وجهه بهتری داشته باشد، اطلاعات زیر را تکمیل کنید</p>
    </div>
    <div id="container-fields">
    <?php
        include MV_DIR_PATH . '/templates/client/profile-fields/store-info.php';
    ?>
    </div>
</div>