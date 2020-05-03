<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card ci-card">
			<div class="card-body">
            <div class="alert alert-danger"><?php echo $this->common_lib->get_icon('warning'); ?> Sorry! The requested page could not found.</div>
            <a href="<?php echo base_url();?>" class="btn btn-outline-secondary">Go to home</a>
			</div><!--/.card-body-->
		</div><!--/.card-->
	</div>
</div>