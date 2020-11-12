<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-lg-3">		
		<?php echo $cal; ?>
		<?php echo form_error('selected_date'); ?>
		<div class="mt-3 small">
			<div class="d-inline-block"><span class="i-today pr-2 pl-2 m-1 text-white"></span>Today</div>
			<div class="d-inline-block"><span class="i-selected pr-2 pl-2 m-1"></span>Selected</div>
			<div class="d-inline-block"><span class="i-has-data pr-2 pl-2 m-1"></span>Task Logged</div>
			<div class="d-inline-block"><span class="i-leave pr-2 pl-2 m-1"></span>Leave</div>
			<div class="d-inline-block"><span class="i-holiday pr-2 pl-2 m-1"></span>Holiday</div>
		</div>
		<div class="mt-2"><a id="clear_selected_days" class="btn btn-outline-secondary btn-sm" href="#">Clear all selected days</a></div>
	</div>

	<div class="col-lg-9">
	<?php echo isset($alert_message) ? $alert_message : ''; ?>
		<h2><?php echo $this->common_lib->get_icon('form_icon'); ?> Form</h2>
		<?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form form-timesheet','name' => '','id' => 'ci-form-timesheet',)); ?>
		<?php echo form_hidden('form_action', 'add'); ?>		  
		<?php echo form_hidden('selected_date',set_value('selected_date')); ?>		  

		<div class="form-group">
			<label for="selected_days" class="required">Selected Day(s)</label>
			<div id="display_selected_date">no date selected</div>
			<?php echo form_error('selected_date'); ?>
		</div>			
		<button type="submit" class="btn ci-btn-primary btn-primary">Submit</button>
		<?php echo form_close(); ?>
	</div>
</div>


