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

init_langVars(['Global']);

if(!isset($_SESSION['UserId'])) {
    echo '
<script>
  location.reload();
</script>';
    exit;
}

if(!isset($_FILES['ImgPhoto']['name'])) {
    exit;
}

$imgname     = $_FILES['ImgPhoto']['name'];
$imgsize     = $_FILES['ImgPhoto']['size'];
$imgtmpname  = $_FILES['ImgPhoto']['tmp_name'];
$imgtype     = $_FILES['ImgPhoto']['type'];

if(!empty($_FILES)) {
    /**
     *  Secure image ulpload
     */
    $checkFile = check_imageSecure($_FILES['ImgPhoto']['tmp_name']);
    if($checkFile !== TRUE) {
        echo '
<script>
alert("'.$checkFile.'");
</script>';
        unlink($_FILES['ImgPhoto']['tmp_name']);
        exit;
    }

    if(is_uploaded_file($_FILES['ImgPhoto']['tmp_name'])) {
        /** Deleting actual photo */
        if($sessionUser['picture'] != NULL) {
            del_userProfileImg($sessionUser['picture']);
        }

        img_orientate($_FILES['ImgPhoto']['tmp_name']); // Check if image has been reoriented on the OS (Windows / Linux / Mac...)
        
        $fileId = get_uniqueIdDatabase($sql = 'SELECT count(*) AS num FROM pr__user WHERE picture = :id');
        $pathPictures = _PATHROOT.'include/images/_uploads/profiles_pictures/';
        $dest = $pathPictures.$fileId.'.jpg';
        copy($_FILES['ImgPhoto']['tmp_name'], $dest);
        if(img_copyResized($dest, 
                            $pathPictures.$fileId.'-100.jpg', 100) &&
           img_copyResized($dest, 
                            $pathPictures.$fileId.'-500.jpg', 500)) {
            /**
             * If you add / modify / delete a dimension, you have to
             * update the function del_userProfileImg from global.inc.php
             */
            $sql = $dataBase->prepare('UPDATE pr__user 
                                       SET picture = :picture
                                       WHERE id = :id');
            $sql->execute(['picture'  => $fileId,
                           'id'       => get_userIdSession()]);
            $sql->closeCursor();
            
        }
        unlink($_FILES['ImgPhoto']['tmp_name']);
        echo '
<script>
$(".img-profile").fadeTo("fast", 0, function() {
  $("#ImgProfileTop").attr("src", "'.$config['ImagesURL'].'_uploads/profiles_pictures/'.$fileId.'-100.jpg");
  $("#AImgProfile").attr("href", "'.$config['ImagesURL'].'_uploads/profiles_pictures/'.$fileId.'-500.jpg");
  $("#ImgProfileTop").one("load", function() {
    $("#DivImgProfileDefault").addClass("dis-n");
    $("#DivImgProfile").removeClass("dis-n");
    setTimeout(function() {
      $(".img-profile").fadeTo("fast", 1);
    }, 1000);
  });
});
</script>';
    }
    
}











?>
