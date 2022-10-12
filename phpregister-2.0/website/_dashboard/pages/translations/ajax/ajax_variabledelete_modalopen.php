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

$sql = $dataBase->prepare('SELECT id, name, page
                           FROM pr__translation 
                           WHERE id = :id');
$sql->execute(['id' => $_POST['id']]);
$variableLang = $sql->fetch();
$sql->closeCursor();

$unixCommandSearch = 'grep -rn "lg(\''.str_replace('"', '\"', str_replace("'", "\'", $variableLang['name'])).'\'"';

echo '
<div id="DivAJaxVariables">
    <div class="float-left">Page: <span class="font-weight-bold">'.$variableLang['page'].'</span></div>
    <div class="float-right pl-4">Name: <span class="font-weight-bold">'.htmlentities($variableLang['name']).'</span></div>
    <div class="float-right">Id: <span class="font-weight-bold">'.$variableLang['id'].'</span></div>
    <div class="clearfix"></div>
    <hr>
    <p class="fnt-1-2">Are-you sure you want to delete this language variable?</p>
    <button id="BtVariableDelete" class="btn btn-outline-danger mx-auto" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg\'></i> &nbsp; Delete in progress">Delete this variable</button>
    <hr>
    <p>Unix Command to search this variable in the code:</p>
    <p>'.htmlentities($unixCommandSearch).'  <i class="ml-3 fa fa-copy pointer fnt-1-3 ml-1" id="ModalIconCopyUnixCommand'.$variableLang['id'].'" onClick="copyToClipboard(\'GetCopyUnixSearch'.$variableLang['id'].'\', \'ModalIconCopyUnixCommand'.$variableLang['id'].'\')"></i></p>
</div>


<script>
$("#DivBodyModalVariableEdit").html($("#DivAJaxVariables").html());
$("#DivAJaxVariables").remove();
$("#ModalVariableEdit").modal("show");
$("#BtVariableDelete").on("click", function(e) {
  $("#BtVariableDelete").btn("loading");
  var values = {"id": '.$variableLang['id'].'};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/translations/ajax/ajax_variable_delete.php", type: "POST", data: values,
    success: function(data) {
        $("#AjaxUpdateVariable div").remove();
        $("#AjaxUpdateVariable").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });  
});
</script>';









?>
