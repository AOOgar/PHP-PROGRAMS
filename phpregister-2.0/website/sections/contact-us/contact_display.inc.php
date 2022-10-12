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

function show_contact() {
    global $config, $jsDocumentReady, $jsWindowLoaded;

    $jsWindowLoaded .= '
$("body").on("submit", "#FormMessage", function(e) {
  $("#BtMessage").btn("loading");
  var values = $("form#FormMessage").serialize();
  $.ajax({
    url: "'.$config['URL'].'/sections/contact-us/ajax" + "/ajax_m" + "essage.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxMessage").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
  e.preventDefault();
})';

    // We wait 3 seconds before changing the Id to prevent execution from robots
    // That should work for most of robots, even if they execute the javascript, I don't think
    // that they will analyse the code to check if they have to wait 3 seconds before sending the form 
    $jsDocumentReady .= '
setTimeout(function() {
  $("#FormMessageTmp").attr("id", "FormMessage");
}, 3000);';

    echo '
<div class="container contact-box my-0 my-sm-5 text-center rounded" style="max-width:900px;">
    <div class="text-left pl-2 pl-sm-4 pt-2 pt-sm-4 mt-4 mb-5 text-white">
        <h3><i class="fa fa-pencil-square pr-2"></i>'.lg('Contact Form', NULL, FALSE).'</h3>
    </div>
    <form action="#/" name="FormMessageTmp" id="FormMessageTmp"  method="post">
    <div class="mx-auto trans-white-0-5 p-3 p-sm-5 mb-2 mb-sm-5 trans-white-0-8 rounded" style="max-width:700px;">
        <div id="DivMessage" class="mx-auto  text-left" style="max-width:600px;">
            <div class="row" style="margin:0px;">
                <div class="col-sm-6" style="padding:0px;">
                    <input name="InputName" id="InputName" class="name" type="text" width="100%" placeholder="'.lg('Your name', NULL, FALSE).'" required>
                </div>
                <div class="col-sm-6" style="padding:0px;">
                    <input name="InputEmail" id="InputEmail" class="email" type="email" width="100%" placeholder="'.lg('Your email address', NULL, FALSE).'" required>
                </div>
            </div>
            <div>
              <input name="InputSubject" id="InputSubject" class="subject" type="text" placeholder="'.lg('Subject of the message', NULL, FALSE).'" required>
           </div>
            <div>
                <textarea name="TextareaMessage" id="TextareaMessage" class="message" rows="7" placeholder="'.lg('Message', NULL, FALSE).'" required></textarea>
            </div>
            <div class="pt-4 text-center">
                <button id="BtMessage" class="btn btn-mytheme" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button>
            </div>
        </div>
        <div id="AjaxMessage" class="dis-n"></div>
    </div>
    </form>
</div>';
    

}




?>
