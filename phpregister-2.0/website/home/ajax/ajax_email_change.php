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

init_langVars(['Home', 'Global']);

$sql = $dataBase->prepare('SELECT pr__user.id, pr__user.password, pr__user.firstname, pr__user.newemail, pr__user.newemail_changedate,
                                  pr__user_oauth.user_id, pr__user_oauth.google_id, pr__user_oauth.facebook_id
                           FROM pr__user
                           LEFT JOIN pr__user_oauth ON pr__user.id = pr__user_oauth.user_id
                           WHERE newemail_changekey = :key');
$sql->execute(array('key' => $_POST['key_emlchange']));
$user = $sql->fetch();
$sql->closeCursor();

/*
 * We check if the Key exist, if the Key has expired,
 * and if the user_newemail is still in database
 */
if( $user &&
    $user['newemail'] != NULL ) {

    if(!check_dateExpired($user['newemail_changedate'],
                           $config['ExpiryKeyNewEmail'])) {
        
        
        $sql = $dataBase->prepare('UPDATE pr__user
                                   SET
                                       newemail = :newemail_del,
                                       newemail_changekey = :key_del,
                                       newemail_changedate = :date_del
                                   WHERE newemail_changekey = :key');
        
        $sql->execute(array('newemail_del'  => NULL,
                            'key_del'       => NULL,
                            'date_del'      => NULL,
                            'key'           => $_POST['key_emlchange']));

        ajax_emailKeyInvalid();
        exit;
    }
    
} else {
    ajax_emailKeyInvalid();
    exit;
}

if($_POST['do'] == 'showchange') {

    if($user['password'] == NULL) {
        /**
         *  It's a Social Media Account
         */
        if(get_userIdSession() == $user['id']) {

            $sql = $dataBase->prepare('UPDATE pr__user
                                       SET
                                           email = :user_email,
                                           newemail = :newemail,
                                           newemail_changekey = :key_del,
                                           newemail_changedate = :date_del

                                       WHERE newemail_changekey = :key');
            
            $sql->execute(array('user_email'  => $user['newemail'],
                                'newemail'    => NULL,
                                'key_del'     => NULL,
                                'date_del'    => NULL,
                                'key'         => $_POST["key_emlchange"]));
            
            $sql->closeCursor();

            ajax_emailSocialMediaChanged();
            
        } else {
            /**
             *  SESSION['user_id'] does not correspond to this Key / Account user_id
             */
            ajax_emailSocialMediaInvalid();
            
        }
        
    } else {
        /**
         *  It's an Email/Password account
         *  We ask for the Password Account to change the account email
         */

        ajax_emailChangeForm();
    }
    
} else if( ($_POST['do'] == 'checkpassword')&&
           ($_POST['InputPassword'] != '') ) {
    /** 
     *  Checking $_POST['InputPassword'] not empty for security reasons 
     */

    $sql = $dataBase->prepare('SELECT id, lang
                               FROM pr__user
                               WHERE newemail_changekey = :key_change AND password = :password');
    
    $sql->execute(array('key_change'  => $_POST['key_emlchange'],
                        'password'    => hash_password($_POST['InputPassword'])));
    $userPassword = $sql->fetch();
    $sql->closeCursor();
    if(!$userPassword) {
        
        ajax_passwordError();
        
    } else {
        
        $sql = $dataBase->prepare('UPDATE pr__user
                                   SET
                                       email = :user_email,
                                       newemail = :newemail,
                                       newemail_changekey = :key_del,
                                       newemail_changedate = :date_del

                                   WHERE newemail_changekey = :key');
        
        $sql->execute(array('user_email'  => $user['newemail'],
                            'newemail'    => NULL,
                            'key_del'     => NULL,
                            'date_del'    => NULL,
                            'key'         => $_POST["key_emlchange"]));
        $sql->closeCursor();
        sess_create($userPassword);
        ajax_emailNewValidated($user);

    }
}

function ajax_emailSocialMediaChanged() {
    global $config, $user;
    
    echo '
<div id="DivAjaxEmailChange" class="p-4">
    <p>'.ucfirst($user['firstname']).',</p>
    <p>'.lg('Your new email').' <span class="underline-mytheme mx-2">'.$user['newemail'].'</span> '.lg('has been validated and you are connected.').'</p>
    <div class="text-center pt-4">
        <i class="fa fa-envelope text-mytheme" style="font-size:80px;"></i>
    </div>
</div>

<script>
$("#DivAjaxEmailChange").appendTo($("#DivModalBodyEmailChange"));
$("#ModalEmailChange").modal("show");
</script>';
    
}

function ajax_emailSocialMediaInvalid() {
    global $config, $user;
    
    echo '
<div id="DivAjaxEmailChange" class="p-4">
    <p>'.ucfirst($user['firstname']).',</p>
    <p>'.lg('This link to change the WebisteName email does not correspond to this session.').'</p>
    <p>'.lg('To change the email of your account, you must connect with this browser.').'</p>
    <p>'.lg('Your account is associated to the social network:');
    if($user['google_id'] != NULL) {
        echo '<span class=\'underline-mytheme mx-2\'>Google / Gmail</span>';
    }

    if($user['facebook_id'] != NULL) {
        echo '<span class=\'underline-mytheme mx-2\'>Facebook</span>';
    }

    echo '
    </p>
</div>

<script>
$("#DivAjaxEmailChange").appendTo($("#DivModalBodyEmailChange"));
$("#ModalEmailChange").modal("show");
</script>';

}

function ajax_emailChangeForm() {
    global $config, $user;

    echo '
<div id="DivAjaxEmailChange" class="p-4">
    <form id="FormEmailChange" action="" method="post">
    <p class="text-left pb-3">'.lg('Please enter your WebsiteName password to validate the new email').'<span class="underline-mytheme mx-2">'.$user['newemail'].'</span>.</p>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-light" >'.lg('Password', 'Global').'</span>
            </div>
            <input name="InputPassword" id="InputPassword" type="password" class="form-control" style="max-width:300px;" required>
        </div>
        <div id="DivErrorPassword" class="text-danger pt-1 fnt-0-85 opa-0" style="height:35px;">'.lg('Invalid password').'</div>
    </div>
    <div>
        <button id="BtEmailChange" class="btn btn-mytheme" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button>
    </div>
    </form>
</div>

<script>
$("#DivAjaxEmailChange").appendTo($("#DivModalBodyEmailChange"));
$("#ModalEmailChange").modal("show");
$("#FormEmailChange").on("submit", function(e) {
  $("#BtEmailChange").btn("loading");
  $("[id^=\'DivError\']").css({"opacity":0});
  var values = {"do":  "checkpassword", "key_emlchange": "'.$_POST["key_emlchange"].'", "InputPassword": $("#InputPassword").val()};
  $.ajax({
    url: "'.$config['URL'].'/home/ajax/ajax_email_change.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxEmailChange").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
  e.preventDefault();
});
</script>';

}

function ajax_emailNewValidated($user) {
    global $config, $user;

    echo '
<div id="DivAjaxEmailChange" class="p-4 opa-0">
    <p>'.ucfirst($user['firstname']).',</p>
    <p>'.lg('Your new email').' <span class="underline-mytheme mx-2">'.$user['newemail'].'</span> '.lg('has been validated and you are connected.').'</p>
    <div class="text-center pt-4">
        <i class="fa fa-envelope text-mytheme" style="font-size:80px;"></i>
    </div>
</div>

<script>
$("#ModalEmailChange").on("hide.bs.modal", function () {
    window.location.replace("'.get_URL().'");
})

setTimeout(function() {
  $("#DivModalBodyEmailChange").empty();
  $("#DivAjaxEmailChange").appendTo($("#DivModalBodyEmailChange"));
  setTimeout(function() {$("#DivAjaxEmailChange").fadeTo("fast",1);}, 1000);
},1000);
</script>';
}

function ajax_passwordError() {
    
    echo '
<script>
setTimeout(function() {
  $("#DivErrorPassword").fadeTo("slow", 1);
  $("#BtEmailChange").btn("reset");
}, 1000);
</script>';
    
}

function ajax_emailKeyInvalid() {
    global $config;
    
    echo '
<div id="DivAjaxEmailChange">
    <p class="pt-3">'.lg('This link to change the WebsiteName email is no longer valid or is incorrect.').'</p>
    <p class="pt-3">'.lg('You can create another one in your account profile.').'</p>
    <div class="text-center pt-4">';
    if(isset($_SESSION['UserId'])) {
        /**
         *  It's a Social Media Session which has not been deleted
         */
        echo '
        <button id="BtSignin" onClick="goToAccount();" class="btn btn-mytheme mt-0">'.lg('My account', 'Global').'</button>';
        
    } else {
        /**
         *  It's an Email/Password Account for which the session has been deleted
         */
        echo '
        <button id="BtSignin" onClick="goToSignin();" class="btn btn-mytheme mt-0">'.lg('Log in', 'Global').'</button>';
        
    }
    echo '
    </div>
    <div class="text-center pt-4">
        <i class="fa fa-user text-mytheme" style="font-size:80px;"></i>
    </div>
</div>
<script>
function goToSignin() {
    $("#ModalEmailChange").modal("hide");
    setTimeout(function() { window.location.href = "'.get_URL().'/login/"; }, 1000);
}
function goToAccount() {
    $("#ModalEmailChange").modal("hide");
    setTimeout(function() { window.location.href = "'.get_URL().'/account/paramters"; }, 1000);
}
$("#DivAjaxEmailChange").appendTo($("#DivModalBodyEmailChange"));
$("#ModalEmailChange").modal("show");
</script>';
    
}
?>
