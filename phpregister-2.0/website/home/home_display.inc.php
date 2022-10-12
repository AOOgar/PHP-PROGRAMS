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

function show_home() {
    global $config, $jsWindowLoaded, $jsDocumentReady, $jsWindowResize, $jsScripts;

    /**
     *  Change password
     *  (from a link received by email)
     */
    if(isset($_GET['key_passchange'])) {

        show_modalPasswordChange();
        
    }
    
    /**
     *  Change e-mail
     *  (from a link received by email)
     */
    if(isset($_GET['key_emlchange'])) {

        show_modalEmailChange();

    }
    
    /**
     *  Deletion of Account by the user
     *  (from a link received by email)
     */

    if(isset($_GET['key_delaccount'])) {
        
        show_modalAccountDelete();
        
    }

    /**
     *  Log as 
     *  An administrator log in as any user
     */
    if(isset($_GET['open']) && $_GET['open'] == 'loginas') {

        show_modalLogAsPassword();
        
    }

    echo '
<div class="container my-2 my-sm-5">

    <h2>Welcome on phpRegister default Home page!</h2>
    <p>The source of phpRegister has been published under GPL V3. The main purpose of this publication is to help developpers to start a new project with a software infrastructure they can easily understand and modify to adapt it to their needs. I also wanted the code and its structure to be as easy as possible, so any Full Stack developper can be integrated to a project started with phpRegister.</p>
    <h5>Main features:</h5>
    <ul class="features">
       <li>Accounts creation: Email / Password account. Account creation via Facebook and Google buttons</li>
       <li>Send email on account creation to activate it. Resend activation link. Recover password</li>
       <li>Manage profile: Photo, email, addresses, subscribe to newsletter</li>
       <li>User support, open ticket, reply to ticket, close a ticket</li>
       <li>Account deletion by sending a deletion link. Delete all user datas</li>
       <li>Full Multilingual: URL rewriting, Metas Title and Description, Canonical/Alternate pages</li>
       <li>Basic pages: Login - Create account - Profile - User support - Contact - About us - Licence</li>
    </ul>
    <h5>Admin main features:</h5>
    <ul class="features">
       <li>Home page with charts of accounts creation</li>
       <li>Accounts management: Search users, display a user details, manage a user Admin rights, send email to a user</li>
       <li>Management of translation of pages. Search and modify a variable, modify your website content on the fly by showing Translates Ids</li>
       <li>"Login as" feature to log as another user by generating a unique link containing a key and with the "Login as" password</li>
       <li>Management of tickets from Helpdesk: Reply to a ticket, mark a ticket In progress, close or delete a ticket, reopen a closed ticket</li>
       <li>Create redirections 404 to 301 (Moved Permanently)</li>
       <li>Manage your environnement global configuration variables</li>
       <li>Generate sitemaps file</li>
       <li>Create accounts randomly! With this functionnality, you can simulate a lot of accounts created on your website and test the velocity of the phpRegister script and of your server</li>
    </ul>

    <hr class="my-4">

    <h4>First configure your SMTP service provider to send emails</h4>
    <p>Edit your file <span class="px-2 py-0 border bg-white">/config/config_smtp.inc.php</span> to specify your email server provider.<br>Sending emails is mandatory to create your first account which will be by default an account with Admin rights.</p>
    <p>You will find examples of SMTP service provider configuration but also how to use a <span class="px-2 py-0 border bg-white">Gmail</span> account for your SMTP server.</p></p>
    <pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/config_smtp.inc.php.txt"></pre>
    <p>Edit your file <span class="px-2 py-0 border bg-white">/config/config.inc.php</span> to specify the default sender of emails:</p>
    <pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/emailpart-config.inc.php.txt"></pre>
    <p>Then, edit the file <span class="border bg-white px-2 py-0">/include/php/emails/testing/basic.php</span> to specify your email for testing:</p>
    <pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/basic.php.txt"></pre>
    <p>And go to the page <a class="text-underline" href="'.$config['URL'].'/include/php/emails/testing/basic.php">'.$config['URL'].'include/php/emails/testing/basic.php</a> to test your configuration, specify <span class="px-2 py-0 border bg-white">?send=1</span> and the end of this url to send the test email.</p>

    <hr class="my-4">

    <h4>First account</h4>
    <p>Once you have created your first account, you can remove from the file <span class="border bg-white px-2 py-0">/signup/ajax/ajax_account_create.php</span> the following code:</p>
    <pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/signup-ajax-remove-code.php.txt"></pre>
    <hr class="my-4">
    <h4>Admin dashboard</h4>
    <p>For security reason you should rename the default name <span class="px-2 py-0 border bg-white">_dashboard</span> of the admin folder and specify its new name on the config file <span class="px-2 py-0 border bg-white">/config/config.inc.php</span></p>
    <pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/adminfolder-config.inc.php.txt"></pre>
</div>';

}


?>
