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


function show_translations() {
    global $config, $jsScripts, $jsWindowLoaded, $variablesCount, $numTravelerCoutries, $numFamilyCoutries, $translationsPages, $translations;

    $jsScripts .= '
var prefsOpened = false;
function showTranslateConfig() {
  if(NProgress.isStarted()) return;
  NProgress.start();
  if(prefsOpened == 0) {
    contentPage = $("#DivTranslationsPage").html();
    $.ajax({
      url: "'.$config['AdminURL'].'/pages/translations/ajax/ajax_translations_config_show.php",
      type: "POST",
      success: function(data) {
          $("#DivTranslations").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });
    prefsOpened = true;
  } else {
     $("#DivTranslationsPage").attr("style", "opacity:0;");
    $("#DivTranslationsPage").removeClass("dis-n");
    $("#DivTranslations").removeClass("dis-n").addClass("dis-n");
    setTimeout(function () {$("#DivTranslationsPage").fadeTo("fast", 1);NProgress.done();}, 500);
    prefsOpened = false;
  }
}';

    if(isset($_GET['variableId'])) {
        $jsScripts .= '
modalVariableEditOpen(\'edit\', '.$_GET['variableId'].');
setTimeout(function() { scrollToElemMiddle($("#DivVariable'.$_GET['variableId'].'")); }, 1000);';
    }
    $jsWindowLoaded .= '
$("#SelectPage").on("change", function() {
  if($("#SelectPage").val() != "") {
    window.location = "'.$config['AdminURL'].'/pages/translations/?page=" + $("#SelectPage").val();
  } else {
    window.location = "'.$config['AdminURL'].'/pages/translations/";
  }
});

$("#FormSearch").submit(function(e) {
  e.preventDefault();
  window.location = "'.$config['AdminURL'].'/pages/translations/?search=" + $("#InputSearch").val();
});';

    $jsWindowLoaded .= '
$("#BtCollapseNewVariable").on("click", function() {
  if($("#InputVariablePage").val() == "" && $("#SelectPage").val() != "All") {
    $("#InputVariablePage").val($("#SelectPage").val());
  }
});
$(".popoverData").popover({html: true});';

    echo '
<div id="AjaxUpdateVariable" class=""></div>
<div id="DivTranslationsPage">
    <div class="clearfix pad-b-40 p-4" style="margin:auto;max-width:1100px;">
        <div class="text-left">
            <div class="card bg-success text-white d-inline-block">
                <div class="card-body fnt-1-0" style="padding:10px !important;">
                     <p class="card-text">Number of translation variables: <strong>'.$variablesCount.'</strong></p>
                 </div>
            </div>
        </div>
    </div>

    <div class="container text-center rounded-lg" style="background:white;min-height:400px;">
        <div class="float-left pt-3">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light text-secondary">Page</span>
                </div>
                <select id="SelectPage" name="SelectVariableLength" class="custom-select select-grey">
                    <option value="All"';
    if($_GET['page'] == '') echo ' selected '; 
    echo '>All</option>';
    foreach($translationsPages as $onePage) {
        echo '<option value="'.$onePage['page'].'" ';
    if($_GET['page'] == $onePage['page']) echo ' selected '; 
    echo '>'.$onePage['page'].'</option>';
    }
    echo '
                </select>
            </div>
        </div>
        <div class="float-left pt-3 ml-4">
            <form action="#" name="FormSearch" id="FormSearch"  method="post">
            <div class="input-group input-group-sm">
                <input type="text" id="InputSearch" name="InputSearch" class="form-control input-grey" value="'.issetor($_GET['search']).'" placeholder="Search by id or name" size="30">
                <div class="input-group-append">
                    <button class="btn btn-info" id="BtSearh"><i class="fa fa-search"></i></button>
                </div>
            </div>
            </form>
        </div>
        <div class="pl-4 pt-3 float-right">
            <button id="BtCollapseNewVariable" class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#DivVariableAdd" aria-expanded="true" aria-controls="DivVariableAdd">
                '.lg('Add variable').'
            </button>
        </div>
        <div class="clearfix"></div>
        <div id="DivVariableAdd" class="collapse pl-4 mx-auto" style="max-width:800px;">
            <form action="#/" id="FormVariableAdd"  name="FormVariableAdd" method="post">
            <div class="text-center py-3 fnt-1-3"><strong>'.lg('Add a variable:').'</strong></div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light text-secondary" style="min-width:120px;">Page</span>
                </div>
                <input id="InputVariablePage" name="InputVariablePage" type="text" class="form-control input-grey" required maxlength="60">
              </div>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-light text-secondary" style="min-width:120px;">Name</span>
                  </div>
                  <input name="InputVariableName" type="text" class="form-control input-grey" required maxlength="87">
              </div>
              <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light text-secondary" style="min-width:120px;">Size</span>
                  </div>
                  <select id="SelectVariableLength" name="SelectVariableLength" class="custom-select select-grey">
                       <option value="small">Small</option>
                       <option value="medium">Medium</option>
                       <option value="large">Large</option>
                  </select>
              </div>
              <div class="text-center">
                  <button id="BtVariableAdd" class="btn btn-info" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Add variable').'</button>
              </div>
              <div id="DivErrorVariableAdd" class="text-center fnt-0-95 text-danger" style="height:25px;"></div>
              </form>
              <hr>
        </div>
        <div class="mt-5 text-left pb-1 mb-4" style="min-height:100px;">';
    if(empty($translations)) {
        echo '<div class="p-5 text-center fnt-1-2">No variable found!</div>';
    }

    foreach($translations as $oneTranslation) {
        $showVariableFromPage = 'lg(\''.str_replace("'", "\'", $oneTranslation['name']).'\')';
        $showVariableOtherage = 'lg(\''.str_replace("'", "\'", $oneTranslation['name']).'\', \''.$oneTranslation['page'].'\')';
        $unixCommandSearch = 'grep -rn "lg(\''.str_replace('"', '\"', str_replace("'", "\\\\\'", $oneTranslation['name'])).'\'"';
        echo '
<div id="DivVariable'.$oneTranslation['id'].'">
<div style="position: absolute;top:-10000px;">
    <textarea id="GetCopyFromPage'.$oneTranslation['id'].'">'.$showVariableFromPage.'</textarea>
    <textarea id="GetCopyOtherPage'.$oneTranslation['id'].'">'.$showVariableOtherage.'</textarea>
    <textarea id="GetCopyUnixSearch'.$oneTranslation['id'].'">'.$unixCommandSearch.'</textarea>
</div>
<div class="d-inline-block p-2 ml-2 brd-rad-t-6 border border-bottom-0"><b>Id:</b> '.$oneTranslation['id'].'</div>
<div class="d-inline-block p-2 ml-2 brd-rad-t-6 border border-bottom-0">
    <b>'.lg('Page').':</b> <span id="SpanPage'.$oneTranslation['id'].'">'.$oneTranslation['page'].'</span>
    <i class="popoverData fa fa-edit pointer fnt-1-3 ml-1" data-content="'.lg('Change page').'" rel="popover" data-placement="bottom" data-trigger="hover" onClick="modalVariableEditOpen(\'page\', '.$oneTranslation['id'].');"></i>
</div>
<div class="d-inline-block p-2 ml-2 brd-rad-t-6 border border-bottom-0">
    <b>'.lg('Variable').':</b> <span id="SpanName'.$oneTranslation['id'].'">'.htmlentities($oneTranslation['name']).'</span>
    <i class="popoverData fa fa-edit pointer fnt-1-3 ml-1" data-content="'.lg('Change variable name').'" rel="popover" data-placement="bottom" data-trigger="hover" onClick="modalVariableEditOpen(\'name\', '.$oneTranslation['id'].');"></i>
</div>
<div class="d-inline-block p-2 ml-2 brd-rad-t-6 border border-bottom-0">
    <b>'.lg('Copy').':</b>';
        $textCopy = lg('Copy to clipboard the PHP code of the lg function used in another page');
        if($oneTranslation['page'] != 'Global') {
            echo '
    <i class="popoverData fa fa-clipboard pointer fnt-1-3 ml-1" data-content="'.lg('Copy to clipboard the PHP code of the lg function used in the page').' '.$oneTranslation['page'].':<br><br>'.str_replace('"', '&quot;', htmlspecialchars(htmlentities($showVariableFromPage))).'" rel="popover" data-placement="bottom" data-trigger="hover"
       id="IconCopyFromPage'.$oneTranslation['id'].'" onClick="copyToClipboard(\'GetCopyFromPage'.$oneTranslation['id'].'\', \'IconCopyFromPage'.$oneTranslation['id'].'\')"></i>';
        } else {
            $textCopy = lg('Copy to clipboard the PHP code of the lg function of this Global variable');
        }
        echo '
    <i class="popoverData fa fa-columns pointer ml-1 fnt-1-3" data-content="'.$textCopy.':<br><br>'.str_replace('"', '&quot;', htmlspecialchars(htmlentities($showVariableOtherage))).'" rel="popover" data-placement="bottom" data-trigger="hover"
       id="IconCopyOtherPage'.$oneTranslation['id'].'" onClick="copyToClipboard(\'GetCopyOtherPage'.$oneTranslation['id'].'\', \'IconCopyOtherPage'.$oneTranslation['id'].'\')"></i>
    <i class="popoverData fa fa-search pointer ml-1 fnt-1-3" data-content="'.lg('Copy to clipboard the Unix command to search this variable in the code').':<br><br>'.str_replace('"', '&quot;', htmlspecialchars(htmlentities($unixCommandSearch))).'" rel="popover" data-placement="bottom" data-trigger="hover"
       id="IconCopyUnixSearch'.$oneTranslation['id'].'" onClick="copyToClipboard(\'GetCopyUnixSearch'.$oneTranslation['id'].'\', \'IconCopyUnixSearch'.$oneTranslation['id'].'\')"></i>
</div>
<div class="float-right pt-1 pl-2 mt-1">
    <i class="popoverData fa fa-trash pointer text-danger fnt-1-2" onClick="modalVariableEditOpen(\'delete\', '.$oneTranslation['id'].')" data-content="'.lg('Delete this variable').'" rel="popover" data-placement="bottom" data-trigger="hover"></i> </div>
<div class="float-right mt-1">
    <div class="d-inline-block">
        <select id="SelectVariableLength'.$oneTranslation['id'].'" onChange="selectVariableLengthUpdate('.$oneTranslation['id'].');" class="custom-select custom-select-sm select-grey">        
            <option value="small"';
        if($oneTranslation['length'] == 'small') echo ' selected ';
        echo '>Small</option>
            <option value="medium"';
        if($oneTranslation['length'] == 'medium') echo ' selected ';
        echo '>Medium</option>
            <option value="large"';
        if($oneTranslation['length'] == 'large') echo ' selected ';
        echo '>Large</option>
        </select>
    </div>
    <div class="d-inline-block mr-2" style="margin-top:-0px;">
        <button class="btn btn-outline-info btn-sm" onClick="modalVariableEditOpen(\'edit\', '.$oneTranslation['id'].');">'.lg('Translate').'</button>
    </div>
</div>
<div id="DivVariableValues'.$oneTranslation['id'].'" class="rounded-lg border border-secondary text-left mb-5" style="min-height:60px;">'.html_oneVariable($oneTranslation).'</div>
</div>';
    }
    
    echo '
        </div>
    </div>
</div>
<div id="DivTranslations" class="dis-n"></div>';
    $jsScripts .= '
function selectVariableLengthUpdate(id) {
  var values = {"id": id, "length": $("#SelectVariableLength"+id).val()};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/translations/ajax/ajax_variablelength_update.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxUpdateVariable div").remove();
      $("#AjaxUpdateVariable").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}

function modalVariableEditOpen(action, id) {
  var values = {"id": id};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/translations/ajax/ajax_variable" + action + "_modalopen.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxUpdateVariable div").remove();
      $("#AjaxUpdateVariable").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}';

    $jsWindowLoaded .= '
$("#FormVariableAdd").on("submit", function (e) {
  e.preventDefault();
  $("#BtVariableAdd").btn("loading");
  var values = $("form#FormVariableAdd").serialize();
  $.ajax({
      url: "'.$config['AdminURL'].'/pages/translations/ajax/ajax_variable_insert.php", type: "POST", data: values,
      success: function(data) {
          $("#AjaxUpdateVariable div").remove();
          $("#AjaxUpdateVariable").html("").html(data);
      },
      error: function(exception) { console.log(exception); }
  });
});';

    echo '
<div class="modal modal-responsive modal-mytheme fade" id="ModalVariableEdit" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-file-code-o fa-2x pr-4 align-middle"></i>Editer variable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivBodyModalVariableEdit">
            </div>
        </div>
    </div>
</div>

<div class="modal modal-responsive modal-mytheme fade" id="ModalVariableDelete" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title"><i class="fa fa-file-code-o fa-2x pr-4 align-middle"></i>Ajouter variable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>';
}


function html_oneVariable($oneTranslation) {    
    global $config;

    $html = '';

    foreach($config['Langs'] as $oneLang) {

        $html .= '
<div class="border border-light-2 p-2 m-2 bg-white d-inline-block" style="width:350px;">
   <strong class="pr-2">'.strtoupper($oneLang).'</strong>';
        if($oneTranslation[$oneLang] == NULL || $oneTranslation[$oneLang] == '')  {
            $html .= '<div class="border-bottom border-danger" style="width:40px;"></div>';
        } else {
            $html .= substr(htmlentities($oneTranslation[$oneLang]), 0, 90);
        }
        $html .= '
</div>';
        
    }

    return $html;
}

?>
