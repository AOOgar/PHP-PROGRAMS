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

if(!check_adminRights('admin')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

$sqlUsersAdmin = $dataBase->prepare('SELECT DISTINCT pr__user.*,
                                                     pr__user_oauth.facebook_id, pr__user_oauth.google_id
                                     FROM pr__user
                                     LEFT JOIN pr__user_adminright ON pr__user.id = pr__user_adminright.user_id
                                     LEFT JOIN pr__user_oauth ON pr__user.id = pr__user_oauth.user_id
                                     WHERE pr__user_adminright.id IS NOT NULL
                                     ORDER BY date_accountcreated');
$sqlUsersAdmin->execute();
$usersAdmin = $sqlUsersAdmin->fetchAll();
$sqlUsersAdmin->closeCursor();

$usersRights = [];
foreach($usersAdmin as $oneAdmin) {

    $usersRights[$oneAdmin['id']] = get_userAdminRights($oneAdmin['id']);
}

echo '
<div id="DivAccountsPrefs" class="mx-auto bg-white pb-4" style="max-width:1100px;">

    <div class="mt-5 bg-light container">
        <div class="row">
            <div class="col-2"><i class="fa fa-gears fa-3x p-3"></i></div>
            <div class="col-10 p-3 fnt-1-4 text-right">'.lg('Preferences').'</div>
        </div>
    </div>
    <div class="mx-auto my-4" style="max-width:1050px;">
        <p class="pb-3 text-center"><big>'.lg('Accounts with Admin rights').'</big></p>
        <table id="TableAccountsAdmin" class="table table-striped table-bordered dt-responsive">
            <thead style="background-color:white;">
                <tr>
                    <th>'.lg('Rights').'</th>
                    <th>'.lg('Firstname', 'Global').'</th>
                    <th>'.lg('Lastname', 'Global').'</th>
                    <th>'.lg('Email', 'Global').'</th>
                    <th>'.lg('Creation date').'</th>
                    <th data-priority="1"></th>
                </tr>
             </thead>
             <tbody>';

$evenBgcolor = "background-color:white;";
$oddBgcolor = "background-color:#f8f8f8;";
$i = 0;
foreach($usersAdmin as $oneAccount) {
    $social = '';
    $separator = '';
    
    if ($i % 2 == 1) {
        $bgcolor = $oddBgcolor;
    } else {
        $bgcolor = $evenBgcolor;
    }
    echo '
           <tr id="TrUserRights'.$oneAccount['id'].'" style="'.$bgcolor.'">
               <td class="align-middle" style="height:20px;padding:7px 4px;">';
    $i = 1;
    foreach($usersRights[$oneAccount['id']] as $oneRight) {
        echo $oneRight;
        if(count($usersRights[$oneAccount['id']]) != $i) {
            echo ', ';
        }
        $i++;
    }
    echo '

               </td>
               <td class="align-middle" style="height:20px;padding:7px 4px;">'.$oneAccount['firstname'].'</td>
               <td class="align-middle" style="height:20px;padding:7px 4px;">'.$oneAccount['lastname'].'</td>
               <td class="align-middle" style="height:20px;padding:7px 4px;">'.$oneAccount['email'].'</td>
               <td class="align-middle" style="height:20px;padding:7px 4px;" nowrap>'.date("d-m-Y", strtotime($oneAccount['date_accountcreated'])).'</td>
               <td style="height:20px;padding:7px 4px;">
<div class="btn-group">
    <button type="button" class="btn btn-info btn-sm rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sort-desc"></i></button>
    <div class="dropdown-menu dropdown-menu-right fnt-1-0">
        <a class="dropdown-item" href="#/" style="color:#337ab7" onClick="showModalDetails('.$oneAccount['id'].')"><i class="fa fa-user-plus pr-3" style="font-size:24px;"></i>'.lg('Detailed information').'</a>
        <div class="dropdown-divider"></div>';
        if(check_adminRights('accounts-delete')) {
            echo '
        <a class="dropdown-item" href="#/" style="color:red;" onClick="showModalDetails('.$oneAccount['id'].', \'delete\')"><i class="fa fa-remove pr-3" style="font-size:24px;"></i>'.lg('Delete account').'</a>
        <div class="dropdown-divider"></div>';
        }
        if(check_adminRights('admin')) {
            echo '
        <a class="dropdown-item" href="#/" onClick="showModalDetails('.$oneAccount['id'].', \'rights\')"><i class="fa fa-connectdevelop  pr-3" style="font-size:24px;"></i>'.lg('Edit Admin Rights').'</a>';
        }
        echo '
    </div>
</div>
               </td>
           </tr>';
    
    $i++;
}
echo '
             </tbody>
         </table>';
if(check_adminRights('admin')) {

    echo '
<hr class="my-4">
    <form action="#" id="FormPasswordLogAs"  method="post">    
    <div class="form-group">
        <div class="input-group" style="max-width:550px;">
            <div class="input-group-prepend">
                <span class="input-group-text">'.lg('Password "Login as"').'</span>
            </div>
            <input name="InputLogAsPassword" id="InputLogAsPassword" class="form-control input-grey" minlength="4" type="password" required>
            <div class="input-group-append">
                <button class="btn btn-info" id="BtPasswordLogAs" style="width:110px;" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg\'></i>">'.lg('Modify', 'Global').'</button>
            </div>
        </div>
    </div>
    <div id="AjaxLogAsPassword" class="dis-n"></div>
    </form>

<script>
$("#FormPasswordLogAs").on("submit", function (e) {
  e.preventDefault();
  $("#BtPasswordLogAs").btn("loading");
  var values = {"InputLogAsPassword": $("#InputLogAsPassword").val()};
  $("#DivErrorEmail").html("");
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/accounts/ajax/ajax_loginas_passwordupdate.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxLogAsPassword").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});
</script>';
    
}
    echo '
    </div>
</div>

<script>
$("#DivAccountsPage").removeClass("dis-n").addClass("dis-n");
$("#AjaxAccounts").attr("style", "opacity:0;");
$("#AjaxAccounts").removeClass("dis-n");
$("#TableAccountsAdmin").DataTable( {
    "bInfo" : false,
    "paging": false,
    "ordering": false,
    "searching": false
});

setTimeout(function () {$("#AjaxAccounts").fadeTo("fast", 1);NProgress.done();}, 500);
</script>';

?>
