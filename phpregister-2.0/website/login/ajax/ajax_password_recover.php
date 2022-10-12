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

init_langVars(['Log in', 'Global']);

/**
 *  We check if there is an account with this email
 */
$sql = $dataBase->prepare('SELECT id, firstname, lastname, password
                           FROM pr__user
                           WHERE email = :email');
$sql->execute(array('email' => $_POST['InputEmailRecover']));
$numRows = $sql->rowCount();
$user = $sql->fetch();
$sql->closeCursor();

/**
 *  We can recover password from a phone navbar or the page login/ for PC and tablets 
 *  InputFrom -> Phone or Empty
 */
if(!isset($_POST['InputFrom'])) {
    $_POST['InputFrom'] = '';
} 

if($numRows == 0) {
    
    ajax_noEmailAccount();

} else {

    /**
     *  We check if this account is a social network account only 
     *  with NO PASSWORD in database / pr__user / password
     */
    
    if($user['password'] == NULL) {
        
        $sql = $dataBase->prepare('SELECT *
                                   FROM pr__user_oauth
                                   WHERE user_id = :id');
        $sql->execute(array('id' => $user['id']));
        $userOAuth = $sql->fetch();
        $sql->closeCursor();

        ajax_acccountSocialNetwork();
        
    } else {

        $unique_string = md5(uniqid(rand(), true));
        
        $sql = $dataBase->prepare('UPDATE pr__user
                                   SET password_changekey = :change_key, password_changedate = :date
                                   WHERE email = :email');
        
        $sql->execute(array('change_key' => $unique_string,
                            'date' => date('Y-m-d H:i:s'),
                            'email' => $_POST['InputEmailRecover']));
        $sql->closeCursor();

        $configEmail['To'] = $_POST['InputEmailRecover'];
        $configEmail['ToName'] = ucfirst($user['firstname']).' '.ucfirst($user['lastname']);
        $configEmail['Subject'] = lg('Reset password on WebsiteName', NULL, FALSE);
        $configEmail['Title'] = lg('Hello', 'Global').' '.ucfirst($user['firstname']).',';
        $configEmail['box'][0]['Type'] = 'text';
        
        $configEmail['box'][0]['Content'] = lg('A request was received for reseting the password of your account on WebsiteName');

        $configEmail['box'][1]['Type'] = 'link';
        $configEmail['box'][1]['URL'] = get_URL().'/?key_passchange='.$unique_string;
        $configEmail['box'][1]['URLDesc'] = lg('Reset password');
        
        $configEmail['Template'] = 'email_templateBase';
        
        $catchError = email_send();

        ajax_emailSent($catchError);
        
    }
}

echo '
<script>
setTimeout(function() {
  $("#Bt'.$_POST['InputFrom'].'PasswordRecover").btn("reset");
  $(".btn").blur();
}, 2000);
</script>';


function ajax_emailSent($catchError) {
    global $config;
    
    echo '
<div id="DivPasswordSent" class="opa-0">
    <div class="p-4">';
    
    if($catchError != '') {

        echo 'Error sending email: '.$catchError;
        
    } else {
        echo '
    <p>
        '.lg('Email with a link to reset password sent to').' <span class="underline-mytheme mx-2">'.$_POST['InputEmailRecover'].'</span>.
    </p>
    <p class="fnt-0-9">
        <i class="fa fa-envelope mx-auto text-mytheme" style="font-size:100px;"></i><br>
        <p class="py-2 fnt-0-85">'.lg('This link can only be used once and must be used within the next 2 hours.', 'Global').'</p>
    </p>';
    }
    
    echo '
    </div>
</div>

<script>
setTimeout(function() {
  $("#DivPasswordSent").height($("#DivPasswordRecover").height());
  $("#Div'.$_POST['InputFrom'].'PasswordRecover").removeClass("dis-n").addClass("dis-n");
  $("#Ajax'.$_POST['InputFrom'].'Password").removeClass("dis-n");
  setTimeout(function() {$("#DivPasswordSent").fadeTo("fast",1);}, 1000);
},1000);
</script>';
}

function ajax_noEmailAccount() {

    echo '
<script>
setTimeout(function() {
  $("#DivErrorPasswordRecover").html("'.lg('There is no account with this email').'");
  $("#DivErrorPasswordRecover").fadeTo("slow", 1);
}, 1000);
</script>';
}

function ajax_acccountSocialNetwork() {
    global $userOAuth;

    echo '
<div id="DivSocialNetwork">
    <span class="pb-3 pt-3" style="color:#a94442;">'.lg('This email is associated to the Social Network:').' ';
    if($userOAuth['google_id'] != NULL) {
        echo '
        <span class="underline-mytheme mx-2" style="font-style:normal;">Google / Gmail</span>';
    }
    if($userOAuth['facebook_id'] != NULL) {
        echo '
        <span class="underline-mytheme mx-2" style="font-style:normal;">Facebook</span>';
    }
    echo '
    </span>
    <p class="fnt-0-9 pt-3">'.lg('You must use the Social Network button to log in.').'</p>
</div>';
    
    echo '
<script>
setTimeout(function() {
  $("#Span'.$_POST['InputFrom'].'EmailRecover").attr("style", "font-size:1.1em;opacity:0;");
  $("#Span'.$_POST['InputFrom'].'EmailRecover").html($("#DivSocialNetwork").html());
  $("#Span'.$_POST['InputFrom'].'EmailRecover").fadeTo("slow", 1);
},1000);
</script>';
    
}

?>
