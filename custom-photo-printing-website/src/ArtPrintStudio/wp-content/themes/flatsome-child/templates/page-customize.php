<?php

/* Template Name: Customize */
global $wpdb;

/* =========================
   HANDLE ADD TO CART
========================= */
if (isset($_POST['add_to_cart'])) {

  $user_id = get_current_user_id();

//  $image_data = $_POST['image_data']; // base64 hoặc path

  // $size_id  = intval($_POST['size_id']);
 $frame_id = intval($_POST['frame_id']);
$size_id  = intval($_POST['size_id']);

if (!$frame_id || !$size_id) {
  wp_die('Missing size or frame');
}

// LẤY FRAME PRICE
$frame = $wpdb->get_row(
  $wpdb->prepare(
    "SELECT base_price FROM Frames WHERE frame_id = %d",
    $frame_id
  )
);

if (!$frame) {
  wp_die('Invalid frame');
}

// ✅ LẤY SIZE FACTOR (BẠN ĐANG THIẾU ĐOẠN NÀY)
$size = $wpdb->get_row(
  $wpdb->prepare(
    "SELECT size_factor FROM Print_Sizes WHERE size_id = %d",
    $size_id
  )
);

if (!$size) {
  wp_die('Invalid size');
}

// ✅ TÍNH GIÁ ĐÚNG
$unit_price = (int) round($frame->base_price * $size->size_factor);
  // INSERT PRINT_CONFIGURATIONS
  $wpdb->insert('Print_Configurations', [
    
    'size_id'    => $size_id,
    'frame_id'   => $frame_id,
    'quantity'   => 1,
    'unit_price' => $unit_price
  ]);

  $config_id = $wpdb->insert_id;

  // CART
  $cart = $wpdb->get_row(
    $wpdb->prepare(
      "SELECT cart_id FROM Carts WHERE user_id = %d",
      $user_id
    )
  );

  if (!$cart) {
    $wpdb->insert('Carts', ['user_id' => $user_id]);
    $cart_id = $wpdb->insert_id;
  } else {
    $cart_id = $cart->cart_id;
  }

  // CART ITEMS
  $wpdb->insert('Cart_Items', [
    'cart_id'   => $cart_id,
    'config_id' => $config_id,
    'quantity'  => 1,
    'subtotal'  => $unit_price
  ]);

  // UPDATE TOTAL
  $wpdb->query(
    $wpdb->prepare(
      "
      UPDATE Carts
      SET total_amount = (
        SELECT SUM(subtotal)
        FROM Cart_Items
        WHERE cart_id = %d
      )
      WHERE cart_id = %d
      ",
      $cart_id,
      $cart_id
    )
  );

  wp_redirect(site_url('/artprintstudio/cart-2'));
  exit;
}

/* =========================
   LOAD PAGE
========================= */
get_header();

/* GỌI CSS & JS RIÊNG CHO TRANG CUSTOMIZE */

//LOAD STICKER

$stickers = $wpdb->get_results("
  SELECT sticker_id, sticker_name, sticker_image, base_size
  FROM Stickers
  WHERE is_active = 1
");


//LOAD SIZE 
$sizes = $wpdb->get_results("
  SELECT size_id, size_name, orientation, size_factor
  FROM print_sizes
  WHERE is_active = 1
"); 
wp_enqueue_script(
  'customize-frame-js',
  get_stylesheet_directory_uri() . '/assets/js/custom.js',
  [],
  null,
  true
);
//LOAD FRAME
$frames = $wpdb->get_results("
  SELECT frame_id, frame_name, frame_image, frame_thumbnail, base_price
  FROM Frames
  WHERE is_active = 1
");


?>
<div class="sf-wrapper">
    <div class="sf-top">
        <a href="/start-framing" class="sf-back">← BACK</a>
    </div>

    <div class="sf-body">

        <!-- LEFT STEP -->
        <div class="sf-sidebar">
            <div class="sf-step">Add Photos</div>
            <div class="sf-step active">Edit Photos & Layout</div>
            <div class="sf-step">Order</div>
        </div>

        <!-- CONTENT -->
        <div class="sf-content">

            <!-- PREVIEW CARD -->
            <div class="customize-card">

  <!-- LEFT: PHOTO -->
  <div class="customize-left">
  <div class="photo-frame">
 
  <div id="frameBox" class="frame-box">
    <img id="userPhoto" alt="Your photo">
  </div>


</div>
</div>

  <!-- RIGHT: TOOLS -->
  <div class="customize-right">
    <p class="edit-title">
      Now’s the time to crop or enhance your photo if you’d like.
    </p>

    <div class="tool-list">
    <button data-tool="plus" class="tool-btn">
        <img 
            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/plus.svg"
             alt="Plus">
    </button>
    <button data-tool="minus" class="tool-btn">
        <img 
            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/minus.svg"
             alt="Minus">
    </button>
      
    <button data-tool="rotate" class="tool-btn">
         <img 
             src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/rotate-cw.svg"
            alt="Rotate">
    </button>
      
     <button data-tool="brighten" class="tool-btn">
         <img 
             src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/sun.svg"
            alt="Brighten">
    </button>
    
      
    <button data-tool="bw" class="tool-btn">
         <img 
             src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/circle-with-left-half-black-svgrepo-com.svg"
            alt="B&W">
    </button>
    

    <button data-tool="remove" class="tool-btn">
      
         <img 
             src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/trash.svg"
            alt="Remove">
    </button>
    
    </div>
  <div>
    <button type="button" id="btnDoneSticker" class="tool-btn">
  Done
</button>

  </div>

    <!-- TOOL SLIDERS -->
<div class="tool-sliders">

  <!-- Brightness -->
  <div class="slider-group" data-slider="brighten">
    <label>Brightness</label>
    <input 
      type="range" 
      min="0.5" 
      max="1.8" 
      step="0.05" 
      value="1"
      id="brightnessSlider"
    >
  </div>

  <!-- B&W -->
  <div class="slider-group" data-slider="bw">
    <label>Black & White</label>
    <input 
      type="range" 
      min="0" 
      max="100" 
      step="1" 
      value="0"
      id="bwSlider"
    >
  </div>

</div>

  </div>

</div>


<!-- FRAME SELECT WRAPPER -->
<div class="frame-select-wrapper">

  <button class="frame-nav prev" id="framePrev">‹</button>

  <div class="frame-viewport">
    <div class="frame-selector" id="frameTrack">
      <?php foreach ($frames as $frame): ?>
      <div class="frame-option"
     data-frame-id="<?= esc_attr($frame->frame_id); ?>"
     data-frame-name="<?= esc_attr($frame->frame_name); ?>"
     data-price="<?= (int)$frame->base_price ?>"
     data-frame-image="<?= esc_url($frame->frame_image); ?>">

          <img
            src="<?php echo esc_url($frame->frame_thumbnail); ?>"
            alt="<?php echo esc_attr($frame->frame_name); ?>">
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <button class="frame-nav next" id="frameNext">›</button>

</div>
      <!--SIZE-->
<div class="size-select">

  <div class="size-options" id="sizeOptions">
      <p class="size-title">Select Size</p>
    <?php foreach ($sizes as $size): ?>
      <button
  type="button"
  class="size-option"
  data-size-id="<?= esc_attr($size->size_id); ?>"
  data-size-name="<?= esc_attr($size->size_name); ?>"
  data-factor="<?= esc_attr($size->size_factor); ?>"
  data-orientation="<?= esc_attr($size->orientation); ?>"
  style="display:none;"
>
  <?= esc_html($size->size_name); ?>
</button>
    <?php endforeach; ?>
  </div>
</div>

<!-- MATERIAL SELECT -->
<div class="material-select">

  <div class="material-options">
      <p class="material-title">Select Material</p>

    <div class="material-option active" data-material="canvas">
      <span class="material-dot canvas"></span>
      <span class="material-name">Canvas</span>
    </div>

    <div class="material-option" data-material="acrylic">
      <span class="material-dot acrylic"></span>
      <span class="material-name">Acrylic</span>
    </div>

    <div class="material-option" data-material="plastic">
      <span class="material-dot plastic"></span>
      <span class="material-name">Plastic</span>
    </div>

  </div>
</div>
<button type="button" id="btnSticker" class="tool-btn">
<p>Select Stickers</p>
</button>

<div id="stickerOverlay" class="sticker-overlay">
  <div class="sticker-panel">

<button
  class="sticker-close"
  onclick="document.getElementById('stickerOverlay').style.display='none'">
  ✕
</button>


    <div class="sticker-grid">
      <?php foreach ($stickers as $sticker): ?>
        <img
          src="<?= esc_url($sticker->sticker_image); ?>"
          class="sticker-item"
          data-size="<?= esc_attr($sticker->base_size); ?>"
        >
      <?php endforeach; ?>
    </div>

  </div>
</div>



            <!-- FOOTER -->
<form method="post" class="customize-footer">

  <input type="hidden" name="photo_id" id="photo_id">
   <input type="hidden" name="size_id" id="size_id">
  <input type="hidden" name="frame_id" id="frame_id">
  <!-- <input type="hidden" name="material" id="material"> -->
  <input type="hidden" name="quantity" value="1">

  <button type="button" class="sf-save">Save Creation</button>

  <div class="summary-box">
    <p><strong>Summary</strong></p>
    <p id="summaryText">—</p>
    <p class="price" id="summaryPrice">—</p>

    <button type="submit" name="add_to_cart" class="sf-add-cart">
      Add to cart
    </button>
  </div>

</form>


        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const photo = localStorage.getItem('uploadedPhoto');
  const img = document.getElementById('userPhoto');

  if (photo && img) {
    img.src = photo;
  }
});





</script>


<?php get_footer(); ?>
<div id="ratioModal" class="ratio-modal">
  <div class="ratio-box">
    <h3>⚠ Image ratio mismatch</h3>
    <p>
      Your image ratio does not match the selected frame.
      Please choose how to adjust your photo.
    </p>

    <div class="ratio-actions">
      <button onclick="applyFit()">Fit image to frame</button>
      <button onclick="applyCrop()">Crop image to fit</button>
    </div>

    <button class="ratio-close" onclick="closeRatioModal()">Cancel</button>
  </div>
</div>

