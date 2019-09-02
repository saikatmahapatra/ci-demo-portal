<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-lg-12">
	<?php echo isset($alert_message) ? $alert_message : ''; ?>
        <p>Command in cPanel</p>
        <p>/usr/local/bin/php /home/xyzportal/public_html/webportal/index.php example send_mail_cron_job</p>
    </div>
</div>
