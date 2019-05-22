<header class="header">
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="<?php echo base_url($this->router->directory); ?>">
		<img class="logo" src="<?php echo base_url('assets/src/img/logo.png');?>">
		<?php //echo $this->config->item('app_logo_name_dashboard'); ?>
	    </a>
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <a class="sidebar-toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- .collapse .navbar-collapse removed -->
        <div class="navbar-collapse justify-content-end" id="navbarsExampleDefault">
			  <ul class="navbar-nav">
                <?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
                <li class="nav-item search">
                    <?php echo form_open(base_url('user/people'), array( 'method' => 'get','class'=>'form-inline','name' => '','id' => 'ci-form-helper',)); ?>
				    <?php echo form_hidden('form_action', 'search'); ?>
					  <input name="q" class="form-control search-input" type="search" placeholder="Search Employees" aria-label="Search">
					  <button class="search-button" type="submit"><i class="fa fa-search"></i></button>
					<?php echo form_close(); ?>
                </li>

                <li class="nav-item dropdown nav-icon-adjust">
                    <a class="nav-link dropdown-toggle" id="dropdown_notification" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
                    <ul class="notification dropdown-menu dropdown-menu-right">
                        <li class="notification-title">You have 0 new notifications.</li>
                            <div class="notification-content">
                                <!-- <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-flash fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Lisa sent you a mail</p><p class="notification-meta">2 min ago</p></div></a></li>
                                <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-flash fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Mail server not working</p><p class="notification-meta">5 min ago</p></div></a></li>
                                <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-flash fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Transaction complete</p><p class="notification-meta">2 days ago</p></div></a></li>
                                <div
                                    class="notification-content">
                                    <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-flash fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Lisa sent you a mail</p><p class="notification-meta">2 min ago</p></div></a></li>
                                    <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-flash fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Mail server not working</p><p class="notification-meta">5 min ago</p></div></a></li>
                                    <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-flash fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Transaction complete</p><p class="notification-meta">2 days ago</p></div></a></li>
                                </div> -->
                            </div>
                        <li class="notification-footer"><a href="<?php echo base_url();?>">See all notifications.</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown nav-icon-adjust">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="fa fa-user-circle fa-lg" aria-hidden="true"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown03">					
                        <div class="dropdown-item welcome-user-container">					
                            <div class="mb-1"><?php echo isset($this->session->userdata['sess_user']['user_title'])? $this->session->userdata['sess_user']['user_title']:''; ?> <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></div>
                            <div class="small"><?php echo isset($this->session->userdata['sess_user']['user_email']) ? $this->session->userdata['sess_user']['user_email'] :'';?></div>
                            <div class="small">Access Group: <?php echo isset($this->session->userdata['sess_user']['user_role_name']) ? $this->session->userdata['sess_user']['user_role_name'] :'';?></div>
                            <div class="small">Last Login: <?php echo isset($this->session->userdata['sess_user']['user_login_date_time']) ? $this->common_lib->display_date($this->session->userdata['sess_user']['user_login_date_time'], true) :'';?></div>					
                        </div><!--/.welcome-user-container-->
                        
                        <div class="dropdown-divider mt-3"></div>			
                        <a class="dropdown-item"  href="<?php echo base_url($this->router->directory.'user/my_profile/'); ?>">My Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/change_password'); ?>">Change Password</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/logout'); ?>">Logout</a>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>