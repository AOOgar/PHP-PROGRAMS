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

define('_PATHROOT', '../../../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');
include_once (_PATHROOT.'account/profile/profile_sql.inc.php');
require_once (_PATHROOT.'include/php/_libraries/geoip/'.$config['GeoIPLibraryVersion'].'/autoload.php');
use GeoIp2\Database\Reader; /* Auto select the country of the user based on IP location */

init_langVars(['Profile', 'Global']);

if(!isset($_SESSION['UserId'])) {
    echo '
<script>
window.location.href = "'.get_URL().'/account";
</script>';
    exit;
}

$countryLangShow = get_countryLanguage();

$sql = $dataBase->prepare('SELECT code, '.$countryLangShow.'
                           FROM pr__country
                           WHERE display = 1
                           ORDER BY '.$countryLangShow);
$sql->execute();
$countries = $sql->fetchAll();
$sql->closeCursor();

if(isset($_POST['id'])) {
    $userAddress = sql_getUserAdress($_POST['id'], $countryLangShow);
}


if(!isset($userAddress['country_code']) && check_GeoIPDatabaseFile()) {
    $reader = new Reader(_PATHROOT.'include/php/_libraries/geoip/database/'.$config['GeoIPDatabaseFile']);
    try {
        //$clientLocation = $reader->city('8.8.8.8'); // Test with Google DNS IP (USA)
        $clientLocation = $reader->city(get_IPClient());
    } catch (Exception $e) {
        $clientLocation = FALSE;
    }
    if(isset($clientLocation->country->isoCode)) {
        $userAddress['country_code'] = $clientLocation->country->isoCode;
    }
}

echo '
<div id="DivAjaxAddress">
    <form action="#" id="FormAddress"  name="FormAddress" method="post">
    <input name="id" type="hidden" value="'.issetor($_POST['id']).'">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-light text-secondary rounded-0">'.lg('Address name').'</span>
         </div>
         <input value="'.htmlentities(issetor($userAddress['name'])).'" id="InputName" name="InputName" placeholder="'.lg('Home, Work, Billing, Holidays...', NULL, FALSE).'" type="text"  class="form-control input-grey py-sm-4 px-sm-3" required>
    </div>
    <hr>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-transparent text-secondary border-0 rounded-0">'.lg('Your name').'</span>
         </div>
         <input value="'.htmlentities(issetor($userAddress['username'], (ucfirst($sessionUser['firstname']).' '.ucfirst($sessionUser['lastname'])))).'" id="InputUserName" name="InputUserName" type="text"  class="form-control input-grey py-sm-4 px-sm-3" required>
    </div>
<hr>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-transparent text-secondary border-0 rounded-0">'.lg('Line').' 1</span>
         </div>
         <input value="'.htmlentities(issetor($userAddress['line1'])).'" id="InputLine1" name="InputLine1" type="text"  class="form-control input-grey py-sm-4 px-sm-3" required>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-transparent text-secondary border-0 rounded-0">'.lg('Line').' 2</span>
         </div>
         <input value="'.htmlentities(issetor($userAddress['line2'])).'" id="InputLine2" name="InputLine2" type="text"  class="form-control input-grey py-sm-4 px-sm-3">
    </div>
<hr>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-transparent text-secondary border-0 rounded-0">'.lg('City').'</span>
         </div>
         <input value="'.htmlentities(issetor($userAddress['city'])).'" id="InputCity" name="InputCity" type="text"  class="form-control input-grey py-sm-4 px-sm-3" required>
    </div>
<hr>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-transparent text-secondary border-0 rounded-0">'.lg('Postal code').'</span>
         </div>
         <input value="'.htmlentities(issetor($userAddress['postcode'])).'" id="InputPostcode" name="InputPostcode" type="text"  class="form-control input-grey py-sm-4 px-sm-3" required>
    </div>
<hr>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text bg-transparent text-secondary border-0 rounded-0" for="inputGroupSelect01">'.lg('Country').'</label>
        </div>
        <select id="SelectCountrycode" name="SelectCountrycode" class="custom-select bg-light select-grey" style="height:48px;" required>
            <option value="">--</option>';
foreach($countries as $oneCountry) {

    echo '
            <option value="'.$oneCountry['code'].'" ';
    if(isset($userAddress['country_code']) && $userAddress['country_code'] == $oneCountry['code']) {
        echo ' selected ';
    }
    echo '>'.htmlentities($oneCountry[$countryLangShow]).'</option>';
}
echo '
        </select>
    </div>

    <button type="submit" id="BtAddress" class="mt-5 btn btn-mytheme" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'" >'.lg('Save', 'Global').'</button>
    </form>

</div>';


echo '
<script>
$(document).on("submit", "#FormAddress", function(e) {
  if (!e.isDefaultPrevented()) {
    $("#BtAddress").btn("loading");
    var values = $("form#FormAddress").serialize();
    $.ajax({
      url: "'.$config['URL'].'/account/profile/ajax/ajax_address_update.php", type: "POST", data: values,
      success: function (data) {
        $("#AjaxEdit").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });
  }
  e.preventDefault();
});
$("#DivModalBodyAddress").empty();
$("#DivAjaxAddress").appendTo($("#DivModalBodyAddress"));
$("#ModalAddress").modal("show");
</script>';







?>
