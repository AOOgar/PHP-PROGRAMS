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

init_langVars(['Admin', 'Global']);

if(!check_adminRights()) {
    echo '
    <script>location.reload();</script>';
    exit;
}

$sql = $dataBase->prepare('SELECT adminhome_period
                           FROM pr__user_adminprefs
                           WHERE user_id = :id');

$sql->execute(['id' => get_userIdSession()]);
$userPrefs = $sql->fetch();
$sql->closeCursor();


echo '
<div id="DivHomePrefs" class="mx-auto" style="max-width:800px;">
    <div class="mt-5 bg-light container">
        <div class="row">
            <div class="col-2"><i class="fa fa-gears fa-3x p-3"></i></div>
            <div class="col-10 p-3 fnt-1-4 text-right">'.lg('Preferences').'</div>
        </div>
    </div>
    <div class="mx-auto p-2 p-sm-4 bg-white border">
        <form method="post" id="FormHomePrefs" name="FormHomePrefs" action="#/">
        <p class="pb-3 text-center"><big>'.lg('Time range for charts on page opening:').'</big></p>

            <div class="mx-auto pt-4 pb-4" style="max-width:400px;">
                <select id="SelectGraphPeriod" name="SelectGraphPeriod" class="custom-select select-grey">
                    <option value="">--</option>
                    <option value="15LastDays"';
if($userPrefs['adminhome_period'] == '15LastDays') {
    echo ' selected ';
}
echo '>'.lg('15 last days').'</option>
                    <option value="LastPeriodFilled"';
if($userPrefs['adminhome_period'] == 'LastPeriodFilled') {
    echo ' selected ';
}
echo '>'.lg('Last period filled').'</option>
                </select>
            </div>
            <div class="text-center pt-5 pb-4">
                <button id="BtHomePrefs" class="btn btn-info" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Save', 'Global').'</button>
            </div>

        </form>
    </div>';

if(check_adminRights('admin')) {
    echo '
    <div id="DivWrapperRandAccounts" class="mt-5 container">
        <div class="row bg-danger text-white">
            <div class="col-5"><i class="fa fa-street-view fa-3x p-3"></i></div>
            <div class="col-7 p-3 fnt-1-4 text-right">Create randomly accounts</div>
        </div>
    </div>
    <div class="mx-auto p-2 p-sm-4 bg-white border fnt-1-1 mb-4">
        <p class="mb-0">Functionality to use with care, in a <b>test environment</b>. When creating or deleting a large number of users, the server will be high charged.</p>
        <div class="text-right">
            <a href="#/" data-toggle="collapse" data-target="#DivRandAccounts" class="fnt-1-7 ml-auto a-none"><i id="IconOpenRandAccounts" class="fa fa-angle-left text-danger ml-auto"></i></a>
        </div>
        <div id="DivRandAccounts" class="collapse">
            <p>Create accounts randomly to check if your server configuration can handle a large number of users, addresses and tickets opened on Helpdesk.</p>
            <p>With this functionnality, you can simulate a lot of users on your website and have a answers on questions like:</p>
            <ul>
                <li>How long to login or create a new account?</li>
                <li>How long to update its own profile or manage a Helpdesk ticket?</li>
                <li>How long to search in Admin dashboard a profile, a opened ticket or display Home charts?</li>
            </ul>
            <div class="float-right">
              Number of random accounts created: <div id="DivRandomAccounts" class="d-inline-block text-center" style="min-width:100px;"><i class="fa fa-spinner fa-spin fa-lg"></i></div>
            </div>
            <input type="hidden" id="InputCurrentRandAccounts" value="">
            <div class="clearfix"></div>
            <hr>
            <div class="my-4">               
                <p class="font-weight-bold">Create some new random accounts</p>
                <form action="#" id="FormRandAccounts"  name="FormName" method="post">
                <div class="input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text bg-light">Start date</span>
                    </div>
                    <select id="SelectMonthNumbers" name="SelectMonthNumbers" class="custom-select select-grey">';
    $i = 5;
    while($i <= 30) {
        $beginYear = date("Y", strtotime("-".($i-1)." months"));
        $month = date("m", strtotime("-".($i-1)." months"));
        $selected = '';
        if($i == 20) {
            $selected = 'selected';
        }
        echo '
                       <option value="'.$i.'" '.$selected.'>'.$beginYear.'/'.$month.'</option>';
        $i++;
    }
    echo '
                    </select>
                </div>
                <div class="input-group my-4">
                    <div class="input-group-prepend">
                       <span class="input-group-text bg-light">Number of accounts</span>
                    </div>
                    <input id="InputNumberAccounts" name="InputNumberAccounts" class="form-control input-grey rounded-right" value="50000" required>
                </div>
                <div class="text-center"><button id="BtRandAccountCreate" class="btn btn-info mb-2" data-loading-text="Generating random accounts: <span id=\'SpanPercentDone\'></span>">Create random accounts</button></div>
                </form>
                <p>The number of accounts to be created must be between 1 and 1,000,000.
                <br>Accounts will be created gradually to obtain realistic graphs. Therefore, the final number of random accounts created will not be exactly the specified number.
                <br>The only way to <b>stop</b> a random accounts creation in progress is by relaunching the web server or the PHP service.</p>
                <div id="DivTimeoutErrorCreate" class="dis-n text-danger"><b>Server timeout error</b>: If PHP is running as a service it will keep on running but the button will stay active and the number of random accounts blinking. When the "Number of random accounts created" does not change, that means the creating proccess is finished.</div>
                <div id="AjaxRandAccounts" class="dis-n"></div>
            <hr>
            <div id="DivDeleteRandomAccounts" class="dis-n mt-4">
                <p class="font-weight-bold">Delete created random accounts</p>
                <div class="text-right my-3">
                    <button id="BtDeleteRandomAccounts" class="btn btn-sm btn-outline-danger" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>Deleting the random accounts">Delete the random accounts</button>
                    <button id="BtOptimizeTables" class="btn btn-sm btn-sm btn-warning dis-n"><i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>Optimizing tables</button>
                </div>
                <p class="fnt-0-9 my-1">The deletion will be performed by checking the <span class="border px-2 py-1">agent</span> value in <span class="border px-2 py-1">pr__user</span> table which must be <span class="border px-2 py-1">random-account</span></p>
                <p class="fnt-0-9 my-1">Once the deletion finished, an optimisation SQL request will be performed on database tables.
                <br>The only way to <b>stop</b> a random accounts deletion in progress is by relaunching the web server or the PHP service.</p>
                <div id="DivTimeoutErrorDelete" class="dis-n text-danger"><b>Server timeout error</b>: If PHP is running as a service it will keep on running but the button will stay active and the number of random accounts blinking. When the "Number of random accounts created" is 0, that means the deleting proccess is finished.</div>
            </div>
        </div>
    </div>
</div>
<script>
$("#IconOpenRandAccounts").on("click", function() {
  $("#IconOpenRandAccounts").toggleClass("rotate");
  scrollToElem($("#DivWrapperRandAccounts"));
});
var createInProgress = false;
var timeoutErrorCreate = false;
$("#FormRandAccounts").on("submit", function (e) {
  var values = $("form#FormRandAccounts").serialize();
  $("#BtRandAccountCreate").btn("loading");
  $("#InputNumberAccounts").prop("disabled", true);
  $("#BtDeleteRandomAccounts").prop("disabled", true);
  doCheckRandAccounts = true;
  createInProgress = true;
  checkNumRandAccounts();
  reloadPage = true; /* For displaying back Home page with new charts */
  $.ajax({
    timeout: (6000 * 1000),
    url: "'.$config['AdminURL'].'/pages/home/ajax/random_accounts/ajax_randomaccounts_generate.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxRandAccounts").empty().html(data);
      $("#BtRandAccountCreate").btn("reset");
      $("#InputNumberAccounts").prop("disabled", false);
      $("#BtDeleteRandomAccounts").prop("disabled", false);
      doCheckRandAccounts = false;
      createInProgress = false;
    },
    error: function(jX, err, errT) {
      if(jX.status == 504) {
        $("#DivTimeoutErrorCreate").removeClass("dis-n");
        timeoutErrorCreate = true;
      }
      //alert(jX.status + "\n" + err + "\n" + errT);
    },
  });
  e.preventDefault();
});

var doCheckRandAccounts = false;
function checkNumRandAccounts() {
  $.ajax({
    timeout: (6000 * 1000),
    url: "'.$config['AdminURL'].'/pages/home/ajax/random_accounts/ajax_randomaccounts_count.php", type: "POST",
    success: function (data) {
      $("#DivRandomAccounts").empty().html(data);        
      $("#DivRandomAccounts").blink(1);
      if(data != "0") {
        $("#DivDeleteRandomAccounts").removeClass("dis-n");
      }
      if(doCheckRandAccounts) {
        setTimeout(function() {
          checkNumRandAccounts();
        }, 2000);
      }
      if(!createInProgress) {
        $("#InputCurrentRandAccounts").val(data);
      } else {
        if(!timeoutErrorCreate) {
          var accountsCreated = data - $("#InputCurrentRandAccounts").val();
          $("#SpanPercentDone").html(parseInt(accountsCreated * 100 / $("#InputNumberAccounts").val()) + " %");
        } else {
          $("#SpanPercentDone").html("?? %");
        }
      }
    },
  });
}
checkNumRandAccounts();
$("#BtDeleteRandomAccounts").on("click", function() {
  doCheckRandAccounts = true;
  $("#BtDeleteRandomAccounts").btn("loading");
  $("#BtRandAccountCreate").prop("disabled", true);
  checkNumRandAccounts();
  reloadPage = true; /* For displaying back Home page with new charts */
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/home/ajax/random_accounts/ajax_randomaccounts_delete.php", type: "POST",
    success: function (data) {
      doCheckRandAccounts = false;
      optimizeTables();
      $("#BtDeleteRandomAccounts").btn("reset");
      $("#BtRandAccountCreate").prop("disabled", false);
      $("#BtOptimizeTables").removeClass("dis-n");
      $("#BtDeleteRandomAccounts").addClass("dis-n");
    },
    error: function(jX, err, errT) {
      if(jX.status == 504) {
        $("#DivTimeoutErrorDelete").removeClass("dis-n");
      }
      //alert(jX.status + "\n" + err + "\n" + errT);
    },
  });
});

function optimizeTables() {
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/home/ajax/random_accounts/ajax_randomaccounts_optimizetables.php", type: "POST",
    success: function(data) {
      setTimeout(function() {
        $("#AjaxDB").empty().html(data);
        $("#BtOptimizeTables").addClass("dis-n");
        $("#BtDeleteRandomAccounts").removeClass("dis-n");
        $("#DivDeleteRandomAccounts").addClass("dis-n");   
        showDBTablesInfos();
      }, 2000);
    },
    error: function(exception) { console.log(exception); }
  });
}
</script>';
}
echo '
<script>
$("#DivHomePage").addClass("dis-n");
$("#AjaxHome").attr("style", "opacity:0;");
$("#AjaxHome").removeClass("dis-n");
$("#SelectGraphPeriod").on("change", function() {
    $(".custom-select").blur();
});
setTimeout(function () {$("#AjaxHome").fadeTo("fast", 1);NProgress.done();}, 500);' ;

?>
