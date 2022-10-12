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
 * For Security Reasons uncomment this line //exit once your tests are finished 
 */
//exit;

define('_PATHROOT', '../../../../');
require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/emails/global_email.inc.php');

/**
 * From details are by default defined in function email_send()
 */
$configEmail['From'] = $config['EmailContact'];
$configEmail['FromName'] = $config['EmailContactName'];

$configEmail['To'] = 'email@domain.com';
$configEmail['ToName'] = 'John Doe';

$configEmail['Subject'] = 'Subject of Email '.$config['WebsiteName'];

$configEmail['Title'] = 'Title Line1,<br /> Another line for the Title. ';

$configEmail['box'][0]['Type'] = 'text';
$configEmail['box'][0]['Content'] = '<b>A text box inside the tag &lt;b&gt;&lt;/b&gt;some text</b>: Huic Arabia est conserta, ex alio latere Nabataeis contigua; opima varietate conmerciorum castrisque oppleta validis. </br>A link in the text box, <a href="'.get_URL().'" style="box-sizing: border-box; color: #348eda; font-weight: 400; text-decoration: none;">Name of the link.</strong>';

$configEmail['box'][1]['Type'] = 'link';
$configEmail['box'][1]['URL'] = get_URL();
$configEmail['box'][1]['URLDesc'] = 'Name of the button';

$configEmail['box'][2]['Type'] = 'text';
$configEmail['box'][2]['Content'] = '&nbsp;<br />Another text box. Aegypto, quam necessario aliud reieci ad tempus.';

$configEmail['box'][3]['Type'] = 'text';
$configEmail['box'][3]['Content'] = 'Thank you, <br /> The '.$config['WebsiteName'].' Team';

$configEmail['Template'] = 'email_templateBase'; // Name of the function called to create the content HTML of the email

$content = email_templateBase();

echo $content;

echo '
<div style="max-width:350px;margin:20px;border: 3px dotted #525252; padding: 5px 15px 15px 15px; background: #ededed;">
  <p style="text-align:right;">Infos</p>
  <p><b>From</b>: '.$configEmail['From'].'</p>
  <p><b>From / Name</b>: '.$configEmail['FromName'].'</p>
  <p><b>To</b>: '.$configEmail['To'].'</p>
  <p><b>To / Name</b>: '.$configEmail['ToName'].'</p>
  <p><b>Subject</b>: '.$configEmail['Subject'].'</p>';
if(isset($_GET['send']) && $_GET['send'] == 1) {
    $catchError = email_send();
    if($catchError == '') {
        echo '<p style="text-align:center;color:green;"><b>Email sent!</b></p>';
    } else {
        echo '<p style="text-align:center;color:red;"><b>Error sending email to '.$configEmail['To'].'</b><br><br>Error: '.$catchError.'</p>';
    }
} else {
    echo '
  <p style="text-align:center;"><b>Email not send.</b></p><span style="font-size:0.8em">Add <a href="?send=1">?send=1</a> to url to send email.</span>';
}
echo '
  <hr>
  <p style="color:red;font-size:0.8em;">Logo images cannot by displayed because they are embed in the mail with: <span style="color:black;padding:2px 5px; border: 1px solid #a2a2a2;">src="cid: ...</span></p>
</div>';


?>
