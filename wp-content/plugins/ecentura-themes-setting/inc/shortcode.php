<?php

//Shortcode
function create_shortcode($atts)
{
    ob_start();
    include __DIR__ . '/../template-parts/main.php';
    return ob_get_clean();
}
add_shortcode('test_shortcode', 'create_shortcode');