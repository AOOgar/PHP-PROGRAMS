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

/** Security check to prevent direct access to this ajax file */
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') { exit; }

define('_PATHROOT', '../../../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');
require_once (_PATHROOT.'include/php/emails/global_email.inc.php');

init_langVars(['Contact']);

$configEmail['To'] = $config['EmailContact'];
$configEmail['ToName'] = $config['EmailContactName'];
$configEmail['Subject'] = 'Message from '.$config['WebsiteName'].': '.$_POST['InputSubject'];
$configEmail['Title'] = 'Message from the contact page';
$configEmail['ReplyTo'] = $_POST['InputEmail'];

$emailBox = '<b>From / Email</b>: '.$_POST['InputEmail'].'<br>';
$emailBox .= '<b>Subject</b>: '.$_POST['InputSubject'].'<br>';
$emailBox .= '<b>Message</b>:<br> '.nl2br($_POST['TextareaMessage']);
$configEmail['box'][0]['Type'] = 'text';
$configEmail['box'][0]['Content'] = $emailBox;

$configEmail['Template'] = 'email_templateBase';

$catchError = email_send();

$catchError = '';

echo '
<div id="DivAjaxMessage">
    <div class="p-5 text-center mt-4">';

if($catchError == '') {

    echo '
           <p><i class="fa fa-envelope-o text-mytheme" style="font-size:80px;"></i></p>
           <p class="fnt-1-3">'.lg('Message sent!').'</p>';

} else {

    echo '
Error sending email: '.$catchError;

}
echo '
    </div>
</div>';

echo '
<script>
setTimeout(function () {
  $("#BtMessage").btn("reset");
  $("#DivMessage").animate({
    opacity: 0,
    height: "200px"
  }, 800, function() {
  $(this).html($("#DivAjaxMessage").html());
  scrollToElemMiddle($("#DivMessage"));
  $(this).animate({
    opacity: 1,
  }, 800);
});

}, 1000);
</script>';

?>
