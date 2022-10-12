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

/**
 *  Resend Link to activate account
 */

define('_PATHROOT', '../../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');
require_once (_PATHROOT.'include/php/emails/global_email.inc.php');

init_langVars(['Log in', 'Signup']);

$sql = $dataBase->prepare('SELECT firstname, lastname, activation_key
                           FROM pr__user
                           WHERE email = :email');

$sql->execute(array('email' => $_POST['InputActivationEmail']));
$user = $sql->fetch();

echo '
<div id="DivActivationSent">';

if($user) {

    $configEmail['To'] = $_POST['InputActivationEmail'];
    $configEmail['ToName'] = $user['firstname'].' '.$user['lastname'];
    $configEmail['Subject'] = lg('Account activation on', NULL, FALSE).' '.$config['WebsiteName'];
    $configEmail['Title'] = lg('You\'re on your way! <br>Let\'s confirm your email address.', 'Signup', FALSE);
    $configEmail['box'][0]['Type'] = 'text';
    $configEmail['box'][0]['Content'] = lg('You asked for a new link to activate your account on WebsiteName. <br>By clicking ...', NULL, FALSE);

    $configEmail['box'][1]['Type'] = 'link';
    $configEmail['box'][1]['URL'] = get_URL().'/login/?key_act='.$user["activation_key"].'&key_eml='.rawurlencode(encrypt($_POST['InputActivationEmail'], $config['KeyEmail']));
    $configEmail['box'][1]['URLDesc'] = lg('Confirm email address', NULL, FALSE);

    if(isset($_POST['InputLinkBroken']) && $_POST['InputLinkBroken'] == 1) {
        $configEmail['box'][2]['Type'] = 'text';
        $configEmail['box'][2]['Content'] = '&nbsp;<br /><small>'.lg('In case of problem using the link, you can copy-paste in your browser this link:', NULL, FALSE).'<br>'.get_URL().'/login/?key_act='.$user["activation_key"].'&key_eml='.rawurlencode(encrypt($_POST['InputActivationEmail'], $config['KeyEmail'])).'</small>';
    }
    
    $configEmail['Template'] = 'email_templateBase';

    $catchError = email_send();
    if($catchError != '') { // Returned an error!
        
        echo 'Error! Sending email: '.$catchError;
        
    } else {

        echo '
<div class="mx-auto mt-5 p-4 rounded bg-light shadow" style="margin-top:20px;max-width:1000px;min-height:500px;">
    <div class="p-4" > 
        <p>'.$user['firstname'].',</p>
        <p>'.lg('An email with a link to activate your account has been resent to ').' <span class="underline-mytheme">'.$_POST['InputActivationEmail'].'</span>.</p>
        <p class="pt-4 fnt-0-9">'.lg('If you don\'t find any mail from WebsiteName, please check also your spam folder in ...').'</small></p>
        <div class="float-right pt-4"><a class="btn btn btn-outline-secondary" href="#" onClick="goBackSignin();">'.lg('Back to Log in page', NULL, FALSE).'</a></div>
        <div class="clearfix"></div>
        <div class="fa fa-envelope-o text-mytheme" style="font-size:100px;"></div>
    </div>
</div>';
    }
    
} else {
    
    echo 'Error: E-mail '.$email.' not found!'; 
    
}

echo '
</div>';
?>
