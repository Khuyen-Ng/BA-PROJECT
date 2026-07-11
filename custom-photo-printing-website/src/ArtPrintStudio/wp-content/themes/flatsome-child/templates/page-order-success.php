<?php
/* Template Name: Order Success */
wp_enqueue_style(
  'order-success-css',
  get_stylesheet_directory_uri() . '/assets/css/order-success.css',
  [],
  null
);
get_header();
// LAY ORDER_ID
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
$current_user = wp_get_current_user();
$name = $current_user->exists() ? $current_user->display_name : 'Customer';
?>

<div class="order-success-page">
  <div class="success-box">

    <div class="success-icon">✓</div>

    <p class="success-hello">Hey <?php echo esc_html($name); ?>,</p>

    <h2 class="success-title">Order Placed Successfully!</h2>

    <p class="success-desc">
      We'll send you a shipping confirmation email<br>
      as soon as your order ships.
    </p>

   <a href="/artprintstudio/order-tracking?order_id=<?php echo $order_id; ?>" class="success-btn">
      CHECK STATUS
    </a>


  </div>
</div>

<?php get_footer(); ?>
