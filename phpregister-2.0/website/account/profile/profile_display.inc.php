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


function show_profile() {
    global $config, $configNative, $siteSections, $userInfos, $userAddresses, $countryLangShow, $sessionUser, $jsScripts, $jsDocumentReady, $jsWindowLoaded, $jsWindowResize;

    $jsDocumentReady .= '
$("#DivAccountContent").fadeTo("slow", 1);';

    $jsScripts .= '
var uploadAjax;
var xhr;
var percent = 0;
var finish = true;
var id = 0;

function uploadCancel(id) {
  $("#ImgPhoto" + id).val("");
  xhr.abort();
  percent = 0;
  finish = true;
  $("#DivUploading" + id).addClass("dis-n");
  $("#BtUploadCancel" + id).addClass("dis-n");
  $("#LabelPhotoUpload" + id).removeClass("dis-n");
  $("#LabelPhotoDelete" + id).removeClass("dis-n");
  $("#DivProgressBarPhoto" + id).width(0 + "%");
};';
    
    $jsWindowLoaded .= '
$(".input-photo").change(function(e) {
  if(finish == false) {
    alert("'.lg('﻿Please wait until the current download is complete. ', 'Global', FALSE).'");
    return;
  }
  id = e.target.id.substring(8);
  if($("#ImgPhoto" + id)[0].files[0].size > '.max_file_upload_in_bytes().') {
    alert("'.lg('File too large, maximum size:', 'Global', FALSE).' '.get_bytesReadable(max_file_upload_in_bytes()).'");
    return;
  }
  var fileName = $("#ImgPhoto" +id).prop("files")[0]["name"];
  var ext = $("#ImgPhoto" + id).val().split(".").pop().toLowerCase();
  if($.inArray(ext, ["jpg","jpeg"]) == -1) {
    alert("'.lg('Please upload a photo in .jpg format', 'Global', FALSE).'");
    $("#ImgPhoto" + id).val("");
    return;
  }
  $("#FormPhotoUpload" + id).submit();
});
$("form[id^=\'FormPhotoUpload\']").submit(function(e) {
  e.preventDefault();
  if($("#ImgPhoto" + id).val() != "") {
    uploadAjax = $("#FormPhotoUpload" + id).ajaxSubmit({
      beforeSend: function() {
        $("#DivUploading" + id).removeClass("dis-n");
        $("#BtUploadCancel" + id).removeClass("dis-n");
        $("#LabelPhotoUpload" + id).addClass("dis-n");
        $("#LabelPhotoDelete" + id).addClass("dis-n");
        finish = false;
        percent = 0;
        $("#DivProgressBarPhoto" + id).width("0%");
        $("#DivProgressBarPhoto" + id).attr("style", "opacity:1;");
      },
      uploadProgress: function(event, position, total, percentComplete) {
        percent = percentComplete - 2;
        $("#DivProgressBarPhoto" + id).width(percentComplete + "%");
      },
      success: function() {
        finish = true;
        setTimeout(function () {
          $("#DivProgressBarPhoto" + id).attr("style", "opacity:0;");
          $("#DivProgressBarPhoto" + id).width("0%");
        }, 1000);
      },
      complete: function(xhr) {
        //alert(xhr.responseText);
        uploadCancel(id);
        $("#AjaxPhotoUpload").html(xhr.responseText);
      }
    });
    xhr = uploadAjax.data("jqxhr");
    return false;
  }
});';
    
    $jsScripts .= '
function delProfilePicture() {
  $.ajax({
    url: "'.$config['URL'].'/account/profile/ajax/ajax_photo_delete.php",
    success: function(data) {
      $("#AjaxEdit").empty().html(data);
    }
  });
}';
    $jsWindowLoaded .= '
$(".popoverData").popover();';

    echo '
<div id="AjaxEdit" class="dis-n"></div>
<div id="AjaxPhotoUpload" class="dis-n"></div>
<div id="DivAccountContent" class="container py-3 py-sm-5 opa-0" style="max-width:890px;">

    <h2 class="fnt-1 clr-mytheme font-weight-bold">'.lg('My profile', 'Global').'</h2>

    <div class="row py-2 py-sm-4">
        <div class="col-sm-2 text-center mt-3 mt-sm-4">';
    $imgProfile = $config['ImagesURL'].'profile-default-image.jpg';
    $cssDisImgDefault = 'dis-n';
    $cssDisImgProfile = 'dis-n';
    $imgProfileThumb = '';
    $imgProfile = '';
    if($sessionUser['picture'] != NULL) {
        $cssDisImgProfile = '';
    } else {
        $cssDisImgDefault = '';
    }
    echo '
           <div id="DivImgProfileDefault" class="'.$cssDisImgDefault.'">
              <img src="'.$config['ImagesURL'].'profile-default-image.jpg" class="rounded-lg img-profile" style="max-height:100px;max-width:100px;">
           </div>
           <div id="DivImgProfile" class="'.$cssDisImgProfile.'">';
        if($sessionUser['picture'] != NULL) {
            $imgProfileThumb = $config['ImagesURL'].'_uploads/profiles_pictures/'.$sessionUser['picture'].'-100.jpg';
            $imgProfile = $config['ImagesURL'].'_uploads/profiles_pictures/'.$sessionUser['picture'].'-500.jpg';
        }
    echo '<a id="AImgProfile" class="example-image-link" href="'.$imgProfile.'" data-lightbox="example-1"><img id="ImgProfileTop" src="'.$imgProfile.'" class="rounded-lg img-profile" style="max-height:100px;max-width:100px;"></a>
            </div>
            <form id="FormPhotoUpload1" action="'.$config['URL'].'/account/profile/ajax/ajax_photo_upload.php" method="post" enctype="multipart/form-data">
            <label id="LabelPhotoUpload1" class="btn btn-file btn-xs btn-outline-secondary mt-2 pointer">
                '.lg('Modify', 'Global').'
                <input id="ImgPhoto1" name="ImgPhoto" class="input-photo dis-n" type="file">
            </label>
            <label id="LabelPhotoDelete1" class="align-bottom">
                <i onClick="delProfilePicture();" class="pointer fa fa-trash ml-3 text-danger popoverData" data-content="'.lg('Delete this image', FALSE).'" rel="popover" data-placement="bottom" data-trigger="hover" style="font-size:24px;"></i>
            </label>
            <div id="DivUploading1" class="fnt-0-85 dis-n">
                <div id="DivProgress1" class="progressdiv mx-auto" style="width:100%;">
                     <div class="progressbar" id="DivProgressBarPhoto1"></div>
                </div>
            </div>
            <button id="BtUploadCancel1" class="btn btn-xs btn-mytheme dis-n" onClick="uploadCancel();">'.lg('Cancel', 'Global').'</button>
            </form>

        </div>
        <div class="col-sm-10">';
    $jsWindowLoaded .= '
$("#FormName").on("submit", function (e) {
  $("[id^=\'DivError\']").css({"opacity":0});
  $("#BtName").btn("loading");
  var values = $("form#FormName").serialize();
  $.ajax({
    url: "'.$config['URL'].'/account/profile/ajax/ajax_name_update.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxEdit").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
  e.preventDefault();
});';
    echo '
            <form action="#" id="FormName"  name="FormName" method="post">
            <div class="pl-1">
                '.lg('Firstname', 'Global').'
            </div>
            <input id="InputFirstname" name="InputFirstname" type="text" value="'.$userInfos['firstname'].'" class="form-control input-grey py-sm-4 px-sm-3">
            <div id="DivErrorFirstname" class="text-danger fnt-0-85 opa-0" style="height:35px;">'.lg('Please fill out this field', 'Global').'</div>
             <div class="pl-1">
                '.lg('Lastname', 'Global').'
            </div>
            <input id="InputLastname" name="InputLastname" type="text" value="'.$userInfos['lastname'].'" class="form-control input-grey py-sm-4 px-sm-3">
            <div id="DivErrorLastname" class="text-danger fnt-0-85 opa-0 pt-1" style="height:35px;">'.lg('Please fill out this field', 'Global').'</div>
            <button type="submit" id="BtName" class="btn btn-mytheme" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'"> '.lg('Save', 'Global').'</button>
            </form>
        </div>
    </div>
    <hr>
    <div class="row py-2 py-sm-4">
        <div class="col-sm-2 text-center">
            <i class="fa fa-at mb-2 clr-mytheme" style="font-size:40px;"></i>
        </div>
        <div class="col-sm-10">
            <p class="fnt-1-1">'.lg('Change your email address').'</p>
            <div id="DivEmail">';
    $jsScripts .= '
function emailPendingDelete() {
  $("body #BtEmailPendingDelete").btn("loading");
  var values = {};
  $.ajax({
    url: "'.$config['URL'].'/account/profile/ajax/ajax_emailpending_delete.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxEdit").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}';
        $jsWindowLoaded .= '
$("#FormEmail").on("submit", function (e) {
  e.preventDefault();
  $("#BtEmail").btn("loading");
  var values = {"InputEmail": $("#InputEmail").val()};
  $("#DivErrorEmail").html("");
  $.ajax({
    url: "'.$config['URL'].'/account/profile/ajax/ajax_email_update.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxEdit").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});';

    echo html_profileEmail();
    echo '
            </div>
        </div>
    </div>
    <hr>
<div class="modal modal-mytheme fade" id="ModalAddress" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">'.lg('Your delivery address').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivModalBodyAddress">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">'.lg('Close', 'Global').'</button>
            </div>
        </div>
    </div>
</div>';
    
    $jsScripts .= '
function addressModalOpen(id = null) {
  var values = {"id": id};
  $.ajax({
    url: "'.$config['URL'].'/account/profile/ajax/ajax_address_modalopen.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxEdit").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}
function addressModalDelete(id) {
  var values = {"id": id};
  $.ajax({
    url: "'.$config['URL'].'/account/profile/ajax/ajax_addressdelete_modalopen.php", type: "POST", data: values,
    success: function(data) {
      $("#AjaxEdit").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
}';

    echo '
    <div class="row py-2 py-sm-4">
        <div class="col-sm-2 text-center">
            <i class="fa fa-truck mb-2 clr-mytheme" style="font-size:40px;"></i>
        </div>
        <div class="col-sm-10">
            <div class="d-inline-block fnt-1-1">'.lg('Your delivery addresses').'</div>
            <div class="float-right">
                <button class="btn btn-mytheme align-bottom" onClick="addressModalOpen();"><i class="fa fa-plus pointer pr-2"></i>'.lg('Add an address').'</button>
            </div>
            <div class="clearfix"></div>
            <div id="DivAddresses">';
    echo html_profileAdresses();
    echo '
            </div> 
        </div>
    </div>
    <hr>
    <div class="row py-2 py-sm-4">
        <div class="col-sm-2 text-center">
            <i class="fa fa-newspaper-o mb-2 clr-mytheme" style="font-size:40px;"></i>
        </div>
        <div class="col-sm-10">';
    $newsLetterChecked = '';
    if($userInfos['newsletter'] == 1) {
        $newsLetterChecked = 'checked';
    }
    $jsWindowLoaded .= '
$("#CheckboxNewsletter").on("change", function() {
  if($("#CheckboxNewsletter").is(":checked")) {
    var values = {"CheckboxNewsletter": 1};
  } else {
    var values = {"CheckboxNewsletter": 0};
  }
  $.ajax({
    url: "'.$config['URL'].'/account/profile/ajax/ajax_newsletter_update.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxEdit").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});';
    echo '
            <p class="fnt-1-1">'.lg('Receive the newsletter').'</p>
            <div class="text-left pt-3 pb-3" style="max-width:670px;">
                <div class="p-2">
                    <div class="float-left text-left" style="max-width:70%;">'.lg('I would like to receive the WebsiteName newsletter and be informed of new features a...').'</div>
                    <div class="float-right">
                        <label class="switch ml-4">
                            <input id="CheckboxNewsletter" name="CheckboxNewsletter" type="checkbox" '.$newsLetterChecked.'>
                            <div class="slider round"></div>
                        </label>
                     </div>
                     <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row py-2 py-sm-4">
        <div class="col-sm-2 text-center">
            <i class="fa fa-unlock mb-2 clr-mytheme" style="font-size:40px;"></i>
        </div>
        <div class="col-sm-10">
            <p class="fnt-1-1">'.lg('ChangeYourPassword').'</p>';
    $disCurrentPassword = '';
    if($userInfos['password'] == NULL) {
        /** Password is NULL for social networks accounts. If the user specify a password, 
         *  he will be able to login through his social network AND through email / password authentication
         */
        $disCurrentPassword = 'dis-n';
    }
    $jsWindowLoaded .= '
$("#FormPassword").on("submit", function (e) {
  e.preventDefault();
  $("#BtPassword").btn("loading");
  var values = $("#FormPassword").serialize();
  $("#DivErrorPassword").html("");
  $.ajax({
    url: "'.$config['URL'].'/account/profile/ajax/ajax_password_update.php", type: "POST", data: values,
    success: function (data) {
      $("#AjaxEdit").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });
});';
    echo '
            <form action="#" id="FormPassword"  method="post">
            <div class="div-cpass pt-4 fnt-0-95 pl-1 '.$disCurrentPassword.'">
                '.lg('Current').'
            </div>
            <div class="div-cpass pt-1 pb-2 '.$disCurrentPassword.'">
                <div class="row">
                    <div class="col-sm-6">
                        <input id="InputPasswordCurrent" name="InputPasswordCurrent" type="password" value="" class="form-control input-grey" style="max-width:500px;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="pt-1 fnt-0-95 pl-1">
                      '.lg('New').'
                    </div>
                    <input id="InputPasswordNew1" name="InputPasswordNew1" type="password" value="" class="form-control input-grey">
                    <div class="text-italic fnt-0-8">'.lg('Minimum 6 characters, with at least 1 digit and a special character such as: ! # @ - _.', 'Signup').'</div>
                </div>
                <div class="col-sm-6">
                    <div class="pt-1 fnt-0-95 pl-1">
                      '.lg('Confirm').'
                    </div>
                    <input id="InputPasswordNew2" name="InputPasswordNew2" type="password" value="" class="form-control input-grey">
                </div>
            </div>
            <div class="pb-1 pt-3">
                <button id="BtPassword" class="btn btn-mytheme" data-loading-text="<span class=\'fa fa-spinner fa-spin fa-lg mr-2\'></span>'.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button>
            </div>
            <div id="DivErrorPassword" class="text-danger fnt-0-85 opa- pt-1" style="height:25px;"></div>
            </form>
        </div>
    </div>
    <hr>
    <div class="float-right pt-2 pt-sm-4">
        <button class="btn btn-outline-secondary btn-xs noshadow fnt-0-8" data-toggle="modal" data-target="#ModalAccountDelete">'.lg('Delete account').'</button>
    </div>
    <div class="clearfix"></div>
<div class="modal modal-responsive modal-mytheme fade" id="ModalAccountDelete" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">'.lg('Delete account').'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="DivModalBodyAccountDelete">';
    if($userInfos['email'] == NULL) {
        /** Social network accounts can be created without email.
         *  An email must be attached to an account for its deletion. */
        echo '
                <p class="py-4 fnt-1-2">'.lg('For an account deletion, an email must be attached to your account.').'</p>
                <i class="fa fa-envelope text-mytheme" style="font-size:75px;"></i>';
    } else {
        
        echo '
    <div class="row">
        <div class="col-sm-2 text-center">
            <i class="fa fa-trash text-danger" style="font-size:55px;"></i>
        </div>
        <div id="DivAccountDelete" class="col-sm-10">';
        
        if($userInfos['account_deletekey'] == NULL) {
            echo html_accountDelete();
        } else {
            echo html_accountDeletePending();
        }
        echo '
        </div>
    </div>';
    }

    $jsWindowLoaded .= '
$(document).on("click", "#BtAccountDelete", function(e) {
  if(!$("#CheckboxAccountDelete").is(":checked")) {
    $("#LabelDeleteConfirm").addClass("text-danger");
    $("#LabelDeleteConfirm").blink(2);
  } else {
    $("#BtAccountDelete").btn("loading");
    $.ajax({
      url: "'.$config['URL'].'/account/profile/ajax/ajax_accountdeletion_sendemail.php", type: "POST",
      success: function (data) {
        $("#AjaxEdit").empty().html(data);
      },
      error: function(exception) { console.log(exception); }
    });   
  }
});
$(document).on("click", "#BtAccountDeletionCancel", function(e) {
  $("#BtAccountDeletionCancel").btn("loading");
  $.ajax({
    url: "'.$config['URL'].'/account/profile/ajax/ajax_accountdeletion_cancel.php", type: "POST",
    success: function (data) {
      $("#AjaxEdit").empty().html(data);
    },
    error: function(exception) { console.log(exception); }
  });     
});';

    echo '
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">'.lg('Close', 'Global').'</button>
            </div>
        </div>
    </div>
</div>
</div>';

}

function html_accountDelete() {
    
    $html =  '
<p><strong>'.lg('Are you sure you want to delete your account?').'</strong></p>
<div class="text-center bg-warning rounded-lg my-4 py-4 fnt-1-2">'.lg('The deletion will be final').'</div>
<div class="custom-control custom-checkbox">
    <input id="CheckboxAccountDelete" type="checkbox" class="custom-control-input">
    <label id="LabelDeleteConfirm" class="custom-control-label" for="CheckboxAccountDelete">'.lg('Please check to confirm').'</label>
</div>
<p class="pt-5 txt-c"><button id="BtAccountDelete" class="btn btn-outline-danger" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Send', 'Global').'</button></p>';
    return $html;
}

function html_accountDeletePending() {
    global $sessionUser;
    $html =  '
<div>
    <p>'.ucfirst($sessionUser['firstname']).',</p>
    <p class="pt-1">'.lg('An email was sent to').' <span class="underline-mytheme mx-2">'.$sessionUser['email'].'</span> '.lg('with a link to delete your account.').'</p>
    <div class="text-center"><i class="fa fa-envelope text-mytheme" style="font-size: 80px;"></i></div>
    <hr>
    <div id="DivBtCancelDeletion" style="height:100px;">
        <p class="pt-3">'.lg('Cancel the account deletion?').'</p>
        <button id="BtAccountDeletionCancel" class="btn btn-outline-danger" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Yes, cancel').'</button>
    </div>
</div>';
    return $html;
}

function html_profileAdresses() {
    global $userAddresses, $countryLangShow;
    
    $html = '';
    if(count($userAddresses) == 0) {
        $html .= '
<div class="bg-light p-3 mt-2 mt-sm-3 p-sm-4 border rounded" style="width:90%;min-width:220px;max-width:430px;">
    <p>'.lg('No address registered').'</p>
    <p>'.lg('Click on <i class="fa fa-plus fnt-1-2 px-2 pointer" onClick="addressModalOpen();" ><...').'</p>
</div>';
    } else {
        foreach($userAddresses as $oneAddress) {
            $html .= '
<div id="DivAddress'.$oneAddress['id'].'" class="mt-3" style="width:90%;min-width:220px;max-width:430px;">
    <div class="float-right mr-4">'.$oneAddress['name'].'</div>
    <div class="clearfix"></div>
    <div class="bg-light p-3 p-sm-4 border rounded">
        <div class="row">
            <div class="col-10">
                <p>'.$oneAddress['username'].'</p>
                <p>'.$oneAddress['line1'].'</p>'.issetor($oneAddress['line2'], FALSE, $addBefore = '<p>',  $addAfter = '</p>').'
                <p>'.$oneAddress['city'].' '.$oneAddress['postcode'].'</p>
                <p class="mb-0">'.$oneAddress[$countryLangShow].'</p>
            </div>
            <div class="col-2" style="margin:0px !important;padding:0px !important;">
                <p><i onClick="addressModalOpen('.$oneAddress['id'].');" class="fa fa-pencil fnt-1-4 pointer popoverData" data-content="'.lg('Modify this address', NULL, FALSE).'" rel="popover" data-placement="bottom" data-trigger="hover"></i></p>
                <p class="mt-3"><i onClick="addressModalDelete('.$oneAddress['id'].');" class="fa fa-trash-o fnt-1-4 text-danger pointer popoverData" data-content="'.lg('Delete this address', NULL, FALSE).'" rel="popover" data-placement="bottom" data-trigger="hover"></i></p>
            </div>
        </div>
    </div>
 </div>';
        }
    }
    return $html;
}

function html_profileEmail() {
    global $userInfos, $sessionUser;
    
    if($userInfos['newemail'] != NULL) {
        $html = '
<p class="pt-3">'.lg('An email was sent to you at').'<span class="underline-mytheme mx-2">'.$userInfos['newemail'].'</span> '.lg('with a link to validate it').'.</p>
<p>'.lg('Delete activation?').'</p>
<p class="pb-3"><button id="BtEmailPendingDelete" class="btn btn-outline-danger ml-5" onClick="emailPendingDelete();" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'">'.lg('Yes, delete').'</button></p>';
    } else {

        $html = '
<form action="#" id="FormEmail"  method="post">
<div id="DivInputEmail">
    <div class="pt-2 fnt-0-9 pl-1">
        '.lg('Email address', 'Global').'
    </div>
    <div id="DivInputEmail" class="pt-1 pb-2">
        <input id="InputEmail" name="InputEmail" type="text" value="'.$sessionUser['email'].'" class="form-control input-grey py-sm-4 px-sm-3">
    </div>
    <div id="DivChangeInProgress" class="fnt-0-95 dis-n" style="height:50px;"></div>
    <div id="DivErrorEmail" class="text-danger fnt-0-85 opa-0" style="height:35px;">'.lg('Please fill out this field', 'Global').'</div>
    <div class="pt-1">
        <button type="submit" id="BtEmail" class="btn btn-mytheme" data-loading-text="<i class=\'fa fa-spinner fa-spin fa-lg mr-2\'></i>'.lg('Sending', 'Global').'"> '.lg('Save', 'Global').'</button>
    </div>
</div>
</form>';
    }
    return $html;
}





?>
