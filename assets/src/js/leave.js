$(function() {

    if (ROUTER_METHOD == 'import_data') {
        renderLeaveBalanceDataTable();
    }

    if (ROUTER_METHOD == 'view_leave_balance') {
        renderLeaveBalDataTable();
    }

    //showAjaxLoader();
    $('#leave_from_date').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        autoclose: true,
        startDate: '-3m',
        container: $('#leave_from_date').parent()
    });

    $('#leave_to_date').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        autoclose: true,
        startDate: '-3m',
        container: $('#leave_to_date').parent()
    });

    //Show modal on clicking action link
    $('[data-action-by]').on('click', function(e) {
        e.preventDefault();
        $("#leaveActionModal input[name='action_by_approver']").val($(this).attr('data-action-by'));
        $("#leaveActionModal input[name='action_by_approver_id']").val($(this).attr('data-action-by-userid'));
        $('#leaveActionModal').modal('show');
    });
    $('#btnManageLeave').on('click', manage_leave_req);

    //On user drop down change get leave balance
    $('#user_dropdown').on('change', function() {
        var user_id = $(this).val();
        var xhr = new Ajax();
        xhr.type = 'POST';
        xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/get_user_leave_balance';
        xhr.data = {
            user_id: user_id,
            action: 'ajax',
        };
        xhr.beforeSend = function() {
            showAjaxLoader();
        }
        var promise = xhr.init();
        promise.done(function(response) {
            console.log(response);
            var form_id = '#ci-form-leavebalance';
            if (response.data != null) {
                $(form_id + ' input[name="id"]').val(response.data.id);
                $(form_id + ' input[name="cl"]').val(response.data.cl);
                $(form_id + ' input[name="sl"]').val(response.data.sl);
                $(form_id + ' input[name="pl"]').val(response.data.pl);
                $(form_id + ' input[name="ol"]').val(response.data.ol);

                $('#created_on').html(response.data.created_on);
                $('#updated_on').html(response.data.updated_on);
                $('#pl_updated_by_cron_on').html(response.data.pl_updated_by_cron_on);
                $('#cl_updated_by_cron_on').html(response.data.cl_updated_by_cron_on);
                $('#ol_updated_by_cron_on').html(response.data.ol_updated_by_cron_on);

            } else {
                $(form_id + ' input[name="id"]').val('');
                $(form_id + ' input[name="cl"]').val('');
                $(form_id + ' input[name="sl"]').val('');
                $(form_id + ' input[name="pl"]').val('');
                $(form_id + ' input[name="ol"]').val('');
                $('#created_on').html('');
                $('#updated_on').html('');
                $('#pl_updated_by_cron_on').html('');
                $('#cl_updated_by_cron_on').html('');
                $('#ol_updated_by_cron_on').html('');
            }
            hideAjaxLoader();
        });
        promise.fail(function() {
            alert("Sorry, Can not process your request.");
        });
        promise.always(function() {

        });
    });

    $('#import_form').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
                url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/import',
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#userfile').val('');
                    //load_data();
                    console.log(data);
                    leave_balance_datatable.ajax.reload();
                }
            })
            // var xhr = new Ajax();
            // xhr.type = 'POST';
            // xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/import';
            // xhr.data = formData;
            // xhr.beforeSend = function() {
            //     showAjaxLoader();
            // }
            // var promise = xhr.init();
            // promise.done(function(response) {
            //     console.log(response);
            //     hideAjaxLoader();
            //     $('#file').val('');
            // });
            // promise.fail(function() {
            //     alert("Sorry, Can not process your request.");
            // });
            // promise.always(function() {

        // });
    });
});

function renderLeaveBalDataTable() {
    table = $('#view-leave-bal-datatable').DataTable({
        /*dom: 'Bfrtip',
        buttons: [
        	'copy', 'csv', 'excel', 'pdf', 'print'
        ],*/
        iDisplayLength: 50,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order: [], //Initial no order.
        // Load data for the table's content from an Ajax source
        ajax: {
            url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/render_leave_bal_datatable',
        },
        //Set column definition initialisation properties.
        columnDefs: [{
            targets: [-1], //last column
            orderable: false, //set not orderable
        }, ],
    });
}


function manage_leave_req(e) {
    // console.log(e);
    var xhr = new Ajax();
    xhr.type = 'POST';
    xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/update_leave_status';
    xhr.data = {
        leave_id: $('#leave_id').val(),
        leave_req_id: $('#leave_req_id').val(),
        action_by_approver: $('#action_by_approver').val(),
        action_by_approver_id: $('#action_by_approver_id').val(),
        leave_status: $('#leave_action_status').val(),
        leave_comments: $('#leave_action_comment').val(),
        action: 'update',
    };
    xhr.beforeSend = function() {
        showAjaxLoader();
    }
    var promise = xhr.init();
    promise.done(function(response) {
        // console.log(response);
        hideAjaxLoader();
        if (response.msg) {
            $('#responseMessage_leaveActionModal').removeClass('alert alert-danger alert-success').addClass(response.css);
            $('#responseMessage_leaveActionModal').empty().html(response.msg);
        }
        if (response.updated == true) {
            $('#leaveActionModal').modal('hide');
            window.location.reload(true);
        }
    });
    promise.fail(function() {
        alert("Sorry, Can not process your request.");
    });
    promise.always(function() {

    });
}

/**
 * ------------------------------------------------------------------------------
 * Controller Specific JS Function
 * ------------------------------------------------------------------------------
 */
function renderLeaveBalanceDataTable() {
    leave_balance_datatable = $('#leave_balance_datatable').DataTable({
        /*dom: 'Bfrtip',
        buttons: [
        	'copy', 'csv', 'excel', 'pdf', 'print'
        ],*/
        iDisplayLength: 100,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order: [], //Initial no order.
        // Load data for the table's content from an Ajax source
        ajax: {
            url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/render_leave_balance_datatable',
        },
        //Set column definition initialisation properties.
        columnDefs: [{
            targets: [-1], //last column
            orderable: false, //set not orderable
        }, ],
    });
}