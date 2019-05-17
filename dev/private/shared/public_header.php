<!doctype html>
<?php

if(is_post_request()) {
  // Form was submitted
  $preference = $_POST['preference'] ?? 'Any';
  $expire = time() + 60*60*24*365;
  setcookie('preference', $preference, $expire);

} else {
  // Read the stored value (if any)
  $preference = $_COOKIE['preference'] ?? 'Any';
}

?>
<html lang="en">
  <head>
    <title>Email <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <style type="text/css">
      <?php
      include PUBLIC_PATH . '/stylesheets/custom.bootstrap.min.css';
      include PUBLIC_PATH . '/stylesheets/public.min.css';
      include PUBLIC_PATH . '/stylesheets/' . $stationName . '.min.css'; ?>
    </style>
  </head>

  <body>

    <div class="header">
      <div class="container">
        <div class="text-center">
          <img src="http://bwaymedia.wpengine.com/wp-content/uploads/2018/11/<?php echo $stationName;?>_logo.png" alt="logo" />
        </div>

      </div>
    </div><!-- Header Container -->

    <div class="container">
