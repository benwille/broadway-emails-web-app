<?php require_once '../private/initialize.php';
echo PRIVATE_PATH . '<br />';
echo PROJECT_PATH . '<br />';
echo PUBLIC_PATH . '<br />';
echo SHARED_PATH . '<br />';
echo dirname( __FILE__ ) . '<br />';
?>

<?php
date_default_timezone_set( 'America/Denver' );
echo date( 'l jS \of F Y h:i:s A' );
?>

<?php
require '../private/shared/public_header.php';
$stationName = 'rewind';
require PUBLIC_PATH . '/stylesheets/' . $stationName . '.css';
?>
 ?>




<?php // phpinfo(); ?>

<?php require SHARED_PATH . '/public_footer.php'; ?>
