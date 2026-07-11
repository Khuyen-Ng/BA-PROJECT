<?php
/*
Plugin Name: Photo Printing Plugin
Description: Handle photo uploads, gallery, and frame preview logic.
Version: 2.0
Author: Team 7
*/

if (!defined('ABSPATH')) exit;

// =============================
// 1) LOAD CÁC MODULE
// =============================
include_once plugin_dir_path(__FILE__) . 'includes/install.php';
include_once plugin_dir_path(__FILE__) . 'includes/upload-handler.php';
include_once plugin_dir_path(__FILE__) . 'includes/shortcode-gallery.php';


// =============================
// 2) CHẠY INSTALL KHI ACTIVATE PLUGIN
// =============================
register_activation_hook(__FILE__, 'pp_install_tables');


// 3) ENQUEUE CSS + JS RIÊNG
add_action('wp_enqueue_scripts', 'pp_enqueue_frontend_assets');
function pp_enqueue_frontend_assets() {

    $plugin_url = plugin_dir_url(__FILE__);

    // CSS gallery riêng
    wp_enqueue_style(
        'pp-gallery-css',
        $plugin_url . 'assets/css/gallery.css',
        array(),
        null
    );

    // Fancybox JS 
    wp_enqueue_script(
        'pp-fancybox-js',
        'https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js',
        array(),
        null,
        true
    );

    wp_enqueue_style(
        'pp-fancybox-css',
        'https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css',
        array(),
        null
    );

    // JS custom gallery
    wp_enqueue_script(
        'pp-gallery-js',
        $plugin_url . 'assets/js/gallery.js',
        array('pp-fancybox-js'),
        null,
        true
    );
}
