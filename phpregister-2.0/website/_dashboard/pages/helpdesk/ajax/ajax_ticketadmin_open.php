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

init_langVars(['Admin', 'Helpdesk', 'Global']);

if(!check_adminRights('helpdesk')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

$sql = $dataBase->prepare('SELECT *
                           FROM pr__ticket
                           WHERE id = :id');

$sql->execute(array('id' => $_POST['ticket_id']));
$ticket = $sql->fetch();
$sql->closeCursor();

if(!$ticket) {
    echo '<div id="DivAjaxTicket" class="text-center py-5 fnt-1-3">Ticket not found, it might have been deleted!</div>';
    echo '
<script>
$("#DivModalBodyTicketDetails").empty();
$("#DivAjaxTicket").appendTo($("#DivModalBodyTicketDetails"));
$("#DivModalFooterTicket").html("");
$("#ModalTicketOpen").modal("show");
</script>';
    exit;    
}

$sql = $dataBase->prepare('SELECT firstname, lastname
                           FROM pr__user
                           WHERE id = :id');

$sql->execute(['id' => get_userIdSession()]);
$userAdmin = $sql->fetch();
$sql->closeCursor();

$sql = $dataBase->prepare('SELECT firstname, lastname, email, lang
                           FROM pr__user
                           WHERE id = :id');

$sql->execute(array('id' => $ticket['user_id']));
$user = $sql->fetch();
$sql->closeCursor();
if(!isset($user['email'])) {
    /** 
    Some Facebook accounts does not have emails (created with mobile phones) and then create accounts with no emails 
    */
    $user['email'] = lg('Account without email');
}

$sql = $dataBase->prepare('SELECT pr__ticket_reply.*, pr__user.firstname, pr__user.lastname
                           FROM pr__ticket_reply
                           LEFT JOIN pr__user ON pr__ticket_reply.user_id = pr__user.id
                           WHERE pr__ticket_reply.ticket_id = :id
                           ORDER BY pr__ticket_reply.date');

$sql->execute(['id' => $ticket['id']]);
$replies = $sql->fetchAll();
$sql->closeCursor();

$sql = $dataBase->prepare('SELECT helpdesk_replyas, helpdesk_signaturetext
                           FROM pr__user_adminprefs
                           WHERE user_id = :id');

$sql->execute(['id' => get_userIdSession()]);
$userPrefs = $sql->fetch();
$sql->closeCursor();

if($userPrefs['helpdesk_replyas'] == NULL) {
    $replyAs = $userAdmin['firstname'].' '.$userAdmin['lastname'];
} else {
    $replyAs = $userPrefs['helpdesk_replyas'];
}

$cssReopen = 'dis-n';
$cssRead = '';
$cssClosed = '';
if($ticket['status'] == 'closed') {
    $cssClosed = 'dis-n';
    $cssReopen = '';
} else {
    if( ($ticket['status'] == 'read') ||
        ($ticket['status'] == 'closed') ) {
        $cssRead = 'dis-n';
    }
}
echo '
<div id="DivAjaxTicketFooter">
    <div class="mr-auto">
        <button type="button" id="BtTicketMarkRead" onClick="ticketStatusUpdate('.$ticket['id'].', \'read\');" class="btn btn-warning '.$cssRead.' '.$cssClosed.'"><i class="fa fa-eye pr-2"></i>'.lg('In progress', 'Helpdesk').'</button>
        <button type="button" id="BtTicketMarkClosed" onClick="ticketStatusUpdateShow($(\'#DivAjaxTicketClose\'));" class="btn btn-success ml-3 '.$cssClosed.'"><i class="fa fa-thumbs-up pr-2"></i>'.lg('Resolved', 'Helpdesk').'</button>
        <button type="button" id="BtTicketMarkReopen" onClick="ticketStatusUpdateShow($(\'#DivAjaxTicketReopen\'));" class="btn btn-success ml-3 '.$cssReopen.'"><i class="fa fa-folder-open pr-2"></i>'.lg('Reopen').'</button>
    </div>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">'.lg('Close', 'Global').'</button>
</div>
<div id="DivAjaxTicket">';
if($_POST['forDelete'] == 1) {
    echo '
<div id="DivAjaxTicketDelete" class="container my-4 mx-auto rounded-lg p-4 bg-light border border-danger text-center" style="max-width:600px;">
    <div class="row">
        <div class="col-sm-2 text-center">
            <i class="fa fa-trash fa-3x pr-4"></i>
        </div>
        <div class="col-sm-10">
            <p><b>'.lg('Please confirm the deletion of the ticket and its replies.').'</b></p>
            <p class="text-center bg-warning fnt-1-2 rounded-lg p-3">'.lg('You can not undo this deletion').'</p>
        </div>
    </div>
    <button type="button" onClick="ticketDeleteCancel();" class="btn btn-outline-secondary mr-4 mt-4">'.lg('Cancel', 'Global').'</button>
    <button id="BtTicketDelete" onClick="ticketDelete('.$ticket['id'].');" class="btn btn-outline-danger mx-auto mt-4" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Delete in progress').'">'.lg('Delete this ticket').'</button>
</div>
<script>
function ticketDeleteCancel() {
  $("#DivAjaxTicketDelete").hide(1000);
}
function ticketDelete(id) {
  $("#BtTicketDelete").btn("loading");
  NProgress.start();
  var values = {"ticket_id":  id};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/helpdesk/ajax/ajax_ticketadmin_delete.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxTicketOpen").empty().html(data);
      NProgress.done();
    }
  });
}
</script>';
}
echo '
<script>
function ticketStatusUpdateShow(element) {
  $(".btn").blur();
  element.removeClass("dis-n");
  element.attr("style", "opacity:0");
  $("#ModalTicketOpen").animate({ scrollTop: 0 }, 1000, function() {
    element.fadeTo("slow", 1);
  });
}
function ticketClose(id) {
    $("#BtTicketClose").btn("loading");
    ticketStatusUpdate(id, "closed");
}
function ticketCloseCancel() {
  $("#DivAjaxTicketClose").addClass("dis-n");
}
function ticketReopen(id) {
    $("#BtTicketReopen").btn("loading");
    ticketStatusUpdate(id, "reopen");
}
function ticketReopenCancel() {
  $("#DivAjaxTicketReopen").addClass("dis-n");
}
</script>

<div class="mx-auto" style="max-width:600px;">
<div id="DivAjaxTicketClose" class="container my-4 mx-auto rounded-lg p-4 bg-light border border-warning text-center dis-n">
    <div class="row">
        <div class="col-sm-2 text-center">
            <i class="fa fa-file-archive-o fa-4x pr-4"></i>
        </div>
        <div class="col-sm-10 text-center">
            <p class="fnt-1-2">'.lg('Please confirm the ticket resolution').'</p>
    <button type="button" onClick="ticketCloseCancel();" class="btn btn-outline-secondary mr-4 mt-4">'.lg('Cancel', 'Global').'</button>
    <button id="BtTicketClose" onClick="ticketClose('.$ticket['id'].');" class="btn btn-success mx-auto mt-4" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'"><i class="fa fa-thumbs-up pr-2"></i>'.lg('Ticket resolved', 'Helpdesk').'</button>

        </div>
    </div>
</div>
</div>
<div class="mx-auto" style="max-width:600px;">
<div id="DivAjaxTicketClose" class="container my-4 mx-auto rounded-lg p-4 bg-light border border-warning text-center dis-n">
    <div class="row">
        <div class="col-sm-2 text-center">
            <i class="fa fa-file-archive-o fa-4x pr-4"></i>
        </div>
        <div class="col-sm-10 text-center">
            <p class="fnt-1-2">'.lg('Please confirm the ticket resolution').'</p>
            <button type="button" onClick="ticketCloseCancel();" class="btn btn-outline-secondary mr-4 mt-4">'.lg('Cancel', 'Global').'</button>
            <button id="BtTicketClose" onClick="ticketClose('.$ticket['id'].');" class="btn btn-success mx-auto mt-4" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'"><i class="fa fa-thumbs-up pr-2"></i>'.lg('Ticket resolved', 'Helpdesk').'</button>
        </div>
    </div>
</div>
</div>

<div class="mx-auto" style="max-width:600px;">
<div id="DivAjaxTicketReopen"  class="container my-4 mx-auto rounded-lg p-4 bg-light border border-warning text-center dis-n">
    <div class="row">
        <div class="col-sm-2 text-center">
            <i class="fa fa-file-archive-o fa-4x pr-4"></i>
        </div>
        <div class="col-sm-10 text-center">
            <p>'.lg('Please confirm the reopening of the ticket').'</p>
            <button type="button" onClick="ticketReopenCancel();" class="btn btn-outline-secondary mr-4 mt-4">'.lg('Cancel', 'Global').'</button>
            <button id="BtTicketReopen" onClick="ticketReopen('.$ticket['id'].');"  class="btn btn-warning mx-auto mt-4" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'"><i class="fa fa-thumbs-up pr-2"></i>'.lg('Reopen the ticket').'</button>
        </div>
    </div>
</div>
</div>


    <div class="row">
        <div class="col-sm-9">
            <b>'.$user['firstname'].' '.$user['lastname'].'</b> / '.$user['email'].' / '.ucfirst($config['LangsNames'][$user['lang']]).'<br/>
        </div>
        <div class="col-sm-3 text-right">
            Ticket #'.$ticket['id'].'
        </div>
    </div>       
    <div class="row">
        <div class="col-sm-6">
            <b>'.lg('Date', 'Helpdesk').':</b> '.get_dateFormatLang($ticket['date']);
if($ticket['date_closed'] != NULL) {
    echo '<span id="SpanDateClosed">, <strong>Closed on</strong> '.get_dateFormatLang($ticket['date_closed']).'</span>';
}
echo '
            <br><br><b>'.lg('Subjet', 'Helpdesk').':</b> '.htmlentities($ticket['subject']).'
        </div>
        <div class="col-sm-6 text-right">';
        if($ticket['status'] == "opened") {
            $textStatus = lg('Sent', 'Helpdesk');
            $textColor = 'text-success';
        } else if($ticket['status'] == "read") {
            $textStatus = lg('In progress', 'Helpdesk');
            $textColor = 'text-warning';
        } else if($ticket['status'] == "closed") {
            $textStatus = lg('Resolved', 'Helpdesk');
            $textColor = 'text-secondary';
        }
echo '
            Status: <span id="SpanTicketOpenStatus" class="font-weight-bold '.$textColor.'">'.$textStatus.'</span>
        </div>
    </div>
    <div class="font-weight-bold">'.lg('Message', 'Helpdesk').':</div>
    <div class="p-3 border border bg-light rounded fnt-1-1 space-wrap">'.htmlentities($ticket['message']).'</div>
    <div class="text-center pt-1">';
$cssDivReplyForm = ''; 
if($ticket['status'] == 'closed') {
    echo lg('Ticket is closed', 'Helpdesk');
    $cssDivReplyForm = 'dis-n';
} else {

    if($ticket['next'] == 'user') {
        $cssText = 'text-primary';
        $text = lg('Waiting a reply from the user', 'Helpdesk');
    } else {
        $cssText = 'text-danger';
        $text = lg('Waiting a reply from the user support', 'Helpdesk');
    }
    echo '<span id="SpanReplyNext" class="'.$cssText.'">'.$text.'</span>';
}
echo '
    </div>
    <div id="DivReplies" class="pt-2">';

foreach($replies as $oneReply) {
    $cssMessage = 'bg-light';
    if($oneReply['reply_as'] == 'support') {
        $cssMessage = 'border-info';
    }
    echo '
        <div class="border '.$cssMessage.' rounded p-3 mb-3">
            <div class="float-left">
                <b>'.lg('From').': </b>';
    if($oneReply['showname'] != NULL) {
        echo $oneReply['showname'];
    } else {
        echo $oneReply['firstname'].' '.$oneReply['lastname'];
    }
    if($oneReply['reply_as'] == 'support') {
        echo ' / '.lg('User support', 'Global');
    }
        echo '
            </div>
            <div class="float-right"><b>'.lg('Date', 'Helpdesk').': </b>'.get_dateFormatLang($oneReply['date']).'</div>
            <div class="clearfix"></div>';
    $message = htmlentities($oneReply['message']);
    $message = str_replace('  ', '&nbsp;&nbsp;', $message); // Not to loose indent style if the message contains some code
        echo '<hr class="my-2">
            <p class="mb-0 fnt-1-1 space-wrap">'.$message.'</p>
        </div>';
}

echo '
    </div>
    <hr>
    <form action="" id="FormTicketReply"  name="FormTicketReply" action="" method="post" onSubmit="return false;">
    <input type="hidden" name="ticket_subject" id="ticket_subject" value="'.htmlentities($ticket['subject']).'">
    <input type="hidden" name="ticket_user_id" id="ticket_user_id" value="'.$ticket['user_id'].'">
    <input type="hidden" name="ticket_status" id="ticket_status" value="'.$ticket['status'].'">
    <input type="hidden" name="ticket_id" id="ticket_id" value="'.$ticket['id'].'">
    <div id="DivAjaxTicketReply" class="text-center '.$cssDivReplyForm.'">
        <div class="input-group">
            <div class="input-group-prepend">
               <span class="input-group-text bg-light" >'.lg('Reply as').'</span>
            </div>
            <input value="'.$replyAs.'" name="InputReplyName" id="InputReplyName" class="form-control input-grey rounded-right">
        </div>
        <textarea name="TextareaMessage" id="TextareaMessage" class="form-control input-grey rounded mt-3" rows="7" style="resize:vertical;">'.$userPrefs['helpdesk_signaturetext'].'</textarea>
        <button type="button" onClick="showReplyPreview();" class="my-4 btn btn-info">Preview</button>
    </div>
    <div id="DivAjaxTicketPreview" class="dis-n">
        <p><b>Reply as </b><span id="SpanReplyAs"></span></p>
        <div id="DivAjaxTicketReplyShow" class="p-3 border border-info rounded fnt-1-1 space-wrap"></div>
        <div class="text-center">
            <button type="button" onClick="showReplyTextarea();" class="my-3 mr-3 btn btn-outline-secondary">'.lg('Modify', 'Global').'</button>
            <button type="submit" id="BtTicketReply" onClick="ticketReply();" class="my-3 btn btn-info" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button>
        </div>
    </div>
    </form>
</div>
<script>
$("#DivModalBodyTicketDetails").empty();
$("#DivAjaxTicket").appendTo($("#DivModalBodyTicketDetails"));
$("#DivModalFooterTicket").html($("#DivAjaxTicketFooter").html());
function ticketReply() {
   NProgress.start();
   $("#BtTicketReply").btn("loading");
   var values = {"ticket_subject": $("#ticket_subject").val(),
                 "ticket_user_id": $("#ticket_user_id").val(),
                 "ticket_id": $("#ticket_id").val(),
                 "ticket_status": $("#ticket_status").val(),
                 "InputReplyName": $("#InputReplyName").val(),
                 "TextareaMessage": $("#TextareaMessage").val()};
   $.ajax({
   url: "'.$config['AdminURL'].'/pages/helpdesk/ajax/ajax_ticketadmin_reply.php", type: "POST", data: values,
   success: function(data) {
       $("#AjaxTicketOpen").empty().html(data);
     }
   });
}
$("#ModalTicketOpen").modal("show");
NProgress.done();
function htmlEntities(str) {
  return String(str).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
}
function showReplyPreview() {
  $("#DivAjaxTicketReplyShow").html(htmlEntities($("#TextareaMessage").val()));
  if($("#InputReplyName").val() == "") {
    $("#InputReplyName").val("'.htmlentities($sessionUser['firstname']).' '.htmlentities($sessionUser['lastname']).'");
  }
  $("#SpanReplyAs").text($("#InputReplyName").val());
  $("#DivAjaxTicketPreview").attr("style", "opacity:0");
  $("#DivAjaxTicketPreview").removeClass("dis-n");
  $("#DivAjaxTicketReply").removeClass("dis-n").addClass("dis-n");
  $("#DivAjaxTicketPreview").fadeTo("slow", 1);
}

function showReplyTextarea() {
  $("#DivAjaxTicketPreview").removeClass("dis-n").addClass("dis-n");
  $("#DivAjaxTicketReply").attr("style", "opacity:0");
  $("#DivAjaxTicketReply").addClass("dis-n").removeClass("dis-n");
  $("#DivAjaxTicketReply").fadeTo("slow", 1);
}

function ticketStatusUpdate(id, status) {
  NProgress.start();
  var values = {"markas": status, "id":  id};
  $("#BtTicketMarkRead").addClass("dis-n");
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/helpdesk/ajax/ajax_ticketadmin_status.php",
    type: "POST",
    data: values,
    success: function(data) {
      $("#AjaxTicketOpen").empty().html(data);
      NProgress.done();
    }
  });
}
</script>';

?>
