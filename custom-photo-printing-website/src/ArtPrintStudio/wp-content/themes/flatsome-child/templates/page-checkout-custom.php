<?php
/* Template Name: Checkout Custom */
global $wpdb;

/* =========================
   HANDLE PLACE ORDER
========================= */
if (isset($_POST['place_order'])) {

  $user_id = get_current_user_id();

  $full_name = sanitize_text_field($_POST['full_name']);
  $phone     = sanitize_text_field($_POST['phone']);
  $address   = sanitize_text_field($_POST['address']);
  $payment   = sanitize_text_field($_POST['payment_method']);

  // Load cart
  $configs = $wpdb->get_results("
    SELECT
      pc.config_id,
      pc.unit_price,
      pc.quantity
    FROM Print_Configurations pc
    ORDER BY pc.created_at DESC
  ");

  if (!$configs) {
    wp_die('Cart is empty');
  }

  // TÍNH TỔNG
  $shipping_fee = 15000;
  $subtotal = 0;

  foreach ($configs as $c) {
    $subtotal += $c->unit_price * $c->quantity;
  }

  $total = $subtotal + $shipping_fee;

  // INSERT ORDER
  $wpdb->insert('Orders', [
    'user_id'           => $user_id,
    'total_amount'     => $total,
    'shipping_address' => $address,
    'phone'             => $phone,
    'payment_method'   => $payment,
    'status'            => 'pending',
    'created_at'        => current_time('mysql')
  ]);

  $order_id = $wpdb->insert_id;

  // INSERT ORDER ITEMS
  foreach ($configs as $c) {
    $wpdb->insert('Order_Items', [
      'order_id'   => $order_id,
      'config_id'  => $c->config_id,
      'quantity'   => $c->quantity,
      'unit_price' => $c->unit_price,
      'subtotal'   => $c->unit_price * $c->quantity
    ]);
  }

  // CLEAR CART
  $wpdb->query("DELETE FROM Print_Configurations");

  // REDIRECT
 wp_redirect('/artprintstudio/order-success?order_id=' . $order_id);
exit;

  exit;
}

/* =========================
   LOAD PAGE
========================= */
get_header();

/*
  LOAD CART
*/
$configs = $wpdb->get_results("
  SELECT
    pc.config_id,
    pc.unit_price,
    pc.quantity,
    s.size_name,
    f.frame_name
  FROM Print_Configurations pc
  JOIN Frames f ON pc.frame_id = f.frame_id
  JOIN Print_Sizes s ON pc.size_id = s.size_id
  ORDER BY pc.created_at DESC
");

$shipping_fee = 15000;
$subtotal = 0;

foreach ($configs as $c) {
  $subtotal += $c->unit_price * $c->quantity;
}

$total = $subtotal + $shipping_fee;
?>

<div class="checkout-page">

  <!-- TOP BAR -->
  <div class="checkout-top">
<!--XEM LAI CHO NAY-->
    <a href="/artprintstudio/cart-2" class="continue-shopping">← CONTINUE SHOPPING</a>

    <div class="checkout-steps">
      <span class="step done">1 Cart & Options</span>
      <span class="step active">2 Shipping & Payment</span>
    </div>
  </div>

  <form method="post" class="sf-checkout-wrapper">

    <!-- LEFT -->
    <div class="sf-checkout-left">
      <h3>Shipping and payment</h3>

      <!-- SHIPPING -->
      <div class="checkout-section">
        <h4>1. Shipping Address</h4>

        <label class="field-label">FULL NAME</label>
        <input type="text" name="full_name" placeholder="Full name" required>

        <label class="field-label">PHONE NUMBER</label>
        <input type="text" name="phone" placeholder="Phone number" required>
        <small class="field-note">
          OTP will be sent to this number when the package is out for delivery.
        </small>

        <label class="field-label">ADDRESS</label>
        <input type="text" name="address" placeholder="Address" required>
      </div>

      <!-- PAYMENT -->
     <div class="checkout-section">
  <h4>2. Payment Method</h4>

  <label class="payment">
    <input type="radio" name="payment_method" value="momo" checked>
    <img  src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/momo.png" alt="MoMo">
    <span>MoMo</span>
  </label>

  <label class="payment">
    <input type="radio" name="payment_method" value="vnpay">
    <img  src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/vnpay.png" alt="VNPay">
    <span>VNPay</span>
  </label>

  <label class="payment">
    <input type="radio" name="payment_method" value="bank">
    <img  src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/banktranfer.png" alt="Bank Transfer">
    <span>Bank Transfer</span>
  </label>

  <label class="payment">
    <input type="radio" name="payment_method" value="card">
    <img  src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/credit.png" alt="Credit Card">
    <span>Credit Card Payment</span>
  </label>
</div>

</div>
    <!-- RIGHT -->
    <div class="sf-checkout-right">
      <h4>Summary</h4>

      <?php foreach ($configs as $c): ?>
        <div class="summary-line">
          <span>
            <?php echo esc_html($c->quantity); ?> ×
            <?php echo esc_html($c->frame_name); ?>
            "<?php echo esc_html($c->size_name); ?>"
          </span>
          <span>
            <?php echo number_format($c->unit_price * $c->quantity); ?> VND
          </span>
        </div>
      <?php endforeach; ?>

      <div class="summary-line">
        <span>Shipping fee</span>
        <span><?php echo number_format($shipping_fee); ?> VND</span>
      </div>

      <!-- DISCOUNT UI -->
      <div class="summary-discount">
        <input type="text" placeholder="Discount Code">
        <button type="button">Apply</button>
      </div>

      <div class="summary-total">
        <strong>Total</strong>
        <strong><?php echo number_format($total); ?> VND</strong>
      </div>

      <button type="submit" name="place_order" class="place-order-btn">
        PLACE ORDER
      </button>
    </div>

  </form>

</div>

<?php get_footer(); ?>
