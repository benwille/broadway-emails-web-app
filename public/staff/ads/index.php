<?php

require_once('../../../private/initialize.php');
require_login();
require_admin();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/emails/index.php'));
}

if(!isset($_GET['station'])) {
  redirect_to(url_for('/staff/emails/index.php'));
}
$station = $_GET['station'];
$id = $_GET['id'];
$ad = Ad::find_by_id($id);
if($ad == false) {
  redirect_to(url_for('/staff/emails/index.php?station=' . h($station)));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['ad'];

  $ad->merge_attributes($args);
  $result = $ad->save();

  if($result === true) {
    $session->message('The ad was updated successfully.');
    redirect_to(url_for('/staff/emails/index.php?station=' . $station));
  } else {
    // show errors
  }

} else {

  // display the form

}

?>
