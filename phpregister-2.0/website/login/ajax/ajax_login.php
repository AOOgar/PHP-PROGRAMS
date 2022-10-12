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
$_GET['r'] = 'noupdate'; // Don't update COOKIE['OAuthRedirect']
require_once (_PATHROOT.'include/php/global_cookies.inc.php');

init_langVars(['Log in']);
/**
 *  We can sign in from a phone navbar or the page login/ for PC and tablets 
 *  InputFrom -> Phone or Empty
 */
if(!isset($_POST['InputFrom'])) {
    $_POST['InputFrom'] = '';
} 


/**
 *  To avoid loging in with a social network account email 
 *  Social network accounts does not have a password
 */
if($_POST['InputPassword'] == '') {

    ajax_loginError();
    exit;
}


$sql = $dataBase->prepare('SELECT id, activation_key, firstname, lang
                           FROM pr__user
                           WHERE email = :email AND password = :password');

$sql->execute(['email'    => $_POST['InputEmail'],
               'password' => hash_password($_POST['InputPassword'])]);
$user = $sql->fetch();
$sql->closeCursor();

if(!$user) {
    
    /** 
     *  Check if there is an social network account with this email 
     */
    $sql = $dataBase->prepare('SELECT pr__user.id, pr__user.password, pr__user_oauth.id as oauth_id, pr__user_oauth.google_id, pr__user_oauth.facebook_id
                               FROM pr__user
                               LEFT JOIN pr__user_oauth ON pr__user.id = pr__user_oauth.user_id
                               WHERE email = :email');

    $sql->execute(['email' => $_POST['InputEmail']]);
    $userOAuth = $sql->fetch();
    $sql->closeCursor();
    if(!$userOAuth) {

        ajax_loginError();

    } else if($userOAuth['password'] == NULL ) {
        
        /**
         *  It's a social network account only 
         */
        ajax_acccountSocialNetwork();
        
    } else if($userOAuth['oauth_id'] != NULL) {

        /** 
         *  It's an account with e-mail/password but also 
         *  associated to a social network account
         */
        ajax_loginError_socialNetwork();
        
    } else {

        ajax_loginError();

    }
    
} else {
    
    /**
     *  Good e-mail and password
     */
    if($user['activation_key'] == NULL) {
        
        /**
         *  User account has been activated
         */

        sess_create($user);
        $sessionUser = get_userInfos();
        $sql = $dataBase->prepare('UPDATE pr__user
                                   SET lastsession_ip = :ip, lastsession_date = :date, agent = :agent
                                   WHERE id = :id');
        
        $sql->execute(['ip'    => get_IPClient(),
                       'date'  => date("Y-m-d H:i:s"),
                       'agent' => $_SERVER['HTTP_USER_AGENT'],
                       'id'    => $user["id"]]);


        ajax_signedIn_redirect();
        
    } else {
        
        /**
         *  User account NOT activated
         */
        ajax_accountNotActivated();
        
    }
    
}

function ajax_signedIn_redirect() {
    global $config, $sessionUser;

    $redirectLink =  '';
    if(isset($_COOKIE['OAuthRedirect']) && $_COOKIE['OAuthRedirect'] != '') {
        $redirectLink = urldecode(decrypt($_COOKIE['OAuthRedirect'], $config['KeyOAuthRedirect']));
        $redirectLink = ltrim($redirectLink, '/');
    }

    echo '
<script>
setTimeout(function() {
  window.location.replace("'.get_URL($sessionUser['lang']).$redirectLink.'");
  }, 1000);
</script>';

}

function ajax_loginError() {

    echo '
<script>
setTimeout(function() {
  $("#DivSigninError").html("'.lg('Invalid email or password').'");
  setTimeout(function() { $("#DivSigninError").fadeTo("slow", 1); }, 500);
  $("#BtSignIn").btn("reset");
}, 1500);
</script>';

}

function ajax_loginError_socialNetwork() {
    global $userOAuth;

    $socialNetworks = '';

    if($userOAuth['google_id'] != NULL) {
        $socialNetworks = '<span class=\'underline-mytheme mr-3\'>Google / Gmail</span>';
    }

    if($userOAuth['facebook_id'] != NULL) {
        $socialNetworks = '<span class=\'underline-mytheme mr-3\'>Facebook</span>';
    }

    if($_POST['InputFrom'] == 'Phone') {
        $cssColor = 'white';
        $cssColor2 = 'white';
    } else {
        $cssColor = '#a94442';
        $cssColor2 = '#333333';
    }

    echo '
<script>
setTimeout(function() {
  $("#Div'.$_POST['InputFrom'].'SigninError").css("opacity", "0");
  $("#Div'.$_POST['InputFrom'].'SigninError").html("<span style=\'color:'.$cssColor.';\'>'.lg('Invalid email or password').'.</span> <br><span style=\'color:'.$cssColor2.';\'>'.lg('This email is also associated to the Social Network:').' '.$socialNetworks.'</span>");
  $("#Div'.$_POST['InputFrom'].'SigninError").fadeTo("slow", 1);
  setTimeout(function(){$("#Bt'.$_POST['InputFrom'].'SignIn").btn("reset");},1500);
}, 1000);
</script>';

}


function ajax_accountNotActivated() {
    global $config;

    echo '
<div id="DivAccountNotActivated" class="mx-auto mt-5 p-4 rounded bg-light shadow" style="margin-top:20px;max-width:1000px;min-height:500px;">
    <form action="" name="FormActivationResend" id="FormActivationResend">
    <input type="hidden" name="InputType" value="resend">
    <input type="hidden" name="InputActivationEmail" id="InputActivationEmail" value="'.$_POST['InputEmail'].'">
    <div class="pl-4 pt-5">
        <p><big>'.lg('You have not activated your account').'</big></p> 
        <p>'.lg('Please check your emails and your spam folder in your inbox to activate your account...').'</p>
        <p class="pt-4"><big>'.lg('Email not received?').'</big></p>
        <p class="pt-4">
            <button type="button" id="BtActivationResend" onClick="resendActivation();" class="btn btn-mytheme" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg\'></i>&nbsp; '.lg('Send email in progress').'"> '.lg('Resend the activation email').'</button>
        </p>

        <div class="float-right pt-4 pb-2"><a class="btn btn-outline-secondary" href="#" onClick="goBackSignin();">'.lg('Back to Log in page').'</a></div> 
        <div class="clearfix"></div>
        <div class="fa fa-envelope-o text-mytheme" style="font-size:100px;"></div>
    </div>
    </form>
</div>

<script>
setTimeout(function() {
  $("#DivAccountNotActivated").css("opacity", "0");
  $("#DivSigninBody").addClass("dis-n");
  $("#AjaxSignin").removeClass("dis-n");
  $("#BtSignIn").btn("reset");
  setTimeout(function() {$("#DivAccountNotActivated").fadeTo("slow", 1);}, 1000);
}, 1000);
</script>';
}

function ajax_acccountSocialNetwork() {
    global $userOAuth;

    $socialNetworks = '';
    if($userOAuth['google_id'] != NULL) {
        $socialNetworks .= '<span class="underline-mytheme mr-3">Google / Gmail</span>';
    }
    if($userOAuth['facebook_id'] != NULL) {
        $socialNetworks .= '<span class="underline-mytheme mr-3">Facebook</span>';
    }
        
    echo '
<div id="DivAccountSocialNetwork" class="mx-auto mt-5 p-4 rounded bg-light shadow" style="margin-top:20px;max-width:1000px;min-height:450px;">
    <div class="text-left pl-4 pt-5">
        <p>'.lg('Your account is associated to at least one Social Network and the Log in is through...').'</p>
        <p>'.lg('You have to click on this button to Log in. Your account is associated to:').'</p>
        <p class="pt-4 text-center">'.$socialNetworks.'
        </p>
        <p class="pt-5">
            <a href="#" onClick="goBackSignin();"><a class="btn btn-outline-secondary" href="#" onClick="goBackSignin();">'.lg('Back to Log in page').'</a>
        </p>
    </div>
</div>

<script>
setTimeout(function() {
  $("#DivAccountSocialNetwork").css("opacity", "0");
  $("#DivSigninBody").removeClass("dis-n").addClass("dis-n");
  $("#AjaxSignin").removeClass("dis-n");
  setTimeout(function() {$("#DivAccountSocialNetwork").fadeTo("slow", 1);}, 1000);
  $("#BtSignIn").btn("reset");
  $("#FormSignIn").validator("destroy").trigger("reset").validator();
}, 1000);
</script>';
}

?>
