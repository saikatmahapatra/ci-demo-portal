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
        <h4>Read Only Sub Dir</h4>        
        <?php 
        echo '<pre>';
        print_r($sub_folders); 
        echo '</pre>';
        ?>
            <h4>Read Sub Dir + Files</h4>
        <?php 
        echo '<pre>';
        print_r($read_dir); 
        echo '</pre>';
        ?>
    </div>

</div>