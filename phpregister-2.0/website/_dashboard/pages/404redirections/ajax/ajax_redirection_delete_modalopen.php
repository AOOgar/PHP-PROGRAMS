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

init_langVars(['Admin', 'Global']);

if(!check_adminRights('redirections')) {
    echo '<script>location.reload();</script>';
    exit;
}

$sql = $dataBase->prepare('SELECT * 
                           FROM pr__url_redirection
                           WHERE id = :id');
$sql->execute(['id' => $_POST['id']]);
$redirection = $sql->fetch();
$sql->closeCursor();

if(!isset($redirection['date_lastclick'])) {
    $dateLastClick = ' -';
} else {
    $dateLastClick = get_dateFormatLang($redirection['date_lastclick'], TRUE);
}

echo '
<div class="p-2 p-lg-4 fnt-95">
    <p class="fnt-1-2">'.lg('Please confirm the deletion of this redirection').'</p>

    <table class="table">
        <tbody>
        <tr>
            <td class="font-weight-bold" style="width:240px;">'.lg('Source').'</td>
            <td><a href="'.$redirection['src'].'" target="_blank" class="text-dark">'.$redirection['src'].'</a></td>
        </tr>
        <tr>
            <td class="font-weight-bold">'.lg('Destination').'</td>
            <td><a href="'.$redirection['dest'].'" target="_blank" class="text-dark">'.$redirection['dest'].'</a></td>
        </tr>
        <tr>
            <td class="font-weight-bold">'.lg('Number of redirections').'</td>
            <td>'.$redirection['count_redirect'].'</td>
        </tr>
        <tr>
            <td class="font-weight-bold">'.lg('Last click date').'</td>
            <td>'.$dateLastClick.'</td>
        </tr>
        </tbody>
    </table>
    <div class="text-center pt-4">
        <button id="BtRedirectionDelete'.$redirection['id'].'" class="btn btn-outline-danger" onClick="deleteRedirection('.$redirection['id'].');" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Confirm deletion').'</button>  
    </div>
</div>';



?>
