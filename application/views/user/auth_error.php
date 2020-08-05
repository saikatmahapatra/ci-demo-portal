<!-- <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1> -->
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-6">
			<div class="text-center mt-4">
				<!-- <h1 class="display-1">401</h1>
				<p class="lead">Unauthorized</p> -->
				<img class="mb-4 img-error" src="<?php echo base_url('assets/dist/img/401-error-unauthorized-pana.svg');?>" />
				<p>Access to this resource is denied. You are not authorized to access the rosource.</p>
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>">
					Login to continue <i class="fas fa-arrow-right ml-1"></i>
				</a>
			</div>
		</div>
	</div>
</div>