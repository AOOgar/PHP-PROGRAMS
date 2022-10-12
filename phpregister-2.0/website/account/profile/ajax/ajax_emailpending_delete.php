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
include_once (_PATHROOT.'account/profile/profile_display.inc.php');

init_langVars(['Profile', 'Global']);

if(!isset($_SESSION['UserId'])) {
    echo '
<script>
window.location.href = "'.get_URL().'/account";
</script>';
    exit;
}

/**
 *  Deleting the pending email
 */

$sql = $dataBase->prepare('UPDATE pr__user
                           SET
                               newemail = :new_email,
                               newemail_changekey = :changekey,
                               newemail_changedate = :date
                            WHERE id = :id ');

$sql->execute(['new_email' => NULL,
               'changekey' => NULL,
               'date'      => NULL,
               'id'        => get_userIdSession()]);
$sql->closeCursor();

$userInfos = NULL;

echo '
<div id="DivAjaxEmail">
  '.html_profileEmail().'
</div>
<script>
setTimeout(function() {
  $("#DivEmail").fadeTo("fast", 0, function() {
    $("#DivEmail").html($("#DivAjaxEmail").html());
  });
  setTimeout(function() {
    $("#DivEmail").fadeTo("fast", 1);
  }, 700);
}, 1000);
</script>';







?>
