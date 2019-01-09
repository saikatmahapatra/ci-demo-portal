<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $el_html_head; ?>
    <!-- Core Bootstrap CSS with customized (theme) style should be loaded first -->
    <link href="<?php echo base_url('assets/dist/css/styles.css');?>" rel="stylesheet">
	
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

    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'); ?>"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'); ?>"></script>
    <![endif]-->
</head>

<body class="app sidebar-mini" data-controller="<?php echo $this->router->class; ?>" data-method="<?php echo $this->router->method; ?>">	
	
    <?php //echo $el_navbar; ?>
    <?php echo $el_header; ?>
    <?php echo $el_sidebar; ?>
    
    <main class="main-content" role="main">
        <h1 class="h1 mb-3 font-weight-normal">Bootstrap SASS Customized Theme Components : UX Guide</h1>
        <h1 class="h3 mb-3 mt-3 font-weight-normal">Text</h1> 
		<p><a href="https://getbootstrap.com/">Bootstrap</a> is an open source toolkit for developing with <span class="font-weight-bold">HTML, CSS, and JS</span>. Quickly prototype your ideas or build your entire app with our Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful plugins built on jQuery.</p>
        <?php echo $maincontent; ?>
    </main>
	
	<footer class="footer">
        <?php echo $el_footer; ?>
    </footer>

	<button class="btn btn-primary scrollup"><i aria-hidden="true" class="fa fa-arrow-up"></i></button>
	<div class="ajax-loader-ui" id="ajax-loader" style="display:none;">
		<!--<img src="<?php echo base_url('assets/src/img/ajax-loader.svg');?>" class="ajax-loader-img" alt="Loading...">-->
		<div class="ajax-loader-img"></div>
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
	
	<!--Application Specific JS Loading Through Controllers-->
    <?php echo isset($app_js) ? $app_js : ''; ?>
</body>
</html>
