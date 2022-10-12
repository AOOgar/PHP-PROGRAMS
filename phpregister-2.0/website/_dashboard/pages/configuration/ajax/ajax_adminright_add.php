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
require_once ('../configuration_display.inc.php');
require_once ('../configuration_sql.inc.php');

init_langVars(['Admin', 'Global']);

if(!check_adminRights('admin')) {
    echo '<script>location.reload();</script>';
    exit;
}

$sql = $dataBase->prepare('SELECT COUNT(id) AS num 
                           FROM pr__adminright
                           WHERE name LIKE :name');
$sql->execute(['name'  => $_POST['InputName']]);
$countAdminright = $sql->fetch();
$sql->closeCursor();

if($countAdminright['num'] != 0) {

    echo '
<script>
setTimeout(function() {
  $("#BtAdminrightAdd").btn("reset");
  $("#DivErrorAdminrightAdd").html("'.lg('There is already an adminright with the name').' \"<strong>'.$_POST['InputName'].'</strong>\".").fadeTo("slow", 1);
}, 1500);
</script>';
    exit;
}

$sql = $dataBase->prepare('INSERT INTO pr__adminright(name,
                                                      description)
                                               values(:name,
                                                      :description)');
$sql->execute(['name'         => $_POST['InputName'],
               'description'  => $_POST['TextareaDescription']]);
$sql->closeCursor();

echo '
<script>
setTimeout(function() {
  showTab("adminrights");
}, 1500);
</script>';

?>
