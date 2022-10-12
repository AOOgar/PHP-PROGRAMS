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

// Not to display the Translation variables Ids in this modal!
$_COOKIE['ShowTranslatesIds'] = 0;

init_langVars(['Admin']);

if(!check_adminRights('translations')) {
    echo '
    <script>alert("'.lg('You do not have the required rights to edit the translation variables', NULL, FALSE).'");</script>';
    exit;
}

if(!isset($_GET['from'])) $_GET['from'] = 'admin' ;

$langs = '';
foreach($config['Langs'] as $oneLang) {
    $langs .= $oneLang.', ';
}
$langs = rtrim($langs, ', ');
$sql = $dataBase->prepare('SELECT id, length, name, page, '.$langs.'
                           FROM pr__translation 
                           WHERE id = :id');
$sql->execute(['id' => $_POST['id']]);
$variableLang = $sql->fetch();
$sql->closeCursor();

$showVariableFromPage = 'lg(\''.str_replace("'", "\'", $variableLang['name']).'\')';
$showVariableOtherPage = 'lg(\''.str_replace("'", "\'", $variableLang['name']).'\', \''.$variableLang['page'].'\')';
$unixCommandSearch = 'grep -rn "lg(\''.str_replace('"', '\"', str_replace("'", "\\\\\'", $variableLang['name'])).'\'"';

echo '
<div id="DivAJaxVariables">
    <div style="position: absolute;top:-10000px;">
        <textarea id="GetCopyFromPage">'.$showVariableFromPage.'</textarea>
        <textarea id="GetCopyOtherPage">'.$showVariableOtherPage.'</textarea>
        <textarea id="GetCopyUnixSearch">'.$unixCommandSearch.'</textarea>
    </div>
    <div class="float-left">'.lg('Page').': <span class="font-weight-bold">'.$variableLang['page'].'</span></div>
    <div class="float-right pl-4"><i class="fa fa-plus-circle pointer fnt-1-3" data-toggle="collapse" data-target="#DivCopyClipboard" aria-expanded="true" aria-controls="DivCopyClipboard"></i></div>
    <div class="float-right pl-4">'.lg('Name').': <span class="font-weight-bold">'.htmlentities($variableLang['name']).'</span></div>
    <div class="float-right">Id: <span class="font-weight-bold">'.$variableLang['id'].'</span></div>
    <div class="clearfix"></div>
    <div id="DivCopyClipboard" class="collapse pt-3 fnt-0-95">';
if($variableLang['page'] == 'Global') {
    echo  lg('PHP code of the lg function of this Global variable').': <i>'.htmlspecialchars($showVariableOtherPage).'</i> <i class="fa fa-copy ml-2 pointer"></i>';
} else {
    echo '
        <p class="my-1 pb-1 border-bottom">'.lg('PHP code of the lg function used in page').' '.$variableLang['page'].': <i>'.htmlspecialchars($showVariableFromPage).'</i> <i id="IconCopyFromPage" class="fa fa-copy ml-2 pointer" onClick="copyToClipboard(\'GetCopyFromPage\', \'IconCopyFromPage\')"></i></p> 
        <p class="my-1 pb-1 border-bottom">'.lg('PHP code of the lg function used in another page').': <i>'.htmlspecialchars($showVariableOtherPage).'</i> <i id="IconCopyOtherPage" class="fa fa-copy ml-2 pointer" onClick="copyToClipboard(\'GetCopyOtherPage\', \'IconCopyOtherPage\')"></i></p>';
}
echo '
        <p class="my-1 pb-1 border-bottom">'.lg('Unix command to search this variable in the code').': <i>'.htmlspecialchars($unixCommandSearch).'</i> <i id="IconCopyUnixSearch" class="fa fa-copy ml-2 pointer" onClick="copyToClipboard(\'GetCopyUnixSearch\', \'IconCopyUnixSearch\')"></i></p>
    </div>
    <hr>
    <form action="#" id="FormUpdateVariable"  method="post">
    <input type="hidden" name="id" value="'.$_POST['id'].'">
    <input type="hidden" name="from" value="'.$_GET['from'].'">';
if($variableLang['length'] == 'small') {
    foreach($config['Langs'] as $oneLang) {
        echo '
    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text text-secondary bg-light" style="min-width:110px;">'.ucfirst($config['LangsNames'][$oneLang]).'</span>
        </div>    
        <input type="text" id="Variable_'.$oneLang.'" name="Variable_'.$oneLang.'" class="form-control input-grey" value="'.htmlentities($variableLang[$oneLang]).'">
    </div>';
    }
} else if($variableLang['length'] == 'medium') {
    foreach($config['Langs'] as $oneLang) {
        echo '
    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text text-secondary bg-light" style="min-width:110px;">'.ucfirst($config['LangsNames'][$oneLang]).'</span>
       </div>    
       <textarea type="text" id="Variable_'.$oneLang.'" name="Variable_'.$oneLang.'" class="form-control input-grey" style="resize: none;">'.htmlentities($variableLang[$oneLang]).'</textarea>
    </div>';
    }
} else {
    foreach($config['Langs'] as $oneLang) {
        echo '
    <div class="form-group mb-4">
      <label for="comment" class="text-secondary border p-1 bg-light">'.ucfirst($config['LangsNames'][$oneLang]).'</label>
      <textarea class="form-control input-grey" rows="7" id="Variable_'.$oneLang.'" name="Variable_'.$oneLang.'" name="text" style="resize: none;">'.$variableLang[$oneLang].'</textarea>
    </div>';
    }
}
echo '
    <div class="pt-5 text-center">
        <button id="BtSendVariableUpdate" class="btn btn-info" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg\'></i> &nbsp; Save in progress">Save</button>
    </div>
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
    url: "'.$config['AdminURL'].'/pages/translations/ajax/ajax_variable_update.php", type: "POST", data: values,
    success: function(data) {
        $("#AjaxUpdateVariable div").remove();
        $("#AjaxUpdateVariable").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });  
});
</script>';

?>
