"use strict";

(function ($) {
  'use strict';

  $(document).ready(function () {
    // Function: Initialize Datatable.
    function wlsmInitializeTable(table, data) {
      var dataExport = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
      var disableOrdering = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : [];
      table.DataTable({
        'processing': true,
        'serverSide': true,
        'responsive': true,
        'order': [],
        'ajax': {
          url: ajaxurl,
          type: 'POST',
          data: data,
          complete: function complete(event, xhr, settings) {
            var wlsmExportBtn = $('#wlsm-export-table-btn');
            wlsmExportBtn.hide();

            if (dataExport) {
              var json = event.responseJSON;

              if (json && json.hasOwnProperty('recordsTotal') && json.recordsTotal > 0 && json.hasOwnProperty('export')) {
                var exportFields = json["export"];
                $('#wlsm-export-nonce').val(exportFields['nonce']);
                $('#wlsm-export-action').val(exportFields['action']);
                $('#wlsm-export-filter').val(exportFields['filter']);

                if (exportFields.hasOwnProperty('data')) {
                  var exportFieldsInputs = $('.wlsm-export-fields');
                  var exportFieldsData = exportFields['data'];

                  for (var exportKey in exportFieldsData) {
                    exportFieldsInputs.append('<input type="hidden" name="' + exportKey + '" value="' + exportFieldsData[exportKey] + '">');
                  }
                }

                wlsmExportBtn.show();
              }
            }
          }
        },
        'deferRender': true,
        'language': {
          'processing': wlsmloadingtext
        },
        'lengthMenu': [25, 50, 100, 200],
        'columnDefs': [{
          'targets': disableOrdering,
          'orderable': false
        }]
      });
    } // Manager: Schools Table.


    var schoolsTable = $('#wlsm-schools-table');
    wlsmInitializeTable(schoolsTable, {
      action: 'wlsm-fetch-schools'
    }); // Manager: School Classes Table.

    var schoolClassesTable = $('#wlsm-school-classes-table');
    var school = schoolClassesTable.data('school');
    var nonce = schoolClassesTable.data('nonce');

    if (school && nonce) {
      var data = {
        action: 'wlsm-fetch-school-classes',
        school: school
      };
      data['school-classes-' + school] = nonce;
      wlsmInitializeTable(schoolClassesTable, data);
    } // Manager: Admins Table.


    var schoolAdminsTable = $('#wlsm-school-admins-table');
    var school = schoolAdminsTable.data('school');
    var nonce = schoolAdminsTable.data('nonce');

    if (school && nonce) {
      var data = {
        action: 'wlsm-fetch-school-admins',
        school: school
      };
      data['school-admins-' + school] = nonce;
      wlsmInitializeTable(schoolAdminsTable, data);
    } // Manager: Classes Table.


    var classesTable = $('#wlsm-classes-table');
    wlsmInitializeTable(classesTable, {
      action: 'wlsm-fetch-classes'
    }); // Manager: Sessions Table.

    var sessionsTable = $('#wlsm-sessions-table');
    wlsmInitializeTable(sessionsTable, {
      action: 'wlsm-fetch-sessions'
    }); // Copy target content to clipboard on click.

    function copyToClipboard(selector, target) {
      $(document).on('click', selector, function () {
        var value = $(target).text();
        var temp = $('<input>');
        $('body').append(temp);
        temp.val(value).select();
        document.execCommand('copy');
        temp.remove();
        toastr.success();
      });
    } // Initialize datatable without server side.


    function wlsmInitializeDataTable(selector) {
      var length = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [25, 50, 100, 200];
      var action = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';
      var data = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : '';
      var exportButtons = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : '';
      var options = {
        'responsive': true,
        'order': [],
        'language': {
          'processing': wlsmloadingtext
        },
        'pageLength': 0,
        'lengthMenu': length
      };

      if (action) {
        options['ajax'] = {
          url: ajaxurl + '?security=' + wlsmsecurity + '&action=' + action + data,
          dataSrc: 'data'
        };
      }

      if (exportButtons) {
        options['aaSorting'] = [];
        options['lengthChange'] = false;
        options['dom'] = 'lBfrtip';
        options['select'] = true;
        options['buttons'] = exportButtons;
      }

      selector.DataTable(options);
    } // Copy shortcodes.


    copyToClipboard('#wlsm_school_management_fees_copy_btn', '#wlsm_school_management_fees_shortcode');
    copyToClipboard('#wlsm_school_management_account_copy_btn', '#wlsm_school_management_account_shortcode');
    copyToClipboard('#wlsm_school_management_inquiry_copy_btn', '#wlsm_school_management_inquiry_shortcode');
    copyToClipboard('#wlsm_school_management_registration_copy_btn', '#wlsm_school_management_registration_shortcode');
    copyToClipboard('#wlsm_school_management_fees_default_session_copy_btn', '#wlsm_school_management_fees_default_session_shortcode');
    copyToClipboard('#wlsm_school_management_exam_time_table_copy_btn', '#wlsm_school_management_exam_time_table_shortcode');
    copyToClipboard('#wlsm_school_management_exam_admit_card_copy_btn', '#wlsm_school_management_exam_admit_card_shortcode');
    copyToClipboard('#wlsm_school_management_exam_result_copy_btn', '#wlsm_school_management_exam_result_shortcode');
    copyToClipboard('#wlsm_school_management_certificate_copy_btn', '#wlsm_school_management_certificate_shortcode');
    copyToClipboard('#wlsm_school_management_noticeboard_copy_btn', '#wlsm_school_management_noticeboard_shortcode'); // Loading icon variables.

    var loaderContainer = $('<span/>', {
      'class': 'wlsm-loader ml-2'
    });
    var loader = $('<img/>', {
      'src': wlsmadminurl + 'images/spinner.gif',
      'class': 'wlsm-loader-image mb-1'
    }); // Function: Before Submit.

    function wlsmBeforeSubmit(button) {
      $('div.text-danger').remove();
      $(".is-invalid").removeClass("is-invalid");
      $('.wlsm .alert-dismissible').remove();
      button.prop('disabled', true);
      loaderContainer.insertAfter(button);
      loader.appendTo(loaderContainer);
      return true;
    } // Function: Display Form Erros.


    function wlsmDisplayFormErrors(response, formId) {
      if (response.data && $.isPlainObject(response.data)) {
        $(formId + ' :input').each(function () {
          var input = this;
          $(input).removeClass('is-invalid');

          if (response.data[input.name]) {
            var errorSpan = '<div class="text-danger mt-1">' + response.data[input.name] + '</div>';
            $(input).addClass('is-invalid');
            $(errorSpan).insertAfter(input);
          }
        });
      } else {
        var errorSpan = '<div class="text-danger mt-3">' + response.data + '<hr></div>';
        $(errorSpan).insertBefore(formId);
        toastr.error(response.data);
      }
    } // Function: Show Success Alert.


    function wlsmShowSuccessAlert(message, formId) {
      var alertBox = '<div class="mt-2 alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="wlsm-font-bold"><i class="fa fa-check"></i> &nbsp;' + message + '</span></div>';
      $(alertBox).insertBefore(formId);
    } // Function: Display Form Error.


    function wlsmDisplayFormError(response, formId, button) {
      button.prop('disabled', false);
      var errorSpan = '<div class="text-danger mt-2"><span class="wlsm-font-bold">' + response.status + '</span>: ' + response.statusText + '<hr></div>';
      $(errorSpan).insertBefore(formId);
      toastr.error(response.data);
    } // Function: Complete.


    function wlsmComplete(button) {
      button.prop('disabled', false);
      loaderContainer.remove();
    }

    var subHeader = '.wlsm-sub-header-left'; // Function: Action.

    function wlsmAction(event, element, data, performActions) {
      var color = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : 'red';
      var showLoadingIcon = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : false;
      event.preventDefault();
      $('.wlsm .alert-dismissible').remove();
      var button = $(element);
      var title = button.data('message-title');
      var content = button.data('message-content');
      var cancel = button.data('cancel');
      var submit = button.data('submit');
      $.confirm({
        title: title,
        content: content,
        type: color,
        useBootstrap: false,
        buttons: {
          formSubmit: {
            text: submit,
            btnClass: 'btn-' + color,
            action: function action() {
              $.ajax({
                data: data,
                url: ajaxurl,
                type: 'POST',
                beforeSend: function beforeSend(xhr) {
                  $('.wlsm .alert-dismissible').remove();

                  if (showLoadingIcon) {
                    return wlsmBeforeSubmit(button);
                  }
                },
                success: function success(response) {
                  if (response.success) {
                    var alertBox = '<div class="alert alert-success alert-dismissible clearfix" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-check"></i> &nbsp;' + response.data.message + '</strong></div>';
                    $(alertBox).insertBefore(subHeader);
                    toastr.success(response.data.message, '', {
                      timeOut: 600,
                      fadeOut: 600,
                      closeButton: true,
                      progressBar: true,
                      onHidden: function onHidden() {
                        performActions(response);
                      }
                    });
                  } else {
                    toastr.error(response.data);
                    var errorSpan = '<div class="alert alert-danger alert-dismissible clearfix" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>' + response.data + '</strong></div>';
                    $(errorSpan).insertBefore(subHeader);
                  }
                },
                error: function error(response) {
                  toastr.error(response.status + ': ' + response.statusText);
                  var errorSpan = '<div class="alert alert-danger alert-dismissible clearfix" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>' + response.status + '</strong>: ' + response.statusText + '</div>';
                  $(errorSpan).insertBefore(subHeader);
                },
                complete: function complete(event, xhr, settings) {
                  if (showLoadingIcon) {
                    wlsmComplete(button);
                  }
                }
              });
            }
          },
          cancel: {
            text: cancel,
            action: function action() {
              $('.wlsm .alert-dismissible').remove();
            }
          }
        }
      });
    } // Manager: Save school.


    var saveSchoolFormId = '#wlsm-save-school-form';
    var saveSchoolForm = $(saveSchoolFormId);
    var saveSchoolBtn = $('#wlsm-save-school-btn');
    saveSchoolForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          } else if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveSchoolForm[0].reset();
          } else {
            $('.wlsm-page-heading-box').load(location.href + " " + '.wlsm-page-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolFormId, saveSchoolBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolBtn);
      }
    });

    function wlsmDelay(callback, ms) {
      var timer = 0;
      return function () {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
          callback.apply(context, args);
        }, ms || 0);
      };
    }

    function wlsmPad(pad, str) {
      return (pad + str).slice(-pad.length);
    }

    function wlsmUpdateEnrollmentPreview() {
      var prefix = $('input[name="enrollment_prefix"]').val();
      var base = $('input[name="enrollment_base"]').val();
      var padding = $('input[name="enrollment_padding"]').val();
      base = parseInt(base);
      padding = parseInt(padding);
      var defaultBase = saveSchoolForm.data('default-enrollment-base');
      var defaultPadding = saveSchoolForm.data('default-enrollment-padding');

      if (isNaN(base)) {
        base = defaultBase;
      }

      if (isNaN(padding)) {
        padding = defaultPadding;
      }

      var paddedValue = wlsmPad('0'.repeat(padding), 1 + base);
      $('.wlsm-enrollment-text').text(prefix + paddedValue);
    } // On change enrollment prefix.


    $(document).on('keyup', '#wlsm-save-school-form input[name="enrollment_prefix"]', wlsmDelay(function (event) {
      wlsmUpdateEnrollmentPreview();
    }, 500)); // On change enrollment base.

    $(document).on('keyup', '#wlsm-save-school-form input[name="enrollment_base"]', wlsmDelay(function (event) {
      wlsmUpdateEnrollmentPreview();
    }, 500)); // On change enrollment padding.

    $(document).on('keyup', '#wlsm-save-school-form input[name="enrollment_padding"]', wlsmDelay(function (event) {
      wlsmUpdateEnrollmentPreview();
    }, 500));

    function wlsmUpdateAdmissionPreview() {
      var prefix = $('input[name="admission_prefix"]').val();
      var base = $('input[name="admission_base"]').val();
      var padding = $('input[name="admission_padding"]').val();
      base = parseInt(base);
      padding = parseInt(padding);
      var defaultBase = saveSchoolForm.data('default-admission-base');
      var defaultPadding = saveSchoolForm.data('default-admission-padding');

      if (isNaN(base)) {
        base = defaultBase;
      }

      if (isNaN(padding)) {
        padding = defaultPadding;
      }

      var paddedValue = wlsmPad('0'.repeat(padding), 1 + base);
      $('.wlsm-admission-text').text(prefix + paddedValue);
    } // On change admission prefix.


    $(document).on('keyup', '#wlsm-save-school-form input[name="admission_prefix"]', wlsmDelay(function (event) {
      wlsmUpdateAdmissionPreview();
    }, 500)); // On change admission base.

    $(document).on('keyup', '#wlsm-save-school-form input[name="admission_base"]', wlsmDelay(function (event) {
      wlsmUpdateAdmissionPreview();
    }, 500)); // On change admission padding.

    $(document).on('keyup', '#wlsm-save-school-form input[name="admission_padding"]', wlsmDelay(function (event) {
      wlsmUpdateAdmissionPreview();
    }, 500)); // Manager: Delete school.

    $(document).on('click', '.wlsm-delete-school', function (event) {
      event.preventDefault();
      var schoolId = $(this).data('school');
      var nonce = $(this).data('nonce');
      var data = "school_id=" + schoolId + "&delete-school-" + schoolId + "=" + nonce + "&action=wlsm-delete-school";

      var performActions = function performActions() {
        schoolsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Manager: Delete school class.

    $(document).on('click', '.wlsm-delete-school-class', function (event) {
      event.preventDefault();
      var classId = $(this).data('class');
      var schoolId = $(this).data('school');
      var nonce = $(this).data('nonce');
      var data = "school_id=" + schoolId + "&class_id=" + classId + "&delete-school-class-" + classId + "=" + nonce + "&action=wlsm-delete-school-class";

      var performActions = function performActions() {
        window.location.reload();
      };

      wlsmAction(event, this, data, performActions);
    }); // Manager: Set school.

    $(document).on('click', '.wlsm-school-card-link', function (event) {
      var nonce = $(this).data('nonce');
      var school = $(this).data('school');
      $.ajax({
        data: "school=" + school + "&set-school-" + school + "=" + nonce + "&action=wlsm-set-school",
        url: ajaxurl,
        type: 'POST',
        beforeSend: function beforeSend(xhr) {
          $('.wlsm .alert-dismissible').remove();
        },
        success: function success(response) {
          if (response.success) {
            toastr.success(response.data.message);
            window.location.href = response.data.url;
          } else {
            if (response.data) {
              toastr.error(response.data);
            }
          }
        },
        error: function error(response) {
          if (response.data) {
            toastr.error(response.data);
          }
        }
      });
    }); // Manager: Autocomplete classes.

    var classSearch = $('#wlsm_class_search');
    $('#wlsm_class_search').autocomplete({
      minLength: 1,
      source: function source(request, response) {
        $.ajax({
          data: 'action=wlsm-get-keyword-classes&keyword=' + request.term,
          url: ajaxurl,
          type: 'POST',
          success: function success(res) {
            if (res.success) {
              response(res.data);
            } else {
              response([]);
            }
          }
        });
      },
      select: function select(event, ui) {
        classSearch.val('');
        var id = ui.item.ID;
        var label = ui.item.label;
        var classesInput = $('.wlsm_school_classes_input');

        if (classesInput) {
          var classesToAdd = classesInput.map(function () {
            return $(this).val();
          }).get();

          if (-1 !== $.inArray(id, classesToAdd)) {
            return false;
          }
        }

        if (id) {
          $('.wlsm_school_classes').append('' + '<div class="wlsm-school-class-item mb-1">' + '<input class="wlsm_school_classes_input" type="hidden" name="classes[]" value="' + id + '">' + '<span class="wlsm-badge badge badge-info">' + label + '</span>' + '&nbsp;<i class="fa fa-times bg-danger text-white wlsm-remove-item"></i>' + '</div>' + '');
          return false;
        }

        return false;
      }
    }); // Remove parent on click

    $(document).on('click', '.wlsm-remove-item', function () {
      $(this).parent().remove();
    }); // Manager: Assign school classes.

    var assignClassesFormId = '#wlsm-assign-classes-form';
    var assignClassesForm = $(assignClassesFormId);
    var assignClassesBtn = $('#wlsm-assign-classes-btn');
    assignClassesForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(assignClassesBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, assignClassesFormId);
          toastr.success(response.data.message); // schoolClassesTable.DataTable().ajax.reload(null, false);

          window.location.reload();
          $('.wlsm_school_classes').html('');
        } else {
          wlsmDisplayFormErrors(response, assignClassesFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, assignClassesFormId, assignClassesBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(assignClassesBtn);
      }
    }); // Manager: Add new or existing admin user.

    var existingUser = $('.wlsm-assign-exisitng-user');
    var newUser = $('.wlsm-assign-new-user');
    $(document).on('change', 'input[name="new_or_existing"]', function (event) {
      var user = this.value;
      $('.wlsm-assign-user').hide();

      if ('new_user' === user) {
        newUser.fadeIn();
      } else {
        existingUser.fadeIn();
      }
    }); // Manager: Assign school admin.

    var assignAdminFormId = '#wlsm-assign-admin-form';
    var assignAdminForm = $(assignAdminFormId);
    var assignAdminBtn = $('#wlsm-assign-admin-btn');
    assignAdminForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(assignAdminBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, assignAdminFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          } else if (response.data.hasOwnProperty('reset') && response.data.reset) {
            assignAdminForm[0].reset();
          }

          schoolAdminsTable.DataTable().ajax.reload(null, false);
        } else {
          wlsmDisplayFormErrors(response, assignAdminFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, assignAdminFormId, assignAdminBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(assignAdminBtn);
      }
    }); // Manager: Save new or existing admin user.

    var saveAdminExistingUser = $('.wlsm-school-admin-existing-user');
    var saveAdminNewUser = $('.wlsm-school-admin-new-user');
    $(document).on('change', 'input[name="save_new_or_existing"]', function (event) {
      var user = this.value;
      $('.wlsm-save-school-admin').hide();

      if ('new_user' === user) {
        saveAdminNewUser.fadeIn();
      } else {
        saveAdminExistingUser.fadeIn();
      }
    }); // Manager: Save school admin.

    var saveSchoolAdminFormId = '#wlsm-save-school-admin-form';
    var saveSchoolAdminForm = $(saveSchoolAdminFormId);
    var saveSchoolAdminBtn = $('#wlsm-save-school-admin-btn');
    saveSchoolAdminForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolAdminBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolAdminFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolAdminFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolAdminFormId, saveSchoolAdminBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolAdminBtn);
      }
    }); // Manager: Delete school admin.

    $(document).on('click', '.wlsm-delete-school-admin', function (event) {
      var staffId = $(this).data('admin');
      var nonce = $(this).data('nonce');
      var data = "staff_id=" + staffId + "&delete-school-admin-" + staffId + "=" + nonce + "&action=wlsm-delete-school-admin";

      var performActions = function performActions() {
        schoolAdminsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Manager: Save class.

    var saveClassFormId = '#wlsm-save-class-form';
    var saveClassForm = $(saveClassFormId);
    var saveClassBtn = $('#wlsm-save-class-btn');
    saveClassForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveClassBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveClassFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          } else if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveClassForm[0].reset();
          } else {
            $('.wlsm-page-heading-box').load(location.href + " " + '.wlsm-page-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveClassFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveClassFormId, saveClassBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveClassBtn);
      }
    }); // Manager: Delete class.

    $(document).on('click', '.wlsm-delete-class', function (event) {
      var classId = $(this).data('class');
      var nonce = $(this).data('nonce');
      var data = "class_id=" + classId + "&delete-class-" + classId + "=" + nonce + "&action=wlsm-delete-class";

      var performActions = function performActions() {
        classesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Manager: Save session.

    var saveSessionFormId = '#wlsm-save-session-form';
    var saveSessionForm = $(saveSessionFormId);
    var saveSessionBtn = $('#wlsm-save-session-btn');
    saveSessionForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSessionBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSessionFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          } else if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveSessionForm[0].reset();
          } else {
            $('.wlsm-page-heading-box').load(location.href + " " + '.wlsm-page-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveSessionFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSessionFormId, saveSessionBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSessionBtn);
      }
    }); // Manager: Delete session.

    $(document).on('click', '.wlsm-delete-session', function (event) {
      var sessionId = $(this).data('session');
      var nonce = $(this).data('nonce');
      var data = "session_id=" + sessionId + "&delete-session-" + sessionId + "=" + nonce + "&action=wlsm-delete-session";

      var performActions = function performActions() {
        sessionsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Session start date.

    $('#wlsm_start_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true,
      view: 'years'
    }); // Session end date.

    $('#wlsm_end_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true,
      view: 'years'
    }); // Manager: Save general settings.

    var saveGeneralSettingsFormId = '#wlsm-save-general-settings-form';
    var saveGeneralSettingsForm = $(saveGeneralSettingsFormId);
    var saveGeneralSettingsBtn = $('#wlsm-save-general-settings-btn');
    saveGeneralSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveGeneralSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveGeneralSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          } else if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveGeneralSettingsForm[0].reset();
          } else {
            $('.wlsm-page-heading-box').load(location.href + " " + '.wlsm-page-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveGeneralSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveGeneralSettingsFormId, saveGeneralSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveGeneralSettingsBtn);
      }
    }); // Manager: Save uninstall settings.

    var saveUninstallSettingsFormId = '#wlsm-save-uninstall-settings-form';
    var saveUninstallSettingsForm = $(saveUninstallSettingsFormId);
    var saveUninstallSettingsBtn = $('#wlsm-save-uninstall-settings-btn');
    saveUninstallSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveUninstallSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveUninstallSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          } else if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveUninstallSettingsForm[0].reset();
          }
        } else {
          wlsmDisplayFormErrors(response, saveUninstallSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveUninstallSettingsFormId, saveUninstallSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveUninstallSettingsBtn);
      }
    }); // Manager: Reset plugin.

    var resetPluginFormId = '#wlsm-reset-plugin-form';
    var resetPluginForm = $(resetPluginFormId);
    var resetPluginBtn = $('#wlsm-reset-plugin-btn');
    $(document).on('click', '#wlsm-reset-plugin-btn', function (event) {
      $.confirm({
        title: resetPluginBtn.data('message-title'),
        content: resetPluginBtn.data('message-content'),
        type: 'red',
        useBootstrap: false,
        buttons: {
          confirm: {
            text: resetPluginBtn.data('submit'),
            btnClass: 'btn-red',
            action: function action() {
              resetPluginForm.ajaxSubmit({
                beforeSubmit: function beforeSubmit(arr, $form, options) {
                  return wlsmBeforeSubmit(resetPluginBtn);
                },
                success: function success(response) {
                  if (response.success) {
                    wlsmShowSuccessAlert(response.data.message, resetPluginFormId);
                    toastr.success(response.data.message);

                    if (response.data.hasOwnProperty('reload') && response.data.reload) {
                      window.location.reload();
                    } else if (response.data.hasOwnProperty('reset') && response.data.reset) {
                      resetPluginForm[0].reset();
                    }
                  } else {
                    wlsmDisplayFormErrors(response, resetPluginFormId);
                  }
                },
                error: function error(response) {
                  wlsmDisplayFormError(response, resetPluginFormId, resetPluginBtn);
                },
                complete: function complete(event, xhr, settings) {
                  wlsmComplete(resetPluginBtn);
                }
              });
            }
          },
          cancel: {
            text: resetPluginBtn.data('cancel'),
            action: function action() {
              return;
            }
          }
        }
      });
    }); // Staff: Set staff school.

    $(document).on('click', '.wlsm-staff-school-card-link', function (event) {
      var nonce = $(this).data('nonce');
      var school = $(this).data('school');
      $.ajax({
        data: "school=" + school + "&set-school-" + school + "=" + nonce + "&action=wlsm-staff-set-school",
        url: ajaxurl,
        type: 'POST',
        beforeSend: function beforeSend(xhr) {
          $('.wlsm .alert-dismissible').remove();
        },
        success: function success(response) {
          if (response.success) {
            toastr.success(response.data.message);
            window.location.href = response.data.url;
          } else {
            if (response.data) {
              toastr.error(response.data);
            }
          }
        },
        error: function error(response) {
          if (response.data) {
            toastr.error(response.data);
          }
        }
      });
    }); // Staff: Set current session.

    $(document).on('change', '#wlsm_user_current_session', function (event) {
      var nonce = $(this).find(':selected').data('nonce');
      var session = this.value;
      $.ajax({
        data: "session=" + session + "&set-session-" + session + "=" + nonce + "&action=wlsm-staff-set-session",
        url: ajaxurl,
        type: 'POST',
        beforeSend: function beforeSend(xhr) {
          $('.wlsm .alert-dismissible').remove();
        },
        success: function success(response) {
          if (response.success) {
            toastr.success(response.data.message);
            window.location.reload();
          } else {
            if (response.data) {
              toastr.error(response.data);
            }
          }
        },
        error: function error(response) {
          if (response.data) {
            toastr.error(response.data);
          }
        }
      });
    }); // Staff: Classes Table.

    var staffClassesTable = $('#wlsm-staff-classes-table');
    wlsmInitializeTable(staffClassesTable, {
      action: 'wlsm-fetch-staff-classes'
    }); // Staff: Class Sections Table.

    var classSectionsTable = $('#wlsm-class-sections-table');
    var classSchool = classSectionsTable.data('class-school');
    var nonce = classSectionsTable.data('nonce');

    if (classSchool && nonce) {
      var data = {
        action: 'wlsm-fetch-class-sections',
        'class_school': classSchool
      };
      data['class-sections-' + classSchool] = nonce;
      wlsmInitializeTable(classSectionsTable, data);
    } // Staff: Save class sections.


    var saveSectionFormId = '#wlsm-save-section-form';
    var saveSectionForm = $(saveSectionFormId);
    var saveSectionBtn = $('#wlsm-save-section-btn');
    saveSectionForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSectionBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSectionFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveSectionForm[0].reset();
            classSectionsTable.DataTable().ajax.reload(null, false);
          } else {
            $('.wlsm-page-heading-box').load(location.href + " " + '.wlsm-page-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveSectionFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSectionFormId, saveSectionBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSectionBtn);
      }
    }); // Staff: Delete class section.

    $(document).on('click', '.wlsm-delete-section', function (event) {
      event.preventDefault();
      var sectionId = $(this).data('section');
      var classId = $(this).data('class');
      var nonce = $(this).data('nonce');
      var data = "class_id=" + classId + "&section_id=" + sectionId + "&delete-section-" + sectionId + "=" + nonce + "&action=wlsm-delete-section";

      var performActions = function performActions() {
        classSectionsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Date of birth.

    $('#wlsm_date_of_birth').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true,
      view: 'years',
      direction: false
    }); // Enrollment date.

    $('#wlsm_admission_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    }); // Staff: Add new or existing student user.

    var studentNewUser = $('.wlsm-student-new-user');
    var studentExistingUser = $('.wlsm-student-existing-user');
    var studentUser = $('input[name="student_new_or_existing"]:checked').val();

    if ('new_user' === studentUser) {
      studentExistingUser.fadeIn();
      studentNewUser.fadeIn();
    } else if ('existing_user' === studentUser) {
      studentExistingUser.fadeIn();
      studentNewUser.hide();
    } else {
      studentExistingUser.hide();
      studentNewUser.hide();
    }

    $(document).on('change', 'input[name="student_new_or_existing"]', function (event) {
      var studentUser = this.value;

      if ('new_user' === studentUser) {
        studentExistingUser.hide();
        studentNewUser.fadeIn();
      } else if ('existing_user' === studentUser) {
        studentNewUser.hide();
        studentExistingUser.fadeIn();
      } else {
        studentExistingUser.hide();
        studentNewUser.hide();
      }
    }); // Staff: Add new or existing parent user.

    var parentNewUser = $('.wlsm-parent-new-user');
    var parentExistingUser = $('.wlsm-parent-existing-user');
    var parentUser = $('input[name="parent_new_or_existing"]:checked').val();

    if ('new_user' === parentUser) {
      parentExistingUser.fadeIn();
      parentNewUser.fadeIn();
    } else if ('existing_user' === parentUser) {
      parentExistingUser.fadeIn();
      parentNewUser.hide();
    } else {
      parentExistingUser.hide();
      parentNewUser.hide();
    }

    $(document).on('change', 'input[name="parent_new_or_existing"]', function (event) {
      var parentUser = this.value;

      if ('new_user' === parentUser) {
        parentExistingUser.hide();
        parentNewUser.fadeIn();
      } else if ('existing_user' === parentUser) {
        parentNewUser.hide();
        parentExistingUser.fadeIn();
      } else {
        parentExistingUser.hide();
        parentNewUser.hide();
      }
    }); // Custom file input.

    $(document).on('change', '.custom-file-input', function () {
      var fileName = $(this).val().split('\\').pop();
      $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
    }); // Staff: Add admission.

    var addAdmissionFormId = '#wlsm-add-admission-form';
    var addAdmissionForm = $(addAdmissionFormId);
    var addAdmissionBtn = $('#wlsm-add-admission-btn');
    addAdmissionForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(addAdmissionBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, addAdmissionFormId);
          toastr.success(response.data.message);
          addAdmissionForm[0].reset();
          var selectPicker = $('.selectpicker');
          selectPicker.selectpicker('refresh');
          $('.wlsm-photo-box').load(location.href + " " + '.wlsm-photo-section', function () {});
          $('.wlsm-id-proof-box').load(location.href + " " + '.wlsm-id-proof-section', function () {});
          $('.wlsm-parent-id-proof-box').load(location.href + " " + '.wlsm-parent-id-proof-section', function () {});
        } else {
          wlsmDisplayFormErrors(response, addAdmissionFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, addAdmissionFormId, addAdmissionBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(addAdmissionBtn);
      }
    }); // Staff: Edit student.

    var editStudentFormId = '#wlsm-edit-student-form';
    var editStudentForm = $(editStudentFormId);
    var editStudentBtn = $('#wlsm-edit-student-btn');
    editStudentForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(editStudentBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, editStudentFormId);
          toastr.success(response.data.message);
          window.location.reload();
        } else {
          wlsmDisplayFormErrors(response, editStudentFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, editStudentFormId, editStudentBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(editStudentBtn);
      }
    }); // Staff: Search students.

    var searchKeywordStudents = $('.wlsm-search-keyword-students');
    var searchClassStudents = $('.wlsm-search-class-students');
    $(document).on('change', 'input[name="search_students_by"]', function (event) {
      var searchBy = this.value;
      $('.wlsm-search-students').hide();

      if ('search_by_class' === searchBy) {
        searchKeywordStudents.hide();
        searchClassStudents.fadeIn();
      } else {
        searchClassStudents.hide();
        searchKeywordStudents.fadeIn();
      }
    });

    $.fn.serializeObject = function () {
      var o = {};
      var a = this.serializeArray();
      $.each(a, function () {
        if (o[this.name]) {
          if (!o[this.name].push) {
            o[this.name] = [o[this.name]];
          }

          o[this.name].push(this.value || '');
        } else {
          o[this.name] = this.value || '';
        }
      });
      return o;
    }; // Staff: Students Table.


    function wlsmInitializeStudentsTable() {
      var data = $('#wlsm-get-students-form').serializeObject();
      data['from_table'] = true;
      wlsmInitializeTable($('#wlsm-staff-students-table'), data, true, [0]);
    }

    wlsmInitializeStudentsTable();
    $(document).on('click', '#wlsm-get-students-btn', function (event) {
      event.preventDefault();
      var getStudentsFormId = '#wlsm-get-students-form';
      var getStudentsForm = $(getStudentsFormId);
      var getStudentsBtn = $('#wlsm-get-students-btn');
      getStudentsForm.ajaxSubmit({
        beforeSubmit: function beforeSubmit(arr, $form, options) {
          return wlsmBeforeSubmit(getStudentsBtn);
        },
        success: function success(response) {
          if (response.success) {
            $('#wlsm-staff-students-table').DataTable().clear().destroy();
            wlsmInitializeStudentsTable();
          } else {
            wlsmDisplayFormErrors(response, getStudentsFormId);
          }
        },
        error: function error(response) {
          wlsmDisplayFormError(response, getStudentsFormId, getStudentsBtn);
        },
        complete: function complete(event, xhr, settings) {
          wlsmComplete(getStudentsBtn);
        }
      });
    }); // Add more fee.

    var feesBox = $('.wlsm-fees-box');
    var ftFeeType = feesBox.data('fee-type');
    var ftFeeTypePlaceholder = feesBox.data('fee-type-placeholder');
    var ftFeePeriod = feesBox.data('fee-period');
    var ftFeeAmount = feesBox.data('fee-amount');
    var ftAmountPlaceholder = feesBox.data('fee-amount-placeholder');
    var ftFeePeriods = feesBox.data('fee-periods');
    feesBox.sortable({
      placeholder: '',
      revert: true
    });
    $(document).on('click', '.wlsm-add-fee-btn', function () {
      var feesCount = $('.wlsm-fee-box:last').data('fee');

      if (feesCount === undefined) {
        feesCount = 0;
      }

      feesCount++;
      var id = feesCount;
      var feePeriods = '<select name="fee_period[]" class="form-control selectpicker wlsm_fee_period_selectpicker" id="wlsm_fee_period_' + id + '">';
      $.each(ftFeePeriods, function (key, value) {
        feePeriods += '<option value="' + key + '">' + value;
        feePeriods += '</option>';
      });
      feePeriods += '</select>';
      feesBox.append('' + '<div class="wlsm-fee-box card col" data-fee="' + id + '">' + '<button type="button" class="btn btn-sm btn-danger wlsm-remove-fee-btn"><i class="fas fa-times"></i></button>' + '<div class="form-row">' + '<div class="form-group col-md-4">' + '<label for="wlsm_fee_label_' + id + '" class="wlsm-font-bold"><span class="wlsm-important">*</span> ' + ftFeeType + ':' + '</label>' + '<input type="text" name="fee_label[]" class="form-control" id="wlsm_fee_label_' + id + '" placeholder="' + ftFeeTypePlaceholder + '" value="">' + '</div>' + '<div class="form-group col-md-4">' + '<label for="wlsm_fee_period_' + id + '" class="wlsm-font-bold"><span class="wlsm-important">*</span> ' + ftFeePeriod + ':' + '</label>' + feePeriods + '</div>' + '<div class="form-group col-md-4">' + '<label for="wlsm_fee_amount_' + id + '" class="wlsm-font-bold"><span class="wlsm-important">*</span> ' + ftFeeAmount + ':' + '</label>' + '<input type="number" step="1" min="1" name="fee_amount[]" class="form-control" id="wlsm_fee_amount_' + id + '" placeholder="' + ftAmountPlaceholder + '" value="">' + '</div>' + '</div>' + '</div>'); // Fee periods select picker.

      $('.wlsm_fee_period_selectpicker').selectpicker();
    }); // Remove fee.

    $(document).on('click', '.wlsm-remove-fee-btn', function () {
      if (feesBox.children().size() > 0) {
        $(this).parent().fadeOut(300, function () {
          $(this).remove();
        });
      }
    }); // Staff: Get student session records.

    $(document).on('click', '.wlsm-view-session-records', function (event) {
      var element = $(this);
      var studentId = element.data('student');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['student_id'] = studentId;
      data['view-session-records-' + studentId] = nonce;
      data['action'] = 'wlsm-view-session-records';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        useBootstrap: false,
        columnClass: 'medium'
      });
    }); // Staff: Get student attendance report.

    $(document).on('click', '.wlsm-view-attendance-report', function (event) {
      var element = $(this);
      var studentId = element.data('student');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['student_id'] = studentId;
      data['view-attendance-report-' + studentId] = nonce;
      data['action'] = 'wlsm-view-attendance-report';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        useBootstrap: true,
        columnClass: 'large',
        containerFluid: true
      });
    }); // Staff: Get student detail report.

    $(document).on('click', '.wlsm-view-student-detail', function (event) {
      var element = $(this);
      var studentId = element.data('student');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['student_id'] = studentId;
      data['view-student-detail-' + studentId] = nonce;
      data['action'] = 'wlsm-view-student-detail';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        useBootstrap: true,
        columnClass: 'large',
        containerFluid: true
      });
    }); // Staff: Get staff attendance report.

    $(document).on('click', '.wlsm-view-staff-attendance-report', function (event) {
      var element = $(this);
      var staffId = element.data('staff');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['staff_id'] = staffId;
      data['view-staff-attendance-report-' + staffId] = nonce;
      data['action'] = 'wlsm-view-staff-attendance-report';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        useBootstrap: true,
        columnClass: 'large',
        containerFluid: true
      });
    }); // Staff: Delete student.

    $(document).on('click', '.wlsm-delete-student', function (event) {
      event.preventDefault();
      var studentId = $(this).data('student');
      var nonce = $(this).data('nonce');
      var data = "student_id=" + studentId + "&delete-student-" + studentId + "=" + nonce + "&action=wlsm-delete-student";

      var performActions = function performActions() {
        $('#wlsm-staff-students-table').DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Student sample CSV export.

    $(document).on('click', '#wlsm-student-sample-csv-export-btn', function (e) {
      var nonce = $(this).data('nonce');
      var formId = 'wlsm-student-sample-csv-export-form';
      var classId = $('#wlsm_class').val();
      var sectionId = $('#wlsm_section').val();
      var form = '' + '<form action="' + ajaxurl + '" method="post" id="' + formId + '">' + '<input type="hidden" name="nonce" value="' + nonce + '">' + '<input type="hidden" name="action" value="wlsm-student-sample-csv-export">' + '<input type="hidden" name="class_id" value="' + classId + '">' + '<input type="hidden" name="section_id" value="' + sectionId + '">' + '</form>' + '';
      $('#' + formId).remove();
      $(document.body).append(form);
      $('#' + formId).submit();
    }); // Staff: Bulk import students.

    var bulkImportStudentFormId = '#wlsm-bulk-import-student-form';
    var bulkImportStudentForm = $(bulkImportStudentFormId);
    var bulkImportStudentBtn = $('#wlsm-bulk-import-student-btn');
    $(document).on('click', '#wlsm-bulk-import-student-btn', function (e) {
      var bulkImportStudentBtn = $(this);
      e.preventDefault();
      $.confirm({
        title: bulkImportStudentBtn.data('message-title'),
        content: bulkImportStudentBtn.data('message-content'),
        type: 'green',
        useBootstrap: false,
        buttons: {
          confirm: {
            text: bulkImportStudentBtn.data('submit'),
            btnClass: 'btn-success',
            action: function action() {
              bulkImportStudentForm.ajaxSubmit({
                beforeSubmit: function beforeSubmit(arr, $form, options) {
                  return wlsmBeforeSubmit(bulkImportStudentBtn);
                },
                success: function success(response) {
                  if (response.success) {
                    wlsmShowSuccessAlert(response.data.message, bulkImportStudentFormId);
                    toastr.success(response.data.message);
                  } else {
                    wlsmDisplayFormErrors(response, bulkImportStudentFormId);
                  }
                },
                error: function error(response) {
                  wlsmDisplayFormError(response, bulkImportStudentFormId, bulkImportStudentBtn);
                },
                complete: function complete(event, xhr, settings) {
                  wlsmComplete(bulkImportStudentBtn);
                }
              });
            }
          },
          cancel: {
            text: bulkImportStudentBtn.data('cancel'),
            action: function action() {
              return;
            }
          }
        }
      });
    }); // Staff: Print Bulk ID Cards.

    var saveBulkIDCardsFormId = '#wlsm-print-bulk-id-cards-form';
    var saveBulkIDCardsForm = $(saveBulkIDCardsFormId);
    var saveBulkIDCardsBtn = $('#wlsm-print-bulk-id-cards-btn');
    saveBulkIDCardsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveBulkIDCardsBtn);
      },
      success: function success(response) {
        if (response.success) {
          var data = JSON.parse(response.data.json);
          $.dialog({
            title: data.message_title,
            content: response.data.html,
            theme: 'bootstrap',
            useBootstrap: true,
            columnClass: 'xlarge',
            containerFluid: true,
            backgroundDismiss: true
          });
        } else {
          wlsmDisplayFormErrors(response, saveBulkIDCardsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveBulkIDCardsFormId, saveBulkIDCardsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveBulkIDCardsBtn);
      }
    }); // Staff: Print ID Card.

    $(document).on('click', '.wlsm-print-id-card', function (event) {
      var element = $(this);
      var studentId = element.data('id-card');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['student_id'] = studentId;
      data['print-id-card-' + studentId] = nonce;
      data['action'] = 'wlsm-print-id-card';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        useBootstrap: false,
        columnClass: 'large',
        backgroundDismiss: true
      });
    }); // Staff: Print fee structure.

    $(document).on('click', '.wlsm-print-fee-structure', function (event) {
      var element = $(this);
      var studentId = element.data('fee-structure');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['student_id'] = studentId;
      data['print-fee-structure-' + studentId] = nonce;
      data['action'] = 'wlsm-print-fee-structure';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        useBootstrap: false,
        columnClass: 'large',
        backgroundDismiss: true
      });
    }); // Staff: Manage promotion.

    var promoteStudentFormId = '#wlsm-promote-student-form';
    var promoteStudentForm = $(promoteStudentFormId);
    var managePromotionBtn = $('#wlsm-manage-promotion-btn');
    $(document).on('click', '#wlsm-manage-promotion-btn', function (e) {
      var studentsToPromote = $('.wlsm-students-to-promote');
      var promoteToSession = $('#wlsm-promote-to-session').val();
      var fromClass = $('#wlsm_from_class').val();
      var toClass = $('#wlsm_to_class').val();
      var nonce = $(this).data('nonce');
      var data = {};
      data['promote_to_session'] = promoteToSession;
      data['from_class'] = fromClass;
      data['to_class'] = toClass;
      data['nonce'] = nonce;
      data['action'] = 'wlsm-manage-promotion';

      if (nonce) {
        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          beforeSend: function beforeSend() {
            return wlsmBeforeSubmit(managePromotionBtn);
          },
          success: function success(response) {
            if (response.success) {
              studentsToPromote.html(response.data.html);
            } else {
              wlsmDisplayFormErrors(response, promoteStudentFormId);
            }
          },
          error: function error(response) {
            wlsmDisplayFormError(response, getStudentsFormId, managePromotionBtn);
          },
          complete: function complete(event, xhr, settings) {
            wlsmComplete(managePromotionBtn);
          }
        });
      } else {
        studentsToPromote.html('');
      }
    }); // Staff: Promote student.

    $(document).on('click', '#wlsm-promote-student-btn', function (e) {
      var promoteStudentBtn = $(this);
      e.preventDefault();
      $.confirm({
        title: promoteStudentBtn.data('message-title'),
        content: promoteStudentBtn.data('message-content'),
        type: 'green',
        useBootstrap: false,
        buttons: {
          confirm: {
            text: promoteStudentBtn.data('submit'),
            btnClass: 'btn-success',
            action: function action() {
              promoteStudentForm.ajaxSubmit({
                beforeSubmit: function beforeSubmit(arr, $form, options) {
                  return wlsmBeforeSubmit(promoteStudentBtn);
                },
                success: function success(response) {
                  if (response.success) {
                    wlsmShowSuccessAlert(response.data.message, promoteStudentFormId);
                    toastr.success(response.data.message);
                    window.location.reload();
                  } else {
                    wlsmDisplayFormErrors(response, promoteStudentFormId);
                  }
                },
                error: function error(response) {
                  wlsmDisplayFormError(response, promoteStudentFormId, promoteStudentBtn);
                },
                complete: function complete(event, xhr, settings) {
                  wlsmComplete(promoteStudentBtn);
                }
              });
            }
          },
          cancel: {
            text: promoteStudentBtn.data('cancel'),
            action: function action() {
              return;
            }
          }
        }
      });
    });
    $(document).on('change', '#wlsm-select-all', function () {
      if ($(this).is(':checked')) {
        $('.wlsm-select-single').prop('checked', true);
      } else {
        $('.wlsm-select-single').prop('checked', false);
      }
    }); // Staff: Transfer student.

    var transferStudentFormId = '#wlsm-transfer-student-form';
    var transferStudentForm = $(transferStudentFormId);
    var transferStudentBtn = $('#wlsm-transfer-student-btn');
    $(document).on('click', '#wlsm-transfer-student-btn', function (e) {
      var transferStudentBtn = $(this);
      e.preventDefault();
      $.confirm({
        title: transferStudentBtn.data('message-title'),
        content: transferStudentBtn.data('message-content'),
        type: 'green',
        useBootstrap: false,
        buttons: {
          confirm: {
            text: transferStudentBtn.data('submit'),
            btnClass: 'btn-success',
            action: function action() {
              transferStudentForm.ajaxSubmit({
                beforeSubmit: function beforeSubmit(arr, $form, options) {
                  return wlsmBeforeSubmit(transferStudentBtn);
                },
                success: function success(response) {
                  if (response.success) {
                    wlsmShowSuccessAlert(response.data.message, transferStudentFormId);
                    toastr.success(response.data.message);
                    window.location.reload();
                  } else {
                    wlsmDisplayFormErrors(response, transferStudentFormId);
                  }
                },
                error: function error(response) {
                  wlsmDisplayFormError(response, transferStudentFormId, transferStudentBtn);
                },
                complete: function complete(event, xhr, settings) {
                  wlsmComplete(transferStudentBtn);
                }
              });
            }
          },
          cancel: {
            text: transferStudentBtn.data('cancel'),
            action: function action() {
              return;
            }
          }
        }
      });
    }); // Staff: Admins Table.

    var adminsTable = $('#wlsm-staff-admin-table');
    wlsmInitializeTable(adminsTable, {
      action: 'wlsm-fetch-staff-admins'
    }); // Staff: Table.

    var staffTable = $('#wlsm-staff-table');
    var staffRole = staffTable.data('role');
    wlsmInitializeTable(staffTable, {
      action: 'wlsm-fetch-staff-' + staffRole
    }); // Staff: Add new or existing staff user.

    var staffNewUser = $('.wlsm-staff-new-user');
    var staffExistingUser = $('.wlsm-staff-existing-user');
    var staffUser = $('input[name="staff_new_or_existing"]:checked').val();

    if ('new_user' === staffUser) {
      staffExistingUser.fadeIn();
      staffNewUser.fadeIn();
    } else if ('existing_user' === staffUser) {
      staffExistingUser.fadeIn();
      staffNewUser.hide();
    } else {
      staffExistingUser.hide();
      staffNewUser.hide();
    }

    $(document).on('change', 'input[name="staff_new_or_existing"]', function (event) {
      var staffUser = this.value;

      if ('new_user' === staffUser) {
        staffExistingUser.hide();
        staffNewUser.fadeIn();
      } else if ('existing_user' === staffUser) {
        staffNewUser.hide();
        staffExistingUser.fadeIn();
      } else {
        staffExistingUser.hide();
        staffNewUser.hide();
      }
    }); // Joining date.

    $('#wlsm_joining_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    });
    $(document).on('change', '#wlsm_role', function () {
      var role = this.value;
      var nonce = $(this).data('nonce');
      var permissions = $('input[name="permission[]');

      if (role && nonce) {
        $.ajax({
          data: 'action=wlsm-get-role-permissions&nonce=' + nonce + '&role_id=' + role,
          url: ajaxurl,
          type: 'POST',
          success: function success(res) {
            if ($.isArray(res)) {
              permissions.each(function (permisson) {
                if ($.inArray(this.value, res) > -1) {
                  $(this).prop('checked', true);
                  $(this).prop('disabled', true);
                } else {
                  $(this).prop('checked', false);
                  $(this).prop('disabled', false);
                }
              });
            }
          }
        });
      } else {
        permissions.prop('disabled', false);
      }
    }); // Staff: Save staff.

    var saveStaffFormId = '#wlsm-save-staff-form';
    var saveStaffForm = $(saveStaffFormId);
    var saveStaffBtn = $('#wlsm-save-staff-btn');
    saveStaffForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveStaffBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveStaffFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          } else {
            saveStaffForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          }
        } else {
          wlsmDisplayFormErrors(response, saveStaffFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveStaffFormId, saveStaffBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveStaffBtn);
      }
    }); // Bus in-charge.

    var vehicleInCharge = $('.wlsm-vehicle-incharge');
    var isBusInCharge = $('input[name="is_vehicle_incharge"]:checked').val();

    if ('1' === isBusInCharge) {
      vehicleInCharge.show();
    }

    $(document).on('change', 'input[name="is_vehicle_incharge"]', function () {
      var isBusInCharge = this.value;

      if ('1' === isBusInCharge) {
        vehicleInCharge.fadeIn();
      } else {
        vehicleInCharge.fadeOut();
      }
    }); // Staff: Delete staff.

    $(document).on('click', '.wlsm-delete-staff', function (event) {
      event.preventDefault();
      var staffId = $(this).data('staff');
      var nonce = $(this).data('nonce');
      var role = $(this).data('role');
      var data = "staff_id=" + staffId + "&delete-staff-" + staffId + "=" + nonce + "&action=wlsm-delete-" + role;

      var performActions = function performActions() {
        staffTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Roles Table.

    var rolesTable = $('#wlsm-roles-table');
    wlsmInitializeTable(rolesTable, {
      action: 'wlsm-fetch-roles'
    }); // Staff: Save role.

    var saveRoleFormId = '#wlsm-save-role-form';
    var saveRoleForm = $(saveRoleFormId);
    var saveRoleBtn = $('#wlsm-save-role-btn');
    saveRoleForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveRoleBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveRoleFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveRoleForm[0].reset();
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveRoleFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveRoleFormId, saveRoleBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveRoleBtn);
      }
    }); // Staff: Delete role.

    $(document).on('click', '.wlsm-delete-role', function (event) {
      var roleId = $(this).data('role');
      var nonce = $(this).data('nonce');
      var data = "role_id=" + roleId + "&delete-role-" + roleId + "=" + nonce + "&action=wlsm-delete-role";

      var performActions = function performActions() {
        rolesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Certificates Table.

    var certificatesTable = $('#wlsm-certificates-table');
    wlsmInitializeTable(certificatesTable, {
      action: 'wlsm-fetch-certificates'
    }); // Staff: Save certificate.

    var saveCertificateFormId = '#wlsm-save-certificate-form';
    var saveCertificateForm = $(saveCertificateFormId);
    var saveCertificateBtn = $('#wlsm-save-certificate-btn');
    saveCertificateForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveCertificateBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveCertificateFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveCertificateForm[0].reset();
          }

          window.location.href = response.data.url;
        } else {
          wlsmDisplayFormErrors(response, saveCertificateFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveCertificateFormId, saveCertificateBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveCertificateBtn);
      }
    }); // Staff: Delete certificate.

    $(document).on('click', '.wlsm-delete-certificate', function (event) {
      var certificateId = $(this).data('certificate');
      var nonce = $(this).data('nonce');
      var data = "certificate_id=" + certificateId + "&delete-certificate-" + certificateId + "=" + nonce + "&action=wlsm-delete-certificate";

      var performActions = function performActions() {
        certificatesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Distribute certificate.

    var distributeCertificateFormId = '#wlsm-distribute-certificate-form';
    var distributeCertificateForm = $(distributeCertificateFormId);
    var distributeCertificateBtn = $('#wlsm-distribute-certificate-btn');
    distributeCertificateForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(distributeCertificateBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, distributeCertificateFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            distributeCertificateForm[0].reset();
          }

          window.location.href = response.data.url;
        } else {
          wlsmDisplayFormErrors(response, distributeCertificateFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, distributeCertificateFormId, distributeCertificateBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(distributeCertificateBtn);
      }
    }); // Staff: Certificates Distributed Table.

    var certificatesDistributedTable = $('#wlsm-certificates-distributed-table');
    var certificate = certificatesDistributedTable.data('certificate');
    var nonce = certificatesDistributedTable.data('nonce');

    if (certificate && nonce) {
      var data = {
        action: 'wlsm-fetch-certificates-distributed',
        'certificate': certificate
      };
      data['certificate-' + certificate] = nonce;
      wlsmInitializeTable(certificatesDistributedTable, data);
    } // Staff: Delete certificate distributed.


    $(document).on('click', '.wlsm-delete-certificate-distributed', function (event) {
      event.preventDefault();
      var certificateDistributedId = $(this).data('certificate-distributed');
      var nonce = $(this).data('nonce');
      var data = "certificate_student_id=" + certificateDistributedId + "&delete-certificate-distributed-" + certificateDistributedId + "=" + nonce + "&action=wlsm-delete-certificate-distributed";

      var performActions = function performActions() {
        certificatesDistributedTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Send notification.

    var sendNotificationFormId = '#wlsm-send-notification-form';
    var sendNotificationForm = $(sendNotificationFormId);
    var sendNotificationBtn = $('#wlsm-send-notification-btn');
    sendNotificationForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(sendNotificationBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, sendNotificationFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            sendNotificationForm[0].reset();
          }
        } else {
          wlsmDisplayFormErrors(response, sendNotificationFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, sendNotificationFormId, sendNotificationBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(sendNotificationBtn);
      }
    }); // Date issued.

    $('#wlsm_date_issued').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    }); // Staff: Inquiries Table.

    var inquiriesTable = $('#wlsm-inquiries-table');
    wlsmInitializeTable(inquiriesTable, {
      action: 'wlsm-fetch-inquiries'
    }, true); // Staff: Get inquiry message.

    $(document).on('click', '.wlsm-view-inquiry-message', function (event) {
      var element = $(this);
      var inquiryId = element.data('inquiry');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['inquiry_id'] = inquiryId;
      data['view-inquiry-message-' + inquiryId] = nonce;
      data['action'] = 'wlsm-view-inquiry-message';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data);
            }
          });
        },
        theme: 'bootstrap',
        columnClass: 'medium'
      });
    }); // Inquiry next follow up date.

    $('#wlsm_inquiry_next_follow_up').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    }); // Staff: Save inquiry.

    var saveInquiryFormId = '#wlsm-save-inquiry-form';
    var saveInquiryForm = $(saveInquiryFormId);
    var saveInquiryBtn = $('#wlsm-save-inquiry-btn');
    saveInquiryForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveInquiryBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveInquiryFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveInquiryForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveInquiryFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveInquiryFormId, saveInquiryBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveInquiryBtn);
      }
    }); // Staff: Delete inquiry.

    $(document).on('click', '.wlsm-delete-inquiry', function (event) {
      event.preventDefault();
      var inquiryId = $(this).data('inquiry');
      var nonce = $(this).data('nonce');
      var data = "inquiry_id=" + inquiryId + "&delete-inquiry-" + inquiryId + "=" + nonce + "&action=wlsm-delete-inquiry";

      var performActions = function performActions() {
        inquiriesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Notices Table.

    var noticesTable = $('#wlsm-notices-table');
    wlsmInitializeTable(noticesTable, {
      action: 'wlsm-fetch-notices'
    }); // Notice link.

    var noticeAttachment = $('.wlsm-notice-attachment');
    var noticeUrl = $('.wlsm-notice-url');
    var noticeLinkTo = $('input[name="link_to"]:checked').val();

    if ('attachment' === noticeLinkTo) {
      noticeAttachment.show();
    } else if ('url' === noticeLinkTo) {
      noticeUrl.show();
    } // On change notice link.


    $(document).on('change', 'input[name="link_to"]', function () {
      var noticeLinkTo = this.value;
      var noticeLink = $('.wlsm-notice-link');
      noticeLink.hide();

      if ('attachment' === noticeLinkTo) {
        noticeAttachment.fadeIn();
      } else if ('url' === noticeLinkTo) {
        noticeUrl.fadeIn();
      }
    }); // Staff: Save notice.

    var saveNoticeFormId = '#wlsm-save-notice-form';
    var saveNoticeForm = $(saveNoticeFormId);
    var saveNoticeBtn = $('#wlsm-save-notice-btn');
    saveNoticeForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveNoticeBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveNoticeFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveNoticeForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
            $('.wlsm-notice-link').hide();
            $('.wlsm-notice-url').show();
          } else {
            $('.wlsm-attachment-box').load(location.href + " " + '.wlsm-attachment-section', function () {});
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveNoticeFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveNoticeFormId, saveNoticeBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveNoticeBtn);
      }
    }); // Staff: Delete notice.

    $(document).on('click', '.wlsm-delete-notice', function (event) {
      var noticeId = $(this).data('notice');
      var nonce = $(this).data('nonce');
      var data = "notice_id=" + noticeId + "&delete-notice-" + noticeId + "=" + nonce + "&action=wlsm-delete-notice";

      var performActions = function performActions() {
        noticesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Events Table.

    var eventsTable = $('#wlsm-events-table');
    wlsmInitializeTable(eventsTable, {
      action: 'wlsm-fetch-events'
    }); // Event date.

    $('#wlsm_event_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    }); // Staff: Save event.

    var saveEventFormId = '#wlsm-save-event-form';
    var saveEventForm = $(saveEventFormId);
    var saveEventBtn = $('#wlsm-save-event-btn');
    saveEventForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveEventBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveEventFormId);
          toastr.success(response.data.message);
          window.location.reload();
        } else {
          wlsmDisplayFormErrors(response, saveEventFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveEventFormId, saveEventBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveEventBtn);
      }
    }); // Staff: Delete event.

    $(document).on('click', '.wlsm-delete-event', function (event) {
      var eventId = $(this).data('event');
      var nonce = $(this).data('nonce');
      var data = "event_id=" + eventId + "&delete-event-" + eventId + "=" + nonce + "&action=wlsm-delete-event";

      var performActions = function performActions() {
        eventsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Event Participants Table.

    var eventParticipantsTable = $('#wlsm-event-participants-table');
    var event = eventParticipantsTable.data('event');
    var nonce = eventParticipantsTable.data('nonce');

    if (event && nonce) {
      var data = {
        action: 'wlsm-fetch-event-participants',
        'event': event
      };
      data['event-' + event] = nonce;
      wlsmInitializeTable(eventParticipantsTable, data, true);
    } // Staff: Delete event participant.


    $(document).on('click', '.wlsm-delete-event-participant', function (event) {
      event.preventDefault();
      var eventParticipantId = $(this).data('event-participant');
      var nonce = $(this).data('nonce');
      var data = "event_participant_id=" + eventParticipantId + "&delete-event-participant-" + eventParticipantId + "=" + nonce + "&action=wlsm-delete-event-participant";

      var performActions = function performActions() {
        eventParticipantsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Subjects Table.

    var subjectsTable = $('#wlsm-subjects-table');
    wlsmInitializeTable(subjectsTable, {
      action: 'wlsm-fetch-subjects'
    }); // Staff: Save subject.

    var saveSubjectFormId = '#wlsm-save-subject-form';
    var saveSubjectForm = $(saveSubjectFormId);
    var saveSubjectBtn = $('#wlsm-save-subject-btn');
    saveSubjectForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSubjectBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSubjectFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveSubjectForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveSubjectFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSubjectFormId, saveSubjectBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSubjectBtn);
      }
    }); // Staff: Delete subject.

    $(document).on('click', '.wlsm-delete-subject', function (event) {
      var subjectId = $(this).data('subject');
      var nonce = $(this).data('nonce');
      var data = "subject_id=" + subjectId + "&delete-subject-" + subjectId + "=" + nonce + "&action=wlsm-delete-subject";

      var performActions = function performActions() {
        subjectsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Subject Admins Table.

    var subjectAdminsTable = $('#wlsm-subject-admins-table');
    var subject = subjectAdminsTable.data('subject');
    var nonce = subjectAdminsTable.data('nonce');

    if (subject && nonce) {
      var data = {
        action: 'wlsm-fetch-subject-admins',
        subject: subject
      };
      data['subject-admins-' + subject] = nonce;
      wlsmInitializeTable(subjectAdminsTable, data);
    } // Staff: Delete subject admin.


    $(document).on('click', '.wlsm-delete-subject-admin', function (event) {
      event.preventDefault();
      var adminId = $(this).data('admin');
      var subjectId = $(this).data('subject');
      var nonce = $(this).data('nonce');
      var data = "subject_id=" + subjectId + "&admin_id=" + adminId + "&delete-subject-admin-" + adminId + "=" + nonce + "&action=wlsm-delete-subject-admin";

      var performActions = function performActions() {
        subjectAdminsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Autocomplete admins.

    var adminSearch = $('#wlsm_admin_search');
    $('#wlsm_admin_search').autocomplete({
      minLength: 1,
      source: function source(request, response) {
        $.ajax({
          data: 'action=wlsm-get-keyword-admins&keyword=' + request.term,
          url: ajaxurl,
          type: 'POST',
          success: function success(res) {
            if (res.success) {
              response(res.data);
            } else {
              response([]);
            }
          }
        });
      },
      select: function select(event, ui) {
        adminSearch.val('');
        var id = ui.item.ID;
        var label = ui.item.label;
        var adminsInput = $('.wlsm_subject_admins_input');

        if (adminsInput) {
          var adminsToAdd = adminsInput.map(function () {
            return $(this).val();
          }).get();

          if (-1 !== $.inArray(id, adminsToAdd)) {
            return false;
          }
        }

        if (id) {
          $('.wlsm_subject_admins').append('' + '<div class="wlsm-subject-admin-item mb-1">' + '<input class="wlsm_subject_admins_input" type="hidden" name="admins[]" value="' + id + '">' + '<span class="wlsm-badge badge badge-info">' + label + '</span>' + '&nbsp;<i class="fa fa-times bg-danger text-white wlsm-remove-item"></i>' + '</div>' + '');
          return false;
        }

        return false;
      }
    }); // Staff: Assign subject admins.

    var assignSubjectAdminsFormId = '#wlsm-assign-subject-admins-form';
    var assignSubjectAdminsForm = $(assignSubjectAdminsFormId);
    var assignSubjectAdminsBtn = $('#wlsm-assign-subject-admins-btn');
    assignSubjectAdminsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(assignSubjectAdminsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, assignSubjectAdminsFormId);
          toastr.success(response.data.message);
          subjectAdminsTable.DataTable().ajax.reload(null, false);
          $('.wlsm_subject_admins').html('');
        } else {
          wlsmDisplayFormErrors(response, assignSubjectAdminsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, assignSubjectAdminsFormId, assignSubjectAdminsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(assignSubjectAdminsBtn);
      }
    }); // Staff: Timetable Table.

    var timetableTable = $('#wlsm-timetable-table');
    wlsmInitializeTable(timetableTable, {
      action: 'wlsm-fetch-timetable'
    }); // Staff: Delete timetable.

    $(document).on('click', '.wlsm-delete-timetable', function (event) {
      var timetableId = $(this).data('timetable');
      var nonce = $(this).data('nonce');
      var data = "section_id=" + timetableId + "&delete-timetable-" + timetableId + "=" + nonce + "&action=wlsm-delete-timetable";

      var performActions = function performActions() {
        timetableTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Save routine.

    var saveRoutineFormId = '#wlsm-save-routine-form';
    var saveRoutineForm = $(saveRoutineFormId);
    var saveRoutineBtn = $('#wlsm-save-routine-btn');
    saveRoutineForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveRoutineBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveRoutineFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveRoutineForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveRoutineFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveRoutineFormId, saveRoutineBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveRoutineBtn);
      }
    }); // Staff: Delete routine.

    $(document).on('click', '.wlsm-delete-routine', function (event) {
      var routineId = $(this).data('routine');
      var nonce = $(this).data('nonce');
      var data = "routine_id=" + routineId + "&delete-routine-" + routineId + "=" + nonce + "&action=wlsm-delete-routine";

      var performActions = function performActions() {
        $('.wlsm-class-timetable-box').load(location.href + " " + '.wlsm-class-timetable', function () {});
      };

      wlsmAction(event, this, data, performActions);
    }); // Time.

    $('.wlsm_time').Zebra_DatePicker({
      format: 'h:i a',
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: false,
      view: 'time'
    }); // Staff: Exams Table.

    var examsTable = $('#wlsm-exams-table');
    wlsmInitializeTable(examsTable, {
      action: 'wlsm-fetch-exams'
    }); // Staff: Exams Admit Cards Table.

    var examsAdmitCardsTable = $('#wlsm-exams-admit-cards-table');
    wlsmInitializeTable(examsAdmitCardsTable, {
      action: 'wlsm-fetch-exams-admit-cards'
    }); // Staff: Exams Results Table.

    var examsResultsTable = $('#wlsm-exams-results-table');
    wlsmInitializeTable(examsResultsTable, {
      action: 'wlsm-fetch-exams-results'
    }); // Add more exam paper.

    var examPapersBox = $('.wlsm-exam-papers-box');
    var epSubjectName = examPapersBox.data('subject-name');
    var epSubjectNamePlaceholder = examPapersBox.data('subject-name-placeholder');
    var epRoomNumber = examPapersBox.data('room-number');
    var epRoomNumberPlaceholder = examPapersBox.data('room-number-placeholder');
    var epSubjectType = examPapersBox.data('subject-type');
    var epMaximumMarks = examPapersBox.data('maximum-marks');
    var epMaximumMarksPlaceholder = examPapersBox.data('maximum-marks-placeholder');
    var epPaperCode = examPapersBox.data('paper-code');
    var epPaperCodePlaceholder = examPapersBox.data('paper-code-placeholder');
    var epPaperDate = examPapersBox.data('paper-date');
    var epPaperDatePlaceholder = examPapersBox.data('paper-date-placeholder');
    var epStartTime = examPapersBox.data('start-time');
    var epStartTimePlaceholder = examPapersBox.data('start-time-placeholder');
    var epEndTime = examPapersBox.data('end-time');
    var epEndTimePlaceholder = examPapersBox.data('end-time-placeholder');
    var epSubjectTypes = examPapersBox.data('subject-types');
    examPapersBox.sortable({
      placeholder: '',
      revert: true
    });
    $(document).on('click', '.wlsm-add-exam-paper-btn', function () {
      var examPapersCount = $('.wlsm-exam-paper-box:last').data('exam-paper');

      if (examPapersCount === undefined) {
        examPapersCount = 0;
      }

      examPapersCount++;
      var id = examPapersCount;
      var subjectTypes = '<select name="subject_type[]" class="form-control selectpicker wlsm_subject_type_selectpicker" id="wlsm_subject_type_' + id + '">';
      $.each(epSubjectTypes, function (key, value) {
        subjectTypes += '<option value="' + key + '">' + value;
        subjectTypes += '</option>';
      });
      subjectTypes += '</select>';
      examPapersBox.append('' + '<div class="wlsm-exam-paper-box card col" data-exam-paper="' + id + '">' + '<button type="button" class="btn btn-sm btn-danger wlsm-remove-exam-paper-btn"><i class="fas fa-times"></i></button>' + '<div class="form-row">' + '<div class="form-group col-sm-6 col-md-4">' + '<label for="wlsm_subject_label_' + id + '" class="wlsm-font-bold">' + epSubjectName + ':' + '</label>' + '<input type="text" name="subject_label[]" class="form-control" id="wlsm_subject_label_' + id + '" placeholder="' + epSubjectNamePlaceholder + '" value="">' + '</div>' + '<div class="form-group col-sm-6 col-md-3">' + '<label for="wlsm_subject_type_' + id + '" class="wlsm-font-bold">' + epSubjectType + ':' + '</label>' + subjectTypes + '</div>' + '<div class="form-group col-sm-6 col-md-2">' + '<label for="wlsm_maximum_marks_' + id + '" class="wlsm-font-bold">' + epMaximumMarks + ':' + '</label>' + '<input type="number" step="1" min="1" name="maximum_marks[]" class="form-control" id="wlsm_maximum_marks_' + id + '" placeholder="' + epMaximumMarksPlaceholder + '" value="">' + '</div>' + '<div class="form-group col-sm-6 col-md-3">' + '<label for="wlsm_paper_code_' + id + '" class="wlsm-font-bold">' + epPaperCode + ':' + '</label>' + '<input type="text" name="paper_code[]" class="form-control" id="wlsm_paper_code_' + id + '" placeholder="' + epPaperCodePlaceholder + '" value="">' + '</div>' + '<div class="form-group col-sm-6 col-md-3">' + '<label for="wlsm_paper_date_' + id + '" class="wlsm-font-bold">' + epPaperDate + ':' + '</label>' + '<input type="text" name="paper_date[]" class="form-control wlsm_paper_date" id="wlsm_paper_date_' + id + '" placeholder="' + epPaperDatePlaceholder + '" value="">' + '</div>' + '<div class="form-group col-sm-6 col-md-3">' + '<label for="wlsm_start_time" class="wlsm-font-bold">' + epStartTime + ':' + '</label>' + '<input type="text" name="start_time[]" class="form-control wlsm_paper_time" id="wlsm_start_time" placeholder="' + epStartTimePlaceholder + '" value="">' + '</div>' + '<div class="form-group col-sm-6 col-md-3">' + '<label for="wlsm_end_time_' + id + '" class="wlsm-font-bold">' + epEndTime + ':' + '</label>' + '<input type="text" name="end_time[]" class="form-control wlsm_paper_time" id="wlsm_end_time_' + id + '" placeholder="' + epEndTimePlaceholder + '" value="">' + '</div>' + '<div class="form-group col-sm-6 col-md-3">' + '<label for="wlsm_room_number_' + id + '" class="wlsm-font-bold">' + epRoomNumber + ':' + '</label>' + '<input type="text" name="room_number[]" class="form-control" id="wlsm_room_number_' + id + '" placeholder="' + epRoomNumberPlaceholder + '" value="">' + '</div>' + '</div>' + '</div>'); // Subject types select picker.

      $('.wlsm_subject_type_selectpicker').selectpicker(); // Exam paper date.

      $('.wlsm_paper_date').Zebra_DatePicker({
        format: wlsmdateformat,
        readonly_element: false,
        show_clear_date: true,
        disable_time_picker: true
      }); // Exam paper time.

      $('.wlsm_paper_time').Zebra_DatePicker({
        format: 'h:i a',
        readonly_element: false,
        show_clear_date: true,
        disable_time_picker: false,
        view: 'time'
      });
    }); // Remove exam paper.

    $(document).on('click', '.wlsm-remove-exam-paper-btn', function () {
      if (examPapersBox.children().size() > 1) {
        $(this).parent().fadeOut(300, function () {
          $(this).remove();
        });
      }
    }); // Exam paper date.

    $('.wlsm_paper_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    }); // Exam paper time.

    $('.wlsm_paper_time').Zebra_DatePicker({
      format: 'h:i a',
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: false,
      view: 'time'
    }); // Add grade criteria.

    $(document).on('click', '.wlsm-grade-criteria-add', function () {
      $('.wlsm-grade-criteria tbody').append('' + '<tr>' + '<td><input type="number" step="1" min="0" name="grade_criteria[min][]"></td>' + '<td><input type="number" step="1" min="1" name="grade_criteria[max][]"></td>' + '<td><input type="text" name="grade_criteria[grade][]"></td>' + '<td><span class="wlsm-grade-criteria-remove text-danger dashicons dashicons-no"></span></td>' + '</tr>' + '');
    }); // Remove grade criteria.

    $(document).on('click', '.wlsm-grade-criteria-remove', function () {
      $(this).parent().parent().remove();
    }); // Staff: Save exam.

    var saveExamFormId = '#wlsm-save-exam-form';
    var saveExamForm = $(saveExamFormId);
    var saveExamBtn = $('#wlsm-save-exam-btn');
    saveExamForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveExamBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveExamFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveExamForm[0].reset();
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveExamFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveExamFormId, saveExamBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveExamBtn);
      }
    }); // Staff: Delete exam.

    $(document).on('click', '.wlsm-delete-exam', function (event) {
      var examId = $(this).data('exam');
      var nonce = $(this).data('nonce');
      var data = "exam_id=" + examId + "&delete-exam-" + examId + "=" + nonce + "&action=wlsm-delete-exam";

      var performActions = function performActions() {
        examsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Get exam time table.

    $(document).on('click', '.wlsm-view-exam-time-table-btn', function (event) {
      var element = $(this);
      var examId = element.data('exam-time-table');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['exam_id'] = examId;
      data['view-exam-time-table-' + examId] = nonce;
      data['action'] = 'wlsm-view-exam-time-table';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        useBootstrap: true,
        columnClass: 'large',
        containerFluid: true
      });
    }); // Staff: Generate admit cards.

    $(document).on('click', '#wlsm-generate-admit-cards-btn', function (e) {
      var generateAdmitCardsFormId = '#wlsm-generate-admit-cards-form';
      var generateAdmitCardsForm = $(generateAdmitCardsFormId);
      var generateAdmitCardsBtn = $(this);
      e.preventDefault();
      $.confirm({
        title: generateAdmitCardsBtn.data('message-title'),
        content: generateAdmitCardsBtn.data('message-content'),
        type: 'green',
        useBootstrap: false,
        buttons: {
          confirm: {
            text: generateAdmitCardsBtn.data('submit'),
            btnClass: 'btn-success',
            action: function action() {
              generateAdmitCardsForm.ajaxSubmit({
                beforeSubmit: function beforeSubmit(arr, $form, options) {
                  return wlsmBeforeSubmit(generateAdmitCardsBtn);
                },
                success: function success(response) {
                  if (response.success) {
                    wlsmShowSuccessAlert(response.data.message, generateAdmitCardsFormId);
                    toastr.success(response.data.message);

                    if (response.data.hasOwnProperty('reset') && response.data.reset) {
                      generateAdmitCardsForm[0].reset();
                    } else {
                      $('.wlsm-students-without-admit-cards-box').load(location.href + " " + '.wlsm-students-without-admit-cards', function () {});
                    }
                  } else {
                    wlsmDisplayFormErrors(response, generateAdmitCardsFormId);
                  }
                },
                error: function error(response) {
                  wlsmDisplayFormError(response, generateAdmitCardsFormId, generateAdmitCardsBtn);
                },
                complete: function complete(event, xhr, settings) {
                  wlsmComplete(generateAdmitCardsBtn);
                }
              });
            }
          },
          cancel: {
            text: generateAdmitCardsBtn.data('cancel'),
            action: function action() {
              return;
            }
          }
        }
      });
    }); // Staff: Admit cards table.

    var examAdmitCardsTable = $('.wlsm-admit-cards-table');
    wlsmInitializeDataTable(examAdmitCardsTable, [5, 25, 50, 100, 200], 'wlsm-fetch-exam-admit-cards', '&exam_id=' + examAdmitCardsTable.data('exam')); // Staff: Delete admit card.

    $(document).on('click', '.wlsm-delete-exam-admit-card', function (event) {
      event.preventDefault();
      var admitCardId = $(this).data('exam-admit-card');
      var nonce = $(this).data('nonce');
      var data = "admit_card_id=" + admitCardId + "&delete-exam-admit-card-" + admitCardId + "=" + nonce + "&action=wlsm-delete-exam-admit-card";

      var performActions = function performActions() {
        examAdmitCardsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Edit exam admit card.

    $(document).on('click', '.wlsm-edit-exam-admit-card', function (e) {
      e.preventDefault();
      var editAdmitCardBtn = $(this);
      var admitCardId = editAdmitCardBtn.data('exam-admit-card');
      var nonce = editAdmitCardBtn.data('nonce');
      var title = editAdmitCardBtn.data('message-title');
      var rollNumber = editAdmitCardBtn.data('roll-number');
      var rollNumberLabel = editAdmitCardBtn.data('roll-number-label');
      var rollNumberPlaceholder = editAdmitCardBtn.data('roll-number-placeholder');
      var rollNumberEmptyMessage = editAdmitCardBtn.data('roll-number-empty-message');

      var _error = editAdmitCardBtn.data('error');

      var save = editAdmitCardBtn.data('save');
      var cancel = editAdmitCardBtn.data('cancel');

      if (!rollNumber) {
        rollNumber = '';
      }

      var data = {};
      data['admit_card_id'] = admitCardId;
      data['edit-exam-admit-card-' + admitCardId] = nonce;
      data['action'] = 'wlsm-save-exam-admit-card';
      var editAdmitCardConfirm = $.confirm({
        title: title,
        content: '' + '<div class="form-group">' + '<label>' + rollNumberLabel + '</label>' + '<input type="text" placeholder="' + rollNumberPlaceholder + '" class="wlsm-admit-card-roll-number-input form-control" value="' + rollNumber + '">' + '</div>',
        type: 'blue',
        useBootstrap: false,
        buttons: {
          formSubmit: {
            text: save,
            btnClass: 'btn-blue',
            action: function action() {
              var rollNumber = this.$content.find('.wlsm-admit-card-roll-number-input').val();

              if (!rollNumber) {
                $.alert({
                  title: _error,
                  content: rollNumberEmptyMessage,
                  type: 'red'
                });
                return false;
              }

              data['roll_number'] = rollNumber;
              $.ajax({
                data: data,
                url: ajaxurl,
                type: 'POST',
                beforeSend: function beforeSend() {
                  return wlsmBeforeSubmit(editAdmitCardBtn);
                },
                success: function success(response) {
                  if (response.success) {
                    examAdmitCardsTable.DataTable().ajax.reload(null, false);
                    toastr.success(response.data.message);
                    editAdmitCardConfirm.close();
                  } else {
                    $.alert({
                      title: _error,
                      content: response.data,
                      type: 'red'
                    });
                  }
                },
                error: function error(response) {
                  $.alert({
                    title: _error,
                    content: response.data,
                    type: 'red'
                  });
                },
                complete: function complete(event, xhr, settings) {
                  wlsmComplete(editAdmitCardBtn);
                }
              });
              return false;
            }
          },
          cancel: {
            text: cancel,
            action: function action() {
              return;
            }
          }
        }
      });
    }); // Staff: Print exam admit card.

    $(document).on('click', '.wlsm-print-exam-admit-card', function (event) {
      var element = $(this);
      var examAdmitCardId = element.data('exam-admit-card');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['admit_card_id'] = examAdmitCardId;
      data['print-exam-admit-card-' + examAdmitCardId] = nonce;
      data['action'] = 'wlsm-print-exam-admit-card';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        useBootstrap: true,
        columnClass: 'large',
        containerFluid: true
      });
    }); // Staff: Exam results table.

    var examResultsTable = $('.wlsm-exam-results-table');
    wlsmInitializeDataTable(examResultsTable, [5, 25, 50, 100, 200], 'wlsm-fetch-exam-results', '&exam_id=' + examResultsTable.data('exam'), ['pageLength', {
      'extend': 'excel',
      'exportOptions': {
        'columns': [0, 1, 2, 3, 4, 5, 6],
        'modifier': {
          'selected': null
        }
      }
    }, {
      'extend': 'csv',
      'exportOptions': {
        'columns': [0, 1, 2, 3, 4, 5, 6],
        'modifier': {
          'selected': null
        }
      }
    }]); // Staff: Save exam results.

    var saveExamResultsFormId = '#wlsm-save-exam-results-form';
    var saveExamResultsForm = $(saveExamResultsFormId);
    var saveExamResultsBtn = $('#wlsm-save-exam-results-btn');
    saveExamResultsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveExamResultsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveExamResultsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveExamResultsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveExamResultsFormId, saveExamResultsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveExamResultsBtn);
      }
    }); // Staff: Exam results sample CSV export.

    $(document).on('click', '#wlsm-exam-results-csv-export-btn', function (e) {
      var nonce = $(this).data('nonce');
      var formId = 'wlsm-exam-results-csv-export-form';
      var examId = $('#wlsm_exam').val();
      var form = '' + '<form action="' + ajaxurl + '" method="post" id="' + formId + '">' + '<input type="hidden" name="nonce" value="' + nonce + '">' + '<input type="hidden" name="action" value="wlsm-exam-results-csv-export">' + '<input type="hidden" name="exam_id" value="' + examId + '">' + '</form>' + '';
      $('#' + formId).remove();
      $(document.body).append(form);
      $('#' + formId).submit();
    }); // Staff: Bulk import exam results.

    var bulkImportExamResultsFormId = '#wlsm-bulk-import-exam-results-form';
    var bulkImportExamResultsForm = $(bulkImportExamResultsFormId);
    var bulkImportExamResultsBtn = $('#wlsm-bulk-import-exam-results-btn');
    $(document).on('click', '#wlsm-bulk-import-exam-results-btn', function (e) {
      var bulkImportExamResultsBtn = $(this);
      e.preventDefault();
      $.confirm({
        title: bulkImportExamResultsBtn.data('message-title'),
        content: bulkImportExamResultsBtn.data('message-content'),
        type: 'green',
        useBootstrap: false,
        buttons: {
          confirm: {
            text: bulkImportExamResultsBtn.data('submit'),
            btnClass: 'btn-success',
            action: function action() {
              bulkImportExamResultsForm.ajaxSubmit({
                beforeSubmit: function beforeSubmit(arr, $form, options) {
                  return wlsmBeforeSubmit(bulkImportExamResultsBtn);
                },
                success: function success(response) {
                  if (response.success) {
                    wlsmShowSuccessAlert(response.data.message, bulkImportExamResultsFormId);
                    toastr.success(response.data.message);
                  } else {
                    wlsmDisplayFormErrors(response, bulkImportExamResultsFormId);
                  }
                },
                error: function error(response) {
                  wlsmDisplayFormError(response, bulkImportExamResultsFormId, bulkImportExamResultsBtn);
                },
                complete: function complete(event, xhr, settings) {
                  wlsmComplete(bulkImportExamResultsBtn);
                }
              });
            }
          },
          cancel: {
            text: bulkImportExamResultsBtn.data('cancel'),
            action: function action() {
              return;
            }
          }
        }
      });
    }); // Staff: Delete exam results.

    $(document).on('click', '.wlsm-delete-exam-results', function (event) {
      event.preventDefault();
      var admitCardId = $(this).data('exam-admit-card');
      var nonce = $(this).data('nonce');
      var data = "admit_card_id=" + admitCardId + "&delete-exam-results-" + admitCardId + "=" + nonce + "&action=wlsm-delete-exam-results";

      var performActions = function performActions() {
        examResultsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Print exam results.

    $(document).on('click', '.wlsm-print-exam-results', function (event) {
      var element = $(this);
      var admitCardId = element.data('exam-results');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['admit_card_id'] = admitCardId;
      data['print-exam-results-' + admitCardId] = nonce;
      data['action'] = 'wlsm-print-exam-results';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        useBootstrap: false,
        boxWidth: '900px'
      });
    }); // Staff: Get results assessment.

    var resultsAssessmentFormId = '#wlsm-get-results-assessment-form';
    var resultsAssessmentForm = $(resultsAssessmentFormId);
    var resultsAssessmentBtn = $('#wlsm-get-results-assessment-btn');
    $(document).on('click', '#wlsm-get-results-assessment-btn', function (e) {
      var studentsResultsAssessment = $('.wlsm-students-results-assessment');
      var classId = $('#wlsm_class').val();
      var sectionId = $('#wlsm_section').val();
      var nonce = $(this).data('nonce');
      var data = {};
      data['class_id'] = classId;
      data['section_id'] = sectionId;
      data['nonce'] = nonce;
      data['action'] = 'wlsm-get-results-assessment';

      if (nonce) {
        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          beforeSend: function beforeSend() {
            return wlsmBeforeSubmit(resultsAssessmentBtn);
          },
          success: function success(response) {
            if (response.success) {
              studentsResultsAssessment.html(response.data.html);
            } else {
              wlsmDisplayFormErrors(response, resultsAssessmentFormId);
            }
          },
          error: function error(response) {
            wlsmDisplayFormError(response, resultsAssessmentFormId, resultsAssessmentBtn);
          },
          complete: function complete(event, xhr, settings) {
            wlsmComplete(resultsAssessmentBtn);
          }
        });
      } else {
        studentsResultsAssessment.html('');
      }
    }); // Staff: Get student result assessment.

    $(document).on('click', '.wlsm-get-result-assessment', function (event) {
      var element = $(this);
      var studentId = element.data('student');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['student_id'] = studentId;
      data['get-result-assessment-' + studentId] = nonce;
      data['action'] = 'wlsm-get-result-assessment';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        columnClass: 'large',
        containerFluid: true,
        backgroundDismiss: true
      });
    }); // Staff: Get student result subject-wise.

    $(document).on('click', '.wlsm-get-result-subject-wise', function (event) {
      var element = $(this);
      var studentId = element.data('student');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['student_id'] = studentId;
      data['get-result-subject-wise-' + studentId] = nonce;
      data['action'] = 'wlsm-get-result-subject-wise';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        columnClass: 'xlarge',
        containerFluid: true,
        backgroundDismiss: true
      });
    });
    $('.wlsm_at').Zebra_DatePicker({
      format: wlsmatformat,
      default_position: 'below',
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: false
    }); // Staff: Meetings Table.

    var meetingsTable = $('#wlsm-meetings-table');
    wlsmInitializeTable(meetingsTable, {
      action: 'wlsm-fetch-meetings'
    }); // Staff: Save meeting.

    var saveMeetingFormId = '#wlsm-save-meeting-form';
    var saveMeetingForm = $(saveMeetingFormId);
    var saveMeetingBtn = $('#wlsm-save-meeting-btn');
    saveMeetingForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveMeetingBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveMeetingFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveMeetingForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveMeetingFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveMeetingFormId, saveMeetingBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveMeetingBtn);
      }
    }); // Staff: Delete meeting.

    $(document).on('click', '.wlsm-delete-meeting', function (event) {
      var meetingId = $(this).data('meeting');
      var nonce = $(this).data('nonce');
      var data = "meeting_id=" + meetingId + "&delete-meeting-" + meetingId + "=" + nonce + "&action=wlsm-delete-meeting";

      var performActions = function performActions() {
        meetingsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Staff Meetings Table.

    var staffMeetingsTable = $('#wlsm-staff-meetings-table');
    wlsmInitializeTable(staffMeetingsTable, {
      action: 'wlsm-fetch-staff-meetings'
    }); // Staff: Study Materials Table.

    var studyMaterialsTable = $('#wlsm-study-materials-table');
    wlsmInitializeTable(studyMaterialsTable, {
      action: 'wlsm-fetch-study-materials'
    }); // Staff: Save study material.

    var saveStudyMaterialFormId = '#wlsm-save-study-material-form';
    var saveStudyMaterialForm = $(saveStudyMaterialFormId);
    var saveStudyMaterialBtn = $('#wlsm-save-study-material-btn');
    saveStudyMaterialForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveStudyMaterialBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveStudyMaterialFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveStudyMaterialForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          } else {
            $('.wlsm-attachment-box').load(location.href + " " + '.wlsm-attachment-section', function () {});
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveStudyMaterialFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveStudyMaterialFormId, saveStudyMaterialBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveStudyMaterialBtn);
      }
    });
    $(document).on('click', '.wlsm-remove-study-material-attachment', function (e) {
      $(this).parent().fadeOut(250, function () {
        $(this).remove();
      });
    }); // Staff: Delete study material.

    $(document).on('click', '.wlsm-delete-study-material', function (event) {
      var studyMaterialId = $(this).data('study-material');
      var nonce = $(this).data('nonce');
      var data = "study_material_id=" + studyMaterialId + "&delete-study-material-" + studyMaterialId + "=" + nonce + "&action=wlsm-delete-study-material";

      var performActions = function performActions() {
        studyMaterialsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Homework Table.

    var homeworksTable = $('#wlsm-homeworks-table');
    wlsmInitializeTable(homeworksTable, {
      action: 'wlsm-fetch-homeworks'
    }); // Staff: Homework Submission Table.

    var homeworksTable = $('#wlsm-homeworks-submission-table');
    var id = $('#homework_id').val();
    wlsmInitializeTable(homeworksTable, {
      action: 'wlsm-fetch-student-homeworks',
      id: id
    }); // Staff: Save homework.

    var saveHomeworkFormId = '#wlsm-save-homework-form';
    var saveHomeworkForm = $(saveHomeworkFormId);
    var saveHomeworkBtn = $('#wlsm-save-homework-btn');
    saveHomeworkForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveHomeworkBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveHomeworkFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveHomeworkForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveHomeworkFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveHomeworkFormId, saveHomeworkBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveHomeworkBtn);
      }
    }); // Homework date.

    $('#wlsm_homework_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    }); // Staff: Delete homework.

    $(document).on('click', '.wlsm-delete-homework', function (event) {
      var homeworkId = $(this).data('homework');
      var nonce = $(this).data('nonce');
      var data = "homework_id=" + homeworkId + "&delete-homework-" + homeworkId + "=" + nonce + "&action=wlsm-delete-homework";

      var performActions = function performActions() {
        homeworksTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Invoices Table.

    function wlsmInitializeInvoicesTable() {
      var data = $('#wlsm-get-invoices-form').serializeObject();
      data['from_table'] = true;
      wlsmInitializeTable($('#wlsm-staff-invoices-table'), data, true);
    }

    wlsmInitializeInvoicesTable();
    $(document).on('click', '#wlsm-get-invoices-btn', function (event) {
      event.preventDefault();
      var getInvoicesFormId = '#wlsm-get-invoices-form';
      var getInvoicesForm = $(getInvoicesFormId);
      var getInvoicesBtn = $('#wlsm-get-invoices-btn');
      getInvoicesForm.ajaxSubmit({
        beforeSubmit: function beforeSubmit(arr, $form, options) {
          return wlsmBeforeSubmit(getInvoicesBtn);
        },
        success: function success(response) {
          if (response.success) {
            $('#wlsm-staff-invoices-table').DataTable().clear().destroy();
            wlsmInitializeInvoicesTable();
          } else {
            wlsmDisplayFormErrors(response, getInvoicesFormId);
          }
        },
        error: function error(response) {
          wlsmDisplayFormError(response, getInvoicesFormId, getInvoicesBtn);
        },
        complete: function complete(event, xhr, settings) {
          wlsmComplete(getInvoicesBtn);
        }
      });
    });
    $('#wlsm_invoice_date_issued').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    });
    $('#wlsm_invoice_due_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    }); // Staff: Single or bulk students.

    var invoicePayments = $('.wlsm-invoice-payments');
    var invoiceStudent = $('#wlsm_student');
    var invoiceStudentLabel = $('label[for="wlsm_student"]');
    $(document).on('change', 'input[name="invoice_type"]', function (event) {
      var invoiceType = this.value;
      invoiceStudent.selectpicker('destroy');

      if ('bulk_invoice' === invoiceType) {
        invoicePayments.hide();
        invoiceStudent.attr('name', 'student[]');
        invoiceStudent.attr('multiple', 'multiple');
        invoiceStudentLabel.html(invoiceStudentLabel.data('bulk-label'));
      } else {
        invoicePayments.fadeIn();
        invoiceStudent.attr('name', 'student');
        invoiceStudent.removeAttr('multiple');
        invoiceStudentLabel.html(invoiceStudentLabel.data('single-label'));
      }

      invoiceStudent.selectpicker('render');
      invoiceStudent.selectpicker('selectAll');
    });
    var collectInvoicePayment = $('.wlsm-collect-invoice-payment');
    $(document).on('change', '#wlsm_collect_invoice_payment', function (event) {
      if ($(this).is(':checked')) {
        collectInvoicePayment.fadeIn();
        wlsmInitializePaymentDatePicker();
      } else {
        collectInvoicePayment.hide();
      }
    });
    $(document).on('click', '.wlsm-print-invoice-fee-structure', function () {
      var element = $(this);
      var studentsSelected = $("#wlsm_student :selected");
      var length = studentsSelected.length;
      var studentId = studentsSelected.val();
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var onlyOneStudent = element.data('only-one-student');

      if (1 === length && studentId && nonce) {
        var data = {};
        data['student_id'] = studentId;
        data['print-invoice-fee-structure'] = nonce;
        data['action'] = 'wlsm-print-invoice-fee-structure';
        $.dialog({
          title: title,
          content: function content() {
            var self = this;
            return $.ajax({
              data: data,
              url: ajaxurl,
              type: 'POST',
              success: function success(res) {
                self.setContent(res.data.html);
              }
            });
          },
          theme: 'bootstrap',
          columnClass: 'large',
          containerFluid: true,
          backgroundDismiss: true
        });
      } else {
        toastr.error(onlyOneStudent);
      }
    }); // Staff: Save invoice.

    var saveInvoiceFormId = '#wlsm-save-invoice-form';
    var saveInvoiceForm = $(saveInvoiceFormId);
    var saveInvoiceBtn = $('#wlsm-save-invoice-btn');
    saveInvoiceForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveInvoiceBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveInvoiceFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveInvoiceForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + ' .wlsm-section-heading', function () {});
            $('.wlsm-fee-invoice-status-box').load(location.href + " " + ' .wlsm-fee-invoice-status', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveInvoiceFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveInvoiceFormId, saveInvoiceBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveInvoiceBtn);
      }
    }); // Staff: Delete invoice.

    $(document).on('click', '.wlsm-delete-invoice', function (event) {
      event.preventDefault();
      var invoiceId = $(this).data('invoice');
      var nonce = $(this).data('nonce');
      var data = "invoice_id=" + invoiceId + "&delete-invoice-" + invoiceId + "=" + nonce + "&action=wlsm-delete-invoice";

      var performActions = function performActions() {
        $('#wlsm-staff-invoices-table').DataTable().ajax.reload(null, false);
        $('.wlsm-fee-invoices-amount-total-box').load(location.href + " " + '.wlsm-fee-invoices-amount-total', function () {});
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Print invoice.

    $(document).on('click', '.wlsm-print-invoice', function (event) {
      var element = $(this);
      var invoiceId = element.data('invoice');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['invoice_id'] = invoiceId;
      data['print-invoice-' + invoiceId] = nonce;
      data['action'] = 'wlsm-print-invoice';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        useBootstrap: false,
        boxWidth: '900px'
      });
    }); // Staff: Invoice - Payments table.

    var invoicePaymentsTable = $('#wlsm-invoice-payments-table');
    var invoice = invoicePaymentsTable.data('invoice');
    var nonce = invoicePaymentsTable.data('nonce');

    if (invoice && nonce) {
      var data = {
        action: 'wlsm-fetch-invoice-payments',
        'invoice': invoice
      };
      data['invoice-payments-' + invoice] = nonce;
      wlsmInitializeTable(invoicePaymentsTable, data);
    } // Staff: Collect invoice payment.


    var collectInvoicePaymentFormId = '#wlsm-collect-invoice-payment-form';
    var collectInvoicePaymentForm = $(collectInvoicePaymentFormId);
    $(document).on('click', '#wlsm-collect-invoice-payment-btn', function (e) {
      var collectInvoicePaymentBtn = $(this);
      e.preventDefault();
      $.confirm({
        title: collectInvoicePaymentBtn.data('message-title'),
        content: collectInvoicePaymentBtn.data('message-content'),
        type: 'green',
        useBootstrap: false,
        buttons: {
          confirm: {
            text: collectInvoicePaymentBtn.data('submit'),
            btnClass: 'btn-success',
            action: function action() {
              collectInvoicePaymentForm.ajaxSubmit({
                beforeSubmit: function beforeSubmit(arr, $form, options) {
                  return wlsmBeforeSubmit(collectInvoicePaymentBtn);
                },
                success: function success(response) {
                  if (response.success) {
                    wlsmShowSuccessAlert(response.data.message, collectInvoicePaymentFormId);
                    toastr.success(response.data.message);

                    if (response.data.hasOwnProperty('reload') && response.data.reload) {
                      window.location.reload();
                    } else {
                      if (response.data.hasOwnProperty('reset') && response.data.reset) {
                        collectInvoicePaymentForm[0].reset();
                      }

                      invoicePaymentsTable.DataTable().ajax.reload(null, false);
                      $('.wlsm-fee-invoice-status-box').load(location.href + " " + ' .wlsm-fee-invoice-status', function () {});
                    }
                  } else {
                    wlsmDisplayFormErrors(response, collectInvoicePaymentFormId);
                  }
                },
                error: function error(response) {
                  wlsmDisplayFormError(response, collectInvoicePaymentFormId, collectInvoicePaymentBtn);
                },
                complete: function complete(event, xhr, settings) {
                  wlsmComplete(collectInvoicePaymentBtn);
                }
              });
            }
          },
          cancel: {
            text: collectInvoicePaymentBtn.data('cancel'),
            action: function action() {
              return;
            }
          }
        }
      });
    });

    function wlsmInitializePaymentDatePicker() {
      // Payment date.
      $('#wlsm_payment_date').Zebra_DatePicker({
        format: wlsmdateformat,
        readonly_element: false,
        show_clear_date: true,
        disable_time_picker: true
      });
    }

    wlsmInitializePaymentDatePicker(); // Staff: Delete invoice payment.

    $(document).on('click', '.wlsm-delete-invoice-payment', function (event) {
      event.preventDefault();
      var paymentId = $(this).data('payment');
      var invoiceId = $(this).data('invoice');
      var nonce = $(this).data('nonce');
      var data = "invoice_id=" + invoiceId + "&payment_id=" + paymentId + "&delete-payment-" + paymentId + "=" + nonce + "&action=wlsm-delete-invoice-payment";

      var performActions = function performActions(response) {
        if (response.data.hasOwnProperty('reload') && response.data.reload) {
          window.location.reload();
        } else {
          invoicePaymentsTable.DataTable().ajax.reload(null, false);
          $('.wlsm-fee-invoice-status-box').load(location.href + " " + '.wlsm-fee-invoice-status', function () {});
        }
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Pending Payments Table.

    var pendingPaymentsTable = $('#wlsm-pending-payments-table');
    wlsmInitializeTable(pendingPaymentsTable, {
      action: 'wlsm-fetch-pending-payments'
    }); // Staff: Delete pending payment.

    $(document).on('click', '.wlsm-delete-pending-payment', function (event) {
      event.preventDefault();
      var paymentId = $(this).data('payment');
      var nonce = $(this).data('nonce');
      var data = "payment_id=" + paymentId + "&delete-payment-" + paymentId + "=" + nonce + "&action=wlsm-delete-pending-payment";

      var performActions = function performActions(response) {
        pendingPaymentsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Approve pending payment.

    $(document).on('click', '.wlsm-approve-pending-payment', function (event) {
      var paymentId = $(this).data('payment');
      var nonce = $(this).data('nonce');
      var data = "payment_id=" + paymentId + "&approve-pending-payment-" + paymentId + "=" + nonce + "&action=wlsm-approve-pending-payment";

      var performActions = function performActions() {
        pendingPaymentsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions, 'green');
    }); // Staff: Payments Table.

    var paymentsTable = $('#wlsm-payments-table');
    wlsmInitializeTable(paymentsTable, {
      action: 'wlsm-fetch-payments'
    }); // Staff: Get payment note.

    $(document).on('click', '.wlsm-view-payment-note', function (event) {
      var element = $(this);
      var paymentId = element.data('payment');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['payment_id'] = paymentId;
      data['view-payment-note-' + paymentId] = nonce;
      data['action'] = 'wlsm-view-payment-note';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data);
            }
          });
        },
        theme: 'bootstrap',
        columnClass: 'medium'
      });
    }); // Staff: Delete payment.

    $(document).on('click', '.wlsm-delete-payment', function (event) {
      event.preventDefault();
      var paymentId = $(this).data('payment');
      var nonce = $(this).data('nonce');
      var data = "payment_id=" + paymentId + "&delete-payment-" + paymentId + "=" + nonce + "&action=wlsm-delete-payment";

      var performActions = function performActions(response) {
        paymentsTable.DataTable().ajax.reload(null, false);
        $('.wlsm-stats-payment-table').DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Print invoice payment.

    $(document).on('click', '.wlsm-print-invoice-payment', function (event) {
      var element = $(this);
      var paymentId = element.data('invoice-payment');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['payment_id'] = paymentId;
      data['print-invoice-payment-' + paymentId] = nonce;
      data['action'] = 'wlsm-print-invoice-payment';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        useBootstrap: false,
        boxWidth: '900px'
      });
    }); // Staff: Expense Categories Table.

    var expenseCategoriesTable = $('#wlsm-expense-categories-table');
    wlsmInitializeTable(expenseCategoriesTable, {
      action: 'wlsm-fetch-expense-categories'
    }); // Staff: Save expense category.

    var saveExpenseCategoryFormId = '#wlsm-save-expense-category-form';
    var saveExpenseCategoryForm = $(saveExpenseCategoryFormId);
    var saveExpenseCategoryBtn = $('#wlsm-save-expense-category-btn');
    saveExpenseCategoryForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveExpenseCategoryBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveExpenseCategoryFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveExpenseCategoryForm[0].reset();
            expenseCategoriesTable.DataTable().ajax.reload(null, false);
          } else {
            $('.wlsm-page-heading-box').load(location.href + " " + '.wlsm-page-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveExpenseCategoryFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveExpenseCategoryFormId, saveExpenseCategoryBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveExpenseCategoryBtn);
      }
    }); // Staff: Delete expense category.

    $(document).on('click', '.wlsm-delete-expense-category', function (event) {
      event.preventDefault();
      var expenseCategoryId = $(this).data('expense-category');
      var nonce = $(this).data('nonce');
      var data = "expense_category_id=" + expenseCategoryId + "&delete-expense-category-" + expenseCategoryId + "=" + nonce + "&action=wlsm-delete-expense-category";

      var performActions = function performActions() {
        expenseCategoriesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Income Categories Table.

    var incomeCategoriesTable = $('#wlsm-income-categories-table');
    wlsmInitializeTable(incomeCategoriesTable, {
      action: 'wlsm-fetch-income-categories'
    }); // Staff: Save income category.

    var saveIncomeCategoryFormId = '#wlsm-save-income-category-form';
    var saveIncomeCategoryForm = $(saveIncomeCategoryFormId);
    var saveIncomeCategoryBtn = $('#wlsm-save-income-category-btn');
    saveIncomeCategoryForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveIncomeCategoryBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveIncomeCategoryFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveIncomeCategoryForm[0].reset();
            incomeCategoriesTable.DataTable().ajax.reload(null, false);
          } else {
            $('.wlsm-page-heading-box').load(location.href + " " + '.wlsm-page-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveIncomeCategoryFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveIncomeCategoryFormId, saveIncomeCategoryBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveIncomeCategoryBtn);
      }
    }); // Staff: Delete income category.

    $(document).on('click', '.wlsm-delete-income-category', function (event) {
      event.preventDefault();
      var incomeCategoryId = $(this).data('income-category');
      var nonce = $(this).data('nonce');
      var data = "income_category_id=" + incomeCategoryId + "&delete-income-category-" + incomeCategoryId + "=" + nonce + "&action=wlsm-delete-income-category";

      var performActions = function performActions() {
        incomeCategoriesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Expenses Table.

    var expensesTable = $('#wlsm-expenses-table');
    wlsmInitializeTable(expensesTable, {
      action: 'wlsm-fetch-expenses'
    }, true); // Staff: Get expense note.

    $(document).on('click', '.wlsm-view-expense-note', function (event) {
      var element = $(this);
      var expenseId = element.data('expense');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['expense_id'] = expenseId;
      data['view-expense-note-' + expenseId] = nonce;
      data['action'] = 'wlsm-view-expense-note';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data);
            }
          });
        },
        theme: 'bootstrap',
        columnClass: 'medium'
      });
    }); // Expense date.

    $('#wlsm_expense_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    }); // Staff: Save expense.

    var saveExpenseFormId = '#wlsm-save-expense-form';
    var saveExpenseForm = $(saveExpenseFormId);
    var saveExpenseBtn = $('#wlsm-save-expense-btn');
    saveExpenseForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveExpenseBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveExpenseFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveExpenseForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveExpenseFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveExpenseFormId, saveExpenseBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveExpenseBtn);
      }
    }); // Staff: Delete expense.

    $(document).on('click', '.wlsm-delete-expense', function (event) {
      event.preventDefault();
      var expenseId = $(this).data('expense');
      var nonce = $(this).data('nonce');
      var data = "expense_id=" + expenseId + "&delete-expense-" + expenseId + "=" + nonce + "&action=wlsm-delete-expense";

      var performActions = function performActions() {
        expensesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Fees Table.

    var feesTable = $('#wlsm-fees-table');
    wlsmInitializeTable(feesTable, {
      action: 'wlsm-fetch-fees'
    }, true); // Staff: Save fee.

    var saveFeeFormId = '#wlsm-save-fee-form';
    var saveFeeForm = $(saveFeeFormId);
    var saveFeeBtn = $('#wlsm-save-fee-btn');
    saveFeeForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveFeeBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveFeeFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveFeeForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveFeeFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveFeeFormId, saveFeeBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveFeeBtn);
      }
    }); // Staff: Delete fee.

    $(document).on('click', '.wlsm-delete-fee', function (event) {
      event.preventDefault();
      var feeId = $(this).data('fee');
      var nonce = $(this).data('nonce');
      var data = "fee_id=" + feeId + "&delete-fee-" + feeId + "=" + nonce + "&action=wlsm-delete-fee";

      var performActions = function performActions() {
        feesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Income Table.

    var incomeTable = $('#wlsm-income-table');
    wlsmInitializeTable(incomeTable, {
      action: 'wlsm-fetch-income'
    }, true); // Staff: Get income note.

    $(document).on('click', '.wlsm-view-income-note', function (event) {
      var element = $(this);
      var incomeId = element.data('income');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['income_id'] = incomeId;
      data['view-income-note-' + incomeId] = nonce;
      data['action'] = 'wlsm-view-income-note';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data);
            }
          });
        },
        theme: 'bootstrap',
        columnClass: 'medium'
      });
    }); // Income date.

    $('#wlsm_income_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    }); // Staff: Save income.

    var saveIncomeFormId = '#wlsm-save-income-form';
    var saveIncomeForm = $(saveIncomeFormId);
    var saveIncomeBtn = $('#wlsm-save-income-btn');
    saveIncomeForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveIncomeBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveIncomeFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveIncomeForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveIncomeFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveIncomeFormId, saveIncomeBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveIncomeBtn);
      }
    }); // Staff: Delete income.

    $(document).on('click', '.wlsm-delete-income', function (event) {
      event.preventDefault();
      var incomeId = $(this).data('income');
      var nonce = $(this).data('nonce');
      var data = "income_id=" + incomeId + "&delete-income-" + incomeId + "=" + nonce + "&action=wlsm-delete-income";

      var performActions = function performActions() {
        incomeTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    });
    $('#wlsm_attendance_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    }); // Staff: Manage attendance.

    var takeAttendanceFormId = '#wlsm-take-attendance-form';
    var takeAttendanceForm = $(takeAttendanceFormId);
    var manageAttendanceBtn = $('#wlsm-manage-attendance-btn');
    $(document).on('click', '#wlsm-manage-attendance-btn', function (e) {
      var studentsAttendance = $('.wlsm-students-attendance');
      var classId = $('#wlsm_class').val();
      var sectionId = $('#wlsm_section').val();
      var attendanceDate = $('#wlsm_attendance_date').val();
      var nonce = $(this).data('nonce');
      var data = {};
      data['class_id'] = classId;
      data['section_id'] = sectionId;
      data['attendance_date'] = attendanceDate;
      data['nonce'] = nonce;
      data['action'] = 'wlsm-manage-attendance';

      if (nonce) {
        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          beforeSend: function beforeSend() {
            return wlsmBeforeSubmit(manageAttendanceBtn);
          },
          success: function success(response) {
            if (response.success) {
              studentsAttendance.html(response.data.html);
            } else {
              wlsmDisplayFormErrors(response, takeAttendanceFormId);
            }
          },
          error: function error(response) {
            wlsmDisplayFormError(response, takeAttendanceFormId, manageAttendanceBtn);
          },
          complete: function complete(event, xhr, settings) {
            wlsmComplete(manageAttendanceBtn);
          }
        });
      } else {
        studentsAttendance.html('');
      }
    });
    $(document).on('click', '.wlsm-mark-all-present', function (e) {
      $('.wlsm-attendance-status-input').val(['p']);
    });
    $(document).on('click', '.wlsm-mark-all-absent', function (e) {
      $('.wlsm-attendance-status-input').val(['a']);
    }); // Staff: Take attendance.

    $(document).on('click', '#wlsm-take-attendance-btn', function (e) {
      var takeAttendanceBtn = $(this);
      e.preventDefault();
      $.confirm({
        title: takeAttendanceBtn.data('message-title'),
        content: takeAttendanceBtn.data('message-content'),
        type: 'green',
        useBootstrap: false,
        buttons: {
          confirm: {
            text: takeAttendanceBtn.data('submit'),
            btnClass: 'btn-success',
            action: function action() {
              takeAttendanceForm.ajaxSubmit({
                beforeSubmit: function beforeSubmit(arr, $form, options) {
                  return wlsmBeforeSubmit(takeAttendanceBtn);
                },
                success: function success(response) {
                  if (response.success) {
                    wlsmShowSuccessAlert(response.data.message, takeAttendanceFormId);
                    toastr.success(response.data.message);
                  } else {
                    wlsmDisplayFormErrors(response, takeAttendanceFormId);
                  }
                },
                error: function error(response) {
                  wlsmDisplayFormError(response, takeAttendanceFormId, takeAttendanceBtn);
                },
                complete: function complete(event, xhr, settings) {
                  wlsmComplete(takeAttendanceBtn);
                }
              });
            }
          },
          cancel: {
            text: takeAttendanceBtn.data('cancel'),
            action: function action() {
              return;
            }
          }
        }
      });
    });
    $('#wlsm_attendance_year_month').Zebra_DatePicker({
      format: 'F Y',
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    }); // Staff: View attendance.

    var viewAttendanceFormId = '#wlsm-view-attendance-form';
    var viewAttendanceForm = $(viewAttendanceFormId);
    var viewAttendanceBtn = $('#wlsm-view-attendance-btn');
    $(document).on('click', '#wlsm-view-attendance-btn', function (e) {
      var studentsAttendance = $('.wlsm-students-attendance');
      var classId = $('#wlsm_class').val();
      var sectionId = $('#wlsm_section').val();
      var yearMonth = $('#wlsm_attendance_year_month').val();
      var nonce = $(this).data('nonce');
      var data = {};
      data['class_id'] = classId;
      data['section_id'] = sectionId;
      data['year_month'] = yearMonth;
      data['nonce'] = nonce;
      data['action'] = 'wlsm-view-attendance';

      if (nonce) {
        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          beforeSend: function beforeSend() {
            return wlsmBeforeSubmit(viewAttendanceBtn);
          },
          success: function success(response) {
            if (response.success) {
              studentsAttendance.html(response.data.html);
            } else {
              wlsmDisplayFormErrors(response, viewAttendanceFormId);
            }
          },
          error: function error(response) {
            wlsmDisplayFormError(response, viewAttendanceFormId, viewAttendanceBtn);
          },
          complete: function complete(event, xhr, settings) {
            wlsmComplete(viewAttendanceBtn);
          }
        });
      } else {
        studentsAttendance.html('');
      }
    }); // Staff: Manage staff attendance.

    var takeStaffAttendanceFormId = '#wlsm-take-staff-attendance-form';
    var takeStaffAttendanceForm = $(takeStaffAttendanceFormId);
    var manageStaffAttendanceBtn = $('#wlsm-manage-staff-attendance-btn');
    $(document).on('click', '#wlsm-manage-staff-attendance-btn', function (e) {
      var staffAttendance = $('.wlsm-staff-attendance');
      var attendanceDate = $('#wlsm_attendance_date').val();
      var nonce = $(this).data('nonce');
      var data = {};
      data['attendance_date'] = attendanceDate;
      data['nonce'] = nonce;
      data['action'] = 'wlsm-manage-staff-attendance';

      if (nonce) {
        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          beforeSend: function beforeSend() {
            return wlsmBeforeSubmit(manageStaffAttendanceBtn);
          },
          success: function success(response) {
            if (response.success) {
              staffAttendance.html(response.data.html);
            } else {
              wlsmDisplayFormErrors(response, takeStaffAttendanceFormId);
            }
          },
          error: function error(response) {
            wlsmDisplayFormError(response, takeStaffAttendanceFormId, manageStaffAttendanceBtn);
          },
          complete: function complete(event, xhr, settings) {
            wlsmComplete(manageStaffAttendanceBtn);
          }
        });
      } else {
        staffAttendance.html('');
      }
    }); // Staff: Take staff attendance.

    $(document).on('click', '#wlsm-take-staff-attendance-btn', function (e) {
      var takeStaffAttendanceBtn = $(this);
      e.preventDefault();
      $.confirm({
        title: takeStaffAttendanceBtn.data('message-title'),
        content: takeStaffAttendanceBtn.data('message-content'),
        type: 'green',
        useBootstrap: false,
        buttons: {
          confirm: {
            text: takeStaffAttendanceBtn.data('submit'),
            btnClass: 'btn-success',
            action: function action() {
              takeStaffAttendanceForm.ajaxSubmit({
                beforeSubmit: function beforeSubmit(arr, $form, options) {
                  return wlsmBeforeSubmit(takeStaffAttendanceBtn);
                },
                success: function success(response) {
                  if (response.success) {
                    wlsmShowSuccessAlert(response.data.message, takeStaffAttendanceFormId);
                    toastr.success(response.data.message);
                  } else {
                    wlsmDisplayFormErrors(response, takeStaffAttendanceFormId);
                  }
                },
                error: function error(response) {
                  wlsmDisplayFormError(response, takeStaffAttendanceFormId, takeStaffAttendanceBtn);
                },
                complete: function complete(event, xhr, settings) {
                  wlsmComplete(takeStaffAttendanceBtn);
                }
              });
            }
          },
          cancel: {
            text: takeStaffAttendanceBtn.data('cancel'),
            action: function action() {
              return;
            }
          }
        }
      });
    }); // Staff: View staff attendance.

    var viewStaffAttendanceFormId = '#wlsm-view-staff-attendance-form';
    var viewStaffAttendanceForm = $(viewStaffAttendanceFormId);
    var viewStaffAttendanceBtn = $('#wlsm-view-staff-attendance-btn');
    $(document).on('click', '#wlsm-view-staff-attendance-btn', function (e) {
      var staffAttendance = $('.wlsm-staff-attendance');
      var yearMonth = $('#wlsm_attendance_year_month').val();
      var nonce = $(this).data('nonce');
      var data = {};
      data['year_month'] = yearMonth;
      data['nonce'] = nonce;
      data['action'] = 'wlsm-view-staff-attendance';

      if (nonce) {
        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          beforeSend: function beforeSend() {
            return wlsmBeforeSubmit(viewStaffAttendanceBtn);
          },
          success: function success(response) {
            if (response.success) {
              staffAttendance.html(response.data.html);
            } else {
              wlsmDisplayFormErrors(response, viewStaffAttendanceFormId);
            }
          },
          error: function error(response) {
            wlsmDisplayFormError(response, viewStaffAttendanceFormId, viewStaffAttendanceBtn);
          },
          complete: function complete(event, xhr, settings) {
            wlsmComplete(viewStaffAttendanceBtn);
          }
        });
      } else {
        staffAttendance.html('');
      }
    }); // Staff: Staff Leave Requests Table.

    var staffLeaveRequestsTable = $('#wlsm-staff-leave-request-table');
    wlsmInitializeTable(staffLeaveRequestsTable, {
      action: 'wlsm-fetch-staff-leave-requests'
    }); // Staff: Submit leave request.

    var submitLeaveRequestFormId = '#wlsm-submit-staff-leave-request-form';
    var submitLeaveRequestForm = $(submitLeaveRequestFormId);
    var submitLeaveRequestBtn = $('#wlsm-submit-staff-leave-request-btn');
    $(document).on('click', '#wlsm-submit-staff-leave-request-btn', function (e) {
      e.preventDefault();
      var confirmMessage = $(this).data('confirm');

      if (confirm(confirmMessage)) {
        submitLeaveRequestForm.ajaxSubmit({
          beforeSubmit: function beforeSubmit(arr, $form, options) {
            return wlsmBeforeSubmit(submitLeaveRequestBtn);
          },
          success: function success(response) {
            if (response.success) {
              wlsmShowSuccessAlert(response.data.message, submitLeaveRequestFormId);
              toastr.success(response.data.message);

              if (response.data.hasOwnProperty('reset') && response.data.reset) {
                $('#wlsm_description').val('');
                $('#wlsm_leave_start_date').val('');
                $('#wlsm_leave_end_date').val('');
              }

              staffLeaveRequestsTable.DataTable().ajax.reload(null, false);
            } else {
              wlsmDisplayFormErrors(response, submitLeaveRequestFormId);
            }
          },
          error: function error(response) {
            wlsmDisplayFormError(response, submitLeaveRequestFormId, submitLeaveRequestBtn);
            window.location.reload();
          },
          complete: function complete(event, xhr, settings) {
            wlsmComplete(submitLeaveRequestBtn);
          }
        });
      }
    }); // Staff: Transferred to table.

    var transferredToSchoolTable = $('#wlsm-transferred-to-school-table');
    wlsmInitializeTable(transferredToSchoolTable, {
      action: 'wlsm-fetch-transferred-to-school'
    }); // Staff: Get transferred to other school note.

    $(document).on('click', '.wlsm-view-transferred-to-note', function (event) {
      var element = $(this);
      var studentId = element.data('transferred-to');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['student_id'] = studentId;
      data['view-transferred-to-note-' + studentId] = nonce;
      data['action'] = 'wlsm-view-transferred-to-note';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data);
            }
          });
        },
        theme: 'bootstrap',
        columnClass: 'medium'
      });
    }); // Staff: Delete transferred to other school record.

    $(document).on('click', '.wlsm-delete-transferred-to', function (event) {
      event.preventDefault();
      var studentId = $(this).data('transferred-to');
      var nonce = $(this).data('nonce');
      var data = "student_id=" + studentId + "&delete-transferred-to-" + studentId + "=" + nonce + "&action=wlsm-delete-transferred-to";

      var performActions = function performActions() {
        transferredToSchoolTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Transferred from table.

    var transferredFromSchoolTable = $('#wlsm-transferred-from-school-table');
    wlsmInitializeTable(transferredFromSchoolTable, {
      action: 'wlsm-fetch-transferred-from-school'
    }); // Staff: Get transferred from other school note.

    $(document).on('click', '.wlsm-view-transferred-from-note', function (event) {
      var element = $(this);
      var studentId = element.data('transferred-from');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['student_id'] = studentId;
      data['view-transferred-from-note-' + studentId] = nonce;
      data['action'] = 'wlsm-view-transferred-from-note';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data);
            }
          });
        },
        theme: 'bootstrap',
        columnClass: 'medium'
      });
    }); // Staff: Delete transferred from other school record.

    $(document).on('click', '.wlsm-delete-transferred-from', function (event) {
      event.preventDefault();
      var studentId = $(this).data('transferred-from');
      var nonce = $(this).data('nonce');
      var data = "student_id=" + studentId + "&delete-transferred-from-" + studentId + "=" + nonce + "&action=wlsm-delete-transferred-from";

      var performActions = function performActions() {
        transferredFromSchoolTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Books Table.

    var booksTable = $('#wlsm-books-table');
    wlsmInitializeTable(booksTable, {
      action: 'wlsm-fetch-books'
    }); // Staff: Save book.

    var saveBookFormId = '#wlsm-save-book-form';
    var saveBookForm = $(saveBookFormId);
    var saveBookBtn = $('#wlsm-save-book-btn');
    saveBookForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveBookBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveBookFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveBookForm[0].reset();
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveBookFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveBookFormId, saveBookBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveBookBtn);
      }
    }); // Staff: Delete book.

    $(document).on('click', '.wlsm-delete-book', function (event) {
      var bookId = $(this).data('book');
      var nonce = $(this).data('nonce');
      var data = "book_id=" + bookId + "&delete-book-" + bookId + "=" + nonce + "&action=wlsm-delete-book";

      var performActions = function performActions() {
        booksTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Return date.

    $('#wlsm_return_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true
    }); // Staff: Issue book.

    var issueBookFormId = '#wlsm-issue-book-form';
    var issueBookForm = $(issueBookFormId);
    var issueBookBtn = $('#wlsm-issue-book-btn');
    $(document).on('click', '#wlsm-issue-book-btn', function (e) {
      var issueBookBtn = $(this);
      e.preventDefault();
      $.confirm({
        title: issueBookBtn.data('message-title'),
        content: issueBookBtn.data('message-content'),
        type: 'blue',
        useBootstrap: false,
        buttons: {
          confirm: {
            text: issueBookBtn.data('submit'),
            btnClass: 'btn-primary',
            action: function action() {
              issueBookForm.ajaxSubmit({
                beforeSubmit: function beforeSubmit(arr, $form, options) {
                  return wlsmBeforeSubmit(issueBookBtn);
                },
                success: function success(response) {
                  if (response.success) {
                    wlsmShowSuccessAlert(response.data.message, issueBookFormId);
                    toastr.success(response.data.message);
                    issueBookForm[0].reset();
                  } else {
                    wlsmDisplayFormErrors(response, issueBookFormId);
                  }
                },
                error: function error(response) {
                  wlsmDisplayFormError(response, issueBookFormId, issueBookBtn);
                },
                complete: function complete(event, xhr, settings) {
                  wlsmComplete(issueBookBtn);
                }
              });
            }
          },
          cancel: {
            text: issueBookBtn.data('cancel'),
            action: function action() {
              return;
            }
          }
        }
      });
    }); // Staff: Books Issued Table.

    var booksIssuedTable = $('#wlsm-books-issued-table');
    wlsmInitializeTable(booksIssuedTable, {
      action: 'wlsm-fetch-books-issued'
    }); // Staff: Delete book issued.

    $(document).on('click', '.wlsm-delete-book-issued', function (event) {
      var bookIssuedId = $(this).data('book-issued');
      var nonce = $(this).data('nonce');
      var data = "book_issued_id=" + bookIssuedId + "&delete-book-issued-" + bookIssuedId + "=" + nonce + "&action=wlsm-delete-book-issued";

      var performActions = function performActions() {
        booksIssuedTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Mark issued book as returned.

    $(document).on('click', '.wlsm-mark-book-as-returned', function (event) {
      var bookIssuedId = $(this).data('book-issued');
      var nonce = $(this).data('nonce');
      var data = "book_issued_id=" + bookIssuedId + "&mark-book-as-returned-" + bookIssuedId + "=" + nonce + "&action=wlsm-mark-book-as-returned";

      var performActions = function performActions() {
        booksIssuedTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions, 'green');
    }); // Staff: Library Cards Table.

    var libraryCardsTable = $('#wlsm-library-cards-table');
    wlsmInitializeTable(libraryCardsTable, {
      action: 'wlsm-fetch-library-cards'
    }); // Staff: Manage library cards.

    var manageLibraryCardsFormId = '#wlsm-issue-library-cards-form';
    var manageLibraryCardsForm = $(manageLibraryCardsFormId);
    var manageLibraryCardsBtn = $('#wlsm-manage-library-cards-btn');
    $(document).on('click', '#wlsm-manage-library-cards-btn', function (e) {
      var studentsLibraryCards = $('.wlsm-students-library-cards');
      var classId = $('#wlsm_class').val();
      var sectionId = $('#wlsm_section').val();
      var dateIssued = $('#wlsm_date_issued').val();
      var nonce = $(this).data('nonce');
      var data = {};
      data['class_id'] = classId;
      data['section_id'] = sectionId;
      data['date_issued'] = dateIssued;
      data['nonce'] = nonce;
      data['action'] = 'wlsm-manage-library-cards';

      if (nonce) {
        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          beforeSend: function beforeSend() {
            return wlsmBeforeSubmit(manageLibraryCardsBtn);
          },
          success: function success(response) {
            if (response.success) {
              studentsLibraryCards.html(response.data.html);
            } else {
              wlsmDisplayFormErrors(response, manageLibraryCardsFormId);
            }
          },
          error: function error(response) {
            wlsmDisplayFormError(response, manageLibraryCardsFormId, manageLibraryCardsBtn);
          },
          complete: function complete(event, xhr, settings) {
            wlsmComplete(manageLibraryCardsBtn);
          }
        });
      } else {
        studentsLibraryCards.html('');
      }
    }); // Staff: Issue library cards.

    $(document).on('click', '#wlsm-issue-library-cards-btn', function (e) {
      var manageLibraryCardsBtn = $(this);
      e.preventDefault();
      $.confirm({
        title: manageLibraryCardsBtn.data('message-title'),
        content: manageLibraryCardsBtn.data('message-content'),
        type: 'green',
        useBootstrap: false,
        buttons: {
          confirm: {
            text: manageLibraryCardsBtn.data('submit'),
            btnClass: 'btn-success',
            action: function action() {
              manageLibraryCardsForm.ajaxSubmit({
                beforeSubmit: function beforeSubmit(arr, $form, options) {
                  return wlsmBeforeSubmit(manageLibraryCardsBtn);
                },
                success: function success(response) {
                  if (response.success) {
                    $('.wlsm-students-library-cards-box').load(location.href + " " + '.wlsm-students-library-cards', function () {});
                    wlsmShowSuccessAlert(response.data.message, manageLibraryCardsFormId);
                    toastr.success(response.data.message);
                  } else {
                    wlsmDisplayFormErrors(response, manageLibraryCardsFormId);
                  }
                },
                error: function error(response) {
                  wlsmDisplayFormError(response, manageLibraryCardsFormId, manageLibraryCardsBtn);
                },
                complete: function complete(event, xhr, settings) {
                  wlsmComplete(manageLibraryCardsBtn);
                }
              });
            }
          },
          cancel: {
            text: manageLibraryCardsBtn.data('cancel'),
            action: function action() {
              return;
            }
          }
        }
      });
    }); // Staff: Delete issued library card.

    $(document).on('click', '.wlsm-delete-library-card', function (event) {
      var libraryCardId = $(this).data('library-card');
      var nonce = $(this).data('nonce');
      var data = "library_card_id=" + libraryCardId + "&delete-library-card-" + libraryCardId + "=" + nonce + "&action=wlsm-delete-library-card";

      var performActions = function performActions() {
        libraryCardsTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Print library card.

    $(document).on('click', '.wlsm-print-library-card', function (event) {
      var element = $(this);
      var libraryCardId = element.data('library-card');
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var data = {};
      data['library_card_id'] = libraryCardId;
      data['print-library-card-' + libraryCardId] = nonce;
      data['action'] = 'wlsm-print-library-card';
      $.dialog({
        title: title,
        content: function content() {
          var self = this;
          return $.ajax({
            data: data,
            url: ajaxurl,
            type: 'POST',
            success: function success(res) {
              self.setContent(res.data.html);
            }
          });
        },
        theme: 'bootstrap',
        useBootstrap: false,
        columnClass: 'large',
        backgroundDismiss: true
      });
    }); // Staff: View library card.

    $(document).on('click', '.wlsm-view-library-card', function () {
      var element = $(this);
      var studentsSelected = $("#wlsm_student :selected");
      var length = studentsSelected.length;
      var studentId = studentsSelected.val();
      var title = element.data('message-title');
      var nonce = element.data('nonce');
      var onlyOneStudent = element.data('only-one-student');

      if (1 === length && studentId && nonce) {
        var data = {};
        data['student_id'] = studentId;
        data['view-library-card'] = nonce;
        data['action'] = 'wlsm-view-library-card';
        $.dialog({
          title: title,
          content: function content() {
            var self = this;
            return $.ajax({
              data: data,
              url: ajaxurl,
              type: 'POST',
              success: function success(res) {
                if (res.success) {
                  self.setContent(res.data.html);
                } else {
                  self.setContent('<div class="text-danger wlsm-font-bold">' + res.data + '</div>');
                }
              }
            });
          },
          theme: 'bootstrap',
          columnClass: 'large',
          containerFluid: true,
          backgroundDismiss: true
        });
      } else {
        toastr.error(onlyOneStudent);
      }
    }); // Staff: Vehicles Table.

    var vehiclesTable = $('#wlsm-vehicles-table');
    wlsmInitializeTable(vehiclesTable, {
      action: 'wlsm-fetch-vehicles'
    }); // Staff: Save vehicle.

    var saveVehicleFormId = '#wlsm-save-vehicle-form';
    var saveVehicleForm = $(saveVehicleFormId);
    var saveVehicleBtn = $('#wlsm-save-vehicle-btn');
    saveVehicleForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveVehicleBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveVehicleFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveVehicleForm[0].reset();
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveVehicleFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveVehicleFormId, saveVehicleBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveVehicleBtn);
      }
    }); // Staff: Delete vehicle.

    $(document).on('click', '.wlsm-delete-vehicle', function (event) {
      var vehicleId = $(this).data('vehicle');
      var nonce = $(this).data('nonce');
      var data = "vehicle_id=" + vehicleId + "&delete-vehicle-" + vehicleId + "=" + nonce + "&action=wlsm-delete-vehicle";

      var performActions = function performActions() {
        vehiclesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Routes Table.

    var routesTable = $('#wlsm-routes-table');
    wlsmInitializeTable(routesTable, {
      action: 'wlsm-fetch-routes'
    }); // Staff: Save route.

    var saveRouteFormId = '#wlsm-save-route-form';
    var saveRouteForm = $(saveRouteFormId);
    var saveRouteBtn = $('#wlsm-save-route-btn');
    saveRouteForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveRouteBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveRouteFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            saveRouteForm[0].reset();
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          } else {
            $('.wlsm-section-heading-box').load(location.href + " " + '.wlsm-section-heading', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveRouteFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveRouteFormId, saveRouteBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveRouteBtn);
      }
    }); // Staff: Delete route.

    $(document).on('click', '.wlsm-delete-route', function (event) {
      var routeId = $(this).data('route');
      var nonce = $(this).data('nonce');
      var data = "route_id=" + routeId + "&delete-route-" + routeId + "=" + nonce + "&action=wlsm-delete-route";

      var performActions = function performActions() {
        routesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Get transport report.

    var getTransportReportFormId = '#wlsm-get-transport-report-form';
    var getTransportReportForm = $(getTransportReportFormId);
    var getTransportReportBtn = $('#wlsm-get-transport-report-btn');
    $(document).on('click', '#wlsm-get-transport-report-btn', function (e) {
      var studentsTransport = $('.wlsm-students-transport');
      var classId = $('#wlsm_class').val();
      var sectionId = $('#wlsm_section').val();
      var routeId = $('#wlsm_route').val();
      var vehicleId = $('#wlsm_vehicle').val();
      var nonce = $(this).data('nonce');
      var data = {};
      data['class_id'] = classId;
      data['section_id'] = sectionId;
      data['route_id'] = routeId;
      data['vehicle_id'] = vehicleId;
      data['nonce'] = nonce;
      data['action'] = 'wlsm-get-transport-report';

      if (nonce) {
        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          beforeSend: function beforeSend() {
            return wlsmBeforeSubmit(getTransportReportBtn);
          },
          success: function success(response) {
            if (response.success) {
              studentsTransport.html(response.data.html);
              $('#wlsm-students-transport-table').DataTable({
                'aaSorting': [],
                'responsive': true,
                'lengthMenu': [25, 50, 100, 200],
                'lengthChange': false,
                'dom': 'lBfrtip',
                'select': true,
                'buttons': ['pageLength', {
                  'extend': 'excel',
                  'exportOptions': {
                    'columns': [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    'modifier': {
                      'selected': null
                    }
                  }
                }, {
                  'extend': 'csv',
                  'exportOptions': {
                    'columns': [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    'modifier': {
                      'selected': null
                    }
                  }
                }]
              });
            } else {
              wlsmDisplayFormErrors(response, getTransportReportFormId);
            }
          },
          error: function error(response) {
            wlsmDisplayFormError(response, getTransportReportFormId, getTransportReportBtn);
          },
          complete: function complete(event, xhr, settings) {
            wlsmComplete(getTransportReportBtn);
          }
        });
      } else {
        studentsTransport.html('');
      }
    }); // Staff: Logs Table.

    var logsTable = $('#wlsm-logs-table');
    wlsmInitializeTable(logsTable, {
      action: 'wlsm-fetch-logs'
    }, true); // Staff: Student Leaves Table.

    var studentLeavesTable = $('#wlsm-student-leaves-table');
    wlsmInitializeTable(studentLeavesTable, {
      action: 'wlsm-fetch-student-leaves'
    }); // Leave start date.

    $('#wlsm_leave_start_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true,
      direction: true,
      pair: $('#wlsm_leave_end_date')
    }); // Leave end date.

    $('#wlsm_leave_end_date').Zebra_DatePicker({
      format: wlsmdateformat,
      readonly_element: false,
      show_clear_date: true,
      disable_time_picker: true,
      direction: 1
    }); // Leave for single or multiple days.

    var leaveEndDate = $('.wlsm_leave_end_date');
    var multipleDays = $('input[type="radio"][name="multiple_days"]:checked').val();

    if ('1' === multipleDays) {
      leaveEndDate.show();
    } else {
      leaveEndDate.hide();
    }

    $(document).on('change', 'input[type="radio"][name="multiple_days"]', function () {
      var multipleDays = this.value;
      var leaveStartDate = $('#wlsm_leave_start_date');
      var leaveStartDateLabel = $('label[for="wlsm_leave_start_date"]');

      if ('1' === multipleDays) {
        leaveStartDateLabel.html(leaveStartDate.data('multiple'));
        leaveStartDate.attr('placeholder', leaveStartDate.data('multiple'));
        leaveEndDate.fadeIn();
      } else {
        leaveStartDateLabel.html(leaveStartDate.data('single'));
        leaveStartDate.attr('placeholder', leaveStartDate.data('single'));
        leaveEndDate.fadeOut();
      }
    }); // Staff: Save student leave.

    var saveStudentLeaveFormId = '#wlsm-save-student-leave-form';
    var saveStudentLeaveForm = $(saveStudentLeaveFormId);
    var saveStudentLeaveBtn = $('#wlsm-save-student-leave-btn');
    saveStudentLeaveForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveStudentLeaveBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveStudentLeaveFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            $('#wlsm_description').val('');
            $('#wlsm_leave_start_date').val('');
            $('#wlsm_leave_end_date').val('');
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          }
        } else {
          wlsmDisplayFormErrors(response, saveStudentLeaveFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveStudentLeaveFormId, saveStudentLeaveBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveStudentLeaveBtn);
      }
    }); // Staff: Delete student leave.

    $(document).on('click', '.wlsm-delete-student-leave', function (event) {
      var studentLeaveId = $(this).data('student-leave');
      var nonce = $(this).data('nonce');
      var data = "student_leave_id=" + studentLeaveId + "&delete-student-leave-" + studentLeaveId + "=" + nonce + "&action=wlsm-delete-student-leave";

      var performActions = function performActions() {
        studentLeavesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Staff Leaves Table.

    var staffLeavesTable = $('#wlsm-staff-leaves-table');
    wlsmInitializeTable(staffLeavesTable, {
      action: 'wlsm-fetch-staff-leaves'
    });
    $(document).on('change', 'input[type="radio"][name="multiple_days"]', function () {
      var multipleDays = this.value;
      var leaveStartDate = $('#wlsm_leave_start_date');
      var leaveStartDateLabel = $('label[for="wlsm_leave_start_date"]');

      if ('1' === multipleDays) {
        leaveStartDateLabel.html(leaveStartDate.data('multiple'));
        leaveStartDate.attr('placeholder', leaveStartDate.data('multiple'));
        leaveEndDate.fadeIn();
      } else {
        leaveStartDateLabel.html(leaveStartDate.data('single'));
        leaveStartDate.attr('placeholder', leaveStartDate.data('single'));
        leaveEndDate.fadeOut();
      }
    }); // Staff: Autocomplete single admin.

    var singleAdminSearch = $('#wlsm_single_admin_search');
    $('#wlsm_single_admin_search').autocomplete({
      minLength: 1,
      source: function source(request, response) {
        $.ajax({
          data: 'action=wlsm-get-keyword-admins&keyword=' + request.term,
          url: ajaxurl,
          type: 'POST',
          success: function success(res) {
            if (res.success) {
              response(res.data);
            } else {
              response([]);
            }
          }
        });
      },
      select: function select(event, ui) {
        singleAdminSearch.val('');
        var id = ui.item.ID;
        var label = ui.item.label;
        var adminInput = $('.wlsm_single_admin_input');

        if (adminInput) {
          var adminToAdd = adminInput.map(function () {
            return $(this).val();
          }).get();

          if (-1 !== $.inArray(id, adminToAdd)) {
            return false;
          }
        }

        if (id) {
          $('.wlsm_single_admin').html('' + '<div class="wlsm-single-admin-item mb-1 mt-2">' + '<input class="wlsm_single_admin_input" type="hidden" name="staff" value="' + id + '">' + '<span class="text-primary wlsm-font-bold">' + label + '</span>' + '&nbsp;<i class="fa fa-times bg-danger text-white wlsm-remove-item"></i>' + '</div>' + '');
          return false;
        }

        return false;
      }
    }); // Staff: Save staff leave.

    var saveStaffLeaveFormId = '#wlsm-save-staff-leave-form';
    var saveStaffLeaveForm = $(saveStaffLeaveFormId);
    var saveStaffLeaveBtn = $('#wlsm-save-staff-leave-btn');
    saveStaffLeaveForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveStaffLeaveBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveStaffLeaveFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reset') && response.data.reset) {
            $('.wlsm_single_admin').html('');
            $('#wlsm_description').val('');
            $('#wlsm_leave_start_date').val('');
            $('#wlsm_leave_end_date').val('');
            var selectPicker = $('.selectpicker');
            selectPicker.selectpicker('refresh');
          }
        } else {
          wlsmDisplayFormErrors(response, saveStaffLeaveFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveStaffLeaveFormId, saveStaffLeaveBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveStaffLeaveBtn);
      }
    }); // Staff: Delete staff leave.

    $(document).on('click', '.wlsm-delete-staff-leave', function (event) {
      var staffLeaveId = $(this).data('staff-leave');
      var nonce = $(this).data('nonce');
      var data = "staff_leave_id=" + staffLeaveId + "&delete-staff-leave-" + staffLeaveId + "=" + nonce + "&action=wlsm-delete-staff-leave";

      var performActions = function performActions() {
        staffLeavesTable.DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions);
    }); // Staff: Save school general settings.

    var saveSchoolGeneralSettingsFormId = '#wlsm-save-school-general-settings-form';
    var saveSchoolGeneralSettingsForm = $(saveSchoolGeneralSettingsFormId);
    var saveSchoolGeneralSettingsBtn = $('#wlsm-save-school-general-settings-btn');
    saveSchoolGeneralSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolGeneralSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolGeneralSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          } else {
            $('.wlsm-school-logo-box').load(location.href + " " + '.wlsm-school-logo-section', function () {});
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolGeneralSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolGeneralSettingsFormId, saveSchoolGeneralSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolGeneralSettingsBtn);
      }
    }); // Staff: Save school email carrier settings.

    var saveSchoolEmailCarrierSettingsFormId = '#wlsm-save-school-email-carrier-settings-form';
    var saveSchoolEmailCarrierSettingsForm = $(saveSchoolEmailCarrierSettingsFormId);
    var saveSchoolEmailCarrierSettingsBtn = $('#wlsm-save-school-email-carrier-settings-btn');
    saveSchoolEmailCarrierSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolEmailCarrierSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolEmailCarrierSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolEmailCarrierSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolEmailCarrierSettingsFormId, saveSchoolEmailCarrierSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolEmailCarrierSettingsBtn);
      }
    }); // Trigger TinyMCE on submit.

    function triggerTinyMCE(submitButton) {
      $(submitButton).mousedown(function () {
        tinyMCE.triggerSave();
      });
    }

    triggerTinyMCE('#wlsm-save-general-settings-btn');
    triggerTinyMCE('#wlsm-save-school-email-templates-settings-btn');
    triggerTinyMCE('#wlsm-send-notification-btn');
    triggerTinyMCE('#wlsm-save-event-btn'); // Staff: Save school email templates settings.

    var saveSchoolEmailTemplatesSettingsFormId = '#wlsm-save-school-email-templates-settings-form';
    var saveSchoolEmailTemplatesSettingsForm = $(saveSchoolEmailTemplatesSettingsFormId);
    var saveSchoolEmailTemplatesSettingsBtn = $('#wlsm-save-school-email-templates-settings-btn');
    saveSchoolEmailTemplatesSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolEmailTemplatesSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolEmailTemplatesSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolEmailTemplatesSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolEmailTemplatesSettingsFormId, saveSchoolEmailTemplatesSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolEmailTemplatesSettingsBtn);
      }
    });
    $(document).on('click', '.wlsm-send-test-email', function () {
      var button = $(this);
      var nonce = button.data('nonce');
      var template = button.data('template');
      var to = button.parent().find('.wlsm-send-test-email-to').val();
      var data = {
        'to': to,
        'template': template,
        'send-test-email': nonce,
        'action': 'wlsm-send-test-email'
      };
      $.ajax({
        data: data,
        url: ajaxurl,
        type: 'POST',
        beforeSend: function beforeSend(xhr) {
          $('.wlsm .alert-dismissible').remove();
          return wlsmBeforeSubmit(button);
        },
        success: function success(response) {
          if (response.success) {
            toastr.success(response.data.message);
          } else {
            if (response.data) {
              toastr.error(response.data);
            }
          }
        },
        error: function error(response) {
          if (response.data) {
            toastr.error(response.data);
          }
        },
        complete: function complete(xhr) {
          wlsmComplete(button);
        }
      });
    }); // Staff: Save school sms carrier settings.

    var saveSchoolSMSCarrierSettingsFormId = '#wlsm-save-school-sms-carrier-settings-form';
    var saveSchoolSMSCarrierSettingsForm = $(saveSchoolSMSCarrierSettingsFormId);
    var saveSchoolSMSCarrierSettingsBtn = $('#wlsm-save-school-sms-carrier-settings-btn');
    saveSchoolSMSCarrierSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolSMSCarrierSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolSMSCarrierSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolSMSCarrierSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolSMSCarrierSettingsFormId, saveSchoolSMSCarrierSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolSMSCarrierSettingsBtn);
      }
    }); // Staff: Save school sms templates settings.

    var saveSchoolSMSTemplatesSettingsFormId = '#wlsm-save-school-sms-templates-settings-form';
    var saveSchoolSMSTemplatesSettingsForm = $(saveSchoolSMSTemplatesSettingsFormId);
    var saveSchoolSMSTemplatesSettingsBtn = $('#wlsm-save-school-sms-templates-settings-btn');
    saveSchoolSMSTemplatesSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolSMSTemplatesSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolSMSTemplatesSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolSMSTemplatesSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolSMSTemplatesSettingsFormId, saveSchoolSMSTemplatesSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolSMSTemplatesSettingsBtn);
      }
    });
    $(document).on('click', '.wlsm-send-test-sms', function () {
      var button = $(this);
      var nonce = button.data('nonce');
      var template = button.data('template');
      var to = button.parent().find('.wlsm-send-test-sms-to').val();
      var data = {
        'to': to,
        'template': template,
        'send-test-sms': nonce,
        'action': 'wlsm-send-test-sms'
      };
      $.ajax({
        data: data,
        url: ajaxurl,
        type: 'POST',
        beforeSend: function beforeSend(xhr) {
          $('.wlsm .alert-dismissible').remove();
          return wlsmBeforeSubmit(button);
        },
        success: function success(response) {
          if (response.success) {
            toastr.success(response.data.message);
          } else {
            if (response.data) {
              toastr.error(response.data);
            }
          }
        },
        error: function error(response) {
          if (response.data) {
            toastr.error(response.data);
          }
        },
        complete: function complete(xhr) {
          wlsmComplete(button);
        }
      });
    }); // Staff: Save school payment method settings.

    var saveSchoolPaymentMethodSettingsFormId = '#wlsm-save-school-payment-method-settings-form';
    var saveSchoolPaymentMethodSettingsForm = $(saveSchoolPaymentMethodSettingsFormId);
    var saveSchoolPaymentMethodSettingsBtn = $('#wlsm-save-school-payment-method-settings-btn');
    saveSchoolPaymentMethodSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolPaymentMethodSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolPaymentMethodSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolPaymentMethodSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolPaymentMethodSettingsFormId, saveSchoolPaymentMethodSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolPaymentMethodSettingsBtn);
      }
    }); // Staff: Save school inquiry settings.

    var saveSchoolInquirySettingsFormId = '#wlsm-save-school-inquiry-settings-form';
    var saveSchoolInquirySettingsForm = $(saveSchoolInquirySettingsFormId);
    var saveSchoolInquirySettingsBtn = $('#wlsm-save-school-inquiry-settings-btn');
    saveSchoolInquirySettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolInquirySettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolInquirySettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolInquirySettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolInquirySettingsFormId, saveSchoolInquirySettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolInquirySettingsBtn);
      }
    }); // Staff: Save school registration settings.

    var saveSchoolRegistrationSettingsFormId = '#wlsm-save-school-registration-settings-form';
    var saveSchoolRegistrationSettingsForm = $(saveSchoolRegistrationSettingsFormId);
    var saveSchoolRegistrationSettingsBtn = $('#wlsm-save-school-registration-settings-btn');
    saveSchoolRegistrationSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolRegistrationSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolRegistrationSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolRegistrationSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolRegistrationSettingsFormId, saveSchoolRegistrationSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolRegistrationSettingsBtn);
      }
    }); // Staff: Save school dashboard settings.

    var saveSchoolDashboardSettingsFormId = '#wlsm-save-school-dashboard-settings-form';
    var saveSchoolDashboardSettingsForm = $(saveSchoolDashboardSettingsFormId);
    var saveSchoolDashboardSettingsBtn = $('#wlsm-save-school-dashboard-settings-btn');
    saveSchoolDashboardSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolDashboardSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolDashboardSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolDashboardSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolDashboardSettingsFormId, saveSchoolDashboardSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolDashboardSettingsBtn);
      }
    }); // Staff: Save school charts settings.

    var saveSchoolChartsSettingsFormId = '#wlsm-save-school-charts-settings-form';
    var saveSchoolChartsSettingsForm = $(saveSchoolChartsSettingsFormId);
    var saveSchoolChartsSettingsBtn = $('#wlsm-save-school-charts-settings-btn');
    saveSchoolChartsSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolChartsSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolChartsSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolChartsSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolChartsSettingsFormId, saveSchoolChartsSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolChartsSettingsBtn);
      }
    }); // Staff: Save school zoom settings.

    var saveSchoolZoomSettingsFormId = '#wlsm-save-school-zoom-settings-form';
    var saveSchoolZoomSettingsForm = $(saveSchoolZoomSettingsFormId);
    var saveSchoolZoomSettingsBtn = $('#wlsm-save-school-zoom-settings-btn');
    saveSchoolZoomSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolZoomSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolZoomSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolZoomSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolZoomSettingsFormId, saveSchoolZoomSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolZoomSettingsBtn);
      }
    }); // Staff: Save school logs settings.

    var saveSchoolLogsSettingsFormId = '#wlsm-save-school-logs-settings-form';
    var saveSchoolLogsSettingsForm = $(saveSchoolLogsSettingsFormId);
    var saveSchoolLogsSettingsBtn = $('#wlsm-save-school-logs-settings-btn');
    saveSchoolLogsSettingsForm.ajaxForm({
      beforeSubmit: function beforeSubmit(arr, $form, options) {
        return wlsmBeforeSubmit(saveSchoolLogsSettingsBtn);
      },
      success: function success(response) {
        if (response.success) {
          wlsmShowSuccessAlert(response.data.message, saveSchoolLogsSettingsFormId);
          toastr.success(response.data.message);

          if (response.data.hasOwnProperty('reload') && response.data.reload) {
            window.location.reload();
          }
        } else {
          wlsmDisplayFormErrors(response, saveSchoolLogsSettingsFormId);
        }
      },
      error: function error(response) {
        wlsmDisplayFormError(response, saveSchoolLogsSettingsFormId, saveSchoolLogsSettingsBtn);
      },
      complete: function complete(event, xhr, settings) {
        wlsmComplete(saveSchoolLogsSettingsBtn);
      }
    }); // Bulk Action.

    $(document).on('click', '.bulk-action-btn', function (event) {
      var button = $(this);
      var nonce = button.data('nonce');
      var tableId = '#' + button.parent().parent().parent().attr('id');
      var bulkActionSelect = $('.bulk-action-select');
      var bulkAction = bulkActionSelect.val();
      var entity = bulkActionSelect.data('entity');
      var bulkValues = $("input[name='bulk_data[]']:checked").map(function () {
        return $(this).val();
      }).get();
      var data = {
        'bulk_action': bulkAction,
        'bulk_values': bulkValues,
        'action': 'wlsm-bulk-action',
        'entity': entity,
        'nonce': nonce
      };

      var performActions = function performActions() {
        $(tableId).DataTable().ajax.reload(null, false);
      };

      wlsmAction(event, this, data, performActions, 'red', true);
    }); // Staff: School Dashboard - Active Inquiries table.

    wlsmInitializeDataTable($('.wlsm-stats-active-inquiries-table'), [5, 10]); // Staff: School Dashboard - Enrollment table.

    wlsmInitializeDataTable($('.wlsm-stats-admission-table'), [5, 10, 15]); // Staff: School Dashboard - Payment table.

    wlsmInitializeDataTable($('.wlsm-stats-payment-table'), [5, 10, 15], 'wlsm-fetch-stats-payments'); // Email carriers.

    var wpMail = $('.wlsm_wp_mail');
    var smtp = $('.wlsm_smtp');
    var wlsmEmailCarrier = $('#wlsm_email_carrier').val();

    if ('smtp' === wlsmEmailCarrier) {
      smtp.show();
    } else {
      wpMail.show();
    } // On change email carrier.


    $(document).on('change', '#wlsm_email_carrier', function () {
      var wlsmEmailCarrier = this.value;
      var emailCarrier = $('.wlsm_email_carrier');
      emailCarrier.hide();

      if ('wp_mail' === wlsmEmailCarrier) {
        wpMail.fadeIn();
      } else if ('smtp' === wlsmEmailCarrier) {
        smtp.fadeIn();
      }
    }); // SMS carriers.

    var smsstriker = $('.wlsm_smsstriker');
    var msgclub = $('.wlsm_msgclub');
    var pointsms = $('.wlsm_pointsms');
    var nexmo = $('.wlsm_nexmo');
    var twilio = $('.wlsm_twilio');
    var msg91 = $('.wlsm_msg91');
    var textlocal = $('.wlsm_textlocal');
    var ebulksms = $('.wlsm_ebulksms');
    var pob = $('.wlsm_pob');
    var vinuthan = $('.wlsm_vinuthansms');
    var wlsmSMSCarrier = $('#wlsm_sms_carrier').val();

    if ('msgclub' === wlsmSMSCarrier) {
      msgclub.show();
    } else if ('pointsms' === wlsmSMSCarrier) {
      pointsms.show();
    } else if ('pob' === wlsmSMSCarrier) {
      pob.show();
    } else if ('vinuthan' === wlsmSMSCarrier) {
      vinuthan.show();
    } else if ('smsstriker' === wlsmSMSCarrier) {
      smsstriker.show();
    } else if ('nexmo' === wlsmSMSCarrier) {
      nexmo.show();
    } else if ('msg91' === wlsmSMSCarrier) {
      msg91.show();
    } else if ('textlocal' === wlsmSMSCarrier) {
      textlocal.show();
    } else if ('ebulksms' === wlsmSMSCarrier) {
      ebulksms.show();
    } else {
      twilio.show();
    } // On change sms carrier.


    $(document).on('change', '#wlsm_sms_carrier', function () {
      var wlsmSMSCarrier = this.value;
      var smsCarrier = $('.wlsm_sms_carrier');
      smsCarrier.hide();

      if ('smsstriker' === wlsmSMSCarrier) {
        smsstriker.fadeIn();
      } else if ('msgclub' === wlsmSMSCarrier) {
        msgclub.fadeIn();
      } else if ('pointsms' === wlsmSMSCarrier) {
        pointsms.fadeIn();
      } else if ('pob' === wlsmSMSCarrier) {
        pob.fadeIn();
      } else if ('nexmo' === wlsmSMSCarrier) {
        nexmo.fadeIn();
      } else if ('msg91' === wlsmSMSCarrier) {
        msg91.fadeIn();
      } else if ('textlocal' === wlsmSMSCarrier) {
        textlocal.fadeIn();
      } else if ('twilio' === wlsmSMSCarrier) {
        twilio.fadeIn();
      } else if ('ebulksms' === wlsmSMSCarrier) {
        ebulksms.fadeIn();
      } else if ('vinuthan' === wlsmSMSCarrier) {
        vinuthan.fadeIn();
      }
    }); // Staff: General Actions.

    $(document).on('change', '#wlsm_class', function () {
      var classId = this.value;
      var feesBox = $('#fees-box'); // Removed all Fee types

      $('.wlsm-fee-box').remove();
      var fees_list = $('#fees-box').data('fees-type-list');

      if (feesBox.length) {
        var ftFeePeriods = feesBox.data('fee-periods');
        var ftFeePeriod = feesBox.data('fee-period');
        var ftFeeAmount = feesBox.data('fee-amount');
        var ftFeeType = feesBox.data('fee-type');
        var ftFeeTypePlaceholder = feesBox.data('fee-type-placeholder');
        var ftAmountPlaceholder = feesBox.data('fee-amount-placeholder');
        fees_list.forEach(function (item, index) {
          var class_name = 'class-id-' + item.class_id;
          var feePeriods = '<select name="fee_period[]" class="form-control selectpicker wlsm_fee_period_selectpicker" id="wlsm_fee_period_' + item.ID + '">';
          $.each(ftFeePeriods, function (key, value) {
            var selected = key == item.period ? 'selected' : '';
            feePeriods += '<option value="' + key + '" ' + selected + '>' + value;
            feePeriods += '</option>';
          });
          feePeriods += '</select>';
          feesBox.append('' + '<div class="wlsm-fee-box card col ' + class_name + '" data-fee="' + item.ID + '">' + '<button type="button" class="btn btn-sm btn-danger wlsm-remove-fee-btn"><i class="fas fa-times"></i></button>' + '<input type="hidden" name="fee_id[]" value="' + item.ID + '">' + '<div class="form-row">' + '<div class="form-group col-md-4">' + '<label for="wlsm_fee_label_' + item.ID + '" class="wlsm-font-bold"><span class="wlsm-important">*</span> ' + ftFeeType + ':' + '</label>' + '<input type="text" name="fee_label[]" class="form-control" id="wlsm_fee_label_' + item.ID + '" placeholder="' + ftFeeTypePlaceholder + '" value="' + item.label + '">' + '</div>' + '<div class="form-group col-md-4">' + '<label for="wlsm_fee_period_' + item.ID + '" class="wlsm-font-bold"><span class="wlsm-important">*</span> ' + ftFeePeriod + ':' + '</label>' + feePeriods + '</div>' + '<div class="form-group col-md-4">' + '<label for="wlsm_fee_amount_' + item.ID + '" class="wlsm-font-bold"><span class="wlsm-important">*</span> ' + ftFeeAmount + ':' + '</label>' + '<input type="number" step="1" min="1" name="fee_amount[]" class="form-control" id="wlsm_fee_amount_' + item.ID + '" placeholder="' + ftAmountPlaceholder + '" value="' + item.amount + '">' + '</div>' + '</div>' + '</div>');
        });
        $('.wlsm_fee_period_selectpicker').selectpicker();
        $('.wlsm-fee-box').not('.class-id-' + classId).remove();
      }

      var nonce = $(this).data('nonce');
      var sections = $('#wlsm_section');
      var subjects = $('#wlsm_subject_table');
      var fetchStudents = sections.data('fetch-students');
      $('div.text-danger').remove();

      if (classId && nonce) {
        var data = 'action=wlsm-get-class-sections&nonce=' + nonce + '&class_id=' + classId;

        if (sections.data('all-sections')) {
          data += '&all_sections=1';
        }

        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          success: function success(res) {
            var options = [];
            var subjts = []; // console.log(res);

            res.forEach(function (item) {
              if (typeof item.section.ID !== 'undefined') {
                var option = '<option value="' + item.section.ID + '">' + item.section.label + '</option>';
                options.push(option); // color is undefined
              } // console.log( item.section.ID );

            });
            res.forEach(function (item) {
              if (item.subject) {
                // console.log(item.subject);
                var subj = '<tr><td>' + '<input type="checkbox" name="subjects_list[]" value="' + item.subject.ID + '"> &nbsp;' + item.subject.subject_name + '</td></tr>';
                subjts.push(subj);
              }
            });
            sections.html(options);
            subjects.html(subjts);
            $('#wlsm_subject_table').selectpicker();
            sections.selectpicker('refresh');

            if (fetchStudents) {
              sections.trigger('change');
            }
          }
        });
      } else {
        sections.html([]);
        sections.selectpicker('refresh');

        if (fetchStudents) {
          sections.trigger('change');
        }
      }
    });
    $(document).on('change', '.wlsm_section', function () {
      var classId = $('#wlsm_class').val();
      var sectionId = this.value;

      if (!sectionId) {
        sectionId = 0;
      }

      var nonce = $(this).data('nonce');
      var students = $('#wlsm_student');
      $('div.text-danger').remove();

      if (classId && nonce) {
        var data = 'action=wlsm-get-section-students&nonce=' + nonce + '&section_id=' + sectionId + '&class_id=' + classId;
        var onlyActive = $(this).data('only-active');
        var skipTransferred = $(this).data('skip-transferred');

        if (typeof onlyActive !== 'undefined') {
          data += '&only_active=' + onlyActive;
        }

        if (typeof skipTransferred !== 'undefined') {
          data += '&skip_transferred=' + skipTransferred;
        }

        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          success: function success(res) {
            var options = [];
            res.forEach(function (item) {
              var option = '<option value="' + item.ID + '">' + item.name + ' (' + item.enrollment_number + ')' + '</option>';
              options.push(option);
            });
            students.html(options);
            students.selectpicker('refresh');
          }
        });
      } else {
        students.html([]);
        students.selectpicker('refresh');
      }
    });
    $(document).on('change', '#wlsm_school', function () {
      var schoolId = this.value;
      var nonce = $(this).data('nonce');
      var classes = $('#wlsm_school_class');
      $('div.text-danger').remove();

      if (schoolId && nonce) {
        var data = 'action=wlsm-get-school-classes&nonce=' + nonce + '&school_id=' + schoolId;
        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          success: function success(res) {
            var options = [];
            res.forEach(function (item) {
              var option = '<option value="' + item.ID + '">' + item.label + '</option>';
              options.push(option);
            });
            classes.html(options);
            classes.selectpicker('refresh');
            classes.trigger('change');
          }
        });
      } else {
        classes.html([]);
        classes.selectpicker('refresh');
        classes.trigger('change');
      }
    });
    $(document).on('change', '#wlsm_school_class', function () {
      var schoolId = $('#wlsm_school').val();
      var classId = this.value;
      var nonce = $(this).data('nonce');
      var sections = $('#wlsm_school_class_section');
      $('div.text-danger').remove();

      if (schoolId && classId && nonce) {
        var data = 'action=wlsm-get-school-class-sections&nonce=' + nonce + '&school_id=' + schoolId + '&class_id=' + classId;
        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          success: function success(res) {
            var options = [];
            res.forEach(function (item) {
              var option = '<option value="' + item.ID + '">' + item.label + '</option>';
              options.push(option);
            });
            sections.html(options);
            sections.selectpicker('refresh');
          }
        });
      } else {
        sections.html([]);
        sections.selectpicker('refresh');
      }
    });
    $(document).on('change', '.wlsm_class_subjects', function () {
      var classId = this.value;
      var nonce = $(this).data('nonce-subjects');
      var subjects = $('#wlsm_subject');
      $('div.text-danger').remove();

      if (classId && nonce) {
        var data = 'action=wlsm-get-class-subjects&nonce=' + nonce + '&class_id=' + classId;
        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          success: function success(res) {
            var options = [];
            res.forEach(function (item) {
              var option = '<option value="' + item.ID + '">' + item.label + '</option>';
              options.push(option);
            });
            subjects.html(options);
            subjects.selectpicker('refresh');
          }
        });
      } else {
        subjects.html([]);
        subjects.selectpicker('refresh');
      }
    });
    $(document).on('change', '.wlsm_subject_teachers', function () {
      var subjectId = this.value;
      var nonce = $(this).data('nonce-teachers');
      var teachers = $('#wlsm_teacher');
      $('div.text-danger').remove();

      if (subjectId && nonce) {
        var data = 'action=wlsm-get-subject-teachers&nonce=' + nonce + '&subject_id=' + subjectId;
        $.ajax({
          data: data,
          url: ajaxurl,
          type: 'POST',
          success: function success(res) {
            var options = [];
            res.forEach(function (item) {
              var option = '<option value="' + item.ID + '">' + item.label + '</option>';
              options.push(option);
            });
            teachers.html(options);
            teachers.selectpicker('refresh');
          }
        });
      } else {
        teachers.html([]);
        teachers.selectpicker('refresh');
      }
    });
    var wlsmSendSMS = $('.wlsm-send-sms');
    $(document).on('change', '#wlsm_send_email_notification', function () {
      if ($(this).is(':checked')) {
        wlsmSendEmail.fadeIn();
      } else {
        wlsmSendEmail.hide();
      }
    });
    var wlsmSendEmail = $('.wlsm-send-email');
    $(document).on('change', '#wlsm_send_sms_notification', function () {
      if ($(this).is(':checked')) {
        wlsmSendSMS.fadeIn();
      } else {
        wlsmSendSMS.hide();
      }
    }); // Set certificate data positions.

    var certificateName = $('.ctf-data-name');
    $(document).on('keyup', '#ctf-pos-x-name', function () {
      var pos = $(this).val();
      certificateName.css({
        'left': pos + 'pt'
      });
    });
    $(document).on('keyup', '#ctf-pos-y-name', function () {
      var pos = $(this).val();
      certificateName.css({
        'top': pos + 'pt'
      });
    });
    var certificateRollNumber = $('.ctf-data-roll-number');
    $(document).on('keyup', '#ctf-pos-x-roll-number', function () {
      var pos = $(this).val();
      certificateRollNumber.css({
        'left': pos + 'pt'
      });
    });
    $(document).on('keyup', '#ctf-pos-y-roll-number', function () {
      var pos = $(this).val();
      certificateRollNumber.css({
        'top': pos + 'pt'
      });
    }); // Print.

    function wlsmPrint(targetId, title, styleSheets) {
      var css = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : '';
      var target = $(targetId).html();
      var frame = $('<iframe />');
      frame[0].name = 'frame';
      frame.css({
        'position': 'absolute',
        'top': '-1000000px'
      });
      var that = frame.appendTo('body');
      var frameDoc = frame[0].contentWindow ? frame[0].contentWindow : frame[0].contentDocument.document ? frame[0].contentDocument.document : frame[0].contentDocument;
      frameDoc.document.open(); // Create a new HTML document.

      frameDoc.document.write('<html><head>' + title);
      frameDoc.document.write('</head><body>'); // Append the external CSS file.

      styleSheets.forEach(function (styleSheet, index) {
        $(that).contents().find('head').append('<link href="' + styleSheet + '" rel="stylesheet" type="text/css" referrerpolicy="origin" />');
      });

      if (css) {
        frameDoc.document.write('<style>' + css + '</style>');
      } // Append the target.


      frameDoc.document.write(target);
      frameDoc.document.write('</body></html>');
      frameDoc.document.close();
      setTimeout(function () {
        window.frames["frame"].focus();
        window.frames["frame"].print();
        frame.remove();
      }, 1000);
    } // Print ID card.


    $(document).on('click', '#wlsm-print-id-card-btn', function () {
      var targetId = '#wlsm-print-id-card';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print student detail .

    $(document).on('click', '#wlsm-print-student-detail-btn', function () {
      var targetId = '#wlsm-student-detail';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print ID cards.

    $(document).on('click', '#wlsm-print-id-cards-btn', function () {
      var targetId = '#wlsm-print-id-cards';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print fee structure.

    $(document).on('click', '#wlsm-print-fee-structure-btn', function () {
      var targetId = '#wlsm-print-fee-structure';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print attendance sheet.

    $(document).on('click', '#wlsm-print-attendance-sheet-btn', function () {
      var targetId = '#wlsm-print-attendance-sheet';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print staff attendance sheet.

    $(document).on('click', '#wlsm-print-staff-attendance-sheet-btn', function () {
      var targetId = '#wlsm-print-staff-attendance-sheet';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print invoice.

    $(document).on('click', '#wlsm-print-invoice-btn', function () {
      var targetId = '#wlsm-print-invoice';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print payment.

    $(document).on('click', '#wlsm-print-invoice-payment-btn', function () {
      var targetId = '#wlsm-print-invoice-payment';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print exam time table.

    $(document).on('click', '#wlsm-print-exam-time-table-btn', function () {
      var targetId = '#wlsm-print-exam-time-table';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print exam admit card.

    $(document).on('click', '#wlsm-print-exam-admit-card-btn', function () {
      var targetId = '#wlsm-print-exam-admit-card';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print exam results.

    $(document).on('click', '#wlsm-print-exam-results-btn', function () {
      var targetId = '#wlsm-print-exam-results';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print certficate.

    $(document).on('click', '#wlsm-print-certificate-btn', function () {
      var targetId = '#wlsm-print-certificate';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      var css = $(this).data('css');
      wlsmPrint(targetId, title, styleSheets, css);
    }); // Print class timetable.

    $(document).on('click', '#wlsm-print-class-timetable-btn', function () {
      var targetId = '#wlsm-print-class-timetable';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print library card.

    $(document).on('click', '#wlsm-print-library-card-btn', function () {
      var targetId = '#wlsm-print-library-card';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print results assessment.

    $(document).on('click', '#wlsm-print-result-assessment-btn', function () {
      var targetId = '#wlsm-print-results-assessment';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    }); // Print results subject-wise.

    $(document).on('click', '#wlsm-print-result-subject-wise-btn', function () {
      var targetId = '#wlsm-print-results-subject-wise';
      var title = $(this).data('title');

      if (title) {
        title = '<title>' + title + '</title>';
      }

      var styleSheets = $(this).data('styles');
      wlsmPrint(targetId, title, styleSheets);
    });
  });
})(jQuery);