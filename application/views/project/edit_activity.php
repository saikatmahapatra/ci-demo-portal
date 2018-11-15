<?php
$row = $rows[0];
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

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
		<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
		<?php echo form_hidden('form_action', 'update'); ?>
		<?php echo form_hidden('id', $row['id']); ?>
		
		<div class="form-row">						
			<div class="form-group col-md-8">
				<label for="task_activity_name" class="">Project Name <span class="required">*</span></label>
				<?php echo form_input(array('name' => 'task_activity_name', 'value' => (isset($_POST['task_activity_name']) ? set_value('task_activity_name') : $row['task_activity_name']), 'id' => 'task_activity_name', 'class' => 'form-control', 'placeholder' => ''));?>
				<?php echo form_error('task_activity_name'); ?>
			</div>		
		</div>		
		<div class="form-row">
			<div class="form-group col-md-12">									
			<label for="task_activity_status" class="">Display Status <span class="required">*</span></label>				
				  	<div class="">
						<div class="custom-control custom-radio custom-control-inline">
							<?php
								$radio_is_checked = isset($_POST['task_activity_status']) ? $_POST['task_activity_status'] == 'Y' : ($row['task_activity_status'] == 'Y');

								echo form_radio(array('name' => 'task_activity_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('task_activity_status', 'Y'));
							?>
							<label class="custom-control-label" for="Y">Publish</span></label>
						</div>
						
						<div class="custom-control custom-radio custom-control-inline">
							<?php
								$radio_is_checked = isset($_POST['task_activity_status']) ? $_POST['task_activity_status'] == 'N' : ($row['task_activity_status'] == 'N');

								echo form_radio(array('name' => 'task_activity_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('task_activity_status', 'N'));
							?>
							<label class="custom-control-label" for="N">Unpublish</span></label>
						</div>								
					</div>
					<small class="form-text text-muted">Unpublished projects will not appear at timesheet project list dropdown.</small>
					<?php echo form_error('task_activity_status'); ?>
			</div>
		</div>
		
		<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
		
		<a href="<?php echo base_url($this->router->directory.$this->router->class.'/activity');?>" class="ml-2 btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>                             
		<?php echo form_close(); ?>
	</div>
</div>