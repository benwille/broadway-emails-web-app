<?php

require_once('../../../private/initialize.php');

$args = $_POST['post'];
$station = $_GET['station'];

$clear = new Email($args);

$result = $clear->clear('station',$station);

if($result === true) {
  $session->message('Cleared out. Ready for a new email.');
  redirect_to(url_for('/staff/emails/index.php?station=' . $station));
}

// do {
//
//   if(!isset($_GET['station'])) {
//     redirect_to(url_for('/staff/x96/index.php'));
//     break;
//   }
//
//   if (!isset($_GET['featured']) && isset($_GET['position'])) {
//     $args = $_POST['post'];
//
//     $clear = new Email($args);
//
//     $result = $clear->clear_position('station',1);
//
//     if($result === true) {
//       $session->message('All positions cleared out. Ready for a new email.');
//       redirect_to(url_for('/staff/x96/index.php'));
//     }
//     break;
//   }
//
//   if (!isset($_GET['position']) && isset($_GET['featured'])) {
//     $args = $_POST['post'];
//
//     $clear = new Email($args);
//
//     $result = $clear->clear_featured('station',1);
//
//     if($result === true) {
//       $session->message('All featured posts have been cleared out. Ready for a new email.');
//       redirect_to(url_for('/staff/x96/index.php'));
//     }
//     break;
//   }
//
//   else {
//     $args = $_POST['post'];
//
//     $clear = new Email($args);
//
//     $result = $clear->clear_all('station',1);
//
//     if($result === true) {
//       $result = $clear->clear_all('featured',1);
//       if($result === true) {
//         $session->message('All featured posts and positions cleared out. Ready for a new email.');
//         redirect_to(url_for('/staff/x96/index.php'));
//       }
//     }
//     break;
//   }
//
//
// } while (0);



?>
