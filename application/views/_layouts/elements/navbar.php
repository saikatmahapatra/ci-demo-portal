<header class="header-navbar <?php echo (isset($this->session->userdata['sess_user']['id'])) ? 'post-auth' : 'pre-auth'; ?>">
<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <a class="mega-menu-toggle" href="#" data-toggle="dropdown" aria-label="Show Menu"></a>
		<!-- <a class="sidebar-toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a> -->
		<!-- <button class="navbar-toggler" type="button" data-toggle="dropdown" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        
        <a class="navbar-brand" href="<?php echo base_url($this->router->directory); ?>">
            <img class="nav-logo" src="<?php echo base_url('assets/dist/img/logo-light.png');?>">
        </a>


        <?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown bs-mega-menu">
                        <!-- <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Menu </a> -->
                        <ul class="dropdown-menu dropdown-mega-menu">
                        <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                            <div class="row">
                                <li class="col-lg-3 col-md-6 dropdown-item">
                                    <ul>
                                        <li class="dropdown-header"><i class="bsmm-icon fa fa-user-plus" aria-hidden="true"></i> Employee Management</li>
                                        <li><a href="<?php echo base_url('user/create_account'); ?>">Add New Employee</a></li>
                                        <li><a href="<?php echo base_url('user/manage'); ?>">Manage Employees</a></li>
                                    </ul>
                                </li>

                                <li class="col-lg-3 col-md-6 dropdown-item">
                                    <ul>
                                        <li class="dropdown-header"><i class="bsmm-icon fa fa-leaf" aria-hidden="true"></i> Content Management</li>
                                        <li><a href="<?php echo base_url('cms/add'); ?>">Add New Content</a></li>
                                        <li><a href="<?php echo base_url('cms'); ?>">Manage Contents</a></li>
                                        <li><a href="<?php echo base_url('holiday'); ?>">Manage Holidays</a></li>
                                    </ul>
                                </li>

                                <li class="col-lg-3 col-md-6 dropdown-item">
                                    <ul>
                                        <li class="dropdown-header"><i class="bsmm-icon fa fa-paper-plane-o" aria-hidden="true"></i> Leave Management</li>
                                        <li><a href="<?php echo base_url('leave/manage/all'); ?>">Leave Applications</a></li>
                                        <li><a href="<?php echo base_url('leave/view_leave_balance'); ?>">Leave Balance</a></li>
                                        <!-- <li><a href="<?php echo base_url('leave/import_data'); ?>">Import/Export Balance Sheet</a></li> -->
                                        <li><a href="<?php echo base_url('leave/manage/assigned_to_me'); ?>">Leave Applications to Approve</a></li>
                                    </ul>
                                </li>

                                <li class="col-lg-3 col-md-6 dropdown-item">
                                    <ul>
                                        <li class="dropdown-header"><i class="bsmm-icon fa fa-calendar-check-o" aria-hidden="true"></i> Timesheet & Projects</li>
                                        <li><a href="<?php echo base_url('timesheet/report'); ?>">Timesheet Report</a></li>
                                        <li><a href="<?php echo base_url('project'); ?>">Manage Projects</a></li>
                                        <li><a href="<?php echo base_url('project/tasks'); ?>">Manage Tasks</a></li>
                                    </ul>
                                </li>

                            </div>
                            <?php } ?>
                            <div class="row">
                                
                                <li class="col-lg-3 col-md-6 dropdown-item">
                                    <ul>
                                        <!-- <li class="dropdown-header"><i class="bsmm-icon fa fa-home" aria-hidden="true"></i> Home</li>
                                        <li><a href="<?php echo base_url();?>">Dashboard</a></li>
                                        <li class="divider"></li> -->
                                        <li class="dropdown-header"><i class="bsmm-icon fa fa-institution" aria-hidden="true"></i> Organization</li>
                                        <li><a href="<?php echo base_url('user/people');?>">Employees</a></li>
                                        <li><a href="<?php echo base_url('home/policy'); ?>">HR Policies</a></li>
                                        <li><a href="<?php echo base_url('holiday/view');?>">Holidays</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header"><i class="bsmm-icon fa fa-puzzle-piece" aria-hidden="true"></i> Team</li>
                                        <li><a href="<?php echo base_url('user/reportee_employee'); ?>">My Reportee</a></li>
                                    </ul>
                                </li>
                                <li class="col-lg-3 col-md-6 dropdown-item">
                                    <ul>
                                        <li class="dropdown-header"><i class="bsmm-icon fa fa-calendar-check-o" aria-hidden="true"></i> Timesheet</li>
                                        <li><a href="<?php echo base_url('timesheet'); ?>">Log Tasks</a></li>
                                        <li><a href="<?php echo base_url('timesheet/report?redirected_from=reportee_id'); ?>">Report</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header"><i class="bsmm-icon fa fa-calendar" aria-hidden="true"></i> Event Calendar</li>
                                        <li><a href="<?php echo base_url('event_calendar'); ?>">View Calendar</a></li>
                                    </ul>
                                </li>
                                <li class="col-lg-3 col-md-6 dropdown-item">
                                    <ul>
                                        <li class="dropdown-header"><i class="bsmm-icon fa fa-plane" aria-hidden="true"></i> Leave</li>
                                        <li><a href="<?php echo base_url('leave/apply'); ?>">Apply</a></li>
                                        <li><a href="<?php echo base_url('leave/history'); ?>">History</a></li>
                                        <li><a href="<?php echo base_url('user/edit_approvers'); ?>">Change Approvers</a></li>
                                        <li><a href="<?php echo base_url('leave/manage/assigned_to_me'); ?>">Leave to Approve</a></li>
                                    </ul>
                                </li>
                                <li class="col-lg-3 col-md-6 dropdown-item">
                                    <ul>
                                        <li class="dropdown-header"><i class="bsmm-icon fa fa-user-circle" aria-hidden="true"></i> Profile</li>
                                        <li><a href="<?php echo base_url('user/profile');?>">My Profile</a></li>
                                        <li><a href="<?php echo base_url('user/edit_profile');?>">Edit Basic Information</a></li>
                                        <li><a href="<?php echo base_url('user/profile_pic');?>">Change Profile Photo</a></li>
                                        <li><a href="<?php echo base_url('document');?>">My Documents</a></li>
                                        <li><a href="<?php echo base_url('user/change_password');?>">Change Password</a></li>
                                        <li><a href="<?php echo base_url('user/logout');?>">Logout</a></li>
                                    </ul>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav my-2 my-lg-0">
                    <li class="nav-item dropdown no-toggle-icon">
                        <a class="nav-link dropdown-toggle" id="dropdown_notification" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-fw fa-bell-o "></i></a>
                        <ul class="notification dropdown-menu dropdown-menu-right">
                            <li class="notification-title">You have 0 new notifications.</li>
                                <div class="notification-content">
                                    <!-- <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack "><i class="fa fa-fw fa-circle-o-notch fa-stack-2x text-primary"></i><i class="fa fa-fw fa-envelope fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Lisa sent you a mail</p><p class="notification-meta">2 min ago</p></div></a></li>-->
                                </div>
                            <li class="notification-footer"><a href="<?php echo base_url();?>">See all notifications.</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown_5" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-fw fa-user-circle " aria-hidden="true"></i> <?php //echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'] : 'Guest';?></a>
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
                            <a class="dropdown-item"  href="<?php echo base_url('user/profile/'); ?>">My Profile</a>
                            <a class="dropdown-item" href="<?php echo base_url('user/change_password'); ?>">Change Password</a>
                            <a class="dropdown-item" href="<?php echo base_url('user/logout'); ?>">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        <?php } ?>
    </nav>
</header>