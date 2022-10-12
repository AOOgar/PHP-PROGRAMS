<?php
/**
 * This file is part of phpRegister.
 *
 * phpRegister is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

 * phpRegister is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * See: http://www.gnu.org/licenses/
 * Thank you for your help and support: https://phpregister.org/help

 * Creation: 2019 Vincent Marguerit
 * Last modification:
 */ 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once (_PATHROOT.'config/config_smtp.inc.php');
require_once (_PATHROOT.'include/php/_libraries/phpmailer/6.0.7/src/Exception.php');
require_once (_PATHROOT.'include/php/_libraries/phpmailer/6.0.7/src/PHPMailer.php');
require_once (_PATHROOT.'include/php/_libraries/phpmailer/6.0.7/src/SMTP.php');
require_once (_PATHROOT.'include/php/_libraries/html2text/Html2Text.php');

function email_send() {
    global $config, $configEmail;
    
    if(!isset($configEmail['From'])) {
        $configEmail['From'] = $config['EmailContact'];
    }
    
    if(!isset($configEmail['FromName'])) {
        $configEmail['FromName'] = $config['EmailContactName'];
    }
    
    if(!isset($configEmail['Template'])) {
        $configEmail['Template'] = 'email_templateBase';
    }

    //True param means it will throw exceptions on errors
    $mail = new PHPMailer(true);
    $mail->CharSet = 'utf-8';
    
    try {
        
        if($configEmail['isSMTP']) {
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $configEmail['Host'];                   // Specify server
            $mail->SMTPAuth = $configEmail['SMTPAuth'];           // Enable SMTP authentication
            $mail->Username = $configEmail['Username'];           // SMTP username
            $mail->Password = $configEmail['Password'];           // SMTP password
            $mail->Port = $configEmail['Port'];                   // Recommended Port
            $mail->SMTPSecure = $configEmail['SMTPSecure'];       // Enable encryption, 'ssl'
        }
        
        if(isset($configEmail['ReplyTo'])) {
            if(!isset($configEmail['ReplyToName'])) {
                $configEmail['ReplyToName'] = '';
            }
            $mail->AddReplyTo($configEmail['ReplyTo'], $configEmail['ReplyToName']);
        }
        if(isset($configEmail['BCC'])) {
            if(!isset($configEmail['BCCName'])) {
                $configEmail['BCCName'] = '';
            }
            $mail->AddBCC($configEmail['BCC'], $configEmail['BCCName']);
        }
        $mail->From = $configEmail['From'];
        $mail->FromName = $configEmail['FromName'];
        $mail->AddAddress($configEmail['To'], $configEmail['ToName']);
        
        if($configEmail['Template'] == 'email_templateBase') {
            $mail->AddEmbeddedImage(_PATHROOT.'include/images/emails/logo-top-yourwebiste.png', 'logo_top');
            $mail->AddEmbeddedImage(_PATHROOT.'include/images/emails/logo-footer-yourwebiste.png', 'logo_footer');
        }
        
        $mail->Subject = $configEmail['Subject'];
        $mail->IsHTML(true);

        //We call the Template function
        $emailHtml = $configEmail['Template']();

        $mail->Body =  $emailHtml;
        
        $html2text = new \Html2Text\Html2Text($emailHtml);
        $mail->AltBody = $html2text->getText();


        $mail->Send();
    } catch (phpmailerException $e) {
        //Pretty error messages from PHPMailer
        return $e->errorMessage();
    } catch (Exception $e) {
        //Error messages from anything else!
        return $e->getMessage(); 
    }
}

function email_templateEmpty() {
    global $config, $configEmail;
    
    $htmlMailContent = '
<html>
<head>
    <meta name="viewport" content="width=device-width"><meta http-equiv="Content-Type" content="text/html; ">
    <title>'.$configEmail['Subject'].'</title>
</head>
<body style="font-size: 14px; background-color: #f4f4f4; margin: 0; padding:10px; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; -webkit-text-size-adjust: 100%; line-height: 1.5; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; height: 100% !important; width: 100% !important;">
    '.$configEmail['Body'].'
</body>
</html>';
    
    return $htmlMailContent;
    
}

function email_templateBase() {
    global $config, $configEmail;
    
    $emailContentHTML = '
<html>
<head><meta name="viewport" content="width=device-width"><meta http-equiv="Content-Type" content="text/html; ">
<title>'.$configEmail['Subject'].'</title>
<style media="all" type="text/css">
.withRoundedCorners {
    border-radius: 5px;
    moz-border-radius: 5px;
    khtml-border-radius: 5px
    o-border-radius: 5px;
    webkit-border-radius: 5px;
    ms-border-radius: 5px;
}
@media only screen and (max-width: 480px) {
  table[class=body] h1 {
    font-size: 24px !important;
  }
  table[class=body] h2 {
    font-size: 20px !important;
  }
  table[class=body] h3 {
    font-size: 14px !important;
  }
  table[class=body] .content,
  table[class=body] .wrapper {
    padding: 15px !important;
  }
  table[class=body] .container {
    width: 100% !important;
    padding: 0 !important;
  }
  table[class=body] .column {
    width: 100% !important;
  }

  table[class=body] .hero-image,
  table[class=body] .thumb {
    width: 100% !important;
    height: auto !important;
  }
  table[class=body] .btn table,
  table[class=body] .btn a {
    width: 100% !important;
  }
  table[class=body] .credits table {
    table-layout: auto !important;
  }
  table[class=body] .credits .label {
    font-size: 11px !important;
  }
}
</style>
<style type="text/css">@font-face {
    font-family: \'Open Sans\';
    font-style: normal;
    font-weight: 300;
    src: local(\'Open Sans Light\'), local(\'OpenSans-Light\'), url(https://fonts.gstatic.com/s/opensans/v13/DXI1ORHCpsQm3Vp6mXoaTYnF5uFdDttMLvmWuJdhhgs.ttf) format(\'truetype\');
}
@font-face {
    font-family: \'Open Sans\';
    font-style: normal;
    font-weight: 400;
    src: local(\'Open Sans\'), local(\'OpenSans\'), url(https://fonts.gstatic.com/s/opensans/v13/cJZKeOuBrn4kERxqtaUH3aCWcynf_cDxXwCLxiixG1c.ttf) format(\'truetype\');
}
@font-face {
    font-family: \'Open Sans\';
    font-style: normal;
    font-weight: 600;
    src: local(\'Open Sans Semibold\'), local(\'OpenSans-Semibold\'), url(https://fonts.gstatic.com/s/opensans/v13/MTP_ySUJH_bn48VBG8sNSonF5uFdDttMLvmWuJdhhgs.ttf) format(\'truetype\');
}
        </style>
        <!--[if mso]>
                <style>
                  h1, h2, h3, h4,
                  p, ol, ul {
                    font-family: Arial, sans-serif !important;
                  }
                </style>
        <![endif]-->
</head>
<body style="font-size: 16px; background-color: #0089c0; margin: 0; padding: 0; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; -webkit-text-size-adjust: 100%; line-height: 1.5; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; height: 100% !important; width: 100% !important;">
<table bgcolor="#0089c0" class="body" style="box-sizing: border-box; border-spacing: 0; mso-table-rspace: 0pt; mso-table-lspace: 0pt; width: 100%; background-color: #0089c0; border-collapse: separate !important;" width="100%">
    <tbody>
        <tr>
            <td style="box-sizing: border-box; padding: 0; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;</td>
            <td class="container" style="box-sizing: border-box; padding: 0; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 16px; vertical-align: top; display: block; width: 600px; max-width: 600px; margin: 0 auto !important;" valign="top" width="600">
                <div class="content" style="box-sizing: border-box; display: block; max-width: 600px; margin: 0 auto; padding: 10px;">
                    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">
'.$configEmail['Subject'].'
                    </span>
                    <div class="header" style="box-sizing: border-box; width: 100%; margin-bottom: 30px; margin-top: 15px;">
                        <table style="box-sizing: border-box; width: 100%; border-spacing: 0; mso-table-rspace: 0pt; mso-table-lspace: 0pt; border-collapse: separate !important;" width="100%">
                            <tbody>
                                <tr>
                                    <td align="left" class="align-left" style="box-sizing: border-box; padding: 0; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 16px; vertical-align: top; text-align: left;" valign="top">
                                       <a href="'.get_URL().'" style="box-sizing: border-box; color: #348eda; font-weight: 400; text-decoration: none;">
                                           <img alt="'.$config['WebsiteName'].'" width="110" src="cid:logo_top" style="max-width: 100%; border-style: none;" />
                                       </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="block withRoundedCorners" bgcolor="#ffffff" style="box-sizing: border-box; width: 100%; margin-bottom: 30px; background: #ffffff; background-color: #ffffff;border-radius:6px;">
                        <table class="withRoundedCorners" style="box-sizing: border-box; width: 100%; border-spacing: 0; background: #ffffff; background-color: #ffffff; border-radius:6px;mso-table-rspace: 0pt; mso-table-lspace: 0pt; border-collapse: separate !important;" width="100%">
                            <tbody>
                                <tr>
                                    <td class="wrapper" style="box-sizing: border-box; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 16px; vertical-align: top; padding:30px; padding-bottom:10px;" valign="top">
                                        <table style="box-sizing: border-box; width: 100%; border-spacing: 0; mso-table-rspace: 0pt; mso-table-lspace: 0pt; border-collapse: separate !important;" width="100%">
                                            <tbody>';
    if(isset($configEmail['Title']) && $configEmail['Title'] != '') {
        $emailContentHTML .= '
                                                <tr>
                                                    <td style="box-sizing: border-box; padding: 0; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 16px; vertical-align: top;" valign="top">
                                                        <h2 style="margin: 0; margin-bottom: 30px; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-weight: 300; line-height: 1.5; font-size: 24px; color: #294661 !important;color: #294661;">
                                                            '.$configEmail['Title'].'
                                                        </h2>
                                                    </td>
                                                </tr>';
    }
    foreach($configEmail['box'] as $oneBox) {

        $emailContentHTML .= email_templateBaseBox($oneBox);
        
    }
    
    $emailContentHTML .= '
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="footer" style="box-sizing: border-box; clear: both; width: 100%;">
                        <table style="box-sizing: border-box; width: 100%; border-spacing: 0; mso-table-rspace: 0pt; mso-table-lspace: 0pt; font-size: 12px; border-collapse: separate !important;" width="100%">
                            <tbody>
                                <tr style="font-size: 12px;">
                                    <td align="center" class="align-center" style="box-sizing: border-box; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; vertical-align: top; font-size: 12px; text-align: center; padding: 20px 0;" valign="top">
                                        <a href="'.get_URL().'" style="box-sizing: border-box; color: #32424f; font-weight: 400; text-decoration: none; font-size: 12px;"><img alt="'.$config['WebsiteName'].'" width="50" src="cid:logo_footer" style="max-width: 100%; border-style: none;" /></a></span>
                                        <p style="margin: 0; color: #32424f; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-weight: 300;font-size: 12px; margin-bottom: 20px;color:#ffffff;">&copy; '.$config['WebsiteName'].' Inc.</p>
<table style="box-sizing: border-box; width: 100%; border-spacing: 0; mso-table-rspace: 0pt; mso-table-lspace: 0pt; font-size: 8px; border-collapse: separate !important;">
<tr style="height:1px;">
<td style="background:none; border-top:dotted 1px #ffffff; border-width:1px 0 0 0; height:4px; width:100%; margin:0px 0px 0px 0px; padding-top:0px;padding-bottom:0px;">&nbsp;</td>
</tr>
</table>
                                            <a href="https://www.facebook.com/" style="box-sizing: border-box; color: #ffffff; font-weight: 400; text-decoration: none; font-size: 14px;">Facebook</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </td>
            <td style="box-sizing: border-box; padding: 0; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;</td>
        </tr>
    </tbody>
</table>
</html>';
    return $emailContentHTML;
}

function email_templateBaseBox($oneBox) {

    if($oneBox['Type'] == 'link') {

        $boxHTML = '
<tr>
    <td style="box-sizing: border-box; padding: 0; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 16px; vertical-align: top;" valign="top">

        <table cellpadding="0" cellspacing="0" class="btn btn-primary" style="box-sizing: border-box; border-spacing: 0; mso-table-rspace: 0pt; mso-table-lspace: 0pt; width: 100%; border-collapse: separate !important;" width="100%">
            <tbody>
                <tr>
                    <td align="center" style="box-sizing: border-box; padding: 0; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 16px; vertical-align: top; padding-bottom: 15px;" valign="top">
                        <table cellpadding="0" cellspacing="0" style="box-sizing: border-box; border-spacing: 0; mso-table-rspace: 0pt; mso-table-lspace: 0pt; width: auto; border-collapse: separate !important;">                                                    <tbody>
                                <tr>
                                    <td align="center" bgcolor="#0089c0" style="box-sizing: border-box; padding: 0; border-radius:3px;font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 16px; vertical-align: top; background-color: #0089c0; text-align: center;" valign="top">
                                        <a href="'.$oneBox['URL'].'" style="box-sizing: border-box; border-color: #348eda; border-radius:3px;font-weight: 400; text-decoration: none; display: inline-block; margin: 0; color: #ffffff; background-color: #0089c0; border: solid 1px #0089c0; cursor: pointer; font-size: 14px; padding: 12px 45px;"><strong style="font-weight:normal">'.$oneBox['URLDesc'].'</strong></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

    </td>
</tr>';

    } else if($oneBox['Type'] == 'text') {

        $boxHTML = '
<tr>
    <td style="box-sizing: border-box; padding: 0; color: #294661; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 300; vertical-align: top;" valign="top">
        <p style="margin: 0; margin-bottom: 30px; color: #294661; font-family: \'Open Sans\', \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 300;">'.$oneBox['Content'].'
    </td>
</tr>';
    }
    
    return $boxHTML;

}


function email_templateTicket() {
    global $config, $configEmail, $user;

    $contentLang = lg('Your ticket has been updated. To check the ticket status and add a new comment, foll...', NULL, FALSE, $user['lang']);

    $htmlMailContent = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; " />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Windows Phone 8 fix -->
  <!-- hack for Outlook so it doesn\'t default to its favorite font, Times New Roman -->
  <!--[if mso]>
  <style>
    body {
      font-family: Helvetica, Arial, sans-serif !important;
    }
  </style>
  <![endif]-->
</head>
<body yahoofix="true" style="font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; width: 100% !important; -ms-text-size-adjust: none !important; background: #f4f4f4; margin: 0;" bgcolor="#f4f4f4">
<style type="text/css">
  @font-face {
    font-family: \'Source Sans Pro\'; font-style: normal; font-weight: 300; src: local(\'Source Sans Pro Light\'), local(\'SourceSansPro-Light\'), url(\'http://fonts.gstatic.com/s/sourcesanspro/v9/toadOcfmlt9b38dHJxOBGMw1o1eFRj7wYC6JbISqOjY.ttf\') format(\'truetype\');
  }
  @font-face {
    font-family: \'Source Sans Pro\'; font-style: normal; font-weight: 400; src: local(\'Source Sans Pro\'), local(\'SourceSansPro-Regular\'), url(\'http://fonts.gstatic.com/s/sourcesanspro/v9/ODelI1aHBYDBqgeIAH2zlNzbP97U9sKh0jjxbPbfOKg.ttf\') format(\'truetype\');
  }
  @font-face {
    font-family: \'Source Sans Pro\'; font-style: normal; font-weight: 600; src: local(\'Source Sans Pro Semibold\'), local(\'SourceSansPro-Semibold\'), url(\'http://fonts.gstatic.com/s/sourcesanspro/v9/toadOcfmlt9b38dHJxOBGNNE-IuDiR70wI4zXaKqWCM.ttf\') format(\'truetype\');
  }
  @media only screen and (max-device-width: 480px) {
    body[yahoofix] .main-container {
      width: 100% !important; padding: 5px;
    }
    body[yahoofix] .m-full-width {
      width: 100% !important;
    }
    body[yahoofix] .m-full-image {
      width: 100% !important; min-width: 310px !important; height: auto !important;
    }
  }
</style>
<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%"><tr><td align="center">
    <table width="640" cellpadding="0" cellspacing="0" class="main-container"><tr></tr>
        <tr><!-- start section module --><td style="padding:20px 0;">
            <table border="0" cellspacing="0" cellpadding="0" width="100%" class="section-wrapper" style="border-collapse: collapse; background: #fff; border: 1px solid #e4e4e4;" bgcolor="#fff">
                <tbody><tr><td>
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                        <tbody><tr><td align="left" style="padding: 15px 30px 30px;">
                            <h2 style="font-size: 16px; font-weight: 400; color: #222222; margin: 0;">
                            <p>'.$contentLang.' <a target="_blank" style="box-sizing: border-box; color: #348eda; font-weight: 400; text-decoration: none;" href="'.$configEmail['LinkTicket'].'">'.$configEmail['LinkTicket'].'</a></p>
                            <div style="margin-top: 25px" data-version="2">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr><td width="100%" style="padding: 15px 0; border-top: 1px dotted #c5c5c5;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style=" table-layout:fixed;">
                                            <tr><td valign="top" style="padding: 0 15px 0 15px;width: 40px;">
                                                <img alt="Helpdesk" height="40" src="'.$config['ImagesURL'].'emails/ticket-reply.png" style="height: auto; line-height: 100%; outline: none; text-decoration: none; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;" width="40" />
                                                </td>
                                                <td width="100%" style="padding: 0; margin: 0;" valign="top">
                                                <p style="font-family: \'Lucida Grande\',\'Lucida Sans Unicode\',\'Lucida Sans\',Verdana,Tahoma,sans-serif; font-size: 15px; line-height: 18px; margin-bottom: 0; margin-top: 0; padding: 0; color:#1b1d1e;">
                                                    <strong>'.$configEmail['ShowName'].'</strong>
                                                    <span class="directional_text_wrapper">('.$config['WebsiteName'].')</span>
                                                </p>
                                                <p style="font-family: \'Lucida Grande\',\'Lucida Sans Unicode\',\'Lucida Sans\',Verdana,Tahoma,sans-serif; font-size: 13px; line-height: 25px; margin-bottom: 15px; margin-top: 0; padding: 0; color:#bbbbbb;">
                                                    '.$configEmail['Date'].'
                                                </p>
                                                <div style="color: #2b2e2f; font-family: \'Lucida Sans Unicode\', \'Lucida Grande\', \'Tahoma\', Verdana, sans-serif; font-size: 14px; line-height: 22px; margin: 15px 0">
                                                    <p style="color: #2b2e2f; font-family: \'Lucida Sans Unicode\', \'Lucida Grande\', \'Tahoma\', Verdana, sans-serif; font-size: 14px; line-height: 22px; margin: 15px 0" dir="auto">

'.$configEmail['Message'].'

                               </div>
                            </td>
                   </tr></table></td>
            </tr></table></div></h2>


      </td>
      </tr><tr><td align="left" style="padding: 0 30px 15px;">
        </td>
        </tr></tbody></table></td>
    </tr></tbody></table>
</td></tr><!-- end section module --></table>

</td>
  </tr></table>

</body>
</html>';

    return $htmlMailContent;
}
?>
