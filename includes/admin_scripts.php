<?php
defined( 'ABSPATH' ) || exit;

// admin enqueue scripts to head
function admin_enqueue_scripts_head() {
    ?> 
        <style>
            <?php
            if ($_GET['page'] === 'mv-products') { ?> 
            .content-action, .forms {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap:1rem;
            }
            .subsubsub {
                margin:0;
            }
            mark.instock {    
                font-weight: 700;
                background: transparent none;
                line-height: 1;
                color: #7ad03a;
            }
            <?php }
            ?>
        </style>
    <?php
}
add_action('admin_head', 'admin_enqueue_scripts_head');