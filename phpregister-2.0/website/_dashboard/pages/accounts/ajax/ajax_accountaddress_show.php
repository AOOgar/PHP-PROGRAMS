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

/** Security check to prevent direct access to this ajax file */
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') { exit; }

define('_PATHROOT', '../../../../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');


if(!check_adminRights('accounts')) {
    echo '<script>location.reload();</script>';
    exit;
}

$sql = $dataBase->prepare('SELECT pr__address.*, pr__country.'.$_POST['lang'].' AS country_name
                           FROM pr__address
                           LEFT JOIN pr__country ON pr__address.country_code = pr__country.code
                           WHERE pr__address.id = :id
                           ORDER BY id DESC');

$sql->execute(['id' => $_POST['address_id']]);
$userAddress = $sql->fetch();
$sql->closeCursor();

echo '
<div id="DivAddressShow">
    <p>'.$userAddress['username'].'</p>
    <p>'.$userAddress['line1'].'</p>
    <p>'.$userAddress['line2'].'</p>
    <p>'.$userAddress['postcode'].' '.$userAddress['city'].'</p>
    <p>'.$userAddress['state'].'</p>
    <p class="mb-0">'.$userAddress['country_name'].'</p>
</div>';

echo '
<script>
$("#DivAddressDisplayed").html($("#DivAddressShow").html());
</script>';





?>
