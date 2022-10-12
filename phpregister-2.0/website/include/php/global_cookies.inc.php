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
 *  By requiring this file we call for the function check_cookies()
 *  This function will be called another time on oauth_redirect.php to empty $_COOKIE['OAuthRedirect']
 */

$updateCookie = FALSE;

/**
 * All Cookies are in $_COOKIE['Datas'] and we split it in multiples  _$COOKIE[...]
 */

if(isset($_COOKIE['Datas'])) {
    $cookie = json_decode($_COOKIE['Datas']);
    if(is_object($cookie)) {
        foreach($cookie->Data as $key => $value) {
            $_COOKIE[$key] = $value;
        }
    } else {
        /**
         * To avoid error $cookie is not an Object if Datas is empty
         * Should not happen except by modifying the cookie by hand in browser
         */
        setcookie('Datas', null, -1, '/');
    }
}

/***
 *  Show Translates Ids
 */  
if(isset($_GET['ShowTranslatesIds'])) {
    $cookiesInfos['ShowTranslatesIds'] = $_GET['ShowTranslatesIds'];
    $updateCookie = TRUE;
} else if(isset($_COOKIE['ShowTranslatesIds'])) {
    $cookiesInfos['ShowTranslatesIds'] = $_COOKIE['ShowTranslatesIds'];
} else {
    $cookiesInfos['ShowTranslatesIds'] = 0;
}
$_COOKIE['ShowTranslatesIds'] = $cookiesInfos['ShowTranslatesIds'];

/**
 *  Languages
 */
$config['UserLang'] = $config['LangDefault'];
if(isset($_GET['Lang'])) {
    if(in_array($_GET['Lang'], $config['Langs'])) {
        $config['UserLang'] = $_GET['Lang'];
    }
    
    if((isset($_COOKIE['Lang']) && $_COOKIE['Lang'] != $_GET['Lang']) || 
       !isset($_COOKIE['Lang'])) {
        $updateCookie = TRUE;
        //echo 'Testing / Update Lang Cookie...';
    }
    
    /**
     *  Updating the language in database pr__user table
     */
    /*
       Admin Demo
    if(isset($_SESSION['UserId']) && 
       (isset($_SESSION['user_lang']) && $_SESSION['user_lang'] != $_GET['Lang']) && // User Session Lang different from $_GET['Lang']
       $_SESSION['type'] != 'logas')  { // "Login as" feature used by an Admin
        
        $sql = $dataBase->prepare('UPDATE pr__user
                                       SET lang = :lang
                                       WHERE id = :id');
        $sql->execute(['lang'  => $_GET['Lang'],
                       'id'    => get_userIdSession()]);
        $sql->closeCursor();
        $_SESSION['user_lang'] = $_GET['Lang'];
        $config['UserLang'] = $_SESSION['user_lang'];
    }
    */
} else {
    /*
     * No language specified in URL
     */
    /* Admin DEMO
    if(isset($_SESSION['user_lang'])) {
        $config['UserLang'] = $_SESSION['user_lang'];
    } else */

    if(isset($_COOKIE['Lang'])) {
        $config['UserLang'] = $_COOKIE['Lang'];
    } else {
        /**
         *  Check the browser language and if available in array $config['Langs']
         */
        $browserLang = substr(@$_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        if(in_array($browserLang, $config['Langs'])) {
            $config['UserLang'] = $browserLang;
        } else {
            $config['UserLang'] = $config['LangDefault'];
        }
    }
}

$cookiesInfos['Lang'] = $config['UserLang'];    

/**
 *  OAuth Redirect
 */
if(isset($_GET['r']) && $_GET['r'] != 'noupdate') {
    $updateCookie = TRUE;
    $_COOKIE['OAuthRedirect'] = $_GET['r'];
    $cookiesInfos['OAuthRedirect'] = $_GET['r'];
}
if(!isset($_GET['r']) && !isset($_COOKIE['OAuthRedirect'])) {
    $_COOKIE['OAuthRedirect'] = '';
}
if(!isset($_GET['r']) && $_COOKIE['OAuthRedirect'] != '') {
    $updateCookie = TRUE;
    $_COOKIE['OAuthRedirect'] = '';
    $cookiesInfos['OAuthRedirect'] = '';
}


/**
 *  Set Cookie if needed
 */
if($updateCookie && !check_bot()) { // We check also if Cookies are enabled
    $expiry = time() + ($config['CookieLifetime'] * 86400); // We transform Days in seconds (Unix time)
    
    $cookiesArray = [];
    $cookiesArray['Data'] = [];
    foreach($cookiesInfos as $key => $val) {
        $cookiesArray['Data'][$key] = $val;
    }
    $cookiesArray['expiry'] = $expiry;
    
    setcookie('Datas', null, -1, '/');
    setcookie('Datas', json_encode($cookiesArray), $expiry, '/');
}

?>
