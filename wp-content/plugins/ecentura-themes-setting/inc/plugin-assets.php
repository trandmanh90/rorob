<?php

function wp_include_css_tm_plugin()
{
    wp_enqueue_style('main-style-tm-plugin', plugin_dir_url(__DIR__) . 'assets/css/style.css', array(), false, 'all');
}
// add_action('wp_enqueue_scripts', 'wp_include_css_tm_plugin'); //Nhúng vào web 
// add_action('admin_enqueue_scripts', 'wp_include_admin_css'); //Nhúng vào wp-admin 
// add_action('login_enqueue_scripts', 'wp_include_login_css'); //Nhúng vào wp-login

function wp_include_js_tm_plugin()
{
    wp_enqueue_script('main-js-tm-plugin', plugin_dir_url(__DIR__) . 'assets/js/main.js', array(), false, true);
}
// add_action('wp_enqueue_scripts', 'wp_include_js_tm_plugin'); //Nhúng vào web 
// add_action('admin_enqueue_scripts', 'wp_include_js'); //Nhúng vào wp-admin 
// add_action('login_enqueue_scripts', 'wp_include_js'); //Nhúng vào wp-login

// Thay đổi logo trang login
function custom_login_logo()
{
    $ecentura_image_logo = get_option('ecentura_image_logo');
    $ecentura_image_logo_url = wp_get_attachment_image_url($ecentura_image_logo, 'full');
    if ($ecentura_image_logo_url) :
?>
        <style type="text/css">
            .login #login h1 a {
                background-image: url(<?php echo $ecentura_image_logo_url; ?>);
                background-size: contain;
                width: 100%;
                height: 80px;
            }
        </style>
<?php
    endif;
}
add_action('login_enqueue_scripts', 'custom_login_logo');

// Bỏ icon WP trong dashboard
function remove_wp_logo_icon()
{
    global $wp_admin_bar;

    // Replace 'wp-logo' with the ID of the node you want to remove
    $wp_admin_bar->remove_node('wp-logo');
}
add_action('wp_before_admin_bar_render', 'remove_wp_logo_icon', 999);

