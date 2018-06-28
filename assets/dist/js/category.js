//-------------------------------------------//
//------ CI Controller Specific JS ----------//
//-------------------------------------------//


var Category = function(){
	this.table = '';
	this.renderDataTable = function(){
		this.table = $('#category-datatable').DataTable({
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
	};
};

//Instantiate
var category = new Category();

//Document Ready Handler
$(domReady);
function domReady(){	
	//Index View:
	if(ROUTER_METHOD == 'index'){
		category.renderDataTable();
	}
}