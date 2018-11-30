
<?php require_once('../../../private/initialize.php'); ?>

<?php
  if(!isset($_GET['station'])) {
  redirect_to(url_for('/staff/emails/index.php'));
  }
  if ($_GET['station'] == 6) {
    redirect_to(url_for('/staff/emails/sports_email.php?station=6'));
  }
  $station = $_GET['station'];
  foreach(Email::STATION as $station_id => $station_name) {
    if($station == $station_id) {
    $stationName = $station_name;
    break;
    }
  }
  foreach(Email::STATION_URL as $station_id => $station_url) {
    if($station == $station_id) {
    $stationURL = "https://www." . $station_url . ".com/";
    break;
    }
  }
?>
<?php require_once('../../../private/content.php'); ?>

<?php $page_title = $stationName . ' Email'; ?>
<?php include(SHARED_PATH . '/public_header2.php'); ?>

<tr><!--Section-->
  <?php
  if ($featured) {
    $x = first_position($featured);
  ?>
  <td valign="top" id="templateBody" style="background:#ffffff none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #ffffff;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border: 1px solid #EAEAEA;padding-top: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #eaeaea; text-transform: uppercase;"><!--text block header-->
      <tr>
        <td valign="top" class="mcnTextBlockInner section-title" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; background-color: rgba(0,0,0,0.03);">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: left;">
                Featured
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block header-->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><!--image block-->
      <tr>
        <td valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
          <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><!--image content-->
            <tr>
              <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; ">
                <a href="<?php echo $featured[0]->link ?>" target="_blank"><img class="card-img" src="<?php echo $featured[0]->imageLink ?>" alt="<?php echo h_decode($featured[0]->title) ?>"></a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--main image block-->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #eaeaea;"><!--text block-->
      <tr>
        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: left;">
                <h2 class="card-title"><a href="<?php echo $featured[0]->link ?>" target="_blank"><?php echo h_decode($featured[0]->title) ?></a></h2>
                <p class="card-text"><?php echo h_decode($featured[0]->excerpt); ?></p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block-->
    <?php if ($featured) {
      foreach ($featured as $i => $post) {
        if ($i == 0) {
          continue;
        }
        if ($i == 1) { ?>
    <table border="0" cellpadding="10" cellspacing="10" width="100%" class="mcnTextBlock d-sm-none" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #eaeaea;"><!--text block + image-->
      <tr>
        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 18px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; ">
                <a href="<?php echo $post->link; ?>"><img class="d-flex img-fluid rounded mr-3"  src="<?php echo $post->imageLink ?>" alt="<?php echo h_decode($post->title) ?>"></a>
              </td>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px 0px 9px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: left;">
                <h4><a href="<?php echo $post->link; ?>"><?php echo h_decode($post->title); ?></a></h4>
                <p class="card-text"><?php echo h_decode($post->excerpt); ?></p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block + image-->
    <table border="0" cellpadding="10" cellspacing="10" width="100%" class="mcnTextBlock d-sm" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #eaeaea;"><!--text block + image-->
      <tr>
        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 18px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                <a href="<?php echo $post->link; ?>"><img class="img-fluid rounded mr-3"  style="max-height:300px;" src="<?php echo $post->imageLink ?>" alt="<?php echo h_decode($post->title) ?>"></a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px 0px 9px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: left;">
                <h4><a href="<?php echo $post->link; ?>"><?php echo h_decode($post->title); ?></a></h4>
                <p class="card-text"><?php echo h_decode($post->excerpt); ?></p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block + image-->
    <?php } else { ?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><!--text block-->
        <tr>
          <td valign="top" class="mcnTextBlockInner" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
              <!--text content-->
              <tr>
                <td valign="top" class="mcnTextContent" style="padding: 0px 18px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: left;">
                  <a class="list-group-item" href="<?php echo $post->link; ?>"><?php echo h_decode($post->title); ?></a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table><!--text block-->
    <?php }}} ?>
  </td><!--featured section-->
  <?php } ?>

</tr><!--section-->

<tr><!--spacer-->
  <td height="20"></td>
</tr><!--spacer-->

<?php
if ($posts) {
  // var_dump($sports_posts);
  foreach ($posts as $post) {
    if ($post) {
    $category_url = $stationURL . 'category/' . $post[0]->category();
?>
<tr><!--Section-->
  <td valign="top" id="templateBody" style="background:#ffffff none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #ffffff;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border: 1px solid #EAEAEA;padding-top: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #eaeaea;"><!--text block header-->
      <tr>
        <td valign="top" class="mcnTextBlockInner section-title" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; background-color: rgba(0,0,0,0.03); text-transform: uppercase;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: left;">
                <?php echo $post[0]->category(); ?>
              </td>
            </tr>
          </table>
        </td>
        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; background-color: rgba(0,0,0,0.03);">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: right;">
                <a class="card-link" href="<?php echo $category_url;?>" target="_blank">See All &raquo;</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block header-->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><!--image block-->
      <tr>
        <td valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
          <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><!--image content-->
            <tr>
              <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; ">
                <a href="<?php echo $post[0]->link ?>" target="_blank"><img class="card-img img-fluid mb-2 mb-lg-1" src="<?php echo $post[0]->imageLink ?>" alt="<?php echo h_decode($post[0]->title) ?>"></a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--main image block-->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #eaeaea;"><!--text block-->
      <tr>
        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: left;">
                <h2 class="card-title"><a href="<?php echo $post[0]->link ?>" target="_blank"><?php echo h_decode($post[0]->title) ?></a></h2>
                <p class="card-text"><?php echo h_decode($post[0]->excerpt); ?></p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block-->
    <?php if ($post) {
      foreach ($post as $i => $post) {
        if ($i >= 6) {
          break;
        }
        if ($i == 0) {
          continue;
        }
        if ($i == 1) { ?>
    <table border="0" cellpadding="10" cellspacing="10" width="100%" class="mcnTextBlock d-sm-none" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #eaeaea;"><!--text block + image-->
      <tr>
        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 18px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; ">
                <a href="<?php echo $post->link; ?>"><img class="d-flex img-fluid rounded mr-3" src="<?php echo $post->imageLink ?>" alt="<?php echo h_decode($post->title) ?>"></a>
              </td>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px 0px 9px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: left;">
                <h4><a href="<?php echo $post->link; ?>"><?php echo h_decode($post->title); ?></a></h4>
                <p class="card-text"><?php echo h_decode($post->excerpt); ?></p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block + image-->
    <table border="0" cellpadding="10" cellspacing="10" width="100%" class="mcnTextBlock d-sm" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #eaeaea;"><!--text block + image-->
      <tr>
        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 18px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                <a href="<?php echo $post->link; ?>"><img style="max-height:300px" class="img-fluid rounded mr-3" src="<?php echo $post->imageLink ?>" alt="<?php echo h_decode($post->title) ?>"></a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px 0px 9px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: left;">
                <h4><a href="<?php echo $post->link; ?>"><?php echo h_decode($post->title); ?></a></h4>
                <p class="card-text"><?php echo h_decode($post->excerpt); ?></p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block + image-->
    <?php } else { ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; "><!--text block-->
      <tr>
        <td valign="top" class="mcnTextBlockInner" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: left;">
                <a class="list-group-item" href="<?php echo $post->link; ?>"><?php echo h_decode($post->title); ?></a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block-->
    <?php }}} ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #eaeaea; border-top: 1px solid #eaeaea;"><!--text block-->
      <tr>
        <td valign="top" class="mcnTextBlockInner see-all" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: center;">
                <a class="card-link text-center" href="<?php echo $category_url;?>" target="_blank">See All &raquo;</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block-->
  </td><!--section-->
</tr><!--section-->

<tr><!--spacer-->
  <td height="20"></td>
</tr><!--spacer-->

<?php }}} ?>

<?php if ($latest) { ?>
<tr><!--Section-->
  <td valign="top" id="templateBody" style="background:#ffffff none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #ffffff;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border: 1px solid #EAEAEA;padding-top: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #eaeaea;"><!--text block header-->
      <tr>
        <td valign="top" class="mcnTextBlockInner section-title" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; background-color: rgba(0,0,0,0.03); text-transform: uppercase;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: left;">
                <span>Latest</span>
              </td>
            </tr>
          </table>
        </td>
        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; background-color: rgba(0,0,0,0.03);">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: right;">
                <a class="card-link" href="<?php echo $category_url;?>" target="_blank">See All &raquo;</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block header-->
    <?php if ($latest) {
      foreach ($latest as $i => $post) {
        if ($i >= 6) {
          break;
    } ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><!--text block-->
      <tr>
        <td valign="top" class="mcnTextBlockInner" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: left;">
                <a class="list-group-item" href="<?php echo $post->link; ?>"><?php echo h_decode($post->title); ?></a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block-->
    <?php }} ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; border-bottom: 1px solid #eaeaea; border-top: 1px solid #eaeaea;"><!--text block-->
      <tr>
        <td valign="top" class="mcnTextBlockInner see-all" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
            <!--text content-->
            <tr>
              <td valign="top" class="mcnTextContent" style="padding: 0px 18px;line-height: 125%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: rgb(33,37,41);  font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;text-align: center;">
                <a class="card-link text-center" href="<?php echo $category_url;?>" target="_blank">See All &raquo;</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table><!--text block-->
  </td><!--section-->
</tr><!--latest section-->
<?php } ?>

</table><!--email body-->
</td>
</tr>





<?php include(SHARED_PATH . '/public_footer.php'); ?>
