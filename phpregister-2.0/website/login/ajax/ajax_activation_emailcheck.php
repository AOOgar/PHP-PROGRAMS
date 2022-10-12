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

init_langVars(['Log in']);

/**
   We check if there is an account with this email
 */
$sql = $dataBase->prepare('SELECT id, firstname, lastname, password, activation_key
                           FROM pr__user
                           WHERE email = :email');
$sql->execute(array('email' => $_POST['InputActivationEmail']));
$numRows = $sql->rowCount();
$user = $sql->fetch();
$sql->closeCursor();

if($numRows == 0) {
    
    ajax_noEmailAccount();

} else {

    /**
     *  We check if this account is a Social Media account only 
     *  with NO PASSWORD in database / pr__user / password
     */
    
    if($user['password'] == NULL) {
        
        $sql = $dataBase->prepare('SELECT *
                                   FROM pr__user_oauth
                                   WHERE user_id = :id');
        $sql->execute(array('id' => $user['id']));
        $userOAuth = $sql->fetch();
        $sql->closeCursor();
        
        ajax_accountSocialNetwork();
        
    } else {

        if($user['activation_key'] == NULL) {

            ajax_alreadyActivated();
            
        } else {

            ajax_activationSend();
            
        }
    }
}

function ajax_noEmailAccount() {

    echo '
<script>
$("#SpanEmailCheck").attr("style", "color:#a94442;opacity:0;");
setTimeout(function() {
  $("#SpanEmailCheck").html("'.lg('There is no account with this email').'");
  $("#SpanEmailCheck").fadeTo("slow", 1);
  $("#BtActivationEmailCheck").btn("reset");
}, 1000);
</script>';
    
}

function ajax_activationSend() {
    global $config;
    
    echo '
<script>
var values = $("form#FormActivationEmailcheck").serialize();
$.ajax({
    url: "'.$config['URL'].'/login/ajax/ajax_activation_resend.php",
    type: "POST",
    data: values,
    success: function(data) {
        setTimeout(function() {
            $("#ModalActivateAccount").modal("hide");
            $("#AjaxSignin div").remove();
            $("#AjaxSignin").html("").html(data);
            $("#DivActivationSent").height($("#DivSigninBody").height());
            $("#DivActivationSent").css("opacity", "0");
            $("#DivSigninBody").removeClass("dis-n").addClass("dis-n");
            $("#AjaxSignin").removeClass("dis-n");
            $("#BtActivationEmailCheck").btn("reset");
            setTimeout(function() {$("#DivActivationSent").fadeTo("slow", 1);}, 1000);
        }, 1000);
    }
});
</script>';
}

function ajax_alreadyActivated() {

    echo '
<script>
$("#SpanEmailCheck").attr("style", "color:#a94442;opacity:0;");
setTimeout(function() {
  $("#SpanEmailCheck").html("'.lg('This account is already activated').'");
  $("#SpanEmailCheck").fadeTo("slow", 1);
  $("#BtActivationEmailCheck").btn("reset");
  $("#InputEmail").val("'.$_POST['InputActivationEmail'].'");
  setTimeout(function() {$("#ModalActivateAccount").modal("hide");}, 3000);
}, 1000);
</script>';
    
}

function ajax_accountSocialNetwork() {
    global $userOAuth, $user;

    echo '
<div id="DivSocialNetwork" class="dis-n">
    <span style="color:#a94442;">'.lg('This email is associated to the Social Network:');
    if($userOAuth['google_id'] != NULL) {
        echo '
        <span class="underline-mytheme mx-2" style="font-style:normal;">Google / Gmail</span>';
    }
    if($userOAuth['facebook_id'] != NULL) {
        echo '
        <span class="underline-mytheme mx-2" style="font-style:normal;">Facebook</span>';
    }
    if($userOAuth['windowslive_id'] != NULL) {
        echo '
        <span class="underline-mytheme mx-2" style="font-style:normal;">Windows Live</span>';
    }
    echo '
    </span>
    <p style="font-style:normal;">'.lg('You must use the Social Network button to log in.').'</p>
</div>';
    
    echo '
<script>
setTimeout(function() {
  $("#SpanEmailCheck").attr("style", "font-size:1.1em;opacity:0;");
  $("#SpanEmailCheck").html($("#DivSocialNetwork").html());
  $("#SpanEmailCheck").fadeTo("slow", 1);
  $("#BtActivationEmailCheck").btn("reset");
},1000);
</script>';

}

?>
