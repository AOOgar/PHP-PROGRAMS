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

init_langVars(['Helpdesk', 'Global']);

if(!isset($_SESSION['UserId'])) {
    echo '
<script>
window.location.href = "'.get_URL().'/account";
</script>';
    exit;
}

$sql = $dataBase->prepare('UPDATE pr__ticket
                           SET
                                next = :next
                           WHERE id = :id');

$sql->execute(['next'  => 'support',
               'id'    => $_POST['ticket_id']]);
$sql->closeCursor();

$sql = $dataBase->prepare('INSERT INTO pr__ticket_reply(user_id,
                                                        ticket_id,
                                                        date,
                                                        message,
                                                        reply_as)
                                       VALUES(:user_id,
                                              :ticket_id,
                                              :date,
                                              :message,
                                              :reply_as)');

$sql->execute(['user_id'    => get_userIdSession(),
               'ticket_id'  => $_POST['ticket_id'],
               'date'       => date("Y-m-d H:i:s"),
               'message'    => $_POST['TextareaReply'],
               'reply_as'   => 'user']);
$sql->closeCursor();

$sql = $dataBase->prepare('SELECT firstname, lastname, email
                           FROM pr__user
                           WHERE id = :id');
$sql->execute(['id' => get_userIdSession()]);
$user = $sql->fetch();
$sql->closeCursor();

$replyDate = get_dateFormatLang(date("Y-m-d H:i:s"));

$message = htmlentities($_POST['TextareaReply']);

/**
 *  Prevent by email when a new
 *  Helpdesk ticket is open
 */

if($config['HelpdeskEmail'] === TRUE) {

    $configEmail['To'] = $config['HelpdeskEmailContact'];
    $configEmail['ToName'] = $config['HelpdeskEmailContactName'];
    $configEmail['Subject'] = 'Helpdesk / Ticket reply '.$config['WebsiteName'];
    $configEmail['Title'] = 'Ticket Reply #'.$_POST['ticket_id'].' from '.$user['firstname'].' '.$user['lastname'].' ID: '.get_userIdSession().'';

    $emailBox = 'Message :<br> '.nl2br($message);
    $configEmail['box'][0]['Type'] = 'text';
    $configEmail['box'][0]['Content'] = $emailBox;

    $configEmail['Template'] = 'email_templateBase';
    email_send();

}


echo '
<div id="DivAjaxReply" class="border bg-light rounded p-3 mb-3 opa-0">
    <div class="float-left">
        <b>'.lg('From').': </b>'.$user['firstname'].' '.$user['lastname'].'
    </div>
    <div class="float-right"><b>'.lg('Date', 'Helpdesk').': </b>'.get_dateFormatLang(date("Y-m-d H:i:s")).'</div>
    <div class="clearfix"></div>';
$message = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $message);;
echo '
    <hr class="my-2">
    <p class="mb-0 space-wrap">'.$message.'</p>
</div>

<script>
setTimeout(function () {
  $("#DivAjaxReply").appendTo($("#DivAjaxReplies"));
  $("#BtTicketReply").btn("reset");
  $("#DivAjaxTicketPreview").addClass("dis-n");
  $("#DivAjaxReply").fadeTo("slow", 1);
  $("#SpanReplyNext").html("'.lg('Waiting a reply from the user support').'");
}, 1000);
</script>';





?>
