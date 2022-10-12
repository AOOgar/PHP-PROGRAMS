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

init_langVars(['Helpdesk', 'Global']);

if(!check_adminRights('helpdesk')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

if($_POST['markas'] == 'read') {
    
    $sql = $dataBase->prepare('UPDATE pr__ticket
                               SET
                                   status = :status
                               WHERE id = :id');
    $sql->execute(['status'  => 'read',
                   'id'      => $_POST['id']]);

    ajax_ticketRead();
} else if($_POST['markas'] == 'closed') {

    $sql = $dataBase->prepare('UPDATE pr__ticket
                               SET
                                   date_closed = :date,
                                   status = :status
                               WHERE id = :id');
    $sql->execute(['date'       => date("Y-m-d H:i:s"),
                   'status'  => 'closed',
                   'id'      => $_POST['id']]);
    ajax_ticketClosed();

} else if($_POST['markas'] == 'reopen') {

    $sql = $dataBase->prepare('UPDATE pr__ticket
                               SET
                                   date_closed = :date,
                                   status = :status
                               WHERE id = :id');
    $sql->execute(['date'    =>  NULL,
                   'status'  => 'read',
                   'id'      => $_POST['id']]);
    ajax_ticketReopen();
    
}

function ajax_ticketRead() {
    echo '
<script>
setTimeout(function () {
  $("#BtTicketMarkRead").addClass("dis-n");
  $("#DivTicketStatus'.$_POST['id'].'").removeClass("text-success").addClass("text-warning").html("'.lg('In progress').'");
  $("#DivTicket'.$_POST['id'].'").removeClass("border-success").addClass("border-warning");
  $("#SpanTicketOpenStatus").html("'.lg('In progress').'").removeClass("text-success").addClass("text-warning");
}, 1000);
</script>';

}

function ajax_ticketClosed() {
    echo '
<script>
setTimeout(function () {
  $("#BtTicketMarkRead").addClass("dis-n");
  $("#DivTicketStatus'.$_POST['id'].'").removeClass("text-success text-warning").addClass("text-secondary").html("'.lg('Resolved').'");
  $("#DivTicket'.$_POST['id'].'").removeClass("border-success border-warning shadow").addClass("border-secondary");
  $("#ModalTicketOpen").modal("hide");
}, 1000);
</script>';
}

function ajax_ticketReopen() {
    global $config;

    echo '
<script>
setTimeout(function () {
  $("#DivTicketStatus'.$_POST['id'].'").removeClass("text-success").addClass("text-warning").html("'.lg('In progress').'");
  $("#DivTicket'.$_POST['id'].'").removeClass("border-success").addClass("border-warning shadow");
  var values = {"ticket_id": '.$_POST['id'].', "forDelete": 0};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/helpdesk/ajax/ajax_ticketadmin_open.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxTicketOpen").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}, 1000);
</script>';
}

?>
