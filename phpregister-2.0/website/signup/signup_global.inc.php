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


/**
 * Check Password Strenght 
 * Used in /home/ajax/ajax_password_change.php / 
 */

function check_passwordStrength($password) {

    $containsLetter  = preg_match('/[a-zA-Z]/', $password);
    $containsDigit   = preg_match('/\d/', $password);
    $containsSpecial = preg_match('/[^a-zA-Z\d]/', $password);

    if(strlen($password) < 6) {
        return lg('Password not long enough.', 'Signup');
    }
    
    if(!$containsLetter) {
        return lg('The password must contain at least one letter.', 'Signup');
    }
    
    if(!$containsDigit) {
        return lg('The password must contain at least one number.', 'Signup');
    }

    if(!$containsSpecial) {
        return lg('The password must contain at least one special character such as: ! # @ - _', 'Signup');
    }

    return NULL;

}







?>
