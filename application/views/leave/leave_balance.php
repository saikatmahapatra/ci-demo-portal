<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="h4 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
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


<div class="row">
	<div class="col-md-12">
		<?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form','name' => '','id' => 'ci-form-leavebalance',)); ?>
		<?php echo form_hidden('form_action', 'leave_balance_update'); ?>
		<?php echo form_hidden('id', ''); ?>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="user_id" class="bmd-label-floating">Employee <span class="required">*</span></label>
				<?php
				echo form_dropdown('user_id', $user_dropdwon, set_value('user_id'), array(
					'class' => 'form-control',
					'id' => 'user_dropdown'
				));
				?> 
				<?php echo form_error('user_id'); ?>
			</div>
								
			<div class="form-group col-md-2">
				<label for="cl" class="bmd-label-floating">Casual Leave <span class="required">*</span></label>
				<?php echo form_input(array('name' => 'cl','value' => set_value('cl'),'id' => 'cl','class' => 'form-control', 'placeholder'=>'', 'maxlength'=>'6')); ?>
				<?php echo form_error('cl'); ?>
			</div>
				
			<div class="form-group col-md-2">
				<label for="pl" class="bmd-label-floating">Priviledge Leave <span class="required">*</span></label>		
				<?php echo form_input(array('name' => 'pl','value' => set_value('pl'),'id' => 'pl','class' => 'form-control', 'placeholder'=>'', 'maxlength'=>'6')); ?>
				<?php echo form_error('pl'); ?>
			</div>
		
			<div class="form-group col-md-2">
				<label for="ol" class="bmd-label-floating">Optional Leave <span class="required">*</span></label>
				<?php echo form_input(array('name' => 'ol','value' => set_value('ol'),'id' => 'ol', 'class' => 'form-control','placeholder'=>'','maxlength' => '6'));
				?>
				<?php echo form_error('ol'); ?>				
			</div>

			<div class="col-md-2 mt-4">
				<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-check-circle"></i> Submit</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>

<div class="row">
	<div class="col-md-3 text-right">Balance Added on : </div>
	<div class="col-md-9"><div id="created_on"></div></div>
	
	<div class="col-md-3 text-right">Manually Updated on : </div>
	<div class="col-md-9"><div id="updated_on"></div></div>
	
	<div class="col-md-3 text-right">PL Updated by System on : </div>
	<div class="col-md-9"><div id="pl_updated_by_cron_on"></div></div>
	
	<div class="col-md-3 text-right">CL Updated by System on : </div>
	<div class="col-md-9"><div id="cl_updated_by_cron_on"></div></div>

	<div class="col-md-3 text-right">OL updated by System on : </div>
	<div class="col-md-9"><div id="ol_updated_by_cron_on"></div></div>
</div>