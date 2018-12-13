<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top nav-colorgraph">	
	<a class="navbar-brand" href="<?php echo base_url($this->router->directory); ?>">
		<img class="logo" src="<?php echo base_url('assets/src/img/logo.png');?>">
		<?php //echo $this->config->item('app_logo_name_dashboard'); ?>
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
		aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'home'); ?>">
					Home
					<span class="sr-only">(current)</span>
				</a>
			</li>

			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown01_ess" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">Employee Self Services</a>
				<div class="dropdown-menu" aria-labelledby="dropdown01_ess">					
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/my_profile'); ?>">Update Profile Information</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'document'); ?>">My Documents</a>					
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'leave/apply'); ?>">Apply Leave</a>					
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'leave/history'); ?>">My Leave History</a>					
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'leave/manage'); ?>">Manage Leaves</a>					
				</div>
			</li>

			<?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>			
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown011" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">Employees</a>
					<div class="dropdown-menu" aria-labelledby="dropdown011">						
						<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/manage'); ?>">Manage Employees</a>
						<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Add New Employee</a>
					</div>
				</li>
			<?php } else { ?>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'user/people'); ?>">People</a>
			</li>
			<?php } ?>

			
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown012" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">Timesheet</a>
					<div class="dropdown-menu" aria-labelledby="dropdown012">
						<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'timesheet'); ?>">My Timesheet</a>
						<?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>			
						<a class="dropdown-item" href="<?php echo base_url('timesheet/report'); ?>">Timesheet Report</a>						
						<a class="dropdown-item" href="<?php echo base_url('project'); ?>">Add/Manage Projects</a>
						<a class="dropdown-item" href="<?php echo base_url('project/activity'); ?>">Add/Manage Timesheet Activity</a>
						<?php } ?>
					</div>
				</li>
			


			<?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>			
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown012" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">Contents</a>
					<div class="dropdown-menu" aria-labelledby="dropdown012">
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'cms'); ?>">Manage Contents</a>
						<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'cms/add');?>">Add New Content</a>						
						<a class="dropdown-item" href="<?php echo base_url('holiday'); ?>">Manage Holidays</a>
					</div>
				</li>
			<?php } ?>
			

			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'holiday/view'); ?>">Holidays</a>
			</li>
			
		</ul>
		
		
		<ul class="navbar-nav my-2 my-lg-0">
			<li class="nav-item mt-1">
				<?php echo form_open(base_url('search/index'), array( 'method' => 'get','class'=>'form-inline','name' => '','id' => 'ci-form-helper',)); ?>
				<?php echo form_hidden('form_action', 'search'); ?>
				<div class="input-group">
						<input type="text" name="q" class="form-control form-control-sm" placeholder="Search Employee..." aria-label="Search" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button class="btn btn-sm" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
						</div>
					</div>
				<?php echo form_close(); ?>
			</li>

			<?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false"><i class="fa fa-user d-none" aria-hidden="true"></i> Welcome, <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'] : 'Guest';?></a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown03">					
					<div class="dropdown-item welcome-user-container">					
						<div class=""><?php echo isset($this->session->userdata['sess_user']['user_title'])? $this->session->userdata['sess_user']['user_title']:''; ?> <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></div>
						<div class="small"><?php echo isset($this->session->userdata['sess_user']['user_email']) ? $this->session->userdata['sess_user']['user_email'] :'';?></div>
						<div class="small">Access Group: <?php echo isset($this->session->userdata['sess_user']['user_role_name']) ? $this->session->userdata['sess_user']['user_role_name'] :'';?></div>
						<div class="small">Last Login: <?php echo isset($this->session->userdata['sess_user']['user_login_date_time']) ? $this->common_lib->display_date($this->session->userdata['sess_user']['user_login_date_time'], true) :'';?></div>					
					</div><!--/.welcome-user-container-->
					
					<div class="dropdown-divider mt-3"></div>			
					<a class="dropdown-item"  href="<?php echo base_url($this->router->directory.'user/my_profile/'); ?>">My Profile</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/change_password'); ?>">Change Password</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/logout'); ?>">Log Out</a>			
				</div>
			</li>
			<?php  } ?>
		</ul>
		
	</div>
</nav>