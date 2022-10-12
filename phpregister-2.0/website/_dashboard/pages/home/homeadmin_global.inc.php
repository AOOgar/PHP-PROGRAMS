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
 *  Generate an array of string dates between 2 dates
 *  Will returns days if there are 40 days or less
 *  Will return month if there are at least 41 days
 *
 *  Used in file ajax_home_charts_update.php to display Line Charts
 */
function get_datesRange($start, $end, $format = 'Y-m-d') {

    $date1 = new DateTime($start);
    $date2 = new DateTime($end);
    $diff = $date2->diff($date1)->format("%a");
    if($diff > 40) {
        $format = 'Y-m';
        $interval = new DateInterval('P1M');        
    } else {
        $interval = new DateInterval('P1D');
    }
    
    $array = array();

    $realEnd = new DateTime($end);
    if($diff <= 40) {
        $realEnd->add($interval);
    }
    
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach($period as $date) { 
        $array[] = $date->format($format); 
    }

    return $array;
}


?>
