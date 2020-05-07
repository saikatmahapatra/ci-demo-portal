<nav id="sidebar" class="<?php echo isset($this->session->userdata['sess_hide_sidebar_md']) ? 'active' : ''; ?>">
    <div class="sidebar-header">
        <?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
            <?php   
                $img_src = "";
                $default_path = "";
                $show_name_dp = true;
                $sess_user_firstname = $this->session->userdata['sess_user']['user_firstname'];
                $sess_user_lastname = $this->session->userdata['sess_user']['user_lastname'];
                $sess_designation_name = $this->session->userdata['sess_user']['designation_name'];
                $profile_pic = $this->session->userdata['sess_user']['user_profile_pic'];
                if(isset($profile_pic)){
                    $user_dp = "assets/uploads/user/profile_pic/".$profile_pic;
                    if (file_exists(FCPATH . $user_dp)) {
                        $img_src = $user_dp;
                        $show_name_dp = true;
                    }else{
                        $img_src = $default_path;
                        $show_name_dp = true;
                    }
                }else{
                    $img_src = $default_path;
                    $show_name_dp = true;
                }
            ?>
        <a href="<?php echo base_url('user/profile');?>">
        <?php if($show_name_dp === true) { ?>
        <div class="sidebar-user-dp mx-auto d-block">
            <?php
                echo isset($sess_user_firstname) ? substr($sess_user_firstname, 0, 1) : '-';
                echo isset($sess_user_lastname) ? substr($sess_user_lastname, 0, 1) : '';
            ?>
        </div>
        <?php } else {?>
            <img class="sidebar-user-dp rounded mx-auto d-block" src="<?php echo base_url($img_src);?>">
        <?php } ?>
        <div class="text-center mt-2"><?php echo $sess_user_firstname.' '.$sess_user_lastname; ?></div>
        </a>
        <div id="locksidebar" class="d-none d-md-block float-right"><?php echo isset($this->session->userdata['sess_hide_sidebar_md']) ? $this->common_lib->get_icon('right_arrow') : $this->common_lib->get_icon('left_arrow'); ?></div>

        <?php } ?>
        
    </div>
    
    <?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
    <ul class="list-unstyled components">
        <!-- <p class="d-lg-none user-info">
            <?php //echo isset($this->session->userdata['sess_user']['user_firstname']) ? 'Hi, '.$this->session->userdata['sess_user']['user_firstname'].' !' :'';?>
        </p> -->
        <li class=""><!--/.active-->
            <a href="<?php echo base_url($this->router->directory); ?>"><?php echo $this->common_lib->get_icon('home'); ?> Dashboard</a>
        </li>
        <!-- <li><a href="<?php echo base_url('event_calendar'); ?>"><?php //echo $this->common_lib->get_icon('calendar'); ?> Event Calendar</a></li> -->
        <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
        <li class="">
            <a href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $this->common_lib->get_icon('admin_user'); ?> Administrator</a>
            <ul class="collapse list-unstyled" id="adminSubmenu">
            <li><a href="<?php echo base_url('user/manage'); ?>">Employees</a></li>
            <!-- <li><a href="<?php echo base_url('cms/add'); ?>">New Content</a></li> -->
            <li><a href="<?php echo base_url('cms'); ?>">Contents</a></li>
            <li><a href="<?php echo base_url('holiday'); ?>">Holiday Calendar</a></li>
            <!-- <li><a href="<?php echo base_url('user/create_account'); ?>">New Employee</a></li> -->
            
            <li><a href="<?php echo base_url('leave/manage'); ?>">Leave Management</a></li>
            <li><a href="<?php echo base_url('leave/view_leave_balance'); ?>">Leave Balance</a></li>
            <li><a href="<?php echo base_url('timesheet/report'); ?>">Timesheet Report</a></li>
            <li><a href="<?php echo base_url('project'); ?>">Projects</a></li>
            <li><a href="<?php echo base_url('project/tasks'); ?>">Tasks</a></li>
            </ul>
        </li>
        <?php } ?>

        <li class="">
            <a href="#organizationSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $this->common_lib->get_icon('organization'); ?> Organization</a>
            <ul class="collapse list-unstyled" id="organizationSubmenu">
                <li><a href="<?php echo base_url('event_calendar'); ?>">Event Calendar</a></li>
                <li><a href="<?php echo base_url('user/people');?>">Employees</a></li>
                <li><a href="<?php echo base_url('user/reportee_employee'); ?>">My Reportees</a></li>
                <li><a href="<?php echo base_url('home/policy'); ?>">HR Policies</a></li>
                <li><a href="<?php echo base_url('holiday/view');?>">Holidays List </a></li>
            </ul>
        </li>

        <li><a href="<?php echo base_url('timesheet'); ?>"><?php echo $this->common_lib->get_icon('timesheet'); ?> Timesheet</a></li>

        <li class="">
            <a href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $this->common_lib->get_icon('leave'); ?> Leave</a>
            <ul class="collapse list-unstyled" id="leaveSubmenu">
            <li><a href="<?php echo base_url('leave/apply'); ?>">Apply</a></li>
            <li><a href="<?php echo base_url('leave/history'); ?>">History</a></li>
            <li><a href="<?php echo base_url('user/edit_approvers'); ?>">Change Approvers</a></li>
            <li><a href="<?php echo base_url('leave/manage'); ?>">Leave to Approve</a></li>
            </ul>
        </li>
        
        <li class="">
            <a href="#maSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $this->common_lib->get_icon('user_account'); ?> My Account</a>
            <ul class="collapse list-unstyled" id="maSubmenu">
            <li><a href="<?php echo base_url('user/profile');?>">My Profile</a></li>
            <li><a href="<?php echo base_url('document');?>">My Documents</a></li>
            <li><a href="<?php echo base_url('user/change_password');?>">Change Password</a></li>
            <li><a href="<?php echo base_url('user/logout');?>">Sign Out</a></li>
            </ul>
        </li>
    </ul>

    <ul class="list-unstyled CTAs">
        <li>
            <a href="<?php echo base_url('user/logout');?>" class="download">Sign Out</a>
        </li>
        <li>
            <a href="#" class="article"><?php echo $this->config->item('app_version');?></a>
        </li>
    </ul>
    <div class="small text-center px-3"><?php echo $this->config->item('app_admin_copy_right');?></div>
    <?php } ?>
</nav>