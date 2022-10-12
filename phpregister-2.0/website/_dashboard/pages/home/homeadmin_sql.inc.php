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
 *  Function to recover Total accounts per period, used in
 *    _ adminhome_display.inc.php
 *    _ iframes/if_accounts_chart.php
 */

function sql_getRange_allAccounts($startDate, $endDate) {
    global $dataBase;

    $startDate .= ' 00:00:00';
    $endDate .= ' 23:59:59';

    $date1 = new DateTime($startDate);
    $date2 = new DateTime($endDate);
    $diff = $date2->diff($date1)->format('%a');
    
    if($diff > 40) {
        $sql = $dataBase->prepare('SELECT date_format(`date_accountcreated`, "%Y") AS year,
                                          date_format(`date_accountcreated`, "%m") AS month,
                                          date_format(`date_accountcreated`, "%Y-%m") AS  date,
                                          COUNT(*) AS total
                                   FROM pr__user
                                   WHERE date_accountcreated BETWEEN :start AND :end
                                   GROUP BY date, year, month');        
    } else {
        $sql = $dataBase->prepare('SELECT date_format(`date_accountcreated`, "%Y") AS year,
                                          date_format(`date_accountcreated`, "%m") AS month,
                                          date_format(`date_accountcreated`, "%d") AS day,
                                          date_format(`date_accountcreated`, "%Y-%m-%d") AS  date,
                                          COUNT(*) AS total
                                   FROM pr__user
                                   WHERE date_accountcreated BETWEEN :start AND :end
                                   GROUP BY date, year, month, day');
    }
    $sql->execute(['start' => $startDate,
                   'end'   => $endDate]);
    $accountsTotal = $sql->fetchAll();
    return $accountsTotal;
}

function sql_getRange_socialNetworksAccounts($startDate, $endDate) {
    global $dataBase;

    $startDate .= ' 00:00:00';
    $endDate .= ' 23:59:59';

    $date1 = new DateTime($startDate);
    $date2 = new DateTime($endDate);
    $diff = $date2->diff($date1)->format('%a');

    if($diff > 40) {
        $sql = $dataBase->prepare('SELECT date_format(`date_accountcreated`, "%Y") AS year,
                                          date_format(`date_accountcreated`, "%m") AS month,
                                          date_format(`date_accountcreated`, "%Y-%m") AS  date,
                                   COUNT(case when facebook_id IS NOT NULL then 1 end ) AS total_facebook,
                                   COUNT(case when google_id IS NOT NULL then 1 end) AS total_google,
                                   COUNT(case when password IS NOT NULL then 1 end) AS total_email
                                   FROM pr__user 
                                   LEFT JOIN pr__user_oauth ON pr__user_oauth.user_id = pr__user.id 
                                   WHERE date_accountcreated BETWEEN :start AND :end
                                   GROUP BY date, year, month');
    } else {
        $sql = $dataBase->prepare('SELECT date_format(`date_accountcreated`, "%Y") AS year,
                                          date_format(`date_accountcreated`, "%m") AS month,
                                          date_format(`date_accountcreated`, "%d") AS day,
                                          date_format(`date_accountcreated`, "%Y-%m") AS  date,
                                   COUNT(case when facebook_id IS NOT NULL then 1 end ) AS total_facebook,
                                   COUNT(case when google_id IS NOT NULL then 1 end) AS total_google,
                                   COUNT(case when password IS NOT NULL then 1 end) AS total_email
                                   FROM pr__user 
                                   LEFT JOIN pr__user_oauth ON pr__user_oauth.user_id = pr__user.id 
                                   WHERE date_accountcreated BETWEEN :start AND :end
                                   GROUP BY date, year, month, day');
    }
    
    $sql->execute(['start' => $startDate,
                   'end'   => $endDate]);
    $accountsTotal = $sql->fetchAll();

    return $accountsTotal;
}

?>
