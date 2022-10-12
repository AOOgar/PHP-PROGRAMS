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
require_once (_PATHROOT.'include/php/global_images.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');
require_once (_PATHROOT.'include/php/emails/global_email.inc.php');

init_langVars(['Profile', 'Global']);

if(!isset($_SESSION['UserId'])) {
    echo '
<script>
  location.reload();
</script>';
    exit;
}

$srcollToElement = FALSE;
$jsAjaxScriptError = '';

if($_POST['InputFirstname'] != '') {
    if( ($_POST['InputFirstname'] != $sessionUser['firstname'])) {
        $sql = $dataBase->prepare('UPDATE pr__user
                                   SET firstname = :firstname
                                    WHERE id = :id');
        $sql->execute(['firstname' => $_POST['InputFirstname'],
                       'id'        => get_userIdSession()]);
        $sql->closeCursor();
    }
} else {
    if(!$srcollToElement) $srcollToElement = 'InputFirstname';
    $jsAjaxScriptError .= '
$("#DivErrorFirstname").blink(2);';
}

if($_POST['InputLastname'] != '') {
    if(($_POST['InputLastname'] != $sessionUser['lastname'])) {
        $sql = $dataBase->prepare('UPDATE pr__user
                                   SET lastname = :lastname
                                   WHERE id = :id');
        $sql->execute(['lastname'  => $_POST['InputLastname'],
                       'id'        => get_userIdSession()]);
        $sql->closeCursor();
    }
} else {
    if(!$srcollToElement) $srcollToElement = 'InputLastname';
    $jsAjaxScriptError .= '
$("#DivErrorLastname").blink(2);';
}


echo '
<script>
setTimeout(function() {
  '.$jsAjaxScriptError;
if($srcollToElement != '') {
    echo '
scrollToElemMiddle($("#'.$srcollToElement.'"), 40, 40)';
}
echo '
  $("#BtName").btn("reset");
}, 1500);
</script>';












?>
