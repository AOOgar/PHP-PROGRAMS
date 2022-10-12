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
include_once (_PATHROOT.'include/php/global_display.inc.php');
include_once ('home_display.inc.php');
include_once ('home_modalsprofile.inc.php');

init_langVars(['Home', 'Global']);

$page = 'home';

$cssFiles = get_cssFiles(['navbar', 'main', 'home']);
$jsFiles = get_jsFiles(['global']);
$cssPlugins = ['prism/prism.css'];
$jsPlugins = ['prism.js'];

/**
 *  Check Key used for changing email and deleting Account
 */
if(isset($_GET['key_emlchange']) ||
   isset($_GET['key_delaccount']) ) {
    
    $key = isset($_GET['key_emlchange']) ? $_GET['key_emlchange'] : $_GET['key_delaccount'];
    $dbTableColumn = isset($_GET['key_emlchange']) ? 'newemail_changekey' : 'account_deletekey';
    
    /**
     *  We need to check if this account is a Social Media Account
     *  (By default, Social Media Accounts don't have a password)
     */
    $sql = $dataBase->prepare('SELECT password
                               FROM pr__user
                               WHERE '.$dbTableColumn.' = :key');
    
    $sql->execute(['key' => $key]);
    $user = $sql->fetch();
    $sql->closeCursor();
    if((!$user) ||
       ($user['password'] != NULL)) { /* We do not delete the session for a Social Media Account for which password is NULL */
        /**
         * The key has been deleted / already used or It's not a Social Media Account
         * We delete the session and the password will be asked to change the email or delete the account
         */
        sess_delete();
    }
}

/**
 *  Check Key used for changing password
 */
if(isset($_GET['key_passchange'])) {
    sess_delete();
}

/**
 *  An administrator log in as any user
 */
if(isset($_GET['open']) && $_GET['open'] == 'loginas') {
    $sql = $dataBase->prepare('SELECT * 
                               FROM pr__user 
                               WHERE loginas_key LIKE :key');
    $sql->execute(['key' => $_GET['key']]);
    $userLogAs = $sql->fetch();
    sess_delete();
}

$headerTitle = lg('Header Title', NULL, FALSE);
$headerDesc = lg('Header Desc', NULL, FALSE);

show_header();
show_navbar();
show_home();
show_end();



?>
