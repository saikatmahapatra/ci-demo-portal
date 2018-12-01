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
		<?php 
		//print_r($approvers); //echo sizeof($approvers); 
		$myapprover = isset($approvers) && sizeof($approvers) > 0 ? $approvers[0] : null;
		?>

		<?php 
		$has_approvers = false;
		$msg = '';
		$msg_css = 'alert-warning';
		if(isset($myapprover) ){
			$has_approvers = true;
			$msg = 'Your approvers. To update your approvers please contact to system administrator / HR';
			$msg_css = 'alert-info';
			if($myapprover['user_supervisor_id'] == 0 || $myapprover['user_director_approver_id'] == 0){
				$has_approvers = false;
				//$msg = 'You are not tagged with any approvers';
				//$msg_css = 'alert-danger';
			}	
		}else{
			$has_approvers = false;
			$msg = 'You are not tagged with any approvers';
			$msg_css = 'alert-danger';
		}
		?>

		<div class="alert <?php echo isset($msg_css) ? $msg_css : '';?>">
			<?php echo isset($msg) ? $msg : '';?>
			<ul>
				<li>Supervisor L1 : <?php echo $myapprover['supervisor_firstname'].' '.$myapprover['supervisor_lastname'].' '.$myapprover['supervisor_emp_id'].'';?></li>
				<li>Director L2 : <?php echo $myapprover['director_firstname'].' '.$myapprover['director_lastname'].' '.$myapprover['director_emp_id'].'';?></li>
				<li>HR L3 : <?php echo $myapprover['hr_firstname'].' '.$myapprover['hr_lastname'].' '.$myapprover['hr_emp_id'].'';?></li>
			</ul>
		</div>

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
		
		<button type="submit" <?php echo ($has_approvers == false) ? 'disabled="disabled"' : '';  ?> class="btn btn-primary"><i class="fa fa-fw fa-check-circle"></i> Submit</button>
		<?php echo form_close(); ?>
	</div>
</div>