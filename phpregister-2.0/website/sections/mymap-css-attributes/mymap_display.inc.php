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

function show_attributes() {
    global $config, $jsScripts, $jsDocumentReady;

    $jsScripts .= '
var lat = 51.510357;
var lon = -0.116773;
var mymap = null;
function initMap() {
  mymap = L.map("map").setView([lat, lon], 13);                
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "data © <a href=\'//osm.org/copyright\'>OpenStreetMap</a>/ODbL</a>",
    minZoom: 1,
    maxZoom: 20
  }).addTo(mymap);                                
  var marker = L.marker([lat, lon]).addTo(mymap);
  mymap.scrollWheelZoom.disable();
}';

    $jsDocumentReady .= '
initMap();';

    echo '
<div class="container my-5 documentation">
    <h4>Attributes for CSS plugins</h4>
    <p>You can specify attributes and values to these attributes when you initialize the array variable <span class="px-2 py-0 border bg-white">$cssPlugins</span>. Example with the plugin <span class="px-2 py-0 border bg-white">//unpkg.com/leaflet@1.3.1/dist/leaflet.css</span> having the attribute <span class="px-2 py-0 border bg-white">integrity</span> with a value and the attribute <span class="px-2 py-0 border bg-white">crossorigin</span> without any value:</p>
    <p><pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/include-pluginscss-attributes-files.php.txt"></pre></p>
    <p><span class="underline-mytheme">Result in the DOM:</span></p>
    <p><pre class="okaidia-block language-html" data-src="'.$config['URL'].'/include/show-code/DOM-plugins-css-attributes.html.txt"></pre></p>
    <hr class="mt-4">
    <h4>Attributes for JS plugins</h4>
    <p>By the same way, you can specify attributes when you initialize <span class="px-2 py-0 border bg-white">$jsPlugins</span>. Example with the plugin <span class="px-2 py-0 border bg-white">//unpkg.com/leaflet@1.3.1/dist/leaflet.js</span> having the attribute <span class="px-2 py-0 border bg-white">integrity</span> with a value and the attribute <span class="px-2 py-0 border bg-white">crossorigin</span> without any value:</p>
    <p><pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/include-pluginsjs-attributes-files.php.txt"></pre></p>
    <p><span class="underline-mytheme">Result in the DOM:</span></p>
    <p><pre class="okaidia-block language-html" data-src="'.$config['URL'].'/include/show-code/DOM-plugins-js-attributes.html.txt"></pre></p>
    <hr class="mt-4">
    <h4>Displaying a map with leaflet.js Plugin:</h4>
    <div id="map" class="mt-3 border border-info rounded-lg" style="height: 450px; width: 100%; margin-bottom: 45px;"></div>
</div>';

}












?>
