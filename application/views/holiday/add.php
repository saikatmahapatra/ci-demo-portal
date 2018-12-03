<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="h3 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

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
		<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
		<?php echo form_hidden('form_action', 'insert'); ?>

		
		<div class="form-row">
			<div class="form-group col-md-3">									
				<label for="holiday_date" class="">Holiday Date <span class="required">*</span></label>
				<?php echo form_input(array('name' => 'holiday_date', 'value' => set_value('holiday_date'), 'id' => 'holiday_date', 'class' => 'form-control holiday-datepicker', 'placeholder' => '', 'readonly'=>true));?>
				<?php echo form_error('holiday_date'); ?>
			</div>
			<div class="form-group col-md-5">									
				<label for="holiday_description" class="">Holiday Reason / Occasion <span class="required">*</span></label>
				<?php echo form_input(array('name' => 'holiday_description', 'value' => set_value('holiday_description'), 'id' => 'holiday_description', 'class' => 'form-control', 'placeholder' => ''));?>
				<?php echo form_error('holiday_description'); ?>
			</div>
			<div class="form-group col-md-4">									
				<label for="holiday_type" class="">Holiday Type <span class="required">*</span></label>
				<?php echo form_dropdown('holiday_type', $arr_holiday_type, set_value('holiday_type'), array('class' => 'form-control')); ?>
				<?php echo form_error('holiday_type'); ?>
			</div>
		</div>
		
		
		<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
		<a href="<?php echo base_url($this->router->directory.$this->router->class);?>" class="ml-2 btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
		<?php echo form_close(); ?>
	</div>
</div>