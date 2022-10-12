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
include_once ('../homeadmin_display.inc.php');
include_once ('../homeadmin_sql.inc.php');
include_once ('../homeadmin_global.inc.php');

init_langVars(['Admin', 'Global']);

if(!check_adminRights()) {
    echo 'location.reload();';
    exit;
}

/**
 * When a PHP script uses sessions, PHP locks the session file until the script completes.
 * So we close the session not to block the server.
 */
session_write_close();

$sql = $dataBase->prepare('SELECT id
                           FROM pr__user_adminprefs
                           WHERE user_id = :id');

$sql->execute(['id' => get_userIdSession()]);
$userPrefs = $sql->fetch();
$sql->closeCursor();

$prefsPeriod = '';

$startDate = NULL;
$endDate = NULL;

if(isset($_POST['period']) &&
   $_POST['period']  == 'currentmonth') {
    $startDate = date('Y-m').'-01';
    $endDate = date('Y-m-d');
    $btPeriodContent = lg('Current month');
    $prefsPeriod = 'CurrentMonth';
    
} else if(isset($_POST['period'])) {
    if($_POST['period'] == '15lastdays') {

        $startDate = date('Y-m-d', strtotime('-15 days', strtotime(date('Y-m-d'))));
        $endDate = date('Y-m-d');
        $btPeriodContent = '15 last days';
        $prefsPeriod = '15LastDays';
    
    } else if($_POST['period']== "oneyear") {
        if( $_POST['year'] == date('Y') ) {
            $startDate = $_POST['year'].'-01-01';
            $endDate = date('Y-m-d');
        } else {
            $startDate = $_POST['year'].'-01-01';
            $endDate = $_POST['year'].'-12-31';
        }
        $btPeriodContent = lg('Year').': '.$_POST['year'];
        $prefsPeriod = $_POST['year'];
        
    } else if($_POST['period'] == "custom") {
        $startDate = $_POST['start'];
        $endDate = $_POST['end'];
        $btPeriodContent = lg('From').' '.$startDate.' '.lg('to').' '.$endDate;
        $prefsPeriod = $startDate.','.$endDate;
    }
}

if(isset($userPrefs['id'])) {
    $sql = $dataBase->prepare('UPDATE pr__user_adminprefs
                               SET
                                   adminhome_periodfilled = :period

                               WHERE id = :id');
    
    $sql->execute(array('period'  => $prefsPeriod,
                        'id'      => $userPrefs['id']));

}

$datesDisplay = get_datesRange($startDate, $endDate);
$allAccounts = sql_getRange_allAccounts($startDate, $endDate);
$socialNetworks = sql_getRange_socialNetworksAccounts($startDate, $endDate);

echo '
<script>
setTimeout(function() {
NProgress.done();';
    echo '
$("#BtPeriod").html("<i class=\'fa fa-area-chart\'></i><span class=\'p-4\'>'.$btPeriodContent.'</span><span class=\'caret\'></span>");
allAccounts = null;
allAccounts = [ ';

    /**
     * Function available in adminhome_display.inc.php
     */
    echo get_valuesChart_allAccounts($datesDisplay, $allAccounts);
    echo '
 ];
chartAllAccountsRefresh();';


    echo '
socialNetworks = null;
socialNetworks = [ ';

    /**
     * Function available in adminhome_display.inc.php
     */
    echo get_valuesChart_socialNetwords($datesDisplay, $socialNetworks);

    echo '
 ];
chartSocialMediaRefresh();

}, 500);
</script>';

?>
