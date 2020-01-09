<header class="header-navbar">
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
        <a class="sidebar-toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- <button class="navbar-toggler" type="button" data-toggle="sidebar" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button> -->

        <a class="navbar-brand" href="<?php echo base_url($this->router->directory); ?>">
		<img class="nav-logo" src="<?php echo base_url('assets/dist/img/logo-light.png');?>">
		<?php //echo $this->config->item('app_logo_name_dashboard'); ?>
	    </a>

        <!-- .collapse .navbar-collapse removed -->
        <div class="navbar-collapse justify-content-end" id="navbarsExampleDefault">
            <ul class="navbar-nav">
                <?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
                    <li class="nav-item dropdownW">
                        <a class="nav-link dropdown-toggle" id="dropdown_notification" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o"></i></a>
                        <ul class="notification dropdown-menu dropdown-menu-right">
                            <li class="notification-title">You have 0 new notifications.</li>
                            <div class="notification-content">
                                <!-- <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle-o-notch fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Lisa sent you a mail</p><p class="notification-meta">2 min ago</p></div></a></li>
                                <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle-o-notch fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Mail server not working</p><p class="notification-meta">5 min ago</p></div></a></li>
                                <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle-o-notch fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Transaction complete</p><p class="notification-meta">2 days ago</p></div></a></li>
                                <div
                                    class="notification-content">
                                    <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle-o-notch fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Lisa sent you a mail</p><p class="notification-meta">2 min ago</p></div></a></li>
                                    <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle-o-notch fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Mail server not working</p><p class="notification-meta">5 min ago</p></div></a></li>
                                    <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle-o-notch fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Transaction complete</p><p class="notification-meta">2 days ago</p></div></a></li>
                                </div> -->
                            </div>
                            <li class="notification-footer"><a href="<?php echo base_url();?>">See all notifications.</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown_5" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="fa fa-fw fa-user-circle " aria-hidden="true"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown_5">					
                        <div class="dropdown-item welcome-user-container">
                            <div class="mb-1"><?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></div>
                            <div class="small"><?php echo isset($this->session->userdata['sess_user']['user_emp_id']) ? 'Employee ID : '.$this->session->userdata['sess_user']['user_emp_id'] :'';?></div>
                            <div class="small"><?php echo isset($this->session->userdata['sess_user']['designation_name']) ? $this->session->userdata['sess_user']['designation_name'] :'';?></div>
                            <div class="small"><?php echo isset($this->session->userdata['sess_user']['user_email']) ? $this->session->userdata['sess_user']['user_email'] :'';?></div>
                            <div class="small">Access Group: <?php echo isset($this->session->userdata['sess_user']['user_role_name']) ? $this->session->userdata['sess_user']['user_role_name'] :'';?></div>
                            <div class="small">Last Login: <?php echo isset($this->session->userdata['sess_user']['user_login_date_time']) ? $this->common_lib->display_date($this->session->userdata['sess_user']['user_login_date_time'], true) :'';?></div>					
                        </div><!--/.welcome-user-container-->
                        
                        <div class="dropdown-divider mt-2"></div>			
                        <a class="dropdown-item"  href="<?php echo base_url($this->router->directory.'user/profile/'); ?>">My Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/change_password'); ?>">Change Password</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/logout'); ?>">Logout</a>
                    </div>
                </li>




                <?php } ?>
            </ul>
        </div>
    </nav>
</header>