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
 * Global Images functions
 */

function del_imageById($id, $positionUpdate = TRUE) {
    global $dataBase;

        
}

function check_imageSecure($pathImage) {

    $verifyimg = getimagesize($pathImage);
    if( ($verifyimg['mime'] != 'image/jpeg') ||
        (exif_imagetype($pathImage) == FALSE) ||
        !($verifyimg[0]) || !($verifyimg[1]) ) {
        return lg('Unable to determine the type of file', 'Global');
    }
    $searchString = ['<?php', '<script>'];
    if(file_exists($pathImage)){//if myFile exists check it for searchString:
        foreach($searchString as $oneString) {
            if (PHP_OS === 'WINNT') {
                if( strpos(file_get_contents($pathImage), $oneString) !== FALSE) {
                    return lg('Unable to determine the type of file', 'Global');
                }
            } else {
                if(exec('grep '.escapeshellarg($oneString).' '.$pathImage)) {
                    return lg('Unable to determine the type of file', 'Global');
                }
            }
        }
    }
    return TRUE;
}

function img_copyResized($src, $dest, $newSizeMax) {
    global $config;

    list($width, $height) = getimagesize($src);
    if($width > $config['ImagesMaxSize'] || $height > $config['ImagesMaxSize']) {
        /**
         * Uploaded Image Max Size
           If one side is bigger, original image will be resized
         */
        img_resize($src, $config['ImagesMaxSize']);
        list($width, $height) = getimagesize($src);
    }
    $newWidth = $newSizeMax;
    $newHeight = $newSizeMax;
    if($width > $height) {
        $newHeight = intval(($newSizeMax * $height)/$width);
    } else {
        $newWidth = intval(($newSizeMax * $width)/$height);
    }
    $thumb = imagecreatetruecolor($newWidth, $newHeight);
    $source = imagecreatefromjpeg($src);
    imagesetinterpolation($source, IMG_HAMMING);
    imagesetinterpolation($thumb, IMG_HAMMING);
    if($source) {
        //$thumb = imagescale($source, $newWidth, $newHeight, IMG_BICUBIC);
        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        return imagejpeg($thumb, $dest, 90);
    } else {
        return FALSE;
    }
    
}

function img_resize($src, $newSizeMax) {
    list($width, $height) = getimagesize($src);
    $newWidth = $newSizeMax;
    $newHeight = $newSizeMax;
    if($width > $height) {
        $newHeight = intval(($newSizeMax * $height)/$width);
    } else {
        $newWidth = intval(($newSizeMax * $width)/$height);
    }
    $thumb = imagecreatetruecolor($newWidth, $newHeight);
    $source = imagecreatefromjpeg($src);
    imagesetinterpolation($source, IMG_HAMMING);
    imagesetinterpolation($thumb, IMG_HAMMING);
    if($source) {
        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        return imagejpeg($thumb, $src, 90);
    } else {
        return FALSE;
    }
}

function img_orientate($source, $quality = 90, $destination = NULL) {
    if ($destination === NULL) {
        $destination = $source;
    }
    $info = getimagesize($source);
    if ($info['mime'] === 'image/jpeg') {
        $exif = exif_read_data($source);
        if (!empty($exif['Orientation']) && in_array($exif['Orientation'], [2, 3, 4, 5, 6, 7, 8])) {
            $image = imagecreatefromjpeg($source);
            if (in_array($exif['Orientation'], [3, 4])) {
                $image = imagerotate($image, 180, 0);
            }
            if (in_array($exif['Orientation'], [5, 6])) {
                $image = imagerotate($image, -90, 0);
            }
            if (in_array($exif['Orientation'], [7, 8])) {
                $image = imagerotate($image, 90, 0);
            }
            if (in_array($exif['Orientation'], [2, 5, 7, 4])) {
                imageflip($image, IMG_FLIP_HORIZONTAL);
            }
            imagejpeg($image, $destination, $quality);
        }
    }
    return true;
}

?>
