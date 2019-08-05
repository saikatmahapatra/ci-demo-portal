<nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top colorgraph-navbar">
        <a class="navbar-brand" href="<?php echo base_url($this->router->directory); ?>">
            <img class="logo" src="<?php echo base_url('assets/dist/img/logo-nav.png');?>">
            <?php echo $this->config->item('app_logo_name_dashboard'); ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>">Dashboard
					<span class="sr-only">(current)</span>
				</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Self Services</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown_1">
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/my_profile'); ?>">Update Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'document'); ?>">Upload Documents</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/edit_approvers'); ?>">Change Leave Approvers</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'leave/apply'); ?>">Apply Leave</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'leave/history'); ?>">My Leave History</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'leave/manage/assigned_to_me'); ?>">Approve Leave Requests</a>

                    </div>
                </li>
				<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown_2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                        Organization & Assets
                    <?php } else{?>
                        Organization
                    <?php }?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown_2">
                        <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                            <!-- <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'home/policy'); ?>">HR & Organization Policy</a> -->
                            <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/manage'); ?>">Manage Employees</a>
                            <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/create_account'); ?>">Add New Employee</a>
                            <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'leave/leave_balance'); ?>">Add / Manage Leave Balance</a>
                            <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'leave/manage/all'); ?>">View Leave Requests</a>
                            <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'project'); ?>">Add / Manage Projects</a>
                            <a class="dropdown-item" href="<?php echo base_url('project/activity'); ?>">Add / Manage Timesheet Activity</a>
                            <a class="dropdown-item" href="<?php echo base_url('holiday/view');?>">Holiday Calendar</a>
                            <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'timesheet'); ?>">Timesheet - Log Tasks</a>
                            <a class="dropdown-item" href="<?php echo base_url('timesheet/report'); ?>">Timesheet Report</a>
                    <?php } else{?>
                        <!-- <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'home/policy'); ?>">HR & Organization Policy</a> -->
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'timesheet'); ?>">Timesheet - Log Tasks</a>
                        <a class="dropdown-item" href="<?php echo base_url('user/people');?>">Employee Directory</a>
                        <a class="dropdown-item" href="<?php echo base_url('holiday/view');?>">Holiday Calendar</a>
                    <?php }?>
                    </div>
                </li>
                <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown_3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CMS</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown_3">
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'cms'); ?>">Manage Contents</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'cms/add'); ?>">Add New Content</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'holiday'); ?>">Manage Holiday Calendar</a>
                    </div>
                </li>
                <?php }?>
				<!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown_3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More...</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown_3">
                        <a class="dropdown-item" href="#">Link 1</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" target="_blank" href="http://unitedexploration.co.in/">Corporate Website</a>
                        <a class="dropdown-item" href="#">Link 4</a>
                    </div>
                </li> -->
            </ul>

            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                <?php echo form_open(base_url('user/people'), array( 'method' => 'get','class'=>'form-inline','name' => '','id' => 'ci-form-helper',)); ?>
				    <?php echo form_hidden('form_action', 'search'); ?>
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-sm" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </li>
                        
                <li class="nav-item dropdown no-toggle-icon d-none">
                    <a class="nav-link dropdown-toggle" id="dropdown_notification" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o "></i></a>
                    <ul class="notification dropdown-menu dropdown-menu-right">
                        <li class="notification-title">You have 0 new notifications.</li>
                            <div class="notification-content">
                                <!-- <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack "><i class="fa fa-circle-o fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Lisa sent you a mail</p><p class="notification-meta">2 min ago</p></div></a></li>
                                <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack "><i class="fa fa-circle-o fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Mail server not working</p><p class="notification-meta">5 min ago</p></div></a></li>
                                <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack "><i class="fa fa-circle-o fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Transaction complete</p><p class="notification-meta">2 days ago</p></div></a></li>
                                <div
                                    class="notification-content">
                                    <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack "><i class="fa fa-circle-o fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Lisa sent you a mail</p><p class="notification-meta">2 min ago</p></div></a></li>
                                    <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack "><i class="fa fa-circle-o fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Mail server not working</p><p class="notification-meta">5 min ago</p></div></a></li>
                                    <li><a class="notification-item" href="<?php echo base_url();?>"><span class="notification-icon"><span class="fa-stack "><i class="fa fa-circle-o fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span><div><p class="notification-message">Transaction complete</p><p class="notification-meta">2 days ago</p></div></a></li>
                                </div> -->
                            </div>
                        <li class="notification-footer"><a href="<?php echo base_url();?>">See all notifications.</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown_5" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="fa fa-user-circle " aria-hidden="true"></i> <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'] : 'Guest';?></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown_5">					
                        <div class="dropdown-item welcome-user-container">	
                            
                        <?php
                            $img_src = "";
                            $default_path = "assets/dist/img/default_user@2x.jpg";
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
                            <!-- <div class="text-center d-none">
                            <img class="img-rounded border border-secondary" src="<?php echo base_url($img_src);?>" alt="Profile Image" style="width:64px; height:64px;" />
                            </div> -->
                            <div class="mb-1">
                                <?php echo isset($this->session->userdata['sess_user']['user_title'])? $this->session->userdata['sess_user']['user_title']:''; ?> <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></div>
                            <div class="small"><?php echo isset($this->session->userdata['sess_user']['user_emp_id']) ? 'Employee ID : '.$this->session->userdata['sess_user']['user_emp_id'] :'';?></div>
                            <div class="small"><?php echo isset($this->session->userdata['sess_user']['designation_name']) ? $this->session->userdata['sess_user']['designation_name'] :'';?></div>
                            <div class="small"><?php echo isset($this->session->userdata['sess_user']['user_email']) ? $this->session->userdata['sess_user']['user_email'] :'';?></div>
                            <div class="small">Access Group: <?php echo isset($this->session->userdata['sess_user']['user_role_name']) ? $this->session->userdata['sess_user']['user_role_name'] :'';?></div>
                            <div class="small">Last Login: <?php echo isset($this->session->userdata['sess_user']['user_login_date_time']) ? $this->common_lib->display_date($this->session->userdata['sess_user']['user_login_date_time'], true) :'';?></div>					
                        </div><!--/.welcome-user-container-->
                        
                        <div class="dropdown-divider mt-2"></div>			
                        <a class="dropdown-item"  href="<?php echo base_url($this->router->directory.'user/my_profile/'); ?>">My Profile</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/change_password'); ?>">Change Password</a>
                        <a class="dropdown-item" href="<?php echo base_url($this->router->directory.'user/logout'); ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        <?php } // end of session check ?>
    </nav>

<!-- <div class="mb-2 bg-light small">
      <nav class="nav ">
        <a class="nav-link" href="#">Quick Links</a>
        <a class="nav-link" href="#">Apply Leave</a>
        <a class="nav-link" href="#">Timesheet</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
      </nav>
</div> -->