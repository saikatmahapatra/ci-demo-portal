<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-md-12">
		<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
		<h4>Now</h4>
		<?php echo now(); ?>
    
        <h4>Time Zone Menu</h4>
        <?php echo timezone_menu(); ?>
    
        <h4>unix_to_human</h4>
        <?php
        $now = time();
        echo unix_to_human($now); // U.S. time, no seconds
        echo '<br>';
        echo unix_to_human($now, TRUE, 'us'); // U.S. time with seconds
        echo '<br>';
        echo unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
        ?>
    </div>
</div>
