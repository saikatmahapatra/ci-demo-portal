<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $el_html_head; ?>
    <!-- Core Bootstrap CSS with customized (theme) style should be loaded first -->
    <link href="<?php echo base_url('assets/dist/css/styles.min.css?time='.time()); ?>" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'); ?>"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'); ?>"></script>
    <![endif]-->
</head>

<body class="sb-nav-fixed <?php echo isset($this->session->userdata['sess_hide_sidebar_md']) ? 'sb-sidenav-toggled' : ''; ?>" data-controller="<?php echo $this->router->class; ?>" data-method="<?php echo $this->router->method; ?>">
    <?php echo $el_navbar; ?>
    <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php echo $el_sidebar; ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <?php echo $maincontent; ?>
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
	
	<!-- CKEditor -->
    <script src="<?php echo base_url('assets/vendors/ckeditor/ckeditor.js'); ?>"></script>
    
    <!--Full Calendar-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/core/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/interaction/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/bootstrap/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/daygrid/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/timegrid/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/list/main.js');?>"></script>

	<!--Application Specific JS Loading Through Controllers-->
    <?php echo isset($app_js) ? $app_js : ''; ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#locksidebar').on('click', function(e){
                e.preventDefault();
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
