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
require_once (_PATHROOT.'include/php/emails/global_email.inc.php');
include_once (_PATHROOT.'account/profile/profile_display.inc.php');

init_langVars(['Profile', 'Global']);

if(!isset($_SESSION['UserId'])) {
    echo '
<script>
window.location.href = "'.get_URL().'/account";
</script>';
    exit;
}


/**
 *  Adding a new pending email
 */
if(!check_emailValid($_POST['InputEmail'])) {
    
    /**
     *  Email provided is invalid
     */
    ajax_emailInvalid();
    
} else {
    
    /**
         *  We check if there is already an account with the email filled
     */
    
    $sql = $dataBase->prepare('SELECT COUNT(id)
                               AS number
                               FROM pr__user
                               WHERE email = :email');
    $sql->execute(array('email' => $_POST['InputEmail']));
    $count = $sql->fetch();
    $sql->closeCursor();
    
    if($count['number'] == 0) {
        /** 
         *  No account with this email, we can send a validation link
         *  We recover the firt_name and lastname which are send to the email
         */
        
        $key = md5(uniqid(rand(), true));

        $sql = $dataBase->prepare('SELECT firstname, lastname
                                   FROM pr__user
                                   WHERE id = :id');
            
        $sql->execute(array('id' => get_userIdSession()));
        $user = $sql->fetch();
        $sql->closeCursor();
        
        $configEmail['To'] = $_POST['InputEmail'];
        $configEmail['ToName'] = ucfirst($user['firstname']).' '.ucfirst($user['lastname']);
        $configEmail['Subject'] = lg('Your new email on WebsiteName', NULL, FALSE);
        $configEmail['Title'] = lg('Hello', 'Global').' '.ucfirst($user['firstname']);
        $configEmail['box'][0]['Type'] = 'text';
        $configEmail['box'][0]['Content'] = lg('﻿A request has been received to change the email address of your WebsiteName account...', NULL, FALSE);
        $configEmail['box'][1]['Type'] = 'link';
        $configEmail['box'][1]['URL'] = get_URL().'/?key_emlchange='.rawurlencode($key);
        $configEmail['box'][1]['URLDesc'] = lg('Validate this email', NULL, FALSE);
        $configEmail['box'][2]['Type'] = 'text';
        $configEmail['box'][2]['Content'] = '<br>'.lg('Thank you, <br> The WebsiteName team', 'Global', FALSE);
        
        $configEmail['Template'] = 'email_templateBase';
            
        $catchError = email_send();

        if($catchError != '') {
            
            // An error sending email occurred
            ajax_emailError($catchError);
            
        } else {
            
            // No error sending email
            // We update the user table to insert the key which has been sent by email
            $sql = $dataBase->prepare('UPDATE pr__user
                                       SET
                                           newemail = :new_email,
                                           newemail_changekey = :change_key,
                                           newemail_changedate = :date
                                        WHERE id = :id ');
                
            $sql->execute(['new_email'  => $_POST['InputEmail'],
                           'change_key' => $key,
                           'date'       => date('Y-m-d H:i:s'),
                           'id'         => get_userIdSession()]);
            $userInfos['newemail'] = $_POST['InputEmail'];
            ajax_emailPending();
            
        }
        
    } else {
        
        // There is already an account with this email
        ajax_emailExist();
        
    }

}

function ajax_emailPending() {
    global $config, $userInfos;

    echo '
<div id="DivAjaxEmail">
  '.html_profileEmail().'
</div>
<script>
setTimeout(function() {
  $("#DivEmail").fadeTo("fast", 0, function() {
    $("#DivEmail").html($("#DivAjaxEmail").html());
  });
  setTimeout(function() {
    $("#DivEmail").fadeTo("fast", 1);
  }, 700);
}, 1000);
</script>';
}


function ajax_emailError($catchError) {
    global $config;

    echo '
<script>
setTimeout(function() {
  $("#DivErrorEmail").html("'.lg('Error sending email, please try again later.').'");
  $("#DivErrorEmail").fadeTo("slow", 1);
  setTimeout(function() {$("#BtEmail").btn("reset");}, 1000);
}, 1000);
</script>';
    
}

function ajax_emailInvalid() {

    echo '
<script>
setTimeout(function() {
  $("#DivErrorEmail").html("'.lg('This email is not valid').'");
  $("#DivErrorEmail").fadeTo("slow", 1);
  setTimeout(function() {$("#BtEmail").btn("reset");}, 1000);
}, 1000);
</script>';

}

function ajax_emailExist() {

    echo '
<script>
setTimeout(function() {
  $("#DivErrorEmail").html("'.lg('There is already an account with this email').'");
  $("#DivErrorEmail").fadeTo("slow", 1);
  setTimeout(function() {$("#BtEmail").btn("reset");}, 1000);
}, 1000);
</script>';

}







?>
