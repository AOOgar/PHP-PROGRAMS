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

$sql = $dataBase->prepare('SELECT firstname, lastname, email, lang
                           FROM pr__user
                           WHERE id = :id');
$sql->execute(['id'  => $_POST['ticket_user_id']]);
$user = $sql->fetch();
$sql->closeCursor();

init_langVars(['Admin', 'Helpdesk', 'Global'], 
              [$config['UserLang'], $user['lang']]); // Target Langs with Current admin user lang and the User lang who opened the ticket

if(!check_adminRights('helpdesk')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

$sql = $dataBase->prepare('UPDATE pr__ticket
                           SET
                                next = :next
                           WHERE id = :id');

$sql->execute(['next'   => 'user',
               'id'     => $_POST['ticket_id']]);
$sql->closeCursor();

$sql = $dataBase->prepare('INSERT INTO pr__ticket_reply(user_id,
                                                        ticket_id,
                                                        showname,
                                                        date,
                                                        message)
                                       VALUES(:user_id,
                                              :ticket_id,
                                              :showname,
                                              :date,
                                              :message)');

$sql->execute(['user_id'    => get_userIdSession(),
               'ticket_id'  => $_POST['ticket_id'],
               'showname'   => $_POST['InputReplyName'],
               'date'       => date("Y-m-d H:i:s"),
               'message'    => $_POST['TextareaMessage']]);
$sql->closeCursor();

$sql = $dataBase->prepare('SELECT firstname, lastname
                           FROM pr__user
                           WHERE id = :id');

$sql->execute(['id' => get_userIdSession()]);
$userAdmin = $sql->fetch();
$sql->closeCursor();

$replyDate = get_dateFormatLang(date("Y-m-d H:i:s"));
$message = htmlentities($_POST['TextareaMessage']);
$message = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $message);

if(isset($user['email'])) {
    /** 
       Some Facebook accounts does not have emails and then create accounts with no emails 
     */

    $configEmail['To'] = $user['email'];
    $configEmail['LangUser'] = $user['email'];
    $configEmail['ToName'] = $user['firstname'].' '.$user['lastname'];
    $configEmail['Subject'] = '['.$config['WebsiteName'].' Support] #'.$_POST['ticket_id'].' - Re: '.html_entity_decode($_POST['ticket_subject']);
    $configEmail['LinkTicket'] = $config['URL'].'/account/helpdesk/?show_ticket='.$_POST['ticket_id'];
    $configEmail['ShowName'] = $_POST['InputReplyName'];
    $configEmail['Date'] = $replyDate;
    $configEmail['Message'] = nl2br($message);
    $configEmail['Template'] = 'email_templateTicket';    
    $catchError = email_send();

} else {
    
    $catchError = 'noemail';
}

echo '
<div id="DivAjaxReply" class="border border-info rounded p-3 mb-3 opa-0">
    <div class="float-left">
        <b>'.lg('From').': </b>';
if($_POST['InputReplyName'] != '') {
    echo $_POST['InputReplyName'];
} else {
    echo $userAdmin['firstname'].' '.$userAdmin['lastname'];
}
echo ' / '.lg('User support', 'Global').'
    </div>
    <div class="float-right"><b>'.lg('Date', 'Helpdesk').': </b>'.$replyDate.'</div>
    <div class="clearfix"></div>
    <hr class="my-2">
    <p class="mb-0 fnt-1-1 space-wrap">'.$message.'</p>
</div>

<div id="DivTicketReplyEmail">
    <div class="text-center">';
if($catchError == '') {
    echo '
     <p><i class="fa fa-envelope" style="font-size:50px;"></i></p>
     <p>Reply sent by email</p>';
} else if($catchError == 'noemail') {
    echo '
      <p>Social account without email</p>';
} else {
    echo '
      <p>Error email:'.$catchError.'</p>';
}
echo '
    </div>
</div>

<script>
$("#DivAjaxTicketPreview").attr("style", "opacity:0;");
setTimeout(function() {
  $("#SpanReplyNext").removeClass("text-danger").addClass("text-primary").html("Waiting for a reply from the user");
  $("#DivAjaxReply").appendTo($("#DivReplies"));
  $("#DivAjaxTicketPreview").html($("#DivTicketReplyEmail").html());
  $("#BtTicketReply").btn("reset");
  $("#DivAjaxReply").fadeTo("slow", 1);
  $("#DivAjaxTicketPreview").fadeTo("slow", 1);
  NProgress.done();';
if($_POST['ticket_status'] == 'opened') {
    echo '
  ticketStatusUpdate('.$_POST['ticket_id'].', "read")';
}
echo '
}, 1000);
</script>';

?>
