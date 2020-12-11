<nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
    <button class="btn btn-link order-0 order-lg-0" id="sidebarToggle">
        <span class="navmenu-icon navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url(); ?>">
    <!-- <img class="mx-auto" src="<?php echo base_url('assets/dist/img/logo-nav.png');?>" alt="Logo" width="48px">  -->
    MyApp</a>
    
    <ul class="navbar-nav ml-auto mr-0">
        <?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown_5" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <?php echo $this->common_lib->get_icon('user_account'); ?>
                    <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname']:'Guest';?>
                    </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown_5">
                    <div class="dropdown-item welcome-user-container">
                        <div class="mb-1"><?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></div>
                        <div class="small"><?php echo isset($this->session->userdata['sess_user']['designation_name']) ? $this->session->userdata['sess_user']['designation_name'] :'';?></div>
                        <div class="small"><?php echo isset($this->session->userdata['sess_user']['user_emp_id']) ? 'Employee ID : '.$this->session->userdata['sess_user']['user_emp_id'] :'';?></div>
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
            <!-- <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('user/logout'); ?>"><i class="fa fa-fw fa-power-off"></i> Logout</a>
            </li> -->
            <?php } ?>

    </ul>
</nav>