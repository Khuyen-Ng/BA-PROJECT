<?php
/* Template Name: Saved Creation */
get_header();

if (!is_user_logged_in()) {
  wp_redirect(wp_login_url());
  exit;
}

global $wpdb;
$user_id = get_current_user_id();

$photos = $wpdb->get_results(
  $wpdb->prepare(
    "SELECT * FROM Photos WHERE wp_user_id = %d ORDER BY created_at DESC",
    $user_id
  )
);
?>

<div class="account-wrapper">
  <!-- SIDEBAR -->
  <aside class="account-sidebar">
    <h3>My Account</h3>
    <ul>
      <li><a href="#">Order History</a></li>
      <li class="active"><a href="#">Saved Creation <span class="badge"><?php echo count($photos); ?></span></a></li>
      <li><a href="#">Profile</a></li>
      <li><a href="#">Saved Coupon</a></li>
      <li><a href="#">Connected Accounts</a></li>
      <li><a href="#">Change Password</a></li>
      <li><a href="#">Address Book</a></li>
      <li><a href="#">Reward History</a></li>
    </ul>
  </aside>

  <!-- CONTENT -->
  <main class="account-content">
    <div class="saved-grid">

      <?php if (!$photos): ?>
        <p>Chưa có creation nào.</p>
      <?php endif; ?>

      <?php foreach ($photos as $p): ?>
        <div class="saved-card">
          <img
            src="<?php echo esc_url(wp_upload_dir()['baseurl'] . '/' . $p->file_path); ?>"
            alt=""
          >

          <div class="saved-info">
            <h4><?php echo esc_html($p->creation_name ?: 'Untitled'); ?></h4>
            <p class="sub">Saved on <?php echo date('d/m/Y', strtotime($p->created_at)); ?></p>

           <div class="actions">
  <a href="/artprintstudio/customize?photo_id=<?php echo $p->photo_id; ?>">Edit</a>
  <a href="#" class="dup" data-id="<?php echo $p->photo_id; ?>">Duplicate</a>
  <a href="#" class="del" data-id="<?php echo $p->photo_id; ?>">Delete</a>
</div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </main>
</div>

<?php get_footer(); ?>
