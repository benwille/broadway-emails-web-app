<?php

require_once( '../../../private/initialize.php' );
require_login();
require_admin();

if ( ! isset( $_GET['id'] ) ) {
	redirect_to( url_for( '/staff/emails/index.php' ) );
}

// if(!isset($_GET['station'])) {
// redirect_to(url_for('/staff/emails/index.php'));
// }
$station = $_GET['station'];
$backLink = $station ? url_for( '/staff/emails/index.php?station=' . h( $station ) ) : url_for( '/staff/ads/index.php' );

$id = $_GET['id'];
$ad = Ad::find_by_id( $id );
if ( $ad == false ) {
	redirect_to( url_for( '/staff/emails/index.php?station=' . h( $station ) ) );
}

if ( is_post_request() ) {

	// Save record using post parameters
	$args = $_POST['ad'];
	$args['station'] = serialize( $args['station'] );

	$ad->merge_attributes( $args );
	$result = $ad->save();

	if ( $result === true ) {
		$session->message( 'The ad was updated successfully.' );
		if ( $station ) {
			redirect_to( url_for( '/staff/emails/index.php?station=' . h( $station ) ) );
		} else {
			redirect_to( url_for( '/staff/ads/index.php' ) );
		}
	} else {
		// show errors
	}
} else {

	// display the form
}

?>

<?php $page_title = 'Edit Ad'; ?>
<?php include( SHARED_PATH . '/staff_header.php' ); ?>

<div id="content">

  <a class="back-link" href="<?php echo $backLink; ?>">&laquo; Back to List</a>

  <div class="email edit">
	<h1>Edit <?php echo h( $ad->title ); ?></h1>

	<?php echo display_errors( $ad->errors ); ?>

	<form action="<?php echo url_for( '/staff/ads/edit.php?id=' . h( u( $id ) ) . '&station=' . h( $station ) ); ?>" method="post">

		<?php include( 'form_fields.php' ); ?>

	  <div id="operations">
		<input type="submit" value="Edit Ad" />
	  </div>
	</form>

  </div>

</div>

<?php include( SHARED_PATH . '/staff_footer.php' ); ?>
