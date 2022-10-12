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


set_time_limit(0); // No execution time limit
ini_set('memory_limit', '1024M'); // Increasing the memory limit to avoid  Fatal error:  Allowed memory size of XXX bytes exhausted

/** Security check to prevent direct access to this ajax file */
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') { exit; }

define('_PATHROOT', '../../../../../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once ('random_lists.inc.php');

if(!check_adminRights('admin')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

/**
 * When a PHP script uses sessions, PHP locks the session file until the script completes.
 * So we close the session not to block the server.
 */
session_write_close();

/**
 *  Total accounts to generate randomly
 *  Total accounts to generate randomly
 */
$_POST['InputNumberAccounts'] = intval($_POST['InputNumberAccounts']);
if(!($_POST['InputNumberAccounts'] >= 1 && $_POST['InputNumberAccounts'] <= 1000000)) {
    echo '
<script>
alert("Please specify a number between 1 and 1000000");
</script>';
    exit;
}
$total = $_POST['InputNumberAccounts'];
$nbMonth = $_POST['SelectMonthNumbers'];

/**
 *  Default password of Random generated users: demo
 */
$passwordRandomUsers = hash_password('demo');

/**
 *  Each month of the Year
 */
$totalAccounts = 0;
$totalStart_time = microtime(TRUE);
$percentAverage = 0.09;

$accountsAllMonth = get_AccountsAllMonth($total, $nbMonth, $percentAverage);
asort($accountsAllMonth);

$i = 1;
$beginYear = date("Y", strtotime("-".($nbMonth-1)." months"));
$year = $beginYear;
$month = date("m", strtotime("-".($nbMonth-1)." months"));
$beginDate = "$beginYear-$month-01";
$endYear = date('Y');
$endMonth = date('m');
$endDay = date('d');
$totalAccountsCreated = 0;
$currentPercentage = 0;

foreach($accountsAllMonth as $accountsOneMonth) {
    //each day of the Month
    $monthDays = cal_days_in_month(CAL_GREGORIAN , $month, $year);
    $perDay_accountsMax = intval($accountsOneMonth/$monthDays)*2.1;
    for($day=1; $day<=$monthDays; $day++) {
        $perDay_account = mt_rand(0, $perDay_accountsMax);

        for($k=1;$k<=$perDay_account;$k++) {
            $totalAccountsCreated++;
            if($totalAccountsCreated > $total) {
                exit;
            }
            $firstname = $listFirstnames[mt_rand(0, (sizeof($listFirstnames)-1))];
            $lastname = $listLastnames[mt_rand(0, (sizeof($listLastnames)-1))];
            $lang = $config['Langs'][mt_rand(0, (sizeof($config['Langs'])-1))];
            $email = get_emailUnique(no_special_character($firstname), $lastname);
            if(mt_rand(1,10) <= 7) $email = strtolower($email);
            $userAgent = 'random-account';
            $creationDate = $year.'-'.sprintf("%02d", $month).'-'.sprintf("%02d", $day).' '.get_randomTime();

            $timeMin = strtotime($creationDate);
            $timeMax = strtotime(date('Y-m-d').' 23:59:59');
            $timeRand = mt_rand($timeMin, $timeMax);
            $lastSessionDate = date('Y-m-d H:i:s', $timeRand);

            $emailAccount = mt_rand(1,100);

            if($emailAccount <= 70) { /* 70% are emails accounts*/


                $userActivation_key = (mt_rand(1,100) <= 10) ? md5(uniqid(mt_rand(), true)) : NULL; /* 10% of accounts are not activated */
                if($userActivation_key != NULL) {
                    $lastSessionDate = $creationDate;
                }

                $password = $passwordRandomUsers;
                $newUser_id = sql_createEmail_account();
                
                $alsoSocialNetwork = mt_rand(1,100);
                if($alsoSocialNetwork <= 10) { /* 10% Have a email account and signed with a social Network as well */
                    $typeSocial = mt_rand(1,100);
                    if($typeSocial >= 1 && $typeSocial <= 75) { /* 75% are Facebook accounts */
                        sql_createFacebook_account();
                    } else {
                        sql_createGoogle_account();
                    }
                }
                
            } else { /* So 30% are Social Networks accounts */
                $password = NULL;
                $userActivation_key = NULL;
                $newUser_id = sql_createEmail_account();
                $typeSocial = mt_rand(1,100);
                if( ($typeSocial >= 1 && $typeSocial <= 75) ) { /* 75% are Facebook accounts */
                    sql_createFacebook_account();
                    if(mt_rand(1, 100) <= 10) { /* 10% has 2 Social Network for the same account */
                        sql_createGoogle_account(FALSE);
                    }
                } else { /* 25% are Google accounts */
                    sql_createGoogle_account();
                    if(mt_rand(1, 100) <= 10) { /* 10% has 2 Social Network for the same account */
                        sql_createFacebook_account(FALSE);
                    }
                    
                } 
            }
            
            $accountAddress = mt_rand(1,100);

            if($accountAddress <= 40) { /* 40% of users have specified an address */

                sql_createaddress($newUser_id, 'Home');
                
                $accountAddress2 = mt_rand(1,100);
                if($accountAddress <= 60) { /* 60% of these users have also a second address */

                    sql_createaddress($newUser_id, 'Work');

                    $accountAddress3 = mt_rand(1,100);
                    if($accountAddress <= 20) { /* 20% of these users have also a third address */

                        sql_createaddress($newUser_id, 'Holidays');
                        
                    }
                }
            }

            $accountTicket = mt_rand(1,100);
            $showname = $listTicketShowname[mt_rand(0, (sizeof($listTicketShowname)-1))];
            
            if($accountTicket <= 20) { /* 20% of users have open an ticket */

                $newTicketID = 0;
                /* For calculating random dates */
                $date1 = $beginDate.' 00:00:00';
                $date2 = date("Y-m-d H:i:s");
                $date = new DateTime($date2);
                $date->modify('-1 days');
                $date2 = $date->format("Y-m-d H:i:s");

                createTicketReplies();
                
                sql_ticketStatus($newTicketID, 'closed');
                
            }
        }
        $j = 0;

        if( ($year == $endYear) && (($month) == ($endMonth)) && ($day == $endDay) ) {
            break 2;
        }
    }
   
    if($month == 12) {
        $year++;
        $month = 0;
    }
    $month++;
    $i++;
}
$j=1;

/*
 * We create some last tickets which won't be closed
 */

$sql = $dataBase->prepare('SELECT id FROM pr__user ORDER BY RAND() LIMIT 10');
$sql->execute();
$i = 0;
while($user = $sql->fetch()) {

    $newUser_id = $user['id'];
    
    /* For calculating random dates */
    $date1 = date("Y-m-d H:i:s");
    $date = new DateTime($date1);
    $date->modify('-1 days');
    $date1 = $date->format("Y-m-d H:i:s");
    
    $date2 = date("Y-m-d H:i:s");
    $date = new DateTime($date2);
    $date->modify('-6 hours');
    $date2 = $date->format("Y-m-d H:i:s");

    $newTicketID = 0;

    $randomTicket = mt_rand(1, 100);
    if($i <= 3) {
        $typeTicket = 'opened';
    } else if( $i <= 7) {
        $typeTicket = 'read';
    } else {
        $typeTicket = 'closed';
    }
    createTicketReplies();

    sql_ticketStatus($newTicketID, $typeTicket);
    
    $i++;
}

$totalEnd_time = microtime(TRUE);
$timeTaken = $totalEnd_time - $totalStart_time;
$timeTaken = round($timeTaken,3);

function get_AccountsAllMonth($total, $nbMonth, $percentAverage) {
    $array = array();
    $all = $total;
    $average = floor($total/$nbMonth); // average value
    $step = $average * $percentAverage; // 7% of the average value
    $start = $average - ($step * $nbMonth/2);
    $amount = 0;
    // Increase
    for( $i=1; $i<=$nbMonth; $i++) {
	if( $i != $nbMonth) {
	    $amount = floor( $start + $i * $step );
            if($amount<0) {
                $percentAverage = $percentAverage - 0.01;
                get_AccountsAllMonth($total, $nbMonth, $percentAverage);
            }
	    $all = $all - $amount;
	} else {
	    $amount = $total - array_sum($array);
	}
	$array[$i] = abs($amount);
    }
    return $array;
}

function get_stepAccounts() {
    
}

function createTicketReplies() {
    global $date1, $date2, $typeTicket, $showname, $listTicketShowname, $listTicketSubject, $listTicketMessage;
    global $newUser_id, $newTicketID;
    
    $messageDate = randomDate($date1, $date2);
    $newTicketID = sql_createTicket($newUser_id, $messageDate);

    if($typeTicket != 'opened') {
        $date = new DateTime($messageDate);
        $date->modify('+'.mt_rand(20,100).' minutes');
        $replyDate = $date->format("Y-m-d H:i:s");
        sql_createTicketReply($newUser_id, $newTicketID, $replyDate, 'support');
        
        $oneMoreTicket = mt_rand(1,100);
        if($oneMoreTicket <= 70) {
            
            $date = new DateTime($messageDate);
            $date->modify('+'.mt_rand(100,200).' minutes');
            $replyDate = $date->format("Y-m-d H:i:s");
            sql_createTicketReply($newUser_id, $newTicketID, $replyDate, 'user');
            
            $oneMoreTicket = mt_rand(1,100);
            if($oneMoreTicket <= 80) {
                
                $date = new DateTime($messageDate);
                $date->modify('+'.mt_rand(200,300).' minutes');
                $replyDate = $date->format("Y-m-d H:i:s");
                sql_createTicketReply($newUser_id, $newTicketID, $replyDate, 'support');
                
            }
        }
    }
}

function get_emailUnique($firstname, $lastname) {
    global $dataBase;
    global $listEmails_provider;

    $justFirstname = mt_rand(1,100);

    if(mt_rand(1,2) == 1) {
        $separator = '-';
    } else {
        $separator = '_';
    }
    if($justFirstname <= 5) {

        $noNumbers = mt_rand(1,100);

        if($noNumbers >= 10) {

            $num = mt_rand(1,2000);

            $email = $firstname.$separator.$num.'@'.$listEmails_provider[mt_rand(0, sizeof($listEmails_provider)-1)];

        } else {

            $email = $firstname.'@'.$listEmails_provider[mt_rand(0, sizeof($listEmails_provider)-1)];

        }

    } else {

        $noNumbers = mt_rand(1,100);

        if($noNumbers >= 10) {

            $num = mt_rand(1,2000);

            $email = $firstname.'.'.$lastname.$separator.$num.'@'.$listEmails_provider[mt_rand(0, sizeof($listEmails_provider)-1)];

        } else {

            $email = $firstname.'.'.$lastname.'@'.$listEmails_provider[mt_rand(0, sizeof($listEmails_provider)-1)];

        }

    }


    $sql = $dataBase->prepare('SELECT COUNT(*) AS total FROM pr__user WHERE email like :email');
    $sql->execute(array('email' => $email));
    $countEmail = $sql->fetch();

    if($countEmail['total'] == 0) {
        return $email;
    } else {
        return get_emailUnique($firstname, $lastname);
    }
}

function get_randomTime() {

    //Will return for example: 15:37:03
    return $time = sprintf("%02d", mt_rand(0,23)).':'.sprintf("%02d", mt_rand(0,59)).':'.sprintf("%02d", mt_rand(0,59));

}

function sql_createEmail_account() {
    global $firstname, $lastname, $lang, $email, $password, $userActivation_key, $creationDate, $lastSessionDate, $userAgent;
    global $dataBase;

    
    $sql = $dataBase->prepare('INSERT INTO pr__user(activation_key, email, firstname, lastname, lang, password, date_accountcreated, lastsession_date, agent)
                                            VALUES (:key, :email, :firstname, :lastname, :lang, :password, :date, :date_lastsession, :agent)');

    $sql->execute(['key'              => $userActivation_key,
                   'email'            => $email,
                   'firstname'        => $firstname,
                   'lastname'         => $lastname,
                   'lang'             => $lang,
                   'password'         => $password,
                   'date'             => $creationDate,
                   'date_lastsession' => $lastSessionDate,
                   'agent'            => $userAgent]);
    $newUser_id = $dataBase->lastInsertId();
    $sql->closeCursor();

    return $newUser_id;
}

function sql_createGoogle_account($oauthInsert = TRUE) {
    global $firstname, $lastname, $lang, $email, $newUser_id;
    global $dataBase;

    // User no yet registred with google+ oauth
    $sql = $dataBase->prepare('INSERT INTO pr__user_google (id, email, firstname, lastname, link, locale, picture, verified)
                                                    VALUES (:id, :email, :firstname, :lastname, :link, :locale, :picture, :verified)');

    $verified = (mt_rand(0,10) <= 1) ? 1 : 0;

    $googleId = uniqid(mt_rand(), true);
    $sql->execute(['id'         => $googleId,
                   'email'      => $email,
                   'firstname'  => $firstname,
                   'lastname'   => $lastname,
                   'link'       => 'https://plus.google.com/',
                   'locale'     => 'en',
                   'picture'    => NULL,
                   'verified'   => $verified]);
    $sql->closeCursor();

    if($oauthInsert) {
        // New entry in user_oauth
        $sql = $dataBase->prepare('INSERT INTO pr__user_oauth(user_id, google_id) VALUES(:user_id, :google_id)');
        $sql->execute(array('user_id'    => $newUser_id,
                            'google_id'  => $googleId));
        $sql->closeCursor();
    } else {
        // Update entry in user_oauth
        $sql = $dataBase->prepare('UPDATE pr__user_oauth SET google_id = :google_id WHERE user_id = :user_id');
        $sql->execute(array('google_id'  => $googleId,
                            'user_id'    => $newUser_id));
        $sql->closeCursor();
    }

}

function sql_createFacebook_account($oauthInsert = TRUE) {
    global $firstname, $lastname, $email, $newUser_id;
    global $dataBase;


    $facebookId = uniqid(mt_rand(), true);
    $verified = (mt_rand(0,10) <= 1) ? 1 : 0;
    $sql = $dataBase->prepare('INSERT INTO pr__user_facebook (id, email, firstname, lastname, link, locale, picture, verified)
                                                      VALUES (:id, :email, :firstname, :lastname, :link, :locale, :picture, :verified)');
    $sql->execute(['id'         => $facebookId,
                   'email'      => $email,
                   'firstname'  => $firstname,
                   'lastname'   => $lastname,
                   'link'       => 'https://www.facebook.com',
                   'locale'     => 'en',
                   'picture'    => NULL,
                   'verified'   => $verified]);

    $sql->closeCursor();

    if($oauthInsert) {
        // New entry in user_oauth
        $sql = $dataBase->prepare('INSERT INTO pr__user_oauth(user_id, facebook_id) VALUES(:user_id, :facebook_id)');
        $sql->execute(array('user_id'      => $newUser_id,
                            'facebook_id'  => $facebookId));
        $sql->closeCursor();
    } else {
        // Update entry in user_oauth
        $sql = $dataBase->prepare('UPDATE pr__user_oauth SET facebook_id = :facebook_id WHERE user_id = :user_id');
        $sql->execute(array('facebook_id'  => $facebookId,
                            'user_id'      => $newUser_id));
        $sql->closeCursor();
    }

}

function sql_createaddress($newUser_id, $addressName) {
    global $listAddressStreet, $listAddressCity, $listAddressState, $listAddressPostcode;
    global $dataBase;

    $line1 = mt_rand(20, 1600).' '.$listAddressStreet[mt_rand(0, (sizeof($listAddressStreet)-1))];
    $city = $listAddressCity[mt_rand(0, (sizeof($listAddressCity)-1))];
    $postcode = $listAddressPostcode[mt_rand(0, (sizeof($listAddressPostcode)-1))];

    $line2 = mt_rand(1, 100);
    if($line2 <= 10) {
        $line2 = 'Flat '.mt_rand(1, 100).', '.mt_rand(1, 30).'th Floor';
    } else {
        $line2 = NULL;
    }
    
    $sql = $dataBase->prepare('INSERT INTO pr__address(name, user_id, line1, line2, city, postcode, country_code)
                                                VALUES(:name, :id, :line1, :line2, :city, :postcode, :countrycode)');
    $sql->execute(array('name' => $addressName,
                        'id'  => $newUser_id,
                        'line1'  => $line1,
                        'line2' => $line2,
                        'city'  => $city,
                        'postcode'  => $postcode,
                        'countrycode'  => 'US'));
    $sql->closeCursor();

}

function sql_createTicket($newUser_id, $date) {
    global $listTicketSubject, $listTicketMessage;
    global $dataBase;

    $subject = $listTicketSubject[mt_rand(0, (sizeof($listTicketSubject)-1))];

    $message = generateParagraphs();
    
    $sql = $dataBase->prepare('INSERT INTO pr__ticket(user_id, date, subject, message)
                                               VALUES(:id, :date, :subject, :message)');
    
    $sql->execute(array('id'  => $newUser_id,
                        'date'  => $date,
                        'subject' => $subject,
                        'message'  => $message));
    $sql->closeCursor();

    $newTicketID = $dataBase->lastInsertId();

    return $newTicketID;

}

function sql_createTicketReply($newUser_id, $newTicketID, $replyDate, $reply_as) {
    global $listTicketMessage, $showname;
    global $dataBase;
    
    $message = $listTicketMessage[mt_rand(0, (sizeof($listTicketMessage)-1))];

    $message = generateParagraphs();

    if($reply_as == 'user') {
        $shownameTicket = NULL;
    } else {
        $shownameTicket = $showname;
    }

    $sql = $dataBase->prepare('INSERT INTO pr__ticket_reply(user_id, ticket_id, showname, date, message, reply_as)
                                                     VALUES(:user_id, :ticket_id, :showname, :date, :message, :as)');
    
    $sql->execute(array('user_id' => $newUser_id,
                        'ticket_id'  => $newTicketID,
                        'showname' => $shownameTicket,
                        'date' => $replyDate,
                        'message'  => $message,
                        'as'  => $reply_as));
    $sql->closeCursor();


}

function sql_ticketStatus($newTicketID, $status) {
    global $dataBase;

    $sql = $dataBase->prepare('UPDATE pr__ticket SET status = :status WHERE id = :id');
    $sql->execute(array('status' => $status,
                        'id' => $newTicketID));
    $sql->closeCursor();
}

function generateParagraphs() {
    global $listTicketMessage;

    $message = $listTicketMessage[mt_rand(0, (sizeof($listTicketMessage)-1))];
    
    $paragraphPlus = mt_rand(1, 100);
    if($paragraphPlus <= 50) {
        $message .= '

'.$listTicketMessage[mt_rand(0, (sizeof($listTicketMessage)-1))];
        
        $paragraphPlus = mt_rand(1, 100);
        if($paragraphPlus <= 40) {
            $message .= '

'.$listTicketMessage[mt_rand(0, (sizeof($listTicketMessage)-1))];
            
            $paragraphPlus = mt_rand(1, 100);
            if($paragraphPlus <= 30) {
                $message .= '

'.$listTicketMessage[mt_rand(0, (sizeof($listTicketMessage)-1))];
                
                $paragraphPlus = mt_rand(1, 100);
                if($paragraphPlus <= 10) {
                    $message .= '

'.$listTicketMessage[mt_rand(0, (sizeof($listTicketMessage)-1))];
                }
            }
        }
    }
    return $message;
}

function randomDate($start_date, $end_date) {
    // Convert to timetamps
    $min = strtotime($start_date);
    $max = strtotime($end_date);

    // Generate random number using above bounds
    $val = rand($min, $max);

    // Convert back to desired date format
    return date('Y-m-d H:i:s', $val);
}


function no_special_character($str){

    $str = preg_replace('#Ç#', 'C', $str);
    $str = preg_replace('#ç#', 'c', $str);
    $str = preg_replace('#è|é|ê|ë#', 'e', $str);
    $str = preg_replace('#È|É|Ê|Ë#', 'E', $str);
    $str = preg_replace('#à|á|â|ã|ä|å#', 'a', $str);
    $str = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $str);
    $str = preg_replace('#ì|í|î|ï#', 'i', $str);
    $str = preg_replace('#Ì|Í|Î|Ï#', 'I', $str);
    $str = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $str);
    $str = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $str);
    $str = preg_replace('#ù|ú|û|ü#', 'u', $str);
    $str = preg_replace('#Ù|Ú|Û|Ü#', 'U', $str);
    $str = preg_replace('#ý|ÿ#', 'y', $str);
    $str = preg_replace('#Ý#', 'Y', $str);

    return ($str);

}








?>
