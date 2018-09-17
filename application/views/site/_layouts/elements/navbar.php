<?php
// For making nav item active. Add class .active to .nav-item
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);
//print_r($user_profile_image);
?>

<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">	
	<a class="navbar-brand" href="<?php echo base_url($this->router->directory); ?>">
		<img class="img-fluid" style="width: 200px;" src="<?php echo base_url('assets/src/img/logo.png');?>">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
		aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php echo ($segment1=='home') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'home'); ?>">Home
					<span class="sr-only">(current)</span>
				</a>
			</li>	
			
			<li class="nav-item <?php echo ($segment2 == 'people') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'user/people'); ?>">People</a>
			</li>
						
			<li class="nav-item <?php echo ($segment1=='timesheet') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'timesheet'); ?>">Timesheet</a>
			</li>
			
			<li class="nav-item">
				<a class="nav-link"href="<?php echo base_url($this->router->directory.'leave'); ?>">Apply Leave</a>
			</li>
			
			
			<?php /* if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
			<li class="nav-item dropdown <?php echo ($segment2=='user') ? 'active':''?>">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false"> HR/Admin</a>
				<div class="dropdown-menu" aria-labelledby="dropdown01">
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/manage'); ?>">Manage Employees</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Add New Employee</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Project Allocation</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'timesheet'); ?>">View Timesheet</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'project');?>">Manage Projects</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'project/add');?>">Add Project</a>
				</div>
			</li>
			<?php } */ ?>
			
			
			<?php /* if (isset($this->session->userdata['sess_user']['id'])) {   ?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">My Account </a>
				<div class="dropdown-menu" aria-labelledby="dropdown03">
					
					<div class="dropdown-item welcome-user-container">
					<!--<a class="dropdown-item" href="#">-->				
						<div class=""><?php echo isset($this->session->userdata['sess_user']['user_title'])? $this->session->userdata['sess_user']['user_title']:''; ?> <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></div>
						<div class="small"><?php echo isset($this->session->userdata['sess_user']['user_email']) ? $this->session->userdata['sess_user']['user_email'] :'';?></div>
						<div class="small">Role: <?php echo isset($this->session->userdata['sess_user']['user_role_name']) ? $this->session->userdata['sess_user']['user_role_name'] :'';?></div>
						<div class="small">Last Login: [DD/MM/YYYY HH:MM am/pm]</div>
					<!--</a>-->
					</div><!--/.welcome-user-container-->
					
					<div class="dropdown-divider mt-3"></div>			
					<a class="dropdown-item"  href="<?php echo base_url($this->router->directory.'user/profile/'.$this->session->userdata['sess_user']['id']); ?>">Profile</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/change_password'); ?>">Change Password</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/logout'); ?>">Logout</a>			
				</div>
			</li>
			<?php  } */ ?>
		</ul>
		
		<div class="mt-2 mt-md-0">
			<ul class="navbar-nav mr-auto">
				<?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">My Account </a>
					<div class="dropdown-menu" aria-labelledby="dropdown03">
						
						<div class="dropdown-item welcome-user-container">
						<!--<a class="dropdown-item" href="#">-->				
							<div class=""><?php echo isset($this->session->userdata['sess_user']['user_title'])? $this->session->userdata['sess_user']['user_title']:''; ?> <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></div>
							<div class="small"><?php echo isset($this->session->userdata['sess_user']['user_email']) ? $this->session->userdata['sess_user']['user_email'] :'';?></div>
							<div class="small">Role: <?php echo isset($this->session->userdata['sess_user']['user_role_name']) ? $this->session->userdata['sess_user']['user_role_name'] :'';?></div>
							<div class="small">Last Login: [DD/MM/YYYY HH:MM am/pm]</div>
						<!--</a>-->
						</div><!--/.welcome-user-container-->
						
						<div class="dropdown-divider mt-3"></div>			
						<a class="dropdown-item"  href="<?php echo base_url($this->router->directory.'user/profile/'.$this->session->userdata['sess_user']['id']); ?>">Profile</a>
						<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/change_password'); ?>">Change Password</a>
						<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/logout'); ?>">Logout</a>			
					</div>
				</li>
				<?php  } ?>				
				<?php if ($this->session->userdata['sess_user']['user_role'] == 3) { ?>
				<li class="nav-item dropdown <?php echo ($segment2=='user') ? 'active':''?>">
					<a class="nav-link dropdown-toggle btn btn-sm btn-outline-danger" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false"> Administration</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/manage'); ?>">Manage Employees</a>
						<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Add New Employee</a>
						<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Project Allocation</a>
						<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'timesheet'); ?>">View Timesheet</a>
						<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'project');?>">Manage Projects</a>
						<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'project/add');?>">Add Project</a>
					</div>
				</li>
				<?php } ?>				
				<li class="nav-item"><a class="nav-link" href="<?php echo base_url($this->router->directory.'user/logout'); ?>">Help & FAQ</a></li>				
			</ul>
		</div>
	</div>
</nav>