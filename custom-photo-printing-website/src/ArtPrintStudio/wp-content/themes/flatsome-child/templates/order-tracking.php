<?php
/* Template Name: Order Tracking */

global $wpdb;

/* =========================
   LOAD CSS
========================= */
wp_enqueue_style(
  'order-tracking-css',
  get_stylesheet_directory_uri() . '/assets/css/tracking.css',
  [],
  null
);

get_header();

/* =========================
   1. LẤY order_id TỪ URL
========================= */
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if (!$order_id) {
  echo '<p style="padding:30px">Invalid order.</p>';
  get_footer();
  exit;
}

/* =========================
   2. LẤY ORDER THEO ID
========================= */
$order = $wpdb->get_row(
  $wpdb->prepare(
    "SELECT * FROM Orders WHERE order_id = %d",
    $order_id
  )
);

if (!$order) {
  echo '<p style="padding:30px">Order not found.</p>';
  get_footer();
  exit;
}

/* =========================
   3. STATUS → STEP
========================= */
$status = $order->status;

$steps = [
  'pending'   => 1,
  'printing'  => 2,
  'shipping'  => 3,
  'completed' => 4
];

$current_step = $steps[$status] ?? 1;

/* =========================
   4. LẤY DANH SÁCH SẢN PHẨM
========================= */
$items = $wpdb->get_results(
  $wpdb->prepare(
    "
    SELECT
      oi.quantity,
      oi.unit_price,
      pc.frame_id,
      f.frame_name,
      f.frame_thumbnail
    FROM Order_Items oi
    JOIN Print_Configurations pc ON oi.config_id = pc.config_id
    JOIN Frames f ON pc.frame_id = f.frame_id
    WHERE oi.order_id = %d
    ",
    $order_id
  )
);
?>

<div class="order-tracking-page">

  <!-- HEADER -->
  <div class="order-header-box">
    <div>
      <strong>Order: #ORD-<?php echo esc_html($order_id); ?></strong>
      <div class="sub">
        Order Date: <?php echo date('d/m/Y', strtotime($order->created_at)); ?>
      </div>
    </div>

    <div class="order-status">
      Status: <strong><?php echo ucfirst($status); ?></strong><br>
      Total: <?php echo number_format($order->total_amount); ?> VND
    </div>

    <div class="arrival">
      Expected Arrival<br>
      <span class="date">
        <?php echo date('d/m/Y', strtotime('+4 days', strtotime($order->created_at))); ?>
      </span>
    </div>
  </div>

  <!-- TRACKING -->
  <div class="tracking-box">
    <h4>Track your Order</h4>

    <div class="progress">
      <div class="step <?php echo $current_step >= 1 ? 'active' : ''; ?>">Pending</div>
      <div class="step <?php echo $current_step >= 2 ? 'active' : ''; ?>">Printing</div>
      <div class="step <?php echo $current_step >= 3 ? 'active' : ''; ?>">Shipping</div>
      <div class="step <?php echo $current_step >= 4 ? 'active' : ''; ?>">Completed</div>
    </div>
  </div>

  <!-- ORDER ITEMS -->
  <div class="order-items">
    <h4>All Order</h4>

    <?php foreach ($items as $item): ?>
      <div class="order-item">

        <img
          src="<?php echo esc_url($item->frame_thumbnail); ?>"
          alt="<?php echo esc_attr($item->frame_name); ?>"
        >

        <div class="item-info">
          <strong><?php echo esc_html($item->frame_name); ?></strong>
        </div>

        <div class="qty">
          Qty: <?php echo intval($item->quantity); ?>
        </div>

        <div class="price">
          <?php echo number_format($item->unit_price); ?> VND
        </div>

        <div class="actions">
          <?php if ($status === 'shipping'): ?>
            <button class="btn-green">Receive</button>
          <?php endif; ?>
          <button class="btn-orange">Buy Again</button>
        </div>

      </div>
    <?php endforeach; ?>

  </div>

</div>

<?php get_footer(); ?>


