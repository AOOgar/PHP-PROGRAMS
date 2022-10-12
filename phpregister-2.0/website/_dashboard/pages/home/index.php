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
include_once ('homeadmin_display.inc.php');
include_once ('homeadmin_sql.inc.php');

init_langVars(['Admin', 'Global']);

$adminPage = 'adminhome';

$cssFiles = get_cssFiles(['main', 'admin-sidebar', 'admin-pages']);
$jsFiles = get_jsFiles(['global', 'admin-sidebar']);

$cssPlugins = ['nprogress.css', 'admin/morris.css', 'admin/bootstrap-datepicker3.min.css'];
$jsPlugins = ['nprogress.js',
              'admin/flotCharts/jquery.flot.min.js', 'admin/flotCharts/jquery.flot.pie.min.js',
              'admin/raphael.min.js', 'admin/morris.min.js',
              'admin/datePicker/bootstrap-datepicker.min.js', 'admin/datePicker/locales/bootstrap-datepicker.fr.min.js'];

$config['BodyClass'] = 'body-admin';

$jQueryForceVersion = 2;

if(!check_adminRights()) {
    show_adminError();
    exit;
}

$right = '';
if(check_adminRights('sitemaps')) {
    $right .= '<i onClick="showHomeSiteMaps();" class="fa fa-sitemap fa-2x pt-3 pointer mr-5"></i>';
}
$right .= '<i onClick="showHomeConfig();" class="fa fa-cog fa-2x pt-3 pointer pr-4"></i>';
$pageTop = ['left'    => '<i class="fa fa-home fa-3x pl-4 text-info"></i>',
            'center'  => lg('Administration Home'),
            'right'   => $right];

show_header();
show_adminSidebar();
show_adminPageTop($pageTop);
show_adminHome();
show_adminPageBottom();
show_end();


?>
