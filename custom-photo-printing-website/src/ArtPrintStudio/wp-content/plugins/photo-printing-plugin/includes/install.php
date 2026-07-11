<?php
if (!defined('ABSPATH')) exit;

function pp_install_tables() {
    global $wpdb;
    $charset = $wpdb->get_charset_collate();

    // tên bảng
    $table_photos = $wpdb->prefix . "pp_photos";
    $table_frames = $wpdb->prefix . "pp_frames";
    $table_orders = $wpdb->prefix . "pp_orders_extra";
    $table_reviews = $wpdb->prefix . "pp_reviews";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    // BẢNG 1: Lưu ảnh upload (FR02)
    $sql1 = "
        CREATE TABLE $table_photos (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id BIGINT(20) UNSIGNED NOT NULL,
            photo_url VARCHAR(255) NOT NULL,
            frame_id BIGINT(20) DEFAULT NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY (id)
        ) $charset;
    ";

    // BẢNG 2: Lưu khung (Frame – FR03/FR08)
    $sql2 = "
        CREATE TABLE $table_frames (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            frame_name VARCHAR(100) NOT NULL,
            frame_image VARCHAR(255) NOT NULL,
            price DECIMAL(10,2) DEFAULT 0,
            created_at DATETIME NOT NULL,
            PRIMARY KEY (id)
        ) $charset;
    ";

    // BẢNG 3: Thông tin đơn hàng mở rộng (FR05–FR07)
    $sql3 = "
        CREATE TABLE $table_orders (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            order_id BIGINT(20) UNSIGNED NOT NULL,
            user_id BIGINT(20) UNSIGNED NOT NULL,
            photo_id BIGINT(20) UNSIGNED NOT NULL,
            frame_id BIGINT(20) UNSIGNED DEFAULT NULL,
            status VARCHAR(50) NOT NULL DEFAULT 'pending',
            updated_at DATETIME NOT NULL,
            PRIMARY KEY (id)
        ) $charset;
    ";

    // BẢNG 4: Đánh giá sản phẩm/dịch vụ (FR10)
    $sql4 = "
        CREATE TABLE $table_reviews (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            order_id BIGINT(20) UNSIGNED NOT NULL,
            user_id BIGINT(20) UNSIGNED NOT NULL,
            rating TINYINT NOT NULL,
            comment TEXT,
            created_at DATETIME NOT NULL,
            PRIMARY KEY (id)
        ) $charset;
    ";

    // Thực thi
    dbDelta($sql1);
    dbDelta($sql2);
    dbDelta($sql3);
    dbDelta($sql4);
}
