<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>	
		
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
	<div class="container">
		<h1 class="display-3">Hello, world!</h1>
		<p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
		<p><a class="btn ci-btn-primary btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
	</div><!--/.container-->
</div><!--/.jumbotron-->


<div class="container">
	<div class="row my-2">
		<div class="col-12">
			<div id="demo" class="carousel slide" data-ride="carousel">
			<ul class="carousel-indicators">
				<li data-target="#demo" data-slide-to="0" class="active"></li>
				<li data-target="#demo" data-slide-to="1"></li>
				<li data-target="#demo" data-slide-to="2"></li>
			</ul>
			<div class="carousel-inner w-100 h-100">
				<div class="carousel-item active">
					<img src="<?php echo base_url('assets/src/img/carousel/1.jpg');?>">
					<div class="carousel-caption">
						<h3>Some title goes here...</h3>
						<p>Some text, another text...</p>
					</div>   
				</div><!--/.carousel-item-->

				<div class="carousel-item">
					<img src="<?php echo base_url('assets/src/img/carousel/2.jpg');?>">
					<div class="carousel-caption">
						<h3>Darjeeling</h3>
						<p>We miss you!</p>
					</div>   
				</div><!--/.carousel-item-->

				<div class="carousel-item">
					<img src="<?php echo base_url('assets/src/img/carousel/3.jpg');?>">
					<div class="carousel-caption">
						<h3>Some title goes here...</h3>
						<p>Some text, another text...</p>
					</div>   
				</div><!--/.carousel-item-->

			</div><!--/.carousel-inner-->
			<a class="carousel-control-prev" href="#demo" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#demo" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>
			</div>
		</div><!--/.col-->
	</div><!--/.row-->
	<p>Primary color is the main color of the application which is used for navbar, active links and primary button.</p>		
	<h2 class="h3 mb-3 font-weight-normal">Button</h2>       
	<button type="button" class="btn ci-btn-primary btn-primary">.ci-btn-primary btn-primary</button>
	<button type="button" class="btn btn-secondary">.btn-secondary</button>
	<button type="button" class="btn btn-success">.btn-success</button>
	<button type="button" class="btn btn-danger">.btn-danger</button>
	<button type="button" class="btn btn-warning">.btn-warning</button>
	<button type="button" class="btn btn-info">.btn-info</button>
	<button type="button" class="btn btn-outline-secondary">.btn-outline-secondary</button>
	<button type="button" class="btn btn-dark">.btn-dark</button>
	<button type="button" class="btn btn-link">.btn-link</button>

	<h2 class="h3 mb-3 font-weight-normal">Button Outline</h1>
	<button type="button" class="btn btn-outline-primary">.btn .btn-outline-primary</button>
	<button type="button" class="btn btn-outline-secondary">btn-outline-secondary</button>

	<h2 class="h3 mb-3 font-weight-normal">Progress Bar</h1>        
	<div class="progress">
		<div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 32%" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100">32%</div>
	</div>
	<div class="progress mt-1">
		<div class="progress-bar progress-bar-striped bg-secondary" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
	</div>

	<h2 class="h3 mb-3 font-weight-normal">Alerts</h2>
	<div class="alert alert-primary" role="alert">
		This is a primary alert—check it out!
	</div>
	<div class="alert alert-secondary" role="alert">
		This is a secondary alert—check it out!
	</div>


	<h2 class="h3 mb-3 font-weight-normal">Tooltip</h2>
	<button type="button" class="btn ci-btn-primary btn-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
	Tooltip on top
	</button>
	<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Tooltip on right">
	Tooltip on right
	</button>
	<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">
	Tooltip on bottom
	</button>
	<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="left" title="Tooltip on left">
	Tooltip on left
	</button>
	<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-html="true" title="<em>Tooltip</em> <u>with</u> <b>HTML</b>. To open modal <span style='cursor: pointer;' data-toggle='modal' data-target='#exampleModal'><u>click here</u></span>">
	Tooltip with HTML
	</button>

	<h2 class="h3 mb-3 font-weight-normal">News Feed</h2>

	<div class="row">
		
		<div class="col-lg-12 mb-3">				
			<div class="card-news pl-2 border-4 border-left border-success">					
					<div class="card-news-header h5">Redmi Launched Mi Band in India @ 1699/-</div>
					<div class="card-news-time-auther">
						<span class="text-muted small">Administrator, 20/09/2018 10.34am</span>
					</div>
					<div class="card-news-body">All the three Xiaomi phones come with face unlock support and run MIUI 9.6 on top of Android Oreo, but Xiaomi promises to upgrade all the Redmi 6 series phones to MIUI 10 very soon <a class="btn btn-sm ci-btn-primary btn-primary" href="#">View details</a></div>						
			</div><!--/.card-news-->				
		</div>
		
		<div class="col-lg-12 mb-3">				
			<div class="card-news pl-2 border-4 border-left border-danger">					
					<div class="card-news-header h5">Redmi Launched Mi Band in India @ 1699/-</div>
					<div class="card-news-time-auther">
						<span class="text-muted small">Administrator, 20/09/2018 10.34am</span>
					</div>
					<div class="card-news-body">All the three Xiaomi phones come with face unlock support and run MIUI 9.6 on top of Android Oreo, but Xiaomi promises to upgrade all the Redmi 6 series phones to MIUI 10 very soon <a class="btn btn-sm ci-btn-primary btn-primary" href="#">View details</a></div>						
			</div><!--/.card-news-->				
		</div>
		
	</div>

	<h2 class="h3 mb-3 font-weight-normal">Card</h2>
	<div class="row">
		<div class="col-lg-3">
			<div class="card">
				<h5 class="card-header">Card Header</h5>
				<div class="card-body">
					<h5 class="card-title">Card title</h5>
					<p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Click here for <a href="#" class="">more details</a></p>                        
				</div>
				<div class="card-footer">.card-footer</div>
			</div>
		</div>
		
		<div class="col-lg-3">
			<div class="card">
				<h5 class="card-header">Featured</h5>
				<div class="card-body">
					<h5 class="card-title">Card title</h5>
					<p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					<a href="#" class="btn btn-outline-secondary">.btn-outline-secondary</a>
				</div>
				<div class="card-footer">
					<button class="btn ci-btn-primary btn-primary btn-sm">.ci-btn-primary btn-primary</button>
					<button class="btn btn-secondary btn-sm">.btn-secondary</button>
				</div>
			</div>
		</div>
		
		<div class="col-lg-6">
			<div class="card card-legend">			
				<div class="card-body">
					<h5 class="card-title text-on-card">Add Benificiary</h5>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Text</label>
						<div class="col-10">
						<input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
						</div>
					</div>						
					<button class="btn ci-btn-primary btn-primary">Submit</button>
					<button class="btn btn-secondary">Cancel</button>
				</div><!--./card-body-->
			</div><!--./card-->
		</div>
		
		
	</div>

	<h2 class="h3 mb-3 font-weight-normal">Accordion</h2>
	<div id="accordion">
		<div class="card">
			<div class="card-header" id="heading_1">
				<h5 class="mb-0">
					<button class="btn btn-link btn-block" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" aria-controls="collapse_1">Heading #1</button>
				</h5>
			</div>

			<div id="collapse_1" class="collapse show" aria-labelledby="heading_1" data-parent="#accordion">
				<div class="card-body">
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Click here for <a href="#" class="">more details</a>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="heading_2">
				<h5 class="mb-0">
					<button class="btn btn-link collapsed btn-block" data-toggle="collapse" data-target="#collapse_2" aria-expanded="false" aria-controls="collapse_2">Heading #2</button>
				</h5>
			</div>
			<div id="collapse_2" class="collapse" aria-labelledby="heading_2" data-parent="#accordion">
				<div class="card-body">
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Click here for <a href="#" class="">more details</a>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="heading_3">
				<h5 class="mb-0">
					<button class="btn btn-link collapsed btn-block" data-toggle="collapse" data-target="#collapse_3" aria-expanded="false" aria-controls="collapse_3">Heading #3</button>
				</h5>
			</div>
			<div id="collapse_3" class="collapse" aria-labelledby="heading_3" data-parent="#accordion">
				<div class="card-body">
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Click here for <a href="#" class="">more details</a>
				</div>
			</div>
		</div>
	</div> <!--/#accordion-->

	<h2 class="h3 mb-3 font-weight-normal">Form Control</h2>
	<form>
		<div class="form-row">
			<div class="form-group col-lg-4">
				<label for="exampleFormControlInput2">Text Box</label>
				<input type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com">
			</div>
			<div class="form-group col-lg-4">
				<label for="exampleFormControlInput3">Text Box (Small)</label>
				<input type="email" class="form-control form-control-sm" id="exampleFormControlInput3" placeholder="name@example.com">
			</div>
			<div class="form-group col-lg-4">
				<label for="exampleFormControlInput4">Text Box (Large)</label>
				<input type="email" class="form-control form-control-lg" id="exampleFormControlInput4" placeholder="name@example.com">
			</div>
		</div><!--/.form-row-->			
		<div class="form-row">
			<div class="form-group col-lg-4">
				<label for="exampleFormControlSelect1">Example select</label>
				<select class="form-control" id="exampleFormControlSelect1">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
			<div class="form-group col-lg-4">
				<label for="exampleFormControlSelect2">Example multiple select</label>
				<select multiple class="form-control" id="exampleFormControlSelect2">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
			<div class="form-group col-lg-4">
				<label for="exampleFormControlTextarea1">Example textarea</label>
				<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
			</div>
		</div><!--/.form-row-->			
		<div class="form-row">
			<div class="form-group col-lg-6">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
					<label class="form-check-label" for="defaultCheck1"> Default checkbox </label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
					<label class="form-check-label" for="defaultCheck2"> Disabled checkbox </label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
					<label class="form-check-label" for="inlineCheckbox1">1</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
					<label class="form-check-label" for="inlineCheckbox2">2</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
					<label class="form-check-label" for="inlineCheckbox3">3 (disabled)</label>
				</div>
			</div>
			<div class="form-group col-lg-6">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
					<label class="form-check-label" for="exampleRadios1"> Default radio </label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
					<label class="form-check-label" for="exampleRadios2"> Second default radio </label>
				</div>
				<div class="form-check disabled">
					<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
					<label class="form-check-label" for="exampleRadios3"> Disabled radio</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
					<label class="form-check-label" for="inlineRadio1">1</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
					<label class="form-check-label" for="inlineRadio2">2</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
					<label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
				</div>
			</div>			
		</div><!--/.form-row-->
		
		<div class="form-row mb-4">
		
			<div class="col-lg-4">
				
				<div class="custom-control custom-checkbox my-1 mr-sm-2">
					<input type="checkbox" class="custom-control-input" id="customcheckbox1">
					<label class="custom-control-label" for="customcheckbox1">Kolkata</label>
				</div>
				<div class="custom-control custom-checkbox my-1 mr-sm-2">
					<input type="checkbox" class="custom-control-input" id="customcheckbox2">
					<label class="custom-control-label" for="customcheckbox2">Mumbai</label>
				</div>
				
				
				
				<div class="custom-control custom-checkbox my-1 mr-sm-2 custom-control-inline">
					<input type="checkbox" class="custom-control-input" id="custominlinecheckbox1">
					<label class="custom-control-label" for="custominlinecheckbox1">Kolkata</label>
				</div>
				<div class="custom-control custom-checkbox my-1 mr-sm-2 custom-control-inline">
					<input type="checkbox" class="custom-control-input" id="custominlinecheckbox2" disabled>
					<label class="custom-control-label" for="custominlinecheckbox2">Mumbai</label>
				</div>
				
				
			</div>
			
			<div class="col-lg-4">
				
				<div class="custom-control custom-radio">
					<input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
					<label class="custom-control-label" for="customRadio1">Male</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
					<label class="custom-control-label" for="customRadio2">Female</label>
				</div>
				
				
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
					<label class="custom-control-label" for="customRadioInline1">Yes</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
					<label class="custom-control-label" for="customRadioInline2">No</label>
				</div>
				
			</div>
			
			<div class="col-lg-4">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="customFile">
					<label class="custom-file-label" for="customFile">Choose file</label>
				</div>
			</div>	
			
		</div><!--/.form-row-->
		
		
		<button type="submit" class="btn ci-btn-primary btn-primary">Submit</button>
		<button class="btn btn-secondary">Cancel</button>
	</form><!--/form-->



	<h2 class="h3 mb-3 font-weight-normal">Modal</h2>
	<!-- Button trigger modal -->
	<button type="button" class="btn ci-btn-primary btn-primary" data-toggle="modal" data-target="#exampleModal">Launch demo modal</button>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Modal Body
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn ci-btn-primary btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</div> <!-- /container -->