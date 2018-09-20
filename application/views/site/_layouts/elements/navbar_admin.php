<?php
// For making nav item active. Add class .active to .nav-item
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);
//print_r($user_profile_image);
?>

<nav class="navbar navbar-expand-md navbar-dark bg-info fixed-top">	
	<a class="navbar-brand" href="<?php echo base_url('user/administrator'); ?>">
		<img class="img-fluid d-none" style="width: 200px;" src="<?php echo base_url('assets/src/img/logo.png');?>">
		Administrator
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
		aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php echo ($segment1=='home') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url('user/administrator'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home
					<span class="sr-only">(current)</span>
				</a>
			</li>
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown011" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">Employee</a>
				<div class="dropdown-menu" aria-labelledby="dropdown011">
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Add New Employee</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/manage'); ?>">Manage Employees</a>
				</div>
			</li>
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown012" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">CMS</a>
				<div class="dropdown-menu" aria-labelledby="dropdown012">
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'cms/add');?>">Add New Content</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'cms'); ?>">Manage Contents</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'holiday'); ?>">Holiday</a>
				</div>
			</li>
			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown012" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">Track Timesheet</a>
				<div class="dropdown-menu" aria-labelledby="dropdown012">
					<a class="dropdown-item" href="<?php echo base_url();?>">View Report</a>
					<a class="dropdown-item" href="<?php echo base_url('project/add'); ?>">Add Project Work</a>
					<a class="dropdown-item" href="<?php echo base_url('project'); ?>">Manage Projects</a>
				</div>
			</li>
			
		</ul>
		
		
		<ul class="navbar-nav my-2 my-lg-0">
			<?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">Welcome, <?php echo isset($this->session->userdata['sess_user']['user_title'])? $this->session->userdata['sess_user']['user_title']:''; ?> <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></a>
				<div class="dropdown-menu" aria-labelledby="dropdown03">
					
					<div class="dropdown-item welcome-user-container">
					<!--<a class="dropdown-item" href="#">-->				
						<div class=""><?php echo isset($this->session->userdata['sess_user']['user_title'])? $this->session->userdata['sess_user']['user_title']:''; ?> <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></div>
						<div class="small"><?php echo isset($this->session->userdata['sess_user']['user_email']) ? $this->session->userdata['sess_user']['user_email'] :'';?></div>
						<div class="small">Role: <?php echo isset($this->session->userdata['sess_user']['user_role_name']) ? $this->session->userdata['sess_user']['user_role_name'] :'';?></div>
						<div class="small">Last Login: <?php echo isset($this->session->userdata['sess_user']['user_login_date_time']) ? $this->session->userdata['sess_user']['user_login_date_time'] :'';?></div>
					<!--</a>-->
					</div><!--/.welcome-user-container-->
					
					<div class="dropdown-divider mt-3"></div>			
					<a class="dropdown-item"  href="<?php echo base_url($this->router->directory.'user/profile/'.$this->session->userdata['sess_user']['id']); ?>">Profile</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/change_password'); ?>">Change Password</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/logout'); ?>">Logout</a>			
				</div>
			</li>
			<?php  } ?>				
			
			<li class="nav-item">
			<a class="nav-link" href="<?php echo base_url(); ?>">
				<i class="fa fa-globe"></i> Portal</a>
			</li>
			
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'user/logout'); ?>">
					<i class="fa fa-power-off"></i> Logout</a>
			</li>
		</ul>
		
	</div>
</nav>