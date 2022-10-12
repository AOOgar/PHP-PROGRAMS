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
                           FROM pr__website_option
                           WHERE id = :id');
$sql->execute(['id' => $_POST['id']]);
$variable = $sql->fetch();
$sql->closeCursor();

echo '
<div class="p-2 p-lg-4 fnt-1-1">
    <form action="#" name="FormVariableUpdate'.$variable['id'].'" id="FormVariableUpdate'.$variable['id'].'"  method="post">
    <input type="hidden" name="InputId" value="'.$variable['id'].'">
    <p class="fnt-1-2">'.lg('Changing a variable. Changing its <strong>Name</strong> can cause malfunctio...').'</p>
    <table class="table">
        <tbody>
        <tr>
            <td class="font-weight-bold" style="width:140px;">'.lg('Name').'</td>
            <td><input name="InputVariableName" type="text" class="form-control input-grey" value="'.$variable['name'].'" required maxlength="60"></td>
        </tr>
        <tr>
            <td class="font-weight-bold">'.lg('Value').'</td>
            <td><input name="InputVariableValue" type="text" class="form-control input-grey" value="'.$variable['value'].'"  required maxlength="100"></td>
        </tr>
        <tr>
            <td class="font-weight-bold">'.lg('Description').'</td>
            <td><textarea name="TextareaVariableDescription" class="form-control input-grey">'.$variable['description'].'</textarea></td>
        </tr>
        </tbody>
    </table>
    <div class="my-5 text-center">
        <button id="BtVariableUpdate'.$variable['id'].'" class="btn btn-info" onClick="deleteVariable('.$variable['id'].');" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Confirm modification').'</button>
    </div>
    </form>
    <hr>';
$unixCommand = 'grep -rn "\$config\[\''.$variable['name'].'\'\]"';
echo '
    <div style="position: absolute;top:-10000px;"><textarea id="TextareaGetCopy">'.$unixCommand.'</textarea></div>
    <p class="pt-3">'.lg('Unix command to search in the code for the variable').' <strong>$config[\''.$variable['name'].'\']</strong> '.lg('(in single quotation marks)').' :</p>
    <p><span id="SpanGetCopy" class="border px-2 py-1">'.$unixCommand.'</span> <span><i id="FaCopy" class="fa fa-copy fnt-1-2 pointer ml-2 popoverData" data-content="'.lg('Copy this Unix command to clipboard').'" rel="popover" data-placement="bottom" data-trigger="hover" onClick="getCopy();"></i></span></p>
</div>
<script>
$(".popoverData").popover({html: true});
$("#FormVariableUpdate'.$variable['id'].'").on("submit", function (e) {
  e.preventDefault();
  $("#BtVariableUpdate'.$variable['id'].'").btn("loading");
  var values = $("#FormVariableUpdate'.$variable['id'].'").serialize();
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/configuration/ajax/ajax_variable_update.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxEdit div").remove();
      $("#AjaxEdit").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});
</script>';


?>
