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
include_once ('files_display.inc.php');

init_langVars(['Global']);

$page = 'files-php-js-css';

$cssFiles = get_cssFiles(['documentation', 'navbar', 'main']);
$jsFiles = get_jsFiles(['test', 'global']);
$cssPlugins = ['prism/prism.css',
               '//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css']; // lightbox2 not used, only as example.
$jsPlugins = ['prism.js',
              '//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js']; // lightbox2 not used, only as example.

$headerTitle = 'Files PHP/JS/CSS';
$headerDesc = 'List of files';

show_header();
show_navbar();
show_files();
show_end();



?>
