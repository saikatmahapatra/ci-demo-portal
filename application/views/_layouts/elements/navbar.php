<header class="header-navbar">
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
        <!-- <a class="sidebar-toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a> -->
        <button class="navbar-toggler" type="button" data-toggle="dropdown" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="<?php echo base_url($this->router->directory); ?>"><img class="nav-logo" src="<?php echo base_url('assets/dist/img/logo-light.png');?>"></a>

        <!-- .collapse .navbar-collapse removed -->
        <?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
        <div class="navbar-collapse justify-content-end" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown bs-mega-menu"> 
                    <!-- <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Employee Self Services </a> -->
                    <ul class="dropdown-menu dropdown-mega-menu">
                        <div class="row">
                            <li class="col-lg-3 col-md-6 dropdown-item">
                                <ul>
                                    <li class="dropdown-header">Organization</li>
                                    <li><a href="<?php echo base_url('user/search_employee');?>">Employee Directory</a></li>
                                    <li><a href="<?php echo base_url($this->router->directory.'home/policy'); ?>">HR Policies</a></li>
                                    <li><a href="<?php echo base_url('holiday/view');?>">Holidays</a></li>
                                </ul>
                            </li>
                            <li class="col-lg-3 col-md-6 dropdown-item">
                                <ul>
                                    <!-- <li class="dropdown-header">Calendar</li>
                                    <li><a href="<?php echo base_url($this->router->directory.'calendar'); ?>">My Calendar</a></li>
                                    <li class="divider"></li> -->
                                    <li class="dropdown-header">Timesheet</li>
                                    <li><a href="<?php echo base_url($this->router->directory.'timesheet'); ?>">Log Tasks</a></li>
                                    <li><a href="<?php echo base_url($this->router->directory.'timesheet/report?redirected_from=reportee_id'); ?>">Timesheet Report</a></li>
                                    <li class="dropdown-header">Team</li>
                                    <li><a href="<?php echo base_url($this->router->directory.'user/reportee_employee'); ?>">My Reportee</a></li>
                                </ul>
                            </li>
                            <li class="col-lg-3 col-md-6 dropdown-item">
                                <ul>
                                    <li class="dropdown-header">Leave</li>
                                    <li><a href="<?php echo base_url($this->router->directory.'leave/apply'); ?>">Apply</a></li>
                                    <li><a href="<?php echo base_url($this->router->directory.'leave/history'); ?>">Leave History</a></li>
                                    <li><a href="<?php echo base_url($this->router->directory.'user/edit_approvers'); ?>">Change Leave Approvers</a></li>
                                    <li><a href="<?php echo base_url($this->router->directory.'leave/manage/assigned_to_me'); ?>">Leave Applications to Approve</a></li>
                                </ul>
                            </li>
                            <li class="col-lg-3 col-md-6 dropdown-item">
                                <ul>
                                    <li class="dropdown-header">Profile</li>
                                    <li><a href="<?php echo base_url('user/profile');?>">My Profile</a></li>
                                    <li><a href="<?php echo base_url('user/edit_profile');?>">Edit Basic Information</a></li>
                                    <li><a href="<?php echo base_url('document');?>">Upload Documents</a></li>
                                    <li><a href="<?php echo base_url('user/change_password');?>">Change Password</a></li>
                                </ul>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item dropdownW">
                    <a class="nav-link dropdown-toggle" id="dropdown_notification" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o"></i></a>
                    <ul class="notification dropdown-menu dropdown-menu-right">
                        <li class="notification-title">You have 0 new notifications.</li>
                        <div class="notification-content d-none">
                            <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle-o-notch fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">You have logged in</p><p class="notification-meta">2 min ago</p></div></a></li>
                        </div>
                        <li class="notification-footer"><a href="<?php echo base_url();?>">See all notifications.</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown ml-3">
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
                        
                        <div class="dropdown-divider"></div>			
                        <a class="dropdown-item"  href="<?php echo base_url($this->router->directory.'user/profile/'); ?>">My Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/change_password'); ?>">Change Password</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/logout'); ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        <?php } ?>
    </nav>
</header>