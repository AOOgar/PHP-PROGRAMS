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


function show_errorLogin() {
    global $config, $jsWindowLoaded;

    show_header();
    show_navbar();
    
    if($_SERVER['REQUEST_URI'] != '') {
        $redirectLink = urlencode(encrypt($_SERVER['REQUEST_URI'], $config['KeyOAuthRedirect']));
    }
    $jsWindowLoaded .= '
$("#BtSigninGoto").on("click", function(event) {
  window.location = "'.get_URL().'/login/?r='.$redirectLink.'";
})';
    
    echo '
<div class="container border border bg-white rounded p-5" style="max-width:600px;margin-top:100px;">
    <div class="row">
        <div class="col-sm-4">
            <i class="fa fa-adjust fa-5x text-danger py-3"></i>
        </div>
        <div class="col-sm-8">
            <p class="py-3">'.lg('You must Log in to access this page', 'Global').'</p>
            <p><button id="BtSigninGoto" class="btn btn-mytheme">'.lg('Log in', 'Global').'</button></p>
        </div>
    </div>
</div>';
    
    show_end(TRUE);

}

?>
