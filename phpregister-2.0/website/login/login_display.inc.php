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

function show_login() {
    global $config, $jsDocumentReady, $jsScripts;

    $jsDocumentReady = '
$("#BodyPage").backstretch(["'.$config['ImagesURL'].'backgrounds/bg-login.jpg"], {centeredY: false, fade: 2000});';
    
    if(!check_bot()) {
        // Functions from global.inc.php
        $googleauthUrl = oauth_google();
        $facebookauthURL = oauth_facebook();
    }
    
    $jsDocumentReady .= '
$("#ModalPasswordRecover").on("hide.bs.modal", function (e) {
  $("#DivPasswordRecover").removeClass("dis-n");
  $("#AjaxPassword").removeClass("dis-n").addClass("dis-n");
  $("#AjaxPassword div").remove();
  $("#SpanEmailRecover").attr("style", "");
  $("#SpanEmailRecover").text("");
  $("#InputEmailRecover").val("");
  $("#FormPasswordRecover")[0].reset();
});
$("#FormSignIn").on("submit", function (e) {
  if (!e.isDefaultPrevented()) {
    $("#DivSigninError").css({"opacity":0});
    $("#BtSignIn").btn("loading");
    var values = $("form#FormSignIn").serialize();
    $.ajax({
      url: "'.$config['URL'].'/login/ajax/ajax_login.php",
      type: "POST",
      data: values,
      success: function (data) {
        $("#AjaxSignin").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });
  }
  e.preventDefault();
});
$("#FormPasswordRecover").on("submit", function (e) {
  if (!e.isDefaultPrevented()) {
    $("#BtPasswordRecover").btn("loading");
    var values = $("form#FormPasswordRecover").serialize();
    $.ajax({
      url: "'.$config['URL'].'/login/ajax/ajax_password_recover.php",
      type: "POST",
      data: values,
      success: function (data) {
        $("#AjaxPassword").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });
  }
  e.preventDefault();
});';
    
    $jsScripts .= '
function goBackSignin() {
  $("#DivSigninBody").css("opacity", "0");
  $("#DivSigninBody").removeClass("dis-n");
  $("#AjaxSignin").toggleClass("dis-n");
  $("#AjaxSignin div").remove();
  setTimeout(function() {$("#DivSigninBody").fadeTo("slow", 1);}, 1000);
}

function resendActivation() {
  $("#BtActivationResend").btn("loading");
  var values = $("form#FormActivationResend").serialize();
  $.ajax({
    url: "'.$config['URL'].'/login/ajax/ajax_activation_resend.php",
    type: "POST",
    data: values,
    success: function(data) {
      setTimeout(function() {
        $("#AjaxSignin div").remove();
        $("#AjaxSignin").html("").html(data);
        $("#DivActivationSent").css("opacity", "0");
        $("#DivAccountNotActivated").removeClass("dis-n").addClass("dis-n");
        $("#AjaxSignin").removeClass("dis-n");
        $("#BtActivationResend").btn("reset");
        setTimeout(function() {$("#DivActivationSent").fadeTo("slow", 1);}, 1000);
      }, 1000);
    }
  });
}';
    
    echo '
<div id="DivSignin" class="container my-3 my-sm-5">
    <div id="DivSigninBody">
        <div class="row" >
            <div class="col-sm-6">
                <div class="p-4 text-center"><h3 class="spacing-2 d-inline-block underline-title">'.lg('NEW AT').' '.$config['WebsiteName'].'?</div>
                '.lg('<p>Free and fast registration.<br>Get the latest news and security alerts.</p>').'
                <div class="pt-4"><a href="'.get_URL().'/signup"><button type="button" class="btn btn-mytheme btn-lg">'.lg('Create an account').'</button></a></div>
            </div>

            <div class="col-sm-6">
                <div class="p-4 text-center"><h3 class="spacing-3 d-inline-block underline-title">'.lg('ALREADY REGISTERED?').'</h3></div>
                <form action="#" id="FormSignIn"  name="FormSignIn" method="post">
                    <div class="form-group">
                        <span class="text-uppercase">'.lg('Email address', 'Global').'</span>
                        <input name="InputEmail" id="InputEmail" type="email" class="form-control input-grey py-sm-4 px-sm-3" required>
                        <div class="help-block with-errors fnt-0-9 fnt-ita">&nbsp;</div>
                    </div>
                    <div class="form-group" style="margin-top:-7px">
                        <span class="text-uppercase">'.lg('Password', 'Global').'</span>
                        <input name="InputPassword" id="InputPassword" type="password" class="form-control input-grey py-sm-4 px-sm-3" data-minlength="2" required>
                        <div class="help-block with-errors fnt-0-9 fnt-ita">&nbsp;</div>
                    </div>
                    <div class="float-left">
                        <button type="submit" id="BtSignIn" class="btn btn-mytheme btn-lg" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'"> '.lg('Log in', 'Global').'</button>
                        <div id="DivSigninError" class="fnt-0-95 text-danger pt-2" style="min-height:40px;opacity:0;"></div>
                    </div>
                    <div class="float-right mt-2">
                        <a data-toggle="modal" data-target="#ModalPasswordRecover" href="#" class="btn btn-outline-secondary btn-sm">'.lg('Password forgotten? ').'</a>
                    </div>
                    <div class="clearfix"></div>
                </form>';
    if(!check_bot()) {
        echo '
                <p class="pt-5">
                    <a class="btn btn-block btn-social btn-facebook btn-lg text-white" href="'.$facebookauthURL.'" style="width:100%;"><span class="fa fa-facebook"></span> '.lg('Log in with').' Facebook</a>
                </p>
                <p class="pt-2">
                    <a class="btn btn-block btn-social btn-google btn-lg text-white" href="'.$googleauthUrl.'" style="width:100%;"><span class="fa fa-google"></span> '.lg('Log in with').' Google</a>
                </p>';
    }
    echo '
            </div>
        </div>

    </div>

    <div id="AjaxSignin" class="dis-n"></div>

</div>';

    if(isset($_GET['do']) && ($_GET['do'] == 'passch') ){
        $jsDocumentReady .= '
    $("#ModalPasswordRecover").modal("show");';
    }
    echo '
<div class="modal modal-mytheme modal-responsive fade" id="ModalPasswordRecover" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-lock pr-4 fnt-1-5 align-middle"></i>'.lg('Reset password').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="DivPasswordRecover" class="p-4">
                    <form method="post" id="FormPasswordRecover" name="FormPasswordRecover" action="#/">
                    <p>'.lg('An email with a link to create a new password will be sent to you.').'</p>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >'.lg('Email', 'Global').'</span>
                            </div>
                            <input name="InputEmailRecover" type="email" class="form-control input-grey rounded-right" required>
                        </div>
                        <div id="DivErrorPasswordRecover" class="fnt-0-9 text-danger" style="height:50px;"></div>
                    </div>
                    <div class="pb-4">
                        <button id="BtPasswordRecover" class="btn btn-mytheme" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button>
                    </div>
                    </form>
                </div>
                <div id="AjaxPassword" class="dis-n"></div>
            </div>
        </div>
    </div>
</div>';
    
    // Activation Account Link
    if( isset($_GET['key_act']) && ($_GET['key_act'] != '') ){
        
        $jsDocumentReady .= '
var values = { "key_act": "'.$_GET['key_act'].'", "key_eml": "'.$_GET['key_eml'].'"};
$.ajax({
  url: "'.$config['URL'].'/login/ajax/ajax_activation_check.php",
  type: "POST",
  data: values,
  success: function(data) {
    $("#DivActivationCheck").empty().html(data);
    $("#ModalActivateAccount").modal("show");
  }
});';
        
        echo '
<div class="modal modal-mytheme modal-responsive fade" id="ModalActivateAccount" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">'.lg('Account activation').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivActivationCheck">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">'.lg('Close', 'Global').'</button>
            </div>
        </div>
    </div>
</div>';
    }

}

?>
