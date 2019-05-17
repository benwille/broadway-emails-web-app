<?php

require_once '../../../private/initialize.php';
require_login();
require_admin();

if ( ! isset( $_GET['id'] ) ) {
	redirect_to( url_for( '/staff/admins/' ) );
}
$id    = $_GET['id'];
$admin = Feed::find_by_id( $id );
if ( $admin == false ) {
	redirect_to( url_for( '/staff/admins/' ) );
}

if ( is_post_request() ) {

	// Delete task
	$admin->delete();
	$session->message( 'The admin was deleted successfully.' );
	redirect_to( url_for( '/staff/admins/' ) );

} else {
	// Display form
}

?>

<?php $page_title = 'Delete Staff'; ?>
<?php require SHARED_PATH . '/staff_header.php'; ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for( '/staff/admins/' ); ?>">&laquo; Back to List</a>

  <div class="bicycle delete">
	<h1>Delete Post</h1>
	<p>Are you sure you want to delete this admin?</p>
	<p class="item"><?php echo h( $admin->full_name() ); ?></p>

	<form action="<?php echo ( '?id=' . h( u( $id ) ) ); ?>" method="post">
	  <div class="form-group row" id="operations">
		<div class="col-auto">
		  <button class="btn btn-primary" type="submit" name="commit" value="Delete Admin">Delete Admin</button>
		</div>
	  </div>
	</form>
  </div>

</div>

<?php require SHARED_PATH . '/staff_footer.php'; ?>
