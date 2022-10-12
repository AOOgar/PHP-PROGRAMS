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

define('_PATHROOT', '../../../../');

require_once (_PATHROOT.'config/config.inc.php');
require_once (_PATHROOT.'include/php/global.inc.php');
require_once (_PATHROOT.'include/php/global_cookies.inc.php');
include_once (_PATHROOT.'include/php/display_pagination.inc.php');
include_once (_PATHROOT.'include/php/display_pagination.inc.php');

init_langVars(['Admin', 'Helpdesk', 'Global']);

if(!check_adminRights('helpdesk')) {
    echo '
    <script>location.reload();</script>';
    exit;
}

/**
 * When a PHP script uses sessions, PHP locks the session file until the script completes.
 * So we close the session not to block the server.
 */
session_write_close();

if($_POST['page'] == 0) {
    $offSet = 0;
} else {
    $offSet = $_POST['page'] * $config['AdminTicketsPerPage'];     
}

$arrayExecute = array();

/**
 *  Used if $countSearch['number'] == 0 
 */
$searchFilled = 0;

/**
 *  If no status is selected, we select all
 */
if(!isset($_POST['status'][0])) {
    $_POST['status'][0] = 'opened';
    $_POST['status'][1] = 'read';
    $_POST['status'][2] = 'closed';
} else if( !(($_POST['status'][0] == 'opened') &&
             ((isset($_POST['status'][1]) && $_POST['status'][1]  == 'read')) &&
             ((isset($_POST['status'][2]) && $_POST['status'][2]  == 'read')))) {
    $searchFilled = 1;
}

$sqlWhere = 'WHERE ';
$i = 0;
foreach($_POST['status'] as $oneStatus) {
    if($i > 0) {
        $sqlWhere .= ' OR status = :status'.$i;
    } else {
        $sqlWhere .= '( status = :status'.$i;
    }
    $arrayStatus[$i]['status'] = $oneStatus;
    $i++;
}

$sqlWhere .= ')';

if(isset($_POST['searchUserID'])) {

    $sqlWhere .= ' AND ( user_id = ) ';

}
if($_POST['searchTicket'] != '') {
    $searchFilled = 1;
    $sqlWhere .= ' AND (';
    $id = $_POST['searchTicket'];
    $_POST['searchTicket'] = trim(preg_replace('!\s+!', ' ', str_replace(array ("\r", "\t", "\n"), " ", $_POST['searchTicket'])));
    $arrayWords = explode(" ", $_POST['searchTicket']);
    $searchMatch = '"';
    foreach($arrayWords as $word) {
        $searchMatch .= ' +'.$word.'';
    }
    $searchMatch .= '"';
    $sqlWhere .= '
    pr__ticket.id LIKE :ticket_id OR
    pr__ticket.user_id LIKE :user_id OR
    MATCH (subject, message) AGAINST (:match IN NATURAL LANGUAGE MODE) )';
}

$sql = $dataBase->prepare('SELECT pr__ticket.*,
                                  pr__user.firstname, pr__user.lastname, pr__user.lang
                           FROM pr__ticket
                           LEFT JOIN pr__user ON pr__user.id = pr__ticket.user_id
                           '.$sqlWhere.'
                           ORDER BY date DESC LIMIT '.$config['AdminTicketsPerPage'].' OFFSET '.$offSet);
$i = 0;
foreach($arrayStatus as $oneStatus) {
    $sql->bindParam('status'.$i, $oneStatus['status'], PDO::PARAM_STR);
    $i++;
}

if($_POST['searchTicket'] != '') {
    $sql->bindParam('ticket_id', $id, PDO::PARAM_STR);
    $sql->bindParam('user_id', $id, PDO::PARAM_STR);
    $sql->bindParam('match', $searchMatch, PDO::PARAM_STR);
}

$sql->execute();
$ticketSearch = $sql->fetchAll();
$sql->closeCursor();

$sqlCount = $dataBase->prepare('SELECT count(*) AS number
                                FROM pr__ticket
                                '.$sqlWhere);

$i=0;
foreach($arrayStatus as $oneStatus) {
    $sqlCount->bindParam('status'.$i, $oneStatus['status'], PDO::PARAM_STR);
    $i++;
}
if($_POST['searchTicket'] != '') {
    $sqlCount->bindParam('ticket_id', $id, PDO::PARAM_STR);
    $sqlCount->bindParam('user_id', $id, PDO::PARAM_STR);
    $sqlCount->bindParam('match', $searchMatch, PDO::PARAM_STR);
}

$sqlCount->execute();
$countSearch = $sqlCount->fetch();

echo '
<div id="DivAjaxSearchTickets" class="mx-2">';
if($countSearch['number'] != 0) {
    echo ajax__ticketSearchResult($ticketSearch);
} else {
    echo '
<div class="fnt-1-2 text-center p-5 mb-4 rounded bg-light">No tickets found</div>';
}

echo '
<div id="DivPagination" class="container">
    <div class="row">
        <div class="col-sm-8">';

/**
 * Function from admin_display.inc.php
 */
show_pagination2Pages($countSearch['number'], $config['AdminTicketsPerPage'], 'ticketSearch');

echo '
        </div>
        <div class="col-sm-4 text-right">';
if($searchFilled == 1) {
    echo  '
            <div class="border bg-white d-inline-block rounded px-3 py-2">
                '.lg('Search result').': <b>'.number_format($countSearch['number'], 0, '.', ' ').'</b>
            </div>';
}
echo '
        </div>
    </div> ';

echo '
</div>';


echo '
<script>
setTimeout(function () {
  $("#DivHelpDesk").empty();
  $("#DivAjaxSearchTickets").appendTo($("#DivHelpDesk"));
  $("#BtSearch").btn("reset");
}, 1000);

</script>';


function ajax__ticketSearchResult($ticketSearch) {
    global $config, $jsWindowLoaded;

    $html = '
<div class="bg-white px-4 py-3 rounded mb-4">';
    foreach($ticketSearch as $oneTicket) {
        if($oneTicket['status'] == "opened") {
            $borderStatus = 'border-success shadow';
            $textStatus = lg('Sent', 'Helpdesk');
            $textColor = 'text-success';
        } else if($oneTicket['status'] == "read") {
            $borderStatus = 'border-warning shadow';
            $textStatus = lg('In progress', 'Helpdesk');
            $textColor = 'text-warning';
        } else if($oneTicket['status'] == "closed") {
            $borderStatus = 'border-secondary';
            $textStatus = lg('Resolved', 'Helpdesk');
            $textColor = 'text-secondary';
        }
        $html .= '
<div id="DivTicket'.$oneTicket['id'].'" class="my-4 bg-white border '.$borderStatus.' p-3 rounded" style="min-height:50px;">
        <div class="row">
            <div class="col-sm-3">
                <span class="pointer" onClick="showModalDetails('.$oneTicket['user_id'].', 0)"><b>'.$oneTicket['firstname'].' '.$oneTicket['lastname'].'</b></span> [ID: '.$oneTicket['user_id'].'] <br> Ticket #'.$oneTicket['id'].'
            </div>
            <div class="col-sm-4 pointer" onClick="showModalTicket('.$oneTicket['id'].', 0)">
                 <b>'.lg('Subjet', 'Helpdesk').':</b> ';
        if(strlen($oneTicket['subject']) > 70) {
            $html .= substr($oneTicket['subject'], 0, 67).'...';
        } else {
            $html .= $oneTicket['subject'];
        }
        $html .= '
            </div>
            <div class="col-sm-2">
                <b>'.lg('Date', 'Helpdesk').':</b> '.get_dateFormatLang($oneTicket['date']).'
            </div>
            <div class="col-sm-3 text-center">
                <div id="DivTicketStatus'.$oneTicket['id'].'" class="'.$textColor.' d-inline-block fnt-0-9 p-2 text-center font-weight-bold">'.$textStatus.'</div>
                <div class="float-right">
<div class="btn-group">
    <button type="button" class="btn btn-info btn-sm rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sort-desc"></i></button>
    <div class="dropdown-menu dropdown-menu-right fnt-1-0">
        <a class="dropdown-item" href="#/" style="color:#337ab7" onClick="showModalTicket('.$oneTicket['id'].', 0)"><i class="fa fa-search pr-3" style="font-size:24px;"></i>'.lg('Open', 'Helpdesk').'</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#/" style="color:#337ab7" onClick="showModalDetails('.$oneTicket['user_id'].', 0)"><i class="fa fa-user pr-3" style="font-size:24px;"></i>'.lg('Account details').'</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#/" style="color:red;" onClick="showModalTicket('.$oneTicket['id'].', 1);"><i class="fa fa-remove pr-3" style="font-size:24px;"></i>Delete the ticket</a>
    </div>
</div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>';
    }

    $html .= '
</div>';


    return $html;
}






?>
