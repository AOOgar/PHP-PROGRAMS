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

define('_PATHROOT', '../../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');
include_once (_PATHROOT.'signup/signup_global.inc.php');

init_langVars(['Home', 'Signup', 'Profile', 'Global']);

$sql = $dataBase->prepare('SELECT firstname, password_changedate
                           FROM pr__user
                           WHERE password_changekey = :key');

$sql->execute(['key' => $_POST['key_passchange']]);
$user = $sql->fetch();
$sql->closeCursor();

/**
 *  We check if the key exist and if the key has expired.
 */

if($user) {
    
    if(!check_dateExpired($user['password_changedate'],
                           $config['ExpiryKeyNewPassword'])) {
        
        $sql = $dataBase->prepare('UPDATE pr__user
                                   SET
                                       password_changekey = :key_del,
                                       password_changedate = :date_del

                                   WHERE password_changekey = :key');
        
        $sql->execute(['key_del'   => NULL,
                       'date_del'  => NULL,
                       'key'       => $_POST['key_passchange']]);

        ajax_passwordKeyInvalid();
        exit;
    }
    
} else {

    ajax_passwordKeyInvalid();
    exit;
}

if($_POST['do'] == 'showchange') {
    
    ajax_passwordChangeForm();

} else if($_POST['do'] == 'changepassword') {

    $passwordError = check_passwordStrength($_POST['InputPassword']);

    if($passwordError === NULL) {
        if($_POST['InputPassword'] != $_POST['InputPassword2']) {
            ajax_passwordError(lg('The new password and its confirmation are not identical', 'Profile'));
            exit;
        }
    } else {
        ajax_passwordError($passwordError);
        exit;
    }
        
    $sql = $dataBase->prepare('UPDATE pr__user
                               SET
                                   password = :password_new,
                                   password_changekey = :key_del,
                                   password_changedate = :date_del

                               WHERE password_changekey = :key');
    
    $sql->execute(['password_new'  => hash_password($_POST['InputPassword']),
                   'key_del'       => NULL,
                   'date_del'      => NULL,
                   'key'           => $_POST["key_passchange"]]);
    $sql->closeCursor();

    ajax_passwordChanged();
    
}

function ajax_passwordError($errorText) {

    echo '
<div id="DivAjaxErrorPassword">
    <span id="SpanAjaxErrorPassword" class="opa-0 text-danger">'.$errorText.' </span></div>
</div>
<script>
setTimeout(function() {
  $("#DivErrorPasswords").html($("#DivAjaxErrorPassword").html());
  $("#SpanAjaxErrorPassword").fadeTo("fast", 1);
  setTimeout(function() {
    $("#BtPasswordChange").btn("reset");
  }, 1000);
}, 1000);
</script>';

}

function ajax_passwordChangeForm() {
    global $config;
    
    echo '
<div id="DivAjaxPassword" class="p-4">
    <form id="FormPasswordChange" action="#/" method="post">
    <p class="pb-4">'.lg('Please, enter your new password twice.').'</p>
    <p class="fnt-0-95">'.lg('Minimum 6 characters, with at least 1 digit and a special character such as: ! # @ - _.', 'Signup').' :</p>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light" style="width:120px;">'.lg('Password', 'Global').'</span>
                </div>
                <input id="InputPassword" name="InputPassword" type="password" class="form-control input-grey rounded-right" required>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light" style="width:120px;">'.lg('Confirm', 'Profile').'</span>
                </div>
                <input id="InputPassword2" name="InputPassword2" type="password" class="form-control input-grey rounded-right" required>
            </div>
             <div id="DivErrorPasswords" class="text-danger mt-2" style="height:30px;"></div>
            <div class="pt-3">
                <button id="BtPasswordChange" class="btn btn-mytheme" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button>
            </div>
        </div>
    </form>
</div>
<script>
$("#DivAjaxPassword").appendTo($("#DivModalBodyPasswordChange"));
$("#ModalPasswordChange").modal("show");
$("#FormPasswordChange").on("submit", function (e) {
  $("[id^=\'DivError\']").html("");
  $("#BtPasswordChange").btn("loading");
  var values = {"do":  "changepassword", "key_passchange": "'.$_POST["key_passchange"].'", "InputPassword": $("#InputPassword").val(), "InputPassword2": $("#InputPassword2").val()};
  $.ajax({
    url: "'.$config['URL'].'/home/ajax/ajax_password_change.php",
    type: "POST",
    data: values,
    success: function(data) {
      $("#AjaxPasswordChange").empty().html(data);
    },
    error: function(exception) { console.log(exception)},
  });
  e.preventDefault();
});
</script>';
}

function ajax_passwordChanged() {
    global $config, $user;

    echo '
<div id="DivAjaxPassword" class="opa-0">
    <p>'.ucfirst($user['firstname']).',</p>
    <p class="pt-2 pb-2">'.lg('Your password has been changed, you can now log in with that new password.').'</p>
    <p class="p-3 text-center"><button id="BtSignin" onClick="goToSignin();" class="btn btn-mytheme" >'.lg('Log in', 'Global').'</button>
    <div class="text-center pt-4">
        <i class="fa fa-user text-mytheme" style="font-size:100px;"></i>
    </div>
</div>

<script>
$("#ModalPasswordChange").on("hidden.bs.modal", function () {
    window.location.replace("'.get_URL().'/login/");
})
function goToSignin() {
    $("#ModalPasswordChange").modal("hide");
    setTimeout(function() { window.location.href = "'.get_URL().'/login/"; }, 1000);
}
setTimeout(function() {
  $("#BtPasswordChange").btn("reset");
  $("#DivModalBodyPasswordChange").empty();
  $("#DivAjaxPassword").appendTo($("#DivModalBodyPasswordChange"));
  setTimeout(function() {$("#DivAjaxPassword").fadeTo("fast",1);}, 1000);
},1000);
</script>';
}

function ajax_passwordKeyInvalid() {
    global $config;
    
    echo '
<div id="DivAjaxPassword">
    <p class="pt-3">'.lg('This link to change your password on WebsiteName is no longer valid or is incorrect.').'</p>
    <p class="pt-3">'.lg('You can create a new one:').'</p>
    <div class="text-center pt-4">
        <button id="BtSignin" onClick="goToSignin();" class="btn btn-mytheme">'.lg('Create a new link').'</button>
    </div>
    <div class="text-center pt-4">
        <i class="fa fa-lock text-mytheme" style="font-size:100px;"></i>
    </div>
</div>
<script>
function goToSignin() {
  $("#ModalPasswordChange").modal("hide");
  setTimeout(function() { window.location.href = "'.get_URL().'/login?do=passch"; }, 1000);
}
$("#DivAjaxPassword").appendTo($("#DivModalBodyPasswordChange"));
$("#ModalPasswordChange").modal("show");
</script>';
}


?>
