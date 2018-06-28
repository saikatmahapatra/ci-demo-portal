//-------------------------------------------//
//------ CI Controller Specific JS ----------//
//-------------------------------------------//

var Cms = function(){
	this.table = '';
	this.renderDataTable = function(){
		this.table = $('#cms-datatable').DataTable({
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
	};
	
	this.initCKEditor = function(){
		if(typeof CKEDITOR != 'undefined'){
			// Replace the <textarea id="editor1"> with a CKEditor
			// instance, using default configuration.
			//CKEDITOR.replace('pagecontent_text');
			//bootstrap WYSIHTML5 - text editor
			//$(".textarea").wysihtml5();
		}
	};
};

//Instantiate
var cms = new Cms();

//Document Ready Handler
$(domReady);
function domReady(){	
	//Index View:
	if(ROUTER_METHOD == 'index'){
		cms.renderDataTable();
	}
	
	//Add, Edit View:
	if(ROUTER_METHOD == 'add' || ROUTER_METHOD == 'edit'){
		cms.initCKEditor();
	}
}