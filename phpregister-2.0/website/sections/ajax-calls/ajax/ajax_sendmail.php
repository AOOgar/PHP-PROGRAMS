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

/* Require of global_cookies PHP file to get the Lang of current user */
require_once (_PATHROOT.'include/php/global_cookies.inc.php');

/* Require of global_email to initialize PHPMailer and Html2Text to send emails */
require_once (_PATHROOT.'include/php/emails/global_email.inc.php');

/* We initialize the language variables of pages 'Log in', 'Signup', 'Admin', 'Global'.
 * For performance reason, in the `else` we don't initialize language variables in
 * all languages but in only the Selected lang. For sending emails in any language,
 * initialize language variables in all languages, example:
   init_langVars(['Log in', 'Signup', 'Admin', 'Global'], ['en', 'fr', 'es']);
 */
if($_POST['SelectLang'] == NULL) {
    init_langVars(['Log in', 'Signup', 'Admin', 'Global']);
} else {
    init_langVars(['Log in', 'Signup', 'Admin', 'Global'], [$_POST['SelectLang']]);
}

/**
   We configure the receiver which is the connected user:
 */

$configEmail['To'] = $sessionUser['email'];
$configEmail['ToName'] = ucfirst($sessionUser['firstname']).' '.ucfirst($sessionUser['lastname']);

/**
 * Name of the function that will be called to create the content HTML of the email.
 * By default this function is `email_templateBase` and its not usefull to set it 
 * with this value!
   $configEmail['Template'] = 'email_templateBase';
 */

if($_POST['SelectLang'] == NULL) {

    /*
     * The 3rd argument is `FALSE` not to send an email with the onClick JavaScript event on Translate Id.
     * This event is displayed in HTML when an Admin active the `Show Translate Ids` from top Menu.
     */
    $configEmail['Subject'] = lg('Your account has been created', 'Signup', FALSE);
    $configEmail['Title'] = lg('NEW AT', NULL, FALSE).' WebsiteName?';
    $configEmail['box'][0]['Type'] = 'text';
    $configEmail['box'][0]['Content'] = lg('This account is already activated', 'Log in', FALSE);

    $configEmail['box'][1]['Type'] = 'link';
    $configEmail['box'][1]['URL'] = get_URL();
    $configEmail['box'][1]['URLDesc'] = lg('Home', 'Global', FALSE);
    
    $configEmail['box'][3]['Type'] = 'text';
    $configEmail['box'][3]['Content'] = lg('Thank you, <br> The WebsiteName team', 'Global', FALSE);

} else {

    $configEmail['Subject'] = lg('Your account has been created', 'Signup', FALSE, $_POST['SelectLang']);
    $configEmail['Title'] = lg('NEW AT', NULL, FALSE, $_POST['SelectLang']).' WebsiteName?';
    $configEmail['box'][0]['Type'] = 'text';
    $configEmail['box'][0]['Content'] = lg('This account is already activated', 'Log in', FALSE, $_POST['SelectLang']);

    $configEmail['box'][1]['Type'] = 'link';
    $configEmail['box'][1]['URL'] = get_URL();
    $configEmail['box'][1]['URLDesc'] = lg('Home', 'Global', FALSE, $_POST['SelectLang']);
    
    $configEmail['box'][3]['Type'] = 'text';
    $configEmail['box'][3]['Content'] = lg('Thank you, <br> The WebsiteName team', 'Global', FALSE, $_POST['SelectLang']);

}

$catchError = email_send();

echo '
<div id="DivAjaxEmail">';
if($catchError == '') {
    // if `$_POST['SelectLang']` is NULL, then the language display will be the user lang.
    // The 3rd argument is `TRUE` to show a clickable Translate Id.
    echo '
    <span class="text-success font-weight-bold">'.lg('Email sent!', 'Admin', TRUE, $_POST['SelectLang']).'</span>';

} else {
    echo '
    <span class="text-danger">Error sending email</span>: '.$catchError;
}

echo '
</div>
<script>
setTimeout(function() {
  $("#BtSendEmailLang").btn("reset");
  $("#DivAjaxEmail").appendTo($("#DivResultSendEmailLang"));
}, 1500);
</script>';


?>
