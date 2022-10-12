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

 *  Creation: 2019 Vincent Marguerit
 *  Last modification:
 */

$configEmail['isSMTP'] = TRUE;

$configEmail['Host'] = 'smtp.your_host.com';
$configEmail['SMTPAuth'] = true;
$configEmail['Username'] = 'Username';
$configEmail['Password'] = 'Password';
$configEmail['Port'] = 587;
$configEmail['SMTPSecure'] = 'tls';

/**
 * Some Examples of some companies providing 
 * transactional email delivery and management service

   Use your Gmail account!
   Go to this url: https://www.google.com/settings/security/lesssecureapps
   Check Allow less secure apps: ON

   If you use your Gmail account on a server which has a different IP address
   from your usual IP, Google might block the sending

   $configEmail['Host'] = 'smtp.gmail.com';
   $configEmail['SMTPAuth'] = true;
   $configEmail['Username'] = 'account@gmail.com';
   $configEmail['Password'] = 'password';
   $configEmail['Port'] = 587;
   $configEmail['SMTPSecure'] = 'tls';

 *
 *
 *
   Exammple Mailjet: http://mailjet.com/

   $configEmail['Host'] = 'in-v3.mailjet.com';
   $configEmail['SMTPAuth'] = true;
   $configEmail['Username'] = 'username';
   $configEmail['Password'] = 'password';
   $configEmail['Port'] = 587;
   $configEmail['SMTPSecure'] = 'tls';

*
*
*
   Example Postmark: https://postmarkapp.com/

   $configEmail['isSMTP'] = true;
   $configEmail['Host'] = 'smtp.postmarkapp.com';
   $configEmail['SMTPAuth'] = true;
   $configEmail['Username'] = 'username'; 
   $configEmail['Password'] = 'password';  
   $configEmail['Port'] = 587;
   $configEmail['SMTPSecure'] = 'tls'; // Or ssl
 
 */

?>
