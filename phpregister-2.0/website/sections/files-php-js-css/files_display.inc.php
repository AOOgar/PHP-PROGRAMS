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


function show_files() {
    global $config;

    echo '
<div class="container my-2 my-sm-5 documentation">

    <h4>Global structure of PHP files:</h4>
    <div class="row">
        <div class="col-sm-6">
            <div class="text-center"><img src="'.$config['ImagesURL'].'files-php-structure.jpg" class="border rounded-lg" style="width:100%;max-width:600px;"></div>
        </div>
        <div class="col-sm-6">
            <ul>
                <li><strong>index.php</strong>: The php file excecuted on page opening. Requires and includes are located in this file.</li>
                <li><strong>global.inc.php</strong>: A require to execute this files to create user session and connect to database. This files contains generic functions called on multiple parts of phpRegister.</li>
                <li><strong>global_cookies.inc.php</strong>: A require to execute this files which manage user cookies like user language preferences. This file may not be mandatory in some ajax calls which don\'t need user language preferences.</li>
                <li><strong>global_display.inc.php</strong>: An include is enough, file containing main display functions for navbar, footer, etc...This file should not be needed in PHP ajax calls.</li>
                <li><strong>mypage_display.inc.php</strong>: Display functions of your page</li>
                <li><strong>ajax files</strong>: If needed, ajax files which should be in folders <span class="px-2 py-0 border bg-white nowrap">ajax</span>.</li>
            </ul>
            <p>There are others global PHP files like <span class="px-2 py-0 border bg-white nowrap">global_images.inc.php</span> for images manipulations or <span class="px-2 py-0 border bg-white nowrap">emails/global_email.inc.php</span> to send emails.<br> Include these PHP global files only if needed for performance reasons.</p>
        </div> 
    </div>
    <hr>
    <h4>Your CSS files <span class="fnt-0-8 pl-2">(index.php)</span></h4>
    <p>To include in the DOM your CSS files, they must be in folder <span class="px-2 py-0 border bg-white nowrap">/include/css/</span>. To include a CSS file in your DOM, add its name without the last dash containing its version number and its extension in the argument of the PHP function <span class="px-2 py-0 border bg-white nowrap">get_cssFiles()</span> which must be an array. The return value must go in the variable <span class="px-2 py-0 border bg-white nowrap">$cssFiles</span>.</p>
    <p>Files will be analysed to include automaticly the most recent version, example by including in the DOM in addition to the <span class="px-2 py-0 border bg-white nowrap">navbar</span> and <span class="px-2 py-0 border bg-white nowrap">main</span> CSS files the <span class="px-2 py-0 border bg-white nowrap">test</span> file:</p>
    <p><pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/include-cssfile-documentation.php.txt"></pre></p>
    <p><span class="underline-mytheme">Result in the DOM:</span></p>
    <p><pre class="okaidia-block language-html" data-src="'.$config['URL'].'/include/show-code/DOM-css-files-global-documentation.html.txt"></pre></p>
    <p>If you modify your CSS files, then update the version number of your file to include in the DOM your last updates.</p>

    <hr>
    <h4>Plugins CSS files <span class="fnt-0-8 pl-2">(index.php)</span></h4>
    <p>Plugins CSS files can be inserted in the DOM from your local server or from an external CDN. CSS local files of plugins must be in the folder <span class="px-2 py-1 border bg-white nowrap">/include/plugins/css/</span>.</p>
    <p>To include a plugin CSS file in your DOM, add its filename in the PHP array variable <span class="px-2 py-0 border bg-white nowrap">$cssPlugins</span> which must be an array, example by including in the DOM 2 plugins CSS files, one from local server and the second one from a CDN:</p>
    <p><pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/include-pluginscss-files.php.txt"></pre></p>
    <p><span class="underline-mytheme">Result in the DOM:</span></p>
    <p><pre class="okaidia-block language-html" data-src="'.$config['URL'].'/include/show-code/DOM-plugins-css-files.txt"></pre></p>

    <hr>
    <h4>Your JavaScript files <span class="fnt-0-8 pl-2">(index.php)</span></h4>
    <p>Your JS files to include in the DOM must be in folder <span class="px-2 py-0 border bg-white nowrap">/include/js/</span>. To include a JS file in your DOM, add its name without the last dash containing its version number and its extension in the argument of the PHP function <span class="px-2 py-0 border bg-white nowrap">get_jsFiles()</span> which must be an array. The return value must go in the variable <span class="px-2 py-0 border bg-white nowrap">$jsFiles</span>.</p>
    <p>Files will be analysed to include automaticly the most recent version, example by including in the DOM in addition to the <span class="px-2 py-0 border bg-white nowrap">global</span> JS file the <span class="px-2 py-0 border bg-white nowrap">test</span> file:</p>
    <p><pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/include-jsfile-test.php.txt"></pre></p>
    <p><span class="underline-mytheme">Result in the DOM:</span></p>
    <p><pre class="okaidia-block language-html" data-src="'.$config['URL'].'/include/show-code/DOM-js-files-global-test.html.txt"></pre></p>
    <p>If you modify your JS file, then update the version number of your file to include in the DOM your last updates. <button onClick="test();" class="btn btn-xs btn-outline-secondary">Call test function</button></p>
    <p>You can use the PHP global variables <span class="px-2 py-0 border bg-white nowrap">$jsDocumentReady</span> <span class="px-2 py-0 border bg-white nowrap">$jsWindowLoaded</span> <span class="px-2 py-0 border bg-white nowrap">$jsWindowResize</span> <span class="px-2 py-0 border bg-white nowrap">$jsPlugins</span> <span class="px-2 py-0 border bg-white nowrap">$jsScripts</span> for non global JS functions to insert the JS into the DOM directly. <a href="https://phpregister.org/doc-phpvariables-for-js" target="_blank"><button class="btn btn-outline-secondary btn-xs">Documentation online</button></a></p>

    <hr>
    <h4>Plugins JavaScript files <span class="fnt-0-8 pl-2">(index.php)</span></h4>
    <p>Plugins JS files can be inserted in the DOM from your local server or from an external CDN. Plugins JS local files must be in the folder <span class="px-2 py-1 border bg-white nowrap">/include/plugins/js/</span>.</p>
    <p>To include a plugin JS file in your DOM, add its filename in the PHP array variable <span class="px-2 py-0 border bg-white nowrap">$jsPlugins</span> which must be an array, example by including in the DOM 2 plugins JS files, one from local server and the second one from a CDN:</p>
    <p><pre class="okaidia-block language-php" data-src="'.$config['URL'].'/include/show-code/include-pluginsjs-files.php.txt"></pre></p>
    <p>Plugins JS files from CDN must start only with <span class="px-2 py-0 border bg-white nowrap">//</span> and not with http or https, it will automatically select the https version.</p>
    <p><span class="underline-mytheme">Result in the DOM:</span></p>
    <p><pre class="okaidia-block language-html" data-src="'.$config['URL'].'/include/show-code/DOM-plugins-js-files.txt"></pre></p>

    <hr class="mt-4">
    <h4>List of PHP files</h4>
    <p>PHP files of the script phpRegister, this list does not display PHP files from external libraries. The files have been named so that it is easy to understand what they are going to do.</p>
    <p><pre class="okaidia-block language-bash" data-src="'.$config['URL'].'/include/show-code/list-phpfiles.sh.txt"></pre></p>

</div>';

}












?>
