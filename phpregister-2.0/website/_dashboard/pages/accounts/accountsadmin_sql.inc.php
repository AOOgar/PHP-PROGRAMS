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
 *  Function used in 
 *    - accounts_display.inc.php
 *    - ajax/ajax_accounts_search.php
 */

function sql_searchAccounts($dataBase, $page, $InputOrder) {
    global $searchCount, $config;

    if($page == 0) {
        $offSet = 0;
    } else {
        $offSet = $page * $config['AdminAccountsPerPage'];     
    }

    if($_POST['search'] == '') {
        
        $sqlSearch = $dataBase->prepare('SELECT pr__user.*,
                                                pr__user_oauth.facebook_id, 
                                                pr__user_oauth.google_id
                                         FROM pr__user
                                         LEFT JOIN pr__user_oauth ON pr__user.id = pr__user_oauth.user_id
                                    
                                         ORDER BY '.$InputOrder.' DESC LIMIT '.$config['AdminAccountsPerPage'].' OFFSET '.$offSet);
    
        $sqlSearch->execute();
        
        $searchResult = $sqlSearch->fetchAll();
        $sqlSearch->closeCursor();

        /**
         * Search COUNT without LIMIT ... OFFSET
         */
        $sqlCount = $dataBase->prepare('SELECT count(*)
                                        AS number
                                        FROM pr__user ');
        $sqlCount->execute();
        $searchCount = $sqlCount->fetch();
        $sqlCount->closeCursor();
        

    } else {
        
        $searchId = $_POST['search'];

        $_POST['search'] = trim(preg_replace('!\s+!', ' ', str_replace(array ("\r", "\t", "\n"), " ", $_POST['search'])));
        $arrayWords = explode(" ", $_POST['search']);
        
        $searchMatch = '';
        foreach($arrayWords as $word) {
            $searchMatch .= '+"'.$word.'" ';
        }
                
        $sqlSearch = $dataBase->prepare('SELECT pr__user.*,
                                                pr__user_oauth.facebook_id, 
                                                pr__user_oauth.google_id
                                         FROM pr__user
                                         LEFT JOIN pr__user_oauth ON pr__user.id = pr__user_oauth.user_id
                                         WHERE pr__user.id LIKE :id

                                         UNION

                                         SELECT pr__user.*,
                                                pr__user_oauth.facebook_id, 
                                                pr__user_oauth.google_id
                                         FROM pr__user
                                         LEFT JOIN pr__user_oauth ON pr__user.id = pr__user_oauth.user_id
                                         WHERE MATCH (email, firstname, lastname) AGAINST (:match IN BOOLEAN MODE)
                                    
                                         ORDER BY '.$InputOrder.' DESC LIMIT '.$config['AdminAccountsPerPage'].' OFFSET '.$offSet);
    
        $sqlSearch->execute(['id'    => $searchId,
                             'match' => $searchMatch]);
        
        $searchResult = $sqlSearch->fetchAll();
        $sqlSearch->closeCursor();
        
        /**
         * Search COUNT without LIMIT ... OFFSET
         */
        $sqlCount = $dataBase->prepare('SELECT count(*)
                                        AS number
                                        FROM pr__user
                                        WHERE (
                                               (pr__user.id LIKE :id OR 
                                               (MATCH (email, firstname, lastname) AGAINST (:match IN BOOLEAN MODE))
                                                ) 
                                              ) ');
        $sqlCount->execute(['id'    => $searchId,
                            'match' => $searchMatch]);

        $searchCount = $sqlCount->fetch();
        $sqlCount->closeCursor();
        
    }    


    return $searchResult;
}


?>
