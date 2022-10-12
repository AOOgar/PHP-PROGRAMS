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
    global $config, $dataBase, $sessionUser, $ticketCount, $ticketReplyCount, $jsWindowLoaded, $jsScripts, $jsWindowResize;
    
    $jsScripts .= '
var prefsOpened = false;
function showHelpDeskPrefs() {
  NProgress.start();
  if(prefsOpened == false) {
    $.ajax({
      url: "'.$config['AdminURL'].'/pages/helpdesk/ajax/ajax_helpdesk_prefs_show.php", type: "POST",
      success: function(data) {
          $("#AjaxHelpDeskPage").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });
    prefsOpened = true;
  } else {
     $("#DivHelpDeskPage").attr("style", "opacity:0;");
     $("#DivHelpDeskPage").removeClass("dis-n");
     $("#AjaxHelpDeskPage").removeClass("dis-n").addClass("dis-n");
     setTimeout(function () {$("#DivHelpDeskPage").fadeTo("fast", 1);NProgress.done();}, 500);
     prefsOpened = false;
  }
}';
    
    $jsWindowLoaded .= '
$("#SelectStatus").on("hidden.bs.select", function() {
    setTimeout(function () { $(".btn").blur(); }, 100);
});
$("#FormTicketsSearch").submit(function( event ) {
    ticketSearch(0);
    event.preventDefault();
})';


    echo '

<div id="DivHelpDeskPage">
    <div class="p-4 mx-auto" style="max-width:1100px;">
        <div class="card card-outline-success bg-success text-white d-inline-block">
            <div class="card-footer fnt-1-1 p-3">
                '.lg('Total number of tickets').': <b>'.number_format($ticketCount['number'], 0, '.', ' ').'</b><br>
                '.lg('﻿Total number of replies').': <b>'.number_format($ticketReplyCount['number'], 0, '.', ' ').'</b>
            </div>
        </div>
    </div>

    <div class="pb-2 d-flex justify-content-end mx-2" style="max-width:1100px;">
        <form action="#" id="FormTicketsSearch"  name="FormTicketsSearch" method="post">
        <div class="form-group" style="max-width:800px;">
            <div class="input-group rounded-left">
                <div class="input-group-prepend">
                    <select id="SelectStatus" name="SelectStatus" class="selectpicker rounded-left input-group-append" data-style="btn-info" multiple="multiple">
                        <option value="opened" selected>'.lg('Sent', 'Helpdesk').'</option>
                        <option value="read" selected>'.lg('In progress', 'Helpdesk').'</option>
                        <option value="closed" selected>'.lg('Resolved', 'Helpdesk').'</option>
                    </select>
                </div>
                <input type="text" id="searchTicket" name="searchTicket" class="form-control input-grey" value="'.$_POST['search'].'" placeholder="'.lg('Search...by Ticket ID, User ID, Subject or Message', NULL, FALSE).'">
                <div class="input-group-append">
                    <button class="btn btn-info form-control" id="BtSearch" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg\'></i>"><i class="fa fa-search" style="padding-left:6px;"></i></button>
                </div>
            </div>
        </div>
        </form>
   </div>
   <div id="DivHelpDesk" class="mx-auto" style="max-width:1100px;">
   </div>
</div>
<div id="AjaxHelpDesk" class="dis-n"></div>
<div id="AjaxHelpDeskPage" class="dis-n"></div>';

    $jsScripts .= '
function showModalTicket(id, forDelete) {
  NProgress.start();
  var values = {"ticket_id": id, "forDelete": forDelete};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/helpdesk/ajax/ajax_ticketadmin_open.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxTicketOpen").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}
function showModalDetails(uid) {
  NProgress.start();
  var values = {"uid":  uid};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/accounts/ajax/ajax_accountdetails_modalopen.php", type: "POST", data: values,
    success: function(data) {
      $("#DivModalBodyAccountDetails").empty().html(data);
      $("#ModalDetails").modal("show");
      NProgress.done();
    }
  });
}

function ticketSearch(page) {
  $("#BtSearch").btn("loading");
  $("#searchTicket").popover("hide");
  NProgress.start();
  var values = {"searchTicket":  $("#searchTicket").val(), "page": page, "status": $("#SelectStatus").val()};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/helpdesk/ajax/ajax_ticketadmin_search.php",
    type: "POST",
    data: values,
    success: function(data) {
      $("#AjaxHelpDesk").empty().html(data);
      NProgress.done();
    }
  });
}';

    $jsWindowLoaded .= '
$("[data-toggle=\'popover\']").popover();
setTimeout(function() {
  ticketSearch(0);
}, 500);';

    echo '
<div class="modal fade modal-mytheme" id="ModalTicketOpen" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 900px!important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-weixin fa-2x pr-4 align-middle"></i>'.lg('User support', 'Global').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivModalBodyTicketDetails"></div>
            <div class="modal-footer" id="DivModalFooterTicket"></div>
        </div>
    </div>
</div>
<div id="AjaxTicketOpen" class="dis-n"></div>

<div class="modal fade modal-mytheme" id="ModalDetails" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 900px!important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user-circle fa-2x pr-4 align-middle"></i>'.lg('Detailed account information').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivModalBodyAccountDetails"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">'.lg('Close', 'Global').'</button>
            </div>
        </div>
    </div>
</div>';
    
}

?>
