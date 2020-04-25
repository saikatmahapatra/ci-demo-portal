<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Self Service Portal</h3>
    </div>

    <ul class="list-unstyled components">
    <?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
        <p class="">
            <?php //echo $this->common_lib->get_greetings().'!'; ?>
            Welcome, 
            <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'] :'';?>
        </p>
    <?php } ?>
        
        <li class=""><!--/.active-->
            <a href="<?php echo base_url($this->router->directory); ?>"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li><a href="<?php echo base_url('event_calendar'); ?>"><i class="fas fa-calendar-alt"></i> Event Calendar</a></li>
        <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
        <li class="">
            <a href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-user-lock"></i> Admin or HRMS</a>
            <ul class="collapse list-unstyled" id="adminSubmenu">
            <li><a href="<?php echo base_url('cms/add'); ?>">Add New Content</a></li>
            <li><a href="<?php echo base_url('cms'); ?>">Manage Contents</a></li>
            <li><a href="<?php echo base_url('holiday'); ?>">Manage Holiday Calendar</a></li>
            <li><a href="<?php echo base_url('user/create_account'); ?>">Add New Employee</a></li>
            <li><a href="<?php echo base_url('user/manage'); ?>">Employee Management</a></li>
            <li><a href="<?php echo base_url('leave/manage/all'); ?>">Leave Applications</a></li>
            <li><a href="<?php echo base_url('leave/view_leave_balance'); ?>">Leave Balance Management</a></li>
            <li><a href="<?php echo base_url('leave/manage/assigned_to_me'); ?>">Leave to Approve</a></li>
            <li><a href="<?php echo base_url('timesheet/report'); ?>">Timesheet Report</a></li>
            <li><a href="<?php echo base_url('project'); ?>">Projects</a></li>
            <li><a href="<?php echo base_url('project/tasks'); ?>">Tasks</a></li>
            </ul>
        </li>
        <?php } ?>

        <li class="">
            <a href="#organizationSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-bookmark"></i> Organization</a>
            <ul class="collapse list-unstyled" id="organizationSubmenu">
                <li><a href="<?php echo base_url('user/people');?>">Employees</a></li>
                <li><a href="<?php echo base_url('user/reportee_employee'); ?>">My Reportees</a></li>
                <li><a href="<?php echo base_url('home/policy'); ?>">HR Policies</a></li>
                <li><a href="<?php echo base_url('holiday/view');?>">Holidays List [<?php echo date('Y');?>]</a></li>
            </ul>
        </li>

        <li><a href="<?php echo base_url('timesheet'); ?>"><i class="fas fa-calendar-check"></i> Timesheet</a></li>

        <li class="">
            <a href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-paper-plane"></i> Leave</a>
            <ul class="collapse list-unstyled" id="leaveSubmenu">
            <li><a href="<?php echo base_url('leave/apply'); ?>">Apply</a></li>
            <li><a href="<?php echo base_url('leave/history'); ?>">History</a></li>
            <li><a href="<?php echo base_url('user/edit_approvers'); ?>">Change Approvers</a></li>
            <li><a href="<?php echo base_url('leave/manage/assigned_to_me'); ?>">Leave to Approve</a></li>
            </ul>
        </li>
        
        <li class="">
            <a href="#maSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-user"></i> My Account</a>
            <ul class="collapse list-unstyled" id="maSubmenu">
            <li><a href="<?php echo base_url('user/profile');?>">My Profile</a></li>
            <li><a href="<?php echo base_url('document');?>">My Documents</a></li>
            <li><a href="<?php echo base_url('user/change_password');?>">Change Password</a></li>
            <!-- <li><a href="<?php echo base_url('user/logout');?>">Logout</a></li> -->
            </ul>
        </li>
    </ul>

    <ul class="list-unstyled CTAs">
        <li>
            <a href="<?php echo base_url('user/logout');?>" class="download"><i class="fas fa-power-off"></i> Sign out</a>
        </li>
        <li>
            <a href="#" class="article"><?php echo $this->config->item('app_version');?></a>
        </li>
    </ul>
</nav>