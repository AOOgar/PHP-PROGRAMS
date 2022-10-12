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

if( isset($_GET['error']) &&
    $_GET['error'] == 'access_denied') {
    /** 
     *  User clicked on Cancel, error is sent with 'access_denied' as value
     */
    header('Location: '.get_URL().'/login/');
}


/** 
 *  Facebook API for Sign in
 */
require_once(_PATHROOT.'include/php/_libraries/oauth/Facebook/sdk5/autoload.php');
$_GET['r'] = 'noupdate';
require_once (_PATHROOT.'include/php/global_cookies.inc.php');

$fb = new Facebook\Facebook([
    'app_id' => $config['FacebookAppID'], 
    'app_secret' => $config['FacebookAppSecret'],
    'default_graph_version' => 'v4.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    
    $accessToken = $helper->getAccessToken($config['URL'].'/account/oauth/oauth_facebook.php');
    
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    
    /* When Graph returns an error */
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
    
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    
    /* When validation fails or other local issues */
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
    
}

try {
    
    /* Returns a `Facebook\FacebookResponse` object */
    $response = $fb->get('/me?fields=id,email,first_name,last_name', $accessToken);
    
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    
    /* When Graph returns an error */
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
    
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    
    /* When validation fails or other local issues */
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
    
}

$userFacebook = $response->getGraphUser();

$userSocialNetwork = ['id'         => $userFacebook['id'],
                      'email'      => $userFacebook['email'],
                      'firstname'  => $userFacebook['first_name'],
                      'lastname'   => $userFacebook['last_name'],
                      'link'       => NULL, // Deprecated by Facebook
                      'locale'     => NULL, // Deprecated by Facebook
                      'picture'    => 'https://graph.facebook.com/'.$userFacebook['id'].'/picture',
                      'verified'   => NULL]; // Deprecated by Facebook

$socialNetwork = 'facebook';

require('oauth_global.inc.php');


?>
