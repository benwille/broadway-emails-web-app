<?php require_once( '../../../private/initialize.php' ); ?>
<?php
if ( is_post_request() ) {
	$posts = $_POST['posts'];
	$count = 0;
	foreach ( $posts as $post ) {
		// Create record using post parameters
		$args = $post;
		$id = $post['id'];
		$station = $post['station'];
		$post = Email::find_by_id( $id );
		var_dump( $post );

		$post->merge_attributes( $args );

		$result = $post->save();
		if ( $result === true ) {

			$count++;

		} else {
			// show errors
		}
	}

	$session->message( $count . ' posts were updated successfully.' );
}


