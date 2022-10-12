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
require_once (_PATHROOT.'include/php/global_cookies.inc.php');
include_once (_PATHROOT.'include/php/global_display.inc.php');
include_once ('ajaxcalls_display.inc.php');

init_langVars(['Global']);

$page = 'ajax-calls';

$cssFiles = get_cssFiles(['documentation', 'navbar', 'main']);
$jsFiles = get_jsFiles(['global']);
$cssPlugins = ['prism/prism.css'];
$jsPlugins = ['prism.js'];

$headerTitle = 'Ajax calls';
$headerDesc = 'Examples of Ajax calls';

show_header();
show_navbar();
show_ajaxcalls();
show_end();



?>
