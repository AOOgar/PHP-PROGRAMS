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

function img_socialNetworkCopy($image, $userId) {
    global $dataBase, $socialNetwork;

    if($socialNetwork == 'facebook') {
        //Get the biggest size of Facebook profile picture
        $image .= '?width=1000';
    }

    if($data = file_get_contents($image)) {
        $fileId = get_uniqueIdDatabase($sql = 'SELECT count(*) AS num FROM pr__user WHERE picture = :id');
        $userLocalImage = _PATHROOT.'include/images/_uploads/profiles_pictures/'.$fileId.'.jpg';
        $file = fopen($userLocalImage, 'w+');
        fputs($file, $data);
        fclose($file);
        if(img_copyResized($userLocalImage, 
                           _PATHROOT.'include/images/_uploads/profiles_pictures/'.$fileId.'-100.jpg', 100) &&
           img_copyResized($userLocalImage, 
                           _PATHROOT.'include/images/_uploads/profiles_pictures/'.$fileId.'-500.jpg', 500)) {
            $sql = $dataBase->prepare('UPDATE pr__user 
                                           SET picture = :picture
                                           WHERE id = :id');
            $sql->execute(['picture'  => $fileId,
                           'id'       => $userId]);
            $sql->closeCursor();
            echo 'in';
        } else {
            echo 'not';
        }
    }
}

/**
 *  We check if the user exist in pr__user_google table
 */
$sql = $dataBase->prepare('SELECT COUNT(id) AS usercount
                           FROM pr__user_'.$socialNetwork.'
                           WHERE id = :id');
$sql->execute(['id' => $userSocialNetwork['id']]);
$user = $sql->fetch();
$sql->closeCursor();

$accountCreated = FALSE;

if($user['usercount'] == 0) {
    $accountCreated = TRUE;
    /**
     *  User no yet registred with social network (facebook or google) oauth
     */
    $sql = $dataBase->prepare('INSERT INTO pr__user_'.$socialNetwork.'(id,
                                                                       email,
                                                                       firstname,
                                                                       lastname,
                                                                       link,
                                                                       locale,
                                                                       picture,
                                                                       verified)
                               VALUES (:id,
                                       :email,
                                       :firstname,
                                       :lastname,
                                       :link,
                                       :locale,
                                       :picture,
                                       :verified)');
    $sql->execute(['id'         => $userSocialNetwork['id'],
                   'email'      => $userSocialNetwork['email'],
                   'firstname'  => $userSocialNetwork['firstname'],
                   'lastname'   => $userSocialNetwork['lastname'],
                   'link'       => $userSocialNetwork['link'],
                   'locale'     => $userSocialNetwork['locale'],
                   'picture'    => $userSocialNetwork['picture'],
                   'verified'   => $userSocialNetwork['verified']]);
    $sql->closeCursor();
    
    /**
     *  We check if there is already an account with this email
     */
    
    $sql = $dataBase->prepare('SELECT id, lang
                               FROM pr__user
                               WHERE email = :email');
    $sql->execute(['email' => $userSocialNetwork['email']]);
    $rowsCount = $sql->rowCount();
    
    if($rowsCount == 0) {

        /**
         *  No account with this email
         */
        $sql = $dataBase->prepare('INSERT INTO pr__user(email,
                                                        firstname,
                                                        lastname,
                                                        lang,
                                                        date_accountcreated,
                                                        ip_accountcreated,
                                                        lastsession_ip,
                                                        lastsession_date,
                                                        agent) 
                                   VALUES (:email,
                                           :firstname,
                                           :lastname,
                                           :lang,
                                           :date,
                                           :ip,
                                           :lastsession_ip,
                                           :lastsession_date,
                                           :agent)');
        $sql->execute(['email'      => $userSocialNetwork['email'],
                       'firstname'  => $userSocialNetwork['firstname'],
                       'lastname'   => $userSocialNetwork['lastname'],
                       'lang'       => $config['UserLang'],
                       'date'       => date("Y-m-d H:i:s"),
                       'ip'         => get_IPClient(),
                       'lastsession_ip'    => get_IPClient(),
                       'lastsession_date'  => date('Y-m-d H:i:s'),
                       'agent'      => substr($_SERVER['HTTP_USER_AGENT'], 0, 150)]);
        
        /**
         *  We recover the new User Id
         */
        $newUserId = $dataBase->lastInsertId();
        $sql->closeCursor();
        
        /**
         *  We associate the OAuth Id and the User Id
         */
        $sql = $dataBase->prepare('INSERT INTO pr__user_oauth(user_id,
                                                              '.$socialNetwork.'_id)
                                   VALUES (:user_id,
                                           :'.$socialNetwork.'_id)');
        $sql->execute(['user_id'    => $newUserId,
                       $socialNetwork.'_id'  => $userSocialNetwork['id']]);
        $sql->closeCursor();

        $user['id'] = $newUserId;
        $user['lang'] = $config['UserLang'];


        /**
         * Copy Social Network Picture
         */
        img_socialNetworkCopy($userSocialNetwork['picture'], $newUserId);
        
        sess_create($user, $socialNetwork);
        
    } else {
        
        /**
         *  Already an account with this email
         *  We recover the User Id
         */
        $user = $sql->fetch();
        $sql->closeCursor();
        
        /**
         *  We check if this User Id is already registrer in pr__user_oauth
         *  This is possible if the user is already registred with another social button
         */
        $sql = $dataBase->prepare('SELECT COUNT(id) AS oauthcount
                                   FROM pr__user_oauth
                                   WHERE user_id = :id');
        $sql->execute(['id' => $user['id']]);
        $count = $sql->fetch();
        $sql->closeCursor();
        
        if($count['oauthcount'] == 0) {
            /** 
             *  New entry in pr__user_oauth
             */
            
            $sql = $dataBase->prepare('INSERT INTO pr__user_oauth(user_id,
                                                                  '.$socialNetwork.'_id)
                                       VALUES(:user_id, :'.$socialNetwork.'_id)');
            $sql->execute(['user_id'    => $user['id'],
                           $socialNetwork.'_id'  => $userSocialNetwork['id']]);
            $sql->closeCursor();
            
        } else {
            /**
             *  Modify entry in pr__user_oauth
             */
            
            $sql = $dataBase->prepare('UPDATE pr__user_oauth
                                       SET '.$socialNetwork.'_id = :'.$socialNetwork.'_id
                                       WHERE user_id = :user_id');
            $sql->execute([$socialNetwork.'_id'  => $userSocialNetwork['id'],
                           'user_id'    => $user['id']]);
            $sql->closeCursor();
        }
        
        $sql = $dataBase->prepare('UPDATE pr__user
                                   SET lastsession_ip = :ip, lastsession_date = :date, agent = :agent
                                   WHERE id = :id');
        $sql->execute(['ip'    => get_IPClient(),
                       'date'  => date("Y-m-d H:i:s"),
                       'agent' => substr($_SERVER['HTTP_USER_AGENT'], 0, 150),
                       'id'    => $user['id']]);
        $sql->closeCursor();

        $sql = $dataBase->prepare('SELECT picture FROM pr__user
                                   WHERE id = :id');
        $sql->execute(['id' => $user['id']]);
        $userInfos = $sql->fetch();
        if($userInfos['picture']  == NULL) {
            /**
             * Copy Social Network Picture
             */
            img_socialNetworkCopy($userSocialNetwork['picture'], $user['id']);
        }

        sess_create($user, $socialNetwork);
    }
    
} else {
    
    /**
     *  User already registred with social network (facebook or google) oauth
     */
    $sql = $dataBase->prepare('SELECT pr__user_oauth.user_id AS id, pr__user.lang
                               FROM pr__user_oauth
                               LEFT JOIN pr__user ON pr__user_oauth.user_id = pr__user.id
                               WHERE '.$socialNetwork.'_id = :'.$socialNetwork.'_id');
    $sql->execute([$socialNetwork.'_id' => $userSocialNetwork['id']]);
    $userOAuth = $sql->fetch();
    $sql->closeCursor();
    
    $sql = $dataBase->prepare('UPDATE pr__user
                               SET lastsession_ip = :ip, lastsession_date = :date, agent = :agent
                               WHERE id = :id');
    $sql->execute(['ip'    => get_IPClient(),
                   'date'  => date("Y-m-d H:i:s"),
                   'agent' => substr($_SERVER['HTTP_USER_AGENT'], 0, 150),
                   'id'    => $userOAuth['id']]);
    
    sess_create($userOAuth, $socialNetwork);
    
}


$redirectLink = '';

$sessionUser = get_userInfos();

 if(isset($_COOKIE['OAuthRedirect']) && $_COOKIE['OAuthRedirect'] != '') {
     $redirect = urldecode(decrypt($_COOKIE['OAuthRedirect'], $config['KeyOAuthRedirect']));
     $redirect = ltrim($redirect, '/');
     unset($_GET['r']);
     header('Location: '.get_URL($sessionUser['lang']).'/'.$redirect);
     exit;
}


header('Location: '.get_URL($sessionUser['lang']).'/'.$redirectLink);


?>
