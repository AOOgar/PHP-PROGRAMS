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
include_once ('mymap_display.inc.php');

init_langVars(['Global']);

$page = 'mymap-css-attributes';

$cssFiles = get_cssFiles(['navbar', 'main', 'documentation']);
$jsFiles = get_jsFiles(['global']);
$cssPlugins = ['prism/prism.css',
               '//unpkg.com/leaflet@1.3.1/dist/leaflet.css' => ['integrity' => 'sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==',
                                                                'crossorigin']];

$jsPlugins = ['prism.js',
              '//unpkg.com/leaflet@1.3.1/dist/leaflet.js' => ['integrity' => 'sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==',
                                                              'crossorigin']];

$headerTitle = 'My Map and CSS Crossorigin';
$headerDesc = '';

show_header();
show_navbar();
show_attributes();
show_end();



?>
