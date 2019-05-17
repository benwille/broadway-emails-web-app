<?php

function set_hashed_password( $password ) {
	$hashed_password = password_hash( $password, PASSWORD_BCRYPT );
	echo $hashed_password;
}

set_hashed_password( 'Pa$$wOrD' );


