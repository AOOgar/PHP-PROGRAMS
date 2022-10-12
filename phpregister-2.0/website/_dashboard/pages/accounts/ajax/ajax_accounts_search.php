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
include (_PATHROOT.'include/php/display_pagination.inc.php');
include ('../accountsadmin_display.inc.php');
include ('../accountsadmin_sql.inc.php');

init_langVars(['Admin', 'Global']);

if(!check_adminRights('accounts')) {
    echo '<script>location.reload();</script>';
    exit;
}

/**
 * When a PHP script uses sessions, PHP locks the session file until the script completes.
 * So we close the session not to block the server.
 */
session_write_close();

$sql = $dataBase->prepare('SELECT accounts_searchorder
                           FROM pr__user_adminprefs
                           WHERE user_id = :id');
$sql->execute(['id' => get_userIdSession()]);
$userPrefsOrder = $sql->fetch()['accounts_searchorder'];
$sql->closeCursor();
if($_POST['InputOrder'] != $userPrefsOrder) {    
    $sql = $dataBase->prepare('UPDATE pr__user_adminprefs 
                               SET accounts_searchorder = :accounts_searchorder
                               WHERE user_id = :user_id');
    $sql->execute(['accounts_searchorder' => $_POST['InputOrder'],
                   'user_id'              => get_userIdSession()]);
    $sql->closeCursor();

}

$searchAccounts = sql_searchAccounts($dataBase, $_POST['page'], $_POST['InputOrder']);

echo show_accountsTable($searchAccounts);

echo '
<div id="DivPagination" class="row" style="margin-top:7px;">
    <div class="col-sm-8">';

/**
 * Function from admin_display.inc.php
 */
show_pagination2Pages($searchCount['number'], $config['AdminAccountsPerPage'], 'searchLaunch');

echo '
    </div>
    <div class="col-sm-4 text-right">';
$end_time = microtime(TRUE);
$time_taken = $end_time - $config['StartTime'];
$time_taken = round($time_taken,5);
if($_POST['search'] != '') {
    echo  '
        <div class="d-inline-block rounded bg-white">
            <div class="fnt-0-9 p-2">
                '.lg('Search result').': <strong>'.number_format($searchCount['number'], 0, '.', ' ').'</strong><br>
                Search generated in '.round($time_taken, 2).' seconds
            </div>
        </div>';
}
echo '
    </div>
</div> 

<script>
emails = [];
names = [];';
foreach($searchAccounts as $oneAccount) {
    echo '
emails['.$oneAccount['id'].'] = "'.$oneAccount['email'].'";
names['.$oneAccount['id'].'] = "'.htmlentities($oneAccount['firstname']).' '.htmlentities($oneAccount['lastname']).'";';
}
echo '
scrollToElem($("#SideNavContent"));
</script>'; 

?>
