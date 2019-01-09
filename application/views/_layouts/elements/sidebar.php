<div class="sidebar-overlay" data-toggle="sidebar"></div>
<aside class="sidebar">
    <?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
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


    <div class="sidebar-user">
        <a href="<?php echo base_url('user/my_profile'); ?>"><img class="sidebar-user-avatar" src="<?php echo base_url($img_src);?>" alt="Profile Image" /></a>
        <div class="small">
            <p class="sidebar-user-name">
                <?php echo isset($this->session->userdata['sess_user']['user_title'])? $this->session->userdata['sess_user']['user_title']:''; ?>
                <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'] : '' ;?>
                <?php //echo isset($this->session->userdata['sess_user']['user_lastname']) ? ' '.substr($this->session->userdata['sess_user']['user_lastname'], 0, 1) : '' ;?>
            </p>
            <p class="sidebar-user-designation">
                <?php echo isset($this->session->userdata['sess_user']['user_emp_id']) ? 'Emp ID : '.$this->session->userdata['sess_user']['user_emp_id'] :'';?>
            </p>
            <p class="sidebar-user-designation">
                <?php echo isset($this->session->userdata['sess_user']['designation_name']) ? $this->session->userdata['sess_user']['designation_name'] :'';?>
            </p>
        </div>
    </div>
    <?php } ?>

    <ul class="menu">
        <li>
            <a class="menu-item" href="<?php echo base_url();?>"><i class="menu-icon fa fa-dashboard"></i><span class="menu-label">Dashboard</span></a>
        </li>
        <li class="treeview">
            <a class="menu-item" href="#" data-toggle="treeview"><i class="menu-icon fa fa-user-circle-o"></i><span class="menu-label">Update My Profile</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'user/my_profile'); ?>">View My Profile</a></li>
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'user/profile_pic'); ?>">Update Profile Pic</a></li>
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'user/edit_profile'); ?>">Basic Information</a></li>
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'user/add_address'); ?>">Add Address</a></li>
				<li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'user/add_education'); ?>">Add Education</a></li>
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'user/add_work_experience'); ?>">Add Work Experience</a></li>
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'user/add_bank_account'); ?>">Add Salary Account</a></li>	
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'document'); ?>">Upload Documents</a></li>	
            </ul>
        </li>
        <li class="treeview">
            <a class="menu-item" href="#" data-toggle="treeview"><i class="menu-icon fa fa-check"></i><span class="menu-label">My Approvers</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'user/edit_approvers'); ?>">Leave Approvers</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a class="menu-item" href="#" data-toggle="treeview"><i class="menu-icon fa fa-laptop" aria-hidden="true"></i><span class="menu-label">Self Services</span><i class="treeview-indicator fa fa-angle-right" aria-hidden="true"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'user/my_profile'); ?>">Update Profile Information</a></li>
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'document'); ?>">My Documents</a></li>
                <!-- <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'leave/apply'); ?>">Apply Leave</a></li>
				<li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'leave/history'); ?>">My Leave History</a></li>
				<li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'leave/manage'); ?>">Manage Leaves</a></li>	 -->
            </ul>
        </li>

        <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>			
			<li class="treeview">
                <a class="menu-item" href="#" data-toggle="treeview"><i class="menu-icon fa fa-users"></i><span class="menu-label">Manage Employees</span><i class="treeview-indicator fa fa-angle-right" aria-hidden="true"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'user/manage'); ?>">All Employees</a></li>
                    <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'user/create_account'); ?>">Add New Employee</a></li>
                </ul>
            </li>
        <?php } else { ?>
        <li>
            <a class="menu-item" href="<?php echo base_url('user/people');?>"><i class="menu-icon fa fa-users"></i><span class="menu-label">People Network</span></a>
        </li>
        <?php } ?>

        <li class="treeview">
            <a class="menu-item" href="#" data-toggle="treeview"><i class="menu-icon fa fa-clock-o" aria-hidden="true"></i><span class="menu-label">Timesheet & Projects</span><i class="treeview-indicator fa fa-angle-right" aria-hidden="true"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'timesheet'); ?>">My Timesheet</a></li>
                <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>			
                <li><a class="treeview-item" href="<?php echo base_url('timesheet/report'); ?>">Timesheet  Report</a></li>
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'project'); ?>">Manage Projects</a></li>
                <li><a class="treeview-item" href="<?php echo base_url('project/activity'); ?>">Manage Task Activities</a></li>
                <?php } ?>	
            </ul>
        </li>
        
        <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>			
        <li class="treeview">
            <a class="menu-item" href="#" data-toggle="treeview"><i class="menu-icon fa fa-list-ul" aria-hidden="true"></i><span class="menu-label">Content Management</span><i class="treeview-indicator fa fa-angle-right" aria-hidden="true"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'cms'); ?>">Manage Contents - Updates</a></li>
                <li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'cms/add'); ?>">Add New Content</a></li>
				<li><a class="treeview-item" href="<?php echo base_url($this->router->directory.'holiday'); ?>">Manage Holiday Calendar</a></li>
            </ul>
        </li>
        <?php } ?>
        <li>
            <a class="menu-item" href="<?php echo base_url('holiday/view');?>"><i class="menu-icon fa fa-calendar-check-o" aria-hidden="true"></i><span class="menu-label">Holiday List</span></a>
        </li>
        <li>
            <a class="menu-item" href="<?php echo base_url('faq');?>"><i class="menu-icon fa fa-question-circle-o" aria-hidden="true"></i><span class="menu-label">FAQ</span></a>
        </li>

    </ul>

</aside>