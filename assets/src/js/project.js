/**
 * ------------------------------------------------------------------------------
 * Controller Specific DOM Interaction (Ready/Load, Click, Hover, Change)
 * ------------------------------------------------------------------------------
 */
var table;
$(domReady);

function domReady() {
    //Index View:
    if (ROUTER_METHOD == 'index') {
        renderDataTable();
    }

    //activity
    if (ROUTER_METHOD == 'tasks') {
        renderTasksDataTable();
    }
    //Add, Edit View:
    if (ROUTER_METHOD == 'add' || ROUTER_METHOD == 'edit') {

    }

    if (ROUTER_METHOD == 'project_tasks') {
        $('#project_id_dd').on('change', function(e) {
            var project_id = $(this).val();
            if (project_id) {
                window.location = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/project_tasks/pid/' + project_id;
            }
        });
    }
}




/**
 * ------------------------------------------------------------------------------
 * Controller Specific JS Function
 * ------------------------------------------------------------------------------
 */
function renderDataTable() {
    table = $('#project-datatable').DataTable({
        /*dom: 'Bfrtip',
        buttons: [
        	'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        iDisplayLength: 10,*/
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
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


function renderTasksDataTable() {
    table = $('#task-datatable').DataTable({
        /*dom: 'Bfrtip',
        buttons: [
        	'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        iDisplayLength: 10,*/
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order: [], //Initial no order.
        // Load data for the table's content from an Ajax source
        ajax: {
            url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/render_task_datatable',
        },
        //Set column definition initialisation properties.
        columnDefs: [{
            targets: [-1], //last column
            orderable: false, //set not orderable
        }, ],
    });
}