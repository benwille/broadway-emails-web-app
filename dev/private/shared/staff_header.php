<?php
  if(!isset($page_title)) { $page_title = 'Staff Area'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>Broadway Emails - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo url_for('/stylesheets/bootstrap.min.css'); ?>" media="all">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
    <link rel="shortcut icon" href="<?php // TODO: //echo url_for('/images/favicon.ico'); ?>" type="image/x-icon">
    <link rel="icon" href="<?php // TODO:  //echo url_for('/images/favicon.ico'); ?>" type="image/x-icon">
    <script src="<?php echo url_for('/js/jquery.min.js'); ?>"></script>
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
    <?php // TODO:  ?>
    <!-- <meta property="og:url"                content="<?php //echo getURL(); ?>" />
    <meta property="og:title"              content="Task Master - <?php //echo h($page_title); ?>" />
    <meta property="og:description"        content="Demo Web App of a project managament tool called Task Master. Built by Ben Wille" />
    <meta property="og:image"              content="<?php //echo url_for('/images/Depositphotos_111852752_l-2015.jpg'); ?>" /> -->

    <script type="text/javascript">
      $(function() {
        $("a#teamsDropdown").hover(teamdropdown,teamdropdown);

        $("a.nav-item").each(function() {
          $(this).click(function() {
            $(this).toggleClass("active")
          });
        });

        // $("a.nav-item").click(fnClick);


      });

      function fnClick() {
        $("a.nav-item").toggleClass("active");
      }
      function teamdropdown() {
        $("#teamsDropdown").dropdown('toggle');
      }

    </script>
  </head>

  <body>
  <div class="container">
    <header>
      <h1>Broadway Media Staff Area</h1>
    </header>

  <nav class="navbar navbar-light navbar-expand-sm">
    <div class="container">

      <button class="navbar-toggler" type="button"
        data-toggle="collapse" data-target="#myTogglerNav"
        aria-controls="myTogglerNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    <a href="<?php echo url_for('/staff/index.php'); ?>" class="navbar-brand">Broadway Emails</a>

      <div class="collapse navbar-collapse" id="myTogglerNav">
        <div class="navbar-nav ml-sm-auto">
          <?php if ($session->is_logged_in()) { ?>
            <div class="text-right mt-2 mr-1">User: <?php echo $session->username; ?></div>
            <div class="btn-group">
              <a class="btn nav-link" href="<?php echo url_for('/staff/emails/index.php?station=1'); ?>">X96</a>
              <a class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo url_for('/staff/emails/news_feed.php?station=1'); ?>">News Feed</a>
              </div>
            </div>
            <div class="btn-group">
              <a class="btn nav-link" href="<?php echo url_for('/staff/emails/index.php?station=2'); ?>">Mix</a>
              <a class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo url_for('/staff/emails/news_feed.php?station=2'); ?>">News Feed</a>
              </div>
            </div>
            <div class="btn-group">
              <a class="btn nav-link" href="<?php echo url_for('/staff/emails/index.php?station=3'); ?>">U92</a>
              <a class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo url_for('/staff/emails/news_feed.php?station=3'); ?>">News Feed</a>
              </div>
            </div>
            <div class="btn-group">
              <a class="btn nav-link" href="<?php echo url_for('/staff/emails/index.php?station=5'); ?>">Eagle</a>
              <a class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo url_for('/staff/emails/news_feed.php?station=5'); ?>">News Feed</a>
              </div>
            </div>
            <div class="btn-group">
              <a class="btn nav-link" href="<?php echo url_for('/staff/emails/index.php?station=4'); ?>">Rewind</a>
              <a class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo url_for('/staff/emails/news_feed.php?station=4'); ?>">News Feed</a>
              </div>
            </div>
            <div class="btn-group">
              <a class="btn nav-link" href="<?php echo url_for('/staff/emails/index.php?station=6'); ?>">ESPN</a>
              <a class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo url_for('/staff/emails/news_feed.php?station=6'); ?>">News Feed</a>
              </div>
            </div>

            <!-- <a class="nav-link" href="<?php echo url_for('/staff/emails/index.php?station=2'); ?>">Mix</a>
            <a class="nav-link" href="<?php echo url_for('/staff/emails/index.php?station=3'); ?>">U92</a>
            <a class="nav-link" href="<?php echo url_for('/staff/emails/index.php?station=4'); ?>">Eagle</a>
            <a class="nav-link" href="<?php echo url_for('/staff/emails/index.php?station=5'); ?>">Rewind</a>
            <a class="nav-link" href="<?php echo url_for('/staff/emails/index.php?station=6'); ?>">ESPN</a> -->

            <a class="nav-item nav-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">Admins</a>
            <a class="nav-item nav-link" href="<?php echo url_for('/staff/logout.php'); ?>">Logout</a>
          <?php } ?>
        </div><!-- navbar -->
      </div><!--collapse-->

    </div><!-- container -->
  </nav><!-- nav -->


  <?php echo display_session_message(); ?>
