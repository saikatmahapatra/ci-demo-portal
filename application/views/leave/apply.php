<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

<div class="row my-2">
	<div class="col-md-12">
	<?php
	// Show server side flash messages
	if (isset($alert_message)) {
		$html_alert_ui = '';                
		$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
		echo $html_alert_ui;
	}
	?>
	</div>	
</div>

<div class="row my-3">
	<div class="col-md-12">
		<?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form','name' => '','id' => 'ci-form-leave',)); ?>
		<?php echo form_hidden('form_action', 'add'); ?>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="leave_type" class="bmd-label-floating">Leave Type <span class="required">*</span></label>
				<?php
				echo form_dropdown('leave_type', $leave_type_arr, set_value('leave_type'), array(
					'class' => 'form-control',
				));
				?> 
				<?php echo form_error('leave_type'); ?>
			</div>
								
			<div class="form-group col-md-2">
				<label for="leave_from_date" class="bmd-label-floating">From Date <span class="required">*</span></label>
				<?php echo form_input(array('name' => 'leave_from_date','value' => set_value('leave_from_date'),'id' => 'leave_from_date','class' => 'form-control', 'placeholder'=>'dd-mm-yyyy', 'readonly'=>'readonly')); ?>
				<?php echo form_error('leave_from_date'); ?>
			</div>
				
			<div class="form-group col-md-2">
				<label for="leave_to_date" class="bmd-label-floating">To Date <span class="required">*</span></label>		
				<?php echo form_input(array('name' => 'leave_to_date','value' => set_value('leave_to_date'),'id' => 'leave_to_date','class' => 'form-control', 'placeholder'=>'dd-mm-yyyy', 'readonly'=>'readonly')); ?>
				<?php echo form_error('leave_to_date'); ?>
			</div>
		
			<div class="form-group col-md-5">
				<label for="leave_reason" class="bmd-label-floating">Reason <span class="required">*</span></label>
				<?php
				echo form_input(array(
					'name' => 'leave_reason',
					'value' => set_value('leave_reason'),
					'id' => 'leave_reason',
					'class' => 'form-control',
					'placeholder'=>'Briefly describe leave reason',
					'maxlength' => '100'
				));
				?>
				<?php echo form_error('leave_reason'); ?>				
			</div>
		</div>
		<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-check-circle"></i> Submit</button>
		<?php echo form_close(); ?>
	</div>
</div>