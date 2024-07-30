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
            form#add_product_form {
                margin-top: 2rem;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .form-countent {
                padding: 2rem 3rem;
                background: #fff;
                border-radius: 1.5rem;
                box-shadow: 0 0 10px #00000017;
            }
            .field-form {
                display: grid;
                gap:1rem;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                margin-bottom: 1.25rem;
            }
            .field-form label {
                display: block;
                margin-bottom: 6px;
            }
            .field-form input {
                padding: .3rem .75rem;
                border-radius: .75rem;
                display: block;
            }
            .sold-individually-field {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 7px;
                grid-column: 1 / -1;
            }
            .sold-individually-field label {
                margin-bottom: 0;
            }
            button#add_product_submit {
                width: 100%;
                padding: 1rem;
                border-radius: .75rem;
                border: none;
                background: #24ff89;
                cursor: pointer;
            }
            <?php }
            ?>
        </style>
    <?php
}
add_action('admin_head', 'admin_enqueue_scripts_head');