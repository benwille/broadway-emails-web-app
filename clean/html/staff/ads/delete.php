<?php

require_once '../../../private/initialize.php';
require_login();
require_admin();

if ( ! isset( $_GET['id'] ) ) {
	redirect_to( url_for( '/staff/emails/index.php' ) );
}

if ( ! isset( $_GET['station'] ) ) {
	redirect_to( url_for( '/staff/emails/index.php' ) );
}
$station = $_GET['station'];
$id      = $_GET['id'];
$ad      = Ad::find_by_id( $id );
if ( $ad == false ) {
	redirect_to( url_for( '/staff/emails/index.php?station=' . h( $station ) ) );
}

if ( is_post_request() ) {

	// Delete task
	$ad->delete();
	$session->message( 'The ad was deleted successfully.' );
	redirect_to( url_for( '/staff/emails/index.php?station=' . h( $station ) ) );

} else {
	// Display form
}

?>

<?php $page_title = 'Delete Ad'; ?>
<?php require SHARED_PATH . '/staff_header.php'; ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for( '/staff/emails/index.php?station=' . h( $station ) ); ?>">&laquo; Back to List</a>

  <div class="bicycle delete">
	<h1>Delete Ad</h1>
	<p>Are you sure you want to delete this ad?</p>
	<p class="item"><?php echo h( $ad->title ); ?></p>
	<img src="<?php echo h( $ad->imageLink ); ?>">

	<form action="<?php echo url_for( '/staff/emails/delete.php?id=' . h( u( $id ) ) . '&station=' . h( $station ) ); ?>" method="post">
	  <div class="form-group row" id="operations">
		<div class="col-auto">
		  <button class="btn btn-primary" type="submit" name="commit" value="Delete Post">Delete Ad</button>
		</div>
	  </div>
	</form>
  </div>

</div>

<?php require SHARED_PATH . '/staff_footer.php'; ?>
