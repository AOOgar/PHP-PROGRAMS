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

function show_400Top() {
    global $config;

    echo '
<div class="container text-center"> 
    <div class="my-3 my-sm-5">
        <div class="shadow d-inline-block p-4">
            <img src="'.$config['ImagesURL'].'404.jpg" style="width: 100%;max-width:800px;">
            <p class="mt-4 mb-0 fnt-1-5 font-weight-bold">'.lg('Page not found').'</p>
        </div>
    </div>
</div>';


}


?>
