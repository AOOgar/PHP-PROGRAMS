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

if(!check_adminRights('helpdesk')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

$sql = $dataBase->prepare('SELECT helpdesk_replyas, helpdesk_signaturetext
                           FROM pr__user_adminprefs
                           WHERE user_id = :id');

$sql->execute(['id' => get_userIdSession()]);
$userPrefs = $sql->fetch();
$sql->closeCursor();

$sql = $dataBase->prepare('SELECT firstname, lastname
                           FROM pr__user
                           WHERE id = :id');

$sql->execute(['id' => get_userIdSession()]);
$userAdmin = $sql->fetch();
$sql->closeCursor();

if($userPrefs['helpdesk_replyas'] == NULL) {
    $replyAs = $userAdmin['firstname'].' '.$userAdmin['lastname'];
} else {
    $replyAs = $userPrefs['helpdesk_replyas'];
}

echo '
<div id="DivHelpDeskPrefs" class="mx-auto" style="max-width:800px;">
    <div class="mt-5 bg-light container">
        <div class="row">
            <div class="col-2"><i class="fa fa-gears fa-3x p-3"></i></div>
            <div class="col-10 p-3 fnt-1-4 text-right">'.lg('Preferences').'</div>
        </div>
    </div>
    <div class="mx-auto p-2 p-sm-4 bg-white border">
        <form method="post" id="FormHelpDeskPrefs" name="FormHelpDeskPrefs" action="" onSubmit="return false;" >
        <p class="pb-2 text-center fnt-1-2">'.lg('Pre-filling of ticket replies').'</p>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                   <span class="input-group-text bg-light" >'.lg('Reply as').'</span>
                </div>
                <input value="'.$replyAs.'" name="InputReplyName" id="InputReplyName" class="form-control input-grey rounded-right">
            </div>
        </div>
        <p class="pt-3 fnt-1-2">'.lg('Your signature').':</p>
        <textarea name="TextareaSignatureText" id="TextareaSignatureText" placeholder="Thank you very much, \nBest regards,\n'.$userAdmin['firstname'].' '.substr($userAdmin['lastname'], 0, 1).'.\n'.$config['WebsiteName'].' Support" class="form-control input-grey rounded" rows="4" style="resize:vertical;">'.$userPrefs['helpdesk_signaturetext'].'</textarea>
        <div class="text-center pt-5">
            <button type="submit" id="BtHelpDeskPrefs" onClick="modifyHelpDeskPrefs();" class="btn btn-info" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Save', 'Global').'</button>
         </div>
         </form>
    </div>
</div>

<script>
$("#TextareaSignatureText").placeholder();
$("#DivHelpDeskPage").removeClass("dis-n").addClass("dis-n");
$("#AjaxHelpDeskPage").attr("style", "opacity:0;");
$("#AjaxHelpDeskPage").removeClass("dis-n");
setTimeout(function () {$("#AjaxHelpDeskPage").fadeTo("fast", 1);NProgress.done();}, 500);


function modifyHelpDeskPrefs() {
  NProgress.start();
  $("#BtHelpDeskPrefs").btn("loading");
  if($("#TextareaSignatureText").val() == "Thank you very much, \nBest regards,\n'.$userAdmin['firstname'].' '.substr($userAdmin['lastname'], 0, 1).'.\n'.$config['WebsiteName'].' Support") {
      $("#TextareaSignatureText").val("");
  }
  var values = $("#FormHelpDeskPrefs").serialize();
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/helpdesk/ajax/ajax_helpdesk_prefs_update.php", type: "POST", data: values,
    success: function(data) {
     setTimeout(function() {
       $("#DivHelpDeskPage").attr("style", "opacity:0;");
       $("#DivHelpDeskPage").removeClass("dis-n");
       $("#AjaxHelpDeskPage").removeClass("dis-n").addClass("dis-n");
       setTimeout(function () {$("#DivHelpDeskPage").fadeTo("fast", 1);}, 1000);
       NProgress.done();
     }, 2000);
     prefsOpened = false;
    }
  });
}

</script>';


?>
