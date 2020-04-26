<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $el_html_head; ?>
    <!-- Core Bootstrap CSS with customized (theme) style should be loaded first -->
    <link href="<?php echo base_url('assets/dist/css/styles.min.css?time='.time()); ?>" rel="stylesheet">
	
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url('assets/vendors/font-awesome-free/css/fontawesome.min.css');?>" rel="stylesheet">    
    <!-- jQuery DataTables Core CSS -->    
    <link href="<?php //echo base_url('assets/vendors/datatables.net-dt/css/jquery.dataTables.css');?>" rel="stylesheet">
    <!-- Bootstrap 4 DataTables CSS -->    
    <link href="<?php echo base_url('assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css');?>" rel="stylesheet">
	<!--Select 2 CSS-->
	<link href="<?php echo base_url('assets/vendors/select2/dist/css/select2.min.css');?>" rel="stylesheet" />
	<!--Date Picker-->
	<link href="<?php echo base_url('assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>" rel="stylesheet" />

    <!--Full calendar-->
    <link href="<?php echo base_url('assets/vendors/fullcalendar/packages/core/main.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/vendors/fullcalendar/packages/bootstrap/main.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/vendors/fullcalendar/packages/daygrid/main.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/vendors/fullcalendar/packages/timegrid/main.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/vendors/fullcalendar/packages/list/main.css');?>" rel="stylesheet" />
    <!-- Sidebar-->
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/vendors/malihu-custom-scrollbar-plugin/css/jquery.mCustomScrollbar.min.css');?>"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'); ?>"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'); ?>"></script>
    <![endif]-->
</head>

<body class="body-with-sidebar-layout" data-controller="<?php echo $this->router->class; ?>" data-method="<?php echo $this->router->method; ?>">
	
<div class="wrapper">
        <!-- Sidebar  -->
        <?php echo $el_sidebar; ?>
        <!-- Page Content  -->
        <div id="content" class="">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info"><i class="fas fa-fw fa-align-left"></i><span> Toggle Sidebar</span></button>
                <!--  Show this only on mobile to medium screens  -->
                <a class="navbar-brand-centered-logo navbar-brand d-lg-none" href="<?php echo base_url($this->router->directory); ?>"><img class="nav-logo" src="<?php echo base_url('assets/dist/img/logo-dark.png');?>"></a>
                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <!-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-fw fa-align-justify"></i>
                        </button> -->
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
                                aria-expanded="false"><i class="fas fa-fw fa-user" aria-hidden="true"></i> My Account</a>
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
                                <a class="dropdown-item" href="<?php echo base_url('user/logout'); ?>">Sign out</a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                </div>
            </nav>
            <?php echo $maincontent; ?>
        </div> <!--/#content-->
    </div>
    <div class="overlay"></div>
	<button class="btn btn-outline-info scrollup"><i class="fas fa-arrow-up"></i></button>
	<div class="ajax-loader-ui" id="ajax-loader" style="display:none;">
        <div class="ajax-loader-img"><img src="<?php echo base_url('assets/dist/img/rolling.gif');?>" alt="Loading"></div>
	</div>

    
	<!-- jQuery -->    
	<script type="text/javascript" src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js'); ?>"></script>	
    <!-- Bootstrap dependency popper.js -->
    <script src="<?php echo base_url('assets/vendors/popper.js/dist/umd/popper.min.js'); ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	
	
	<!-- jQuery DataTables Core JavaScript -->
    <script src="<?php echo base_url('assets/vendors/datatables.net/js/jquery.dataTables.js'); ?>"></script>    
    <!-- Bootstrap4 DataTables JavaScript -->
    <script src="<?php echo base_url('assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.js'); ?>"></script>    
	<!--Select 2-->
    <script src="<?php echo base_url('assets/vendors/select2/dist/js/select2.min.js');?>"></script>	
	<!-- Datepicker JS -->
	<script src="<?php echo base_url('assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>	
	<!-- Pace JS for page load progress -->
	<script src="<?php echo base_url('assets/vendors/pace-js/pace.min.js'); ?>"></script>
	
	<!-- CKEditor -->
	<!-- <script src="<?php echo base_url('assets/vendors/ckeditor5-build-classic/build/ckeditor.js'); ?>"></script> -->
    <!-- <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script> -->
    <script src="<?php echo base_url('assets/vendors/ckeditor/ckeditor.js'); ?>"></script>
    
    <!--Full Calendar-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/core/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/interaction/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/bootstrap/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/daygrid/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/timegrid/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/list/main.js');?>"></script>
    <!-- Font Awesome JS -->
    <script src="<?php echo base_url('assets/vendors/font-awesome-free/js/solid.min.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/font-awesome-free/js/fontawesome.min.js');?>"></script>
    <!-- jQuery Custom Scroller CDN -->
    <!-- <script src="<?php echo base_url('assets/vendors/malihu-custom-scrollbar-plugin/js/jquery.mCustomScrollbar.concat.min.js');?>"></script> -->
	<!--Application Specific JS Loading Through Controllers-->
    <?php echo isset($app_js) ? $app_js : ''; ?>
    <script type="text/javascript">
        $(document).ready(function () {
            // $("#sidebar").mCustomScrollbar({
            //     theme: "minimal"
            // });
            // static nav
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

            //fixed nav
            // $('#sidebarCollapse').on('click', function () {
            //     $('#sidebar, #content').toggleClass('active');
            //     $('.collapse.in').toggleClass('in');
            //     $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            // });

            // overlaynav
            // $('#dismiss, .overlay').on('click', function () {
            //     $('#sidebar').removeClass('active');
            //     $('.overlay').removeClass('active');
            // });

            // $('#sidebarCollapse').on('click', function () {
            //     $('#sidebar').addClass('active');
            //     $('.overlay').addClass('active');
            //     $('.collapse.in').toggleClass('in');
            //     $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            // });
            $('#locksidebar').on('click', function(){
                var xhr = new Ajax();
                xhr.url = SITE_URL + ROUTER_DIRECTORY + 'home' + '/sidebar_toggle';
                xhr.data = {active: true};
                var promise = xhr.init();
                promise.done(function(response) {
                    window.location.reload(); 
                });
                promise.always(function() {
                    //window.location.reload();
                });
            });
        });
    </script>
</body>
</html>
