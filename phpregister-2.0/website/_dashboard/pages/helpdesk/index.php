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
include_once ('helpdeskadmin_display.inc.php');

init_langVars(['Admin', 'Helpdesk', 'Global']);

$adminPage = 'helpdesk';

$cssFiles = get_cssFiles(['main', 'admin-sidebar', 'admin-pages']);
$jsFiles = get_jsFiles(['global', 'admin-sidebar']);

$cssPlugins = ['nprogress.css',
               '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.min.css'];
$jsPlugins = ['nprogress.js',
              'admin/jquery.placeholder.min.js',
              '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/bootstrap-select.min.js'];

$config['BodyClass'] = 'body-admin';

$sql = $dataBase->prepare('SELECT COUNT(id) AS number
                           FROM pr__ticket'); 
$sql->execute();
$ticketCount = $sql->fetch();
$sql->closeCursor();

$sql = $dataBase->prepare('SELECT COUNT(id) AS number
                           FROM pr__ticket_reply'); 
$sql->execute();
$ticketReplyCount = $sql->fetch();
$sql->closeCursor();

$sql = $dataBase->prepare('SELECT firstname, lastname
                           FROM pr__user
                           WHERE id = :id');

if(!check_adminRights('helpdesk')) {
    show_adminError();
    exit;
}

$pageTop = ['left'    => '<i class="fa fa-weixin fa-3x pl-4 text-info"></i>',
            'center'  => lg('Helpdesk'),
            'right'   => '<i onClick="showHelpDeskPrefs();" class="fa fa-cog fa-2x pointer pr-3 pt-2"></i>'];

show_header();
show_adminSidebar();
show_adminPageTop($pageTop);
show_helpdesk();
show_adminPageBottom();
show_end();


?>
