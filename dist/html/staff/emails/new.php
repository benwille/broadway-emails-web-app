<?php

require_once '../../../private/initialize.php';
require_login();
require_admin();

if ( ! isset( $_GET['station'] ) ) {
	redirect_to( url_for( '/staff/emails/' ) );
}
$station = $_GET['station'];

if ( is_post_request() ) {

	// Create record using post parameters
	$args   = $_POST['post'];
	$post   = new Email( $args );
	$result = $post->save();
	// print_r ($admin->sanitized_attributes());
	if ( $result === true ) {
		$new_id = $post->id;
		$session->message( 'The post was created successfully.' );
		redirect_to( url_for( '/staff/emails/?station=' . $station ) );

	} else {
		// show errors
	}
} else {
	// display the form
	$post = new Email();
}


?>

<?php $page_title = 'Create Post'; ?>
<?php require SHARED_PATH . '/staff_header.php'; ?>

<div id="content">

<a class="back-link" href="<?php echo url_for( '/staff/emails/?station=' . h( $station ) ); ?>">&laquo; Back to List</a>

  <div class="email new">
	<h1>Create Post</h1>

	<?php echo display_errors( $post->errors ); ?>

	<form action="<?php echo '?station=' . h( $station ); ?>" method="post">

		<?php require 'form_fields.php'; ?>

	  <div id="operations">
		<input type="submit" value="Create Post" />
	  </div>
	</form>

  </div>

</div>

<?php require SHARED_PATH . '/staff_footer.php'; ?>
