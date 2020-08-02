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

<body class="sb-nav-fixed" data-controller="<?php echo $this->router->class; ?>" data-method="<?php echo $this->router->method; ?>">
    <?php echo $el_navbar; ?>
    <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php echo $el_sidebar; ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <?php echo $maincontent; ?>
                        <!-- <h1 class="mt-4">Sidenav Light</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sidenav Light</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                This page is an example of using the light side navigation option. By appending the
                                <code>.sb-sidenav-light</code>
                                class to the
                                <code>.sb-sidenav</code>
                                class, the side navigation will take on a light color scheme. The
                                <code>.sb-sidenav-dark</code>
                                is also available for a darker option.
                            </div>
                        </div> -->
                    </div>
                </main>
                <?php echo $el_footer; ?>
            </div>
        </div>
    <?php echo $el_scroll_to_top; ?>
    <?php echo $el_loader; ?>
    <?php echo $el_confirmation_modal; ?>
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
        // $(document).ready(function () {
        //     $('#sidebarCollapse').on('click', function () {
        //         $('#sidebar').toggleClass('active');
        //     });
        //     $('#locksidebar').on('click', function(){
        //         var xhr = new Ajax();
        //         xhr.url = SITE_URL + ROUTER_DIRECTORY + 'home' + '/sidebar_toggle';
        //         xhr.data = {active: true};
        //         var promise = xhr.init();
        //         promise.done(function(response) {
        //             window.location.reload(); 
        //         });
        //         promise.always(function() {
        //             //window.location.reload();
        //         });
        //     });
        // });
    </script>
</body>
</html>
