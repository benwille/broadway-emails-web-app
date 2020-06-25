<?php

require_once( '../../../private/initialize.php' );
require_login();
require_admin();

if ( ! isset( $_GET['id'] ) ) {
	redirect_to( url_for( '/staff/emails/index.php' ) );
}

if ( ! isset( $_GET['station'] ) ) {
	redirect_to( url_for( '/staff/emails/index.php' ) );
}
$station = $_GET['station'];
$id = $_GET['id'];
$post = Email::find_by_id( $id );
if ( $post == false ) {
	redirect_to( url_for( '/staff/emails/index.php?station=' . h( $station ) ) );
}

if ( is_post_request() ) {

	// Save record using post parameters
	$args = $_POST['post'];
	$post->merge_attributes( $args );
	$result = $post->save();

	if ( $result === true ) {
		$session->message( 'The email was updated successfully.' );
		redirect_to( url_for( '/staff/emails/index.php?station=' . $station ) );
	} else {
		// show errors
	}
} else {

	// display the form
}

?>

<?php $page_title = 'Edit Post'; ?>
<?php include( SHARED_PATH . '/staff_header.php' ); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for( '/staff/emails/index.php?station=' . h( $station ) ); ?>">&laquo; Back to List</a>

  <div class="email edit">
	<h1>Edit <?php echo h( $post->title ); ?></h1>

	<?php echo display_errors( $post->errors ); ?>

	<form action="<?php echo url_for( '/staff/emails/edit.php?id=' . h( u( $id ) ) . '&station=' . h( $station ) ); ?>" method="post">

		<?php include( 'form_fields.php' ); ?>

	  <div id="operations">
		<input type="submit" value="Edit Post" />
	  </div>
	</form>

  </div>

</div>

<?php include( SHARED_PATH . '/staff_footer.php' ); ?>
