<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6 text-center">
		<i class="icon fa fa-warning fa-3x text-danger" aria-hidden="true"></i>
		<h4 class="text-danger mt-3 mb-3"><?php echo isset($page_heading)? $page_heading : 'Page Heading'; ?></h5>
		<h6>You are not authorized to access the link you clicked. For security reason you have been logged out. Please contact to system administrator for more details.</h6>
		<a href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>" class="btn btn-primary mt-3"><i class="fa fa-fw fa-check-circle"></i> Please login to continue...</a>        
    </div>
</div>