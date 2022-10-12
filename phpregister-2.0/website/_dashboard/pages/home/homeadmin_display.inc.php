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
 
function show_adminHome() {
    global $config, $jsWindowLoaded, $jsScripts;
    global $dataBase; /* To recover it in sql_ function  */
        
    
    /**
     *  SQL to display users created by email
     *  and created with social buttons
     */
    $sqlUsersTotal = $dataBase->prepare('SELECT COUNT(*) AS total
                                         FROM pr__user');
    $sqlUsersTotal->execute();
    $countUsers = $sqlUsersTotal->fetch();
    
    $sqlUsersTotal->closeCursor();
    
    $sqlUsersByEmail = $dataBase->prepare('SELECT COUNT(*) AS total
                                           FROM pr__user
                                           WHERE password IS NOT NULL');
    $sqlUsersByEmail->execute();
    $countUsersByEmail = $sqlUsersByEmail->fetch();
    if($countUsersByEmail['total'] == NULL) {
        $countUsersByEmail['total'] = 0;
    }
    
    $sqlUsersByEmail->closeCursor();
    
    $sqlUsersSocialNetwork = $dataBase->prepare('SELECT SUM(IF(facebook_id IS NOT NULL, 1, 0)) AS facebook,
                                                        SUM(IF(google_id IS NOT NULL, 1, 0)) AS google
                                                 FROM pr__user_oauth');
    $sqlUsersSocialNetwork->execute();
    $countUsersBySocial = $sqlUsersSocialNetwork->fetch();
    if($countUsersBySocial['facebook'] == NULL) {
        $countUsersBySocial['facebook'] = 0;
    }
    if($countUsersBySocial['google'] == NULL) {
        $countUsersBySocial['google'] = 0;
    }

    /**
     * GET User charts display prefs 
     */    
    $sql = $dataBase->prepare('SELECT adminhome_period, adminhome_periodfilled
                               FROM pr__user_adminprefs
                               WHERE user_id = :id');

    $sql->execute(['id' => get_userIdSession()]);
    $userPrefs = $sql->fetch();
    $sql->closeCursor();

    $jsScripts .= '
function labelFormatter(label, series) {
  return "<div style=\'font-size:8pt; text-align:center; padding:2px; color:white;\'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}';
    
    /**
     *  List and sizes of database tables
     */
    $jsScripts .= '
function showDBTablesInfos() {
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/home/ajax/ajax_dbtables_show.php", type: "POST",
    success: function(data) {
      $("#AjaxDB").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}
showDBTablesInfos();';

echo '
<div id="AjaxDB" class="dis-n"></div>
<div id="AjaxCharts" class="dis-"></div>';
if(check_adminRights('sitemaps')) {
    echo '
<div class="modal modal-mytheme fade" id="ModalSiteMaps" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-sitemap pr-4 align-middle"></i>Generate SiteMaps files</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ModalBodySiteMaps">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">'.lg('Close', 'Global').'</button>
            </div>
        </div>
    </div>
</div>

<div id="AjaxSiteMaps" class="dis-n"></div>';
    $jsScripts .= '
function showHomeSiteMaps() {
  contentPage = $("#DivHomePage").html();
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/home/ajax/ajax_sitemaps_modalopen.php", type: "POST",
    success: function(data) {
      $("#AjaxSiteMaps").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}';
}
    $jsScripts .= '
var prefsOpened = false;
var reloadPage = false;
function showHomeConfig() {
  if(NProgress.isStarted()) return;
  NProgress.start();
  if(!prefsOpened) {
    contentPage = $("#DivHomePage").html();
    $.ajax({
      url: "'.$config['AdminURL'].'/pages/home/ajax/ajax_home_prefs_show.php", type: "POST",
      success: function(data) {
        $("#AjaxHome").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });
    prefsOpened = true;
  } else {
    if(reloadPage) {
      location.reload();
      return;
    }
    $("#AjaxHome").empty();
    $("#DivHomePage").attr("style", "opacity:0;");
    $("#DivHomePage").removeClass("dis-n");
    $("#AjaxHome").removeClass("dis-n").addClass("dis-n");
    setTimeout(function () {$("#DivHomePage").fadeTo("fast", 1);NProgress.done();}, 500);
    prefsOpened = false;
  }
}
$(document).on("submit", "#FormHomePrefs", function(e) {
  NProgress.start();    
  $("#BtHomePrefs").btn("loading");
  var values = $("#FormHomePrefs").serialize();
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/home/ajax/ajax_home_prefs_update.php", type: "POST", data: values,
    success: function(data) {
     setTimeout(function() {
       $("#DivHomePage").attr("style", "opacity:0;");
       $("#DivHomePage").removeClass("dis-n");
       $("#AjaxHome").removeClass("dis-n").addClass("dis-n");
       setTimeout(function () {$("#DivHomePage").fadeTo("fast", 1);}, 1000);
       NProgress.done();
     }, 2000);
     prefsOpened = false;
    }
  });
  e.preventDefault();
});';
    
    echo '
<div id="DivHomePage">
    <div class="row">
        <div class="col-sm-6 p-4">

            <div class="card border-primary mx-auto" style="max-width:500px;">
                <div class="card-header bg-primary text-light">
                    <div class="float-left">
                           <i class="fa fa-database fa-3x"></i>
                    </div>
                    <div class="float-right text-right">
                        <div class="fnt-1-5">'.lg('Database').' {'.$config['DatabaseName'].'}</div>
                        <div id="DivDBInfos"></div>
                    </div>
                </div>
                <div id="DivDBTables" class="card-footer fnt-1-1">
                </div>
            </div>
        </div>';
    
    /**
     *  Accounts type Pie Chat
     */
    $jsWindowLoaded .= '
var data = [
   { label: "'.lg('By email').'",  data: '.$countUsersByEmail['total'].', color: "#4da74d"},
   { label: "Facebook",  data: '.$countUsersBySocial['facebook'].', color: "#1d4ec1"},
   { label: "Google+",  data: '.$countUsersBySocial['google'].', color: "#cb4b4b"},
];

var placeholder = $("#Div_piechart");
showPieChart(data);';
    
    $jsScripts .= '
function showPieChart(data) {
  $.plot($("#Div_piechart"), data, {
    series: {
         pie: { 
              show: true,
              radius: 1,
              label: {
                  show: true,
                  radius: 3/4,
                  formatter: labelFormatter,
                  background: { 
                      opacity: 0.5,
                      color: "#000"
                  }
              }
	 }
    }
  });
}';

    echo '
        <div class="col-sm-6 p-4">

            <div class="card border-success mx-auto" style="max-width:500px;">
                <div class="card-header bg-success text-white">
                    <div class="float-left">
                            <i class="fa fa-users fa-3x"></i>
                    </div>
                    <div class="float-right text-right">
                           <div class="fnt-1-5">'.lg('User Accounts').'</div>
                           <div>'.number_format($countUsers['total'], 0, '.', ' ').'</div>
                    </div>
                </div>
                <div id="Div_content_pc" class="card-footer fnt-1-1" style="height:300px;">
                    <div id="Div_piechart" style="width:100%;height:100%"></div>
                </div>
            </div>

        </div>';
    
    /**
     *  Total Accounts Line Chart
     */
    $sql = $dataBase->prepare('SELECT date_format(MIN(date_accountcreated), "%Y-%m-%d") AS dateMin
                               FROM pr__user');
    $sql->execute();
    $dateMinMax = $sql->fetch();
    $dateOldest = $dateMinMax['dateMin'];
    $datetime = new DateTime($dateMinMax['dateMin']);
    $yearOldest = $datetime->format('Y');
    $dateNewest = date('Y-m-d');

    if($yearOldest == date('Y')) {
        $startView = 1;
    } else {
        $startView = 2;
    }

    $jsWindowLoaded .= '
$("body").on("click", function(event) {
    var target = $(event.target);
    if (target.parents(".bootstrap-select").length) {
	event.stopPropagation();
//$(".selectpicker").selectpicker("destroy");
//$(".selectpicker").selectpicker("show");
    }
});
$("body").on("click", ".dropdown-menu", function (e) {
    //$(this).parent().is(".show") && e.stopPropagation();
});

$(document).on("click", ".dropdown-menu", function (e) { //Prevent closing dropdown-menu on clicking inside
    e.stopPropagation();
});

$(document).on("click", ".bootstrap-select", function (e) { /* Prevent closing dropdown-menu on clicking inside  */
  //  e.stopPropagation();
});
$("#BtLast15days").on("click", function(event) {
  if(!$("#BtLast15days").hasClass("disabled")) {
    $(".dropdown-menu.show").removeClass("show");
    var values = { "period": "15lastdays"};
    $.ajax({
      url: "'.$config['AdminURL'].'/pages/home/ajax/ajax_home_charts_update.php", type: "POST", data: values,
      success: function (data) {
        $("#AjaxCharts").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });
    dateRangeRefresh("'.lg('15 last days').'");
    $("#BtLast15days").addClass("disabled");
  }
});
$("#BtCurrentMonth").on("click", function(event) {
  if(!$("#BtCurrentMonth").hasClass("disabled")) {
    $(".dropdown-menu.show").removeClass("show");
    dateRangeRefresh("'.lg('Current month').'");
    $("#BtCurrentMonth").addClass("disabled");
    var values = { "period": "currentmonth"};
    $.ajax({
      url: "'.$config['AdminURL'].'/pages/home/ajax/ajax_home_charts_update.php", type: "POST", data: values,
      success: function (data) {
        $("#AjaxCharts").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });
  }
});

$("#SelectYear").on("change", function(){
  var selectedYear = $(this).find("option:selected").val();
  if(selectedYear == "") {
    return;
  }
  NProgress.start();
  dateRangeRefresh("'.lg('Year').': " + selectedYear);
  var values = { "period": "oneyear", "year": selectedYear};
  $(".dropdown-menu.show").removeClass("show");
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/home/ajax/ajax_home_charts_update.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxCharts").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});

$("#BtSendDates").on("click", function() {
  if( $("#dateStart").val() == "" || $("#dateEnd").val() == "") {
    $("#DivRangeAlert").html("'.lg('Please, specify start date and end date').'");
    $("#BtSendDates").blur();
  } else if($("#dateStart").val() >= $("#dateEnd").val()) {
    $("#DivRangeAlert").html("'.lg('Start date must be earlier than end date').'");
    $("#BtSendDates").blur();
  } else {
   $(".dropdown-menu.show").removeClass("show");
   var dateStart = $("#dateStart").val();
   var dateEnd = $("#dateEnd").val();
   var values = { "period": "custom", "start": dateStart, "end": dateEnd}
    $.ajax({
      url: "'.$config['AdminURL'].'/pages/home/ajax/ajax_home_charts_update.php", type: "POST", data: values,
      success: function (data) {
        $("#AjaxCharts").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
   });
   dateRangeRefresh("'.lg('From').' " + dateStart + " '.lg('to').' " + dateEnd);
   $("#dateStart").val(dateStart);
   $("#dateEnd").val(dateEnd);
  }
});
$("#dateStart").datepicker({
    format: "yyyy-mm-dd",
    startDate: "'.$dateOldest.'",
    endDate: "'.$dateNewest.'",
    startView: '.$startView.',
    autoclose: true,
    language: "'.$config['UserLang'].'"
});
$("#dateEnd").datepicker({
    format: "yyyy-mm-dd",
    startDate: "'.$dateOldest.'",
    endDate: "'.$dateNewest.'",
    startView: '.$startView.',
    autoclose: true,
    language: "'.$config['UserLang'].'"
});
allAccounts = [];
socialNetworks = [];
chartAllAccountsRefresh();
chartSocialMediaRefresh();' ;
    if( ($userPrefs['adminhome_period'] == 'LastPeriodFilled') &&
        ($userPrefs['adminhome_periodfilled'] != '15LastDays') ) { /* 15LastDays is the default period */
        if($userPrefs['adminhome_periodfilled'] == 'CurrentMonth') {
            $jsWindowLoaded .= '
$("#BtCurrentMonth").trigger("click");';
        } else if(strpos($userPrefs['adminhome_periodfilled'], ',') !== false) { /* It's a Period between 2 dates separated with a comma */
            $dates = explode(',', $userPrefs['adminhome_periodfilled']);
            $jsWindowLoaded .= '
$("#dateStart").val("'.$dates[0].'");
$("#dateEnd").val("'.$dates[1].'");
$("#BtSendDates").trigger("click");';
        } else { /* It's a Year */
            $jsWindowLoaded .= '
$("#SelectYear").val("'.$userPrefs['adminhome_periodfilled'].'").trigger("change");';
        }
    } else {
        $jsWindowLoaded .= '
$("#BtLast15days").trigger("click");';
    }

    $jsScripts .= '
var allAccounts = null;
var socialNetworks = null;

function dateRangeRefresh(date) {
    NProgress.start();
    $("#BtPeriod").html("<i class=\'fa fa-area-chart\'></i><span class=\'p-4\'>" + date + "</span><i class=\'fa fa-spinner fa-spin fa-lg\'></i>");
    $(".btn-group").removeClass("open");
/*
    $("#SelectYear").val("").trigger("changed");
    $("#SelectYear").selectpicker("refresh");
*/
    $("#BtLast15days").removeClass("disabled");
    $("#BtCurrentMonth").removeClass("disabled");
    $("#dateStart").val("");
    $("#dateEnd").val("");
    $("#DivRangeAlert").html("");
}

function chartAllAccountsRefresh() {
    /* We redraw completly the Chart to avoid Dates display bugs*/
    $("#DivChartAccounts").html("");
    var graphAccounts = Morris.Line({
    element: "DivChartAccounts",
    data: allAccounts,
    xkey: "y",
    ykeys: ["accounts"],
    labels: ["Total"],
    lineColors: ["#9c9c9c"],
    lineWidth: "3px",
    resize: true,
    redraw: true,
    parseTime: false
  });
}
function chartSocialMediaRefresh() {
    /* We redraw completly the Chart to avoid Dates display bugs*/
    $("#DivChartSocialNetworks").html("");
    var graphAccounts2 = Morris.Line({
    element: "DivChartSocialNetworks",
    data: socialNetworks,
    xkey: "y",
    ykeys: ["google", "facebook", "email"],
    labels: ["Google", "Facebook", "'.lg('By email').'"],
    lineColors: ["#cb4b4b","#1d4ec1", "#edc240", "#4da74d"],
    lineWidth: "3px",
    resize: true,
    redraw: true,
    parseTime: false
  });
}';    

    echo '
    </div>
    <div class="row">
        <div class="col-sm-12">

            <div style="margin:auto;max-width:1000px;padding-bottom:40px;">
                <div class="float-left py-2 px-3 mx-5 d-inline-block brd-rad-t-6" style="background-color:#e8e8e8;margin-top:3px;">'.lg('Total of registrations').'</div>
                <div class="float-right p-3 mx-5 d-inline-block brd-rad-t-6">
                   <div class="btn-group">
                       <button type="button" id="BtPeriod" class="btn btn-info rounded-0 dropdown-toggle" data-toggle="dropdown" style="min-width:250px;margin-top:-15px;">
                           <i class="fa fa-area-chart"></i><span class="p-4">15 derniers jours</span><span class="caret"></span>
                       </button>
                       <div class="dropdown-menu dropdown-menu-right p-4 border border-secondary" style="width:420px;border-radius:0px;margin-top:5px;margin-right:-2px;">
                           <div class="fnt-1-5 pb-3 rounded-lg"><i class="fa fa-area-chart pr-4"></i>'.lg('Charts Period').'</div>
                           <hr style="border-top: 1px solid #8c8b8b;">
                           <div class="container">
                           <div class="row">
                               <div class="col-sm-6"><button type="button" id="BtLast15days" class="btn btn-outline-secondary rounded-0 btn-block">'.lg('15 last days').'</button></div>
                               <div class="col-sm-6"><button type="button" id="BtCurrentMonth" class="btn btn-outline-secondary rounded-0 btn-block">'.lg('Current month').'</button></div>
                           </div>
                           </div>
                           <hr style="border-top: 1px solid #8c8b8b;">

  <select id="SelectYear" name="SelectYear" class="custom-select select-grey">
    <option value="" selected>'.lg('Select year', NULL, FALSE).'</option>';
    $currentYear = date('Y');
    while($currentYear >= $yearOldest ) {
        echo '
                                   <option value="'.$currentYear.'">'.$currentYear.'</option>';
        $currentYear--;
    }
    echo '
  </select>

                           <hr style="border-top: 1px solid #8c8b8b;">
                           <div class="input-daterange input-group mb-3">
                               <div class="input-group-prepend">
                                   <span class="input-group-text" style="width:60px;">'.lg('From').'</span>
                               </div>
                               <input type="text" class="form-control input-grey" id="dateStart">
                               <span class="input-group-text form-control" style="max-width:10%;">'.lg('to').'</span>
                               <div class="input-group-append" style="max-width:44%;">
                                   <input type="text" class="form-control input-grey" id="dateEnd">
                               </div>
                           </div>
                           <div class="clearfix"><div class="float-right pt-3"><button id="BtSendDates" class="btn btn-info btn-sm" style="margin-top:0px;">'.lg('Send', 'Global').'</button></div></div>
                           <div id="DivRangeAlert" class="pt-3 float-right" style="min-height:20px;color:#ed002a;margin-bottom:-15px;"></div>
                       </div>
                   </div>
                </div>
            </div>

            <div class="text-center" style="margin:auto;max-width:1000px;">
                <div class="rounded-lg" style="height:447;background-color:#f5f5f5;">
                    <div id="DivChartAccounts" class="d-inline-block" style="width:100%;"></div>
                </div>
            </div>

            <div class="py-5">

                <div style="margin:auto;max-width:1000px;padding-bottom:40px;">
                    <div class="pull-left py-2 px-3 mx-5 d-inline-block brd-rad-t-6" style="background-color:#e8e8e8;margin-top:3px;">'.lg('Type of registrations').'</div>
                </div>

                <div class="text-center" style="margin:auto;max-width:1000px;">
                    <div class="rounded-lg" style="height:447;background-color:#f5f5f5;">
                        <div id="DivChartSocialNetworks" class="d-inline-block" style="width:100%;"></div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
<div id="AjaxHome" class="dis-n"></div>';

    $jsWindowLoaded .= '
$(window).on("resize", function(){
    /* Fix bug on resizing Charts*/
    $("#DivChartAccounts").css("height","447");
    $("#DivChartSocialNetworks").css("height", "447");

    /* Resize Piechart */
    $("#Div_piechart").width($("#Div_content_pc").width());
    showPieChart(data);
});';
}

function get_valuesChart_allAccounts($datesDisplay, $allAccounts) {
    
    $i = 0;
    $lenght = count($datesDisplay);
    $values = '';
    foreach($datesDisplay as $oneDate) {

        $total = 0;
        foreach($allAccounts as $oneAccount) {
            if($oneAccount['date'] == $oneDate) {
                $total = $oneAccount['total'];
                break;
            }
        }
        $values .= '
            { y: "'.$oneDate.'", accounts: '.$total.' }';

        if($i != ($lenght-1)) {
            $values .= ',';
        }
        
        $i++;
        
    }
    return $values;
}

function get_valuesChart_socialNetwords($datesDisplay, $socialNetworks) {
    
    $i = 0;
    $lenght = count($datesDisplay);
    $values = '';
    foreach($datesDisplay as $oneDate) {

        $total_facebook = 0;
        $total_google = 0;
        $total_email = 0;
        foreach($socialNetworks as $oneSocialNetwork) {
            if(isset($oneSocialNetwork['day'])) {
                $oneSocialNetwork['date'] = $oneSocialNetwork['date'].'-'.$oneSocialNetwork['day'];
            }
            if($oneSocialNetwork['date'] == $oneDate) {
                $total_facebook = $oneSocialNetwork['total_facebook'];
                $total_google = $oneSocialNetwork['total_google'];
                $total_email = $oneSocialNetwork['total_email'];
                break;
            }
        }
        $values .= '
            { y: "'.$oneDate.'", google: '.$total_google.', facebook: '.$total_facebook.', email: '.$total_email.' }';

        if($i != ($lenght-1)) {
            $values .= ',';
        }
        
        $i++;
        
    }
    return $values;
}







?>
