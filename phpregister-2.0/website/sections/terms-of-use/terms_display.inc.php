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


function show_terms() {

    echo '
<div class="container mt-5 bg-white p-4 border border-myrounded-lg">
    <h1 class="text-center">'.lg('Terms of use', 'Global').'</h1>
    '.lg('Terms of use - Content', 'Terms').'
</div>
<hr>
<div class="container mb-5 bg-white p-4 border rounded-lg">
    <h1 class="text-center">'.lg('Privacy Policy').'</h1>
    '.lg('Privacy Policy - Content', 'Terms').'
</div>';
    
}
?>
