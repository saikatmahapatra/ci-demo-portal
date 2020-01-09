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
        <div class="small">
            <p class="sidebar-user-name">
                <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'] : '' ;?>
            </p>
            <p class="sidebar-user-designation">
                <?php echo isset($this->session->userdata['sess_user']['user_emp_id']) ? 'Emp ID :  '.$this->session->userdata['sess_user']['user_emp_id'] :'';?>
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
                        <a class="treeview-item" href="<?php echo base_url('user/create_account'); ?>">Add New Employee</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('document'); ?>">Upload Documents</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('user/edit_approvers'); ?>">Change Leave Approvers</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('leave/apply'); ?>">Apply Leave</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?php echo base_url('leave/history'); ?>">Leave History</a>
                    </li>
                </ul>
            </li>
        <?php 
        } 
        // Admin Menu Ends
        ?>
        
        <li class="treeview">
            <a class="menu-item" href="<?php echo base_url('#');?>" data-toggle="treeview">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
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