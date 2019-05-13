<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
  <head>
    <!-- NAME: 1 COLUMN -->
    <!--[if gte mso 15]>
    <xml>
        <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
     <style type="text/css">
      <?php
      include PUBLIC_PATH . '/stylesheets/mailchimp.bootstrap.css';
      include PUBLIC_PATH . '/stylesheets/mailchimp.css';
      // include PUBLIC_PATH . '/stylesheets/public.min.css';
      include PUBLIC_PATH . '/stylesheets/' . strtolower($stationName) . '.css'; ?>

    </style>
  </head>
<body>
  <!--*|IF:MC_PREVIEW_TEXT|*-->
  <!--[if !gte mso 9]><!----><span class="mcnPreviewText" style="display:none; font-size:0px; line-height:0px; max-height:0px; max-width:0px; opacity:0; overflow:hidden; visibility:hidden; mso-hide:all;">*|MC_PREVIEW_TEXT|*</span><!--<![endif]-->
  <!--*|END:IF|*-->
  <center>
    <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="max-width: 600px">
      <tr>
        <td align="center" valign="top" id="bodyCell">
          <!-- BEGIN TEMPLATE // -->
          <!--[if (gte mso 9)|(IE)]>
          <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
          <tr>
          <td align="center" valign="top" width="600" style="width:600px;">
          <![endif]-->
          <table border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
            <tr><!-- PRE HEADER -->
              <td valign="top" id="templatePreheader"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;">
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
                          <tbody><tr>
                            <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px; text-align: center;">
                              <a href="*|ARCHIVE|*" target="_blank">View this email in your browser</a>
                            </td>
                          </tr></tbody>
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
                </table></td>
              </tr><!-- PRE HEADER -->
              <tr><!--HEADER-->
                <td valign="top" id="templateHeader">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
                    <tbody class="mcnImageBlockOuter">
                      <tr>
                        <td valign="top" style="padding:9px" class="mcnImageBlockInner">
                          <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                            <tbody><tr>
                              <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                <a href="<?php echo $stationURL; ?>" target="_blank">
                                  <img align="center" alt="logo" src="http://bwaymedia.wpengine.com/wp-content/uploads/2018/11/<?php echo $stationName;?>_logo.png" width="80" style="max-width:80px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                </a>
                              </td>
                            </tr></tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr><!--HEADER-->
