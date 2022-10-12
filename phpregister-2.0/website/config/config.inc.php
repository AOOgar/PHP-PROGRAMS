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
 *  Set a default timezone
 *  To avoid DateTime::__construct() exeption
 *  List of Supported Timezones: http://php.net/manual/en/timezones.php
 */
date_default_timezone_set('Europe/London');

/**
 *  Default CSS for body
 */
$config['BodyClass'] = "body-default";

/**
 * Display in HTML source at bottom of the page the Time to generate the page
 * IE: <!--Page generated in 0.06982 seconds.-->
 */

$config['DisplayPageLoadtime'] = TRUE;
$config['StartTime'] = microtime(TRUE);

/**
 *  Hide All PHP errors
 */
//error_reporting(0);
//ini_set('display_errors', 0);

/**
   Show ALl PHP Errors
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 *  Database
 */
$config['DatabaseDomain'] = 'localhost';
$config['DatabasePort'] = '3306';
$config['DatabaseUser'] = 'root';
$config['DatabasePassword'] = '';
$config['DatabaseName'] = 'phpregister';

/** 
 *  Automatic URL of website (No slash at the end)
 *  Automotic URLS of website Images  (With a slash at the end)
 */
$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$config['URL'] = $protocol.$_SERVER['HTTP_HOST'];
$config['ImagesURL'] = $protocol.$_SERVER['HTTP_HOST'].'/include/images/';

/**
 *  Name of session for authentication, used in function _sess_cookieStart() from file global.inc.php. 
 */
$config['SessionName'] = 'phpRegisterDemo';

/**
 * Default email sender for transactional emails
 */
$config['EmailContact'] = 'email@yourwebsite.com';
$config['EmailContactName'] = 'YourWebsite';

/**
 *  Key password encryption
 *  Passwords will be modified thanks to this key and then will be hashed with sha1
 *  Once used, if you modify this value, passwords will be lost and users will have
 *  to change their passwords with the button "Forgotten password?" in login page
    Generate keys: https://phpregister.org/doc-generate-keys
 */
$config['KeyPassword'] = '';

/**
 *  Key to encode email
 *  For link activation
 */
$config['KeyEmail'] = '';

/**
 *  Key to encode Session ID 
 */
$config['KeySessionID'] = '';

/**
 *  Key to encode Redirect URL (To encrype the URL redirection variable)
 */
$config['KeyOAuthRedirect'] = '';


/**
 *  Langs available and Default Lang
 *  If a lang file is not available which is not the default lang,
 *  the default lang file will be loaded
 */
$config['Langs'] = ['en', 'fr', 'es'];
$config['LangsNames'] = ['en' => 'english', 'fr' => 'français', 'es' => 'español'];
$config['LangDefault'] = 'en';
$config['UserLang'] = $config['LangDefault']; /* Will be updated in global_cookies.inc.php  */

/**
 *  Google Sign In
 */
$config['GoogleClientID'] = '';
$config['GoogleClientSecret'] = '';
$config['GoogleRedirectURI'] = $config['URL'].'/account/oauth/oauth_google.php';

/**
 *  Facebook Sign In
 */
$config['FacebookAppID'] = '';
$config['FacebookAppSecret'] = '';
$config['FacebookRedirectURL'] = $config['URL'].'/account/oauth/oauth_facebook.php';
$config['FacebookRequiredScope'] = ['email'];

/**
 * Pages URL Rewriting to construct URLs depending on the user lang 
 * (good for SEO and for sharing links)
 */
$siteSections = ['contact-us'        => ['fr' => 'contactez-nous', 'es' => 'contactenos'],
                 'about-us'          => ['fr' => 'qui-sommes-nous', 'es' => 'acerca-de-nosotros'],
                 'terms-of-use'      => ['fr' => 'cgu-cgv', 'es' => 'conditiones'],

                 /** Pages with examples of codes */
                 'files-php-js-css'     => ['fr' => 'fichiers-php-js-css', 'es' => 'archivos-php-js-css'],
                 'ajax-calls'           => ['fr' => 'appels-ajax', 'es' => 'ajax-llama'],
                 'mymap-css-attributes' => ['fr' => 'macarte-css-attributes', 'es' => 'mi-mapa-css-attributes'],
                 'sample'               => ['fr' => 'echantillon', 'es' => 'muestra']];


/**
 *  Pages of Website without URL rewriting in different languages like pages of $siteSections
 */
$directPages = ['login', 'signup', 'account'];

/**
 *  Administration
 *
 */

/**
 *  Admin folder
 *  Change it for security reasons
 */
$config['AdminFolder'] = '_dashboard';


/**
 *  Admin URL
 */
$config['AdminURL'] = $config['URL'].'/'.$config['AdminFolder'];


?>
