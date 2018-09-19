<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        <?php echo $breadcrumbs; ?>
    </div>
</div><!--/.heading-container-->




<div class="row">
	<div class="col-md-3">
		<a class="nav-link" href="<?php echo base_url($this->router->directory.'user/create_account'); ?>">
			<div class="circle bg-primary text-white">
				<div class="circle-body text-center p-4">
					<i class="fa fa-user-plus fa-3x" aria-hidden="true"></i>
					<p>Add New Employee</p>
				</div>
			</div>
		</a>
	</div>
	<div class="col-md-3">
		<a class="nav-link" href="<?php echo base_url($this->router->directory.'user/manage'); ?>">
			<div class="circle bg-primary text-white">
				<div class="circle-body text-center p-4">
					<i class="fa fa-users fa-3x" aria-hidden="true"></i>
					<p>Manage Employees</p>
				</div>
			</div>
		</a>
	</div>
	
	<div class="col-md-3">
		<a class="nav-link" href="<?php echo base_url($this->router->directory.'project/add'); ?>">
			<div class="circle bg-primary text-white">
				<div class="circle-body text-center p-4">
					<i class="fa fa-cog fa-3x" aria-hidden="true"></i>
					<p>Add Project</p>
				</div>
			</div>
		</a>
	</div>
	
	<div class="col-md-3">
		<a class="nav-link" href="<?php echo base_url($this->router->directory.'project'); ?>">
			<div class="circle bg-primary text-white">
				<div class="circle-body text-center p-4">
					<i class="fa fa-cog fa-3x" aria-hidden="true"></i>
					<p>Manage Projects</p>
				</div>
			</div>
		</a>
	</div>
	
</div><!--/.row-->