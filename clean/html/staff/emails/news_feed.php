<?php require_once '../../../private/initialize.php'; ?>
<?php require_login(); ?>

<?php
if ( ! isset( $_GET['station'] ) ) {
	redirect_to( url_for( '/staff/emails/index.php' ) );
}
  $station = $_GET['station'];
foreach ( Email::STATION_URL as $station_id => $station_url ) {
	if ( $station == $station_id ) {
		$stationURL = $station_url;
		break;
	}
}
?>

<?php
	$feed    = simplexml_load_file( 'https://www.' . $stationURL . '.com/feed' );
	$channel = $feed->channel;
	$items   = $channel->item;

	// foreach($items[1]->category as $category) {
	// echo $category;
	// };
  // die;
if ( is_post_request() ) {

	// Create record using post parameters
	$args = $_POST['item'];
	// var_dump($args);
	$message = [];
	$x       = 0;
	foreach ( $args as $arg ) {
		$item     = new Email( $arg );
		$result   = $item->save();
		$errors[] = $item->errors;
		if ( $result === true ) {
			$x++;
			// Show all the articles uploaded
			// echo '<pre>';
			// print_r ($item);
			// echo '</pre><br />';
			// $new_id = $task->id;
			// $session->message('The article was added successfully.');
			// redirect_to(url_for('/staff/posts/index.php?id=' . $new_id));
		} else {
			// show errors
			continue;
		}
	}
	// print_r ($item->shift_errors_array());
	$msg = $x . ' were added successfully. ' . ( 10 - $x ) . ' were duplicates.';
	$session->message( $msg );

} else {
	// display the form
	$item = new Email();

}
?>

<!-- <script src="<?php // echo url_for('/js/jquery.slim.min.js'); ?>"></script>
<script>
jQuery(document).ready(function() {
		setTimeout(function() {
				 document.forms["form"].submit()
		}, 300000);
});
</script> -->


<?php $page_title = 'X96 Posts'; ?>
<?php require SHARED_PATH . '/staff_header.php'; ?>
<?php echo display_errors( $item->errors ); ?>
<div class="container">
<form action="<?php echo 'news_feed.php?station=' . $station; ?>" method="post" id="form">
	<div class="table-responsive">
		<table class="list table">
			<tr>
				<td>Title</td>
				<td>Category</td>
				<td>Link</td>
				<td>PubDate</td>
				<td>Image</td>
				<td>Excerpt</td>
			</tr>
			<?php $article = []; ?>
			<?php
				$i = 0;
			while ( $i < 10 ) {
				?>
				<?php
				$description = ( explode( 'wp-content/uploads/', $items[ $i ]->description ) );
				if ( ! isset( $description[1] ) ) {
					$description[1] = null;
					$image[0]       = 'images/full-stadium-for-web.jpg';
				} else {
					$image = ( explode( '"', $description[1] ) );
				} // image Link

				$date = date_create( h( $items[ $i ]->pubDate ), timezone_open( 'GMT' ) );
				date_timezone_set( $date, timezone_open( 'America/Denver' ) );
				// set date/time
				// $category = $items[$i]->category;
				$c   = 0;
				$len = count( $items[ $i ]->category );
				foreach ( $items[ $i ]->category as $category ) {

					switch ( $category ) {
						case 'News':
							$categoryID = 1;
							break;
						case 'Music':
							$categoryID = 1;
							break;
						case 'Life':
							$categoryID = 2;
							break;
						case 'Contests':
							$categoryID = 3;
							break;
						// case 'ESPN 700 Interviews':
						// $categoryID = 4;
						// break;
						case 'RSL':
							$categoryID = 5;
							break;
						case 'Utah Jazz':
							$categoryID = 6;
							break;
						case 'University of Utah':
							$categoryID = 7;
							break;

						default:
							$categoryID = 0;
							break;
					}

					if ( $c < $len - 1 ) {
						if ( $categoryID === 0 ) {
							$c++;
							continue;
						}
					}
					break;
				}
				$description = ( explode( '</div>', $items[ $i ]->description ) );
				$excerpt     = ( explode( '[', $description[1] ) );
				?>
			<tr>
					<td><input type="text" name="item[<?php echo h( $i ); ?>][title]"  value="<?php echo h( $items[ $i ]->title ); ?>" readonly></td>
					<td><input type="number" name="item[<?php echo h( $i ); ?>][category]"  value="<?php echo h( $categoryID ); ?>"></td>
					<td><input type="text" name="item[<?php echo h( $i ); ?>][link]"  value="<?php echo h( $items[ $i ]->link ); ?>" readonly></td>
					<td><input type="text" name="item[<?php echo h( $i ); ?>][pubDate]"  value="<?php echo date_format( $date, 'Y-m-d H:i:s' ); ?>" placeholder="hello" readonly></td>
					<td><input type="text" name="item[<?php echo h( $i ); ?>][imageLink]"  value="<?php echo( 'https://' . $stationURL . '.com/wp-content/uploads/' . h( $image[0] ) ); ?>" readonly></td>
					<td><input type="text" name="item[<?php echo h( $i ); ?>][excerpt]"  value="<?php echo h( trim( $excerpt[0] ) ); ?>" readonly></td>
			</tr>
			<input type="hidden" name="item[<?php echo h( $i ); ?>][station]"  value="<?php echo $station; ?>" readonly>

				<?php
				$i++;
			}
			?>
		</table>
	</div>
	<div id="operations">

	<input type="submit" value="Add Articles" />
  </div>
</form>
</div>
<?php require SHARED_PATH . '/staff_footer.php'; ?>
