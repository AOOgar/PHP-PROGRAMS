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

$sql = $dataBase->prepare('SELECT pr__user.id, pr__user.firstname, pr__user.password, pr__user.account_deletedate,
                                  pr__user_oauth.facebook_id, pr__user_oauth.google_id
                           FROM pr__user
                           LEFT JOIN pr__user_oauth ON pr__user.id = pr__user_oauth.user_id
                           WHERE pr__user.account_deletekey = :key');

$sql->execute(array('key' => $_POST['key_delaccount']));
$user = $sql->fetch();
$sql->closeCursor();


if($user) {
    
    /*
     * We if the Key has expired.
     */
    if(!check_dateExpired($user['account_deletedate'],
                           $config['ExpiryKeyDelAccount'])) {        
        $sql = $dataBase->prepare('UPDATE pr__user
                                   SET
                                       account_deletekey = :key_del,
                                       account_deletedate = :date_del

                                   WHERE account_deletekey = :key');
        
        $sql->execute(array('key_del'   => NULL,
                            'date_del'  => NULL,
                            'key'       => $_POST['key_delaccount']));

        ajax_accountDeletionKeyInvalid();
        exit;
    }
    
} else {

    ajax_accountDeletionKeyInvalid();
    exit;
}

if($_POST['do'] == 'askdeletion') {

    if($user['password'] == NULL) {
        /**
         *  It's a Social Media Account
         */
        if(get_userIdSession() == $user['id']) {
            
            ajax_accountDeletionSocialMediaConfirm();
            
        } else {
            /**
             *  SESSION['user_id'] does not correspond to this Key / Account user_id
             */
            ajax_accountDeletionSocialMediaInvalid();
            
        }

    } else {
        /**
         *  It's an Email/Password account
         *  We ask for the Password Account before deleting the account
         */

        ajax_accountDeletionConfirm();        

    }
        
} else if($_POST['do'] == 'deleteaccount') {

    if($user['password'] == NULL) {
        if(get_userIdSession() == $user['id']) {
            /**
             *  It's a Social Media Account
             */
            del_account($user['id']); /* Function from file global.inc.php*/
            ajax_accountDeleted();
            sess_delete();
        }
    } else {
        /**
         *  It's an Email/Password account
         *  We check if the Password is valid
         */
        if(($_POST['InputPassword'] != '') &&
           ($user['password'] != hash_password($_POST['InputPassword']))) {
            /**
             * Password is not valid
             */
            ajax_passwordError();
            
        } else {
            del_account($user['id']); /* Function from file global.inc.php*/
            ajax_accountDeleted();
            sess_delete();
        }
        
    }
    
}

function ajax_accountDeleted() {
    global $config, $user;
    
    echo '
<div id="DivAjaxAccountDeletion" class="opa-0">
    <p class="pt-4 text-center">
        <i class="fa fa-trash-o text-danger" style="font-size:80px;"></i>
    </p>
    <p class="py-4 text-center fnt-1-1">'.lg('Your account and all details of your account have been deleted.').'</p>
</div>
<script>
$("#ModalAccountDeletion").on("hide.bs.modal", function () {
    window.location.replace("'.get_URL().'");
});
$(".modal-backdrop").attr("style", "background: #e7e7e7;opacity:1;");
setTimeout(function() {
  $("#DivModalBodyDeletion").empty();
  $("#DivAjaxAccountDeletion").appendTo($("#DivModalBodyDeletion"));
  setTimeout(function() {$("#DivAjaxAccountDeletion").fadeTo("fast",1);}, 1000);
}, 2000);
</script>';
}

function ajax_passwordError() {
    
    echo '
<script>
setTimeout(function() {
  $("#DivErrorPassword").fadeTo("slow", 1);
  $("#BtAccountDeletion").btn("reset");
}, 1000);
</script>';
                
}

function ajax_accountDeletionConfirm() {
    global $config;
    
    echo '
<div id="DivAjaxAccountDeletion">
    <div class="row">
        <div class="col-sm-2 text-center">
            <i class="fa fa-trash fa-3x pr-4"></i>
        </div>
        <div class="col-sm-10">
            <p>'.lg('We are sorry to see you go, are you sure you want to delete your account?').'</p>
            <p class="text-center bg-warning rounded-lg my-4 py-4 fnt-1-2">'.lg('The deletion will be final').'</p>
            <form id="FormAccountDeletion" action="" method="post">
            <p class="text-left">'.lg('Please, enter your password to confirm:').'</p>
            <div class="form-group">
                <input name="InputPassword" id="InputPassword" type="password" class="form-control input-grey" style="width:100%;" required>
                <div id="DivErrorPassword" class="text-danger pt-1 fnt-0-85 opa-0" style="height:35px;">'.lg('Invalid password').'</div>
            </div>
            <div>
                <button id="BtAccountDeletion" class="btn btn-mytheme" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
$("#DivAjaxAccountDeletion").appendTo($("#DivModalBodyDeletion"));
$("#ModalAccountDeletion").modal("show");
$("#FormAccountDeletion").on("submit", function(e) {
  $("#BtAccountDeletion").btn("loading");
  $("[id^=\'DivError\']").css({"opacity":0});
  var values = {"do":  "deleteaccount", "key_delaccount": "'.$_POST["key_delaccount"].'", "InputPassword": $("#InputPassword").val()};
  $.ajax({
      url: "'.$config['URL'].'/home/ajax/ajax_account_deletion.php", type: "POST", data: values,
      success: function(data) {
        $("#AjaxAccountDeletion").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
  });
  e.preventDefault();
});
</script>';
}

function ajax_accountDeletionKeyInvalid() {
    global $config;
    
    echo '
<div id="DivAjaxAccountDeletion">
    <p class="pt-3">'.lg('This link to delete your WebsiteName account is no longer valid or is incorrect.').'</p>
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
  $("#ModalAccountDeletion").modal("hide");
  setTimeout(function() { window.location.href = "'.get_URL().'/login/"; }, 1000);
}
function goToAccount() {
  $("#ModalAccountDeletion").modal("hide");
  setTimeout(function() { window.location.href = "'.get_URL().'/account/profile/"; }, 1000);
}
$("#DivAjaxAccountDeletion").appendTo($("#DivModalBodyDeletion"));
$("#ModalAccountDeletion").modal("show");
</script>';

}

function ajax_accountDeletionSocialMediaConfirm() {
    global $config;

    echo '
<div id="DivAjaxAccountDeletion">
    <div class="row">
        <div class="col-sm-2 text-center">
            <i class="fa fa-trash fa-3x pr-4"></i>
        </div>
        <div class="col-sm-10">
            <p>'.lg('We are sorry to see you go, are you sure you want to delete your account?').'</p>
            <p class="text-center bg-warning rounded-lg my-4 py-4 fnt-1-2">'.lg('The deletion will be final').'</p>
            <div id="DivAccountDeleteConfirm" class="custom-control custom-checkbox pt-3">
                <input id="CheckboxAccountDelete" type="checkbox" class="custom-control-input">
                <label id="LabelDeleteConfirm" class="custom-control-label" for="CheckboxAccountDelete">'.lg('Yes, delete my account now').'</label>
            </div>
            <p class="pt-4 text-center"><button id="BtAccountDeletionConfirm" onClick="submitAccountDeletion();" class="btn btn-danger" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button></p>
        </div>
    </div>
</div>
<script>
$("#DivAjaxAccountDeletion").appendTo($("#DivModalBodyDeletion"));
$("#ModalAccountDeletion").modal("show");
function submitAccountDeletion() {
  if($("#CheckboxAccountDelete").is(":checked")) {
    $("#BtAccountDeletionConfirm").btn("loading");
    var values = { "do": "deleteaccount", "key_delaccount": "'.$_POST['key_delaccount'].'" };
    $.ajax({
      url: "'.$config['URL'].'/home/ajax/ajax_account_deletion.php", type: "POST", data: values,
      success: function(data) {
        setTimeout(function () {
          $("#AjaxAccountDeletion div").remove();
          $("#AjaxAccountDeletion").html("").html(data);
        }, 1000);
      },
      error: function(exception) { console.log(exception); }
    });
  } else {
    $("#LabelDeleteConfirm").addClass("text-danger");
    $("#LabelDeleteConfirm").blink(2);
  }
}
</script>';
}


function ajax_accountDeletionSocialMediaInvalid() {
    global $config, $user;
    
    echo '
<div id="DivAjaxAccountDeletion">
    <p>'.ucfirst($user['firstname']).',</p>
    <p>This link to delete your '.$config['WebsiteName'].' account does not correspond to this session.</p>
    <p>To delete your account, you must first <strong>Log In</strong> with this browser.</p>
    <p>Your account is associated to the social network:';

    if($user['google_id'] != NULL) {
        echo '<span class=\'underline-mytheme mx-2\'>Google</span>';
    }

    if($user['facebook_id'] != NULL) {
        echo '<span class=\'underline-mytheme mx-2\'>Facebook</span>';
    }

    echo '
    </p>
</div>

<script>
$("#DivAjaxAccountDeletion").appendTo($("#DivModalBodyDeletion"));
$("#ModalAccountDeletion").modal("show");
</script>';


}


?>
