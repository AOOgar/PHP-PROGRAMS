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

define('_PATHROOT', '../../../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');
include_once (_PATHROOT.'account/profile/profile_sql.inc.php');

init_langVars(['Profile', 'Global']);

if(!isset($_SESSION['UserId'])) {
    echo '
<script>
window.location.href = "'.get_URL().'/account";
</script>';
    exit;
}

$countryLangShow = get_countryLanguage();
$userAddress = sql_getUserAdress($_POST['id'], $countryLangShow);

echo '
<div id="DivAjaxAddressDelete">
   <form action="#" id="FormAddressDelete"  name="FormAddressDelete" method="post">
   <input name="id" type="hidden" value="'.issetor($_POST['id']).'">
   <p class="fnt-1-2">Etes-vous sur de vouloir supprimer cette adresse ?</p>
   <div class="mt-3 mb-4" style="width:90%;min-width:220px;max-width:430px;">
       <div class="float-right mr-4">'.$userAddress['name'].'</div>
       <div class="clearfix"></div>
       <div class="bg-light p-3 pb-1  pb-sm-1  p-sm-4 border rounded">
           <p>'.$userAddress['username'].'</p>
           <p>'.$userAddress['line1'].'</p>'.issetor($userAddress['line2'], FALSE, $addBefore = '<p>',  $addAfter = '</p>').'
           <p>'.$userAddress['city'].' '.$userAddress['postcode'].'</p>
           <p class="mb-0">'.$userAddress[$countryLangShow].'</p>
       </div>
   </div>
   <button id="BtAddressDelete" class="btn btn-outline-danger ml-5" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Yes, delete').'</button>
   </form>
</div>

<script>
$(document).on("submit", "#FormAddressDelete", function(e) {
    $("#BtAddressDelete").btn("loading");
    var values = $("form#FormAddressDelete").serialize();
    $.ajax({
      url: "'.$config['URL'].'/account/profile/ajax/ajax_address_delete.php", type: "POST", data: values,
      success: function (data) {
        $("#AjaxEdit").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });
  e.preventDefault();
});
$("#DivModalBodyAddress").empty();
$("#DivAjaxAddressDelete").appendTo($("#DivModalBodyAddress"));
$("#ModalAddress").modal("show");
</script>';














?>
