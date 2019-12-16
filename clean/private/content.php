<?php

$sql      = 'SELECT * FROM posts ';
$sql     .= 'WHERE station=' . $station . ' ';
$sql     .= 'AND featured=1 ';
$sql     .= 'ORDER BY position = 0, position ASC, pubDate DESC ';
$featured = Email::find_by_sql( $sql );

$posts = array(
	$contests = Email::post_query( $station, 3, 0 ),
	$news = Email::post_query( $station, 1, 0 ),
	$life = Email::post_query( $station, 2, 0 ),
);

$latest       = Email::post_query( $station, 0, 0 );
$sports_posts = [];

if ( $station == 6 ) {
	$sports_posts = array(
		$utes = Email::post_query( $station, 7, 0 ),
		$rsl = Email::post_query( $station, 5, 0 ),
		$jazz = Email::post_query( $station, 6, 0 ),
		$stallions = Email::post_query( $station, 8, 0 ),
		$interviews = Email::post_query( $station, 4, 0 ),
	);
}


$featuredAds = Ad::ad_query( $station, 0 );

$ads = array(
	$contestAds = Ad::ad_query( $station, 1 ),
	$newsAds = Ad::ad_query( $station, 2 ),
	$lifeAds = Ad::ad_query( $station, 3 ),
);

$footerAds = Ad::ad_query( $station, 4 );



