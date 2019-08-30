<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-md-12">
	<?php echo isset($alert_message) ? $this->common_lib->display_flash_message($alert_message, $alert_message_css) : ''; ?>
        <p>Command in cPanel</p>
        <p>/usr/local/bin/php /home/xyzportal/public_html/webportal/index.php example send_mail_cron_job</p>
    </div>
</div>
