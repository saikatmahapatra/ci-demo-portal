/**
 * ------------------------------------------------------------------------------
 * Controller Specific DOM Interaction (Ready/Load, Click, Hover, Change)
 * ------------------------------------------------------------------------------
 */
var table;
$(domReady);
function domReady(){	
	//Index View:
	if(ROUTER_METHOD == 'index'){
		renderDataTable();
	}	
	//Add, Edit View:
	if(ROUTER_METHOD == 'add' || ROUTER_METHOD == 'edit'){
		
	}
	
	//Display Start end date picker 
	$('.holiday-datepicker').datepicker({
		format: "yyyy-mm-dd",
		weekStart: 1,
		autoclose: true
	});
}




/**
 * ------------------------------------------------------------------------------
 * Controller Specific JS Function
 * ------------------------------------------------------------------------------
 */
function renderDataTable(){
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
			url: SITE_URL+ROUTER_DIRECTORY+ROUTER_CLASS+'/render_datatable',
		},
		//Set column definition initialisation properties.
		columnDefs: [
			{
				targets: [-1], //last column
				orderable: false, //set not orderable
			},
		],
	});
}