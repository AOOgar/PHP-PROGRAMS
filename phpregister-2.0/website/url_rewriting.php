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

 * Creation: 2019, Vincent Marguerit
 * Modification: 
 */ 

require_once ('config/config.inc.php');
require_once ('include/php/global.inc.php');

$urlHash = explode('/', trim(strtok($_SERVER['REQUEST_URI'],'?'), '/'));

/**
 * In ErrorDocument 404 pages variables are not retrieved, 
 * so we parse the URL query (after ?) to create all $_GET variables 
 */
$parts = parse_url($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
if(isset($parts['query'])) {
    parse_str($parts['query'], $UrlVariables);
    foreach($UrlVariables as $key => $value) {
        $_GET[$key] = $value;
    }
}

/**
 * Variables that can be found in multiple pages through URL
   IE: with https://mywebsite.com/en/about/open/page2
       we get the variable: $_GET['open'] == 'page2';
 */
$globalVARS = ['open', 'key', 'number']; 
foreach($globalVARS as $oneVar) {
    if(in_array($oneVar, $urlHash)) {
        $key = array_search($oneVar, $urlHash);
        if(isset($urlHash[$key+1])) {
            $_GET[$oneVar] = $urlHash[$key+1];
        }
    }
}

/**
 * $posURLSection is 0 for URL without language specified.
 * http://mywebsite.com/contact
 */
$posURLSection = 0;

if(strlen($urlHash[0]) == 2) {
    if(in_array($urlHash[0], $config['Langs'])) {
        $_GET['Lang'] = $urlHash[0];
    } else {
        $_GET['Lang'] = $config['LangDefault'];
    }
    /**
     * $posURLSection is 1 for URL with language specified:
     * http://mywebsite.com/en/contact
     */
    $posURLSection = 1;
}

$sectionFound = FALSE;
if(isset($urlHash[$posURLSection]) && $sectionFound = check_URLSection($urlHash[$posURLSection], $siteSections)) { // Any page from $siteSections

    chdir('sections/'.$sectionFound['en']);
    header("Status: 200 OK", false, 200);
    require('sections/'.$sectionFound['en'].'/index.php');
    exit;

} else if(!isset($urlHash[$posURLSection]) || $urlHash[$posURLSection] == 'open' || // Home page on direct domain with or without language specified 
   (isset($urlHash[$posURLSection]) && in_array($urlHash[$posURLSection], $directPages)) ) { // Any page from $directPages

    if(!isset($urlHash[$posURLSection])) {
        /* Home page URL like http://mywebsite.com/en/ */
        $urlHash[$posURLSection] = 'home';
    }
    
    if(isset($urlHash[$posURLSection]) && 
       $urlHash[$posURLSection] == 'open') {
         /* Home page URL with open variable like http://mywebsite.com/en/open/something */
        if(isset($urlHash[$posURLSection+1])) {
            $_GET['open'] = $urlHash[$posURLSection+1];
        }
        $urlHash[$posURLSection] = 'home';
    }
    
    if($urlHash[$posURLSection] == 'account') {
        /* Accoount URL like http://mywebsite.com/en/account/profile/ */
        chdir($urlHash[$posURLSection].'/'.$urlHash[$posURLSection+1]);
        header("Status: 200 OK", false, 200);
        require($urlHash[$posURLSection].'/'.$urlHash[$posURLSection+1].'/index.php');
    } else {
        chdir($urlHash[$posURLSection]);
        header("Status: 200 OK", false, 200);
        require($urlHash[$posURLSection].'/index.php');
    }
    exit;

} else {
    
    /**
     * Check 404 -> Redirection
     */
    $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $sql = $dataBase->prepare('SELECT id, dest 
                               FROM pr__url_redirection 
                               WHERE src LIKE :src1 OR src LIKE :src2');
    $sql->execute(['src1' => $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
                   'src2' => $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']]);
    $redirect404 = $sql->fetch();
    $sql->closeCursor();
    
    if(!empty($redirect404)) {
        $sql = $dataBase->prepare('UPDATE pr__url_redirection 
                                   SET date_lastclick = :date,
                                       count_redirect = count_redirect+1
                                   WHERE id = :id');
        $sql->execute(['date' => date('Y-m-d H:i:s'),
                       'id'   => $redirect404['id']]);
        $sql->closeCursor();
        header("Status: 301 Moved Permanently", false, 301);
        header('Location: '.$redirect404['dest']);
        exit;
    }

    chdir('404');
    header("HTTP/1.0 404 Not Found", TRUE, 404);
    require ('404/index.php');

}



?>
