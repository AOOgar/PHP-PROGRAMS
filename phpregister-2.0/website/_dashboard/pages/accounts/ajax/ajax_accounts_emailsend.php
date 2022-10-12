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

define('_PATHROOT', '../../../../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');
require_once (_PATHROOT.'include/php/emails/global_email.inc.php');

init_langVars(['Admin']);

if(!check_adminRights('accounts')) {
    echo '<script>location.reload();</script>';
    exit;
}

if($_POST['InputReplyTo'] != '') {
    $configEmail['ReplyTo'] = $_POST['InputReplyTo'];
}
if($_POST['InputBcc'] != '') {
    $configEmail['BCC'] = $_POST['InputBcc'];
}
if($_POST['InputFrom'] != '') {
    $configEmail['From'] = $_POST['InputFrom'];
}

//$configEmail['FromName'] = "Vincent";
$configEmail['To'] = $_POST['InputEmail'];
$configEmail['ToName'] = $_POST['InputName'];

$configEmail['Subject'] = $_POST['InputSubject'];
$configEmail['Body'] = $_POST['TextareaBody'];

$configEmail['Template'] = 'email_templateEmpty';

$catchError = email_send();

if($catchError != '') { // Returned an error !
    echo 'Error! Sending email: '.$catchError;
} else {

    echo '
<div class="p-4">
    <div class="pb-4 text-center">
        <div class="mx-auto"><span class="label label-danger p-3 fnt-1-1">'.lg('Email sent!').'</span></div>
    </div>
    <div class="p-4">
        <div class="p-2"><span class="border border-secondary bg-light fnt-0-9 p-2">'.lg('From').': '.$_POST['InputFrom'].'</span></div>';
    if($_POST['InputReplyTo'] != '') {
        echo '
        <div class="p-2"><span class="border border-secondary bg-light fnt-0-9 p-2">'.lg('Reply to').': '.$_POST['InputReplyTo'].'</span></div>';
    }
    if($_POST['InputBcc'] != '') {
        echo '
        <div class="p-2"><span class="border border-secondary bg-light fnt-0-9 p-2">'.lg('Blind copy to').': '.$_POST['InputBcc'].'</span></div>';
    }
    echo '
        <div class="p-2"><strong>'.lg('Subject').': '.$_POST['InputSubject'].'</strong></div>
        <p>'.$_POST['TextareaBody'].'</p>
    </div>
</div>';
}

echo '
<script>
$("#DivEmailPreview").removeClass("dis-n").addClass("dis-n");
$("#DivEmailForm").removeClass("dis-n").addClass("dis-n");
$("#DivEmailSent").removeClass("dis-n");
$("#DivEmailSent").css("opacity", "0");
$("#BtEmailPreview").prop("disabled", true);
$("#BtEmailPreview").css("cursor", "auto");
$("#BtEmailSend").btn("reset");
setTimeout(function() {
    $("#InputSubject").val("");
    $("#InputBcc").val("");
    CKEDITOR.instances["TextareaBody"].setData("");
    $("#BtEmailSend").prop("disabled", true);
    $("#BtEmailSend").css("cursor", "auto");
    $("#DivEmailSent").fadeTo("fast", 1);
}, 1000);

NProgress.done();
</script>';



?>
