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
    if (ROUTER_METHOD == 'manage_holidays') {
        renderHolidayDataTable();
    }
    if (ROUTER_METHOD == 'add_holiday' || ROUTER_METHOD == 'edit_holiday') {
        //Display Start end date picker 
        $('.holiday-datepicker').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            autoclose: true
        });
    }
    //Add, Edit View:
    if (ROUTER_METHOD == 'add' || ROUTER_METHOD == 'edit') {
        // Classic CK Editor
        CKEDITOR.replace('content_text', {
            filebrowserBrowseUrl: SITE_URL + 'assets/vendors/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: SITE_URL + 'assets/vendors/ckfinder/ckfinder.html?type=Images',
            filebrowserUploadUrl: SITE_URL + 'assets/vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: SITE_URL + 'assets/vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
        });
        //CKEDITOR.replace('content_text');
    }

    //Display Start end date picker 
    $('.cms-datepicker').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        startDate: '0d',
        autoclose: true
    });

}




/**
 * ------------------------------------------------------------------------------
 * Controller Specific JS Function
 * ------------------------------------------------------------------------------
 */
function renderDataTable() {
    table = $('#cms-datatable').DataTable({
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
            url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/render_datatable',
        },
        //Set column definition initialisation properties.
        columnDefs: [{
            targets: [-1], //last column
            orderable: false, //set not orderable
        }, ],
    });
}

function renderHolidayDataTable() {
    table = $('#holiday-datatable').DataTable({
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
            url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/render_holiday_datatable',
        },
        //Set column definition initialisation properties.
        columnDefs: [{
            targets: [-1], //last column
            orderable: false, //set not orderable
        }, ],
    });
}