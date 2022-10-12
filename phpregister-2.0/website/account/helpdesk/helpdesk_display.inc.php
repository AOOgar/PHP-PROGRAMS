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

function show_helpdesk() {
    global $config, $tickets, $userAdmin, $ticketCount, $ticketReplyCount, $userAdmin, $jsDocumentReady, $jsWindowLoaded, $jsScripts;
    
    $jsDocumentReady .= '
$("#DivAccountContent").fadeTo("slow", 1);';

    echo '
<div id="DivAccountContent" class="container py-3 py-sm-5 opa-0" style="max-width:890px;">

    <h2 class="fnt-1 clr-mytheme font-weight-bold">'.lg('User support', 'Global').'</h2>

    <div class="container my-5" style="max-width:900px;min-height:500px;">
        <div id="DivTickets">';
    $opened = 0;
    $classNoTicketOpened = '';
    if(sizeof($tickets) != 0) {
        $classNoTicketOpened = 'dis-n';
        foreach($tickets as $oneTicket) {
            if($oneTicket['status'] != 'closed') {
                $opened++;
            }
            echo html_oneTicket($oneTicket);
        }
    }
    echo '
        </div>
        <div id="DivTicketEmpty" class="'.$classNoTicketOpened.'">
            <div class="my-5 text-center p-4 fnt-1-1">
                <p><i class="fa fa-weixin text-mytheme fa-5x"></i></p>
                <p>'.lg('No ticket open to user support').'</p>
            </div>
        </div>
        <div class="mt-5 text-center"><button id="BtTicketOpenNew" type="button" onClick="showModalTicketNew();" class="btn btn-mytheme">'.lg('Open a ticket').'</button></div>
    </div>
</div>';

    $jsScripts .= '
function showModalTicketNew() {
  var values = {"do": "showdelete"};
  $.ajax({
    url: "'.$config['URL'].'/account/helpdesk/ajax/ajax_ticketnew_modalopen.php",
    type: "POST",
    data: values,
    success: function(data) {
      $("#DivModalBodyTicketNew").empty().html(data);
      $("#ModalTicketNew").modal("show");
    },
    error: function(exception) { console.log(exception); }
  });
}';

    $jsScripts .= '
function openTicket(id) {
  var values = {"ticket_id": id};
  $.ajax({
    url: "'.$config['URL'].'/account/helpdesk/ajax/ajax_ticket_open.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxTicket").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}';

    
    echo '
<div class="modal modal-responsive modal-mytheme fade" id="ModalTicketOpen" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-olor:red;">
                <h5 class="modal-title">Ticket <span id="SpanTicketOpenId"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivModalBodyTicket">
            </div>
            <div class="modal-footer">
                <button type="button" id="BtTicketMarkClosed" onClick="ticketCloseShow();" class="btn btn-outline-success mr-auto"><i class="fa fa-thumbs-up pr-2"></i>'.lg('Ticket resolved').'</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">'.lg('Close', 'Global').'</button>
            </div>
        </div>
    </div>
</div>
<div id="AjaxTicket" class="dis-n"></div>

<div class="modal modal-mytheme fade" id="ModalTicketNew" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">'.lg('New ticket').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivModalBodyTicketNew">
            </div>
        </div>
    </div>
</div>';

    if(isset($_GET['show_ticket'])) {
        $jsScripts .= '
setTimeout(function () {openTicket(\''.urldecode($_GET['show_ticket']).'\')}, 2000);';
    }   
}


function html_oneTicket($ticket) {

    if($ticket['status'] == "opened") {
        $borderStatus = 'border-success shadow';
        $textStatus = lg('Sent');
        $textColor = 'text-success';
    } else if($ticket['status'] == "read") {
        $borderStatus = 'border-warning shadow';
        $textStatus = lg('In progress');
        $textColor = 'text-warning';
    } else if($ticket['status'] == "closed") {
        $borderStatus = 'border-secondary';
        $textStatus = lg('Resolved');
        $textColor = 'text-secondary';
    }    
    
    $html = '
<div id="DivTicket'.$ticket['id'].'" class="my-4 ml-4 bg-white border '.$borderStatus.' p-3 rounded" style="min-height:50px;">
    <div class="row">
        <div class="col-sm-5">
            <span class="font-weight-bold">'.lg('Subjet').':</span> ';
    if(strlen($ticket['subject']) > 50) {
        $html .= substr($ticket['subject'], 0, 47).'...';
    } else {
        $html .= $ticket['subject'];
    }
    $html .= '
        </div>
        <div class="col-sm-3 text-center">
            <span class="align-middle">'.get_dateFormatLang($ticket['date']).'</span>
        </div>
        <div class="col-sm-2" id="DivColStatus'.$ticket['id'].'">
            <div id="DivStatus'.$ticket['id'].'" class="'.$textColor.' fnt-0-9 p-2 text-center font-weight-bold">'.$textStatus.'</div>';
    $html .= '
            </span>
        </div>
        <div class="col-sm-2 text-center">
           <button class="btn btn-mytheme" onClick="openTicket(\''.$ticket['id'].'\');" ><i class="fa fa-comment pr-2"></i>'.lg('Open').'</button>
        </div>
    </div>
</div>';

    return $html;
}

?>
