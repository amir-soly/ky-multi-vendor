<?php
defined('ABSPATH') || exit;

/*
Plugin Name: KalaYadak Multi Vendor
Plugin URI: https://kalayadak24.com/
Description: A multi-vendor selling plugin for Kalayadak24 online car shop.
Version: 1.0
Author: Your Name
Author URI: https://yourwebsite.com/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: kalayadak-multi-vendor
Domain Path: /languages
*/

define('MV_DIR_PATH', plugin_dir_path(__FILE__));
define('MV_DIR_URL', plugin_dir_url(__FILE__));


include MV_DIR_PATH . '/includes/init.php';
include MV_DIR_PATH . '/includes/client_scripts.php';
include MV_DIR_PATH . '/includes/ajax.php';

?>