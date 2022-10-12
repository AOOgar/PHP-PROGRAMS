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

$paragraphs = [
    'Locatis lenunculos fiducia vel et Siden comminus temere occurrere conserendas quoque et effusae vel dum angusti locatis fiducia scientissime arcebantur quae scientissime a praestruebant sole arcebantur angusti et piscatorios cratibus.',
    'Cohorte aliis similia principes accendente de exitiale eius effervescebat non.',
    'Die adsistebant interrogationibus et imperio notarii nec funestis quidve die hinc aliis adsistebant notarii nec exsertantis imaginarius notarii diluere esset.',
    'Amicis vel proxime accedunt res.',
    'Praefecto protectorum otium Gallum ad solisque comite venerit adiumenta cum et subtraxit Syriam iussit verecunde conpererat quaedam cum scribens illi Domitiano iam conspiraret est Italiam ad eius acciverat fere blandius.',
    'Ut est narrare pastus necem quae professione est nihilo excedamus cadaveribus cadaveribus multa pastus quorum est singula narrare excedamus scrutabatur ut excedamus cadaveribus multa leo excedamus modi scrutabatur non pastus.',
    'Classi facta populum avide sunt ordo ordo sunt ordo et et urbem quam Ptolomaeo populum.'];

/**
 * Number of total paragraphs we will display
 */
$paragraphsTotal = mt_rand(3, 10);

$i = 1; 
$content = '';
while($i < $paragraphsTotal) {
    $selectParagraph = mt_rand(0, (count($paragraphs)-1));
    $content .= '<p>'.$paragraphs[$selectParagraph].'</p>';
    $i++;
}

echo '
<div id="DivAjaxModalBody">
'.$content.'
</div>

<script>
$("#SpanCountWords").html("'.str_word_count(strip_tags($content)).'");
$("#DivAjaxModalBody").appendTo($("#DivModalBodyDynamic"));
$("#ModalDynamic").modal("show");
</script>';

?>
