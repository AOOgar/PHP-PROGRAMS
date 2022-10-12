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
require_once (_PATHROOT.'include/php/emails/global_email.inc.php');
include_once ('../signup_global.inc.php');

init_langVars(['Signup', 'Global']);

if(!check_emailValid($_POST['InputEmail'])) {
    
    /**
     *  PHP E-mail check invalid
     */
    ajax_emailInvalid();
    exit;
    
}
    
/** 
 *  We check e-mail already in use for an account
 */
$sql = $dataBase->prepare('SELECT COUNT(id) AS number
                           FROM pr__user
                           WHERE email = :email');
$sql->execute(['email' => $_POST['InputEmail']]);
$emailCount = $sql->fetch();
$sql->closeCursor();

if($emailCount['number'] >= 1) {
    
    /**
     *  E-mail already registred in database
     */
    ajax_emailAlreadyRegistred();
    exit;

}

$passwordError = check_passwordStrength($_POST['InputPassword']);

if($passwordError !== NULL) {
    ajax_passwordError($passwordError);
    exit;
}

/**
 *  All is OK, we send an email to activate the new account
 */

$key_activation = md5(uniqid(rand(), true));

$configEmail['To'] = $_POST['InputEmail'];
$configEmail['ToName'] = $_POST['InputFirstname'].' '.$_POST['InputLastname'];
$configEmail['Subject'] = lg('Welcome to WebsiteName! Please confirm your email', NULL, FALSE);
$configEmail['Title'] = lg('You\'re on your way! <br>Let\'s confirm your email address.', NULL, FALSE);
$configEmail['box'][0]['Type'] = 'text';
$configEmail['box'][0]['Content'] = lg('Please confirm the email address of your account by clicking on the following link:', NULL, FALSE);

$configEmail['box'][1]['Type'] = 'link';
$configEmail['box'][1]['URL'] = get_URL().'/login/?key_act='.$key_activation.'&key_eml='.rawurlencode(encrypt($_POST['InputEmail'], $config['KeyEmail']));
$configEmail['box'][1]['URLDesc'] = lg('Confirm email address', NULL, FALSE);

$configEmail['Template'] = 'email_templateBase';

$catchError = email_send();

if($catchError != '') { /** Returned an error! */
    
    ajax_accountCreate_errorEmail($catchError);
    
} else {
        
    /**
     *  Email sent! we create the account in database
     */
    $sql = $dataBase->prepare('INSERT INTO pr__user(activation_key,
                                                    email,
                                                    firstname,
                                                    lastname,
                                                    lang,
                                                    password,
                                                    date_accountcreated,
                                                    ip_accountcreated,
                                                    lastsession_ip,
                                                    lastsession_date,
                                                    agent) 
                                   VALUES (:key,
                                           :email,
                                           :firstname,
                                           :lastname,
                                           :lang,
                                           :password,
                                           :date,
                                           :ip,
                                           :lastsession_ip,
                                           :lastsession_date,
                                           :agent)');

    $sql->execute(['key'               => $key_activation,
                   'email'             => $_POST['InputEmail'],
                   'firstname'         => $_POST['InputFirstname'],
                   'lastname'          => $_POST['InputLastname'],
                   'lang'              => $config['UserLang'],
                   'password'          => hash_password($_POST['InputPassword']),
                   'date'              => date('Y-m-d H:i:s'),
                   'ip'                => get_IPClient(),
                   'lastsession_ip'    => get_IPClient(),
                   'lastsession_date'  => date('Y-m-d H:i:s'),
                   'agent'             => $_SERVER['HTTP_USER_AGENT']]);
    
    $userId = $dataBase->lastInsertId();
    $sql->closeCursor();
    
    /**
     * Check if user created is the first user to add it Admin rights
     * This check can be removed once the first user has been created
     */
    $sql = $dataBase->prepare('SELECT COUNT(id) AS num FROM pr__user');
    $sql->execute();
    $countUsers = $sql->fetch()['num'];
    if($countUsers == 1) {
        $sql = $dataBase->prepare('INSERT INTO pr__user_adminright(user_id, adminright_id) VALUES (:user_id, :adminright_id)');
        $sql->execute(['user_id'        => $userId,
                       'adminright_id'  => 1]);
        $sql->closeCursor();
        $sql = $dataBase->prepare('INSERT INTO pr__user_adminprefs(user_id) VALUES(:user_id)');
        $sql->execute(['user_id' => $userId]);
        $sql->closeCursor();
    }

    ajax_accountCreated();
}


function ajax_passwordError($errorText) {

    echo '
<div id="DivAjaxErrorPassword">
    <span id="SpanAjaxErrorPassword" class="opa-0 text-danger">'.$errorText.' </span></div>
</div>
<script>
setTimeout(function() {
  $("#DivErrorPassword").html($("#DivAjaxErrorPassword").html());
  $("#SpanAjaxErrorPassword").fadeTo("fast", 1);
  setTimeout(function() {
    $("#BtAccountCreate").btn("reset");
  }, 1000);
}, 1000);
</script>';

}

function ajax_accountCreated() {
    global $config;
    
    echo '
<div id="DivAjaxAccountCreated">
    <div class="opa-0 bg-light rounded p-2 p-md-5 border shadow" style="margin-top:40px;min-height:450px;">
        <div class="text-center"><h3 class="spacing-2 d-inline-block underline-title text-uppercase">'.lg('Your account has been created').'</h3></div>
        <div class="p-4 pt-5 text-left" > 
            <p>'.ucfirst($_POST['InputFirstname']).',</p>
            <p>'.lg('An email has been sent to').' <span class="underline-mytheme mx-1" >'.$_POST['InputEmail'].'</span> '.lg('with a link to activate your account.').'</p>
            <p class="pt-4 fnt-0-9">'.lg('If you can\'t find it, please check the spam folder in your mailbox.').'</p>
            <i class="fa fa-envelope text-mytheme" style="font-size:100px;"></i>
        </div>
    </div>
</div>

<script>
setTimeout(function() {
  $("#DivSignupBody").html($("#DivAjaxAccountCreated"));
  setTimeout(function() {$("#DivAjaxAccountCreated div").fadeTo("slow", 1);}, 1000);
  scrollToElem($("#BodyPage"));
}, 1500);
</script>';
}

function ajax_accountCreate_errorEmail($catchError) {

    echo '
<div id="DivAjaxAccountCreated">
    <br><br>'.lg('No account created, error when sending the email:').': '.$catchError.'
</div>';
    
    echo '
<script>
setTimeout(function() {
  $("#DivSignupBody").html($("#DivAjaxAccountCreated"));
  setTimeout(function() {$("#DivAjaxAccountCreated div").fadeTo("slow", 1);}, 1000);
  scrollToElem($("#BodyPage"));
}, 1500);
</script>';
    
}

function ajax_emailAlreadyRegistred() {
    global $config, $jsWindowLoaded;
    
    echo '
<div id="DivEmailExists" class="opa-0">
    <span id="SpanEmailExists" class="text-danger">'.lg('This email is already registered.').' </span>
    <div id="DivGoLogin" class="float-right"><a class="ml-2" href="'.$config['URL'].'/login/"> <i class="fa fa-sign-in fa-rotate-45 fnt-1-3 mr-2 a-none" style="transform: rotate(180deg);"></i>'.lg('Go to log in page').'</a></div>
    <div class="clearfix"></div>
</div>
<script>
setTimeout(function() {
  $("#DivErrorEmail").html($("#DivEmailExists").html());
  $("#SpanEmailExists").fadeTo("fast", 1);
  $("#DivGoLogin").blink(2);
  setTimeout(function() {
    $("#BtAccountCreate").btn("reset");
  }, 1000);
}, 1000);
</script>';
    
}

function ajax_emailInvalid() {

    echo '
<div id="DivEmailInvalid">
    <span id="SpanEmailInvalid" class="opa-0">'.lg('This email is incorrect').'</span></div>
</div>
<script>
$("#DivErrorEmail").html("");
setTimeout(function() {
  $("#DivErrorEmail").html($("#DivEmailInvalid").html());
  $("#SpanEmailInvalid").fadeTo("fast", 1);
  setTimeout(function() {
    $("#BtAccountCreate").btn("reset");
  }, 1000);
}, 1000);
</script>';
    
}



?>
