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
require_once (_PATHROOT.'include/php/_libraries/geoip/'.$config['GeoIPLibraryVersion'].'/autoload.php');
use GeoIp2\Database\Reader;
if(check_GeoIPDatabaseFile()) {
    $reader = new Reader(_PATHROOT.'include/php/_libraries/geoip/database/'.$config['GeoIPDatabaseFile']);
}

init_langVars(['Admin', 'Global']);

if(!check_adminRights('accounts')) {
    echo '<script>location.reload();</script>';
    exit;
}

$sql = $dataBase->prepare('SELECT pr__user.*,
                                  pr__address.line1, pr__address.line2, pr__address.city, pr__address.postcode, pr__address.country_code,
                                  pr__country.fr AS name_country_fr,
                                  pr__user_oauth.facebook_id, pr__user_oauth.google_id
                           FROM pr__user
                           LEFT JOIN pr__address ON pr__address.user_id = pr__user.id
                           LEFT JOIN pr__country ON pr__country.code = pr__address.country_code
                           LEFT JOIN pr__user_oauth ON pr__user.id = pr__user_oauth.user_id
                           WHERE pr__user.id = :id ');
$sql->execute(['id' => $_POST['uid']]);
$userInfos = $sql->fetch();
$sql->closeCursor();

if(!$userInfos) {
    echo '<div class="text-center py-5 fnt-1-3">User not found, he might have been deleted!</div>';
    exit;
}

$sql = $dataBase->prepare('SELECT * FROM pr__adminright WHERE id != 1 ORDER BY name');
$sql->execute();
$adminRights = $sql->fetchAll();
$sql->closeCursor();

$userAdminRights = get_userAdminRights($_POST['uid']);

/**
 *  Manage Admin Rights Account
 */
if(isset($_POST['do']) && $_POST['do'] == 'rights') {
    
    if($_POST['uid'] == get_userIdSession()) {
        /**
         *  Can't manage your own Admin Rights 
         */

        echo '
<div class="container mt-4 mb-4 mx-auto rounded-lg p-4" style="max-width:600px;background:#e8e8ed;">
    <div class="row">
        <div class="col-sm-2 text-center">
            <i class="fa fa-connectdevelop fa-4x pr-4"></i>
        </div>
        <div class="col-sm-10 text-center fnt-1-1 pt-3">
           <p class="p-3 text-danger font-weight-bold">'.lg('You can not edit your own rights.').'</p>
        </div>
    </div>
</div>';

    } else {

        echo '
<div class="container mt-4 mb-4 mx-auto rounded border border-danger p-4" style="max-width:835px;">
    <div class="row">
        <div class="col-sm-2 text-center">
            <i class="fa fa-connectdevelop fa-4x pr-4"></i>
        </div>
        <div id="DivRightsActual" class="col-sm-10 fnt-1-1">
            <span class="fnt-1-1 mr-2">'.lg('Actual Admin rights:').'</span>';
        $cssNoRights = '';
        $cssAdminRights = '';
        $cssSpecificRights = '';
        $cssSelectSpecificRights = '';
        if(count($userAdminRights) != 0) {
            if(in_array('admin', $userAdminRights)) {
                echo '<span class="bg-danger text-light font-weight-bold rounded px-2 py-1">admin</span>';
                $cssAdminRights = 'selected';
                $cssSelectSpecificRights = 'disabled';
            } else {
                echo '<div class="mt-2">';
                $cssSpecificRights = 'selected';
                $i = 0;
                foreach($userAdminRights as $oneRight) {
                    echo ' <div class="d-inline ml-3 mb-2 bg-secondary text-light font-weight-bold rounded px-2 py-1">'.$oneRight.'</div>';
                    $i++;
                }
                echo '</div>';
            }
        } else {
            $cssNoRights = 'selected';
            $cssSelectSpecificRights = 'disabled';
            echo '
            <span class="ml-3" style="border-bottom: 3px solid #757575;color:#515151;"><b>'.lg('No rights').'</b></span>';
        }
        echo '
        </div>
    </div>
    <div id="DivSelectsRights" class="text-center">
            <div class="row pt-3">
                <div class="col-sm-5">
                    <select id="SelectRights" class="selectpicker " onChange="rightsSelected(this)" data-width="100%"  data-style="btn-outline-dark" title="Select Rights" data-header="Select Rights">
                        <option value="norights" '.$cssNoRights.'>'.lg('No rights').'</option>
                        <option value="admin" '.$cssAdminRights.'>admin</option>
                        <option value="specific" '.$cssSpecificRights.'>'.lg('Specific rights').'</option>
                    </select>
                </div>
                <div class="col-sm-7">
                    <select id="SelectSpecificRights" class="selectpicker" data-width="100%" data-style="btn-outline-dark" multiple="multiple" title="'.lg('Specific rights').'" data-header="'.lg('Specific rights').'" '.$cssSelectSpecificRights.'>';
        ksort($config['AdminRights']);
        foreach($adminRights as $oneRight) {
            if($oneRight['name'] != 'admin') {
                $cssSelected = '';
                if(in_array($oneRight['name'], $userAdminRights)) {
                    $cssSelected = 'selected';
                }
                echo '
                        <option '.$cssSelected.'>'.$oneRight['name'].'</option>';
            }
        }
        echo '
                    </select>
                </div>
            </div>
            <div id="DivRightsError" class="pt-2" style="height:10px"></div>
            <div id="AjaxRightsUpdate" class="dis-n"></div>
        </div>
        <p class="pt-4 text-center"><button id="BtRightsUpdate" onClick="updateRights();" class="btn btn-info" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Update Admin rights').'</button></p>
    </div>
</div>

<script>
$("#SelectRights").selectpicker("refresh");
$("#SelectSpecificRights").selectpicker("refresh");
function rightsSelected(e){
    if($(e).find("option:selected").val() == "specific") {
        $("#SelectSpecificRights").removeAttr("disabled");
        $("#SelectSpecificRights").selectpicker("refresh");
    } else {
        $("#SelectSpecificRights option").attr("selected",false);
        $("#SelectSpecificRights").attr("disabled",true);
        $("#SelectSpecificRights").selectpicker("refresh");
    }
    $(".btn").blur();
};
function updateRights() {
  $("#BtRightsUpdate").btn("loading");
  $("#searchTicket").popover("hide");
  NProgress.start();
  var values = { "uid": '.$_POST['uid'].', "rights": $("#SelectRights").val(), "specificrights": $("#SelectSpecificRights").val()};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/accounts/ajax/ajax_adminrights_update.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxRightsUpdate").empty().html(data);
    }
  });
}
</script>';
    }
}

/**
 *  Delete Account Confirmation
 */
if(isset($_POST['do']) && $_POST['do'] == 'delete') {
    if($_POST['uid'] == get_userIdSession()) {
        /**
         *  Can't delete its own account 
         */
        
        echo '
<div class="container mt-4 mb-4 mx-auto rounded-lg p-4" style="max-width:600px;background:#e8e8ed;">
    <div class="row">
        <div class="col-sm-2 text-center">
            <i class="fa fa-trash fa-3x pr-4"></i>
        </div>
        <div class="col-sm-10 text-center fnt-1-1 pt-3">
           <p class="text-center bg-warning fnt-1-2 rounded-lg p-3">'.lg('You can not delete your own account.').'</p>
        </div>
    </div>
</div>';
        
    } else {
        /**
         * Display delete account ASK 
         */

        echo '
<div class="container mt-4 mb-4 mx-auto rounded-lg p-4 bg-light border border-danger" style="max-width:600px;">
    <div class="row">
        <div class="col-sm-2 text-center">
            <i class="fa fa-trash fa-3x pr-4"></i>
        </div>
        <div class="col-sm-10">
            <p><b>'.lg('Please, confirm the account deletion').'</b></p>
            <p class="text-center bg-warning fnt-1-2 rounded-lg p-3">'.lg('You can not undo this deletion').'</p>
            <div id="DivAccountDeleteConfirm" class="checkbox pt-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="CheckboxAccountDelete">
                    <label class="custom-control-label" for="CheckboxAccountDelete">'.lg('Yes, delete this account now').'</label>
                </div>
            </div>
        </div>
        <button id="BtAccountDeleteConfirm" onClick="submitAccountDelete();" class="btn btn-outline-danger mx-auto mt-4" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Delete in progress').'">'.lg('Delete this account').'</button>
    </div>
</div>';

    }
    echo '
<div id="AjaxEdit" class=""></div>
<script>
function submitAccountDelete() {
  if($("#CheckboxAccountDelete").is(":checked")) {
    $("#BtAccountDeleteConfirm").btn("loading");
    var values = { "uid": '.$_POST['uid'].'};
    $.ajax({
      url: "'.$config['AdminURL'].'/pages/accounts/ajax/ajax_account_delete.php", type: "POST", data: values,
      success: function(data) {
        setTimeout(function () {
          $("#AjaxEdit").empty().html(data);
        }, 1500);
      },
      error: function(exception) { console.log(exception); }
    });
  } else {
      $("#DivAccountDeleteConfirm").attr("style", "color:#b20010;");
  }
}
</script>';
}



echo '
<div class="container">
          
    <div class="row">
        <div class="col-sm-6 pt-4">

            <div class="card border-primary rounded-0">
                <div class="card-header bg-primary text-white rounded-0">'.lg('General Information').'</div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6">
                            <dl class="row">
                                <dt class="col-sm-6 text-right">User ID</dt>
                                <dd class="col-sm-6">'.$userInfos['id'].'</dd>
                                <dt class="col-sm-6 text-right">'.lg('Firstname', 'Global').'</dt>
                                <dd class="col-sm-6">'.$userInfos['firstname'].'</dd>
                                <dt class="col-sm-6 text-right">'.lg('Lastname', 'Global').'</dt>
                                <dd class="col-sm-6">'.$userInfos['lastname'].'</dd>
                                <dt class="col-sm-6 text-right">'.lg('Language').'</dt>
                                <dd class="col-sm-6">'.$userInfos['lang'].'</dd>
                            </dl>
                        </div>
                        <div class="col-sm-6 text-center">';
if($userInfos['picture'] != NULL) {
    echo '
<a href="'.$config['ImagesURL'].'_uploads/profiles_pictures/'.$userInfos['picture'].'.jpg" target="_blank">
    <img src="'.$config['ImagesURL'].'_uploads/profiles_pictures/'.$userInfos['picture'].'-500.jpg" class="border" style="padding:5px; width:90%;max-width:150px;max-height:300px;">
</a>';
} else {
    echo '
<img src="'.$config['ImagesURL'].'profile-default-image.jpg" class="border" style="padding:5px; width:90%;max-width:150px;max-height:300px;">';
}
echo '
                        </div>

                    </div>
                    <dl class="row pt-2">
                        <dt class="col-sm-5 text-right">'.lg('Email', 'Global').'</dt>
                        <dd class="col-sm-7"><a href="mailto:'.$userInfos['email'].'">'.$userInfos['email'].'</a></dd>
                        <dt class="col-sm-5 text-right">'.lg('Creation').'</dt>
                        <dd class="col-sm-7">'.date("d-m-Y H:i", strtotime($userInfos['date_accountcreated'])).'</dd>
                        <dt class="col-sm-5 text-right">'.lg('Last session').'</dt>
                        <dd class="col-sm-7">';
if($userInfos['lastsession_date'] == NULL) {
    echo '-';
} else {
    echo date("d-m-Y H:i", strtotime($userInfos['lastsession_date']));
}
echo '</dd>
                        <dt class="col-sm-5 text-right">'.lg('Registration Type').'</dt>
                        <dd class="col-sm-7">';
$separator = '';
$typeAccount = '';
if( $userInfos['password'] != NULL ) {
    $typeAccount .= 'E-mail';
    if(($userInfos['activation_key'] != NULL)) {
        $typeAccount .= ' ('.lg('Not activated').')';
    }
    $separator = ', ';
}

if($userInfos['google_id']) {
    $typeAccount .= $separator.'Google';
    $separator = ', ';
}

if($userInfos['facebook_id']) {
    $typeAccount .= $separator.'Facebook';
    $separator = ', ';
}

echo $typeAccount.'</dd>';
if($userAdminRights) {
    echo '
                        <dt class="col-sm-5 text-right">'.lg('Admin Rights').'</dt>
                        <dd class="col-sm-7">';
    $i = 1;
    foreach($userAdminRights as $oneRight) {
        echo $oneRight;
        if(count($userAdminRights) != $i) {
            echo ', ';
        }
        $i++;
    }
    echo '</dd>';
}
echo '
                    </dl>
                </div>
            </div>';

/**
 * DISPLAY GOOGLE INFOS
 */
$mar_top = '';
if($userInfos['google_id']) {
    $sqlGoogle_user = $dataBase->prepare('SELECT *
                                          FROM pr__user_google
                                          WHERE id = :id ');
    $sqlGoogle_user->execute(['id' => $userInfos['google_id']]);
    $userGoogle = $sqlGoogle_user->fetch();
    $sqlGoogle_user->closeCursor();
    
    if($userGoogle['picture'] == NULL) {
        $imgGoogle = '<i class="fa fa-user pl-2" style="font-size:140px;color:#d23f31;border:1px solid #d23f31;"></i>';
    } else {
        $imgGoogle = '<img src="'.$userGoogle['picture'].'?sz=150" style="padding:5px; width:90%;max-width:150px;max-height:300px;">';
    }

    echo '
            <div class="card rounded-0 mt-4" style="border: 1px solid #d23f31;">
                <div class="card-header text-white rounded-0" style="background:#d23f31;"><i class="fa fa-google pr-3"></i>'.lg('Google Account').'</div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6">
                            <dl class="row">
                                <dt class="col-sm-6 text-right">Google ID</dt>
                                <dd class="col-sm-6">'.$userGoogle['id'].'</dd>
                                <dt class="col-sm-6 text-right">'.lg('Firstname', 'Global').'</dt>
                                <dd class="col-sm-6">'.$userGoogle['firstname'].'</dd>
                                <dt class="col-sm-6 text-right">'.lg('Lastname', 'Global').'</dt>
                                <dd class="col-sm-6">'.$userGoogle['lastname'].'</dd>
                                <dt class="col-sm-6 text-right">Locale</dt>
                                <dd class="col-sm-6">'.$userGoogle['locale'].'</dd>
                            </dl>
                        </div>
                        <div class="col-sm-6 text-center">
                        '.$imgGoogle.'';
    if($userGoogle['link'] != NULL) {
        echo '
                        <br><a target="'.rand().'" href="'.$userGoogle['link'].'">'.lg('Link Google').'</a>';
    }
    echo '
                        </div>
                    </div>
                    <dl class="row pt-2">
                        <dt class="col-sm-5 text-right">'.lg('Email', 'Global').'</dt>
                        <dd class="col-sm-7"><a href="mailto:'.$userGoogle['email'].'">'.$userGoogle['email'].'</a></dd>
                        <dt class="col-sm-5 text-right">'.lg('Account Verified').'</dt>
                        <dd class="col-sm-7">'.$userGoogle['verified'].'</dd>
                    </dl>
                </div>
            </div>';
}

/**
 * DISPLAY FACEBOOK INFOS
 */
if($userInfos['facebook_id']) {
    $sqlFacebook_user = $dataBase->prepare('SELECT *
                                            FROM pr__user_facebook
                                            WHERE id = :id ');
    $sqlFacebook_user->execute(['id' => $userInfos['facebook_id']]);
    $userFacebook = $sqlFacebook_user->fetch();
    $sqlFacebook_user->closeCursor();
    $linkSearch = 'https://www.facebook.com/search/top/?q='.rawurlencode($userFacebook['firstname'].' '.$userFacebook['lastname']);
    if($userFacebook['picture'] == NULL) {
        $imgFacebook = '<i class="fa fa-user pl-2" style="font-size:140px;color:#4267b2;border: 1px solid #4267b2;"></i>';
    } else {
        $image = file_get_contents($userFacebook['picture'].'?type=large');
        $imageData = base64_encode($image);
        $src = 'data: '.@mime_content_type($image).';base64,'.$imageData;
        $imgFacebook = '<img style="width:150px;" src="'.$src.'">';
    }
    echo '
            <div class="card rounded-0 mt-4" style="border: 1px solid #4267b2;">
                <div class="card-header text-white rounded-0" style="background:#4267b2;"><i class="fa fa-facebook pr-3"></i>'.lg('Facebook Account').'</div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6">
                            <dl class="row">
                                <dt class="col-sm-6 text-right">Facebook ID</dt>
                                <dd class="col-sm-6">'.$userFacebook['id'].'</dd>
                                <dt class="col-sm-6 text-right">'.lg('Firstname', 'Global').'</dt>
                                <dd class="col-sm-6">'.$userFacebook['firstname'].'</dd>
                                <dt class="col-sm-6 text-right">'.lg('Lastname', 'Global').'</dt>
                                <dd class="col-sm-6">'.$userFacebook['lastname'].'</dd>
                                <dt class="col-sm-6 text-right">Locale</dt>
                                <dd class="col-sm-6">'.$userFacebook['locale'].'</dd>
                            </dl>
                        </div>
                        <div class="col-sm-6 text-center">
                             '.$imgFacebook.'
                            <!-- <br><a target="'.rand().'" href="'.$userFacebook['link'].'">'.lg('Link Facebook').'</a> Not possible anymore -->
                            <br><a target="'.rand().'" href="'.$linkSearch.'">Search</a>
                        </div>
                    </div>
                    <dl class="row pt-2">
                        <dt class="col-sm-6 text-right">'.lg('Email', 'Global').'</dt>
                        <dd class="col-sm-6"><a href="mailto:'.$userFacebook['email'].'">'.$userFacebook['email'].'</a></dd>
                        <dt class="col-sm-6 text-right">'.lg('Account Verified').'</dt>
                        <dd class="col-sm-6">'.$userFacebook['verified'].'</dd>
                    </dl>
                </div>
            </div>';
    $mar_top = 'mt-3';
}

/**
 * DISPLAY Addresses 
 */
$sql = $dataBase->prepare('SELECT pr__address.*, pr__country.'.$userInfos['lang'].' AS country_name
                           FROM pr__address
                           LEFT JOIN pr__country ON pr__address.country_code = pr__country.code
                           WHERE pr__address.user_id = :id
                           ORDER BY id DESC');

$sql->execute(['id' => $_POST['uid']]);
$userAddress = $sql->fetchAll();
$sql->closeCursor();

echo '
            <div class="card border-secondary rounded-0 mt-4">
                <div class="card-header bg-secondary text-white rounded-0">'.lg('Addresses').'</div>
                <div class="card-footer">';
if(sizeof($userAddress) == 0) {

    echo '
                    <div class="pad-20">'.lg('No registered address').'</div>';

} else {

    echo '
<script>
$("#SelectAddress").on("change", function() {
  var values = {"address_id": this.value, "lang": "'.$userInfos['lang'].'"};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/accounts/ajax/ajax_accountaddress_show.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxAddress").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});
</script>';
    echo '
                    <select id="SelectAddress" name="SelectAddress" class="custom-select select-grey">';

$selected = 'selected';
foreach($userAddress as $oneAddress) {
    
    echo '
                        <option id="OptionAddress'.$oneAddress['id'].'" value="'.$oneAddress['id'].'" '.$selected.' >'.$oneAddress['name'].'</option>';
    $selected = '';
    
}

    echo '
                    </select>
                    <div id="DivAddressDisplayed" class="p-3 mt-3 border bg-white border-info rounded">
                          <p>'.$userAddress[0]['username'].'</p>
                          <p>'.$userAddress[0]['line1'].'</p>
                          <p>'.$userAddress[0]['line2'].'</p>
                          <p>'.$userAddress[0]['postcode'].' '.$userAddress[0]['city'].'</p>
                          <p>'.$userAddress[0]['state'].'</p>
                          <p class="mb-0">'.$userAddress[0]['country_name'].'</p>
                  </div>
                  <div id="AjaxAddress" class="dis-n"></div>';
}

echo '
                </div>
            </div>
        </div>';

/**
 * DISPLAY BROWSER AND OS 
 */
echo '
        <div class="col-sm-6 pt-4">';

if(check_adminRights('admin')) {
    
    echo '  
            <div id="AjaxKeyLogAs" class=""></div>
            <div class="card border border-dark rounded-0">
                <div class="card-header bg-dark text-white rounded-0">'.lg('"Login as" key').'</div>
                <div class="card-footer">';
    $disDivKeyGenerate = '';
    $disDivKeyShow = 'dis-n';
    if($userInfos['loginas_key'] != NULL) {
        $disDivKeyGenerate = 'dis-n';
        $disDivKeyShow = '';
    }
    echo '
                    <div id="DivKeyGenerate" class="'.$disDivKeyGenerate.'">
                        <p>'.lg('Creation of a key to login as').' '.$userInfos['firstname'].' '.$userInfos['lastname'].'. '.lg('The key will be usable via a link.').'<p>
                        <div class="p-2 text-center"><button id="BtLogAsKey" style="min-width:120px;" class="btn btn-sm btn-secondary" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg\'></i>">'.lg('﻿Generate a key').'</button></div>
                    </div>

                    <div id="DivKeyShow" class="'.$disDivKeyShow.'">
                       <p>'.lg('Link with the key to login as').' '.$userInfos['firstname'].' '.$userInfos['lastname'].':</p> 
                       <div style="position: absolute;top:-10000px;"><textarea type="text" id="TextareaKeyLogingAs">'.$config['URL'].'/open/loginas/key/'.$userInfos['loginas_key'].'</textarea></div>
                       <div class="p-2 border border-light-2">
                           <span id="SpanKeyLogAs">'.$config['URL'].'/open/loginas/key/'.$userInfos['loginas_key'].'</span>
                           <div class="float-right"><i id="IconCopyKeyLogAs" onClick="copyToClipboard(\'TextareaKeyLogingAs\', \'IconCopyKeyLogAs\')" class="fa fa-copy pointer fnt-1-5"></i></div>
                       </div>
                       <p class="pt-2">'.lg('This link can only be used once and the "Login as" password must be used.').'</p> 
                       <div class="pt-4 text-center"><button id="BtLogAsKeyDelete" style="min-width:120px;" class="btn btn-sm btn-secondary" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg\'></i>">'.lg('Delete the key').'</button></div>
                   </div>

               </div>
            </div>';

    echo '
<script>
$("#BtLogAsKey").on("click", function() {
  $("#BtLogAsKey").btn("loading");
  var values = {"id": '.$userInfos['id'].'};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/accounts/ajax/ajax_loginas_keygenerate.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxKeyLogAs div").remove();
      $("#AjaxKeyLogAs").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});
$("#BtLogAsKeyDelete").on("click", function() {
  $("#BtLogAsKeyDelete").btn("loading");
  var values = {"id": '.$userInfos['id'].'};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/accounts/ajax/ajax_loginas_keydelete.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxKeyLogAs div").remove();
      $("#AjaxKeyLogAs").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});
</script>';

}
    echo '

            <div class="card card-custom-yellow rounded-0 mt-4">
                <div class="card-header rounded-0">'.lg('Browser and Operating system').'</div>
                <div class="card-footer">
                    <dl class="row">
                        <dt class="col-sm-6 text-right">'.lg('Browser').'</dt>
                        <dd class="col-sm-6">'.$userInfos['agent'].'</dd>
                    </dl>
               </div>
            </div>';

/**
 * DISPLAY KEYS GENERATED
 *  
 *  - to activate the account
 *  - to change the account email
 *  - to change the password
 */

echo '
            <div class="card card-custom-yellow rounded-0 mt-4">
                <div class="card-header rounded-0">'.lg('Keys').'</div>
                <div class="card-footer">
                    <dl class="row">';
if($userInfos['activation_key'] != NULL) {
    echo '
                        <dt class="col-sm-6 text-right" style="white-space: normal;">'.lg('Account Activation Key').'</dt>
                        <dd class="col-sm-6">
                            <span class="break-line" style="width:170px;">'.$userInfos['activation_key'].'</span>
                            <span><a target="'.rand().'" href="'.get_URL().'/login/?key_act='.$userInfos['activation_key'].'&key_eml='.rawurlencode(encrypt($userInfos['email'], $config['KeyEmail'])).'">Link</a></span></dd>
                        </dd>
                        <hr style="border-top: 1px solid #8c8b8b;">'; 
}

echo '
                        <dt class="col-sm-6 text-right" style="white-space: normal;">'.lg('New Email Key').'</dt>
                        <dd class="col-sm-6">';
if($userInfos['newemail_changekey'] != NULL) {
    echo '
                            <span class="break-line" style="width:170px;">'.$userInfos['newemail_changekey'].'</span>
                            <span><a target="'.rand().'" href="'.get_URL().'/?key_emlchange='.$userInfos['newemail_changekey'].'">Link</a></span></dd>';
    echo '
                        <dt class="col-sm-6 text-right">'.lg('Creation key date').'</dt>
                        <dd class="col-sm-6">'.date("d-m-Y H:i:s", strtotime($userInfos['newemail_changedate']));
    $minutesExpired = check_dateExpired($userInfos['newemail_changedate'], $config['ExpiryKeyNewEmail']);
    if($minutesExpired) {
        echo '<p>'.lg('Expiry in').' '.$minutesExpired.' min</p>';
    } else {
        echo '<p>'.lg('Link expired').'</p>';
    }
    echo '
                        </dd>';
} else {
    echo '-</dd>';
}
echo '
                        <hr style="border-top: 1px solid #8c8b8b;">
                        <dt class="col-sm-6 text-right" style="white-space: normal;">'.lg('New password key').'</dt>
                        <dd class="col-sm-6">';
if($userInfos['password_changekey'] != NULL) {
    echo '
                            <span class="break-line" style="width:170px;">'.$userInfos['password_changekey'].'</span>
                            <span><a target="'.rand().'" href="'.get_URL().'/?key_passchange='.rawurlencode($userInfos['password_changekey']).'">Link</a></span></dd>';
    
    echo '
                        <dt class="col-sm-6 text-right">'.lg('Creation key date').'</dt>
                        <dd class="col-sm-6">'.date("d-m-Y H:i:s", strtotime($userInfos['password_changedate']));
    $minutesExpired = check_dateExpired($userInfos['password_changedate'], $config['ExpiryKeyNewPassword']);
    if($minutesExpired) {
        echo '<p>'.lg('Expiry in').' '.$minutesExpired.' min</p>';
    } else {
        echo '<p>'.lg('Link expired').'</p>';
    }
    echo '
                        </dd>';
} else {
    echo '-</dd>';
}
echo '
                    </dl>
                </div>
            </div>
        </div>
    </div>';
echo '
    <div class="row">';


/**
 * DISPLAY IP AND LOCATION BY IP 
 */

echo '
        <div class="col-sm-6 pt-4">

            <div class="card card-custom-red rounded-0">
                <div class="card-header rounded-0">'.lg('Location / Account creation').'</div>
                <div class="card-footer">
                    <dl class="row">
                        <dt class="col-sm-6 text-right">IP</dt>
                        <dd class="col-sm-6">'.issetor($userInfos['ip_accountcreated'], '-').'</dd>';
$clientLocation = FALSE;
if(check_GeoIPDatabaseFile()) {
    try {
        $clientLocation = $reader->city($userInfos['ip_accountcreated']);
    } catch (Exception $e) {
        $clientLocation = FALSE;
    }
}
if($clientLocation !== FALSE) {    
    echo '
                        <dt class="col-sm-6 text-right">'.lg('Country').'</dt>
                        <dd class="col-sm-6">'.$clientLocation->country->name.'</dd>
                        <dt class="col-sm-6 text-right">'.lg('Country code').'</dt>
                        <dd class="col-sm-6">'.$clientLocation->country->isoCode.'</dd>
                        <dt class="col-sm-6 text-right">'.lg('City').'</dt>
                        <dd class="col-sm-6">'.$clientLocation->city->name.'</dd>
                        <dt class="col-sm-6 text-right">'.lg('Region name').'</dt>
                        <dd class="col-sm-6">'.$clientLocation->mostSpecificSubdivision->name.'</dd>';
} else {
    echo '
                        <dt class="col-sm-6 text-right">No IP Infos</dt>
                        <dd class="col-sm-6">--</dd>';
}

echo '
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-sm-6 pt-4">

           <div class="card card-custom-red rounded-0">
                <div class="card-header rounded-0">'.lg('Location / Last session').'</div>
                <div class="card-footer">
                    <dl class="row">
                        <dt class="col-sm-6 text-right">IP</dt>
                        <dd class="col-sm-6">'.issetor($userInfos['lastsession_ip'], '-').'</dd>';
$clientLocation = FALSE;
if(check_GeoIPDatabaseFile()) {
    try {
        $clientLocation = $reader->city($userInfos['ip_accountcreated']);
    } catch (Exception $e) {
        $clientLocation = FALSE;
    }
}
if($clientLocation !== FALSE) {    
    echo '
                        <dt class="col-sm-6 text-right">'.lg('Country').'</dt>
                        <dd class="col-sm-6">'.$clientLocation->country->name.'</dd>
                        <dt class="col-sm-6 text-right">'.lg('Country code').'</dt>
                        <dd class="col-sm-6">'.$clientLocation->country->isoCode.'</dd>
                        <dt class="col-sm-6 text-right">'.lg('City').'</dt>
                        <dd class="col-sm-6">'.$clientLocation->city->name.'</dd>
                        <dt class="col-sm-6 text-right">'.lg('Region name').'</dt>
                        <dd class="col-sm-6">'.$clientLocation->mostSpecificSubdivision->name.'</dd>';
} else {
    echo '
                        <dt class="col-sm-6 text-right">No IP Infos</dt>
                        <dd class="col-sm-6">--</dd>';
}

echo '

                    </dl>
                </div>
            </div>

        </div>
    </div>
    </div>';

?>














































































































































































































