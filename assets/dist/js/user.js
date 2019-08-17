/**
 * ------------------------------------------------------------------------------
 * Controller Specific DOM Interaction (Ready/Load, Click, Hover, Change)
 * ------------------------------------------------------------------------------
 */

$(domReady);

function domReady() {
    //Index View:
    if (ROUTER_METHOD == 'manage') {
        renderDataTable();
    }

    //Date of Birth Date Picker
    $('#user_dob').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        autoclose: true,
        endDate: '-18y',
        container: $('#user_dob').parent()
    });

    $('#user_doj').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        autoclose: true
    });

    $('.job-exp-datepicker').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        autoclose: true
    });

    //select2  #academic_specialization
    //render_select2_specialization();
    //render_select2_degree();
    //render_select2_institute();

    $('#academic_degree').select2({
        //tags: true,
    }).on('select2:close', function() {
        add_new_item1('degree', $(this));
    });

    $('#academic_specialization').select2({
        //tags: true,
    }).on('select2:close', function() {
        add_new_item2('specialization', $(this));
    });

    $('#academic_institute').select2({
        //tags: true,
    }).on('select2:close', function() {
        add_new_item3('institute', $(this));
    });

    $('#prev_company_id').select2({
        //tags: true,
    }).on('select2:close', function() {
        add_new_item4('prev_company', $(this));
    });

    $('#prev_designation_id').select2({
        //tags: true,
    }).on('select2:close', function() {
        add_new_item5('prev_designation', $(this));
    });

    if (ROUTER_METHOD == 'edit_approvers') {
        //get_user_suggestion();
    }

} //domready

$('body').on('click', '.change_account_status', changeAccountStatus);

function add_new_item(type, el) {
    console.log(type);
    console.log(el);
}


/**
 * ------------------------------------------------------------------------------
 * Controller Specific JS Function
 * ------------------------------------------------------------------------------
 */

var table;

function renderDataTable() {
    table = $('#user-datatable').DataTable({
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        pageLength: 25,
        order: [], //Initial no order.
        // Load data for the table's content from an Ajax source
        ajax: {
            url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/render_datatable',
        },
        //Set column definition initialisation properties.
        columnDefs: [{
            targets: [-1], //last column
            orderable: false, //set not orderable
        }, ],
        initComplete: function() {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
}

function changeAccountStatus(e) {
    e.preventDefault();

    var elChangeStatusBtn = $(this);
    var new_status = elChangeStatusBtn.attr('data-status');
    var user_id = elChangeStatusBtn.attr('data-id');

    var xhr = new Ajax();
    xhr.type = 'POST';
    xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/change_account_status';
    xhr.data = {
        active: new_status,
        user_id: user_id
    };
    xhr.beforeSend = function() {
        showAjaxLoader();
    }
    var promise = xhr.init();
    promise.done(function(response) {
        if (response.status == 'success') {
            hideAjaxLoader();
            if (elChangeStatusBtn.attr('data-status') == 'Y') {
                elChangeStatusBtn.attr('data-status', 'N');
                elChangeStatusBtn.html('Deactivate');
                elChangeStatusBtn.removeClass('btn-outline-success').addClass('btn-outline-danger');
                $('.account-status[data-user-id="' + user_id + '"]').removeClass('badge-danger').addClass('badge-success').text('Active Account');

            } else if (elChangeStatusBtn.attr('data-status') == 'N') {
                elChangeStatusBtn.attr('data-status', 'Y');
                elChangeStatusBtn.html('Activate');
                elChangeStatusBtn.removeClass('btn-outline-danger').addClass('btn-outline-success');
                $('.account-status[data-user-id="' + user_id + '"]').removeClass('badge-success').addClass('badge-danger').text('Inactive Account');
            }

        }
    });
    promise.fail(function() {
        alert("Failed");
    });
    promise.always(function() {

    });
}

function add_new_item1(item, el) {
    if (el.val() == "-1") {
        var modal = $('#addDegree');
        var input_text = $('#new_degree_name');
        var modalMsgDiv = $('#responseMessage_addDegree');
        var btnSave = $('#btnAddDegree');
        modalMsgDiv.html('');
        input_text.val('');
        modal.modal('show');
        btnSave.on('click', function() {
            //alert('D');
            var xhr = new Ajax();
            xhr.type = 'POST';
            xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/add_user_input_degree';
            xhr.data = {
                degree_name: input_text.val(),
                action: 'add'
            };
            xhr.beforeSend = function() {
                showAjaxLoader();
            }
            var promise = xhr.init();
            promise.done(function(response) {
                //console.log(response);
                hideAjaxLoader();
                if (response.msg) {
                    modalMsgDiv.html(response.msg);
                }
                if (response.insert_id) {
                    // Append Newly added Data and Make Seleetd it                        
                    el.append($('<option>', {
                        value: response.insert_id,
                        text: input_text.val()
                    }));
                    $('#academic_degree option[value=' + response.insert_id + ']').attr('selected', 'selected');

                    // Reset UI
                    modal.modal('hide');
                }
            });
            promise.fail(function() {
                alert("Sorry, Can not process your request.");
            });
            promise.always(function() {

            });
        });
    }
}

function add_new_item2(item, el) {
    if (el.val() == "-1") {
        var modal = $('#addSpecialization');
        var input_text = $('#new_specialization_name');
        var modalMsgDiv = $('#responseMessage_addSpecialization');
        var btnSave = $('#btnAddSpecialization');
        modalMsgDiv.html('');
        input_text.val('');
        modal.modal('show');
        btnSave.on('click', function() {
            //alert('S');
            var xhr = new Ajax();
            xhr.type = 'POST';
            xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/add_user_input_specialization';
            xhr.data = {
                specialization_name: input_text.val(),
                action: 'add'
            };
            xhr.beforeSend = function() {
                showAjaxLoader();
            }
            var promise = xhr.init();
            promise.done(function(response) {
                hideAjaxLoader();
                //console.log(response);
                if (response.msg) {
                    modalMsgDiv.html(response.msg);
                }
                if (response.insert_id) {
                    // Append Newly added Data and Make Seleetd it                        
                    el.append($('<option>', {
                        value: response.insert_id,
                        text: input_text.val()
                    }));
                    $('#academic_specialization option[value=' + response.insert_id + ']').attr('selected', 'selected');

                    // Reset UI
                    modal.modal('hide');
                }
            });
            promise.fail(function() {
                alert("Sorry, Can not process your request.");
            });
            promise.always(function() {

            });
        });
    }
}

function add_new_item3(item, el) {
    if (el.val() == "-1") {
        var modal = $('#addInst');
        var input_text = $('#new_inst_name');
        var modalMsgDiv = $('#responseMessage_addInst');
        var btnSave = $('#btnAddInst');
        modalMsgDiv.html('');
        input_text.val('');
        modal.modal('show');
        btnSave.on('click', function() {
            //alert('I');
            var xhr = new Ajax();
            xhr.type = 'POST';
            xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/add_user_input_institute';
            xhr.data = {
                institute_name: input_text.val(),
                action: 'add'
            };
            xhr.beforeSend = function() {
                showAjaxLoader();
            }
            var promise = xhr.init();
            promise.done(function(response) {
                hideAjaxLoader();
                //console.log(response);
                if (response.msg) {
                    modalMsgDiv.html(response.msg);
                }
                if (response.insert_id) {
                    // Append Newly added Data and Make Seleetd it                        
                    el.append($('<option>', {
                        value: response.insert_id,
                        text: input_text.val()
                    }));
                    $('#academic_institute option[value=' + response.insert_id + ']').attr('selected', 'selected');

                    // Reset UI
                    modal.modal('hide');
                }
            });
            promise.fail(function() {
                alert("Sorry, Can not process your request.");
            });
            promise.always(function() {

            });
        });
    }
}

function add_new_item4(item, el) {
    if (el.val() == "-1") {
        var modal = $('#addCompany');
        var input_text = $('#new_company_name');
        var modalMsgDiv = $('#responseMessage_addCompany');
        var btnSave = $('#btnaddCompany');
        modalMsgDiv.html('');
        input_text.val('');
        modal.modal('show');
        btnSave.on('click', function() {
            //alert('I');
            var xhr = new Ajax();
            xhr.type = 'POST';
            xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/add_user_input_company';
            xhr.data = {
                company_name: input_text.val(),
                action: 'add'
            };
            xhr.beforeSend = function() {
                showAjaxLoader();
            }
            var promise = xhr.init();
            promise.done(function(response) {
                hideAjaxLoader();
                //console.log(response);
                if (response.msg) {
                    modalMsgDiv.html(response.msg);
                }
                if (response.insert_id) {
                    // Append Newly added Data and Make Seleetd it                        
                    el.append($('<option>', {
                        value: response.insert_id,
                        text: input_text.val()
                    }));
                    $('#prev_company_id option[value=' + response.insert_id + ']').attr('selected', 'selected');

                    // Reset UI
                    modal.modal('hide');
                }
            });
            promise.fail(function() {
                alert("Sorry, Can not process your request.");
            });
            promise.always(function() {

            });
        });
    }
}

function add_new_item5(item, el) {
    if (el.val() == "-1") {
        var modal = $('#addDesignation');
        var input_text = $('#new_designation_name');
        var modalMsgDiv = $('#responseMessage_addDesignation');
        var btnSave = $('#btnaddDesignation');
        modalMsgDiv.html('');
        input_text.val('');
        modal.modal('show');
        btnSave.on('click', function() {
            //alert('I');
            var xhr = new Ajax();
            xhr.type = 'POST';
            xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/add_user_input_designation';
            xhr.data = {
                designation_name: input_text.val(),
                action: 'add'
            };
            xhr.beforeSend = function() {
                showAjaxLoader();
            }
            var promise = xhr.init();
            promise.done(function(response) {
                hideAjaxLoader();
                //console.log(response);
                if (response.msg) {
                    modalMsgDiv.html(response.msg);
                }
                if (response.insert_id) {
                    // Append Newly added Data and Make Seleetd it                        
                    el.append($('<option>', {
                        value: response.insert_id,
                        text: input_text.val()
                    }));
                    $('#prev_designation_id option[value=' + response.insert_id + ']').attr('selected', 'selected');

                    // Reset UI
                    modal.modal('hide');
                }
            });
            promise.fail(function() {
                alert("Sorry, Can not process your request.");
            });
            promise.always(function() {

            });
        });
    }
}

function get_user_suggestion() {
    //alert('get_user_suggestion');
    $('.user-serach-dropdown-ajax').select2({
        placeholder: 'Employee Name or ID',
        ajax: {
            url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/get_user_suggestion',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    // var xhr = new Ajax();
    // xhr.type = 'POST';
    // xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/get_user_suggestion';
    // xhr.data = {};
    // xhr.beforeSend = function() {
    //     showAjaxLoader();
    // }
    // var promise = xhr.init();
    // promise.done(function(response) {
    //     console.log(response);
    //     hideAjaxLoader();
    // });
    // promise.fail(function() {
    //     alert("Sorry, Can not process your request.");
    // });
    // promise.always(function() {

    // });
}