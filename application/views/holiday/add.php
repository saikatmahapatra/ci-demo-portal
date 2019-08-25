<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header h6">Form
			</div><!--/.card-header-->

			<div class="card-body">
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
							<label for="holiday_date" class="required">Holiday Date</label>
							<?php echo form_input(array('name' => 'holiday_date', 'value' => set_value('holiday_date'), 'id' => 'holiday_date', 'class' => 'form-control holiday-datepicker', 'placeholder' => '', 'readonly'=>true));?>
							<?php echo form_error('holiday_date'); ?>
						</div>
						<div class="form-group col-md-5">									
							<label for="holiday_description" class="required">Holiday Reason / Occasion</label>
							<?php echo form_input(array('name' => 'holiday_description', 'value' => set_value('holiday_description'), 'id' => 'holiday_description', 'class' => 'form-control', 'placeholder' => ''));?>
							<?php echo form_error('holiday_description'); ?>
						</div>
						<div class="form-group col-md-4">									
							<label for="holiday_type" class="required">Holiday Type</label>
							<?php echo form_dropdown('holiday_type', $arr_holiday_type, set_value('holiday_type'), array('class' => 'form-control')); ?>
							<?php echo form_error('holiday_type'); ?>
						</div>
					</div>
					
					
					<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
					<a href="<?php echo base_url($this->router->directory.$this->router->class);?>" class="btn btn-light btn-cancel">Cancel</a>
				<?php echo form_close(); ?>
			
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->