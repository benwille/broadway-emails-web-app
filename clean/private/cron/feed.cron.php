<?php require_once '../initialize.php'; ?>

<?php
if ( isset( $argv[1] ) ) {
	$_GET['station'] = $argv[1];
} else {
	redirect_to( url_for( '/staff/index.php' ) );
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
	date_default_timezone_set( 'America/Denver' );

?>

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
	$category = $items[ $i ]->category;
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

		default:
			$categoryID = 0;
			break;
	}
	$description = ( explode( '</div>', $items[ $i ]->description ) );
	$excerpt     = ( explode( '[', $description[1] ) );

	$posts['item'][ $i ]['title']     = h( $items[ $i ]->title );
	$posts['item'][ $i ]['category']  = h( $categoryID );
	$posts['item'][ $i ]['link']      = h( $items[ $i ]->link );
	$posts['item'][ $i ]['pubDate']   = h( date_format( $date, 'Y-m-d H:i:s' ) );
	$posts['item'][ $i ]['imageLink'] = 'https://' . $stationURL . '.com/wp-content/uploads/' . h( $image[0] );
	$posts['item'][ $i ]['excerpt']   = h( trim( $excerpt[0] ) );
	$posts['item'][ $i ]['station']   = h( $station );

	$i++;
}

 $args = $posts['item'];
 // var_dump($args);
 $message = [];
 $x       = 0;

foreach ( $args as $arg ) {
	$item     = new Email( $arg );
	$result   = $item->save();
	$errors[] = $item->errors;
	if ( $result === true ) {
		$x++;

	} else {
		continue;
	}
}

 $msg = $x . ' were added successfully. ' . ( 10 - $x ) . ' were duplicates.';
 echo date( 'l jS \of F Y h:i:s A' ) . ' - ' . $msg;
?>

<?php
$session->message( date( 'l jS \of F Y h:i:s A' ) . ' - ' . $msg );
redirect_to( '../../html/staff/emails/news_feed.php?station=' . $station );
