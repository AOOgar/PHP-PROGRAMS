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

/** Security check to prevent direct access to this ajax file */
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') { exit; }

define('_PATHROOT', '../../../../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');


if(!check_adminRights('sitemaps')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

echo '
<div id="DivAjaxSiteMaps" class="p-4 fnt-1-1">
    <p class="fnt-1-4">Generate sitemap file sitemaps-mainpages.xml</p>
    <p>The PHP process must have rights to write on the root directory of the website.</p>
    <p>Edit the file <span class="border px-2">[Admin]/home/ajax/ajax_sitemaps_writefile.php</span> to modify the pages referenced.</p>
    <p>The file robots.txt in the root directory must reference this file.</p>
    <div class="text-center"><button id="BtnMainPagesSiteMaps" class="btn btn-info my-4" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg\'></i> Generating main pages sitemaps file" >Generate main pages sitemaps file</button></div>
    <p>See file: <a class="ml-4" target="_blank" href="'.$config['URL'].'/sitemaps-mainpages.xml"><i class="fa fa-sitemap"></i> '.$config['URL'].'/sitemaps-mainpages.xml</a>
    <p>Then View source CTR-U, beware the cache of your browser if you don\'t see your modifications.</p>
</div>

<script>
$("#ModalBodySiteMaps").empty();
$("#DivAjaxSiteMaps").appendTo($("#ModalBodySiteMaps"));
$("#ModalSiteMaps").modal("show");
$("#BtnMainPagesSiteMaps").on("click", function() {
  $("#BtnMainPagesSiteMaps").btn("loading");
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/home/ajax/ajax_sitemaps_writefile.php", type: "POST",
    success: function(data) {
      $("#AjaxSiteMaps").empty().html(data);
      setTimeout(function() {  $("#BtnMainPagesSiteMaps").btn("reset"); }, 2000);
    },
    error: function(exception) { console.log(exception); }
  });  
});
</script>';










?>
