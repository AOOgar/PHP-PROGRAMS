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


function sql_getVariablesCount() {
    global $dataBase;

    $sql = $dataBase->prepare('SELECT COUNT(id) AS num
                               FROM pr__website_option
                               WHERE name NOT IN ("misstranslation_defaultlang", "logas_password")');
    $sql->execute();
    $variablesCount = $sql->fetch()['num'];
    $sql->closeCursor();
    return $variablesCount;
}

function sql_getAdminRightsCount() {
    global $dataBase;

    $sql = $dataBase->prepare('SELECT COUNT(id) AS num
                               FROM pr__adminright');
    $sql->execute();
    $adminRightsCount = $sql->fetch()['num'];
    $sql->closeCursor();
    return $adminRightsCount;
}

function sql_getVariables() {
    global $dataBase;

    $sql = $dataBase->prepare('SELECT * 
                               FROM pr__website_option 
                               WHERE name NOT IN ("misstranslation_defaultlang", "logas_password")
                               ORDER BY name');
    $sql->execute();
    $variables = $sql->fetchAll();
    $sql->closeCursor();
    
    return $variables;

}

function sql_getAdminRights() {
    global $dataBase;

    $sql = $dataBase->prepare('SELECT * 
                               FROM pr__adminright 
                               ORDER BY name');
    $sql->execute();
    $variables = $sql->fetchAll();
    $sql->closeCursor();
    
    return $variables;
}

?>
