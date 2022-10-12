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
include_once ('../helpdesk_display.inc.php');

init_langVars(['Helpdesk', 'Global']);

if(!isset($_SESSION['UserId'])) {
    echo '
<script>
window.location.href = "'.get_URL().'/account";
</script>';
    exit;
}


$sql = $dataBase->prepare('SELECT count(*) AS number
                           FROM pr__ticket
                           WHERE status NOT LIKE "closed" AND user_id = :id');

$sql->execute(array('id'  => get_userIdSession()));
$countOpened = $sql->fetch();
$sql->closeCursor();

if($countOpened['number'] != 0) {
    exit;
}

while(1) {
    /**
     * Getting beautifull Tickets Ids randomly betweem 10000 and 99999
     */
    $newId = mt_rand(100000, 999999);
    $sql = $dataBase->prepare('SELECT count(id) AS num FROM pr__ticket WHERE id = :id');
    $sql->execute(['id'  => $newId]);
    $idExist = $sql->fetch()['num'];
    $sql->closeCursor();
    if($idExist == 0) { 
        break; 
    }
}

$sql = $dataBase->prepare('INSERT INTO pr__ticket(id,
                                                  user_id,
                                                  date,
                                                  subject,
                                                  message)
                           VALUES(:id,
                                  :user_id,
                                  :date,
                                  :subject,
                                  :message)');

$sql->execute(['id'       => $newId,
               'user_id'  => get_userIdSession(),
               'date'     => date("Y-m-d H:i:s"),
               'subject'  => $_POST['InputSubject'],
               'message'  => $_POST['TextareaMessage']]);
$insertedId = $dataBase->lastInsertId();
$sql->closeCursor();

/**
 *  Prevent Admin contact by email when a new
 *  Helpdesk ticket is open
*/
if($config['HelpdeskEmail'] === TRUE) {

    $sql = $dataBase->prepare('SELECT email, firstname, lastname
                               FROM pr__user
                               WHERE id = :id');

    $sql->execute(['id' => get_userIdSession()]);
    $user = $sql->fetch();
    $sql->closeCursor();
    
    $configEmail['To'] = $config['HelpdeskEmailContact'];
    $configEmail['ToName'] = $config['HelpdeskEmailContactName'];
    $configEmail['Subject'] = 'Helpdesk New Ticket '.$config['WebsiteName'];
    $configEmail['Title'] = 'New Ticket from '.$user['firstname'].' '.$user['lastname'].' ID: '.get_userIdSession().'';

    $message = htmlentities($_POST['TextareaMessage']);
    $message = str_replace('  ', '&nbsp;&nbsp;', $message); // Not to loose indent style if the message contains some code
    
    $emailBox = 'Message :<br> '.nl2br($message);
    $configEmail['box'][0]['Type'] = 'text';
    $configEmail['box'][0]['Content'] = $emailBox;

    $configEmail['Template'] = 'email_templateBase';
    email_send();

}

$ticket = ['subject' => $_POST['InputSubject'],
           'date'    => date("Y-m-d H:i:s"),
           'id'      => $insertedId,
           'status'  => 'opened'];
echo '
<div id="DivAjaxTicketInserted" class="opa-0">';
 echo html_oneTicket($ticket);
 echo '
</div>
<script>
setTimeout(function() { 
  $("#BtTicketNew").btn("reset"); 
  $("#ModalTicketNew").modal("hide");
}, 500);
setTimeout(function() {
  $("#DivTicketEmpty").addClass("dis-n");
  $("#DivAjaxTicketInserted").prependTo($("#DivTickets"));
  $("#DivAjaxTicketInserted").fadeTo("slow", 1);
  $("#DivAjaxTicketInserted").removeAttr("id");
}, 1000);
</script>';

?>
