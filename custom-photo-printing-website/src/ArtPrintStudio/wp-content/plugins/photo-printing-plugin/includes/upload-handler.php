<?php

add_action('init', 'pp_handle_upload');

function pp_handle_upload() {

    // Không làm gì nếu không submit form
    if (!isset($_POST['pp_upload_photo'])) return;
    if (empty($_FILES['pp_photo'])) return;

    // Load file cần thiết để sử dụng wp_handle_upload
    require_once(ABSPATH . 'wp-admin/includes/file.php');

    // Thực hiện upload
    $uploaded = wp_handle_upload($_FILES['pp_photo'], ['test_form' => false]);

    if (!isset($uploaded['error'])) {

        global $wpdb;
        $table = $wpdb->prefix . 'photo_library';

        $wpdb->insert($table, [
            'user_id'    => get_current_user_id(),
            'photo_url'  => $uploaded['url'],
            'created_at' => current_time('mysql'),
        ]);

        // Redirect lại trang với param báo thành công
        wp_redirect(add_query_arg('uploaded', '1'));
        exit;
    }
}
