<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6 text-center">
		<i class="icon fa fa-warning fa-3x text-danger" aria-hidden="true"></i>
		<h3 class="text-danger"><?php echo isset($page_heading)? $page_heading : 'Page Heading'; ?></h3>
		<h5>We're sorry! You are not authorized to access the link you clicked. For security reason you have been logged out.</h5>
		<a href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>" class="btn btn-primary btn-lg">Please login to continue...</a>        
    </div>
</div>