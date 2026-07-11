<?php
/* Template Name: Cart Custom */
get_header();
global $wpdb;

$user_id = get_current_user_id();

/*
  LOAD CART TRỰC TIẾP TỪ PRINT_CONFIGURATIONS
  (mỗi config = 1 sản phẩm)
*/
$configs = $wpdb->get_results("
  SELECT
    pc.config_id,
    pc.unit_price,
    pc.size_id,
    pc.quantity,
    s.size_name,
    f.frame_name,
    f.frame_thumbnail
  FROM Print_Configurations pc
  JOIN Frames f 
    ON pc.frame_id = f.frame_id
  JOIN Print_Sizes s
    ON pc.size_id = s.size_id
  ORDER BY pc.created_at DESC
");


$total = 0;
foreach ($configs as $c) {
  $total += (int) $c->unit_price;
}
?>

<div class="sf-cart-wrapper">

  <!-- TOP -->
  <div class="sf-cart-top">
    <a href="/artprintstudio/customize" class="sf-back">← CONTINUE SHOPPING</a>

    <div class="sf-steps">
      <span class="step active">1 Cart & Options</span>
      <span class="divider"></span>
      <span class="step">2 Shipping & Payment</span>
    </div>
  </div>

  <div class="sf-cart-body">

    <!-- LEFT -->
    <div class="sf-cart-left">

      <!-- GIFT BOX -->
      <div class="sf-gift-box">
        <h3>Add a Gift wrap and Personalized card</h3>
        <p class="note">Just for Rs. 89.</p>

        <div class="gift-tags">
          <span class="active">Gift Card</span>
          <span>Love and Life</span>
          <span>Magical Moments</span>
          <span>Be Mine</span>
          <span>Love is Forever</span>
        </div>

        <textarea placeholder="Enter your heartfelt message here to make this gift unique."></textarea>

        <button class="gift-btn">GIFT WRAP MY ORDER</button>
      </div>

      <!-- CART ITEMS -->
      <?php if (!$configs): ?>
        <p>Your cart is empty.</p>
      <?php endif; ?>

      <?php foreach ($configs as $item): ?>
        <<div class="sf-cart-item"
     data-price="<?php echo (int)$item->unit_price; ?>"
     data-name="<?php echo esc_attr($item->frame_name . ' ' . $item->size_name); ?>"
>

          <img
            src="<?php echo esc_url($item->frame_thumbnail); ?>"
            class="cart-thumb"
            alt=""
          >

          <div class="cart-info">
            <p class="title"><?php echo esc_html($item->frame_name); ?></p>

            <p class="desc">
              <?php echo esc_html($item->frame_name); ?>
             
            </p>

            <p class="price">
               <?php echo number_format($item->unit_price); ?> VNĐ
            </p>

            <div class="cart-actions">
              <a href="/artprintstudio/customize?config_id=<?php echo $item->config_id; ?>">EDIT</a>
              <span>|</span>
              <a href="/artprintstudio/cart-delete?config_id=<?php echo $item->config_id; ?>">DELETE</a>
            </div>
          </div>

        <div class="cart-item-qty">
            <button class="qty-btn minus" type="button">
            <img 
            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/minus.svg"
             alt="Minus">
            </button>

            <span class="qty-number"><?php echo esc_html($item->quantity); ?></span>

            <button class="qty-btn plus" type="button">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/plus.svg" alt="Plus">
            </button>
</div>

        </div>
      <?php endforeach; ?>

    </div>

    <!-- RIGHT -->
    <div class="sf-cart-right">
      <div class="sf-summary-box">
        <h4>Summary</h4>

       <div class="summary-line" id="summaryLine">
  <span class="summary-name"></span>
  <span class="summary-price"></span>
</div>

        <a href="/artprintstudio/checkout-custom" class="checkout-btn">
          PROCEED TO CHECKOUT
        </a>
      </div>
    </div>

  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

  function updateSummary() {
    const summaryLine  = document.getElementById('summaryLine');
    const summaryTotal = document.getElementById('summaryTotal');

    let total = 0;
    let lines = [];

    document.querySelectorAll('.sf-cart-item').forEach(item => {
      const price = Number(item.dataset.price) || 0;
      const name  = item.dataset.name;

      const qtyEl = item.querySelector('.qty-number');
      const qty   = Number(qtyEl.textContent) || 1;

      total += price * qty;
      lines.push(`${qty} x ${name}`);
    });

    const nameEl  = summaryLine.querySelector('.summary-name');
const priceEl = summaryLine.querySelector('.summary-price');

nameEl.innerText  = lines.join(', ');
priceEl.innerText = total.toLocaleString() + ' VND';

  }

  document.querySelectorAll('.sf-cart-item').forEach(item => {
    const minus  = item.querySelector('.qty-btn.minus');
    const plus   = item.querySelector('.qty-btn.plus');
    const number = item.querySelector('.qty-number');

    let qty = Number(number.textContent) || 1;

    minus.addEventListener('click', () => {
      if (qty > 1) {
        qty--;
        number.textContent = qty;
        updateSummary();
      }
    });

    plus.addEventListener('click', () => {
      qty++;
      number.textContent = qty;
      updateSummary();
    });
  });

  // init khi load trang
  updateSummary();
});
</script>


<?php get_footer(); ?>
