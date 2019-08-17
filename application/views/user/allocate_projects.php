<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">	
    <div class="col-md-8">
		<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => 'assign_projects','id' => 'address_add')); ?>
        <?php echo form_hidden('form_action', 'add'); ?>
			<div class="form-row">                
				<div class="form-group col-md-6">                                
					<label for="academic_qualification" class="">Projects</label>
					<?php
					echo form_dropdown('project_id[]', $arr_projects, set_value('project_id'), array(
						'class' => 'form-control ci-js-select-2',
						'multiple' => 'multiple'
					));
					?> 
					<?php echo form_error('project_id'); ?>
				</div>					
            </div>
			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile');?>" class="ml-2 btn btn-secondary">Cancel</a>
        <?php echo form_close(); ?>
    </div>  
</div>