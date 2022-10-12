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

init_langVars(['Admin']);

if(!check_adminRights('redirections')) {
    echo '<script>location.reload();</script>';
    exit;
}


$sql = $dataBase->prepare('SELECT COUNT(id) AS num 
                           FROM pr__url_redirection
                           WHERE src LIKE :src');
$sql->execute(['src'  => $_POST['InputSrc']]);
$countRedirection = $sql->fetch();
$sql->closeCursor();

if($countRedirection['num'] != 0) {
    echo '
<script>
setTimeout(function() {
  $("#BtRedirectionAdd").btn("reset");
  $("#DivErrorRedirectionAdd").html("'.lg('There is already a 404 redirection for the source:').' <strong>'.$_POST['InputSrc'].'</strong>.").fadeTo("slow", 1);
}, 1500);
</script>';
    exit;
}

$sql = $dataBase->prepare('INSERT INTO pr__url_redirection(src,
                                                           dest)
                                                    values(:src,
                                                           :dest)');
$sql->execute(['src'  => $_POST['InputSrc'],
               'dest' => $_POST['InputDest']]);
$redirectionId = $dataBase->lastInsertId();
$sql->closeCursor();


echo '
<tr id="TrRedirection'.$redirectionId.'">
    <td class="fnt-0-85 text-center"><i class="popoverData fa fa-trash pointer text-danger" onclick="modalOpenDeleteRedirection('.$redirectionId.')" style="font-size:18px;" data-content="Delete this redirection" rel="popover" data-placement="bottom" data-trigger="hover" data-original-title="" title=""></i></td>
    <td class="fnt-0-85 text-break-all"><a href="'.$_POST['InputSrc'].'" target="_blank" class="text-dark">'.$_POST['InputSrc'].'</a></td>
    <td class="fnt-0-85 text-break-all"><a href="'.$_POST['InputDest'].'" target="_blank" class="text-dark">'.$_POST['InputDest'].'</a></td>
    <td class="text-center">0</td>
    <td><div class="text-center">-</div></td>
</tr>
<script>
setTimeout(function() {
  if(!$("#TBody404").length) {
    location.reload();
  } else {
    $("#TrRedirection'.$redirectionId.'").prependTo("#TBody404");
    $("#BtRedirectionAdd").btn("reset");
  }
}, 1500);

</script>';


?>
