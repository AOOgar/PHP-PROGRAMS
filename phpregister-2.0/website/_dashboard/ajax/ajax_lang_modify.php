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

if(!check_adminRights()) {
    echo '
<script>location.reload();</script>';
    exit;
}

/**
 * Lang will be updated in global_cookies file
 */
if(in_array($_POST['Lang'], $config['Langs'])) {
    $_GET['Lang'] = $_POST['Lang'];
    require_once (_PATHROOT.'include/php/global_cookies.inc.php');
}

echo '
<script>location.reload();</script>';


?>
