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
include_once (_PATHROOT.'signup/signup_global.inc.php');

init_langVars(['Profile', 'Signup']);

if(!isset($_SESSION['UserId'])) { 
    echo '<script>window.location.href = "'.get_URL().'/account";</script>';
    exit;
}

$sql = $dataBase->prepare('SELECT pr__user.password
                           FROM pr__user
                           WHERE pr__user.id = :id');
$sql->execute(['id' => get_userIdSession()]);
$userPassword = $sql->fetch()['password'];
$sql->closeCursor();

if($userPassword != NULL) {
    $sql = $dataBase->prepare('SELECT COUNT(id) AS number
                               FROM pr__user
                               WHERE id = :id AND password = :password');

    $sql->execute(['id'       => get_userIdSession(),
                   'password' => hash_password($_POST['InputPasswordCurrent'])]);

    $user = $sql->fetch();
    $sql->closeCursor();
    
    if($user['number'] == 0) {
        ajax_passwordError(lg('Incorrect current password'));
        exit;
    }
}

$passwordError = check_passwordStrength($_POST['InputPasswordNew1']);

if($passwordError === NULL) {
    if($_POST['InputPasswordNew1'] != $_POST['InputPasswordNew2']) {
        ajax_passwordError(lg('The new password and its confirmation are not identical'));
        exit;
    }
} else {
    ajax_passwordError($passwordError);
    exit;
}

$sql = $dataBase->prepare('UPDATE pr__user
                           SET
                              password = :password
                           WHERE id = :id');
        
$sql->execute(['password' => hash_password($_POST['InputPasswordNew1']),
               'id'       => get_userIdSession()]);
$sql->closeCursor();

ajax_passwordUpdated();

function ajax_passwordUpdated() {
    
    echo '
<script>
setTimeout(function() {
  $(".div-cpass").removeClass("dis-n"); //In case of new password for account from Social account without password
  $("#BtPassword").btn("reset");
  setTimeout(function() {
    $("#InputPasswordCurrent").val("");
    $("#InputPasswordNew1").val("");
    $("#InputPasswordNew2").val("");
    $("#BtPassword").popover({
       html: true,
       trigger: "click",
       content: "'.lg('﻿Successfully changed password').'"
    });
    $("#BtPassword").popover("toggle");
    setTimeout(function() {
        $("#BtPassword").popover("toggle");
    }, 3000);
  }, 500);
}, 1500);
</script>';
    
}

function ajax_passwordError($errorText) {
    echo '
<script>
setTimeout(function() {
  $("#DivErrorPassword").html("'.$errorText.'");
  $("#DivErrorPassword").fadeTo("slow", 1);
  setTimeout(function() {$("#BtPassword").btn("reset");}, 1000);
}, 1000);
</script>';
}

?>
