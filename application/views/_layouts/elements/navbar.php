<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
    <button type="button" id="sidebarCollapse" class="btn btn-light navbar-toggler" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <!--  Show this only on mobile to medium screens  -->
    <a class="navbar-brand-centered-logo navbar-brand d-lg-none" href="<?php echo base_url($this->router->directory); ?>"><img class="nav-logo" src="<?php echo base_url('assets/dist/img/logo-dark.png');?>"></a>
    
    <!--  Use flexbox utility classes to change how the child elements are justified  -->
    <div class="collapse navbar-collapse justify-content-between" id="navbarToggle">
        <ul class="navbar-nav">
            <!-- <li class="nav-item">
                <a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
            </li> -->
        </ul>
        <!--   Show this only lg screens and up   -->
        <a class="navbar-brand-centered-logo navbar-brand d-none d-lg-block" href="<?php echo base_url($this->router->directory); ?>"><img class="nav-logo" src="<?php echo base_url('assets/dist/img/logo-dark.png');?>"></a>
        <ul class="navbar-nav"> <!--/.nav ml-auto-->
            <!-- <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li> -->
            <?php if (isset($this->session->userdata['sess_user']['id'])) {   ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown_5" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><?php echo $this->common_lib->get_icon('user_account'); ?> 
                    <?php echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?>
                    </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown_5">					
                    <div class="dropdown-item welcome-user-container">
                        <!-- <div class="mb-1"><?php //echo isset($this->session->userdata['sess_user']['user_firstname']) ? $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname']:'Guest';?></div> -->
                        <div class="small"><?php echo isset($this->session->userdata['sess_user']['user_emp_id']) ? 'Employee ID : '.$this->session->userdata['sess_user']['user_emp_id'] :'';?></div>
                        <div class="small"><?php echo isset($this->session->userdata['sess_user']['designation_name']) ? $this->session->userdata['sess_user']['designation_name'] :'';?></div>
                        <div class="small"><?php echo isset($this->session->userdata['sess_user']['user_email']) ? $this->session->userdata['sess_user']['user_email'] :'';?></div>
                        <div class="small">Access Group: <?php echo isset($this->session->userdata['sess_user']['user_role_name']) ? $this->session->userdata['sess_user']['user_role_name'] :'';?></div>
                        <div class="small">Last Login: <?php echo isset($this->session->userdata['sess_user']['user_login_date_time']) ? $this->common_lib->display_date($this->session->userdata['sess_user']['user_login_date_time'], true) :'';?></div>					
                    </div><!--/.welcome-user-container-->
                    
                    <div class="dropdown-divider"></div>			
                    <a class="dropdown-item"  href="<?php echo base_url('user/profile/'); ?>">My Profile</a>
                    <a class="dropdown-item" href="<?php echo base_url('user/change_password'); ?>">Change Password</a>
                    <a class="dropdown-item" href="<?php echo base_url('user/logout'); ?>">Sign Out</a>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
    </div>
</nav>