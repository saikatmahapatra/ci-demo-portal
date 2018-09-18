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
					<p>Onboard New Employee</p>
				</div>
			</div>
		</a>
	</div>
	<div class="col-md-3">
		<a class="nav-link" href="<?php echo base_url($this->router->directory.'user/manage'); ?>">
			<div class="circle bg-primary text-white">
				<div class="circle-body text-center p-4">
					<i class="fa fa-user-plus fa-3x" aria-hidden="true"></i>
					<p>Manage Employees</p>
				</div>
			</div>
		</a>
	</div>
	<div class="col-md-3">
		<a class="nav-link" href="<?php echo base_url($this->router->directory.'user/timesheet'); ?>">
			<div class="circle bg-primary text-white">
				<div class="circle-body text-center p-4">
					<i class="fa fa-user-plus fa-3x" aria-hidden="true"></i>
					<p>Timesheet Tracker</p>
				</div>
			</div>
		</a>
	</div>
</div><!--/.row-->




<a class="dropdown-item" href="">Manage Employees</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Add New Employee</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Project Allocation</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'timesheet'); ?>">View Timesheet</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'project');?>">Manage Projects</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'project/add');?>">Add Project</a>