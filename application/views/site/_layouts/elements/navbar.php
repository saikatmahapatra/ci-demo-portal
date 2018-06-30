<?php
// For making nav item active. Add class .active to .nav-item
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);
//print_r($user_profile_image);
?>
<nav class="navbar navbar-expand-md navbar-dark bg-brand-secondary fixed-top" id="navbar1">
	<a class="navbar-brand" href="<?php echo base_url($this->router->directory); ?>">
		<img src="<?php echo base_url('assets/src/img/logo.png');?>">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
		aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="navbar-collapse collapse ">		
		<ul class="navbar-nav mr-auto">                
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url($this->router->directory); ?>"><h1></h1></a>
			</li>
		</ul>
		<ul class="navbar-nav ">

			<?php if (isset($this->session->userdata['sess_user']['id'])) {  ?>					
				<li class="nav-item mr-2">
					<div class="media text-white">					 
					<?php   
						$img_src = "";
						$default_path = "assets/dist/img/avatar_2x.png";
						//print_r($el_user_profile_pic); die();
						if(isset($this->session->userdata['sess_user']['user_profile_pic'])){					
							$user_dp = "assets/uploads/user/profile_pic/".$this->session->userdata['sess_user']['user_profile_pic'];					
							if (file_exists(FCPATH . $user_dp)) {
								$img_src = $user_dp;
							}else{
								$img_src = $default_path;
							}
						}else{
							$img_src = $default_path;
						}
					?>
					 <img class="mr-3 rounded" alt="50x50" style="width: 50px; height: 50px;" src="<?php echo base_url($img_src);?>">					  
					  <div class="media-body">
						<div class="mt-0"><?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? 'Hello, '.$this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Hello, Guest';?></div>
						<div class="mt-0 small"><?php echo isset($this->session->userdata['sess_user']['user_email']) ? $this->session->userdata['sess_user']['user_email'] :'';?></div>
						<!--<div class="mt-0 small">Role: <?php echo isset($this->session->userdata['sess_user']['user_role_name']) ? $this->session->userdata['sess_user']['user_role_name'] :'';?></div>-->
						<div class="mt-0"><a class="nav-link ml-0 p-0" href="<?php echo base_url($this->router->directory.'user/logout'); ?>"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></div>					
					  </div>
					</div>
				</li>			
			<?php } ?>			
			<!--<li class="nav-item">
				<a class="nav-link" href="#">Pricing</a>
			</li>-->
		</ul>			
		
	</div>
</nav>
	
<nav class="navbar navbar-expand-md navbar-dark pt-0 bg-brand-primary pb-0 fixed-top" id="navbar2">	
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php echo ($segment1=='home') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'home'); ?>">Home
					<span class="sr-only">(current)</span>
				</a>
			</li>			
			<?php if (isset($this->session->userdata['sess_user']['id'])) {  ?>
			<li class="nav-item <?php echo ($segment2 == 'profile') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'user/profile'); ?>">My Profile</a>
			</li>
			<?php } ?>
			
			<?php if (isset($this->session->userdata['sess_user']['id'])) {  ?>
			<li class="nav-item <?php echo ($segment2 == 'change_password') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'user/change_password'); ?>">Change Password</a>
			</li>
			<?php } ?>
			
			<li class="nav-item <?php echo ($segment1=='timesheet') ? 'active':''?>">
				<a class="nav-link" href="<?php echo base_url($this->router->directory.'timesheet'); ?>">Timesheet</a>
			</li>
			
			<li class="nav-item">
				<a class="nav-link"href="<?php echo base_url($this->router->directory.'leave'); ?>">Apply Leave</a>
			</li>
			
			<li class="nav-item <?php echo ($segment2 == 'people' || $segment2 == 'create_account') ? 'active':''?>">
				<a class="nav-link"href="<?php echo base_url($this->router->directory.'user/people'); ?>">People</a>
			</li>
			
			<?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
			<li class="nav-item dropdown <?php echo ($segment2=='cms') ? 'active':''?>">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Admin</a>
				<div class="dropdown-menu" aria-labelledby="dropdown01">
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/manage'); ?>">Manage Employees</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Add New Employee</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Project Allocation</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'timesheet'); ?>">View Timesheet</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">View Projects</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account');?>">Add Project Details</a>
				</div>
			</li>
			<?php } ?>
			
			<?php if (isset($this->session->userdata['sess_user']['id'])) { ?>
			<li class="nav-item">
				<a class="nav-link"href="<?php echo base_url($this->router->directory.'user/logout'); ?>"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
			</li>
			<?php } ?>
						
			
			<?php if (isset($this->session->userdata['sess_user']['id'])) {  /* ?>
			<li class="nav-item dropdown <?php echo ($segment1 == 'user' && ($segment2 != 'manage' || $segment2 != 'create_account')) ? 'active':''?>">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">My Account </a>
				<div class="dropdown-menu" aria-labelledby="dropdown03">
					
					<div class="dropdown-item welcome-user-container">
					<!--<a class="dropdown-item" href="#">-->				
						<div class=""><?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></div>
						<div class="small"><?php echo isset($this->session->userdata['sess_user']['user_email']) ? $this->session->userdata['sess_user']['user_email'] :'';?></div>
						<div class="small">Role: <?php echo isset($this->session->userdata['sess_user']['user_role_name']) ? $this->session->userdata['sess_user']['user_role_name'] :'';?></div>
						<div class="small d-none">Last Login: 03/04/2018 10.30am</div>
					<!--</a>-->
					</div><!--/.welcome-user-container-->
					
					<div class="dropdown-divider mt-3"></div>			
					<a class="dropdown-item"  href="<?php echo base_url($this->router->directory.'user/profile/'.$this->session->userdata['sess_user']['id']); ?>">Profile</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/change_password'); ?>">Change Password</a>
					<a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/logout'); ?>">Logout</a>			
				</div>
			</li>
			<?php */ } ?>
		</ul>
		<form class="form-inline my-2 my-lg-0">
		  <input class="form-control form-control-sm mr-sm-2" type="search" placeholder="Enterprise Search" aria-label="Search">
		</form>
	</div>
</nav>