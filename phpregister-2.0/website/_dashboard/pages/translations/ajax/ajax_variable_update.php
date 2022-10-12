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
include_once ('../translations_display.inc.php');

if(!check_adminRights('translations')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

$sqlSet = '';
foreach($config['Langs'] as $oneLang) {
    $sqlSet .= '
'.$oneLang.' = :'.$oneLang.',';
}
$sqlSet = rtrim($sqlSet, ',');
$arraySql = [];
foreach($config['Langs'] as $oneLang) {
    $arraySql[$oneLang] = $_POST['Variable_'.$oneLang];
}
$arraySql['id'] = $_POST['id'];

$sql = $dataBase->prepare('UPDATE pr__translation 
                           SET '.$sqlSet.'
                           WHERE id = :id');
$sql->execute($arraySql);
$sql->closeCursor();

$sql = $dataBase->prepare('SELECT * 
                           FROM pr__translation 
                           WHERE id = :id');
$sql->execute(['id' => $_POST['id']]);
$variable = $sql->fetch();
$sql->closeCursor();

if($_POST['from'] == 'admin') {
    echo '
<div id="DivAjaxOneVariable">';
    echo html_oneVariable($variable);
    echo '
</div>
<script>
$("#DivVariableValues'.$_POST['id'].'").html($("#DivAjaxOneVariable").html());
$("#AjaxUpdateVariable div").remove();
setTimeout(function() {
  $("#BtSendVariableUpdate").btn("reset");
  $("#ModalVariableEdit").modal("hide");
}, 1000);
</script>';
} else {
    echo '
<script>
$("#SpanTranslate'.$_POST['id'].'").html($("#Variable_'.$config['UserLang'].'").val());
setTimeout(function() {
  $("#BtSendVariableUpdate").btn("reset");
  $("#ModalVariableEdit").modal("hide");
}, 1000);
</script>';
}

?>
