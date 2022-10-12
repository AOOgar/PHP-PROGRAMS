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

$unique_string = md5(uniqid(rand(), true));

$configEmail['To'] = $sessionUser['email'];
$configEmail['ToName'] = ucfirst($sessionUser['firstname']).' '.ucfirst($sessionUser['lastname']);
$configEmail['Subject'] = lg('Deleting your WebsiteName account', NULL, FALSE);
$configEmail['Title'] = ucfirst($sessionUser['firstname']).',';
$configEmail['box'][0]['Type'] = 'text';
$configEmail['box'][0]['Content'] = lg('You have asked to delete your WebsiteName account <br>Clicking on the following link...', NULL, FALSE);
$configEmail['box'][1]['Type'] = 'link';
$configEmail['box'][1]['URL'] = get_URL().'/?key_delaccount='.$unique_string;
$configEmail['box'][1]['URLDesc'] = lg('Delete account', NULL, FALSE);

$configEmail['Template'] = 'email_templateBase';

$catchError = email_send();
if($catchError == '') {
    $sql = $dataBase->prepare('UPDATE pr__user
                               SET account_deletekey = :key, 
                                   account_deletedate = :date
                               WHERE id = :id');
    
    $sql->execute(['key'   => $unique_string,
                   'date'  => date('Y-m-d H:i:s'),
                   'id'    => get_userIdSession()]);
    $sql->closeCursor();

    echo '
<div id="DivAjaxAccountDelete">
'.html_accountDeletePending().'
</div>

<script>
setTimeout(function() {
   $("#DivAccountDelete").empty().css({"opacity":0});
   $("#DivAjaxAccountDelete").appendTo($("#DivAccountDelete"));
   $("#DivAccountDelete").delay(1000).fadeTo("slow", 1);
}, 1000);
</script>';
} else {

    echo '
<div id="DivAjaxAccountDelete">
Error sending email: '.$catchError.'
</div>
<script>
$("#DivAccountDelete").empty();
$("#DivAjaxAccountDelete").appendTo($("#DivAccountDelete"));
</script>';
    

}

?>
