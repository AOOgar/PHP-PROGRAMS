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

ini_set('memory_limit', '256M');

/** Security check to prevent direct access to this ajax file */
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') { exit; }

define('_PATHROOT', '../../../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_images.inc.php');

if(!isset($_SESSION['UserId'])) {
    echo '
<script>
  location.reload();
</script>';
    exit;
}

if($sessionUser['picture'] != NULL) {
    del_userProfileImg($sessionUser['picture']);
}

$sql = $dataBase->prepare('UPDATE pr__user 
                           SET picture = :picture
                           WHERE id = :id');
$sql->execute(['picture'  => NULL,
               'id'       => get_userIdSession()]);
$sql->closeCursor();

echo '
<script>
$(".img-profile").fadeTo("fast", 0, function() {
  $("#DivImgProfileDefault").removeClass("dis-n");
  $("#DivImgProfile").addClass("dis-n");
  setTimeout(function() {
      $(".img-profile").fadeTo("fast", 1);
  }, 1000);
});
</script>';





?>
