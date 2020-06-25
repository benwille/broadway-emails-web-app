<?php

require_once( '../../../private/initialize.php' );

$args = $_POST['post'];
$station = $_GET['station'];

$clear = new Email( $args );

$result = $clear->clear( 'station', $station );

if ( $result === true ) {
	$session->message( 'Cleared out. Ready for a new email.' );
	redirect_to( url_for( '/staff/emails/index.php?station=' . $station ) );
}



