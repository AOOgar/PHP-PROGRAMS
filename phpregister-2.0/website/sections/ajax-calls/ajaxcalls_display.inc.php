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


function show_ajaxcalls() {
    global $config, $sessionUser, $jsDocumentReady;

    echo '
<div class="container my-5 documentation">
    <h4>Get firstname of current user </h4>
    <button id="BtGetFirstname" class="btn btn-outline-secondary" style="width:200px;" data-loading-text="<span class=\'fa fa-spinner fa-spin fa-lg mr-2\'></span>Get in progress">Get firstname</button>
    <div id="DivFirstnameResult" class="ml-4 d-inline-block"></div>';
    $jsDocumentReady .= '
$("#BtGetFirstname").on("click", function() {
  $("#BtGetFirstname").btn("loading");
  $("#DivFirstnameResult").addClass("dis-n");
  $.ajax({
    url: "'.$config['URL'].'/sections/ajax-calls/ajax/ajax_get_firstname.php",
    success: function(data) {
      $("#DivFirstnameResult").empty().html(data);
    }
  });  
});';

    echo '
<div class="modal modal-mytheme fade" id="ModalDynamic" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal with dynamic content: <span id="SpanCountWords"></span> words</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivModalBodyDynamic">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">'.lg('Close', 'Global').'</button>
            </div>
        </div>
    </div>
</div>
    <hr>
    <h4>Open a modal with dynamic content</h4>
    <button id="BtModalDynamic" class="btn btn-outline-secondary" style="width:200px;">Open modal</button>';

    $jsDocumentReady .= '
$("#BtModalDynamic").on("click", function() {
  $.ajax({
    url: "'.$config['URL'].'/sections/ajax-calls/ajax/ajax_openmodal.php",
    success: function(data) {
      $("#DivModalBodyDynamic").empty().html(data);
    }
  });  
});';


    echo '
    <hr>
    <div id="AjaxPassword" class="dis-n"></div>
    <h4>Using setTimeout</h4>
    <p>The JavaScript function setTimeout is often used on Ajax calls for user experience only. If the button has no loading step for at least 1 second, users might think that nothing happened!</p>
    <p>Check your password with setTimeout:</p>
    <form method="post" id="FormPasswordCheck" name="FormPasswordCheck" action="#/">
    <div class="form-group" style="width:100%;max-width:400px;">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Password</span>
            </div>
            <input name="InputPassword" type="password" class="form-control input-grey" required>
            <div class="input-group-append">
                <button id="BtCheckSetTimeout" class="btn btn-mytheme" style="width:90px;" data-loading-text="<span class=\'fa fa-spinner fa-spin fa-lg\'></span>">Check</button>
            </div>
        </div>
        <div id="DivPasswordCheck" class="fnt-0-9 pt-1" style="height:40px;"></div>
    </div>
    </form>';

    $jsDocumentReady .= '
$("#FormPasswordCheck").on("submit", function (e) {
  if (!e.isDefaultPrevented()) {
    $("#BtCheckSetTimeout").btn("loading");
    $("#DivPasswordCheck").empty();
    var values = $("#FormPasswordCheck").serialize();
    $.ajax({
      url: "'.$config['URL'].'/sections/ajax-calls/ajax/ajax_passwordcheck_settimeout.php", type: "POST", data: values,
      success: function (data) {
        $("#AjaxPassword").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });
  }
  e.preventDefault();
});';

echo '
    <p>Check your password without setTimeout:</p>
    <form method="post" id="FormPasswordCheck2" name="FormPasswordCheck2" action="#/">
    <div class="form-group" style="width:100%;max-width:400px;">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Password</span>
            </div>
            <input name="InputPassword2" type="password" class="form-control input-grey" required>
            <div class="input-group-append">
                <button id="BtCheckSetTimeout2" class="btn btn-mytheme" style="width:90px;" data-loading-text="<span class=\'fa fa-spinner fa-spin fa-lg\'></span>">Check</button>
            </div>
        </div>
        <div id="DivPasswordCheck2" class="fnt-0-9" style="height:40px;"></div>
    </div>
    </form>';

    $jsDocumentReady .= '
$("#FormPasswordCheck2").on("submit", function (e) {
  if (!e.isDefaultPrevented()) {
    $("#BtCheckSetTimeout2").btn("loading");
    $("#DivPasswordCheck2").empty();
    var values = $("#FormPasswordCheck2").serialize();
    $.ajax({
      url: "'.$config['URL'].'/sections/ajax-calls/ajax/ajax_passwordcheck_nosettimeout.php", type: "POST", data: values,
      success: function (data) {
        $("#AjaxPassword").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });
  }
  e.preventDefault();
});';

    echo '
    <hr>
    <div id="AjaxPHPError" class="dis-n"></div>
    <h4>PHP Error in Ajax call</h4>
    <p>There are several way to check if an Ajax call has an PHP Error. Check the web server logs, or display the data returned by the call Ajax in an <strong>alert</strong> or in <strong>console.log</strong>. Of course, display of PHP errors must be set to 1 in <strong>config.inc.php</strong>:</p>
    <p><pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/config_show_errors.inc.php.txt"></pre></p>
    <button id="BtPHPError" class="btn btn-outline-secondary" style="width:200px;" data-loading-text="<span class=\'fa fa-spinner fa-spin fa-lg mr-2\'></span>Get in progress">Display PHP Error</button>
    <p class="pt-2">If you get an Internal server error instead of PHP errors in page, your <strong>php.ini</strong> file must set display_errors to on:</p>
    <p><pre class="okaidia-block language-bash" data-src="'.$config['URL'].'/include/show-code/php.ini-display_errors.txt"></pre></p>';

    $jsDocumentReady .= '
$("#BtPHPError").on("click", function() {
  $("#BtPHPError").btn("loading");
  $("#DivResultSendEmailLang").empty();
  $.ajax({
    url: "'.$config['URL'].'/sections/ajax-calls/ajax/ajax_phperror.php",
    success: function(data) {
      alert(data);
      console.log(data);
      $("#AjaxPHPError").empty().html(data);
    }
  });  
});';

    echo '
    <hr>
    <div id="AjaxSendEmail" class="dis-n"></div>
    <h4>Send yourself an email in different languages</h4>';
    if(!isset($_SESSION['UserId'])) {
        // Redirect to this page after Login...
        $redirectLink = urlencode(encrypt($_SERVER['REQUEST_URI'], $config['KeyOAuthRedirect']));
        echo '
    <p>You are not connected. Please connect to test this Ajax call.<br> <a href="'.get_URL().'/login/?r='.$redirectLink.'" "><button class="btn btn-mytheme">Login</button></a></p>
    <p>This link to Login page contains a rediretion to get back to this page after login:</p>
    <p><pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/link-login-redirect.php.txt"></pre></p>';
        
    } else {
        if($sessionUser['email'] == NULL) {
            echo '
    <p>Your account is a Social Network ('.ucfirst($_SESSION['type']).') account without email set. Please set an email to your account profile.<br>
       <a href="'.get_URL().'/account/profile/"><button class="btn btn-mytheme">Account profile</button></a></p>';
        } else {

            $jsDocumentReady .= '
$("#BtSendEmailLang").on("click", function() {
  $("#BtSendEmailLang").btn("loading");
  $("#DivResultSendEmailLang").empty();
  var values = $("#FormSendEmailLang").serialize();
  $.ajax({
    url: "'.$config['URL'].'/sections/ajax-calls/ajax/ajax_sendmail.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxSendEmail").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});';
            
            echo '
    <div id="AjaxSendEmail" class="dis-n"></div>
    <p>Sending an email to <span class="underline-mytheme">'.$sessionUser['email'].'</span>:</p>
    <form method="post" id="FormSendEmailLang" name="FormSendEmailLang" action="#/">
    <div class="input-group input-group-sm">
         <div class="input-group-prepend">
             <select id="SelectLang" name="SelectLang" class="custom-select select-grey">
                 <option value="">User lang ('.ucfirst($config['LangsNames'][$config['UserLang']]).')</option>';
            foreach($config['Langs'] as $oneLang) {
                if($oneLang != $config['UserLang']) {
                    echo '
                 <option value="'.$oneLang.'">'.ucfirst($config['LangsNames'][$oneLang]).'</option>';;
                }
            }
            echo '
             </select>
         </div>
         <div class="input-group-append">
             <button id="BtSendEmailLang" type="button" class="btn btn-info btn-sm" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'" style="min-width:120px;"><i class="fa fa-envelope fnt-1-2 pr-3"></i>'.lg('Send', 'Global').'</button>
         </div>
    </div>
     
    </form>';
            
        }

    echo '
    <div id="DivResultSendEmailLang" style="min-height:30px;"></div>
    <p><span class="underline-mytheme">Ajax file: ajax/ajax_sendmail.php:</span></p>
    <p>We require the needed php files to get the user lang and to send an email. Then we initialize the language variables:</p>
    <p><pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/ajax-sendemail-requires.php.txt"></pre></p>
    <p>We prepare the content of the email:</p>
    <p><pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/ajax-sendemail-content.php.txt"></pre></p>
    <p>We send the email and get any send error in variable $catchError that we check:</p>
    <p><pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/ajax-sendemail-catcherror.php.txt"></pre></p>';
    }
    
    echo '
</div>';

}











?>
