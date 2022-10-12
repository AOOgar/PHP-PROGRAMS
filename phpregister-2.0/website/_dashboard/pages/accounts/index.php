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
include_once ('accountsadmin_display.inc.php');
include_once ('accountsadmin_sql.inc.php');

init_langVars(['Admin', 'Global']);

$adminPage = 'accounts';

$cssFiles = get_cssFiles(['main', 'admin-sidebar', 'admin-pages']);
$jsFiles = get_jsFiles(['global', 'admin-sidebar']);

$cssPlugins = ['nprogress.css',
               '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.min.css', /* For Selecting Admin right*/
               '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
               '//cdn.datatables.net/responsive/2.2.2/css/responsive.bootstrap4.min.css',
               'admin/summernote/summernote.css',
               '//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.css'];
$jsPlugins = ['nprogress.js',

              '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/bootstrap-select.min.js', /* For Selecting Admin right*/

              '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
              '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
              '//cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js',
              '//cdn.datatables.net/responsive/2.2.2/js/responsive.bootstrap4.min.js',

              '//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.js',
              '//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.6.2/ckeditor.js',              
              'admin/summernote/summernote.min.js',
              'admin/summernote/lang/summernote-fr-FR.js'];

$config['BodyClass'] = 'body-admin';

if(!isset($_POST['order'])) {
    $_POST['order'] = 'date_accountcreated';
}

if(!check_adminRights('accounts')) {
    show_adminError();
    exit;
}

if(check_adminRights('admin')) {
    $accountsPrefs = '<i onClick="showAccountsConfig();" class="fa fa-cog fa-2x pt-3 pointer pr-4"></i>';
} else {
    $accountsPrefs = '';
}

$pageTop = ['left'    => '<i class="fa fa-users fa-3x pl-4 text-info"></i>',
            'center'  => lg('User Accounts'),
            'right'   => $accountsPrefs];

/**
 * GET User order prefs 
 */
$sql = $dataBase->prepare('SELECT accounts_searchorder
                           FROM pr__user_adminprefs
                           WHERE user_id = :id');
$sql->execute(['id' => get_userIdSession()]);
$userPrefsOrder = $sql->fetch()['accounts_searchorder'];
$sql->closeCursor();
if($userPrefsOrder == NULL) {
    $userPrefsOrder = 'date_accountcreated';
}

show_header();
show_adminSidebar();
show_adminPageTop($pageTop);
show_accounts();
show_adminPageBottom();
show_end();


?>
