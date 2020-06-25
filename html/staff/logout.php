<?php
require_once( '../../private/initialize.php' );

// Log out the user
$session->logout( $user );

redirect_to( url_for( '/staff/login.php' ) );


