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
    echo '<script>location.reload();</script>';
    exit;
}

$sql = $dataBase->prepare('SELECT * 
                           FROM pr__adminright
                           WHERE id = :id');
$sql->execute(['id' => $_POST['id']]);
$adminright = $sql->fetch();
$sql->closeCursor();

echo '
<div class="p-2 p-lg-4 fnt-1-1">
    <p class="fnt-1-2">'.lg('Please confirm that you want to delete this Admin right. Any deletion is final and...').'</p>
    <table class="table">
        <tbody>
        <tr>
            <td class="font-weight-bold" style="width:140px;">'.lg('Name').'</td>
            <td>'.$adminright['name'].'</td>
        </tr>
        <tr>
            <td class="font-weight-bold">'.lg('Description').'</td>
            <td>'.nl2br(issetor($adminright['description'], '-')).'</td>
        </tr>
        </tbody>
    </table>
    <div class="mt-5 mb-5">
        <div class="d-inline-block ml-3 mr-4"><b>'.lg('Delete this Admin right').'</b></div>
        <div class="d-inline-block mr-4">'.lg('Check to confirm').': <input id="InputRadioDeleteAdminright'.$adminright['id'].'" class="ml-2" type="radio"></div>
        <button id="BtAdminrightDelete'.$adminright['id'].'" class="btn btn-outline-danger" onClick="deleteAdminright('.$adminright['id'].');" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Confirm deletion').'</button>  
    </div>
    <hr>';
$unixCommand = 'grep -rn "check_adminRights(\''.$adminright['name'].'\')"';
echo '
    <div style="position: absolute;top:-10000px;"><textarea id="TextareaGetCopy">'.$unixCommand.'</textarea></div>
    <p class="pt-3">'.lg('Unix command to search where this Admin right is checked in the code').' '.lg('(in single quotation marks)').' :</p>
    <p><span id="SpanGetCopy" class="border px-2 py-1">'.$unixCommand.'</span> <span><i id="FaCopy" class="fa fa-copy fnt-1-2 pointer ml-2 popoverData" data-content="'.lg('Copy this Unix command to clipboard').'" rel="popover" data-placement="bottom" data-trigger="hover" onClick="getCopy();"></i></span></p>
</div>
<script>
$(".popoverData").popover({html: true});
$("#BtAdminrightDelete'.$adminright['id'].'").on("click", function() {
  if(!$("#InputRadioDeleteAdminright'.$adminright['id'].'").is(":checked")) {  
    alert("'.lg('Please tick the box to confirm the deletion of this Admin right', NULL, FALSE).'");
    return;
  }
  $("#BtAdminrightDelete'.$adminright['id'].'").btn("loading");
  var values = {"id": '.$adminright['id'].'};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/configuration/ajax/ajax_adminright_delete.php", type: "POST", data: values, 
    success: function (data) {
      $("#AjaxEdit div").remove();
      $("#AjaxEdit").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });    
});
</script>';



?>
