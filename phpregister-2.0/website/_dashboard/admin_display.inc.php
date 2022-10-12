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

function show_adminSidebar() {
    global $url, $config, $sessionUser, $display, $sidebarLinks, $adminPage, $jsWindowLoaded, $jsScripts, $jsWindowResize;
    
    $display['FormHelp'] = FALSE;
    
    $display['Footer'] = FALSE;
    if(!isset($_POST['search'])) {
        $_POST['search'] = NULL;
    }
    
    $jsScripts .= '
function langModify(lang) {
  var values = {"Lang": lang};
  $.ajax({
    url: "'.$config['AdminURL'].'/ajax/ajax_lang_modify.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxLangModify div").remove();
      $("#AjaxLangModify").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}';

    echo '
<div id="DivOpenSidebar" onClick="sidebarOpen();" class="d-inline trans-black-0-7 p-2 open"><i class="fa fa-caret-right fa-2x"></i></div>
<div id="AjaxLangModify"></div>
<div id="mySidenav" class="sidenav">
    <div id="SideNavContent">
        <div class="float-left">
            <a href="#/" class="dropdown-toggle" data-toggle="dropdown">
              '.ucfirst($config['LangsNames'][$config['UserLang']]).'
            </a>
            <div class="dropdown-menu">';
    foreach($config['Langs'] as $oneLang) {
        if($oneLang != $config['UserLang']) {
            echo '
              <a onClick="langModify(\''.$oneLang.'\');" class="dropdown-item" href="#">'.ucfirst($config['LangsNames'][$oneLang]).'</a>';
        }
    }
    echo '
            </div>
        </div>
        <div class="float-right"><a href="javascript:void(0)" class="closebtn" onclick="sidebarClose();">&times;</a></div>
        <div class="clearfix"></div>
        <div class="text-center pb-3" ><h4>'.lg('Administration').'</h4></div>';
    /**
     *  Admin Home Item
     */
    $cssActive = '';
    if($adminPage == 'adminhome') {
        $cssActive = 'active';
    }
    echo '
        <a href="'.$config['AdminURL'].'/pages/home" class="text-nowrap '.$cssActive.'"><i class="fa fnt-1-1 fa-home"></i> '.lg('Home').'</a>';


    /**
     *  Admin Accounts Item
     */
    if(check_adminRights('accounts')) {
        $cssActive = '';
        if($adminPage == 'accounts') {
            $cssActive = 'active';
        }
        echo '
        <a href="'.$config['AdminURL'].'/pages/accounts" class="text-nowrap '.$cssActive.'"><i class="fa fnt-1-1 fa-users"></i> '.lg('User Accounts').'</a>';
    }

    /**
     *  Admin 404 Redirections
     */
    if(check_adminRights('helpdesk')) {
        $cssActive = '';
        if($adminPage == 'helpdesk') {
            $cssActive = 'active';
        }
        echo '
        <a href="'.$config['AdminURL'].'/pages/helpdesk/" class="text-nowrap '.$cssActive.'"><i class="fa fnt-1-1 fa-weixin"></i> '.lg('Helpdesk').'</a>';
    }

    /**
     *  Admin Translations
     */
    if(check_adminRights('translations')) {
        $cssActive = '';
        if($adminPage == 'translations') {
            $cssActive = 'active';
        }
        echo '
        <a href="'.$config['AdminURL'].'/pages/translations/" class="text-nowrap '.$cssActive.'"><i class="fa fnt-1-1 fa-language"></i> '.lg('Translations').'</a>';
    }

    /**
     *  Admin 404 Redirections
     */
    if(check_adminRights('redirections')) {
        $cssActive = '';
        if($adminPage == 'redirections') {
            $cssActive = 'active';
        }
        echo '
        <a href="'.$config['AdminURL'].'/pages/404redirections/" class="text-nowrap '.$cssActive.'"><i class="fa fnt-1-1 fa-language"></i> '.lg('404 Redirections').'</a>';
    }

    /**
     *  Admin Configuration
     */
    if(check_adminRights('admin')) {
        $cssActive = '';
        if($adminPage == 'configuration') {
            $cssActive = 'active';
        }
        echo '
        <a href="'.$config['AdminURL'].'/pages/configuration/" class="text-nowrap '.$cssActive.'"><i class="fa fnt-1-1 fa-bullseye"></i> '.lg('Configuration').'</a>';
    }
    
    /**
     *  Admin Sample Page Item
     */
    
       if(check_adminRights('admin')) {
       $cssActive = '';
       if($adminPage == 'sample') {
           $cssActive = 'active';
       }
       echo '
       <a href="'.$config['AdminURL'].'/pages/sample/" class="text-nowrap '.$cssActive.'"><i class="fa fnt-1-1 fa-map-o fa-fw"></i> Sample Page</a>';
       }
    
    
    /**
     *  External Tools Loaded in an iFrame
     */
    if(check_adminRights('external-tools')) {
        echo '
        <div data-toggle="collapse" data-target="#SubMenuTools" class="collapsed list-unstyled">
            <a href="#/"><span><i class="fa fnt-1-1 fa-tasks fa-fw"></i> <span class="text-nowrap">'.lg('External Tools').'</span><i class="arrow pull-right fa fnt-1-1 fa-angle-down"></i></span></a>
        </div>
        <ul class="collapse" id="SubMenuTools">
            <li><a class="text-nowrap" href="#/" onClick="alert(\'Link to your phpMyAdmin\'); return false;" target="_blank">phpMyAdmin</a></li>
            <li><a class="text-nowrap" href="#/" onClick="alert(\'Link to your Webmail\'); return false;" target="_blank">Webmail</a></li>
        </ul>';
    }

    echo '
        <a class="text-nowrap translatesids mt-4" href="#/" onClick="ajaxTranslatesShowIds();"><i class="fa fnt-1-1 fa-language pr-2"></i>Show Translates Ids</a>
        <a class="text-nowrap backsite" href="'.$config['URL'].'/'.$config['UserLang'].'"><i class="fa fnt-1-1 fa-mail-reply pr-2"></i>'.lg('Back to Website').'</a>
        <a class="text-nowrap disconnect link-signout" onClick="signOut();" data-loading-text="<i class=\'fa fa-spinner fa-spin\'></i> '.lg('Logout in progress', 'Global').'" href="#/"><i class="fa fnt-1-1 fa-sign-out pr-2"></i>'.lg('Log out', 'Global').'</a>
        <form action="'.$config['AdminURL'].'/pages/accounts/" id="FormSidebarSearch"  method="post">
        <div class="input-group custom-search-form mt-2 px-2">
            <input type="text" name="search" class="form-control input-grey rounded-left" value="'.$_POST['search'].'" placeholder="'.lg('Search account', NULL, FALSE).'...">
            <span class="input-group-append">
                <button class="btn btn-info" type="submit" id="BtSidebarSearch">
                    <i class="fa fnt-1-1 fa-search"></i>
                </button>
            </span>
        </div>
        </form>';

    /**
     * phpRegister Logo with Version
     */
    echo '
       <div class="mt-5 mb-3 text-center"><a href="https://phpregister.org" target="_blank"><img src="'.$config['ImagesURL'].'logo-phpregister.png" class="mx-auto pr-3" style="width:90%;max-width:140px;"></a></div>';
    /**
     * Circles Animation!
     */
    echo '
       <div class="ripple-background"><div class="circle xxlarge shade1"></div><div class="circle xlarge shade2"></div><div class="circle large shade3"></div><div class="circle mediun shade4"></div><div class="circle small shade5"></div></div>

    </div>
</div>';
    
}

function show_adminError() {
    global $config, $jsWindowLoaded, $display;

    show_header();

    $display['Footer'] = FALSE;

    echo '
<div class="d-flex flex-column justify-content-center align-items-center" style="height:100%;margin-left:-250px;">
        <div class="row p-5 bg-light rounded" style="font-size:15px;max-width:800px;">
            <div class="col-sm-2 pb-4"><i class="fa fa-adjust fa-5x text-danger"></i></div>
            <div class="col-sm-10 text-left pt-4">
                <p>'.lg('You don\'t have the required rights to access to the Administration section.').'</p>
                <p>'.lg('To access to it, please contact the administrator of the site.').'</p>
                <p class="pt-4"><a href="'.get_URL().'/login/" target="_top"><button type="button" class="btn btn-success"><i class="fa fa-sign-in fnt-1-3 pr-4"></i>'.lg('Log in', 'Global').'</button></a></p>
            </div>
        </div>
</div>';

    show_end();
}

function show_adminPageTop($pageTop) {
    global $config, $jsWindowLoaded, $jsScripts, $jsWindowResize;
    
    echo '
<div id="DivPageAdmin" class="opa-0">
        <div class="p-3 trans-white-0-8">
            <div class="d-table" style="width:100%;">
                <div class="d-table-cell text-left" style="width:30%;">'.$pageTop['left'].'</div>
                <div class="d-table-cell text-center" style="width:40%;"><h3>'.$pageTop['center'].'</h3></div>
                <div class="d-table-cell text-right" style="width:30%;">'.$pageTop['right'].'</div>
            </div>
        </div>
        <div id="DivPageAdminContent" class="mx-auto opa-0" style="max-width:1300px;">';
}

function show_adminPageBottom() {
    global $jsScripts, $jsWindowLoaded, $jsWindowResize;

    $jsWindowLoaded .= '
setTimeout(function () {
  $("#DivPageAdmin").fadeTo("200", 1);
  setTimeout(function() {
    $("#DivPageAdminContent").removeClass("opa-0");
    $("body").addClass("body-admin-pageloaded");
  }, 700);
}, 200);';

    echo '
    </div>
</div>
</div>';
    
}

?>
