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

set_time_limit(0); // No execution time limit
ini_set('memory_limit', '1024M'); // Increasing the memory limit to avoid  Fatal error:  Allowed memory size of XXX bytes exhausted

/** Security check to prevent direct access to this ajax file */
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') { exit; }

define('_PATHROOT', '../../../../../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');

if(!check_adminRights('admin')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

/**
 * When a PHP script uses sessions, PHP locks the session file until the script completes.
 * So we close the session not to block the server.
 */
session_write_close();

$sql = $dataBase->prepare('SELECT id, picture 
                           FROM pr__user 
                           WHERE agent LIKE "random-account"');
$sql->execute();
$randAccounts = $sql->fetchAll();
$sql->closeCursor();

foreach($randAccounts as $oneAccount) {
    
    del_userProfileImg($oneAccount['picture']);
    $sql = $dataBase->prepare('DELETE FROM pr__user WHERE id = :id');
    $sql->execute(['id' => $oneAccount['id']]);
    $sql->closeCursor();

}

?>
