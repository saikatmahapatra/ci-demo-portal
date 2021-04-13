<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    
    <div class="sb-sidenav-menu">
        <div class="nav ">
            <div class="sb-sidenav-menu-heading">
                <div>United Exploration</div>
            </div>
            <a class="nav-link" href="<?php echo base_url($this->router->directory); ?>">
                <div class="sb-nav-link-icon"><?php echo $this->app_lib->get_icon('dashboard'); ?></div>
                Dashboard
            </a>

            <!-- <a class="nav-link" href="<?php echo base_url('event_calendar'); ?>">
                <div class="sb-nav-link-icon"><?php echo $this->app_lib->get_icon('calendar'); ?></div>
                My Calendar
            </a> -->
            
            <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
            <!-- <div class="sb-sidenav-menu-heading">Admin HR</div> -->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsAdmin" aria-expanded="false" aria-controls="collapseLayoutsAdmin">
                <div class="sb-nav-link-icon"><?php echo $this->app_lib->get_icon('admin_user'); ?></div>
                Admin
                <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayoutsAdmin" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="<?php echo base_url('user/manage'); ?>">Employees</a>
                    <a class="nav-link" href="<?php echo base_url('cms'); ?>">Contents</a>
                    <a class="nav-link" href="<?php echo base_url('cms/manage_holidays'); ?>">Holiday Management</a>
                    <a class="nav-link" href="<?php echo base_url('cms/manage_banner'); ?>">Image Slider Manager</a>
                    <a class="nav-link" href="<?php echo base_url('leave/manage'); ?>">Leave Management</a>
                    <a class="nav-link" href="<?php echo base_url('leave/view_leave_balance'); ?>">Leave Balance</a>
                    <a class="nav-link" href="<?php echo base_url('project/timesheet_report'); ?>">Timesheet Report</a>
                    <a class="nav-link" href="<?php echo base_url('project'); ?>">Projects</a>
                    <a class="nav-link" href="<?php echo base_url('project/tasks'); ?>">Tasks</a>
                </nav>
            </div>
            <?php } ?>

            <!-- <div class="sb-sidenav-menu-heading">ESS MENU</div> -->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_1" aria-expanded="false" aria-controls="collapseLayouts_1">
                <div class="sb-nav-link-icon"><?php echo $this->app_lib->get_icon('organization'); ?></div>
                My Organization
                <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts_1" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo base_url('user/people');?>">Employees</a>
                <a class="nav-link" href="<?php echo base_url('user/reportee_employee'); ?>">My Reportees</a>
                <a class="nav-link" href="<?php echo base_url('home/policy'); ?>">HR Policies</a>
                <a class="nav-link" href="<?php echo base_url('cms/list_of_holidays');?>">Holiday List </a>
                </nav>
            </div>

            <a class="nav-link" href="<?php echo base_url('project/timesheet'); ?>">
                <div class="sb-nav-link-icon"><?php echo $this->app_lib->get_icon('timesheet'); ?></div>
                Timesheet
            </a>
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_2" aria-expanded="false" aria-controls="collapseLayouts_2">
                <div class="sb-nav-link-icon"><?php echo $this->app_lib->get_icon('leave'); ?></div>
                Leave
                <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts_2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo base_url('leave/apply'); ?>">Apply</a>
                <a class="nav-link" href="<?php echo base_url('leave/history'); ?>">History</a>
                <a class="nav-link" href="<?php echo base_url('user/edit_approvers'); ?>">Change Approvers</a>
                <a class="nav-link" href="<?php echo base_url('leave/manage'); ?>">Leave to Approve</a>
                </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts_3" aria-expanded="false" aria-controls="collapseLayouts_3">
                <div class="sb-nav-link-icon"><?php echo $this->app_lib->get_icon('user_account'); ?></div>
                My Account
                <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts_3" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo base_url('user/profile');?>">My Profile</a>
                <a class="nav-link" href="<?php echo base_url('user/my_documents');?>">My Documents</a>
                <a class="nav-link" href="<?php echo base_url('user/change_password');?>">Change Password</a>
                <a class="nav-link" href="<?php echo base_url('user/logout');?>">Logout</a>
                </nav>
            </div>
            <!-- <div class="sb-sidenav-menu-heading">Addons</div>
            <a class="nav-link" href="charts.html">
                <div class="sb-nav-link-icon"><i class="fa fa-chart-area"></i></div>
                Charts
            </a>
            <a class="nav-link" href="tables.html">
                <div class="sb-nav-link-icon"><i class="fa fa-table"></i></div>
                Tables
            </a> -->
        </div>
    </div>
    <div class="sb-sidenav-footer">
    <div class="d-flex justify-content-end my-0 mx-0">
        <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo isset($this->session->userdata['sess_hide_sidebar_md']) ? 'Show sidebar' : 'Hide sidebar'; ?>" id="locksidebar" class="d-none d-sm-block text-secondary"><?php echo isset($this->session->userdata['sess_hide_sidebar_md']) ? $this->app_lib->get_icon('show_sidebar') : $this->app_lib->get_icon('hide_sidebar'); ?></a>
    </div>
    </div>
</nav>