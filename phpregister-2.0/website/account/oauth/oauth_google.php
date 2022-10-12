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

define('_PATHROOT', '../../');
require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_images.inc.php');

// Google+ API for Sign in
require_once(_PATHROOT.'include/php/_libraries/oauth/Google/autoload.php');

/************************************************
   Make an API request on behalf of a user. In
   this case we need to have a valid OAuth 2.0
   token for the user, so we need to send them
   through a login flow. To do this we need some
   information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId($config['GoogleClientID']);
$client->setClientSecret($config['GoogleClientSecret']);
$client->setRedirectUri($config['GoogleRedirectURI']);
$client->addScope('email');
$client->addScope('profile');

/************************************************
   When we create the service here, we pass the
   client to it. The client then queries the service
   for the required scopes, and uses that when
   generating the authentication URL later.
 ************************************************/
$service = new Google_Service_Oauth2($client);

/************************************************
   If we have a code back from the OAuth 2.0 flow,
   we need to exchange that with the authenticate()
   function. We store the resultant access token
   bundle in the session, and redirect to ourself.
 *************************************************/

if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: ' . filter_var($config['GoogleRedirectURI'], FILTER_SANITIZE_URL));
    exit;
}

$_GET['r'] = 'noupdate';
require_once (_PATHROOT.'include/php/global_cookies.inc.php');

/*************************************
   Avoid Fatal error Uncaught exception 
   'Google_Auth_Exception' message 'Could not json decode the token'  OAuth2.php
   when trying to go back to the URL $google_redirect_uri 
   whereas we have signed out
 *************************************/
if(!isset($_SESSION['access_token'])) {
    header('Location: ' . filter_var(get_URL().'/login/', FILTER_SANITIZE_URL));
    exit;
}

$client->setAccessToken($_SESSION['access_token']);

$userGoogle = $service->userinfo->get(); //get user info 

/*
   Test display Image of google+ profile picture with different size:
   <img src="'.$userGoogle->picture.'?sz=50"
 */

$userSocialNetwork = ['id'         => $userGoogle->id,
                      'email'      => $userGoogle->email,
                      'firstname'  => $userGoogle->givenName,
                      'lastname'   => $userGoogle->familyName,
                      'link'       => $userGoogle->link,
                      'locale'     => $userGoogle->locale,
                      'picture'    => $userGoogle->picture,
                      'verified'   => $userGoogle->verifiedEmail];

$socialNetwork = 'google';

require('oauth_global.inc.php');


?>
