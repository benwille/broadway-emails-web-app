<?php

require_once '../../../private/initialize.php';
require_login();
require_admin();

if ( ! isset( $_GET['id'] ) ) {
	redirect_to( url_for( '/staff/emails/' ) );
}

if ( ! isset( $_GET['station'] ) ) {
	redirect_to( url_for( '/staff/emails/' ) );
}
$station = $_GET['station'];
$id      = $_GET['id'];
$post    = Email::find_by_id( $id );
if ( $post == false ) {
	redirect_to( url_for( '/staff/emails/?station=' . h( $station ) ) );
}

if ( is_post_request() ) {

	// Delete task
	$post->delete();
	$session->message( 'The post was deleted successfully.' );
	redirect_to( url_for( '/staff/emails/?station=' . h( $station ) ) );

} else {
	// Display form
}

?>

<?php $page_title = 'Delete Post'; ?>
<?php require SHARED_PATH . '/staff_header.php'; ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for( '/staff/emails/?station=' . h( $station ) ); ?>">&laquo; Back to List</a>

  <div class="bicycle delete">
	<h1>Delete Post</h1>
	<p>Are you sure you want to delete this post?</p>
	<p class="item"><?php echo h( $post->title ); ?></p>

	<form action="<?php echo '?id=' . h( u( $id ) ) . '&station=' . h( $station ); ?>" method="post">
	  <div class="form-group row" id="operations">
		<div class="col-auto">
		  <button class="btn btn-primary" type="submit" name="commit" value="Delete Post">Delete Post</button>
		</div>
	  </div>
	</form>
  </div>

</div>

<?php require SHARED_PATH . '/staff_footer.php'; ?>
