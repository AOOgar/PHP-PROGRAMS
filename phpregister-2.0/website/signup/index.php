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

define('_PATHROOT', '../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');

include (_PATHROOT.'include/php/global_display.inc.php');
include ('signup_display.inc.php');

/**
 * Social Networks buttons
 */
require_once(_PATHROOT.'include/php/_libraries/oauth/Google/autoload.php');
require_once(_PATHROOT.'include/php/_libraries/oauth/Facebook/sdk5/autoload.php');

if(isset($_SESSION['UserId'])) {
    /**
     * If User is already connected
     */
    header('Location: '.get_URL().'/account/');
    exit;
}

init_langVars(['Signup', 'Log in', 'Terms', 'Global']);

$page = 'signup';
$cssFiles = get_cssFiles(['navbar', 'main', 'signup']);
$jsFiles = get_jsFiles(['global']);

$cssPlugins = ['//cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css'];
$jsPlugins = [];

$headerTitle = lg('Header Title');
$headerDesc = lg('Header Desc', 'Global');

show_header();
show_navbar();
show_signup();
show_end();



?>
