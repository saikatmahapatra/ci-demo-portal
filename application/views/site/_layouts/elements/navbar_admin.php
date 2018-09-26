<?php
// For making nav item active. Add class .active to .nav-item
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);
//print_r($user_profile_image);
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">	
	<a class="navbar-brand" href="<?php echo base_url('user/administrator'); ?>">
	<img class="" style="width:80px;" src="<?php echo base_url('assets/src/img/logo.svg');?>">
		<?php //echo $this->config->item('app_logo_name_admin_dashboard'); ?>
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
		aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php echo ($segment1=='home') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url('user/administrator'); ?>">Home
					<span class="sr-only">(current)</span>
				</a>
			</li>

			<?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>			
			<li class="nav-item">
			<a class="nav-link" href="<?php echo base_url(); ?>">
				<i class="fa fa-globe" aria-hidden="true"></i> Portal</a>
			</li>
			<?php } ?>
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown011" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">Manage Employees</a>
				<div class="dropdown-menu" aria-labelledby="dropdown011">
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Add New Employee</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/manage'); ?>">Manage Employee</a>
				</div>
			</li>
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown012" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">CMS (News Notice)</a>
				<div class="dropdown-menu" aria-labelledby="dropdown012">
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'cms/add');?>">Add New Content</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'cms'); ?>">Manage Contents</a>
				</div>
			</li>
			
			<li class="d-none nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown012" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">Track Timesheet</a>
				<div class="dropdown-menu" aria-labelledby="dropdown012">
					<a class="dropdown-item" href="<?php echo base_url();?>">View Report</a>
					<a class="dropdown-item" href="<?php echo base_url('project/add'); ?>">Add Project Work</a>
					<a class="dropdown-item" href="<?php echo base_url('project'); ?>">Manage Projects</a>
				</div>
			</li>
			
			<li class="d-none nav-item <?php echo ($segment1=='home') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url('holiday'); ?>">Holiday
				</a>
			</li>

			<?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> My Account</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown03">					
					<div class="dropdown-item welcome-user-container">					
						<div class=""><?php echo isset($this->session->userdata['sess_user']['user_title'])? $this->session->userdata['sess_user']['user_title']:''; ?> <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></div>
						<div class="small"><?php echo isset($this->session->userdata['sess_user']['user_email']) ? $this->session->userdata['sess_user']['user_email'] :'';?></div>
						<div class="small">Role: <?php echo isset($this->session->userdata['sess_user']['user_role_name']) ? $this->session->userdata['sess_user']['user_role_name'] :'';?></div>
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
		
		
		<ul class="navbar-nav my-2 my-lg-0">
				
		</ul>
		
	</div>
</nav>