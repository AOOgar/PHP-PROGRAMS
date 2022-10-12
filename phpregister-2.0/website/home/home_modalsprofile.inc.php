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

function show_modalPasswordChange() {
    global $config, $jsScripts, $jsDocumentReady, $jsWindowLoaded;
    
    $jsScripts .= '
function showModalPasswordChange() {
  var values = {"do": "showchange", "key_passchange": "'.$_GET['key_passchange'].'" };
  $.ajax({
    url: "'.$config['URL'].'/home/ajax/ajax_password_change.php",
    type: "POST",
    data: values,
    success: function(data) {
      $("#AjaxPasswordChange").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}';

    $jsDocumentReady .= '
showModalPasswordChange();';
    
    echo '
<div class="modal modal-mytheme modal-responsive fade" id="ModalPasswordChange" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">'.lg('Change your WebsiteName password').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivModalBodyPasswordChange">
            </div>
        </div>
    </div>
</div>
<div id="AjaxPasswordChange" class="dis-n"></div>';
}

function show_modalEmailChange() {
    global $config, $jsScripts, $jsDocumentReady, $jsWindowLoaded;
    
    $jsScripts .= '
function showModalEmailChange() {
  var values = {"do": "showchange", "key_emlchange": "'.$_GET['key_emlchange'].'" };
  $.ajax({
    url: "'.$config['URL'].'/home/ajax/ajax_email_change.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxEmailChange").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}';

    $jsDocumentReady .= '
showModalEmailChange();';

    echo '
<div class="modal modal-mytheme modal-responsive fade" id="ModalEmailChange" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user fnt-1-5 pr-4 align-middle"></i>'.lg('Change your WebsiteName email').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivModalBodyEmailChange">
            </div>
        </div>
    </div>
</div>
<div id="AjaxEmailChange" class="dis-n"></div>';
}


function show_modalLogAsPassword() {
    global $config, $jsScripts, $jsDocumentReady, $jsWindowLoaded, $userLogAs;

    $jsWindowLoaded .= '
$("#FormLogAs").on("submit", function (e) {
  e.preventDefault();
  $("#BtLogAsPassword").btn("loading");
  var values = {"key": "'.$_GET['key'].'",
                "InputLogAsPassword": $("#InputLogAsPassword").val()};
  $("#DivLogAsError").html("");
  $.ajax({
    url: "'.$config['URL'].'/home/ajax/ajax_logas.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxLogAsKey").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});';

    $jsDocumentReady .= '
$("#ModalLogAsPassword").modal("show");';

    echo '
<div class="modal modal-mytheme modal-responsive fade" id="ModalLogAsPassword" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user fnt-1-5 pr-4 align-middle"></i>Login as another user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> ';
    if(empty($userLogAs)) {

        echo '<div class="p-5 text-center fnt-1-4">Invalid key</div>';

    } else {
        echo '
               <div class="p-3 text-center">User: <strong>'.ucfirst($userLogAs['firstname']).' '.ucfirst($userLogAs['lastname']).'</strong></div>

    <form id="FormLogAs" action="" method="post" onSubmit="return false;">
    <p class="text-left pb-3">You must enter the Login as password</p>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" >'.lg('Password', 'Global').'</span>
            </div>
            <input name="InputLogAsPassword" id="InputLogAsPassword" type="password" class="form-control input-grey rounded-right" data-error="" style="max-width:300px;" required>
        </div>
        <div id="DivLogAsError" class="help-block with-errors mt-0 text-danger fnt-0-85" style="height:25px;"><i></i></div>
    </div>
    <div>
        <button id="BtLogAsPassword" onClick="submitEmailChange();" class="btn btn-mytheme mt-4" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button>
    </div>
    </form>';
    }
        echo '

            </div>
        </div>
    </div>
</div>
<div id="AjaxLogAsKey" class="dis-n"></div>';

}


function show_modalAccountDelete() {
    global $config, $jsWindowLoaded, $jsDocumentReady, $jsScripts;

    $jsScripts .= '
function showModalAccountDeletion() {
    var values = {"do": "askdeletion", "key_delaccount": "'.$_GET['key_delaccount'].'" };
    $.ajax({
        url: "'.$config['URL'].'/home/ajax/ajax_account_deletion.php", type: "POST", data: values,
        success: function(data) {
            $("#AjaxAccountDeletion").empty().html(data);
        },
        error: function(exception) { console.log(exception); }
    });
}';

    $jsDocumentReady .= '
showModalAccountDeletion();';

    echo '
<div class="modal modal-mytheme modal-responsive fade" id="ModalAccountDeletion" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user fnt-1-5 pr-4 align-middle"></i>'.lg('Deletion of your account').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivModalBodyDeletion">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">'.lg('Close', 'Global').'</button>
            </div>
        </div>
    </div>
</div>
<div id="AjaxAccountDeletion" class="dis-n"></div>';
}








?>
