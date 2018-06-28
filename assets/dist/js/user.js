//-------------------------------------------//
//------ CI Controller Specific JS ----------//
//-------------------------------------------//

var User = function(){
	this.table = '';
	
	this.renderDataTable = function(){
		this.table = $('#user-datatable').DataTable({
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
	
	this.changeAccountStatus = function(e){
		var that = $(this);
		var new_status = that.attr('data-status');
		var user_id = that.attr('data-id');
		
		var XHR = new Ajax();
		XHR.type ='POST';
		XHR.url = SITE_URL+ROUTER_DIRECTORY+ROUTER_CLASS+'/change_account_status';
		XHR.data = {active: new_status, user_id: user_id};
		var promise = XHR.init();		
		promise.done(function(response){
			if (response.status == 'success') {
				window.location.reload();
				if (that.attr('data-status') == 'Y') {
					that.attr('data-status', 'N');
					that.text('Deactivate');
					that.removeClass('btn-info').addClass('btn-warning');
				}
				else if (that.attr('data-status') == 'N') {
					that.attr('data-status', 'Y');
					that.text('Activate');
					that.removeClass('btn-warning').addClass('btn-info');
				}
				
			}
		});
		promise.fail(function(){
			alert("Failed");
		});
		promise.always(function(){
			clickedBtn.html('Delete');
		});
	};
	
};




//Instantiate
var user = new User();

//Document Ready Handler
$(domReady);
function domReady(){	
	//Index View:
	if(ROUTER_METHOD == 'manage'){
		user.renderDataTable();
	}
}
$(document).on('click', '.change_account_status', user.changeAccountStatus);

