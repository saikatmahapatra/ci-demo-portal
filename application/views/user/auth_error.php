<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card ci-card">
			<div class="card-body">
            <div class="alert alert-danger"><?php echo $this->common_lib->get_icon('warning'); ?> Sorry! You are not authorized to access the requested page.</div>
            <a href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>" class="btn btn-outline-primary">Please login to continue</a>
			</div><!--/.card-body-->
		</div><!--/.card-->
	</div>
</div>