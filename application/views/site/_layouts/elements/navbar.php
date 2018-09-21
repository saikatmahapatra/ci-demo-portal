<?php
// For making nav item active. Add class .active to .nav-item
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);
//print_r($user_profile_image);
?>

<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">	
	<a class="navbar-brand" href="<?php echo base_url($this->router->directory); ?>">
		<img class="img-fluid" style="width:80px;" src="<?php echo base_url('assets/src/img/logo.svg');?>">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
		aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php echo ($segment1=='home') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'home'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home
					<span class="sr-only">(current)</span>
				</a>
			</li>	
			
			<li class="nav-item <?php echo ($segment2 == 'people') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'user/people'); ?>">People</a>
			</li>
						
			<li class="nav-item <?php echo ($segment1=='timesheet') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'timesheet'); ?>">Timesheet</a>
			</li>
			
			<li class="nav-item dropdown <?php echo ($segment2=='user') ? 'active':''?>">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">Employee Self Services</a>
				<div class="dropdown-menu" aria-labelledby="dropdown01">
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'holiday/view'); ?>">Holiday Calendar</a>
					<a class="dropdown-item" href="#">Apply Leave</a>
					<a class="dropdown-item" href="#">Travel Request</a>
					<a class="dropdown-item" href="#">My Request List</a>
				</div>
			</li>
		</ul>
		
		
		<ul class="navbar-nav my-2 my-lg-0">
			<?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>			
			<li class="nav-item">
			<a class="nav-link" href="<?php echo base_url($this->router->directory.'user/administrator'); ?>">
				<i class="fa fa-key"></i> Administrator</a>
			</li>
			<?php } ?>
			
			<?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false"><i class="fa fa-user-o" aria-hidden="true"></i> <?php echo isset($this->session->userdata['sess_user']['user_title'])? $this->session->userdata['sess_user']['user_title']:''; ?> <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown03">					
					<div class="dropdown-item welcome-user-container">					
						<div class=""><?php echo isset($this->session->userdata['sess_user']['user_title'])? $this->session->userdata['sess_user']['user_title']:''; ?> <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></div>
						<div class="small"><?php echo isset($this->session->userdata['sess_user']['user_email']) ? $this->session->userdata['sess_user']['user_email'] :'';?></div>
						<div class="small">Role: <?php echo isset($this->session->userdata['sess_user']['user_role_name']) ? $this->session->userdata['sess_user']['user_role_name'] :'';?></div>
						<div class="small">Last Login: <?php echo isset($this->session->userdata['sess_user']['user_login_date_time']) ? $this->common_lib->display_date($this->session->userdata['sess_user']['user_login_date_time'], true) :'';?></div>					
					</div><!--/.welcome-user-container-->
					
					<div class="dropdown-divider mt-3"></div>			
					<a class="dropdown-item"  href="<?php echo base_url($this->router->directory.'user/profile/'.$this->session->userdata['sess_user']['id']); ?>">Profile</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/change_password'); ?>">Change Password</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/logout'); ?>">Logout</a>			
				</div>
			</li>
			<?php  } ?>	
		</ul>
		
	</div>
</nav>