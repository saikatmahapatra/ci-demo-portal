<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        <?php echo $breadcrumbs; ?>
    </div>
</div><!--/.heading-container-->

<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/manage'); ?>">Manage Employees</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Add New Employee</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Project Allocation</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'timesheet'); ?>">View Timesheet</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'project');?>">Manage Projects</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'project/add');?>">Add Project</a>