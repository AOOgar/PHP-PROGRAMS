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

function show_signup() {
    global $config, $jsDocumentReady, $jsWindowLoaded, $jsScripts, $jsWindowResize;

    if(!check_bot()) {
        // Functions from global.inc.php
        $googleauthUrl = oauth_google();
        $facebookauthURL = oauth_facebook();
    }
    

    $jsWindowLoaded .= '
$("body").on("submit", "#FormAccountCreate", function(e) {
  $("[id^=\'DivError\']").html("");
  $("#BtAccountCreate").btn("loading");
  var values = $("body #FormAccountCreate").serialize();
  $.ajax({';
  //We cut the ajax URL link to create account to prevent execution from bots
    $jsWindowLoaded .='
      url: "'.$config['URL'].'/sig" + "nup/aja" + "x/ajax" + "_account" + "_create.php",
      type: "POST",
      data: values,
      success: function(data) {
        $("#AjaxSignup").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
  e.preventDefault();
});';

    // We wait 3 seconds before changing the Form Id to prevent execution from bots
    // That should work for most of bots, even if they execute the javascript, I don't think
    // that they will analyse the code to check if they have to wait 3 seconds before sending the form 
    $jsDocumentReady .= '
setTimeout(function() {
  $("#FormAccountCreateTmp").attr("id", "FormAccountCreate");
}, 3000);';

    echo '
<div id="DivSignup" class="container my-2 my-sm-5" style="max-width:900px;">
    <div id="DivSignupBody">
        <div class="p-2 mb-4">
            <form action="#" id="FormAccountCreateTmp"  method="post">
            <div class="p-4 text-center"><h3 class="spacing-2 d-inline-block underline-title text-uppercase">'.lg('Create an account', 'Log in').'</h3></div>
            <div class="pb-3 text-right fnt-1-1">'.lg('With an email and password').'</div>
            <div class="form-group">
                <span class="text-uppercase">'.lg('Firstname', 'Global').'</span>
                <input name="InputFirstname" type="text" class="form-control input-grey py-sm-4 px-sm-3" data-minlength="2" required>
            </div>
            <div class="form-group">
                <span class="pb-2 text-uppercase">'.lg('Lastname', 'Global').'</span>
                <input name="InputLastname" type="text" class="form-control input-grey mb-4 py-sm-4 px-sm-3" data-minlength="2" required>
            </div>
            <div class="form-group">
                <span class="text-uppercase">'.lg('Email address', 'Global').'</span>
                <input name="InputEmail" type="email" class="form-control input-grey py-sm-4 px-sm-3" required>
                <div id="DivErrorEmail" class="text-danger"></div>
            </div>
            <div class="form-group password">
                <span class="text-uppercase">'.lg('Password', 'Global').'</span>
                <input name="InputPassword" type="password" class="form-control input-grey py-sm-4 px-sm-3" data-minlength="4" required>
                <div class="text-italic fnt-0-8">'.lg('Minimum 6 characters, with at least 1 digit and a special character such as: ! # @ - _.').'</div>
                <div id="DivErrorPassword" class="text-danger"></div>
            </div>
            <div class="mt-4">
                <button type="submit" id="BtAccountCreate" class="btn btn-mytheme btn-lg" data-loading-text="<span class=\'fa fa-spinner fa-spin fa-lg mr-2\'></span>'.lg('Sending', 'Global').'">'.lg('Create my account', 'Signup').'</button>
            </div>
             <div class="mt-2 fnt-0-95 terms">'.lg('By signing up, you agree to the <a href="#/" data-toggle="modal" data-target="#Modal...').'</div>
            </form>
            <div class="text-right mt-5 fnt-1-1">
                '.lg('In only one click with one social network').'
            </div>';
    if(!check_bot()) {
        echo '
            <div class="row mb-4">
                <div class="col-sm-6 pt-3">
                    <a class="btn btn-block btn-social btn-facebook btn-lg text-white" style="max-width:500px;" href="'.$facebookauthURL.'"><span class="fa fa-facebook pad-t-5"></span> '.lg('Sign up with').' Facebook</a>
                </div>
                <div class="col-sm-6 pt-3">
                    <a class="btn btn-block btn-social btn-google btn-lg text-white" style="max-width:500px;" href="'.$googleauthUrl.'"><span class="fa fa-google pad-t-5"></span> '.lg('Sign up with').' Google</a>
                </div>
            </div>';
    }
    echo '
        </div>
        <div id="AjaxSignup" class="dis-n"></div>
    </div>
</div>';
    
    echo '
<div class="modal modal-responsive modal-mytheme fade" id="ModalTerms" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">'.lg('Terms of use', 'Global').' & '.lg('Privacy Policy', 'Terms').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<h1>'.lg('Terms of use', 'Global').'</h1>
'.lg('Terms of use - Content', 'Terms').'
<hr>
<h1>'.lg('Privacy Policy', 'Terms').'</h1>
'.lg('Privacy Policy - Content', 'Terms').'

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-mytheme rounded-0" data-dismiss="modal">'.lg('Close', 'Global').'</button>
            </div>
        </div>
    </div>
</div>';

}
?>
