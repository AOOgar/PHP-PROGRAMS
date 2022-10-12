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

if(!check_adminRights()) {
    echo '
<script>location.reload();</script>';
    exit;
}

/**
 *  SQL to display tables names and sizes
 *  of database
 */
$sqlTables = $dataBase->prepare('SELECT TABLE_NAME AS "table_name",
                                        TABLE_ROWS AS "rows",
                                        ROUND( ( data_length + index_length ), 2 ) AS "bytes"
                                 FROM information_schema.TABLES
                                 WHERE information_schema.TABLES.table_schema = :db_database');
$sqlTables->execute(['db_database' => $config['DatabaseName']]);
$countTables = $sqlTables->rowCount();

echo '
<div id="DivAjaxDBTables">';
$totalSize = 0;
$i = 0;
$maxShowTables = 6; /* Maximum number of Database Table shown */

while($oneTable = $sqlTables->fetch()) {
    
    if($i == $maxShowTables) {
        echo '
<div class="text-right"><a href="#/" data-toggle="collapse" data-target="#DivDBTablesCollapse" class="fnt-1-7 a-none" href="#"><i id="IconDBInfosShow" class="fa fa-angle-left text-primary"></i></a></div>
<div id="DivDBTablesCollapse" class="collapse">  ';
    }
    $totalSize += $oneTable['bytes'];
    echo '
    <div class="pt-2" style="border-bottom: 1px solid #7a7a7a">
        <span>'.$oneTable['table_name'].'</span>
        <span class="pull-right">'.get_bytesReadable($oneTable['bytes']).'</span>
    </div>';
    $i++;
}
if($i >= $maxShowTables) {
    echo '
</div>';
}
echo '
</div>

<script>
$("#DivDBTables").empty();
$("#DivAjaxDBTables").appendTo($("#DivDBTables"));
$("#DivDBInfos").html("'.$countTables.' tables, Total : '.get_bytesReadable($totalSize).'");
$("#IconDBInfosShow").on("click", function() {
  $("#IconDBInfosShow").toggleClass("rotate");
});
</script>';





?>
