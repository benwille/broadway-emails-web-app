<?php

require_once '../../../private/initialize.php';

$args    = $_POST['post'];
$station = $_GET['station'];

$hide = new Email( $args );

$sql    = 'UPDATE posts SET ';
$sql   .= "visible = '" . $hide->visible . "'";
$sql   .= " WHERE station = '" . $station . "' ";
$sql   .= " AND category = '" . $hide->category . "' ";
$result = $database->query( $sql );

if ( $result === true ) {
	$session->message( 'All ' . $hide->category() . ' posts hidden.' );
	redirect_to( url_for( '/staff/emails/index.php?station=' . $station ) );
}



