<?php
/*
*Plugin Name: NubeCart Update
*Description: Updates cart quantity dynamically using JavaScript, eliminating the need to click the 'Update Cart' button..
*Version: 1.0.0
*Author: Nubevest Pvt Ltd
*Plugin URI: https://nubevest.com.au
*License: GPLv2 or later
*License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*Text Domain: nube_update_cart
*/

defined('ABSPATH') || die('No script kiddies please!');  // Prevent direct access

/* Init for Translation ready */
function nubeUpdate_init() {
    load_plugin_textdomain('nube_update_cart', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('init', 'nubeUpdate_init');

/* Update Cart using JavaScript */
add_action('wp_footer', 'nube_cartUpdate');
function nube_cartUpdate() {
    if (is_cart()) :
    ?>
 <script>
        jQuery(function($) {
            var timeout;

            // Trigger cart update when quantity changes
            $('div.woocommerce').on('input change', '.qty', function() {
                clearTimeout(timeout);

                timeout = setTimeout(function() {
                    // Submit the cart form automatically
                    $('button[name="update_cart"]').trigger('click');
                }, 500); // Delay to prevent immediate submission
            });
        });
    </script>

    <?php
    endif;
}

/* CSS to Hide the "Update Cart" Button */
function buttonHide() {
    echo '
    <style type="text/css">
        button[name="update_cart"] {
            display: none !important;
        }
    </style>';
}
add_action('wp_print_styles', 'buttonHide');
