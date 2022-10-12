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

function show_accounts() {
    global $config, $dataBase, $user, $userPrefsOrder, $jsWindowLoaded, $jsScripts, $jsWindowResize, $searchCount;

    if(!isset($_POST['search'])) {
        $_POST['search'] = NULL;
    }
    
    $sql = $dataBase->prepare('SELECT COUNT(id) AS total
                               FROM pr__user'); 
    $sql->execute();
    $users = $sql->fetch();
    $sql->closeCursor();    
  
    /**
     *  Display Table users infos
     */
    if(isset($_POST['search'])) {
        $jsScripts .= '
NProgress.start();';
    }
    
    $jsScripts .= '
var prefsOpened = false;
function showAccountsConfig() {
  if(NProgress.isStarted()) return;
  NProgress.start();
  if(prefsOpened == false) {
    contentPage = $("#DivAccountsPage").html();
    $.ajax({
      url: "'.$config['AdminURL'].'/pages/accounts/ajax/ajax_accounts_prefs_show.php",
      type: "POST",
      success: function(data) {
          $("#AjaxAccounts").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });
    prefsOpened = true;
  } else {
     $("#DivAccountsPage").attr("style", "opacity:0;");
     $("#DivAccountsPage").removeClass("dis-n");
     $("#AjaxAccounts").removeClass("dis-n").addClass("dis-n");
     setTimeout(function () {$("#DivAccountsPage").fadeTo("fast", 1);NProgress.done();}, 500);
     prefsOpened = false;
  }
}

var accounts = Array();
emails = Array();
names = Array();
function showModalDetails(uid, action) {
  NProgress.start();
  var values = {"uid":  uid, "do": action};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/accounts/ajax/ajax_accountdetails_modalopen.php", type: "POST", data: values,
    success: function(data) {
      $("#DivModalBodyAccountDetails").empty().html(data);
      $("#ModalDetails").modal("show");
      NProgress.done();
    }
  });
}

function showModalEmail(uid) {
  if(emails[uid] == "") {
   alert("'.lg('Media social account with no email specified').'");
   return;
  }
  $("#InputName").val(names[uid]);
  $("#InputEmail").val(emails[uid]);
  $("#DivEmailPreview").removeClass("dis-n").addClass("dis-n");
  $("#DivEmailSent").removeClass("dis-n").addClass("dis-n");
  $("#DivEmailForm").removeClass("dis-n");
  $("#DivPrevReplyTo").removeClass("dis-n").addClass("dis-n");
  $("#DivPrevBcc").removeClass("dis-n").addClass("dis-n");
  $("#BtEmailSend").prop("disabled", false);
  $("#BtEmailSend").css("cursor", "pointer");
  $("#BtEmailPreview").prop("disabled", false);
  $("#BtEmailPreview").css("cursor", "pointer");
  $("#uid").val(uid);
  $("#SpanMailTo").html(names[uid] + " &lt;" + emails[uid] + "&gt;");
  $("#ModalEmail").modal("show");
}';
    
    $jsWindowLoaded .= '
$("#BtEmailSend").on("click", function() {
  NProgress.start();
  $("#BtEmailSend").btn("loading");
  $("#TextareaBody").val(CKEDITOR.instances["TextareaBody"].getData());
  var values = $("form#FormEmail").serialize();
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/accounts/ajax/ajax_accounts_emailsend.php",
    type: "POST",
    data: values,
    success: function(data) {
      $("#DivEmailSent").html(data);
    }
  });
});

$("#BtEmailPreview").on("click", function() {
  $("#BtEmailPreview").prop("disabled", true);
  $("#BtEmailPreview").css("cursor", "auto");
  $("#DivEmailPreview").css("opacity", "0");
  $("#DivEmailPreview").removeClass("dis-n");
  $("#DivEmailForm").removeClass("dis-n").addClass("dis-n");
  $("#SpanPrevFrom").html($("#InputFrom").val());
  $("#SpanPrevSubject").html($("#InputSubject").val());
  if($("#InputReplyTo").val() != "") {
      $("#SpanPrevReplyTo").html($("#InputReplyTo").val());
      $("#DivPrevReplyTo").removeClass("dis-n");
  }
  if($("#InputBcc").val() != "") {
      $("#SpanPrevBcc").html($("#InputBcc").val());
      $("#DivPrevBcc").removeClass("dis-n");
  }
  $("#DivPrevBody").html(CKEDITOR.instances["TextareaBody"].getData());
  setTimeout(function() {
     $("#DivEmailPreview").fadeTo("fast", 1);
    }, 1000);
});
$("#BtEmailEdit").on("click", function() {
  $("#BtEmailPreview").prop("disabled", false);
  $("#BtEmailPreview").css("cursor", "pointer");
  $("#DivEmailPreview").removeClass("dis-n").addClass("dis-n");
  $("#DivEmailForm").removeClass("dis-n");
  $("#DivEmailForm").css("opacity", "0");
  setTimeout(function() {
     $("#DivEmailForm").fadeTo("fast", 1);
  }, 1000);
});';
    
    $jsWindowLoaded .= '
$("#FormAccountsSearch").submit(function( event ) {
  $("#BtSearh").btn("loading");
  searchLaunch(0);
  event.preventDefault();
})
searchLaunch(0);';

    $jsScripts .= '
currentPage = 0;
function searchLaunch(page) {
  currentPage = page;
  NProgress.start();
  var values = {"search":  $("#search").val(), 
                "account_type": $("#SelectAccountType").val(), 
                "page": page,
                "InputOrder": $("#InputOrder").val()};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/accounts/ajax/ajax_accounts_search.php",
    type: "POST",
    data: values,
    success: function(data) {
      setTimeout(function () {
        $("#TableAccounts").remove();
        $("#DivAccounts").html(data);
        $("#TableAccounts").DataTable( {
            "bInfo" : false,
            "paging": false,
            "ordering": false,
            "searching": false
        });
        $("#BtSearh").btn("reset");
        NProgress.done();
        }, 500);
    }
  });
}

function changeOrder(NewOrder) {
  $("#InputOrder").val(NewOrder);
  searchLaunch(currentPage);
  $("#Span_date_accountcreated").removeClass("underline-mytheme");
  $("#Span_lastsession_date").removeClass("underline-mytheme");
  $("#Span_" + NewOrder).addClass("underline-mytheme");
}';

    $jsWindowLoaded .= '
$(".selectpicker").on("change", function() {
  $(".btn").blur();
});';

    echo '
<div id="DivAccountsPage">
    <div class="p-4 mx-auto" style="max-width:1100px;">
        <div class="card card-outline-success bg-success text-white d-inline-block">
            <div class="card-footer fnt-1-1 p-3">'.lg('Total number of accounts:').' <strong>'.number_format($users['total'], 0, '.', ' ').'</strong></div>
        </div>
    </div>
    <div class="p-2 p-sm-4 mx-auto" style="max-width:1100px;">
        <div id="DivSearch" class="float-right" style="width:600px;margin-bottom:-20px;">
        <form action="#" id="FormAccountsSearch"  name="FormAccountsSearch" method="post">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control input-grey rounded-left" value="'.$_POST['search'].'" placeholder="'.lg('Search...by lastname, firstname, email, User Id', NULL, FALSE).'">
                <input type="hidden" id="InputOrder" name="InputOrder" value="'.$userPrefsOrder.'">
                <div class="input-group-append">
                    <button class="btn btn-info" id="BtSearh" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg\'></i>"><i class="fa fa-search" style="padding-left:6px;"></i></button>
                </div>
            </div>
        </form>
        </div>
         <div class="clearfix"></div>
        <div id="DivAccounts" style="width:100%;">
            <table id="TableAccounts" class="table dt-responsive" style="width:1100px;">
                <thead style="background-color:white;">
                    <tr>
                        <th>'.lg('Firstname', 'Global').'</th>
                        <th>'.lg('Lastname', 'Global').'</th>
                        <th>'.lg('Email', 'Global').'</th>
                        <th>'.lg('Language').'</th>
                        <th>Creation</th>
                        <th>Session</th>
                        <th>'.lg('Registration Type').'</th>
                        <th data-priority="1"></th>
                    </tr>
                 </thead>
                 <tbody>
                 <tr>
                     <td class="mt-5" colspan="9" style="text-align:center;">
                         <i class="fa fa-spinner fa-spin fa-lg fa-4x" style="opacity:.8;padding:100px;"></i>
                     </td>
                 </tr> 
                 </tbody>
             </table>
        </div>
    </div>
</div>
<div id="AjaxAccounts" class="dis-n"></div>

<div class="modal fade modal-mytheme" id="ModalEmail" role="dialog">
    <div class="modal-dialog modal-lg">
    
        <!-- Modal content-->
        <div class="modal-content" style="margin:0px;padding:0px;">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-envelope-open-o fa-2x pr-4 align-middle"></i>'.lg('Send email to').' <span id="SpanMailTo" class="ml-3 label p-3 label-success"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-4">
                <div id="DivEmailSent" class="dis-n" style="border:2px solid #949494; height:374px;overflow-y:scroll;overflow-x:hidden;"></div>
                <div id="DivEmailPreview" class="pl-4 pr-4 pt-2 dis-n" style="border:2px solid #949494; height:374px;overflow-y:scroll;overflow-x:hidden;">
                    <div class="clearfix">
                        <div class="pull-left">
                            <div class="p-3"><span class="border border-secondary bg-light fnt-0-9 p-2">'.lg('From').': <span id="SpanPrevFrom"></span></span></div>
                            <div id="DivPrevReplyTo" class="dis-n p-3"><span class="border border-secondary bg-light fnt-0-9 p-2">'.lg('Reply to').': <span id="SpanPrevReplyTo"></span></span></div>
                            <div id="DivPrevBcc" class="dis-n p-3"><span class="border border-secondary bg-light fnt-0-9 p-2">'.lg('Blind copy to').': <span id="SpanPrevBcc"></span></span></div>
                            <div class="p-3"><strong>'.lg('Subject').'</strong> <span id="SpanPrevSubject"></span></div>
                        </div>
                        <div class="pull-right">
                            <button type="button" id="BtEmailEdit" class="btn btn-default"><i class="fa fa-pencil-square-o mr-3"></i>'.lg('Modify', 'Global').'</button>
                        </div>
                    </div>
                    <div id="DivPrevBody" class="pt-4"></div>
                </div>
                <div id="DivEmailForm" class="pl-4 pr-4 pt-2">
                    <form action="#" name="FormEmail" id="FormEmail"  method="post">
                    <input type="hidden" name="InputName" id="InputName" value="">
                    <input type="hidden" name="InputEmail" id="InputEmail" value="">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">'.lg('Subject').'</span>
                        </div>
                        <input name="InputSubject" id="InputSubject" class="form-control" data-minlength="2" type="text" value="">
                    </div>
                    <div class="row pt-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">'.lg('From').'</span>
                                    </div>
                                    <input name="InputFrom" id="InputFrom" class="form-control" data-minlength="2" type="text" value="'.$config['EmailContact'].'">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">'.lg('Reply to').'</span>
                                    </div>
                                    <input name="InputReplyTo" id="InputReplyTo" class="form-control" data-minlength="2" type="text" placeholder="'.$config['EmailContact'].'" value="">
                                    <div class="input-group-append">
                                        <button class="btn btn-info form-control" data-toggle="dropdown"><i class="fa fa-plus"></i></button>
                                        <div class="dropdown-menu dropdown-menu-right" role="menu" style="width:500px;">
                                            <div class="input-group p-3" style="width:500px">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">'.lg('Blind copy to').'</span>
                                                </div>
                                                <input name="InputBcc" id="InputBcc" class="form-control" data-minlength="2" style="width:200px" type="text" value="">
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-4">
                        <textarea name="TextareaBody" id="TextareaBody"></textarea>';
    if($config['UserLang'] == 'fr') {
        $summerNoteLang = 'fr-FR';
    } else {
        $summerNoteLang = 'us-EN';
    }
    
    $jsWindowLoaded .= '

CKEDITOR.replace("TextareaBody", {
   language : "'.$summerNoteLang.'",
   toolbar : [
		{ name: "styles", items: [ "Styles", "Format", "Font", "FontSize" ] },
		{ name: "basicstyles", items: [ "Bold", "Italic", "Underline", "Strike" ] },
		{ name: "paragraph", items: [ "NumberedList", "BulletedList", "-", "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock"] },
		{ name: "tools", items: [ "Maximize"] },
   ],
   uiColor : "#dddddd",
   height : "300px"
});';

    echo '          
                    </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="modal-footer" style="margin-top:0px;">
                <div class="w-100">
                <div class="float-left">
                    <button type="button" id="BtEmailPreview" class="btn btn-warning mr-4 rounded-0 float-left" style="margin-left:23px"><i class="fa fa-eye pr-3"></i>'.lg('Preview').'</button>
                    <button type="submit" id="BtEmailSend" class="btn btn-success rounded-0" style="margin-top:0px;" data-loading-text="<i class=\'fa fa-spinner fa-lg mr-2\'></i>'.lg('Sending', 'Global').'"> <i class="fa fa-paper-plane pr-3"></i> '.lg('Send', 'Global').'</button>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">'.lg('Close', 'Global').'</button>
                </div>
                </div>
            </div>
        </div>
     
    </div>
</div>


<div class="modal fade modal-mytheme" id="ModalDetails" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 900px!important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user-circle fa-2x pr-4 align-middle"></i>'.lg('Detailed account information').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivModalBodyAccountDetails"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">'.lg('Close', 'Global').'</button>
            </div>
        </div>
    </div>
</div>

<div id="AjaxDetails" class="dis-n"></div>';

    $jsScripts .= '
function mouseOverTR(id, classTR) {
    $("#TrUser" + id).removeClass(classTR).addClass("tr-over");
}
function mouseOutTR(id, classTR) {
    $("#TrUser" + id).removeClass("tr-over").addClass(classTR);
}';
    
}

function show_accountsTable($accountsSearch) {
    global $searchCount, $config;

    $html = '
   <div class="">&nbsp;</div>';
    
    $cssDateAccountCreated = 'underline-mytheme';
    $cssDateLastSession = '';
    if($_POST['InputOrder'] == 'lastsession_date') {
        $cssDateAccountCreated = '';
        $cssDateLastSession = 'underline-mytheme';
    }

    $html .= '
<table id="TableAccounts" class="table table-striped table-bordered dt-responsive" style="background:white;width:100%;">
       <thead style="background-color:white;">
          <tr>
              <th>'.lg('Firstname', 'Global').'</th>
              <th>'.lg('Lastname', 'Global').'</th>
              <th>'.lg('Email', 'Global').'</th>
              <th>'.lg('Language').'</th>
              <th class="pointer" onClick="changeOrder(\'date_accountcreated\');"><span id="Span_date_accountcreated" class="'.$cssDateAccountCreated.'">'.lg('Creation').' <i class="fa fa-angle-down"></i></span></th>
              <th class="pointer" onClick="changeOrder(\'lastsession_date\');"><span id="Span_lastsession_date" class="'.$cssDateLastSession.'">'.lg('Session').' <i class="fa fa-angle-down"></i></span></th>
              <th>'.lg('Registration Type').'</th>
              <th data-priority="1"></th>
          </tr>
       </thead>
        <tbody>';
    $i = 1;
    foreach($accountsSearch as $oneAccount) {
        if(!isset($oneAccount['email'])) {
            /** 
               Some Facebook accounts does not have emails (created with mobile phones) and then create accounts with no emails 
             */
            $oneAccount['email'] = lg('Email not specified');
        }
        $social = '';
        $separator = '';
        
        if ($i % 2 == 1) {
            $classBG = 'tr-odd';
        } else {
            $classBG = 'tr-even';
        }
        $cssBorderLeft = 'border-left:4px solid transparent !important;';
        $html .= '
           <tr id="TrUser'.$oneAccount['id'].'" class="'.$classBG.'" onMouseOver="mouseOverTR('.$oneAccount['id'].', \''.$classBG.'\');" onMouseOut="mouseOutTR('.$oneAccount['id'].', \''.$classBG.'\');">
               <td class="pointer align-middle" onClick="showModalDetails('.$oneAccount['id'].');">'.$oneAccount['firstname'].'</td>

               <td class="pointer" style="height:20px;padding:7px 4px;" onClick="showModalDetails('.$oneAccount['id'].');">'.$oneAccount['lastname'].'</td>
               <td class="pointer" style="height:20px;padding:7px 4px;" onClick="showModalEmail('.$oneAccount['id'].');">'.$oneAccount['email'].'</td>
               <td class="text-center" style="height:20px;padding:7px 4px;" class="pointer align-middle" onClick="showModalDetails('.$oneAccount['id'].');">'.$oneAccount['lang'].'</td>
               <td style="height:20px;padding:7px 4px;" class="pointer align-middle" text-nowrap onClick="showModalDetails('.$oneAccount['id'].');">'.date("d-m-Y", strtotime($oneAccount['date_accountcreated'])).'</td>
               <td style="height:20px;padding:7px 4px;" class="pointer align-middle" text-nowrap onClick="showModalDetails('.$oneAccount['id'].');">'.date("d-m-Y", strtotime($oneAccount['lastsession_date'])).'</td>
               <td style="height:20px;padding:7px 4px;" class="pointer align-middle" onClick="showModalDetails('.$oneAccount['id'].');">';
        
        if( $oneAccount['password'] != NULL ) {
            $social .= 'E-mail';
            if(($oneAccount['activation_key'] != NULL)) {
                $social .= ' ('.lg('Not activated').')';
            }
            $separator = ', ';
        }
        
        if($oneAccount['google_id']) {
            $social .= $separator.'Google';
            $separator = ', ';
        }
        
        if($oneAccount['facebook_id']) {
            $social .= $separator.'Facebook';
            $separator = ', ';
        }
        
        $html .= $social.'</td>
               <td class="text-center" style="height:20px;padding:7px 4px;">
<div class="btn-group">
    <button type="button" class="btn btn-info btn-sm rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sort-desc"></i></button>
    <div class="dropdown-menu dropdown-menu-right fnt-1-0">
        <a class="dropdown-item" href="#/" style="color:#337ab7" onClick="showModalDetails('.$oneAccount['id'].')"><i class="fa fa-user-plus pr-3" style="font-size:24px;"></i>'.lg('Detailed information').'</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#/" style="color:#337ab7" onClick="showModalEmail('.$oneAccount['id'].')"><i class="fa fa-paper-plane pr-3" style="font-size:24px;"></i>'.lg('Send email').'</a>
        <div class="dropdown-divider"></div>';
        if(check_adminRights('accounts-delete')) {
            $html .= '
        <a class="dropdown-item" href="#/" style="color:red;" onClick="showModalDetails('.$oneAccount['id'].', \'delete\')"><i class="fa fa-remove pr-3" style="font-size:24px;"></i>'.lg('Delete account').'</a>
        <div class="dropdown-divider"></div>';
        }
        if(check_adminRights('admin')) {
            $html .= '
        <a class="dropdown-item" href="#/" onClick="showModalDetails('.$oneAccount['id'].', \'rights\')"><i class="fa fa-connectdevelop  pr-3" style="font-size:24px;"></i>'.lg('Edit Admin Rights').'</a>';
        }
        $html .= '
    </div>
</div>';
        echo '

               </td>
            </tr>';
        $i++;
    }
    $html .= '
        </tbody>
    </table>';
    
    return $html;
}


?>
