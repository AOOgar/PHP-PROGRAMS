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
require_once (_PATHROOT.'include/php/global_display.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');
include_once (_PATHROOT.'account/account_display.inc.php');
include ('helpdesk_display.inc.php');

init_langVars(['Helpdesk', 'Global']);

$cssFiles = get_cssFiles(['navbar', 'main', 'account']);
$jsFiles = get_jsFiles(['global']);
$cssPlugins = ['build-checkbox.css',
               '//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css'];

$jsPlugins = ['//cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js',
              '//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js'];

/** Error User not logged */
if(!isset($_SESSION['UserId'])) { show_errorLogin(); exit; }

$page = 'account-helpdesk';

$config['BodyClass'] = 'body-account';

$sql = $dataBase->prepare('SELECT *
                           FROM pr__ticket
                           WHERE user_id = :id
                           ORDER BY date DESC LIMIT 0, 50');

$sql->execute(['id' => get_userIdSession()]);
$tickets = $sql->fetchAll();
$sql->closeCursor();

show_header();
show_navbar(); 
show_helpdesk();
show_end();

?>


