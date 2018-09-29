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
    $('#academic_specialization').select2({
        //tags: true,
    }).on('select2:close', function() {
        var el = $(this);
        if (el.val() == "-1") {
            //var newval = prompt("Enter new value: ");
            $('#addNewItemModal').modal('show');
            $('#saveNewItem').on('click', function() {
                var xhr = new Ajax();
                xhr.type = 'POST';
                xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/add_user_input_specialization';
                xhr.data = {
                    new_input_value: $('#new_input_value').val(),
                    action: 'add'
                };
                xhr.beforeSend = function() {}
                var promise = xhr.init();
                promise.done(function(response) {
                    console.log(response);
                });
                promise.fail(function() {

                });
                promise.always(function() {

                });
            });

            /*if (newval !== null) {
                el.append('<option>' + newval + '</option>')
                    .val(newval);
            }*/
        }
    });
}