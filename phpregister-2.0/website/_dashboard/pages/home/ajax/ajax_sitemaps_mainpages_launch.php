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

ini_set('max_execution_time', 0); // No time limit

define('_PATHROOT', '../../../../');
require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');

/** Security check to prevent direct access to this ajax file */
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') { exit; }

if(!check_adminRights('sitemaps')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

$dateLastMod = date('Y-m-d');

$contentXML = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:xhtml="http://www.w3.org/1999/xhtml">
   <url>
      <loc>'.$config['URL'].'/en</loc>
      <lastmod>'.$dateLastMod.'</lastmod>
      <changefreq>daily</changefreq>
      <priority>1</priority>';
foreach($config['Langs'] as $oneLang) {
    if($oneLang != 'en') {
        $contentXML .= '
      <xhtml:link rel="alternate" hreflang="'.$oneLang.'" href="'.$config['URL'].'/'.$oneLang.'" />';
    }
}
$contentXML .= '
   </url>';
foreach($siteSections as $key => $value) {
    $contentXML .= '
   <url>
      <loc>'.$config['URL'].'/en/'.$key.'</loc>
      <lastmod>'.$dateLastMod.'</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.9</priority>';
    foreach($config['Langs'] as $oneLang) {
        if($oneLang != 'en') {
            $contentXML .= '
      <xhtml:link rel="alternate" hreflang="'.$oneLang.'" href="'.$config['URL'].'/'.$oneLang.'/'.get_sectionLang($key, $siteSections, $oneLang).'" />';
        }
    }
    $contentXML .= '
   </url>';
}

foreach($directPages as $onePage) {
    $contentXML .= '
   <url>
      <loc>'.$config['URL'].'/en/'.$onePage.'</loc>
      <lastmod>'.$dateLastMod.'</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>';
    foreach($config['Langs'] as $oneLang) {
        if($oneLang != 'en') {
            $contentXML .= '
      <xhtml:link rel="alternate" hreflang="'.$oneLang.'" href="'.$config['URL'].'/'.$oneLang.'/'.$onePage.'" />';
        }
    }
    $contentXML .= '
   </url>';    
}

$contentXML .= '
</urlset>';

$fileSiteMap = _PATHROOT.'/sitemaps-mainpages.xml';

$f = fopen($fileSiteMap, 'w'); 
# Now UTF-8 - Add byte order mark 
fwrite($f, pack('CCC',0xef,0xbb,0xbf)); 
fwrite($f, $contentXML); 
fclose($f);



?>
