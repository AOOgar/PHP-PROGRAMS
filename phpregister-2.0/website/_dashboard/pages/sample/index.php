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

define('_PATHROOT', '../../../');
require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global_display.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');
require_once (_PATHROOT.'include/php/global_normalize.inc.php');
include_once (_PATHROOT.$config['AdminFolder'].'/admin_display.inc.php');
include_once ('sampleadmin_display.inc.php');

init_langVars(['Admin', 'Global']);

$adminPage = 'sample';

$cssFiles = get_cssFiles(['main', 'admin-sidebar', 'admin-accounts']);
$jsFiles = get_jsFiles(['global', 'admin-sidebar']);

$cssPlugins = ['nprogress.css'];
$jsPlugins = ['nprogress.js'];

$config['BodyClass'] = 'body-admin';

$sql = $dataBase->prepare('SELECT * 
                           FROM pr__url_redirection
                           ORDER BY id DESC');
$sql->execute();
$redirections = $sql->fetchAll();
$sql->closeCursor();

if(!check_adminRights('admin')) {
    show_adminError();
    exit;
}

$pageTop = ['left'    => '<i class="fa fa-map-o fa-3x pl-4 text-info"></i>',
            'center'  => 'Sample Page',
            'right'   => ''];

show_header();
show_adminSidebar();
show_adminPageTop($pageTop);
show_sample();
show_adminPageBottom();
show_end();



?>
