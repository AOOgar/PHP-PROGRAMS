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

init_langVars(['Helpdesk', 'Global']);

if(!isset($_SESSION['UserId'])) {
    echo '
<script>
 window.location.href = "'.get_URL().'/account";
</script>';
    exit;
}

$sql = $dataBase->prepare('SELECT *
                           FROM pr__ticket
                           WHERE id = :ticket_id AND user_id = :user_id');

$sql->execute(['ticket_id' => $_POST['ticket_id'],
               'user_id'   => get_userIdSession()]);
$ticket = $sql->fetch();
$sql->closeCursor();

$sql = $dataBase->prepare('SELECT pr__ticket_reply.*, pr__user.firstname, pr__user.lastname
                           FROM pr__ticket_reply
                           LEFT JOIN pr__user ON pr__ticket_reply.user_id = pr__user.id
                           WHERE ticket_id = :id
                           ORDER BY date');

$sql->execute(['id' => $ticket['id']]);
$replies = $sql->fetchAll();
$sql->closeCursor();

echo '
<script>
function ticketClose(id) {
 $("#BtTicketClose").btn("loading");
  var values = {"id":  id};
  $.ajax({
    url: "'.$config['URL'].'/account/helpdesk/ajax/ajax_ticket_close.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxTicket").empty().html(data);
    }
  });
}
function ticketCloseCancel() {
  $("#DivAjaxTicketClose").addClass("dis-n");
}
function ticketCloseShow() {
  $("#BtTicketMarkClosed").blur();
  $("#DivAjaxTicketClose").removeClass("dis-n");
  $("#DivAjaxTicketClose").attr("style", "opacity:0");
  $("#ModalTicketOpen").animate({ scrollTop: 0 }, 600, function() {
    $("#DivAjaxTicketClose").fadeTo("slow", 1);
  });
}
</script>
<div id="DivAjaxTicket">';
if($ticket == NULL) {
    echo '
<div class="text-center fnt-1-2 p-5" style="min-height:160px;">
  <p>'.lg('The ticket you are trying to open does not match your acc...').'</p>
</div>';
} else {
    echo '
    <div id="DivAjaxTicketClose" class="text-center dis-n">
        <p class="fnt-1-2 py-3">'.lg('Has the ticket been resolved?').'</p>
        <button type="button" onClick="ticketCloseCancel();" class="btn btn-outline-secondary mr-4">'.lg('Cancel', 'Global').'</button>
        <button type="submit" id="BtTicketClose" onClick="ticketClose(\''.$ticket['id'].'\');" class="btn btn-success" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg\'></i> &nbsp; '.lg('Closing ticket').'">'.lg('Yes, ticket resolved').'</button>
        <hr>
    </div>
    '.lg('Created on').' '.get_dateFormatLang($ticket['date']).' ';
    if($ticket['date_closed'] != NULL) {
        echo ', '.lg('Closed on').' '.get_dateFormatLang($ticket['date_closed']);
    }
    echo '
        <br><b>'.lg('Subjet').':</b> '.htmlentities($ticket['subject']);
    $message = htmlentities($ticket['message']);
    $message = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $message);
    echo '
    <div id="DivAjaxTicketMessage" class="p-2 border bg-light rounded space-wrap">'.$message.'</div>
    <div id="DivAjaxReplies" class="pt-4">';
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
        $message = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $message);;
        echo '
            <hr class="my-2">
            <p class="mb-0 space-wrap">'.$message.'</p>
        </div>';
    }
    echo '
    </div>
    <div class="p-1 text-center text-secondary"><span id="SpanReplyNext" class="font-weight-bold">';
    $cssDivTicketReply = ''; 
    if($ticket['status'] == 'closed') {
        echo lg('Ticket is closed');
        $cssDivTicketReply = 'dis-n';
    } else {
        if($ticket['next'] == 'user') {
            echo lg('Awaiting your reply');
        } else {
            echo lg('Waiting a reply from the user support');
        }
    }
    echo '</span></div>';
    if($ticket['next'] == 'user') {
        echo '
    <form action="" id="FormTicketReply"  name="FormTicketReply" action="" method="post" onSubmit="return false;">
    <input type="hidden" name="ticket_id" id="ticket_id" value="'.$ticket['id'].'">
    <div id="DivAjaxTicketReply" class="'.$cssDivTicketReply.'">
        '.lg('Reply').':
        <textarea name="TextareaReply" id="TextareaReply" class="form-control input-grey" rows="6" style="resize:vertical;"></textarea>
        <div class="text-center p-3">
            <button type="button" onClick="replyPreviewShow();" class="btn btn-info">'.lg('Preview').'</button>
        </div>
    </div>
    <div id="DivAjaxTicketPreview" class="dis-n">
        <div id="DivAjaxTicketReplyShow" class="bg-light border rounded p-3 space-wrap"></div>
        <div class="text-center p-3">
            <button type="button" onClick="showReplyTextarea();" class="btn btn-outline-secondary mr-3">'.lg('Modify', 'Global').'</button>
            <button type="submit" id="BtTicketReply" onClick="ticketReply();" class="btn btn-info" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button>
        </div>
    </div>
    </form>';
    }
}
echo '
</div>
<script>';
if($ticket['status'] == 'closed' || $ticket == NULL) {
    echo '
    $("#BtTicketMarkClosed").removeClass("dis-n").addClass("dis-n");';
} else {
    echo '
    $("#BtTicketMarkClosed").removeClass("dis-n");';
}
echo '
$("#DivModalBodyTicket").html($("#DivAjaxTicket").html());

function htmlEntities(str) {
    return String(str).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
}

function replyPreviewShow() {
  $("#DivAjaxTicketReplyShow").html(htmlEntities($("#TextareaReply").val()));
  $("#DivAjaxTicketPreview").attr("style", "opacity:0");
  $("#DivAjaxTicketPreview").removeClass("dis-n");
  $("#DivAjaxTicketReply").removeClass("dis-n").addClass("dis-n");
  $("#DivAjaxTicketPreview").fadeTo("slow", 1);
  setTimeout(function() { 
    $("#ModalTicketOpen").animate({ scrollTop: $("#DivModalBodyTicket").prop("scrollHeight") }, 600);
  }, 200);
}

setTimeout( function() { 
  $("#DivModalBodyTicket").animate({ scrollTop: $("#DivModalBodyTicket").prop("scrollHeight") }, 600)
}, 200 ); /** scrollTop wont work without setTimeout */

function ticketReply() {
   $("#BtTicketReply").btn("loading");
   var values = {"ticket_id": $("#ticket_id").val(),
                 "TextareaReply": $("#TextareaReply").val()};
   $.ajax({
     url: "'.$config['URL'].'/account/helpdesk/ajax/ajax_ticket_reply.php", type: "POST", data: values,
     success: function(data) {
       $("#AjaxTicket").empty().html(data);
     }
  });
}

function showReplyTextarea() {
  $("#DivAjaxTicketPreview").removeClass("dis-n").addClass("dis-n");
  $("#DivAjaxTicketReply").attr("style", "opacity:0");
  $("#DivAjaxTicketReply").addClass("dis-n").removeClass("dis-n");
  $("#DivModalBodyTicket").scrollTop($("#DivModalBodyTicket").prop("scrollHeight"));
  $("#DivAjaxTicketReply").fadeTo("slow", 1);
  setTimeout(function() { 
    $("#DivModalBodyTicket").animate({ scrollTop: $("#DivModalBodyTicket").prop("scrollHeight") }, 600)
  }, 200);
}
$("#SpanTicketOpenId").html(" #'.$ticket['id'].'");
$("#ModalTicketOpen").modal("show");
</script>';

?>
