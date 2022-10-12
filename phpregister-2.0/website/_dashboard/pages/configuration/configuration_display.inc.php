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


function show_configuration() {
    global $config, $variablesCount, $adminRightsCount, $jsScripts, $jsDocumentReady, $jsWindowLoaded;

    echo '
<div class="clearfix mt-4" style="margin:auto;max-width:1100px;">
    <div class="text-left">
        <div class="card card-outline-success bg-success text-white d-inline-block">
            <div class="card-footer fnt-1-1 p-3">
               '.lg('Environment variables').': '.$variablesCount.'<br>
               '.lg('Actual Admin rights:').' '.$adminRightsCount.'
             </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <a href="#/" onClick="showTab(\'variables\');"><div id="DivTabvariables" class="taboption ml-3 active"><i class="fa fa-puzzle-piece pr-2 fnt-1-3"></i>'.lg('Variables').'</div></a>
    <a href="#/" onClick="showTab(\'adminrights\');"><div id="DivTabadminrights" class="taboption"><i class="fa fa-sort-amount-asc pr-2 fnt-1-3"></i>'.lg('Administration rights').'</div></a>
    <a href="#/" onClick="showTab(\'phpinfo\');"><div id="DivTabphpinfo" class="taboption"><i class="fa fa-file-code-o pr-2 fnt-1-3"></i>phpinfo()</div></a>
</div>
<div id="AjaxEdit"></div>
<div class="container rounded mb-4" style="background:white;min-height:400px;">
    <div id="DivContainerTab" class="pb-2">
    </div>
</div>';

    $jsScripts .= '
function showTab(tab) {
  $("#DivContainerTab").fadeTo("fast", 0);
  $("div[id^=\'DivTab\']").removeClass("active");
  $("#DivTab" + tab).addClass("active");
  var values = {"Tab": tab};
  setTimeout(function() {
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/configuration/ajax/ajax_tab_show.php", type: "POST", data: values,
    success: function (data) {
      $("#DivContainerTab div").remove();
      $("#DivContainerTab").html("").html(data);
      $("#DivContainerTab").fadeTo(400, 1);
    },
    error: function(exception) { console.log(exception); }
  });
  }, 500);
}';

    if(!isset($_GET['tab'])) {
        $_GET['tab'] = 'variables';
    }

    $jsDocumentReady .= '
showTab("'.$_GET['tab'].'")';
}


function show_variables() {
    global $config, $variables;

    echo '
<div class="modal modal-responsive modal-mytheme fade" id="ModalVariableModify" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-puzzle-piece fa-2x pr-4 align-middle"></i>'.lg('An environment variable').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivBodyModalVariableModify">
            </div>
        </div>
    </div>
</div>
    <div class="p-4 fnt-1-1">'.lg('Default language when a variable is not translated').': <i class="fa fa-info-circle ml-2 text-info popoverData" data-content="<div style=\'line-height:50px !important;\'> Updating variable <span class=\'text-info\'>misstranslation_defaultlang</span> used in functions init_langVars() and lg() in PHP file global.inc.php</div>" rel="popover" data-placement="bottom" data-trigger="hover" style="font-size:22px;"></i></div>
    <div class="pl-4 input-group input-group-sm">
         <div class="input-group-prepend">
             <select id="SelectMissTranslateDefaultLang" name="SelectMissTranslateDefaultLang" class="custom-select select-grey">';
    $i = 0;
    foreach($config['Langs'] as $oneLang) {
        echo '
                 <option value="'.$oneLang.'"';
        if($oneLang == $config['misstranslation_defaultlang']) {
            echo ' selected ';
        } echo '>'.ucfirst($config['LangsNames'][$oneLang]).'</option>';
        $i++;
    }
    echo '
             </select>
         </div>
         <div class="input-group-append">
             <button id="BtMissTranslateDefaultLang" type="button" class="btn btn-info btn-sm" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'" style="min-width:100px;"><i class="fa fa-download fnt-1-2 pr-3"></i>'.lg('Save', 'Global').'</button>
         </div>
    </div>
    <hr class="mt-3">
    <div class="pl-4 float-left fnt-1-1">'.lg('Environment variables contained in the MySQL table <span class="border px-2 py-1">...').'</div>
    <div class="pl-4 float-right">
        <button id="BtCollapseNewVariable" class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#DivVariableAdd" aria-expanded="true" aria-controls="DivVariableAdd">
          '.lg('New variable').'
        </button>
     </div>
    <div class="clearfix"></div>
    <div id="DivVariableAdd" class="collapse pl-4 mx-auto" style="max-width:800px;">
        <form action="#" name="FormVariableNew" id="FormVariableNew"  method="post">
        <div class="text-center py-3 fnt-1-3"><strong>'.lg('Add a variable:').'</strong></div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text bg-light text-secondary" style="min-width:120px;">'.lg('Name').'</span>
            </div>
            <input name="InputName" type="text" class="form-control input-grey" required maxlength="60">
          </div>
          <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <span class="input-group-text bg-light text-secondary" style="min-width:120px;">'.lg('Value').'</span>
              </div>
              <input name="InputValue" type="text" class="form-control input-grey" required maxlength="100">
          </div>
          <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text bg-light text-secondary" style="min-width:120px;">'.lg('Description').'</span>
              </div>
              <textarea name="TextareaDescription" class="form-control input-grey" ></textarea>
          </div>
          <div class="text-center">
              <button id="BtVariableAdd" class="btn btn-info" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Add variable').'</button>
          </div>
          <div id="DivErrorVariableAdd" class="text-center fnt-0-95 text-danger" style="height:25px;"></div>
          </form>
          <hr>
    </div>
    <table class="table table-bordered dt-responsive mt-3" style="background:white;width:100%">
        <thead style="background-color:white;">
            <tr class="fnt-1-1">
                <th> </th>
                <th>'.lg('Name').'</th>
                <th>'.lg('Value').'</th>
                <th>'.lg('Description').'</th>
            </tr>
        </thead>
        <tbody>';
    foreach($variables as $oneVariable) {
        echo '
            <tr>
                <td class="text-center fnt-1-4" style="width:120px;">
                    <i class="popoverData fa fa-trash pointer text-danger" onClick="modalOpenVariable(\'delete\', '.$oneVariable['id'].')" style="font-size:18px;" data-content="'.lg('Delete this variable').'" rel="popover" data-placement="bottom" data-trigger="hover"></i> 
                    <i class="ml-2 popoverData fa fa-edit pointer text-info" onClick="modalOpenVariable(\'update\', '.$oneVariable['id'].')" style="font-size:18px;" data-content="'.lg('Edit this variable').'" rel="popover" data-placement="bottom" data-trigger="hover"></i> 
                </td>
                <td class="text-break-all" style="min-width:200px;"> '.$oneVariable['name'].'</td>
                <td class="fnt-0-95 text-break-all" style="min-width:180px;">'.$oneVariable['value'].'</td>
                <td class="fnt-0-95 text-break-all fnt-1-0"> '.nl2br(issetor($oneVariable['description'], '-')).' </td>
            </tr>';
    }
    echo '
        <tbody>
    </table>';
    /**
     * Variables $jsWindowLoaded / $jsScripts cannot be used because this PHP function is called from an ajax file and show_end() is not called.
     */;
    echo '
<script>
$(".popoverData").popover({html: true});
function getCopy() {
  var copyText = document.getElementById("TextareaGetCopy");
  copyText.select();
  document.execCommand("copy");
  $("#FaCopy").blink(2);
};
function modalOpenVariable(action, id) {
  var values = {"id": id};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/configuration/ajax/ajax_variable_" + action + "_modalopen.php", type: "POST", data: values,
    success: function(data) {
      $("#DivBodyModalVariableModify div").remove();
      $("#DivBodyModalVariableModify").html(data);
      $("#ModalVariableModify").modal("show");
    },
    error: function(exception) { console.log(exception); }
  });  
}
$("#BtMissTranslateDefaultLang").on("click", function() {
  $("#BtMissTranslateDefaultLang").btn("loading");
  NProgress.start();
  var values = {"SelectMissTranslateDefaultLang": $("#SelectMissTranslateDefaultLang option:selected" ).val()}
  $.ajax({
      url: "'.$config['AdminURL'].'/pages/configuration/ajax/ajax_misslangdefault_update.php", type: "POST", data: values,
      success: function(data) {
          $("#AjaxEdit div").remove();
          $("#AjaxEdit").html("").html(data);
          NProgress.done();
      },
      error: function(exception) { console.log(exception); }
  });
});
$("#FormVariableNew").on("submit", function (e) {
  e.preventDefault();
  $("#BtVariableAdd").btn("loading");
  $("#DivErrorVariableAdd").css({"opacity":0});
  var values = $("#FormVariableNew").serialize();
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/configuration/ajax/ajax_variable_add.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxEdit div").remove();
      $("#AjaxEdit").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});
</script>';
}

function show_adminRights() {
    global $config, $adminRights;

    echo '
<div class="modal modal-responsive modal-mytheme fade" id="ModalAdminrightModify" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-sort-amount-asc fa-2x pr-4 align-middle"></i>'.lg('An Admin right').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivBodyModalAdminrightModify">
            </div>
        </div>
    </div>
</div>
    <div class="pt-4 float-right">
        <button id="BtCollapseNewAdminright" class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#DivAdminrightAdd" aria-expanded="true" aria-controls="DivAdminrightAdd">
          '.lg('New Admin right').'
        </button>
     </div>
    <div class="clearfix"></div>
    <div id="DivAdminrightAdd" class="collapse pl-4 mx-auto" aria-labelledby="headingOne" style="max-width:800px;">
        <form action="#" name="FormAdminrightNew" id="FormAdminrightNew"  method="post">
        <div class="text-center py-3 fnt-1-3"><strong>'.lg('Add an Admin right').'</strong></div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text bg-light text-secondary" style="min-width:120px;">'.lg('Name').'</span>
            </div>
            <input name="InputName" type="text" class="form-control input-grey" required maxlength="60">
          </div>
          <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text bg-light text-secondary" style="min-width:120px;">'.lg('Description').'</span>
              </div>
              <textarea name="TextareaDescription" class="form-control input-grey" ></textarea>
          </div>
          <div class="text-center">
              <button id="BtAdminrightAdd" class="btn btn-info" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Add admin right').'</button>
          </div>
          <div id="DivErrorAdminrightAdd" class="text-center fnt-0-95 text-danger" style="height:25px;"></div>
          </form>
          <hr>
    </div>

<div class="mx-auto pt-4" style="max-width:800px;">
    <table class="table table-bordered dt-responsive mt-3" style="background:white;width:100%">
        <thead style="background-color:white;">
            <tr class="fnt-1-1">
                <th> </th>
                <th>'.lg('Name').'</th>
                <th>'.lg('Description').'</th>
            </tr>
        </thead>
        <tbody>';

    $descAdmin = '';
    foreach($adminRights as $oneAdminRight) {
        if($oneAdminRight['name'] == 'admin') {
            $descAdmin = $oneAdminRight['description'];
            break;
        }
    }
    echo '
            <tr>
                <td class="text-center fnt-1-4" style="width:120px;">
                    <i class="ml-2 popoverData fa fa-edit pointer text-info" onClick="modalOpenAdminright(\'update\', 1)" style="font-size:18px;" data-content="'.lg('Edit this Admin right').'" rel="popover" data-placement="bottom" data-trigger="hover"></i> 
                </td>
                <td class="text-break-all" style="min-width:180px;"> admin </td>
                <td class="fnt-0-95 text-break-all" style="min-width:180px;">'.nl2br($descAdmin).'</td>
            </tr>';
    foreach($adminRights as $oneAdminRight) {
        if($oneAdminRight['name'] != 'admin') {
            echo '
            <tr>
                <td class="text-center fnt-1-4" style="width:120px;">
                    <i class="popoverData fa fa-trash pointer text-danger" onClick="modalOpenAdminright(\'delete\', '.$oneAdminRight['id'].')" style="font-size:18px;" data-content="'.lg('Delete this Admin right').'" rel="popover" data-placement="bottom" data-trigger="hover"></i>
                    <i class="ml-2 popoverData fa fa-edit pointer text-info" onClick="modalOpenAdminright(\'update\', '.$oneAdminRight['id'].')" style="font-size:18px;" data-content="'.lg('Edit this Admin right').'" rel="popover" data-placement="bottom" data-trigger="hover"></i> 
                </td>
                <td class="text-break-all" style="min-width:180px;"> '.$oneAdminRight['name'].' </td>
                <td class="fnt-0-95 text-break-all" style="min-width:180px;">'.$oneAdminRight['description'].'</td>
            </tr>';
        }
    }
    echo '
        </tbody>
    </table>
</div>
<script>
$(".popoverData").popover({html: true});
function modalOpenAdminright(action, id) {
  var values = {"id": id};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/configuration/ajax/ajax_adminright_" + action + "_modalopen.php", type: "POST", data: values,
    success: function(data) {
      $("#DivBodyModalAdminrightModify div").remove();
      $("#DivBodyModalAdminrightModify").html(data);
      $("#ModalAdminrightModify").modal("show");
    },
    error: function(exception) { console.log(exception); }
  });  
}
$("#FormAdminrightNew").on("submit", function (e) {
  e.preventDefault();
  $("#BtAdminrightAdd").btn("loading");
  $("#DivErrorAdminrightAdd").css({"opacity":0});
  var values = $("#FormAdminrightNew").serialize();
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/configuration/ajax/ajax_adminright_add.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxEdit div").remove();
      $("#AjaxEdit").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});
</script>';

}

function show_phpinfo() {
    ob_start();
    phpinfo();
    $phpinfo = ob_get_contents();
    ob_end_clean();
    $phpinfo = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $phpinfo);
    echo '
        <style type="text/css">
            #phpinfo {}
            #phpinfo pre {margin: 0; font-family: monospace;}
            #phpinfo a:link {color: #009; text-decoration: none; background-color: #fff;}
            #phpinfo a:hover {text-decoration: underline;}
            #phpinfo table {border-collapse: collapse; border: 0; width: 934px; box-shadow: 1px 2px 3px #ccc;}
            #phpinfo .center {text-align: center;}
            #phpinfo .center table {margin: 1em auto; text-align: left;}
            #phpinfo .center th {text-align: center !important;}
            #phpinfo td, th {border: 1px solid #666; font-size: 110%; vertical-align: baseline; padding: 4px 5px;}
            #phpinfo h1 {font-size: 140%;}
            #phpinfo h2 {font-size: 120%;}
            #phpinfo .p {text-align: left;}
            #phpinfo .e {background-color: #ccf; width: 300px; font-weight: bold;}
            #phpinfo .h {background-color: #99c; font-weight: bold;}
            #phpinfo .v {background-color: #ddd; max-width: 300px; overflow-x: auto; word-wrap: break-word;}
            #phpinfo .v i {color: #999;}
            #phpinfo img {float: right; border: 0;}
            #phpinfo hr {width: 934px; background-color: #ccc; border: 0; height: 1px;}
        </style>
        <div id="phpinfo" class="py-4">
            '.$phpinfo.'
        </div>';
}

?>
