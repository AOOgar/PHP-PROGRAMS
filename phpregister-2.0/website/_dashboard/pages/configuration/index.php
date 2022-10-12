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
include_once (_PATHROOT.$config['AdminFolder'].'/admin_display.inc.php');
include_once ('configuration_display.inc.php');
include_once ('configuration_sql.inc.php');

init_langVars(['Admin', 'Global']);

$adminPage = 'configuration';

$cssFiles = get_cssFiles(['main', 'admin-sidebar', 'admin-accounts']);
$jsFiles = get_jsFiles(['global', 'admin-sidebar']);

$cssPlugins = ['nprogress.css'];
$jsPlugins = ['nprogress.js'];

$config['BodyClass'] = 'body-admin';

$variablesCount = sql_getVariablesCount();
$adminRightsCount = sql_getAdminRightsCount();

if(!check_adminRights('admin')) {
    show_adminError();
    exit;
}

$pageTop = ['left'    => '<i class="fa fa-bullseye fa-3x pl-4 text-info"></i>',
            'center'  => lg('Configuration'),
            'right'   => ''];

show_header();
show_adminSidebar();
show_adminPageTop($pageTop);
show_configuration();
show_adminPageBottom();
show_end();

?>
