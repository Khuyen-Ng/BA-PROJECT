<?php

// Cho phép chọn template custom
function flatsome_child_add_templates($templates) {
    $templates['/templates/upload-photo-page.php'] = 'Upload Photo Page';
    return $templates;
}
add_filter('theme_page_templates', 'flatsome_child_add_templates');

// Áp dụng template khi người dùng chọn
add_filter('template_include', function($template) {
    if (is_page()) {
        $selected = get_page_template_slug();

        if ($selected === 'upload-photo-page.php') {
           return get_stylesheet_directory() . '/templates/upload-photo-page.php';

        }
    }
    return $template;
});
add_action('wp_enqueue_scripts', function () {

    /* ===== CSS ===== */

    // Customize layout
    wp_enqueue_style(
        'customize-css',
        get_stylesheet_directory_uri() . '/assets/css/customize.css',
        [],
        filemtime(get_stylesheet_directory() . '/assets/css/customize.css')
    );

    // Framing (load sau customize)
    wp_enqueue_style(
        'framing-css',
        get_stylesheet_directory_uri() . '/assets/css/framing.css',
        ['customize-css'],
        filemtime(get_stylesheet_directory() . '/assets/css/framing.css')
    );
    // Cart layout
    wp_enqueue_style(
        'cart-css',
        get_stylesheet_directory_uri() . '/assets/css/cart.css',
        [],
        filemtime(get_stylesheet_directory() . '/assets/css/cart.css')
    );
     wp_enqueue_style(
        'checkout-css',
        get_stylesheet_directory_uri() . '/assets/css/checkout.css',
        [],
        filemtime(get_stylesheet_directory() . '/assets/css/checkout.css')
    );

    /* ===== JS ===== */

    wp_enqueue_script(
        'framing-js',
        get_stylesheet_directory_uri() . '/assets/js/framing.js',
        [],
        filemtime(get_stylesheet_directory() . '/assets/js/framing.js'),
        true
    );

});
