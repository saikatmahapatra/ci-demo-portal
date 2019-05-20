<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->

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
        <ul>
            <li><a href="<?php echo base_url($this->router->directory.$this->router->class.'/form_helper');?>" class="">Form Helper</a></li>
            <li><a href="<?php echo base_url($this->router->directory.$this->router->class.'/dom_pdf_gen_pdf');?>" class="">DOM PDF Generate</a></li>
            <li><a href="<?php echo base_url($this->router->directory.$this->router->class.'/date_helper');?>" class="">Date Helper</a></li>
            <li><a href="<?php echo base_url($this->router->directory.$this->router->class.'/directory_helper');?>" class="">Directory Helper</a></li>
            <li><a href="<?php echo base_url($this->router->directory.$this->router->class.'/bootstrap');?>" class="">Bootstrap 4.0 SASS Theme UX</a></li>
        </ul>   
    </div>

</div>