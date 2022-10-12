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

if(!check_adminRights('translations')) {
    echo '
    <script>alert("'.lg('You do not have the required rights to edit the translation variables', NULL, FALSE).'");</script>';
    exit;
}

if(!isset($_GET['from'])) $_GET['from'] = 'admin' ;

$sql = $dataBase->prepare('SELECT id, length, name, page
                           FROM pr__translation 
                           WHERE id = :id');
$sql->execute(['id' => $_POST['id']]);
$variableLang = $sql->fetch();
$sql->closeCursor();

$unixCommandSearch = 'grep -rn "lg(\''.str_replace('"', '\"', str_replace("'", "\'", $variableLang['name'])).'\', \''.$variableLang['page'].'\'"';

echo '
<div id="DivAJaxVariables">
    <textarea id="GetCopyUnixOtherPage" style="position: absolute;top:-10000px;">'.$unixCommandSearch.'</textarea>
    <div class="float-left">Page: <span class="font-weight-bold">'.$variableLang['page'].'</span></div>
    <div class="float-right pl-4">Name: <span class="font-weight-bold">'.htmlentities($variableLang['name']).'</span></div>
    <div class="float-right">Id: <span class="font-weight-bold">'.$variableLang['id'].'</span></div>
    <div class="clearfix"></div>
    <hr>
    <form action="#" id="FormUpdateVariable"  method="post">
    <input type="hidden" name="id" value="'.$_POST['id'].'">
    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text text-secondary bg-light" style="min-width:110px;">Page</span>
        </div>    
        <input type="text" name="InputPage" class="form-control input-grey" value="'.$variableLang['page'].'">
    </div>
    <div class="pt-2 text-center">
        <button id="BtSendVariableUpdate" class="btn btn-info" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg\'></i> &nbsp; Save in progress">Save</button>
    </div>
    <hr>
    <p class="fnt-1-1">';
if($variableLang['page'] != 'Global') {
    echo '
If you change the variable page, you have to change it as well in the code if you specified it in the call of the lg function.';
}
echo '
   <br>'.lg('Unix command to search this variable in the code').':</p>
    <p class="fnt-1-1">'.htmlentities($unixCommandSearch).'  <i class="ml-3 fa fa-copy pointer fnt-1-3 ml-1" id="ModalIconCopyUnixCommand'.$variableLang['id'].'" onClick="copyToClipboard(\'GetCopyUnixOtherPage\', \'ModalIconCopyUnixCommand'.$variableLang['id'].'\')"></i></p>
    </form>
</div>
<script>
$("#DivBodyModalVariableEdit").html($("#DivAJaxVariables").html());
$("#DivAJaxVariables").remove();
$("#ModalVariableEdit").modal("show");
$("#FormUpdateVariable").on("submit", function(e) {
  e.preventDefault();
  $("#BtSendVariableUpdate").btn("loading")
  var values = $("#FormUpdateVariable").serialize();
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/translations/ajax/ajax_variablepage_update.php", type: "POST", data: values,
    success: function(data) {
        $("#AjaxUpdateVariable div").remove();
        $("#AjaxUpdateVariable").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });  
});
</script>';

?>
