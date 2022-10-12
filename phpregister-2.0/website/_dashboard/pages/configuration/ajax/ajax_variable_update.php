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

init_langVars(['Global']);

if(!check_adminRights('admin')) {
    echo '<script>location.reload();</script>';
    exit;
}

$sql = $dataBase->prepare('UPDATE pr__website_option
                           SET name         = :name,
                               value        = :value,
                               description  = :description                              
                           WHERE id = :id');
$sql->execute(['name'     => $_POST['InputVariableName'],
               'value'    => $_POST['InputVariableValue'],
               'description'  => $_POST['TextareaVariableDescription'],
               'id' => $_POST['InputId']]);
$sql->closeCursor();

echo '
<script>
setTimeout(function() {
  $("#ModalVariableModify").modal("hide");
}, 1000);
setTimeout(function() {
  showTab("variables");
}, 2000);
</script>';



?>
