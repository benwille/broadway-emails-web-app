<?php

require_once('../../../private/initialize.php');
require_login();
require_admin();

if(!isset($_GET['station'])) {
  redirect_to(url_for('/staff/emails/index.php'));
}
$station = $_GET['station'];

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['ad'];
  $args['station'] = serialize($args['station']);
  
  $ad = new Ad($args);
  $result = $ad->save();
  // print_r ($admin->sanitized_attributes());

  if($result === true) {
    $new_id = $ad->id;
    $session->message('The ad was created successfully.');
    redirect_to(url_for('/staff/emails/index.php?station=' . $station));

} else {
  // show errors
  }
} else {
  // display the form
  $ad = new Ad;
}


?>

<?php $page_title = 'Create Ad'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

<a class="back-link" href="<?php echo url_for('/staff/emails/index.php?station=' . h($station)); ?>">&laquo; Back to List</a>

  <div class="email new">
    <h1>Create Post</h1>

    <?php echo display_errors($ad->errors); ?>

    <form action="<?php echo url_for('/staff/ads/new.php?station=' . h($station)); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create Ad" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
