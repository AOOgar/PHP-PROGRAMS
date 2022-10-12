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


function sql_getUserAdresses($countryLangShow) {
    global $dataBase;

    $sql = $dataBase->prepare('SELECT pr__address.*, pr__country.'.$countryLangShow.'
                               FROM pr__address
                               LEFT JOIN pr__country ON pr__address.country_code = pr__country.code
                               WHERE pr__address.user_id = :id
                               ORDER BY id DESC');

    $sql->execute(['id' => get_userIdSession()]);
    $userAddresses = $sql->fetchAll();
    $sql->closeCursor();
    return $userAddresses;
}


function sql_getUserAdress($id, $countryLangShow) {
    global $dataBase;

    $sql = $dataBase->prepare('SELECT pr__address.*, pr__country.'.$countryLangShow.'
                               FROM pr__address
                               LEFT JOIN pr__country ON pr__address.country_code = pr__country.code
                               WHERE pr__address.id = :id');

    $sql->execute(['id' => $id]);
    $userAddress = $sql->fetch();
    $sql->closeCursor();
    return $userAddress;
}






?>
