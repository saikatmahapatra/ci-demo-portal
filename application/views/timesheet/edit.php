<?php
$row = $rows[0];
//print_r($row);
?>

<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title.$this->common_lib->display_date($row['timesheet_date']) : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->

<div class="row">
	<div class="col-md-9">
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
		<?php echo form_hidden('selected_date', $row['timesheet_date']); ?>
		
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="project_id" class="bmd-label-floating">Project <span class="required">*</span></label>
				<?php
				echo form_dropdown('project_id', $project_arr, (isset($_POST['project_id']) ? set_value('project_id') : $row['project_id']), array(
					'class' => 'form-control',
				));
				?> 
				<?php echo form_error('project_id'); ?>
			</div>
					
			<div class="form-group col-md-4">
				<label for="activity_id" class="bmd-label-floating">Activity <span class="required">*</span></label>
				<?php
				echo form_dropdown('activity_id', $task_task_activity_type_array, (isset($_POST['activity_id']) ? set_value('activity_id') : $row['activity_id']), array(
					'class' => 'form-control',
				));
				?> 
				<?php echo form_error('activity_id'); ?>
			</div>
				
			<div class="form-group col-md-4">
				<label for="timesheet_hours" class="bmd-label-floating">Working Efforts (In Hours)<span class="required">*</span></label>							
				<?php
				echo form_input(array(
					'name' => 'timesheet_hours',
					'value' => (isset($_POST['timesheet_hours']) ? set_value('timesheet_hours') : $row['timesheet_hours']),
					'id' => 'timesheet_hours',
					'class' => 'form-control',
					'maxlength' => '5',
					'placeholder' => 'Example: 2.5',
				));
				?>
				<?php echo form_error('timesheet_hours'); ?>
			</div>
		</div>		  
			
		
		<div class="form-group">
		<label for="timesheet_description" class="bmd-label-floating">Task Description <span class="required">*</span></label>
		<?php
		echo form_textarea(array(
			'name' => 'timesheet_description',
			'value' => (isset($_POST['timesheet_description']) ? set_value('timesheet_description') : $row['timesheet_description']),
			'id' => 'timesheet_description',
			'class' => 'form-control',
			'rows' => '2',
			'cols' => '4',
			'maxlength' => '200',
			'placeholder' => 'Briefly describe in 200 characters.'
		));
		?>
		<?php echo form_error('timesheet_description'); ?>
		</div>

		<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>		
		<a href="<?php echo base_url($this->router->directory.$this->router->class);?>" class="ml-2 btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>                             
		<?php echo form_close(); ?>
	</div>
</div>