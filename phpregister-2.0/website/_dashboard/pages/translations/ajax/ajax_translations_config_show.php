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

if(!check_adminRights('translations')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

$sql = $dataBase->prepare('SELECT * 
                           FROM pr__country 
                           ORDER by code');
$sql->execute();
$countries = $sql->fetchAll();
$sql->closeCursor();

echo '
<div id="DivTranslationsPrefs" class="mx-auto mb-4" style="max-width:1100px;">
    <div class="mt-5 bg-light container">
        <div class="row">
            <div class="col-2"><i class="fa fa-gears fa-3x p-3"></i></div>
            <div class="col-10 p-3 fnt-1-4 text-right">'.lg('Preferences').'</div>
        </div>
    </div>
    <div class="mx-auto p-2 p-sm-4 bg-white border">
    <p class="fnt-1-2 py-2">'.lg('<b>Countries</b> ordered by their codes. Countries which are not "Displayed" will no...').'</p>
<table id="TableCountriesGranted" class="table table-striped table-bordered dt-responsive" style="background:white;width:100%">
       <thead style="background-color:white;">
          <tr>
              <th class="text-center">CODE</th>
              <th>'.ucfirst($config['LangsNames']['fr']).'</th>
              <th>'.ucfirst($config['LangsNames']['en']).'</th>
              <th>'.ucfirst($config['LangsNames']['es']).'</th>
              <th>Displayed</th>
              <th></th>
          </tr>
       </thead>
        <tbody>';
$i = 1;
foreach($countries as $oneCoutry) {

    ajaxshow_oneLineCountry($oneCoutry, $i);

    $i++;
}
echo '

        </tbody>
</table>
    </div>          
</div>
<div id="AjaxUpdateConfig"></div>
<script>
function saveCountry(id) {
  $("#BtCountry" + id).btn("loading");
  NProgress.start();
  var values = {"id": id, 
                "InputFR": $("#InputFR"+id).val(),
                "InputEN": $("#InputEN"+id).val(),
                "InputES": $("#InputES"+id).val(),
                "SelectDisplay": $("#SelectDisplay"+ id +" option:selected" ).val(),
                "SelectTraveler": $("#SelectTraveler"+ id +" option:selected" ).val()};
  $.ajax({
      url: "'.$config['AdminURL'].'/pages/translations/ajax/ajax_country_update.php", type: "POST", data: values,
      success: function(data) {
          $("#AjaxUpdateConfig div").remove();
          $("#AjaxUpdateConfig").html("").html(data);
          NProgress.done();
      },
      error: function(exception) { console.log(exception); }
  });
}

$("#DivTranslationsPage").removeClass("dis-n").addClass("dis-n");
$("#DivTranslations").attr("style", "opacity:0;");
$("#DivTranslations").removeClass("dis-n");
$("#TableCountriesNotGranted").DataTable( {
    "bInfo" : false,
    "paging": false,
    "ordering": false,
    "searching": false
});
$("#TableCountriesGranted").DataTable( {
    "bInfo" : false,
    "paging": false,
    "ordering": false,
    "searching": false
});
setTimeout(function () {$("#DivTranslations").fadeTo("fast", 1);NProgress.done();}, 500);' ;


function ajaxshow_oneLineCountry($oneCoutry, $i) {
    
    $cssTR = '';
    if($oneCoutry['display'] == 0) {
        $cssTR = 'tr-red';
    }
    echo '
           <tr id="TrCountry'.$oneCoutry['id'].'" class="'.$cssTR.'">
               <td class="align-middle text-center font-weight-bold" style="height:20px;padding:7px 4px;">'.$oneCoutry['code'].'</td>
               <td class="align-middle" style="height:20px;padding:7px 4px;"><input id="InputFR'.$oneCoutry['id'].'" class="form-control form-control-sm rounded input-grey" type="text" value="'.$oneCoutry['fr'].'" style="font-size:14px;"></td>
               <td class="align-middle" style="height:20px;padding:7px 4px;"><input id="InputEN'.$oneCoutry['id'].'" class="form-control form-control-sm rounded input-grey" type="text" value="'.$oneCoutry['en'].'" style="font-size:14px;"></td>
               <td class="align-middle" style="height:20px;padding:7px 4px;"><input id="InputES'.$oneCoutry['id'].'" class="form-control form-control-sm rounded input-grey" type="text" value="'.$oneCoutry['es'].'" style="font-size:14px;"></td>

               <td class="align-middle text-center" style="width:10%;">

  <select id="SelectDisplay'.$oneCoutry['id'].'" name="SelectDisplay" class="custom-select custom-select-sm select-grey">
      <option value="1"';
    if($oneCoutry['display'] == 1) echo ' selected ';
    echo '">Yes</option>
      <option value="0"';
    if($oneCoutry['display'] == 0) echo ' selected ';
    echo '">No</option>
  </select>
                   
                </td>
               <td class="align-middle text-center" style="height:20px;" onClick="saveCountry('.$oneCoutry['id'].');"><button id="BtCountry'.$oneCoutry['id'].'" class="btn btn-info btn-sm" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'"><i class="fa fa-download pr-2"></i>'.lg('Save', 'Global').'</button></td>
           </tr>';

}

?>
