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
    $('.dob-datepicker').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        autoclose: true
    });

    //select2  #academic_specialization
    render_select2_specialization();
    render_select2_degree();
    render_select2_institute();
} //domready

$('body').on('click', '.change_account_status', changeAccountStatus);




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


function render_select2_specialization() {
    var formControlSelectSpecialization = $('#academic_specialization');
    formControlSelectSpecialization.select2({
        //tags: true,
    }).on('select2:close', function() {
        var el = $(this);
        if (el.val() == "-1") {
            //var newval = prompt("Enter new value: ");
            var modal = $('#addNewItemModal');
            var input_text = $('#new_input_value');
            var modalMsgDiv = $('#responseMessage');

            var btnAddSpecialization = $('#btnAddSpecialization');
            var btnAddDegree = $('#btnAddDegree');
            var btnAddInstitute = $('#btnAddInstitute');

            modalMsgDiv.html('');
            input_text.val('');
            $('#addNewItemModalTitle').html('Add New Specialization');
            btnAddSpecialization.removeClass('d-none');
            btnAddDegree.addClass('d-none');
            btnAddInstitute.addClass('d-none');
            modal.modal('show');

            btnAddSpecialization.on('click', function() {
                var xhr = new Ajax();
                xhr.type = 'POST';
                xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/add_user_input_specialization';
                xhr.data = {
                    specialization_name: input_text.val(),
                    action: 'add'
                };
                xhr.beforeSend = function() {}
                var promise = xhr.init();
                promise.done(function(response) {
                    console.log(response);
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
                        modalMsgDiv.html();
                        input_text.val('');
                        $('.modal-action-btn').addClass('d-none');
                        $('#addNewItemModalTitle').html('');
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
    });
}


function render_select2_degree() {
    var formControlSelectDegree = $('#academic_degree');
    formControlSelectDegree.select2({
        //tags: true,
    }).on('select2:close', function() {
        var el = $(this);
        if (el.val() == "-1") {
            //var newval = prompt("Enter new value: ");
            var modal = $('#addNewItemModal');
            var input_text = $('#new_input_value');
            var modalMsgDiv = $('#responseMessage');

            var btnAddSpecialization = $('#btnAddSpecialization');
            var btnAddDegree = $('#btnAddDegree');
            var btnAddInstitute = $('#btnAddInstitute');

            modalMsgDiv.html('');
            input_text.val('');
            $('#addNewItemModalTitle').html('Add New Degree');
            btnAddDegree.removeClass('d-none');
            btnAddInstitute.addClass('d-none');
            btnAddSpecialization.addClass('d-none');
            modal.modal('show');

            btnAddDegree.on('click', function() {
                var xhr = new Ajax();
                xhr.type = 'POST';
                xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/add_user_input_degree';
                xhr.data = {
                    degree_name: input_text.val(),
                    action: 'add'
                };
                xhr.beforeSend = function() {}
                var promise = xhr.init();
                promise.done(function(response) {
                    console.log(response);
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
                        modalMsgDiv.html();
                        input_text.val('');
                        $('#addNewItemModalTitle').html('');
                        $('.modal-action-btn').addClass('d-none');
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
    });
}


function render_select2_institute() {
    var formControlSelectInst = $('#academic_institute');
    formControlSelectInst.select2({
        //tags: true,
    }).on('select2:close', function() {
        var el = $(this);
        if (el.val() == "-1") {
            //var newval = prompt("Enter new value: ");
            var modal = $('#addNewItemModal');
            var input_text = $('#new_input_value');
            var modalMsgDiv = $('#responseMessage');

            var btnAddSpecialization = $('#btnAddSpecialization');
            var btnAddDegree = $('#btnAddDegree');
            var btnAddInstitute = $('#btnAddInstitute');

            modalMsgDiv.html('');
            input_text.val('');
            $('#addNewItemModalTitle').html('Add New University/Board/Council');
            btnAddInstitute.removeClass('d-none');
            btnAddSpecialization.addClass('d-none');
            btnAddDegree.addClass('d-none');
            modal.modal('show');

            btnAddInstitute.on('click', function() {
                var xhr = new Ajax();
                xhr.type = 'POST';
                xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/add_user_input_institute';
                xhr.data = {
                    institute_name: input_text.val(),
                    action: 'add'
                };
                xhr.beforeSend = function() {}
                var promise = xhr.init();
                promise.done(function(response) {
                    console.log(response);
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
                        modalMsgDiv.html();
                        input_text.val('');
                        $('.modal-action-btn').addClass('d-none');
                        $('#addNewItemModalTitle').html('');
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
    });
}