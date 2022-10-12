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
 * Pagination function showing 2 pages before and after selected page:
 *  Example:
 *    - Page 10 selected:
 *    - 23 pages in total
 *  
 *  1 2  ... 8 9 10 11 12 ...  22 23
 *
 * $jsPageFunction, JavasScript function to display another page
 * Used in ajax_accounts_search.php, ajax_ticketadmin_search.php
 * 
 * #/ instead of # to prevent a click on a link from jumping to
 * top of page in jQuery
 */


function show_pagination2Pages($resultsTotal, $perPageMax, $jsPageFunction) {
    global $config;

    if(!isset($_POST['page']) && isset($_GET['page'])) {
        $_POST['page'] = $_GET['page'];
    }
    
    echo '
        <ul class="pagination">';
    $pagesCount = ceil($resultsTotal/$perPageMax);
    //$pagesCount = 20; /*For testing pagination*/
    $i = 0;
    while($i<$pagesCount) {
        $class = '';
        $onClick = '';
        if($i <= 1) {
            if($i == $_POST['page']) {
                $class = 'active';
            } else {
                $onClick = 'onClick="'.$jsPageFunction.'('.$i.');"';
            }
            echo '
            <li class="page-item '.$class.'"><a '.$onClick.' class="page-link" href="#/">'.($i+1).'</a></li>';
            if( ($i == 2) && ($_POST['page'] == 1) &&
                ($pagesCount >3) ) {
                echo '
            <li class="page-item"><a onClick="'.$jsPageFunction.'('.($i+1).') class="page-link" href="#/">'.($i+2).' </a></li>';
            }

        } else {
            if($pagesCount >= 4) {
                if(($_POST['page'] == 0) && ($pagesCount >= 4)) {
                    echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(2)">3</a></li>';
                }
                if( ($_POST['page'] == 1) && ($pagesCount >= 5) ) {
                    echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(2)">3</a></li>';
                    if($pagesCount >= 4) {
                        echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(3);">4</a></li>';
                    }
                }
                if( ($_POST['page'] == 2) && ($pagesCount >= 5) ) {
                    echo '
            <li class="page-item active"><a class="page-link" href="#/">3</a></li>';
                    if($pagesCount >= 6) {
                        if($pagesCount >= 4) {
                            echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(3);">4</a></li>';
                        }
                        if($pagesCount >= 5) {
                            echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(4);">5</a></li>';
                        }
                    }
                } else if( ($_POST['page'] == 3) && ($pagesCount >= 5) )  {
                    if($pagesCount >= 6) {
                        echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(2);">3</a></li>
            <li class="page-item active"><a class="page-link" href="#/">4</a></li>';
                        if($pagesCount >= 7) {
                            echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(4);">5</a></li>';
                        }
                        if($pagesCount >= 7) {
                            echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(5);">6</a></li>';
                        }
                    }
                } else if(($_POST['page'] == 4) && ($pagesCount >= 6) ){
                    echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(2);">3</a></li>
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(3);">4</a></li>
            <li class="page-item active"><a class="page-link" href="#/">5</a></li>';
                    if($pagesCount >= 8) {
                        echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(5);">6</a></li>';
                    }
                    if($pagesCount >= 8) {
                        echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(6);">7</a></li>';
                    }
                } else if(($_POST['page'] >= 5)&&
                          ($_POST['page'] < ($pagesCount-1)) ){
                    echo '
            <li class="page-item disabled" style="background-color:transparent;"><div class="pl-3 pr-3 align-middle"><i class="fa fa-ellipsis-h fnt-1-2 pt-3"></i></div></li>
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'('.($_POST['page']-2).');">'.($_POST['page']-1).'</a></li>
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'('.($_POST['page']-1).');">'.$_POST['page'].'</a></li>';
                    if($_POST['page'] != ($pagesCount-2)) {
                        echo '
            <li class="page-item active"><a class="page-link" href="#/">'.($_POST['page']+1).'</a></li>';
                    }
                    if($_POST['page'] < ($pagesCount-3)) {
                        echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'('.($_POST['page']+1).');">'.($_POST['page']+2).'</a></li>
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'('.($_POST['page']+2).');">'.($_POST['page']+3).'</a></li>';
                    }
                }
                if( $_POST['page'] <= ($pagesCount-6)){
                    echo '
            <li class="page-item disabled" style="background-color:transparent;"><div class="pl-3 pr-3 align-middle"><i class="fa fa-ellipsis-h fnt-1-2 pt-3"></i></div></li>';
                }
            }
            if($pagesCount >= 3) {
                if(($pagesCount >= 4)&&
                   ($_POST['page'] != ($pagesCount-4)) ){
                    if($_POST['page'] == ($pagesCount-2)) {
                        if($pagesCount == 5) {
                            echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'(2);">3</a></li>';
                        }
                        if($_POST['page'] != 4) {
                            echo '
            <li class="page-item active"><a class="page-link" href="#/">'.($pagesCount-1).'</a></li>';
                        }
                    } else {
                        if( ($_POST['page'] == ($pagesCount-1)) && ($pagesCount >= 5) ) {
                            if($pagesCount >= 6) {
                                echo '
            <li class="page-item disabled" style="background-color:transparent;"><div class="pl-3 pr-3 align-middle"><i class="fa fa-ellipsis-h fnt-1-2 pt-3"></i></div></li>';
                            }
                            echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'('.($pagesCount-3).');">'.($pagesCount-2).'</a></li>';

                        }
                        echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'('.($pagesCount-2).');">'.($pagesCount-1).'</a></li>';
                    }
                }
                if($_POST['page'] == ($pagesCount-1)) {
                    echo '
            <li class="page-item active"><a class="page-link" href="#/">'.($pagesCount).'</a></li>';

                } else {
                    echo '
            <li class="page-item"><a class="page-link" href="#/" onClick="'.$jsPageFunction.'('.($pagesCount-1).');">'.($pagesCount).'</a></li>';
                }
            }
            break;
        }
        $i++;
    }
    echo '
         </ul>';
}

/**
 * Pagination function showing 1 page before and 1 after selected page:
 *  Example:
 *    - Page 10 selected:
 *    - 23 pages in total
 *  
 *  1 2 3  ... 9 10 11  ... 21 22 23
 *
 * $jsPageFunction, JavasScript function to display another page
 *
 * Can be used instead of show_pagination2Pages()
 *
 * #/ instead of # to prevent a click on a link
 * from jumping to top of page in jQuery
 *
 */

function show_pagination1Page($resultsTotal, $perPageMax, $jsPageFunction) {
    global $config;

    echo '
        <ul class="pagination">';

    $pagesCount = ceil($resultsTotal/$perPageMax);
    //$pagesCount = 8; /*For testing pagination*/
    $i = 0;
    while($i<$pagesCount) {
        $class = '';
        $onClick = '';
        if($i <= 2) {
            if($i == $_POST['page']) {
                $class = 'class="active"';
            } else {
                $onClick = 'onClick="'.$jsPageFunction.'('.$i.');"';
            }
            echo '
            <li '.$class.'><a '.$onClick.' href="#/">'.($i+1).'</a></li>';
        } else {
            if($pagesCount > 6) {
                if($_POST['page'] == 2) {
                    echo '
            <li><a href="#/" onClick="'.$jsPageFunction.'(3);">4</a></li>';
                } else if($_POST['page'] == 3) {
                    echo '
            <li class="active"><a href="#/">4</a></li>';
                    if($pagesCount > 7) {
                        echo '
            <li><a href="#/" onClick="'.$jsPageFunction.'(4);">5</a></li>';
                    }
                } else if(($_POST['page'] == 4) &&
                          ($pagesCount != 7) ){
                    echo '
            <li><a href="#/" onClick="'.$jsPageFunction.'(3);">4</a></li>
            <li class="active"><a href="#/">5</a></li>';
                    if($pagesCount > 8) {
                        echo '
            <li><a href="#/" onClick="'.$jsPageFunction.'(5);">6</a></li>';
                    }
                } else if(($_POST['page'] >= 5)&&
                          ($_POST['page'] < ($pagesCount-3)) ){
                    echo '
            <li class="disabled" ><a href="#/" style="background-color:transparent;padding:2px;border:0px;cursor:default;"><strong>...</strong></a></li>
            <li><a href="#/" onClick="'.$jsPageFunction.'('.($_POST['page']-1).');">'.$_POST['page'].'</a></li>
            <li class="active"><a href="#/">'.($_POST['page']+1).'</a></li>';
                    if($_POST['page'] < ($pagesCount-4)) {
                        echo '
            <li><a href="#/" onClick="'.$jsPageFunction.'('.($_POST['page']+1).');">'.($_POST['page']+2).'</a></li>';
                    }
                }
                if( ($_POST['page'] != ($pagesCount-4)) &&
                    (($_POST['page'] != ($pagesCount-5))) ){
                    echo '
            <li class="disabled" ><a href="#/" style="background-color:transparent;padding:2px;border:0px;cursor:default;"><strong>...</strong></a></li>';
                }
            }
            if($pagesCount > 3) {
                if($pagesCount > 5) {
                    if($_POST['page'] == ($pagesCount-3)) {
                        echo '
            <li class="active"><a href="#/">'.($pagesCount-2).'</a></li>';
                    } else {
                        echo '
            <li><a href="#/" onClick="'.$jsPageFunction.'('.($pagesCount-3).');">'.($pagesCount-2).'</a></li>';
                    }
                }
                if($pagesCount > 4) {
                    if($_POST['page'] == ($pagesCount-2)) {
                        echo '
            <li class="active"><a href="#/">'.($pagesCount-1).'</a></li>';
                        
                    } else {
                        echo '
            <li><a href="#/" onClick="'.$jsPageFunction.'('.($pagesCount-2).');">'.($pagesCount-1).'</a></li>';
                    }
                }
                if($_POST['page'] == ($pagesCount-1)) {
                    echo '
            <li class="active"><a href="#/">'.($pagesCount).'</a></li>';

                } else {
                    echo '
            <li><a href="#/" onClick="'.$jsPageFunction.'('.($pagesCount-1).');">'.($pagesCount).'</a></li>';
                }
            }
            break;
        }
        $i++;
    }
    echo '
    </ul>';


}

?>
