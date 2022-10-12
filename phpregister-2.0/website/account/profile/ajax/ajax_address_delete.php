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
include_once (_PATHROOT.'account/profile/profile_sql.inc.php');
include_once (_PATHROOT.'account/profile/profile_display.inc.php');

init_langVars(['Profile']);

$sql = $dataBase->prepare('DELETE FROM pr__address 
                           WHERE id = :id AND user_id = :user_id');
$sql->execute(['id'      => $_POST['id'],
               'user_id' => get_userIdSession()]);
$sql->closeCursor();

$countryLangShow = get_countryLanguage();

$userAddresses = sql_getUserAdresses($countryLangShow);

echo '
<div id="DivAjaxAddresses">
  '.html_profileAdresses().'
</div>
<script>
$(".popoverData").popover();
setTimeout(function() {
  $("#DivAddresses").empty().css({"opacity":0});;
  $("#DivAddresses").html($("#DivAjaxAddresses").html());
  $("#ModalAddress").modal("hide");
  $("#BtAddressDelete").btn("reset");
  setTimeout(function() {
    $("#DivAddresses").fadeTo("fast", 1);
    scrollToElemMiddle($("#DivAddresses"));
  }, 700);
}, 1000);
</script>';












?>
