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
 * Check if $config['KeyPassword'] / $config['KeyEmail'] / $config['KeySessionID'] / $config['KeyOAuthRedirect']
 * has been filled in config.inc.php file
 * This check can be removed once these variable has been filled...
 */
if($config['KeyPassword'] == '' || $config['KeyEmail'] == '' || $config['KeySessionID'] == '' || $config['KeyOAuthRedirect'] == '') {
    echo '<p>For security reasons, by default the values of the following variables are empty:
            <ul>
               <li>$config[\'KeyPassword\']</li><li>$config[\'KeyEmail\']</li><li>$config[\'KeySessionID\']</li><li>$config[\'KeyOAuthRedirect\']</li>
             </ul>
          </p>
          <p>Please, edit the file /config/config.inc.php to fill them with some random characters.</p>';
    exit;
}

/**
 *  Database Connexion
 */
function db_PDOConnect() {
    global $config;
    
    try {
        $dataBase = new PDO('mysql:host='.$config['DatabaseDomain'].';port='.$config['DatabasePort'].';dbname='.$config['DatabaseName'].';charset=utf8', 
                            $config['DatabaseUser'], $config['DatabasePassword'], [PDO::MYSQL_ATTR_FOUND_ROWS => true,
                                                                                   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (PDOException $e) {
        echo 'Error PDO Database connexion : '.$e->getMessage();
        exit;
    }

    $sql = $dataBase->prepare('SELECT * FROM pr__website_option');
    $sql->execute();
    $sqlOptions = $sql->fetchAll();
    $sql->closeCursor();
    foreach($sqlOptions as $oneOption) {
        if(in_array($oneOption['value'], ['TRUE', 'true'])) {
            $config[$oneOption['name']] = TRUE;
        } else if(in_array($oneOption['value'], ['FALSE', 'false'])) {
            $config[$oneOption['name']] = FALSE;
        } else {
            $config[$oneOption['name']] = $oneOption['value'];
        }
    }
    return $dataBase;
}

$dataBase = db_PDOConnect();

/**
 * Function used in url_rewriting.php to check if the URL is 404 or a section page
 */
function check_URLSection($section, $allSections) {
    foreach($allSections as $key => $val) {
        if($key === $section) {
            return ['en' => $key];
            break;
        }
        foreach($val as $key2 => $val2) {
            if($val2 === $section) {
                return ['en'  => $key,
                        $key2 => $val2];
                break 2;
            }
        }
    }
    return FALSE;
}

/**
 * Function used to generate links according to the user lang
 */
function get_sectionLang($section, $allSections, $lang = NULL) {
    global $config, $pretty;
    if($lang == NULL) $lang = $config['UserLang'];
    if($lang == 'en') {
        return $section;
    }
    foreach($allSections[$section] as $key => $val) {
        if($lang === $key) {
            return $val;
            break;
        }
    }
}

/**
 *  Session Cookie
 */
function sess_cookieStart() {
    global $config;

    $sessionLifetime = $config['SessionLifetime'] * 86400; // We transform Days in seconds

    ini_set('session.gc_maxlifetime', $sessionLifetime);
    ini_set('session.gc_probability', 1);
    ini_set('session.gc_divisor', 10000);
    ini_set('session.name', $config['SessionName']);
    
    if(isset($config['sessionSavePath']) && $config['sessionSavePath'] != '') {
        session_save_path($config['sessionSavePath']);
    }
    session_set_cookie_params($sessionLifetime,"/");
    session_start();
}

if( !check_bot() ) { 
    // No session Cookie for bots (They create one for each page visited!)
    sess_cookieStart();
}

function check_bot() {
    $isbot = false;
    $bot_regex = '/BotLink|bingbot|AhrefsBot|ahoy|AlkalineBOT|anthill|appie|arale|araneo|AraybOt|ariadne|arks|ATN_Worldwide|Atomz|bbot|Bjaaland|Ukonline|borg\-bot\/0\.9|boxseabot|bspider|calif|christcrawler|CMC\/0\.01|combine|confuzzledbot|CoolBot|cosmos|Internet Cruiser Robot|cusco|cyberspyder|cydralspider|desertrealm, desert realm|digger|DIIbot|grabber|downloadexpress|DragonBot|dwcp|ecollector|ebiness|elfinbot|esculapio|esther|fastcrawler|FDSE|FELIX IDE|ESI|fido|KIT\-Fireball|fouineur|Freecrawl|gammaSpider|gazz|gcreep|golem|googlebot|griffon|Gromit|gulliver|gulper|hambot|havIndex|hotwired|htdig|iajabot|INGRID\/0\.1|Informant|InfoSpiders|inspectorwww|irobot|Iron33|JBot|jcrawler|Teoma|Jeeves|jobo|image\.kapsi\.net|KDD\-Explorer|ko_yappo_robot|label\-grabber|larbin|legs|Linkidator|linkwalker|Lockon|logo_gif_crawler|marvin|mattie|mediafox|MerzScope|NEC\-MeshExplorer|MindCrawler|udmsearch|moget|Motor|msnbot|muncher|muninn|MuscatFerret|MwdSearch|sharp\-info\-agent|WebMechanic|NetScoop|newscan\-online|ObjectsSearch|Occam|Orbsearch\/1\.0|packrat|pageboy|ParaSite|patric|pegasus|perlcrawler|phpdig|piltdownman|Pimptrain|pjspider|PlumtreeWebAccessor|PortalBSpider|psbot|Getterrobo\-Plus|Raven|RHCS|RixBot|roadrunner|Robbie|robi|RoboCrawl|robofox|Scooter|Search\-AU|searchprocess|Senrigan|Shagseeker|sift|SimBot|Site Valet|skymob|SLCrawler\/2\.0|slurp|ESI|snooper|solbot|speedy|spider_monkey|SpiderBot\/1\.0|spiderline|nil|suke|http:\/\/www\.sygol\.com|tach_bw|TechBOT|templeton|titin|topiclink|UdmSearch|urlck|Valkyrie libwww\-perl|verticrawl|Victoria|void\-bot|Voyager|VWbot_K|crawlpaper|wapspider|WebBandit\/1\.0|webcatcher|T\-H\-U\-N\-D\-E\-R\-S\-T\-O\-N\-E|WebMoose|webquest|webreaper|webs|webspider|WebWalker|wget|winona|whowhere|wlm|WOLP|WWWC|none|XGET|Nederland\.zoek|AISearchBot|woriobot|NetSeer|Nutch|YandexBot|YandexMobileBot|SemrushBot|FatBot|MJ12bot|DotBot|AddThis|baiduspider|m2e/i';
    $userAgent = empty($_SERVER['HTTP_USER_AGENT']) ? FALSE : $_SERVER['HTTP_USER_AGENT'];
    $isBot = !$userAgent || preg_match($bot_regex, $userAgent);
    return $isBot;
}


function get_URL($lang = FALSE) {
    global $config;
    
    if(!$lang) {
        return $config['URL'].'/'.$config['UserLang'];
    } else {
        return $config['URL'].'/'.$lang;
    }
    
}

/**
 *  Init Variable Translations Langs
 */
function init_langVars($pages, $targetLangs = NULL) {
    global $config, $translateLangs, $translateLangsPage, $dataBase, $pretty;
    $translateLangsPage = [];
    $sqlWhere = '';
    foreach($pages as $onePage) {
        array_push($translateLangsPage, $onePage);
        $sqlWhere .= ' page LIKE "'.$onePage.'" OR';
    }
    $sqlWhere = rtrim($sqlWhere, 'OR');
    if($targetLangs == NULL) {
        $targetLangs = [$config['UserLang']];
    }
    if(!in_array($config['misstranslation_defaultlang'], $targetLangs)) {
        array_push($targetLangs, $config['misstranslation_defaultlang']);
    }
    $sqlLangs = '';
    foreach($targetLangs as $oneLang) {
        $sqlLangs .= $oneLang.', ';
    }
    $sqlLangs = rtrim($sqlLangs, ', ');
    $sql = $dataBase->prepare('SELECT id, page, name, '.$sqlLangs.' FROM pr__translation WHERE'.$sqlWhere);
    $sql->execute();
    $translations = $sql->fetchAll();
    $sql->closeCursor();
    foreach($translations as $oneTranslate) {
        foreach($targetLangs as $oneLang) {
            $translateLangs[$oneTranslate['page']][$oneTranslate['name']][$oneLang] = $oneTranslate[$oneLang];
        }
        $translateLangs[$oneTranslate['page']][$oneTranslate['name']]['id'] = $oneTranslate['id'];
    }
}


/**
 *  Get Lang from $translateLangs
 */
function lg($name, $page = NULL, $clickIds = TRUE, $lang = NULL) {
    global $config, $translateLangs, $translateLangsPage;

    if($lang == NULL) $lang =  $config['UserLang'];
    if($page == NULL) $page =  $translateLangsPage[0];    
    if(!isset($translateLangs[$page][$name][$lang])) {
        return '<i>'.$name.'</i>';
    }
    
    if($translateLangs[$page][$name][$lang] == '' || $translateLangs[$page][$name][$lang] == NULL) {
        $varLang = $translateLangs[$page][$name][$config['misstranslation_defaultlang']];
    } else {
        $varLang = $translateLangs[$page][$name][$lang];
    }
    if( (isset($_GET['open']) && $_GET['open'] == 'translate') ||
        (isset($_COOKIE['ShowTranslatesIds']) && $_COOKIE['ShowTranslatesIds'] == 1) ) {
        $cssSpanNumber = '';
        if(check_adminRights('translations')) {
            $cssSpanNumber = 'span-translate-number-admin';
        }
        if($clickIds == TRUE) {
            return '<span id=\'SpanTranslate'.$translateLangs[$page][$name]['id'].'\' class=\'span-translate\'>'.$varLang.'</span><span onClick=\'openTranslate('.$translateLangs[$page][$name]['id'].');\' class=\'span-translate-number '.$cssSpanNumber.'\'>'.$translateLangs[$page][$name]['id'].'</span>';
        } else {
            return $varLang.' ['.$translateLangs[$page][$name]['id'].']';
        }

    } else {
        return $varLang;
    }
}

/**
 *  Get User Id from Session Encrypted ID
 */
function get_userIdSession() {
    global $config;
    if(isset($_SESSION['UserId'])) {
        return decrypt($_SESSION['UserId'], $config['KeySessionID']);
    } else {
        return NULL;
    }
}

/**
 *  Display Pretty var_dump
 *  Use: echo  $pretty($myVarArray);
 */
$pretty = function($v='',$c="&nbsp;&nbsp;&nbsp;&nbsp;",$in=-1,$k=null)use(&$pretty){$r='';if(in_array(gettype($v),array('object','array'))){$r.=($in!=-1?str_repeat($c,$in):'').(is_null($k)?'':"$k: ").'<br>';foreach($v as $sk=>$vl){$r.=$pretty($vl,$c,$in+1,$sk).'<br>';}}else{$r.=($in!=-1?str_repeat($c,$in):'').(is_null($k)?'':"$k: ").(is_null($v)?'&lt;NULL&gt;':"<strong>$v</strong>");}return '<span class="pl-3">'.$r.'</span>';};

/**
 *  GET User Information
 *  Go to global variable $sessionUser
 */
function get_userInfos() {
    global $dataBase, $config, $pretty;

    $sql = $dataBase->prepare('SELECT pr__user.id AS user_id, pr__user.firstname, pr__user.lastname, pr__user.email, pr__user.picture, pr__user.lang
                               FROM pr__user
                               WHERE pr__user.id = :id');
    $sql->execute(['id' => get_userIdSession()]);
    $user = $sql->fetch();
    $sql->closeCursor();
    $user['adminrights'] = get_userAdminRights();
    return $user;
}

if(isset($_SESSION['UserId'])) {
    $sessionUser = get_userInfos();
}

/**
 *  SESSION Create / Delete
 */
function sess_create($user, $type='email') {
    global $config, $dataBase, $sessionUser;
    
    $_SESSION['UserId'] = encrypt($user['id'], $config['KeySessionID']);
    $_SESSION['user_lang'] = $user['lang'];
    $_SESSION['type'] = $type;

    $sessionUser = get_userInfos();
}

function sess_delete() {
    
    unset($_SESSION['UserId']);
    unset($_SESSION['user_lang']);
    unset($_SESSION['type']);
    unset($_SESSION['access_token']);
    
}

/**
 *  Encrypt / Decrypt
 *  For 
 *  - Encrypting e-mail link account creation
 *  - Users ID used on SESSION
 */
function encrypt($string, $key) {
    
    $result = '';
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)+ord($keychar));
        $result .= $char;
    }
    
    return base64_encode($result);
    
}

function decrypt($string, $key) {
    
    $result = '';
    $string = base64_decode($string);
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)-ord($keychar));
        $result.=$char;
    }
    return $result;
    
}

/**
 *  Encrypt password
 *  Avoid using sha1 directly
 */
function hash_password($string) {
    global $config;
    
    $result = '';
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($config['KeyPassword'], ($i % strlen($config['KeyPassword']))-1, 1);
        $char = chr(ord($char)+ord($keychar));
        $result.=$char;
    }
    
    return sha1($result);
    
}

/**
 *  Test if variable or index of an array exists 
 */
function issetor(&$var, $default = FALSE, $addBefore = '', $addAfter = '') {
    return isset($var) ? $addBefore.$var.$addAfter : $default;
}


/**
 *  Functions Get CSS/JS Main File
 *  Avoid browsers cache...and modify the filename on
 *  change
 *  
 *  This file must 
 *    - start by namefile- For example: main-
 *    - be in /include/css/
 */

function get_cssFiles($files) {
    global $config;
    
    $i = 0;
    $dirScan = scandir(_PATHROOT.'include/css');
    foreach($files as $oneCssFile) {
        foreach(preg_grep('~^'.$oneCssFile.'-.*\.(css)$~', $dirScan) as $onefile) {
            $cssFiles[$i] = $onefile;
            //break; /* Without break to get the last version of a CSS file */
        }
        $i++;
    }
    return $cssFiles;
}

function get_jsFiles($files) {
    global $config;
    
    $i = 0;
    $dirScan = scandir(_PATHROOT.'include/js');
    foreach($files as $oneJsFile) {
        foreach (preg_grep('~^'.$oneJsFile.'-.*\.(js)$~', $dirScan) as $onefile) {
            $jsFiles[$i] = $onefile;
            //break; /* No break to get the last version of a JS file */
        }
        $i++;
    }
    return $jsFiles;
}

/**
 * File Size Check
 */
function get_bytes($size_str) {
    switch (substr ($size_str, -1)) {
        case 'M': case 'm': return (int)$size_str * 1048576;
        case 'K': case 'k': return (int)$size_str * 1024;
        case 'G': case 'g': return (int)$size_str * 1073741824;
        default: return $size_str;
    }
}

function max_file_upload_in_bytes() {
    //select maximum upload size
    $max_upload = get_bytes(ini_get('upload_max_filesize'));
    //select post limit
    $max_post = get_bytes(ini_get('post_max_size'));
    //select memory limit
    $memory_limit = get_bytes(ini_get('memory_limit'));
    // return the smallest of them, this defines the real limit
    return min($max_upload, $max_post, $memory_limit);
}

/**
 *  GET IP USER 
 */
function get_IPClient() { 
    
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if(isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

/**
 *  Google Sign In auth URL
 */
function oauth_google() {
    global $config;

    /**
     * Make an API request on behalf of a user. In
     * this case we need to have a valid OAuth 2.0
     * token for the user, so we need to send them
     * through a login flow. To do this we need some
     * inf ormation from our API console project.
     */
    $client = new Google_Client();
    $client->setClientId($config['GoogleClientID']);
    $client->setClientSecret($config['GoogleClientSecret']);
    $client->setRedirectUri($config['GoogleRedirectURI']);
    $client->addScope('email');
    $client->addScope('profile');
    
    /**
     * When we create the service here, we pass the
     * client to it. The client then queries the service
     * for the required scopes, and uses that when
     * generating the authentication URL later.
     */
    $service = new Google_Service_Oauth2($client);
    
    
    /**
     * If we have an access token, we can make
     * requests, else we generate an authentication URL.
     */
    return $client->createAuthUrl();
    
}

/**
 *  Facebook Sign In auth URL
 */
function oauth_facebook() {
    global $config;
    
    if( $config['FacebookAppID'] == '' || $config['FacebookAppSecret'] == '') {
        return '';
    }

    $fb = new Facebook\Facebook([
        'app_id' => $config['FacebookAppID'], 
        'app_secret' => $config['FacebookAppSecret'],
        'default_graph_version' => 'v4.0',
    ]);
    
    $helper = $fb->getRedirectLoginHelper();
    
    $permissions = $config['FacebookRequiredScope']; // Optional permissions
    $loginUrl = $helper->getLoginUrl($config['FacebookRedirectURL'], $permissions);
    
    return htmlspecialchars($loginUrl);
    
}

function get_linksMetaHeader_MenuTop() {
    global $config, $linksLangsMenu, $sectionFound, $siteSections;

    $linksMetaHeader = [];
    $linksLangsMenu = []; // For Footer change lang

    
    $_SERVER['REQUEST_URI'] = rtrim($_SERVER['REQUEST_URI'], '/');
    $urlParts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    if(strlen($urlParts[0]) == 2) {
        $_SERVER['REQUEST_URI'] = implode('', explode($urlParts[0], $_SERVER['REQUEST_URI'], 2));
        $_SERVER['REQUEST_URI'] = str_replace('//', '/', $_SERVER['REQUEST_URI']);
    }
    if($sectionFound) {
        $partActual = get_sectionLang($sectionFound['en'], $siteSections, $config['UserLang']);
    }
    
    foreach($config['Langs'] as $oneLang) {
        if($oneLang != $config['UserLang']) {
            $requestURI = $_SERVER['REQUEST_URI'];
            if($sectionFound) {
                $requestURI = str_replace($partActual, get_sectionLang($sectionFound['en'], $siteSections, $oneLang), $_SERVER['REQUEST_URI']);
            }
            $langAl = $oneLang;
            $langShow = ($oneLang == 'en') ? 'en-US' : $oneLang;
            $link = '<link rel="alternate" href="'.$config['URL']
                   .'/'.$langAl
                   .$requestURI
                   .'" hreflang="'.$langShow.'"/>';
            $linksLangsMenu[$oneLang] = $config['URL'].'/'
                                       .$oneLang
                                       .$requestURI;
            array_push($linksMetaHeader, $link);
        }
    }
    
    if(($_SERVER['REQUEST_URI'] == '' || $_SERVER['REQUEST_URI'] == '/') && 
       ($config['UserLang'] == 'en') ) { // If is empty and we are at home page
        $link = '<link rel="canonical" href="'.$config['URL'].'">';
    } else {
        $currentLang = ($config['UserLang'] == 'en') ? '' : '/'.$config['UserLang'];
        $link = '<link rel="canonical" href="'.$config['URL'].$currentLang.$_SERVER['REQUEST_URI'].'">';
    }

    array_push($linksMetaHeader, $link);
    return [$linksMetaHeader, $linksLangsMenu];
}

/**
 *  Check if folder Exists.
 *  If not exists, create folder with rights to write inside
 */
function check_folderExists($folder) {
    if(!file_exists($folder)) {
        mkdir($folder, 0775, true);
        chmod($folder, 0775);
    }
}

function get_uniqueIdDatabase($sqlWithId, $lenght = 12) {
    global $dataBase;
    while(1) {
        $uniqueId = get_stringSuffle($lenght, FALSE); // False -> No upper case
        $sql = $dataBase->prepare($sqlWithId);
        $sql->execute(['id'  => $uniqueId]);
        $countUniqueId = $sql->fetch();
        if($countUniqueId['num'] == 0) { break; }
        $sql->closeCursor();
    }
    return $uniqueId;
}

/**
 *  Getting Languages of Countries Names in table pr__country
 *  Return the Language of User if availabe, if not the Default Language
 *  Used in details_display.inc.php, ajax_address.php
 */
function get_countryLanguage() {
    global $config, $dataBase;
    
    $sql = $dataBase->prepare('SELECT COLUMN_NAME
                               FROM INFORMATION_SCHEMA.COLUMNS
                               WHERE TABLE_SCHEMA = :database AND TABLE_NAME = :table');

    $sql->execute([':database'  => $config['DatabaseName'],
                   ':table'     => 'pr__country']);
    $countryLangs = $sql->fetchAll();
    $sql->closeCursor();
    $countryLangShow = $config['LangDefault'];
    foreach($countryLangs as $oneLang) {
        if($oneLang['COLUMN_NAME'] == $config['UserLang']) {
            $countryLangShow = $oneLang['COLUMN_NAME'];
            break;
        }
    }
    return $countryLangShow;
}

function get_dateFormatLang($dateString, $disHours=FALSE) {
    global $config;
    
    $dateObject = new DateTime($dateString);
    if($config['UserLang'] == 'en') {
        if($disHours) {
            return $dateObject->format('Y/d/m h:i A');
        } else {
            return $dateObject->format('Y/d/m');
        }
    } else {
        if($disHours) {
            return $dateObject->format('d/m/Y H:i');
        } else {
            return $dateObject->format('d/m/Y');
        }
    }
}

function get_dateFormatLangHumanReadable($date = NULL, $showYear = FALSE) {
    global $config;

    if($date == NULL) {
        $date = date('Y-m-d H:m:s');
    }
    $dateObject = new DateTime($date);
    if($config['UserLang'] == 'fr') {
        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        $month = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        $dateToShow = $days[(date('N', strtotime($date))-1)].' '.date('j', strtotime($date)).' '.$month[(date('n', strtotime($date))-1)];
        if($showYear) {
            $dateToShow .= ' '.date('Y', strtotime($date));
        }
        return $dateToShow;
    } else if($config['UserLang'] == 'es') {
        $days = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
        $month = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $dateToShow = $days[(date('N', strtotime($date))-1)].', '.date('j', strtotime($date)).' de '.$month[(date('n', strtotime($date))-1)];
        if($showYear) {
            $dateToShow .= ' de '.date('Y', strtotime($date));
        }
        return $dateToShow;
    } else {
        /*English Time*/
        if($showYear) {
            return date("l, F jS, Y", strtotime($date));
        } else {
            return date("l, F jS", strtotime($date));
        }
    }
}

function check_dateFormat($date, $format = 'd-m-Y') {
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

/**
 *  Calculate in minutes if a date has expired
 *  Used for keys send by emails
 *   - To change a forgotten password
 *   - To modify the account e-mail
 */
function check_dateExpired($dateFrom, $maxMinutes) {
    
    $now = time();
    $dateUnix = strtotime($dateFrom);
    $diff  = (abs($now - $dateUnix) / 60);
    
    if($diff <= $maxMinutes) {
        return intval($maxMinutes - $diff);
    } else {
        return FALSE;
    }
    
}

/**
 *  Get random String (Uniq ID)
 */
function get_stringSuffle($lenght, $uppercase=FALSE) {
    if(!$uppercase) {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } else if (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    } else {
        $str = '';
        for ($x=0;$x<$lenght;$x++)
            $str .= substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 1);
        return $str;
    }
}

/**
 *  Check email is Valid 
 */
function check_emailValid($email) {
    
    $isValid = TRUE;
    $atIndex = strrpos($email, "@");
    if (is_bool($atIndex) && !$atIndex) {
        $isValid = FALSE;
    } else {
        $domain = substr($email, $atIndex+1);
        $local = substr($email, 0, $atIndex);
        $localLen = strlen($local);
        $domainLen = strlen($domain);
        if ($localLen < 1 || $localLen > 64) {
            // local part length exceeded
            $isValid = FALSE;
        } else if ($domainLen < 1 || $domainLen > 255) {
            // domain part length exceeded
            $isValid = FALSE;
        } else if ($local[0] == '.' || $local[$localLen-1] == '.') {
            // local part starts or ends with '.'
            $isValid = FALSE;
        } else if (preg_match('/\\.\\./', $local)) {
            // local part has two consecutive dots
            $isValid = FALSE;
        } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
            // character not valid in domain part
            $isValid = FALSE;
        } else if (preg_match('/\\.\\./', $domain)) {
            // domain part has two consecutive dots
            $isValid = FALSE;
        } else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                               str_replace("\\\\","",$local))) {
            // character not valid in local part unless 
            // local part is quoted
            if (!preg_match('/^"(\\\\"|[^"])+"$/',
                            str_replace("\\\\","",$local))) {
                $isValid = FALSE;
            }
        } if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
            // domain not found in DNS
            $isValid = FALSE;
        }
    }
    
    return $isValid;
    
}

/**
 * Delete User Photo profile
 * Used in account part and for deleting an account
 * userPicture is 
 */
function del_userProfileImg($userPicture) {
    if($userPicture != NULL && $userPicture != '') {
        $pathPictures = _PATHROOT.'include/images/_uploads/profiles_pictures/';
        unlink($pathPictures.$userPicture.'.jpg');
        unlink($pathPictures.$userPicture.'-100.jpg');
        unlink($pathPictures.$userPicture.'-500.jpg');
    }
}

/**
 *  Delete Account, called from:
 *    - Administration part 
 *    - home/ajax/ajax_account_deletion.php when a user wants to delete his account
 */

function del_account($userId) {
    global $config, $dataBase;

    $sql = $dataBase->prepare('SELECT picture 
                               FROM pr__user 
                               WHERE id = :id');
    $sql->execute(['id' => $userId]);
    $userInfos = $sql->fetch();
    $sql->closeCursor();

    del_userProfileImg($userInfos['picture']);

    $sql = $dataBase->prepare('DELETE FROM pr__user 
                               WHERE id = :id');
    
    $sql->execute(['id' => $userId]);
    $sql->closeCursor();

    /**  Database Triggers will delete all other account information
       Trigers are:
       - pr__user_delete, trigger from Table pr__user
       - pr__ticket_delete, trigger from Table pr__ticket
       - pr__user_oauth_delete, trigger from Table pr__user_oauth
     */
}


function get_bytesReadable($bytes, $precision = 2) {  
    $kiloByte = 1024;
    $megaByte = $kiloByte * 1024;
    $gigaByte = $megaByte * 1024;
    $teraByte = $gigaByte * 1024;
    
    if (($bytes >= 0) && ($bytes < $kiloByte)) {
        return $bytes . ' B';
        
    } elseif (($bytes >= $kiloByte) && ($bytes < $megaByte)) {
        return round($bytes / $kiloByte, $precision) . ' Ko';
        
    } elseif (($bytes >= $megaByte) && ($bytes < $gigaByte)) {
        return round($bytes / $megaByte, $precision) . ' Mo';
        
    } elseif (($bytes >= $gigaByte) && ($bytes < $teraByte)) {
        return round($bytes / $gigaByte, $precision) . ' Go';
        
    } elseif ($bytes >= $teraByte) {
        return round($bytes / $teraByte, $precision) . ' To';
    } else {
        return $bytes . ' B';
    }
}

function check_GeoIPDatabaseFile() {
    global $config;
    if(file_exists(_PATHROOT.'include/php/_libraries/geoip/database/'.$config['GeoIPDatabaseFile'])) {
        return TRUE;
    } else {
        return FALSE;
    }
}

/**
 *  
 *  ADMINISTRATION global functions
 *  
 */

function get_userAdminRights($userId = NULL) {
    global $dataBase;

    if($userId == NULL) {
        $userId = get_userIdSession();
    }
    $sql = $dataBase->prepare('SELECT pr__adminright.name 
                               FROM pr__user_adminright 
                               LEFT JOIN pr__adminright ON pr__adminright.id = pr__user_adminright.adminright_id
                               WHERE user_id = :user_id');
    $sql->execute(['user_id' => $userId]);
    $sqlAdminRights = $sql->fetchAll();
    $sql->closeCursor();
    $userAdminRights = [];
    foreach($sqlAdminRights as $oneRight) {
        array_push($userAdminRights, $oneRight['name']);
    }
    return $userAdminRights;
}

function check_adminRights($checkRight = 'any') {
    global $config, $dataBase, $sessionUser, $userLoggedRights;

    if(!isset($_SESSION['UserId']) || !isset($sessionUser['adminrights'])) {
        return FALSE;
    }
    if(count($sessionUser['adminrights']) == 0) {
        return FALSE;
    } else {
        if( $checkRight == 'any' && count($sessionUser['adminrights']) != 0) {
            return TRUE;
        } else if(in_array('admin', $sessionUser['adminrights'])) {
            /**
             *  User is an Administrator
             */
            return TRUE;
        } else if(in_array($checkRight, $sessionUser['adminrights'])) {
            /**
             *  User has expected rights
             */
            return TRUE;
        } else {
            /**
             *  User does not have expected rights
             */
            return FALSE;
        }
    }
}

?>
