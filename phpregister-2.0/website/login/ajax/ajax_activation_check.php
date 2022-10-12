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

init_langVars(['Log in', 'Global']);

$email = decrypt($_POST['key_eml'], $config['KeyEmail']);

/** 
 * We check validity activation link
 */
$sql = $dataBase->prepare('SELECT id, firstname, activation_key, lang
                           FROM pr__user
                           WHERE activation_key = :key AND email = :email');
$sql->execute(array('key' => $_POST['key_act'],
                    'email' => $email));
$user = $sql->fetch();
$sql->closeCursor();

if($user) {

    /**
     *  All is OK to activate account
     */

    $sql = $dataBase->prepare('UPDATE pr__user
                               SET activation_key = :key
                               WHERE email = :email');
    $sql->execute(['key'    => NULL,
                   'email'  => $email]);
    $sql->closeCursor();
     
    sess_create($user);
    
    $config['UserLang'] = $user['lang'];
    $sql = $dataBase->prepare('UPDATE pr__user
                               SET lastsession_ip = :ip, lastsession_date = :date, agent = :agent
                               WHERE id = :id');
    
    $sql->execute(['ip'    => get_IPClient(),
                   'date'  => date("Y-m-d H:i:s"),
                   'agent' => $_SERVER['HTTP_USER_AGENT'],
                   'id'    => $user["id"]]);

    ajax_activationDone($user['firstname']);


} else {

    /** 
     *  We check user data 
     */
    $sql = $dataBase->prepare('SELECT firstname, activation_key
                               FROM pr__user
                               WHERE email = :email');
    $sql->execute(array('email' => $email));
    $user = $sql->fetch();
    $sql->closeCursor();

    if($user) {
        if($user['activation_key'] == NULL){

            /**
             *  This account is already activated 
             */
            ajax_alreadyActivated($user['firstname']);
            
        } else {

            /**
             *  Wrong activation key, ask for sending a new one 
             */
            ajax_wrongActivationKey();
            
        }
        
    }  else {

        /** 
         *  No account whith this email 
         */
        ajax_noAccountEmail();

    }
    
}

function ajax_noAccountEmail() {
    global $config;
    
    echo '
<div class="p-4">
    <p>'.lg('This account does not exist or the link used is invalid.').'</p>
    <p class="text-center">
    <i class="fa fa-unlink" style="font-size:80px;"></i>
    </p>
    <p>'.lg('Resend the activation email').'</p>

    <form method="post" id="FormActivationEmailcheck" name="FormActivationEmailcheck" action="#/">
    <input type="hidden" name="InputLinkBroken" value="1">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" >'.lg('Email', 'Global').'</span>
            </div>
            <input name="InputActivationEmail" type="email" class="form-control input-grey" required>
        </div>
        <div class="help-block fnt-0-95 pt-1 text-danger" style="height:40px;"><span id="SpanEmailCheck"></span></div>
    </div>
    <div>
    <button id="BtActivationEmailCheck" class="btn btn-mytheme" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button>
    </form>
    <div id="AjaxEmailCheck"></div>
</div>
<script>
$("#FormActivationEmailcheck").on("submit", function (e) {
  e.preventDefault();
  $("#BtActivationEmailCheck").btn("loading");
  var values = $("form#FormActivationEmailcheck").serialize();
  $.ajax({
    url: "'.$config['URL'].'/login/ajax/ajax_activation_emailcheck.php",
    type: "POST",
    data: values,
    success: function(data) {
       $("#AjaxEmailCheck").empty().html(data);
    }
  });
});
</script>';
}

function ajax_wrongActivationKey() {
    global $user, $email, $config;

    echo '
<div id="DivActivationLinkBroken" class="p-4">
    <form action="" name="FormActivationResend" id="FormActivationResend">
    <input type="hidden" name="InputLinkBroken" value="1">
    <input type="hidden" name="InputActivationEmail" id="InputActivationEmail" value="'.decrypt($_POST['key_eml'], $config['KeyEmail']).'">
    <div class="pl-4">
        <p><big>'.ucfirst($user['firstname']).',</big></p>
        <p>'.lg('Your account cannot be activated with the link used, please check your messaging too...').'</p>
        <p class="text-center pb-4"><img height="80" src="'.$config['ImagesURL'].'link-broken.png" alt=""></p>
        <p><button type="button" id="BtActivationResendLinkBroken" onClick="resendActivationLinkBroken();" class="btn btn-mytheme" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Resend the activation email').'</button></p>
    </div>
</div>
<script>
function resendActivationLinkBroken() {
  $("#BtActivationResendLinkBroken").btn("loading");
  var values = $("form#FormActivationResend").serialize();
  $.ajax({
    url: "'.$config['URL'].'/login/ajax/ajax_activation_resend.php",
    type: "POST",
    data: values,
    success: function(data) {
      setTimeout(function() {
        $("#ModalActivateAccount").modal("hide");
        $("#AjaxSignin").empty().html(data);
        $("#DivActivationSent").height($("#DivSigninBody").height());
        $("#DivActivationSent").css("opacity", "0");
        $("#DivSigninBody").removeClass("dis-n").addClass("dis-n");
        $("#AjaxSignin").removeClass("dis-n");
        $("#BtActivationResend").btn("reset");
        setTimeout(function() {$("#DivActivationSent").fadeTo("slow", 1);}, 1000);
      }, 1000);
    }
  });
}
</script>';

}

function ajax_activationDone($firstname) {
    global $config, $user;
    
    $redirectLink = '/';
    if(isset($_COOKIE['OAuthRedirect']) && $_COOKIE['OAuthRedirect'] != '') {
        $redirectLink = urldecode(decrypt($_COOKIE['OAuthRedirect'], $config['KeyOAuthRedirect']));
    }

    echo '
<div class="p-4" style="min-height:150px;">
    <p><big>'.ucfirst($firstname).',</big></p>
    <p>'.lg('Your account has been activated and you are connected.').'</p>
    <div class="text-center pt-4">
        <i class="fa fa-user text-mytheme" style="font-size:100px;"></i>
    </div>
</div>
<script>
$("#ModalActivateAccount").on("hide.bs.modal", function () {
  window.location.replace("'.get_URL($user['lang']).$redirectLink.'");
});
</script>';

}

function ajax_alreadyActivated($firstname) {
    global $config;
    
    echo '
<div class="p-4" style="min-height:150px;">
    <p><big>'.ucfirst($firstname).',</big></p>
    <p>'.lg('Your account is already activated, you can Log in with your <span class="underline-m...').'</p>
    <div class="text-center pt-4">
        <i class="fa fa-user text-mytheme" style="font-size:100px;"></i>
    </div>
</div>';
}

?>
