<?php

function pp_photo_library_shortcode() {
    global $wpdb;

    $table = $wpdb->prefix . 'photo_library';
    $user_id = get_current_user_id();

    $photos = $wpdb->get_results("
        SELECT * FROM $table 
        WHERE user_id = $user_id 
        ORDER BY created_at DESC
    ");

    ob_start();

    // Wrapper
    echo '<div class="pp-gallery">';

    foreach ($photos as $p) {
        echo '
        <div class="pp-item">
            <a href="'. esc_url($p->photo_url) .'" class="pp-popup">
                <img src="'. esc_url($p->photo_url) .'" loading="lazy" />
            </a>
        </div>';
    }

    echo '</div>';

    return ob_get_clean();
}
add_shortcode('pp_photo_library', 'pp_photo_library_shortcode');
