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

function show_header() {
    global $config, $sessionUser, $pretty, $cssFiles, $linksMetaHeader, $linksLangsMenu, $headerTitle, $headerDesc;
    global $cssPlugins, $jsScripts, $jsDocumentReady, $jsWindowLoaded, $adminPage, $metaContent, $linkRedirect;

    if($linkRedirect != NULL) {
        header('Location: '.$linkRedirect);
        exit;
    }

    if($linksMetaHeader == NULL) {
        list($linksMetaHeader, $linksLangsMenu) = get_linksMetaHeader_MenuTop();
    }

    echo '<!DOCTYPE html>
<html lang="';
    if($config['UserLang'] == 'en') {
        echo 'en-US';
    } else {
        echo $config['UserLang'];
    }
    echo '">
<head>
<link href="'.$config['URL'].'/include/fonts/line-awesome/css/line-awesome-font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/una0pia.css">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>';
    if(empty($headerDesc)) {
        $headerDesc = $config['WebsiteName'];
    }
    echo '
<meta name="description" content="'.$headerDesc.'">';
    if(!empty($metaContent)) {
        echo $metaContent;
    } else {
        echo '
<meta property="og:type" content="website">
<meta property="og:title" content="'.$headerTitle.'">
<meta property="og:url" content="'.get_URL().$_SERVER['REQUEST_URI'].'">
<meta property="og:image" content="'.$config['ImagesURL'].'banner-yourwebsite.jpg">
<meta property="og:image:width" content="1200"/>
<meta property="og:image:height" content="630"/>
<meta property="og:description" content="'.$headerDesc.'">';
    }

    echo '
<title>';
    if(!isset($headerTitle)) {
        echo $config['WebsiteName'];
    } else {
        echo $headerTitle;
    }
    echo '</title>';
    if(strpos($_SERVER['REQUEST_URI'], $config['AdminFolder']) === false) {
        echo '
<link rel="shortcut icon" href="'.$config['ImagesURL'].'favicon-yourwebsite.png" type="image/png"/>';
    } else {
        echo '
<link rel="shortcut icon" href="'.$config['ImagesURL'].'favicon-phpRegister-admin-1.png" type="image/png"/>';
    }
    /**
     *  Links alternate Languages and canonical
     */
    if(is_array($linksMetaHeader)) {
        foreach($linksMetaHeader as $oneLink) {
            echo '
'.$oneLink;
        }
    }

    echo '
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
    /**
     *  Plugins CSS Files are loaded before local CSS Files
     *  to be able to overwrite Plugins default CSS options
     */
    echo '
<!-- CSS Plugins -->';
    if(is_array($cssPlugins) && count($cssPlugins) >= 1) {
        foreach($cssPlugins as $key => $val) {
            $optionCss = '';
            if(is_array($val)) {
                foreach($val as $key2 => $val2) {
                    if(!$key2) $optionCss .= ' '.$val2;
                    else $optionCss .= ' '.$key2.'="'.issetor($val2).'"';
                }
            } else {
                $key = $val;
            }
            if(substr($key, 0, 2) === '//') {
                echo '
<link rel="stylesheet" href="'.$key.'" '.$optionCss.'>';
            } else {
                echo '
<link href="'.$config['URL'].'/include/plugins/css/'.$key.'" rel="stylesheet" '.$optionCss.'>';
            }
        }
    }
    echo '
<!-- Css local files -->';
    if(count($cssFiles) >= 1) {
        foreach($cssFiles as $oneCss) {
            echo '
<link href="'.$config['URL'].'/include/css/'.$oneCss.'" rel="stylesheet">';
        }
    }
    $cssAdminWrapper = '';
    if(isset($adminPage)) {
        /**
         * Used to make the 250px Margin Left of the Admin section for Sidebar
         */
        $cssAdminWrapper = 'openSidebar';
    }
    
    echo '
</head>
<body id="BodyPage" class="'.$config['BodyClass'].'">
<div id="DivWraper" class="wrapper '.$cssAdminWrapper.' d-flex flex-column">
<script>
var windowWidth = document.documentElement.clientWidth;
var windowHeight = document.documentElement.clientHeight;
</script>';
    
    $jsScripts .= '
function signOut() { 
  $(".link-signout").btn("loading");
  $.ajax({
    url: "'.$config['URL'].'/include/php/ajax/ajax_signout.php",
    success: function() {
      setTimeout(function (data) {
        window.location.replace("'.get_URL().'");
      }, 1000);
    }
  });
}';
    if(isset($sessionUser) && !isset($sessionUser['user_id'])) {
        // User has session but no user found. Account might has been deleted
        // We signout and so delete the session
        $jsDocumentReady .= '
signOut();';
    }

    if(check_adminRights('translations')) {

        $newShowTranslatesIds = ($_COOKIE['ShowTranslatesIds'] == 1) ? 0 : 1;
        $jsScripts .= '
function ajaxTranslatesShowIds() {
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/translations/ajax/ajax_translationscookie_showids.php?ShowTranslatesIds='.$newShowTranslatesIds.'",
    success: function(data) {
        $("#AjaxUpdateVariable").empty().html(data);
    }
  });
}
function closeCurrentModal() {
  $(".modal.show").modal("hide");
}
function openTranslate(id) {
  var wait = 0;
  if($(".modal.show").length) {
    closeCurrentModal();
    wait = 500;
  }
  setTimeout(function() {
    var values = {"id": id};
    $.ajax({
      url: "'.$config['AdminURL'].'/pages/translations/ajax/ajax_variableedit_modalopen.php?from=WebSite", type: "POST", data: values,
      success: function(data) {
        $("#AjaxUpdateVariable div").remove();
        $("#AjaxUpdateVariable").html("").html(data);
      },
      error: function(exception) { console.log(exception); }
    });
  }, wait);
}';
        $jsWindowLoaded .= '
$(".span-translate-number").click(function(e) {
  e.preventDefault();
  e.stopPropagation();
});';

        echo '
<div id="AjaxUpdateVariable" class="dis-n"></div>
<div class="modal modal-responsive modal-mytheme fade" id="ModalVariableEdit" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-pencil-square-o pr-4 align-middle" style="font-size:26px;"></i>Editing a variable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivBodyModalVariableEdit">
            </div>
        </div>
    </div>
</div>';
    }
}

function show_navbar() {
    global $config, $active, $page, $linksLangsMenu;
    global $jsScripts, $jsWindowLoaded, $jsDocumentReady, $jsWindowResize, $jsHideEmail;
    
    $adminRights = FALSE;

    $email = "contact@yourwebsite.com";
    $emailPieces = str_split($email, 4); //Put in whatever number here for chunk size
    $jsHideEmail = '';
    foreach($emailPieces as $onePiece) {
        $jsHideEmail .= $onePiece.'" + "';
    }
    $jsHideEmail = rtrim($jsHideEmail, '" + "');

    $jsScripts .= '
$("#SpanEmailHeader").html("'.$jsHideEmail.'");
$("#LinkEmailHeader").attr("href", "mailto:'.$jsHideEmail.'")';

    echo '
<div id="NavbarPC">
    <div id="NavbarTopMenuLang" class="d-flex mx-auto fnt-0-95 px-2">
        <div class="txt-l nowrap pr-4">
            <i class="fa fa-envelope-o pr-2 fnt-1-1"></i><a id="LinkEmailHeader" href="" class="a-none text-white"><span id="SpanEmailHeader"> &nbsp; </span></a>
        </div>
        <div class="mr-auto pl-4 border-left border-light">
            <i class="fa fa-phone fnt-1-1 pr-2"></i>(+00) 1 22 44 66 88
        </div>
        <div id="DivDropDownLangTop" class="dropdown menuauto">
            <a class="menubutton dropdown-toggle pointer" data-toggle="dropdown">
                '.ucfirst($config['LangsNames'][$config['UserLang']]).'
                <img alt="Lang" height="15" src="'.$config['ImagesURL'].'/flags/'.$config['UserLang'].'.png" class="mx-2">
            </a>
            <ul class="dropdown-menu">';
        $i = 0;
        foreach($config['Langs'] as $oneLang) {
            if($oneLang != $config['UserLang']) {
                echo '
                <li class="pb-2"><a href="'.$linksLangsMenu[$oneLang].'" hreflang="'.$oneLang.'"><img alt="Lang" height="15" src="'.$config['ImagesURL'].'/flags/'.$oneLang.'.png">'.
                  ucfirst($config['LangsNames'][$oneLang]).'</a></li>';
            }
            $i++;
        }
        echo '
            </ul>
        </div>
    </div>
    <div id="NavbarTopMainPages" class="text-center">
        <div class="d-flex mx-auto px-2" style="max-width:1024px;height:75px;"> 
            <div class="mr-4" style="line-height:75px;">
              <a href="'.get_URL().'"><img src="'.$config['ImagesURL'].'logo-yourwebsite-img.png" height="60"></a>
            </div>
            <div id="DivTopMainPages" class="mr-auto" style="width:70%;">';
    echo html_menuPagesTop().'
            </div>';
    $jsDocumentReady .= '
$(document).on("click", ".nocloseonclick", function (e) {
  e.stopPropagation();
});';
    if(!isset($_SESSION['UserId'])) {
        echo '
            <div class="mt-2">
                <a class="text-white a-none " href="'.get_URL().'/login/">
                 <i class="fa fa-user text-white" style="font-size:40px;"></i><br>
                 '.lg('Log in', 'Global').'
                </a>
            </div>';
    } else {
        echo '
             <div id="DivDropDownAccount" class="mt-2 dropdown menuauto">
                 <i class="fa fa-user" style="font-size:40px;"></i><br>
                 <a href="#/" data-toggle="dropdown" class="menubutton text-white a-none">'.lg('My account', 'Global').'<i class="fa fa-angle-down ml-2 fnt-1-2"></i></a>
                 <div class="dropdown-menu dropdown-menu-right nocloseonclick" role="menu">
                    '.html_menuMyAccount().'
                 </div>
             </div>';
    }
    
    echo '
        </div>
    </div>
</div>
<div id="NavbarPhone" class="dis-n mx-auto p-2">
    <div class="pl-2 mt-2">
        <div id="BugerMenuPhoneMainPages" class="hamburger hamburger--3dx-r">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </div>
    <div class="mr-auto ml-4">
        <a href="'.get_URL().'"><img src="'.$config['ImagesURL'].'logo-yourwebsite-img.png" height="40"></a>
    </div>
    <div>';
    $cssAngleDown = 'opa-0';
    $linkAccount = 'href="'.get_URL().'/login"';
    if(isset($_SESSION['UserId'])) {
        $cssAngleDown = '';
    }
    echo '
       <div class="mt-1">';
    if(isset($_SESSION['UserId'])) {
        echo '
           <a id="IconNavbarPhoneUser"  href="#/"><i class="fa fa-user text-white a-none" style="font-size:30px;"></i><i class="fa fa-angle-down '.$cssAngleDown.' a-none text-white"></i></a>';
    } else {
        echo '
           <a href="'.get_URL().'/login/" class="a-none"><i class="fa fa-user text-white a-none" style="font-size:30px;"></i><i class="fa fa-angle-down '.$cssAngleDown.' a-none text-white"></i></a>';
    }
        echo '
       </div>
    </div>
</div>
<div id="DivSail"></div>';

    /**
     * Javascript for Navbar, by default, the PC Navbar is displayed
     * Pure javascript to execute the code straight away to display Phone Navbar if needed
     * Only the part windowWidth < 768 needs to be in pure javascript, the other part 
     * concerns the switch from Phone mode to PC mode 
     */
    echo '
<script>
function navbarCheckPhone() {
  if( windowWidth < 768 ) {
      if(document.querySelector("#NavbarPC").style.display != "none") {
        document.querySelector("#NavbarPC").style.display = "none";
        document.querySelector("#NavbarPhone").classList.remove("dis-n");
        document.querySelector("#NavbarPhone").classList.add("d-flex");
        document.body.style.paddingTop = document.querySelector("#NavbarPhone").offsetHeight + "px";
      }
     return true;
  } else if(document.querySelector("#NavbarPC").style.display == "none") {
    if($("#BugerMenuPhoneMainPages").hasClass("is-active")) {
      $("#BugerMenuPhoneMainPages").click();
    }
    if(!$("#MenuPhoneUser").hasClass("opa-0")) {
      $("#CloseMenuPhoneUser").click();
    }
    document.querySelector("#NavbarPC").style.display = "inline-block";
    document.querySelector("#NavbarPhone").classList.remove("d-flex");
    document.querySelector("#NavbarPhone").classList.add("dis-n");
    document.body.style.paddingTop = 0;
  }
  return false;
}
navbarCheckPhone();
</script>';

    $jsWindowResize .= '
windowWidth = document.documentElement.clientWidth;
navbarCheckPhone();';

    /**
     * The JS code displaying the Phone Navbar / Menus is in the file /include/js/global-xx.js
     */
    echo '
<div id="MenuPhoneMainPages" class="opa-0">
'.html_menuPagesTop($disHomeLink = TRUE).'
</div>
<div id="MenuPhoneUser" class="opa-0">
    <div class="float-right"><a id="CloseMenuPhoneUser" href="#/" class="opa-"><i class="fa fa-times text-white pt-2 pr-2 a-none"></i></a></div>
'.html_menuMyAccount().'
</div>';

}

function html_menuPagesTop($disHomeLink = FALSE) {
    global $siteSections, $active, $page;

    // Array to avoid an if on each <li> to display "active" 
    $active = ['files-php-js-css'      => '',
               'ajax-calls'            => '',
               'mymap-css-attributes'  => '',
               'sample'                => '',
               'contact-us'            => ''];        
    $active[$page] = 'active'; // Variable $page must be set on file index.php of each section page

    $html = '
<ul>';
    if($disHomeLink) {
        /*Home link is displayed only for Mobile*/
        $html .= '
    <li><a class="a-none text-uppercase" href="'.get_URL().'/">'.lg('Home', 'Global').'</a></li>';
    }
    $html .= '
    <li><a class="a-none text-uppercase '.$active['files-php-js-css'].'" href="'.get_URL().'/'.get_sectionLang('files-php-js-css', $siteSections).'">'.lg('Files PHP/JS/CSS', 'Global').'</a></li>
    <li><a class="a-none text-uppercase '.$active['ajax-calls'].'" href="'.get_URL().'/'.get_sectionLang('ajax-calls', $siteSections).'">'.lg('Ajax calls', 'Global').'</a></li>
    <li><a class="a-none text-uppercase '.$active['mymap-css-attributes'].'" href="'.get_URL().'/'.get_sectionLang('mymap-css-attributes', $siteSections).'">My map/CSS attributes</a></li>
    <li><a class="a-none text-uppercase '.$active['sample'].'" href="'.get_URL().'/'.get_sectionLang('sample', $siteSections).'">Sample</a></li>
    <li><a class="a-none text-uppercase '.$active['contact-us'].'" href="'.get_URL().'/'.get_sectionLang('contact-us', $siteSections).'">'.lg('Contact', 'Global').'</a></li>
</ul>';
    return $html;
}

function html_menuMyAccount() {
    global $config, $jsWindowLoaded;
    
    $menu = '
<ul>
    <li><a href="'.get_URL().'/account/profile" class="a-none"><i class="fa fa-file-text"></i> '.lg('My profile', 'Global').'</a></li>
    <li><a href="'.get_URL().'/account/helpdesk" class="a-none"><i class="fa fa-weixin"></i> '.lg('User support', 'Global').'</a></li>
    <li><a href="'.get_URL().'/account/sample" class="a-none"><i class="fa fa-life-ring"></i> Account sample page</a></li>
    <li><a href="#/" class="a-none link-signout" onClick="signOut();" data-loading-text="<i class=\'fa fa-spinner fa-spin\'></i> '.lg('Logout in progress', 'Global').'"><i class="fa fa-sign-out"></i> '.lg('Log out', 'Global').'</a></li>';
    if(check_adminRights()) {
        $menu .= '
    <li class="text-center text-admin">ADMIN</li>';
        if(check_adminRights('translate')) {
            $menu .= '
    <li><i class="fa fa-language"></i><a href="#/" onClick="ajaxTranslatesShowIds();">Show Translate Ids</a></li>';
        }
            $menu .= '
    <li><i class="fa fa-key mar-l-10 pad-r-10"></i><a href="'.$config['AdminURL'].'">Dashboard</a></li>';
    }
    $menu .= '
</ul>';
    return $menu;
}

function show_end() {
    global $config, $siteSections, $display, $linksLangsMenu;
    global $jsHideEmail, $jsDocumentReady, $jsWindowLoaded, $jsWindowResize, $jsPlugins, $jsScripts, $jsFiles, $jQueryForceVersion;
    
    if(!isset($display['Footer'])) {
        $display['Footer'] = TRUE;
    }
    
    if($display['Footer'] == TRUE) {
        echo '
<footer class="mt-auto">
    <div class="footer-bloc container" style="max-width:1200px;">
        <div class="row txt-l">
            <div class="col-sm-4 main-pages">
                <div class="footer-title text-uppercase">'.lg('Main pages', 'Global').'</div>
                <div class="footer-div"><a href="'.get_URL().'/">'.lg('Home', 'Global').'</a></div>
                <div class="footer-div"><a href="'.get_URL().'/'.get_sectionLang('contact-us', $siteSections).'"> '.lg('Contact us', 'Global').'</a></div>
                <div class="footer-div"><a href="'.get_URL().'/'.get_sectionLang('about-us', $siteSections).'"> '.lg('About us', 'Global').'</a></div>
                <div class="footer-div"><a href="'.get_URL().'/'.get_sectionLang('terms-of-use', $siteSections).'"> '.lg('Terms of use', 'Global').'</a></div>
            </div>
            <div class="col-sm-4 main-pages">
                <div class="footer-title text-uppercase">'.lg('My account', 'Global').'</div>';
        if(!isset($_SESSION['UserId'])) {
            echo '
              <div class="footer-div"><a href="'.get_URL().'/signin/">'.lg('Log in', 'Global').'</a></div> 
              <div class="footer-div"><a href="'.get_URL().'/signup/">'.lg('Sign up', 'Global').'</a></div>';
        } else {
            echo '
              <div class="footer-div"><a href="'.$config['URL'].'/account/profile">'.lg('My profile', 'Global').'</a></div> 
              <div class="footer-div"><a href="'.$config['URL'].'/account/helpdesk/">'.lg('User support', 'Global').'</a></div>
              <div class="footer-div"><a href="'.$config['URL'].'/account/sample/">Account sample page</a></div>';
        }
        $jsDocumentReady .= '
$("#SpanEmailFooter").html("'.$jsHideEmail.'");
$("#LinkEmailFooter").attr("href", "mailto:'.$jsHideEmail.'")';
        echo '
            </div>
            <div class="col-sm-4">
                <div class="footer-title text-uppercase">'.lg('Contact us', 'Global').'</div>
                <div class="footer-div"><i class="fa fa-at pr-2"></i><a id="LinkEmailFooter" href=""><span id="SpanEmailFooter"></span></a></div>
                <div class="footer-div"><i class="fa fa-map pr-2"></i>
                    01 Oxford St<br>
                    <span style="padding-left:25px;">Soho, London W1D 2EH,</span><br>
                    <span style="padding-left:25px;">United Kingdom</span> 
                </div>
                <div class="footer-div"><i class="fa fa-phone pr-2"></i>+(00) 1 22 44 66 88</div>
            </div>
        </div>
    </div>
</footer>';        
    }

    echo '
</div><!--DivWraper-->';

    if($jQueryForceVersion == NULL) {
        $jQueryVersion = '3.4.1';
    } else if($jQueryForceVersion == 2) {
        $jQueryVersion = '2.2.4';
    }
    echo '
<!-- jQuery Google CDN -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/'.$jQueryVersion.'/jquery.min.js"></script>
<!-- jQuery local fallback -->
<script>window.jQuery || document.write(\'<script src="'.$config['URL'].'/include/plugins/js/jquery/'.$jQueryVersion.'/jquery.min.js"><\/script>\')</script>
<!-- jQuery Bootstrap Bundle CDN, Bundle contains poppers.js -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<!-- Bootstrap JS local fallback -->
<script>if(typeof($.fn.modal) === "undefined") {document.write(\'<script src="'.$config['URL'].'/include/bootstrap/4.3.1/bootstrap.bundle.min.js"><\/script>\')}</script>
<!-- Bootstrap CSS local fallback -->
<script>
$(document).ready(function() {
    var bodyColor = $("body").css("color");
    if(bodyColor != "rgb(51, 51, 51)") {
    $("head").prepend(\'<link rel="stylesheet" href="'.$config['URL'].'/include/bootstrap/4.3.1/bootstrap.min.css">\');}
});
</script>';
    echo '
<!-- JS files -->';
    
    if(is_array($jsFiles) && count($jsFiles) >= 1) {
        foreach($jsFiles as $oneJs) {
            echo '
<script src="'.$config['URL'].'/include/js/'.$oneJs.'"></script>';
        }
    }
    if(isset($jsDocumentReady)) {
        echo '
<!-- $jsDocumentReady  -->
<script>
$("document").ready(function(){
  '.$jsDocumentReady.'
});
</script>';
    }
    if(isset($jsWindowLoaded)) {
        echo '
<!-- $jsWindowLoaded  -->
<script>
$(window).on("load", function() {
  '.$jsWindowLoaded.'
});
</script>';
    }
    if(isset($jsWindowResize)) {
        echo '
<!-- $jsWindowResize  -->
<script>
$(window).resize(function(){
  '.$jsWindowResize.'
});
</script>';
    }
    echo '
<!-- JS Plugins -->';

    if(is_array($jsPlugins) && count($jsPlugins) >= 1) {
        foreach($jsPlugins as $key => $val) {
            $optionJs = '';
            if(is_array($val)) {
                foreach($val as $key2 => $val2) {
                    if(!$key2) $optionJs .= ' '.$val2;
                    else $optionJs .= ' '.$key2.'="'.issetor($val2).'"';
                }
            } else {
                $key = $val;
            }
            if(substr($key, 0, 2) === '//') {
                echo '
<script src="'.$key.'" '.$optionJs.'></script>';
            } else {
                echo '
<script src="'.$config['URL'].'/include/plugins/js/'.$key.'" '.$optionJs.'></script>';
            }
        }
    }

    if($jsScripts != '') {
        echo '
<script>
'.$jsScripts.'
</script>';
    }
    echo '
</body>';
    if($config['DisplayPageLoadtime'] == TRUE) {
        $end_time = microtime(TRUE);
        $time_taken = $end_time - $config['StartTime'];
        $time_taken = round($time_taken,5);
        echo '<!--Page generated in '.$time_taken.' seconds.-->';
    }
    echo '
</html>';
}



?>
