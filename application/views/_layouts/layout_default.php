<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $el_html_head; ?>
    <!-- Core Bootstrap CSS with customized (theme) style should be loaded first -->
    <link href="<?php echo base_url('assets/dist/css/styles.css?v='.time());?>" rel="stylesheet">
	
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">    
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'); ?>"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'); ?>"></script>
    <![endif]-->
</head>

<body data-controller="<?php echo $this->router->class; ?>" data-method="<?php echo $this->router->method; ?>">
	
	
    <?php echo $el_navbar; ?>
    
    <main role="main" class="container-fluid">
        <?php echo $maincontent; ?>
        <footer class="footer">
            <?php echo $el_footer; ?>
        </footer>
    </main>
	
	

	<button class="btn btn-outline-secondary scrollup"><i aria-hidden="true" class="fa fa-arrow-up"></i></button>
	<div class="ajax-loader-ui" id="ajax-loader" style="display:none;">
		<img src="<?php echo base_url('assets/dist/img/ajax-loader.svg');?>" class="ajax-loader-img" alt="Loading...">
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
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/core/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/interaction/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/bootstrap/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/daygrid/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/timegrid/main.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/fullcalendar/packages/list/main.js');?>"></script>
	<!--Application Specific JS Loading Through Controllers-->
    <?php echo isset($app_js) ? $app_js : ''; ?>
</body>
</html>
