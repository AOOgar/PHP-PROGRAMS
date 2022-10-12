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

$sql = $dataBase->prepare('UPDATE pr__ticket
                           SET
                               date_closed = :date,
                               status = :status

                           WHERE id = :ticket_id AND user_id = :user_id');

$sql->execute(['date'       => date("Y-m-d H:i:s"),
               'status'     => 'closed',
               'ticket_id'  => $_POST['id'],
               'user_id'    => get_userIdSession()]);
$sql->closeCursor();

echo '
<script>
setTimeout(function () {
  $("#ModalTicketOpen").modal("hide");
  setTimeout(function() {
    $("#DivTicket'.$_POST['id'].'").removeClass("border-success border-warning shadow").addClass("border-secondary");
    $("#DivStatus'.$_POST['id'].'").removeClass("text-success text-warning").addClass("text-secondary").html("'.lg('Resolved').'");
  }, 500);
}, 1000);
</script>';

?>
