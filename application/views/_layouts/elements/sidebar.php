<div class="sidebar-overlay" data-toggle="sidebar"></div>
<?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
<aside class="sidebar">    
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
        <a href="<?php echo base_url('user/profile'); ?>"><img class="sidebar-user-avatar" src="<?php echo base_url($img_src);?>" alt="Profile Image" /></a>
        <div class="">
            <p class="sidebar-user-name">
                <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' ('.$this->session->userdata['sess_user']['user_emp_id'].')': '' ;?>
            </p>
            <p class="small sidebar-user-designation">
                <?php echo isset($this->session->userdata['sess_user']['designation_name']) ? $this->session->userdata['sess_user']['designation_name'] :'';?>
            </p>
        </div>
    </div>
    

    <ul class="menu">
        <li>
            <a class="menu-item" href="<?php echo base_url();?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                <span class="menu-label">Dashboard</span>
            </a>
        </li>

        <?php 
        // Admin Menu
        if ($this->session->userdata['sess_user']['user_role'] == 1) { 
        ?>
            <li class="treeview">
                <a class="menu-item" href="<?php echo base_url('#');?>" data-toggle="treeview">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                    <span class="menu-label">Administrator</span><i class="treeview-indicator fa fa-lg fa-angle-right" aria-hidden="true"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('user/manage'); ?>">Manage Employees</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('user/create_account'); ?>">Add New Employee</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('cms'); ?>">Manage Contents</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('cms/add'); ?>">Add New Content</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('holiday'); ?>">Manage Holiday</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('leave/manage/all'); ?>">Leave Requests</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('leave/leave_balance'); ?>">Manage Leave Balance</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('leave/manage/assigned_to_me'); ?>">Leave Requests to Approve</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('timesheet/report'); ?>">Timesheet Report</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('project'); ?>">Manage Projects</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('project/activity'); ?>">Manage Task Activities</a>
                    </li>
                </ul>
            </li>
        <?php 
        } 
        // Admin Menu Ends
        ?>
        
        <li class="treeview">
            <a class="menu-item" href="<?php echo base_url('#');?>" data-toggle="treeview">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                <span class="menu-label">Organization</span><i class="treeview-indicator fa fa-lg fa-angle-right" aria-hidden="true"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="<?php echo base_url('user/search_employee'); ?>">Employee Directory</a>
                </li>
                <li>
                    <a class="treeview-item" href="<?php echo base_url('home/policy'); ?>">HR Policies</a>
                </li>
                <li>
                    <a class="treeview-item" href="<?php echo base_url('holiday/view'); ?>">Holidays</a>
                </li>
            </ul>
        </li>

        <li class="treeview">
            <a class="menu-item" href="<?php echo base_url('#');?>" data-toggle="treeview">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                <span class="menu-label">My Team</span><i class="treeview-indicator fa fa-lg fa-angle-right" aria-hidden="true"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="<?php echo base_url('user/reportee_employee'); ?>">My Reportees</a>
                </li>
            </ul>
        </li>

        <li class="treeview">
            <a class="menu-item" href="<?php echo base_url('#');?>" data-toggle="treeview">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                <span class="menu-label">Timesheet</span><i class="treeview-indicator fa fa-lg fa-angle-right" aria-hidden="true"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="<?php echo base_url('timesheet'); ?>">Log Task</a>
                </li>
                <li>
                    <a class="treeview-item" href="<?php echo base_url('timesheet/report?redirected_from=reportee_id'); ?>">Report</a>
                </li>
            </ul>
        </li>

        <li class="treeview">
            <a class="menu-item" href="<?php echo base_url('#');?>" data-toggle="treeview">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                <span class="menu-label">Leave</span><i class="treeview-indicator fa fa-lg fa-angle-right" aria-hidden="true"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="<?php echo base_url('leave/apply'); ?>">Apply</a>
                </li>
                <li>
                    <a class="treeview-item" href="<?php echo base_url('leave/history'); ?>">History</a>
                </li>
                <li>
                    <a class="treeview-item" href="<?php echo base_url('user/edit_approvers'); ?>">Change Approvers</a>
                </li>
                <li>
                    <a class="treeview-item" href="<?php echo base_url('leave/manage/assigned_to_me'); ?>">Leave to Approve</a>
                </li>
            </ul>
        </li>
        
        <li class="treeview">
            <a class="menu-item" href="<?php echo base_url('#');?>" data-toggle="treeview">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span class="menu-label">My Account</span><i class="treeview-indicator fa fa-lg fa-angle-right" aria-hidden="true"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="<?php echo base_url('user/profile'); ?>">My Profile</a>
                </li>
                <li>
                    <a class="treeview-item" href="<?php echo base_url('user/edit_profile'); ?>">Edit Basic Information</a>
                </li>
                <li>
                    <a class="treeview-item" href="<?php echo base_url('user/profile_pic'); ?>">Profile Photo</a>
                </li>
                <li>
                    <a class="treeview-item" href="<?php echo base_url('document'); ?>">My Documents</a>
                </li>
                <li>
                    <a class="treeview-item" href="<?php echo base_url('user/change_password'); ?>">Change Password</a>
                </li>
                <li>
                    <a class="treeview-item" href="<?php echo base_url('user/logout'); ?>">Logout</a>
                </li>
            </ul>
        </li>

    </ul>

</aside>
<?php } ?>