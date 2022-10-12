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

define('_PATHROOT', '../../../');
require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global_display.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');
include_once (_PATHROOT.$config['AdminFolder'].'/admin_display.inc.php');
include_once ('translations_display.inc.php');

init_langVars(['Admin', 'Global']);

$adminPage = 'translations';

$cssFiles = get_cssFiles(['main', 'admin-sidebar', 'admin-pages']);
$jsFiles = get_jsFiles(['global', 'admin-sidebar']);

$cssPlugins = ['nprogress.css',
               '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
               '//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css'];
$jsPlugins = ['nprogress.js',
              '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
              '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
              '//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js',
              '//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js'];

$config['BodyClass'] = 'body-admin';

$sql = $dataBase->prepare('SELECT count(id) AS num FROM pr__translation');
$sql->execute();
$variablesCount = $sql->fetch()['num'];
$sql->closeCursor();

$sql = $dataBase->prepare('SELECT DISTINCT page FROM pr__translation ORDER by page');
$sql->execute();
$translationsPages = $sql->fetchAll();
$sql->closeCursor();

if(isset($_GET['search'])) {
    $sqlWhere = 'WHERE name LIKE "%'.$_GET['search'].'%" OR id = "'.$_GET['search'].'"';
} else {
    if(!isset($_GET['page'])) $_GET['page'] = 'Global';
    if($_GET['page'] == 'All') {
        $sqlWhere = 'WHERE 1';
    } else {
        $sqlWhere = 'WHERE page like "'.$_GET['page'].'"';
    }
}

$sql = $dataBase->prepare('SELECT * FROM pr__translation 
                          '.$sqlWhere.'
                          ORDER BY page,
                                   name');
$sql->execute();
$translations = $sql->fetchAll();
$sql->closeCursor();

if(!isset($_GET['page'])) {
    $_GET['page'] = '';
}

if(!check_adminRights('translations')) {
    show_adminError();
    exit;
}

$right = '<i onClick="showTranslateConfig();" class="fa fa-cog fa-2x pt-3 pointer pr-4"></i>';

$pageTop = ['left'    => '<i class="fa fa-language fa-3x pl-4 text-info"></i>',
            'center'  => 'Translations',
            'right'   => $right];

show_header();
show_adminSidebar();
show_adminPageTop($pageTop);
show_translations();
show_adminPageBottom();
show_end();





?>
