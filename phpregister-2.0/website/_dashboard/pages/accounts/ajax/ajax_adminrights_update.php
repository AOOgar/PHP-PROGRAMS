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

if(!check_adminRights('admin')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

if($_POST['rights'] == 'specific') {
    /**
     *  Specific Rights
     */
    if(!isset($_POST['specificrights'][0])) {
        /**
         *  No Specific Rights Selected !
         */
        echo '
<script>
$("#DivRightsError").html("");
setTimeout(function() {
  $("#DivRightsError").attr("style", "color:red;height:10px;opacity:0;text-align:right;");
  $("#DivRightsError").html("'.lg('Select at least one specific right.').'");
  $("#BtRightsUpdate").btn("reset");
  $("#DivRightsError").fadeTo("slow", 1);
  NProgress.done();
}, 1000);
</script>';
        
    } else {
        
        ajax_sqlDeleteUserRights();
        
        $newAdminRights = '';
        foreach($_POST['specificrights'] as $oneRight) {
            $newAdminRights .= '"'.$oneRight.'", ';
        }
        $newAdminRights = rtrim($newAdminRights, ', ');
        $sql = $dataBase->prepare('SELECT id FROM pr__adminright WHERE name IN('.$newAdminRights.')');
        $sql->execute();
        $adminRights = $sql->fetchAll();
        $sql->closeCursor();

        $sqlValues = 'VALUES';
        foreach($adminRights as $oneRight) {
            $sqlValues .= '('.$_POST['uid'].', '.$oneRight['id'].'),';
        }
        $sqlValues = rtrim($sqlValues, ',');        

        $sql = $dataBase->prepare('INSERT into pr__user_adminright(user_id, adminright_id)
                                   '.$sqlValues);
        $sql->execute();
        $sql->closeCursor();

        $newAdminRights = array_filter(explode(', ', str_replace("\"", '', $newAdminRights)));
        
        sql_insertAdminPrefs($_POST['uid']);
        ajax_showUserRights();

    }
    
} else if($_POST['rights'] == 'admin') {

    ajax_sqlDeleteUserRights();

    $sql = $dataBase->prepare('INSERT into pr__user_adminright(user_id, adminright_id) VALUES('.$_POST['uid'].', 1)');
    $sql->execute();
    $sql->closeCursor();
    $newAdminRights = ['admin'];
    sql_insertAdminPrefs($_POST['uid']);
    ajax_showUserRights();

} else if($_POST['rights'] == 'norights') {

    ajax_sqlDeleteUserRights();
    
    ajax_showUserRights();

}

function sql_insertAdminPrefs($userId) {
    global $dataBase;

    $sql = $dataBase->prepare('SELECT count(*) AS num
                               FROM pr__user_adminprefs
                               WHERE user_id = :id');
    $sql->execute(['id' => $userId]);
    $userAdminprefs = $sql->fetch()['num'];
    $sql->closeCursor();
    if($userAdminprefs == 0) {
        $sql = $dataBase->prepare('INSERT INTO pr__user_adminprefs(user_id) 
                                                            VALUES(:user_id)');
        $sql->execute(['user_id' => $userId]);
        $sql->closeCursor();
    }
}

function ajax_showUserRights() {
    global $newAdminRights;

    echo '
<div id="DivRightsNew" class="fnt-1-1 fnt-rob">
    <div id="DivContent" class="opa-0">
            <span class="fnt-1-1 mr-2">'.lg('New Admin rights:').'</span>';
    if(is_array($newAdminRights)) {
        asort($newAdminRights);
        if(in_array('admin', $newAdminRights)) {
            echo '<span class="bg-danger text-light font-weight-bold rounded px-2 py-1">admin</span>';
        } else {
            echo '<div class="mt-2">';
            $i = 0;
            foreach($newAdminRights as $oneRight) {
                echo ' <div class="d-inline ml-3 mb-2 bg-secondary text-light font-weight-bold rounded px-2 py-1">'.$oneRight.'</div>';
                $i++;
            }
            echo '</div>';
        }
    } else {
        echo '
            <span class="ml-3" style="border-bottom: 3px solid #757575;color:#515151;"><strong>'.lg('No rights').'</strong></span>';
    }
    echo '
    </div>
</div>
<script>
setTimeout(function() {
  $("#DivRightsActual").html($("#DivRightsNew").html());
  $("#DivRightsError").html("");
  $("#DivSelectsRights").addClass("dis-n");
  $("#BtRightsUpdate").attr("style", "opacity:0;");
  setTimeout(function() {$("#DivContent").fadeTo("slow", 1);}, 1000);
  NProgress.done();
}, 1000);
</script>';

    if(!is_array($newAdminRights)) {
        /**
         *  Hide User from Prefs page
         */

        echo '
<script>
if(prefsOpened == true) {
  setTimeout(function() {
    $("#TrUserRights'.$_POST['uid'].'").html("<td colspan=\'7\'>&nbsp;</td>");
  }, 1000);
}
</script>';
        
    }
}

function ajax_sqlDeleteUserRights() {
    global $dataBase;

    $sql = $dataBase->prepare('DELETE FROM pr__user_adminright
                               WHERE user_id = :user_id');
    $sql->execute(['user_id' => $_POST['uid']]);
    $sql->closeCursor();
    
}

?>
