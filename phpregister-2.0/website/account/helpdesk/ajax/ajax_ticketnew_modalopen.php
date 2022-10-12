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

$sql = $dataBase->prepare('SELECT count(*) AS number
                           FROM pr__ticket
                           WHERE status NOT LIKE "closed" AND user_id = :id');

$sql->execute(['id'  => get_userIdSession()]);
$countOpened = $sql->fetch();
$sql->closeCursor();

if($countOpened['number'] != 0) {

    echo '
<div class="text-center fnt-1-1">
<p>'.lg('You already have an open ticket').'</p>
<p><i class="fa fa-weixin text-mytheme fa-4x py-4"></i></p>
<p>'.lg('You can have only one opened ticket at once').'</p>
</div>';
    
} else {

    echo '
<form action="#" id="FormTicketNew"  method="post">
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text bg-light">'.lg('Subjet').'</span>
        </div>
        <input name="InputSubject" class="form-control input-grey rounded-right" required maxlength="100">
    </div>
</div>
<div class="form-group">
    <label for="exampleFormControlTextarea1">'.lg('Message').'</label>
    <textarea class="form-control input-grey rounded" name="TextareaMessage" rows="4"></textarea>
</div>
<button type="submit" id="BtTicketNew" class="btn btn-mytheme mt-2" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i> '.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button>
</form>

<script>
$(document).on("submit", "#FormTicketNew", function(e){
  $("#BtTicketNew").btn("loading");
  var values = $("form#FormTicketNew").serialize();
  $.ajax({
    url: "'.$config['URL'].'/account/helpdesk/ajax/ajax_ticketnew_insert.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxTicket").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
  e.preventDefault();
});
</script>';
    
}


?>
