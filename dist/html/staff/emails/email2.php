
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

<?php
if ($featured) {
  $x = first_position($featured);
?>
<tr><!-- Featured Section-->
  <td valign="top" id="templateBody">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
  	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
  	<![endif]-->
    	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
          <td valign="top" class="mcnBoxedTextBlockInner">
    				<!--[if gte mso 9]>
    				<td align="center" valign="top" ">
    				<![endif]-->
            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
              <tbody>
                <tr>
                  <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                    <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #FAFAFA;border: 1px solid #EAEAEA;">
                      <tbody>
                        <tr>
                          <td valign="top" class="mcnTextContent" style="padding: 18px;color: #1F2529;font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 16px;font-style: normal;font-weight: bold;line-height: 125%;text-align: center;">
                            <div style="text-align: left;">FEATURED</div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
    				<!--[if gte mso 9]>
    				</td>
    				<![endif]-->

    				<!--[if gte mso 9]>
            </tr>
            </table>
    				<![endif]-->
          </td>
        </tr>
      </tbody>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
      <tbody class="mcnImageBlockOuter">
        <tr>
          <td valign="top" style="padding:9px" class="mcnImageBlockInner">
            <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
              <tbody>
                <tr>
                  <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;">
                    <a href="<?php echo $featured[0]->link ?>" title="<?php echo h_decode($featured[0]->title) ?>" class="" target="_blank">
                      <img align="center" alt="<?php echo h_decode($featured[0]->title) ?>" src="<?php echo $featured[0]->imageLink ?>" width="564" style="max-width: 887px;padding-bottom: 0px;vertical-align: bottom;display: inline !important;border: 1px solid #FFFFFF;border-radius: 1%;" class="mcnImage">
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
      <tbody class="mcnTextBlockOuter">
        <tr>
          <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
          	<!--[if mso]>
    				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
    				<tr>
    				<![endif]-->

    				<!--[if mso]>
    				<td valign="top" width="600" style="width:600px;">
    				<![endif]-->
            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
              <tbody>
                <tr>
                  <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                    <h1>
                      <a href="<?php echo $featured[0]->link ?>" target="_blank"><?php echo h_decode($featured[0]->title) ?></a>
                    </h1>
                    <p>
                      <?php echo h_decode($featured[0]->excerpt); ?>
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
    				<!--[if mso]>
    				</td>
    				<![endif]-->

    				<!--[if mso]>
    				</tr>
    				</table>
    				<![endif]-->
          </td>
        </tr>
      </tbody>
    </table>
    <?php if ($featured) {
      foreach ($featured as $i => $post) {
        if ($i == 0) {
          continue;
        }
        if ($i == 1) { ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnCaptionBlock">
      <tbody class="mcnCaptionBlockOuter">
        <tr>
          <td class="mcnCaptionBlockInner" valign="top" style="padding:9px;">
            <table border="0" cellpadding="0" cellspacing="0" class="mcnCaptionRightContentOuter" width="100%">
              <tbody>
                <tr>
                  <td valign="top" class="mcnCaptionRightContentInner" style="padding:0 9px ;">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnCaptionRightImageContentContainer" width="264">
                      <tbody>
                        <tr>
                          <td class="mcnCaptionRightImageContent" align="center" valign="top">
                            <a href="<?php echo $post->link; ?>">
                              <img alt="<?php echo h_decode($post->title) ?>" src="<?php echo $post->imageLink ?>" width="264" style="max-width: 887px;border: 1px solid #FFFFFF;border-radius: 1%;" class="mcnImage">
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="mcnCaptionRightTextContentContainer" align="right" border="0" cellpadding="0" cellspacing="0" width="264">
                      <tbody>
                        <tr>
                          <td valign="top" class="mcnTextContent">
                            <h4 class="null">
                              <a href="<?php echo $post->link; ?>">
                                <?php echo h_decode($post->title); ?>
                              </a>
                            </h4>
                            <p>
                              <?php echo h_decode($post->excerpt); ?>
                            </p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
      <tbody class="mcnDividerBlockOuter">
        <tr>
          <td class="mcnDividerBlockInner" style="min-width: 100%; padding: 9px 18px;">
            <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #EAEAEA;">
              <tbody>
                <tr>
                  <td>
                    <span></span>
                  </td>
                </tr>
              </tbody>
            </table>
            <!--
            <td class="mcnDividerBlockInner" style="padding: 18px;">
            <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
            -->
          </td>
        </tr>
      </tbody>
    </table>
    <?php } else { ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
      <tbody class="mcnTextBlockOuter">
        <tr>
          <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
          	<!--[if mso]>
    				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
    				<tr>
    				<![endif]-->

    				<!--[if mso]>
    				<td valign="top" width="600" style="width:600px;">
    				<![endif]-->
            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
              <tbody>
                <tr>
                  <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px; line-height: 150%;">
                    <a href="<?php echo $post->link; ?>">
                      <?php echo h_decode($post->title); ?>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
    				<!--[if mso]>
    				</td>
    				<![endif]-->

    				<!--[if mso]>
    				</tr>
    				</table>
    				<![endif]-->
          </td>
        </tr>
      </tbody>
    </table>
    <?php }}} ?>
  </td>
</tr><!-- Featured Section-->
<?php } ?>

<?php
if ($posts) {
  // var_dump($sports_posts);
  foreach ($posts as $post) {
    if ($post) {
    $category_url = $stationURL . 'category/' . $post[0]->category();
?>
<tr><!--Sections-->
  <td valign="top" class="templateBody">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
  	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
  	<![endif]-->
    	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
          <td valign="top" class="mcnBoxedTextBlockInner">
    				<!--[if gte mso 9]>
    				<td align="center" valign="top" width="390">
    				<![endif]-->
            <table align="left" border="0" cellpadding="0" cellspacing="0" width="390" class="mcnBoxedTextContentContainer">
              <tbody>
                <tr>
                  <td class="mcnBoxedTextContentColumn" style="padding-top:9px; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                    <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #FAFAFA;border: 1px solid #EAEAEA;">
                      <tbody>
                        <tr>
                          <td valign="top" class="mcnTextContent" style="padding: 18px;color: #1F2529;font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 16px;font-style: normal;font-weight: normal;line-height: 125%;text-align: center;">
                            <div style="text-align: left;">
                              <strong><?php echo $post[0]->category(); ?></strong>
                            </div>

                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
    				<!--[if gte mso 9]>
    				</td>
    				<![endif]-->

    				<!--[if gte mso 9]>
    				<td align="center" valign="top" width="210">
    				<![endif]-->
            <table align="left" border="0" cellpadding="0" cellspacing="0" width="210" class="mcnBoxedTextContentContainer">
              <tbody>
                <tr>
                  <td class="mcnBoxedTextContentColumn" style="padding-top:9px; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                    <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #FAFAFA;border: 1px solid #EAEAEA;">
                      <tbody>
                        <tr>
                          <td valign="top" class="mcnTextContent" style="padding: 18px;color: #1F2529;font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 16px;font-style: normal;font-weight: normal;line-height: 125%;text-align: center;">
                            <a href="<?php echo $category_url;?>">
                              <span>See All »</span>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
    				<!--[if gte mso 9]>
    				</td>
    				<![endif]-->

    				<!--[if gte mso 9]>
            </tr>
            </table>
    				<![endif]-->
          </td>
        </tr>
      </tbody>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
      <tbody class="mcnImageBlockOuter">
        <tr>
          <td valign="top" style="padding:9px" class="mcnImageBlockInner">
            <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
              <tbody>
                <tr>
                  <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;">
                    <a href="<?php echo $post[0]->link ?>" title="<?php echo h_decode($post[0]->title) ?>" class="" target="_blank">
                      <img align="center" alt="<?php echo h_decode($post[0]->title) ?>" src="<?php echo $post[0]->imageLink ?>" width="564" style="max-width: 887px;padding-bottom: 0px;vertical-align: bottom;display: inline !important;border: 1px solid #FFFFFF;border-radius: 1%;" class="mcnImage">
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
      <tbody class="mcnTextBlockOuter">
        <tr>
          <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
          	<!--[if mso]>
    				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
    				<tr>
    				<![endif]-->

    				<!--[if mso]>
    				<td valign="top" width="600" style="width:600px;">
    				<![endif]-->
            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
              <tbody>
                <tr>
                  <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                    <h1>
                      <a href="<?php echo $post[0]->link ?>" target="_blank"><?php echo h_decode($post[0]->title) ?></a>
                    </h1>
                    <p>
                      <?php echo h_decode($post[0]->excerpt); ?>
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
    				<!--[if mso]>
    				</td>
    				<![endif]-->

    				<!--[if mso]>
    				</tr>
    				</table>
    				<![endif]-->
          </td>
        </tr>
      </tbody>
    </table>
    <?php if ($post) {
      foreach ($post as $i => $post) {
        if ($i >= 6) {
          break;
        }
        if ($i == 0) {
          continue;
        }
        if ($i == 1) { ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnCaptionBlock">
      <tbody class="mcnCaptionBlockOuter">
        <tr>
          <td class="mcnCaptionBlockInner" valign="top" style="padding:9px;">
            <table border="0" cellpadding="0" cellspacing="0" class="mcnCaptionRightContentOuter" width="100%">
              <tbody>
                <tr>
                  <td valign="top" class="mcnCaptionRightContentInner" style="padding:0 9px ;">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnCaptionRightImageContentContainer" width="264">
                      <tbody>
                        <tr>
                          <td class="mcnCaptionRightImageContent" align="center" valign="top">
                            <a href="<?php echo $post->link; ?>">
                              <img alt="<?php echo h_decode($post->title) ?>" src="<?php echo $post->imageLink ?>" width="264" style="max-width: 887px;border: 1px solid #FFFFFF;border-radius: 1%;" class="mcnImage">
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="mcnCaptionRightTextContentContainer" align="right" border="0" cellpadding="0" cellspacing="0" width="264">
                      <tbody>
                        <tr>
                          <td valign="top" class="mcnTextContent">
                            <h4 class="null">
                              <a href="<?php echo $post->link; ?>"><?php echo h_decode($post->title); ?></a>
                            </h4>
                            <p>
                              <?php echo h_decode($post->excerpt); ?>
                            </p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
      <tbody class="mcnDividerBlockOuter">
        <tr>
          <td class="mcnDividerBlockInner" style="min-width: 100%; padding: 9px 18px;">
            <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #EAEAEA;">
              <tbody>
                <tr>
                  <td>
                    <span></span>
                  </td>
                </tr>
              </tbody>
            </table>
            <!--
            <td class="mcnDividerBlockInner" style="padding: 18px;">
            <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
            -->
          </td>
        </tr>
      </tbody>
    </table>
    <?php } else { ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
      <tbody class="mcnTextBlockOuter">
        <tr>
          <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
          	<!--[if mso]>
    				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
    				<tr>
    				<![endif]-->

    				<!--[if mso]>
    				<td valign="top" width="600" style="width:600px;">
    				<![endif]-->
            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
              <tbody>
                <tr>
                  <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px; line-height: 150%;">
                    <a href="<?php echo $post->link; ?>">
                      <?php echo h_decode($post->title); ?>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
    				<!--[if mso]>
    				</td>
    				<![endif]-->

    				<!--[if mso]>
    				</tr>
    				</table>
    				<![endif]-->
          </td>
        </tr>
      </tbody>
    </table>
  <?php }}} ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
  	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
  	<![endif]-->
    	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
          <td valign="top" class="mcnBoxedTextBlockInner">
    				<!--[if gte mso 9]>
    				<td align="center" valign="top" ">
    				<![endif]-->
            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
              <tbody>
                <tr>
                  <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                    <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #FAFAFA;border: 1px solid #EAEAEA;">
                      <tbody>
                        <tr>
                          <td valign="top" class="mcnTextContent" style="padding: 18px;color: #1F2529;font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 16px;font-style: normal;font-weight: normal;line-height: 125%;text-align: center;">
                            <a href="<?php echo $category_url;?>"><div style="text-align: center;">See All »</div></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
    				<!--[if gte mso 9]>
    				</td>
    				<![endif]-->

    				<!--[if gte mso 9]>
            </tr>
            </table>
    				<![endif]-->
          </td>
        </tr>
      </tbody>
    </table>
  </td>
</tr><!--Sections-->
<?php }}} ?>

<?php if ($latest) { ?>
<tr><!--Latest-->
  <td valign="top" class="templateBody">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
  	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
  	<![endif]-->
    	<tbody class="mcnBoxedTextBlockOuter">
        <tr>
          <td valign="top" class="mcnBoxedTextBlockInner">
    				<!--[if gte mso 9]>
    				<td align="center" valign="top" width="390">
    				<![endif]-->
            <table align="left" border="0" cellpadding="0" cellspacing="0" width="390" class="mcnBoxedTextContentContainer">
              <tbody>
                <tr>
                  <td class="mcnBoxedTextContentColumn" style="padding-top:9px; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                    <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #FAFAFA;border: 1px solid #EAEAEA;">
                      <tbody>
                        <tr>
                          <td valign="top" class="mcnTextContent" style="padding: 18px;color: #1F2529;font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 16px;font-style: normal;font-weight: normal;line-height: 125%;text-align: center;">
                            <div style="text-align: left;"><strong>LATEST</strong></div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
    				<!--[if gte mso 9]>
    				</td>
    				<![endif]-->

    				<!--[if gte mso 9]>
    				<td align="center" valign="top" width="210">
    				<![endif]-->
            <table align="left" border="0" cellpadding="0" cellspacing="0" width="210" class="mcnBoxedTextContentContainer">
              <tbody>
                <tr>
                  <td class="mcnBoxedTextContentColumn" style="padding-top:9px; padding-right:18px; padding-bottom:9px; padding-left:18px;">
                    <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #FAFAFA;border: 1px solid #EAEAEA;">
                      <tbody>
                        <tr>
                          <td valign="top" class="mcnTextContent" style="padding: 18px;color: #1F2529;font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 16px;font-style: normal;font-weight: normal;line-height: 125%;text-align: center;">
                            <a href="<?php echo $category_url;?>">See All »</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
    				<!--[if gte mso 9]>
    				</td>
    				<![endif]-->

    				<!--[if gte mso 9]>
            </tr>
            </table>
    				<![endif]-->
          </td>
        </tr>
      </tbody>
    </table>
    <?php if ($latest) {
      foreach ($latest as $i => $post) {
        if ($i >= 6) {
          break;
    } ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
      <tbody class="mcnTextBlockOuter">
        <tr>
          <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;">
          	<!--[if mso]>
    				<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
    				<tr>
    				<![endif]-->

    				<!--[if mso]>
    				<td valign="top" width="600" style="width:600px;">
    				<![endif]-->
            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer">
              <tbody>
                <tr>
                  <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px; line-height: 150%;">
                    <a href="<?php echo $post->link; ?>">
                      <?php echo h_decode($post->title); ?>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
    				<!--[if mso]>
    				</td>
    				<![endif]-->

    				<!--[if mso]>
    				</tr>
    				</table>
    				<![endif]-->
          </td>
        </tr>
      </tbody>
    </table>
    <?php }} ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnBoxedTextBlock" style="min-width:100%;">
    <!--[if gte mso 9]>
    <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
    <![endif]-->
      <tbody class="mcnBoxedTextBlockOuter">
        <tr>
          <td valign="top" class="mcnBoxedTextBlockInner">
            <!--[if gte mso 9]>
            <td align="center" valign="top" ">
            <![endif]-->
            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnBoxedTextContentContainer">
              <tbody>
                <tr>
                  <td style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:18px;">
                    <table border="0" cellspacing="0" class="mcnTextContentContainer" width="100%" style="min-width: 100% !important;background-color: #FAFAFA;border: 1px solid #EAEAEA;">
                      <tbody>
                        <tr>
                          <td valign="top" class="mcnTextContent" style="padding: 18px;color: #1F2529;font-family: Lato, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 16px;font-style: normal;font-weight: normal;line-height: 125%;text-align: center;">
                            <a href="<?php echo $category_url;?>"><div style="text-align: center;">See All »</div></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <!--[if gte mso 9]>
            </td>
            <![endif]-->

            <!--[if gte mso 9]>
            </tr>
            </table>
            <![endif]-->
          </td>
        </tr>
      </tbody>
    </table>
  </td>
</tr><!--Latest-->
<?php } ?>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
