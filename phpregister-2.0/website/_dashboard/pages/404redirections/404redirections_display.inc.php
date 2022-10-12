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


function show_redirections() {
    global $config, $redirections, $jsScripts, $jsDocumentReady, $jsWindowLoaded;

    $jsDocumentReady .= '
$(".popoverData").popover({html: true});';

    $jsWindowLoaded .= '
$("#FormRedirectionNew").on("submit", function (e) {
  e.preventDefault();
  $("#BtRedirectionAdd").btn("loading");
  $("#DivErrorRedirectionAdd").css({"opacity":0});
  var values = $("#FormRedirectionNew").serialize();
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/404redirections/ajax/ajax_redirection_add.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxEdit div").remove();
      $("#AjaxEdit").html("").html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});

$("#BtCollapseNewRedirection").on("click", function() {
  setTimeout(function() {
    $("#InputSrc").focus();
  }, 1000);
});';

    echo '
<div class="container" style="min-height:400px;max-width:1100px;">
    <div class="p-4 mx-auto" style="max-width:1100px;">
        <div class="card card-outline-success bg-success text-white d-inline-block">
            <div class="card-footer fnt-1-1 p-3">'.lg('Number of 404 redirections').': <b>'.count($redirections).'</b></div>
        </div>
    </div>
    <div class="bg-white rounded-lg p-3 p-sm-4">
        <div class="float-right">
            <button id="BtCollapseNewRedirection" class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#DivRedirectionAdd" aria-expanded="true" aria-controls="DivRedirectionAdd">
              '.lg('New redirection').'
            </button>
        </div>
        <div class="clearfix"></div>
        <div id="DivRedirectionAdd" class="collapse" aria-labelledby="headingOne">
            <form action="#" name="FormRedirectionNew" id="FormRedirectionNew"  method="post">
            <p><strong>'.lg('New redirection 404 to 301 (Moved Permanently)').':</strong></p>
            <p>'.lg('You must specify the protocol <strong>http://</strong> or <strong>https://</strong>...').'</p>
            <table class="table table-striped table-bordered dt-responsive" style="background:white;width:100%">
                <thead style="background-color:white;">
                    <tr>
                        <th>'.lg('Source').'</th>
                        <th>'.lg('Destination').'</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle" style="height:20px;padding:7px 4px;"><input id="InputSrc" name="InputSrc" class="form-control form-control-sm input-grey-border-0" type="text" value="" style="font-size:14px;" maxlength="200" required></td>
                        <td class="align-middle" style="height:20px;padding:7px 4px;"><input id="InputDest" name="InputDest" class="form-control form-control-sm input-grey-border-0"  type="text" value="" style="font-size:14px;" maxlength="200" required></td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <button id="BtRedirectionAdd" class="btn btn-info" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Add redirection').'</button>
            </div>
            <div id="DivErrorRedirectionAdd" class="text-center fnt-0-95 text-danger" style="height:25px;"></div>
            </form>
            <hr>
        </div>';

    if(count($redirections) == 0) {
        echo '
        <div class="fnt-1-2 text-center" style="padding-top:100px;">There is no 404 redirections for now</div>';
    } else {

        $jsScripts .= '
function modalOpenDeleteRedirection(id) {
  var values = {"id": id};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/404redirections/ajax/ajax_redirection_delete_modalopen.php", type: "POST", data: values,
    success: function(data) {
      $("#DivBodyModalRedirectionDelete div").remove();
      $("#DivBodyModalRedirectionDelete").html(data);
      $("#ModalRedirectionDelete").modal("show");
    },
    error: function(exception) { console.log(exception); }
  });  
}

function deleteRedirection(id) {
  $("#BtRedirectionDelete" + id).btn("loading");
  var values = {"id": id};
  $.ajax({
    url: "'.$config['AdminURL'].'/pages/404redirections/ajax/ajax_redirection_delete.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxEdit").html(data);
    },
    error: function(exception) { console.log(exception); }
  });  
}';

        echo '
<div class="modal modal-responsive modal-mytheme fade" id="ModalRedirectionDelete" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-share-alt fa-2x pr-4 align-middle"></i>'.lg('Delete Redirection').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivBodyModalRedirectionDelete">
            </div>
        </div>
    </div>
</div>

            <table class="table table-striped table-bordered dt-responsive my-5" style="background:white;width:100%">
                <thead style="background-color:white;">
                    <tr>
                        <th> </th>
                        <th>'.lg('Source').'</th>
                        <th>'.lg('Destination').'</th>
                        <th>'.lg('Count').'</th>
                        <th class="text-nowrap">'.lg('Last click').'</th>
                    </tr>
                </thead>
                <tbody id="TBody404">';
        foreach($redirections as $oneRedirection) {
            
            echo '
                <tr id="TrRedirection'.$oneRedirection['id'].'">
                    <td class="fnt-0-85 text-center"><i class="popoverData fa fa-trash pointer text-danger" onClick="modalOpenDeleteRedirection('.$oneRedirection['id'].')" style="font-size:18px;" data-content="Delete this redirection" rel="popover" data-placement="bottom" data-trigger="hover"></i></td>
                    <td class="fnt-0-85 text-break-all"><a href="'.$oneRedirection['src'].'" target="_blank" class="text-dark">'.$oneRedirection['src'].'</a></td>
                    <td class="fnt-0-85 text-break-all"><a href="'.$oneRedirection['dest'].'" target="_blank" class="text-dark">'.$oneRedirection['dest'].'</a></td>
                    <td class="text-center">'.$oneRedirection['count_redirect'].'</td>
                    <td>'.issetor($oneRedirection['date_lastclick'], '<div class=\'text-center\'>-</div>').'</td>
                </tr>';

        }
        echo '
               </tbody>
           </table>';
    }

    echo '
     </div>
<div class="p-2"></div>
</div>
<div id="AjaxEdit" class="dis-n"></div>';

}


?>
